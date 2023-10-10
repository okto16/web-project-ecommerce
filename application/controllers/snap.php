<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Snap extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$params = array('server_key' => 'SB-Mid-server-pazbn0azjzNcJRORtvbFlxON', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
	}

	public function pupuk()
	{
		$data['tbl_member'] = $this->db->get_where('tbl_member', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('header');
		$this->load->view('sidebar', $data);
		$this->load->view('member/pembayaranpupuk');
	}

	public function token()
	{
		$email = $this->session->userdata('email');
		$namKonsumen = $this->input->post('namKonsumen');
		$alamat = $this->input->post('alamat');
		$grandtotal = 0;
		if ($keranjang = $this->cart->contents()) {
			foreach ($keranjang as $items) {
				$grandtotal += $items['subtotal'];
			}
		}
		if (empty($namKonsumen) || empty($alamat)) {
			$this->session->set_flashdata('error', 'SEMUA DATA HARUS DI ISI');
			redirect('snap/pupuk');
		}
		$transaction_details = array(
			'order_id' => rand(),
			'gross_amount' => $grandtotal,
		);
		// Optional
		$item_details = array();

		if ($keranjang = $this->cart->contents()) {
			foreach ($keranjang as $items) {
				$item = array(

					'id' => $items['id'],
					'price' => $items['price'],
					'quantity' => $items['qty'],
					'name' => $items['name'],
				);

				$item_details[] = $item;
			}
		}
		// Optional
		$billing_address = array(
			'first_name' => "$namKonsumen",
			'address' => "$alamat",
			'city' => "Yogyakarta",
			'postal_code' => "16602",
			'phone' => "081122334455",
			'country_code' => 'IDN'
		);

		// Optional
		$shipping_address = array(
			'first_name' => "Obet",
			'last_name' => "Supriadi",
			'address' => "$alamat",
			'city' => "Yogyakarta",
			'postal_code' => "16601",
			'phone' => "08113366345",
			'country_code' => 'IDN'
		);

		// Optional
		$customer_details = array(
			'first_name' => "$namKonsumen",
			'email' => "$email",
			'phone' => "081122334455",
			'billing_address' => $billing_address,
			'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;
		//ser save_card true to enable oneclick or 2click
		//$credit_card['save_card'] = true;

		$time = time();
		$custom_expiry = array(
			'start_time' => date("Y-m-d H:i:s O", $time),
			'unit' => 'day',
			'duration' => 1
		);

		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details' => $item_details,
			'customer_details' => $customer_details,
			'credit_card' => $credit_card,
			'expiry' => $custom_expiry
		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}

	public function finish()
	{
		$result = json_decode($this->input->post('result_data'), true);
		$idKonsumen = $this->session->userdata('idKonsumen');
		$namKonsumen = $this->input->post('namKonsumen');
		$alamat = $this->input->post('alamat');
		$idInvoice = $result['order_id'];

		$data_invoice = array(
			'idInvoice' => $idInvoice,
			'idKonsumen' => $idKonsumen,
			'namKonsumen' => $namKonsumen,
			'alamat' => $alamat,
			'virtual_account' => $result['va_numbers']['0']['va_number'],
			'bank' => $result['va_numbers']['0']['bank'],
			'total_harga' => $result['gross_amount'],
			'tgl_pesan' => $result['transaction_time'],
			'status' => $result['transaction_status']
		);

		$this->db->insert('invoice', $data_invoice);

		$keranjang = $this->cart->contents();
		foreach ($keranjang as $items) {
			$idProduk = $items['id'];
			$namProduk = $items['name'];
			$harga = $items['price'];
			$jumlah = $items['qty'];
			$total_harga = $harga * $jumlah;

			// Masukkan data ke dalam tabel 'tbl_detail_order'
			$data_detail = array(
				'idInvoice' => $idInvoice,
				'idProduk' => $idProduk,
				'namProduk' => $namProduk,
				'harga' => $harga,
				'jumlah' => $jumlah,
				'total_harga' => $total_harga
			);

			$this->db->insert('tbl_detail_order', $data_detail);
		}

		$Nik = $this->session->userdata('Nik');
		foreach ($this->cart->contents() as $items) {
			$idProduk = $items['id'];
			$jumlah = $items['qty'];

			// Pengurangan kuota produk dengan NIK konsumen tertentu
			$this->db->where('Nik', $Nik);
			$this->db->where('idProduk', $idProduk);
			$this->db->set('jumlahKuota', 'jumlahKuota - ' . $jumlah, FALSE); // Mengurangkan kuota sesuai jumlah yang dibeli
			$this->db->update('tbl_kuota_pupuk'); // Ganti dengan nama tabel yang sesuai

			// Lakukan pengurangan stok produk
			$this->db->where('idProduk', $idProduk);
			$this->db->set('stok', 'stok - ' . $jumlah, FALSE); // Mengurangkan stok sesuai jumlah yang dibeli
			$this->db->update('tbl_produk'); // Ganti dengan nama tabel yang sesuai
		}

		$this->cart->destroy();
		$this->session->set_flashdata('success', 'Pesanan berhasil di proses.');
		redirect('home');
	}
}