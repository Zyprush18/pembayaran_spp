# Pembayaran SPP

## Instalasi

### Prasyarat

Pastikan Anda telah menginstal [Composer](https://getcomposer.org/).

### Langkah-langkah instalasi

1. Clone repositori ini ke dalam direktori lokal Anda:
   ```
     git clone https://github.com/Zyprush18/pembayaran_spp.git
   ```
2. Masuk Ke directorinya
   ```
    cd pembayaran_spp
   ```

3. Install semua dependensi PHP menggunakan Composer
    ```
      composer install
    ```
    
4. Setelah selesai menginstal dependensi, buat salinan file .env.example menjadi .env
   ```
     cp .env.example .env
   ```
5.  sesuaikan pengaturan database anda di .env seperti host,username,password, dan nama database
6.  jalankan migrate nya untuk membuat table otomatis
   ```
     php artisan
   ```



Aplikasi akan dapat diakses di http://localhost/pembayaran_spp/login.php atau sesuai dengan konfigurasi server Anda atau pu anda juga bisa demo website nya di https://pspp.zyprush.my.id/ dengan memasukkan username `admin` dan password `admin123`.
# Pembayaran SPP
