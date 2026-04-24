# Duitify - Personal Finance Management

Duitify adalah aplikasi pengelolaan keuangan pribadi berbasis web yang dirancang untuk membantu pengguna melacak arus kas, memantau target tabungan, dan menganalisis pengeluaran bulanan.

## Fitur Utama
- **Dashboard Intelligence**: Grafik tren pengeluaran 7 hari terakhir dan rasio pengeluaran bulanan.
- **Transaction Management**: Pencatatan pemasukan dan pengeluaran dengan kategori dinamis.
- **Saving Goals**: Pelacakan target tabungan dengan progress bar real-time.
- **Security**: Verifikasi dua langkah (2FA) via email dan Reset Password.
- **Export Report**: Cetak laporan bulanan ke format PDF.

## Tech Stack
- **Backend**: Laravel 11 (PHP)
- **Frontend**: Tailwind CSS, Alpine.js
- **Database**: MySQL
- **Library**: Chart.js, DomPDF

## Instalasi
1. Clone repository: `git clone https://github.com/username/duitify.git`
2. Install dependencies: `composer install && npm install`
3. Salin `.env.example` ke `.env` dan atur database.
4. Generate key: `php artisan key:generate`
5. Jalankan migrasi: `php artisan migrate`
6. Jalankan build asset: `npm run build`
7. Jalankan server: `php artisan serve`