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
/login — Halaman Login
Pintu masuk utama aplikasi. Pengguna memasukkan email dan password. Jika belum punya akun, bisa diarahkan ke halaman register.
/register — Halaman Register
Pendaftaran akun baru. Role yang didaftarkan secara default adalah Pasien.
/ — Dashboard
Menampilkan 4 kartu statistik yaitu jumlah dokter (diambil dari data jadwal dokter), jumlah pasien (gabungan dari antrean dan riwayat pasien), total antrean hari ini, dan jumlah janji aktif. Di bawahnya terdapat grafik kunjungan 7 hari terakhir dan tabel 5 antrean terbaru.
/user — Manajemen User
Menampilkan daftar seluruh pengguna sistem. Admin bisa menambah, mengubah, dan menghapus data user.
/jadwaldokter — Jadwal Dokter
Menampilkan daftar jadwal praktik dokter lengkap dengan nama dokter, spesialis, hari, jam mulai, dan jam selesai. Data di sini mempengaruhi jumlah dokter yang tampil di dashboard.
/jadwalpasien — Jadwal Pasien
Menampilkan daftar pasien berdasarkan data antrean yang sudah terdaftar, diurutkan berdasarkan nomor antrean.
/antrean — Daftar Antrean
Halaman utama pengelolaan antrean harian. Tersedia fitur tambah antrean, panggil pasien berikutnya, tandai selesai, edit, dan hapus data antrean.
/riwayatpasien — Riwayat Pasien
Menampilkan rekam jejak pemeriksaan pasien yang sudah selesai ditangani.
