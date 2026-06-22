================================================================================
PRODUCT REQUIREMENTS DOCUMENT (PRD)
PROYEK: PLATFORM AGREGATOR & PEMESANAN HOTEL BUDGET (REDDOORZ CLONE)
DIBUAT OLEH: ROMADONI LABS
================================================================================

1. INFORMASI DOKUMEN
--------------------------------------------------------------------------------
Judul Dokumen      : Product Requirements Document (PRD) - Hotel Booking Platform
Kode Proyek        : RL-HB-2026
Versi              : 1.0 (Inisial MVP)
Tanggal Pembuatan  : 22 Juni 2026
Penulis            : Tim Pengembangan Produk Romadoni Labs
Status Dokumen     : Ready for Review / Draft Terbuka

--------------------------------------------------------------------------------
2. RINGKASAN EKSEKUTIF & VISI PRODUK
--------------------------------------------------------------------------------
2.1 Latar Belakang
Banyak hotel independen, guesthouse, dan pemilik kos harian di Indonesia kesulitan 
mendapatkan visibilitas digital secara maksimal karena keterbatasan infrastruktur 
teknologi pemasaran. Di sisi lain, pelancong beranggaran terbatas (budget travelers) 
sering menghadapi ketidakpastian kualitas akomodasi saat memesan kamar murah.

2.2 Visi Produk
Membangun platform agregator akomodasi budget terstandardisasi yang andal, cepat, 
dan transparan. Platform ini akan memfasilitasi pengguna untuk memesan kamar dalam 
3 klik, serta memberikan sistem manajemen properti (Property Management System) 
yang ringkas bagi pemilik properti untuk memaksimalkan okupansi mereka.

--------------------------------------------------------------------------------
3. TUJUAN STRATEGIS & METRIK KEBERHASILAN (KPIs)
--------------------------------------------------------------------------------
* Rasio Konversi (Conversion Rate): Mencapai > 3.5% pengguna aktif harian yang 
  melakukan transaksi pemesanan sukses di fase MVP.
* Performa Kecepatan (Page Load Time): Waktu muat halaman hasil pencarian dan detail 
  properti di bawah 2.5 detik pada jaringan seluler 4G (Server-Side Rendering).
* Keandalan Sistem Pemesanan (Booking Success Rate): > 99.8% transaksi berhasil 
  diproses tanpa kegagalan sinkronisasi inventaris kamar (mencegah overbooking).
* Kecepatan Onboarding Mitra: Mitra baru dapat mengaktifkan properti mereka dan 
  menerima pesanan dalam waktu kurang dari 24 jam setelah verifikasi dokumen.

--------------------------------------------------------------------------------
4. TARGET PENGGUNA & PERSONA
--------------------------------------------------------------------------------
4.1 Tamu (Guest - Budi, 24 Tahun)
* Profil: Mahasiswa/Pekerja lepas yang gemar melakukan perjalanan hemat (backpacker).
* Kebutuhan: Kamar bersih dengan fasilitas dasar yang pasti ada (WiFi, AC, Air Bersih, 
  TV), harga kompetitif, lokasi strategis, dan metode pembayaran instan (QRIS).
* Hambatan: Takut zonk (foto tidak sesuai realita), proses refund yang rumit jika batal.

4.2 Mitra Properti (Partner - Siti, 45 Tahun)
* Profil: Pemilik guesthouse mandiri yang tidak memiliki tim IT atau pemasaran khusus.
* Kebutuhan: Aplikasi dasbor yang sangat mudah dipahami untuk mengatur ketersediaan 
  kamar, mengubah harga secara fleksibel, dan memantau pemasukan bulanan.
* Hambatan: Gagap teknologi jika sistem terlalu kompleks; takut dana tertahan lama.

4.3 Super Admin (Operasional Romadoni Labs)
* Profil: Tim internal yang bertugas menjaga kualitas ekosistem platform.
* Kebutuhan: Pusat kontrol untuk memverifikasi kelayakan properti baru, mengelola 
  kampanye promo, dan menangani sengketa (dispute) atau refund transaksi.

