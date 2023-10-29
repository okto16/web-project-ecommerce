# Proyek Penjualan Pupuk menggunakan CodeIgniter 3

Proyek ini adalah contoh aplikasi penjualan pupuk berbasis web yang dibangun dengan menggunakan CodeIgniter 3 (CI3), PHP, HTML, CSS, JavaScript, dan Midtrans sebagai gateway pembayaran. Aplikasi ini memungkinkan pengguna untuk melihat produk pupuk yang tersedia, menambahkan produk ke keranjang belanja, melakukan pembayaran, dan melihat riwayat transaksi.

## Fitur Utama

- Tampilan produk pupuk yang terstruktur dengan deskripsi, harga, stok dan gambar.
- Penambahan produk ke keranjang belanja.
- Proses pembayaran menggunakan Midtrans untuk berbagai metode pembayaran (kartu kredit, transfer bank, dan lainnya).
- Halaman riwayat transaksi pengguna.
- Manajemen produk dan pesanan (dalam mode administrator).
- Penggunaan CodeIgniter 3 sebagai kerangka kerja utama untuk pengembangan.

## Prasyarat

- Web server (seperti Apache) yang mendukung PHP.
- PHP 7.0 atau versi lebih tinggi.
- Database server (MySQL atau database lainnya).
- Akun Midtrans untuk mengatur pembayaran.
- Pengetahuan dasar tentang CodeIgniter 3.

## Pengaturan Awal

1. Clone repositori ini ke server web Anda.
2. Buat database untuk proyek ini dan impor skema database yang tersedia dalam direktori `database`.
3. Konfigurasi koneksi database Anda dengan mengubah file `application/config/database.php`.
4. Atur API key Midtrans Anda di file `application/controller/snap`.

## Penggunaan

1. Akses proyek melalui browser Anda dengan mengunjungi `http://localhost/toko_online`.
2. Jelajahi produk pupuk, tambahkan produk ke keranjang belanja, dan lanjutkan ke proses pembayaran.
3. Selesaikan pembayaran menggunakan Midtrans.
4. Lihat riwayat transaksi Anda.

## Demo Singkat

https://github.com/okto16/web-project-ecommerce/assets/95692091/dad9ed7a-f227-48a1-9621-d034c5e353a5
