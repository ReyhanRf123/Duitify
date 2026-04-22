# Duitify - Personal Finance Tracker (The Fiscal Sanctuary)

Duitify adalah aplikasi pengelolaan keuangan pribadi yang dibangun dengan fokus pada kejelasan visual dan efisiensi pencatatan. Proyek ini mengikuti filosofi desain **"The Fiscal Sanctuary"** yang mengedepankan ketenangan dan presisi.

## 🚀 Status Proyek: Milestone 2 - Transaction & Atomic Logic (In Progress)
- [x] Milestone 1: Foundation & Dashboard UI.
- [x] Implementasi **Atomic Transaction** (Integrasi saldo otomatis).
- [x] Fitur **Saving Goals Tracking** (Saldo target bertambah otomatis saat menabung).
- [x] UI **Soft Well Input** untuk form transaksi premium.
- [x] Upgrade Environment ke **PHP 8.5** & Laravel 11 Optimization.

## 🛠️ Fitur Teknis Milestone 2
- **Data Integrity:** Menggunakan `DB::transaction` untuk memastikan sinkronisasi antara catatan transaksi dan saldo akun.
- **Dynamic UI:** Form transaksi menggunakan teknik *inward shadow* untuk pengalaman pengguna yang lebih *immersive*.
- **Security:** Implementasi `auth()->id()` injection untuk mencegah manipulasi data antar pengguna.