--------------------------------------------------------------------------------
5. PANDUAN VISUAL & IDENTITAS UI/UX (BRAND ALIGNMENT)
--------------------------------------------------------------------------------
Untuk menyelaraskan dengan personal branding Romadoni Labs yang futuristik, inovatif, 
dan bersih, antarmuka aplikasi web akan mengikuti ketentuan berikut:

* Tema Utama: Default Dark Mode UI untuk memberikan kesan premium, modern, dan 
  nyaman di mata saat diakses malam hari oleh pengguna yang sedang mencari hotel.
* Palet Warna Aksentuasi: Menggunakan gradasi warna dari Neon Cyan (#00F2FE) ke 
  Electric Purple (#8B5CF6) pada tombol aksi utama (Call to Action / CTA), teks penting, 
  indikator aktif, dan ikon navigasi utama.
* Tipografi: Menggunakan font Geometric Sans-Serif modern (seperti Plus Jakarta Sans 
  atau Outfit) untuk teks UI guna menjamin keterbacaan yang tinggi. Font Monospace 
  diterapkan khusus untuk visualisasi kode booking/e-voucher.

--------------------------------------------------------------------------------
6. SPESIFIKASI FUNGSIONAL (FITUR UTAMA) & SKALA PRIORITAS
--------------------------------------------------------------------------------
Sistem dibagi menjadi tiga modul besar dengan pembagian prioritas P0 (Mutlak untuk MVP), 
P1 (Penting untuk rilis berikutnya), dan P2 (Dapat ditunda/Nice-to-have).

6.1 Modul Aplikasi Web Pengguna (Guest Web App - Mobile-First)
* [P0] Sistem Pencarian Dinamis: Input kota/area, tanggal check-in/out, dan jumlah kamar.
* [P0] Halaman Hasil Pencarian (SERP): Daftar properti yang tersedia secara real-time 
       dilengkapi informasi harga coret, rating, dan label jaminan fasilitas.
* [P0] Alur Kerja Checkout Instan: Form ringkas data tamu, integrasi payment gateway 
       untuk otomatisasi pembayaran (QRIS & Virtual Account).
* [P0] Penerbitan E-Voucher Otomatis: Halaman konfirmasi sukses yang memuat QR Code 
       voucher setelah webhook pembayaran terverifikasi.
* [P1] Filter Tingkat Lanjut: Filter berdasarkan rentang harga spesifik, fasilitas utama, 
       dan urutan terpopuler/termurah.
* [P1] Fitur Peta Interaktif (Map View): Integrasi API peta untuk melihat lokasi hotel sekitar.
* [P1] Autentikasi Pengguna: Sistem Login/Register berbasis OTP WhatsApp atau Google Auth.

6.2 Modul Dasbor Mitra (Partner Dashboard)
* [P0] Kalender Alokasi Kamar (Inventory Management): Sistem buka/tutup slot kamar 
       secara harian untuk menghindari overbooking dari kanal offline.
* [P0] Pengaturan Tarif Properti: Fitur merubah harga dasar kamar untuk hari kerja (weekday) 
       dan akhir pekan (weekend).
* [P0] Manajemen Status Pesanan: Log daftar tamu yang akan check-in hari ini, sedang 
       menginap (in-house), atau sudah check-out.
* [P1] Ringkasan Finansial: Grafik pendapatan bulanan dan pengajuan pencairan dana 
       (payout request) langsung ke rekening bank mitra.

6.3 Modul Portal Pusat (Super Admin Portal)
* [P0] Manajemen Onboarding Properti: Menyetujui atau menolak pendaftaran hotel baru 
       setelah tim operasional melakukan peninjauan fisik/dokumen.
* [P0] Log Kendali Transaksi: Memantau perputaran uang masuk, status pembayaran dari 
       payment gateway, dan pelacakan manual jika ada kendala sistem.
* [P1] Engine Manajemen Promo: Pembuatan kode kupon diskon (berupa persentase atau 
       potongan nominal tetap) dengan limitasi tanggal dan kuota penggunaan.

--------------------------------------------------------------------------------
7. ALUR KERJA SISTEM & INTEGRASI API
--------------------------------------------------------------------------------
7.1 Alur Transaksi Utama (Booking Sequence)
1. Tamu memilih kamar -> Klik 'Pesan Sekarang' -> Mengisi Data Kontak.
2. Sistem mengunci inventaris kamar terpilih selama 15 menit (Status: Pending Payment).
3. Request dikirim ke Payment Gateway (Midtrans/Xendit) untuk generate QRIS/VA.
4. Tamu menyelesaikan pembayaran di aplikasi bank/e-wallet mereka.
5. Callback Webhook dikirim oleh Payment Gateway ke server Romadoni Labs.
6. Server memproses callback:
   - Jika Sukses: Ubah status transaksi menjadi 'Paid', potong inventaris kamar secara 
     permanen, kirim notifikasi E-Voucher ke email tamu dan WhatsApp mitra hotel.
   - Jika Kedaluwarsa (15 menit tidak bayar): Ubah status menjadi 'Cancelled', kembalikan 
     inventaris kamar ke kondisi semula agar bisa dipesan orang lain.

7.2 Integrasi Pihak Ketiga (Third-Party Integrations)
* Payment Gateway API: Untuk agregasi pembayaran lokal (QRIS, Mandiri VA, BCA VA, BNI VA).
* WhatsApp Gateway API (Fonnte/Winfly): Untuk pengiriman notifikasi instan OTP dan e-voucher.
* Cloud Storage (AWS S3 / Cloudinary): Untuk optimasi penyimpanan galeri foto properti 
  dalam format modern (.webp) guna menjaga performa load time.

--------------------------------------------------------------------------------
8. PERSYARATAN NON-FUNGSIONAL (NON-FUNCTIONAL REQUIREMENTS)
--------------------------------------------------------------------------------
8.1 Performa & Skalabilitas
* Aplikasi harus dibangun menggunakan arsitektur modern berbasis komponen (seperti React/Next.js) 
  dengan teknik Server-Side Rendering (SSR) khusus pada halaman publik demi indeksasi SEO yang kuat.
* Gambar wajib melewati proses kompresi otomatis di sisi server sebelum disimpan ke storage.

8.2 Keamanan & Kepatuhan Hukum
* Enkripsi Data: Semua lalu lintas data wajib mengimplementasikan protokol HTTPS (SSL/TLS). 
  Data kredensial pengguna wajib dienkripsi menggunakan algoritma hashing bcrypt di database.
* Kepatuhan Regulasi: Mengikuti asas regulasi Undang-Undang Perlindungan Data Pribadi (UU PDP) 
  No. 27/2022 di Indonesia. Data nomor telepon dan detail KTP (jika ada untuk mitra) tidak boleh 
  diekspos secara mentah di log sistem.

--------------------------------------------------------------------------------
9. RENCANA KERJA & ROADMAP PENGEMBANGAN
--------------------------------------------------------------------------------
* MINGGU 1-2: Fase Desain & Arsitektur Database
  - Pembuatan Wireframe UI/UX dengan orientasi tema gelap (dark theme).
  - Penyusunan skema database (ERD) untuk tabel Users, Properties, Rooms, Bookings, dan Payments.

* MINGGU 3-6: Fase Pengembangan Inti (Core Coding MVP)
  - Implementasi RESTful API / GraphQL Backend.
  - Slicing frontend Guest Web App untuk fitur pencarian, detail hotel, dan alur checkout.
  - Integrasi API Payment Gateway & pengujian skenario webhook sukses/gagal.

* MINGGU 7-8: Fase Dasbor Internal & Pengujian Massal (QA Testing)
  - Penyelesaian dasbor minimalis untuk Mitra dan Super Admin.
  - Pengujian performa (Load testing) serta perbaikan celah keamanan (Vulnerability assessment).
  - Peluncuran versi Beta terbatas (Closed Beta) untuk 5 properti mitra pertama.

================================================================================
AKHIR DARI DOKUMEN - PROYEK ROMADONI LABS
================================================================================