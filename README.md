<br>
<br>

<div align="center">
 <h1 align="center">Kledo - Technical Test</h1>
</div>

<br>

## Persiapan

Untuk menjalankan project ini maka yang harus disiapkan adalah:
- PHP v.7.3
- Laravel 8.40
- MySql

Aktifkan beberapa extensi di file php.ini sebagai berikut:
- pdo_mysql
- fileinfo 
- mysqli 
- openssl 

Tambahkan environment variable Swagger di file .env:
 ```sh
 L5_SWAGGER_CONST_HOST=(Laravel Server)/api
 ```
Contoh: L5_SWAGGER_CONST_HOST=http://127.0.0.1:8000/api


<br>

## Menjalankan 
Jika semua persiapan sudah dilakukan maka untuk menjalankannya sebagai berikut:

Cara otomatis dengan bash
 ```sh
 ./run.sh
 ```

Cara Manual
1. Menginstall atau memperbarui paket yang dibutuhkan
  ```sh
  composer update
  ```

2. Mengatur kunci aplikasi
  ```sh
  php artisan:key generate
  ```

3. Membuat tabel dan data constant dengan migrasi dan seeder
  ```sh
  php artisan migrate:fresh --seed
  ```

4. Testing dan pastikan tidak ada tulisan berwarna merah
  ```sh
  php artisan test
  ```

5. Jalankan server laravel
  ```sh
  php artisan serve
  ```

6. Buka browser dan salin alamat berikut ke kolom pencarian
  ```sh
  http://127.0.0.1:8000/
  ```

## Contact

Yovie Alfa Guistuta - [@yoviealfa](https://www.instagram.com/yoviealfa/) - yoviealfaguistuta@gmail.com