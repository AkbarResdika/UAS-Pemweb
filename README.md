Nama  : M. Akbar Resdika
NIM   : 121450066
Kelas : Pemweb RB

Bagian 1: Client-side Programming (Bobot: 30%)
  1.1 Manipulasi DOM dengan JavaScript (15%)
    Penjelasan : Manipulasi DOM dapat digunakan untuk memperbarui atau mengubah elemen halaman secara dinamis tanpa perlu memuat ulang halaman

  1.2 Event Handling (15%)
    Penjelasan : Event handling digunakan untuk menangani interaksi pengguna seperti klik tombol, input data, atau peristiwa lainnya.

Bagian 2: Server-side Programming (Bobot: 30%)
  2.1 Pengelolaan Data dengan PHP (20%)
    Penjelasan : terdapat banyak pengelolaan data dengan PHP, seperti validasi input (register.php memeriksa kecocokan password), Penyimpanan data dengan query SQL (INSERT INTO users di register.php).

  2.2 Objek PHP Berbasis OOP (10%)
    Penjelasan : Sesi digunakan untuk melacak pengguna yang sedang login. Pada kode ini daata user disimpan dalam $_SESSION setelah login berhasil di login.php, akses halaman seperti Tabel.php dibatasi untuk pengguna yang telah login.

Bagian 3: Database Management (Bobot: 20%)
  3.1 Pembuatan Tabel Database (5%)
    Penjelasan : Koneksi database telah diatur dengan baik pada file Database.php. Query SQL menggunakan prepared statements untuk mencegah SQL injection. ada validasi koneksi database ($conn->connect_error) di setiap file yang menggunakan database.

  3.2 Konfigurasi Koneksi Database (5%)
    Penjelasan : pada konfigurasi koneksi dataabse memakai user, password, dbname, dan host yang disambingkan ke dalam hosting sehingga dapat diakses di seluruh device

  3.3 Manipulasi Data pada Database (10%)
    Penjelasan :


Bagian 4: State Management (Bobot: 20%)
  4.1 State Management dengan Session (10%)
    Penjelasan : Password sudah dienkripsi menggunakan password_hash() di register.php. password diverifikasi menggunakan password_verify() di login.php.

  4.2 Pengelolaan State dengan Cookie dan Browser Storage (10%)
    Penjelasan : SQL Injection dicegah dengan menggunakan prepared statements di semua query. Output data dari database difilter dengan htmlspecialchars() untuk mencegah XSS (contoh di Tabel.php).
  
Bagian Bonus: Hosting Aplikasi Web (Bobot: 20%)
(5%) Apa langkah-langkah yang Anda lakukan untuk meng-host aplikasi web Anda?
  Jawab : hal yang pertama adalah membuat akun hosting gratis mendapatkan, 5gb disk, lalu membuat myswl databases dan phpmyadmin, kemudian memasukkan file ke dalm online file manager pada hosting infinity free hosting

(5%) Pilih penyedia hosting web yang menurut Anda paling cocok untuk aplikasi web Anda.
  Jawab : infinity free hosting, karena file format saya full formpa php yang dapat diakses langung ke dalam databases online, kemudian memasukkan files ke dalam online file manager yang nantinya dapat diakses di berbagai device

(5%) Bagaimana Anda memastikan keamanan aplikasi web yang Anda host?
  Jawab  : Menerapkan validasi input di sisi server untuk mencegah serangan seperti XSS (Cross-Site Scripting) dan SQL Injection. menggunakan ORM (Object-Relational Mapping) seperti SQLAlchemy atau Django ORM untuk mencegah query SQL yang tidak aman.

(5%) Jelaskan konfigurasi server yang Anda terapkan untuk mendukung aplikasi web Anda.
  Jawab  : Database yang digunakan adalah PoMySQL yang dikonfigurasi dengan indexing dan query optimization untuk performa. Database yang digunakan adalah MySQL yang dikonfigurasi dengan indexing dan query optimization untuk performa.

