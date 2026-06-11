## Clone Repository
- 

# Poliklinik Sehat

Poliklinik Sehat adalah sistem informasi manajemen poliklinik berbasis web yang dibangun menggunakan framework Laravel 11. Aplikasi ini hadir sebagai solusi digital untuk membantu tenaga medis, admin, dan staf poliklinik dalam mengelola seluruh kegiatan operasional sehari-hari secara lebih terstruktur, efisien, dan mudah dipantau.
Sistem ini mencakup berbagai kebutuhan operasional poliklinik, mulai dari pengelolaan data pengguna, pengaturan jadwal dokter, pendaftaran dan pengelolaan antrean pasien, hingga pencatatan riwayat pemeriksaan. Semua fitur tersebut dapat diakses melalui antarmuka web yang responsif dan intuitif, sehingga memudahkan pengguna meskipun tidak memiliki latar belakang teknis.
Dari sisi keamanan, aplikasi ini dilengkapi dengan sistem autentikasi berbasis session, sehingga seluruh halaman utama hanya dapat diakses oleh pengguna yang sudah login. Pengguna yang belum terautentikasi akan secara otomatis diarahkan ke halaman login ketika mencoba mengakses halaman yang dilindungi.

---

## Fitur Utama

- Menggantikan pencatatan manual dengan sistem digital yang lebih efisien dan terorganisir
- Memudahkan admin dalam memantau kondisi antrean pasien secara real-time
- Menyediakan data statistik kunjungan pasien yang akurat untuk kebutuhan laporan
- Memberikan kemudahan pengelolaan jadwal dokter dan data pasien dalam satu platform terpadu
- Memastikan keamanan data dengan sistem autentikasi, sehingga hanya pengguna yang sudah login yang bisa mengakses fitur-fitur utama

---

## Tujuan Project

- **Dashboard** — Menampilkan statistik jumlah dokter, pasien, antrean hari ini, dan janji aktif secara real-time beserta grafik kunjungan 7 hari terakhir
- **Manajemen User** — CRUD data pengguna sistem (admin, dokter, pasien)
- **Jadwal Dokter** — Kelola jadwal praktik dokter beserta spesialis, hari, dan jam praktik
- **Jadwal Pasien** — Tampilan jadwal pasien berdasarkan data antrean
- **Daftar Antrean** — Kelola antrean pasien harian, panggil pasien berikutnya, dan tandai selesai
- **Riwayat Pasien** — Rekam jejak pemeriksaan pasien
- **Autentikasi** — Login, register, dan proteksi halaman (hanya bisa diakses setelah login)

---

## Struktur Fitur Per Halaman

- **Halaman Login** — igunakan untuk masuk ke sistem menggunakan akun yang sudah terdaftar.
- **Dashboard** — menampilkan ringkasan statistik poliklinik, grafik kunjungan mingguan, dan daftar antrean terbaru.
- **Halaman User** — mengelola data akun pengguna sistem, mulai dari menambah, mengubah, menghapus, hingga mencari pengguna berdasarkan nama atau role.
- **Halaman Jadwal Dokter** — mengatur jadwal praktik dokter beserta spesialis dan jam, yang secara otomatis tersinkron ke pilihan dokter di halaman antrean.
- **Halaman Jadwal Pasien** — menampilkan daftar antrean aktif sebagai jadwal harian pasien dan menyediakan form tambah janji baru.
- **Halaman Daftar Antrean** — pusat pengelolaan antrean harian — mendaftarkan pasien, memanggil urutan berikutnya, dan menyelesaikan pemeriksaan agar data masuk ke riwayat.
- **Halaman Riwayat Pasien** — menampilkan rekam medis pasien per kunjungan yang terisi otomatis dari proses penyelesaian antrean.

---

## Panduan Penggunaan Aplikasi

1. Jalankan project menggunakan php artisan serve setelah proses instalasi selesai.
2. Buka aplikasi melalui browser, lalu login menggunakan akun admin yang tersedia.
3. Setelah masuk, gunakan Dashboard untuk memantau kondisi poliklinik secara keseluruhan.
4. Buka halaman Jadwal Dokter dan tambahkan jadwal praktik dokter sebelum memulai pendaftaran antrean.
5. Gunakan halaman Daftar Antrean untuk mendaftarkan pasien — nomor antrean terisi otomatis secara urut.
6. Klik Panggil Berikutnya untuk memanggil pasien sesuai urutan, lalu klik Selesai setelah pemeriksaan selesai.
7. Data pasien yang sudah selesai akan otomatis muncul di halaman Riwayat Pasien.
8. Gunakan halaman User untuk mengelola akun petugas, dokter, atau admin yang menggunakan sistem ini.

---

## Jalankan Poject

- composer install
- php artisan migrate:fresh --seed
- php artisan serve
