# Laundry Salman

Aplikasi kasir (POS) dan manajemen laundry multi-outlet berbasis web, dengan tiga peran pengguna: **admin**, **kasir**, dan **owner**. Proyek ini dibuat saat SMK (2022) dengan Laravel 8, lalu di-upgrade ke Laravel 12 pada 2026.

<!-- Tambahkan screenshot di sini, misalnya: ![Dashboard admin](docs/dashboard.png) -->

## Fitur

### Admin
- **Master data**: CRUD outlet, paket layanan (kiloan, selimut, bed cover, kaos, lainnya), member, dan user. Semuanya bisa di-export dan di-import lewat Excel.
- **Transaksi**:
  - Pilih member dan paket, lalu atur qty, diskon, pajak (%), dan biaya tambahan.
  - Kode invoice dibuat otomatis (`LJTRS` + tanggal + nomor urut).
  - Subtotal dan total dihitung ulang di server dari harga paket di database.
  - Status pembayaran tercatat (dibayar / belum dibayar).
  - Faktur dicetak sebagai PDF.
- **Laporan transaksi**: tabel laporan, export Excel, dan export PDF.
- **Operasional**:
  - Inventaris barang.
  - Penjemputan cucian, dengan status tercatat → penjemputan → selesai.
  - Penggunaan barang, dengan status diajukan beli / habis / tersedia.
  - Absensi karyawan.
  - Status diubah langsung dari tabel (AJAX). Penjemputan, penggunaan, dan absensi juga bisa di-export dan di-import lewat Excel.
- **Simulasi**: halaman latihan perhitungan gaji, transaksi barang, dan penjualan dengan diskon. Semuanya berjalan di browser (JavaScript).

### Kasir
- Kelola member.
- Input transaksi dan cetak faktur PDF.
- Lihat laporan, lalu export ke Excel atau PDF.

### Owner
- Lihat laporan, lalu export ke Excel atau PDF.

Hak akses dicek di server lewat middleware per peran. Pengguna yang membuka halaman peran lain mendapat respons 403.

## Teknologi

- Laravel 12 dan PHP 8.3+ (diuji di PHP 8.5)
- MySQL
- [Laravel Excel](https://laravel-excel.com/) 4 untuk export dan import Excel
- [Laravel DomPDF](https://github.com/barryvdh/laravel-dompdf) 3 untuk faktur dan laporan PDF
- Template admin [Gentelella](https://github.com/ColorlibHQ/gentelella) (Bootstrap 4, jQuery, DataTables, SweetAlert)

## Cara menjalankan

Kebutuhan: PHP 8.3+ (ekstensi `pdo_mysql`, `mbstring`, `gd`, `zip`, `xml`), Composer, dan MySQL.

```bash
git clone https://github.com/salman-yulio/laundry-salman.git
cd laundry-salman
composer install
cp .env.example .env              # sesuaikan DB_USERNAME dan DB_PASSWORD jika perlu
php artisan key:generate
mysql -u root -e "CREATE DATABASE laundry"
php artisan migrate --seed
php artisan serve
```

Buka http://127.0.0.1:8000. Seeder membuat 10 outlet, 10 member, dan tiga akun demo, semuanya dengan password `password123`:

| Email | Peran |
|---|---|
| `admin@gmail.com` | admin |
| `kasir@gmail.com` | kasir |
| `owner@gmail.com` | owner |

Paket belum dibuat oleh seeder, jadi tambahkan paket lewat menu **Paket** (sebagai admin) sebelum mencoba transaksi. User yang ditambahkan lewat import Excel mendapat password awal `password123`.

## Riwayat

| Waktu | Perubahan |
|---|---|
| Januari 2022 | Proyek dimulai dengan Laravel 8: skema database (outlet, paket, member, transaksi, detail transaksi, user) |
| Februari–April 2022 | CRUD master data, login multi-peran, transaksi dan faktur, laporan, export/import Excel, inventaris, penjemputan, penggunaan barang, absensi, dan simulasi |
| Oktober 2026 | Upgrade ke Laravel 12, Laravel Excel 4, dan DomPDF 3. Perbaikan bug: status pembayaran, total dihitung di server, rute status per modul, redirect loop antar peran, transaksi oleh kasir, faktur, import user, serta merapikan sisa template |

## Keterbatasan

Ditulis apa adanya supaya jelas mana yang sudah dan belum dikerjakan:

- Halaman **simulasi** hanya berjalan di browser dan menyimpan data di `localStorage`, bukan di database.
- **Laporan** hanya menampilkan transaksi berstatus "baru" yang sudah dibayar. Filter tanggal belum aktif.
- **Status transaksi** (proses, selesai, diambil) belum bisa diubah dari aplikasi.
- **Data belum dipisah per outlet.** Admin dan kasir melihat data semua outlet.
- Tombol export/import di halaman member **kasir** masih mengarah ke rute admin.
- **Belum ada automated test** selain contoh bawaan Laravel.
