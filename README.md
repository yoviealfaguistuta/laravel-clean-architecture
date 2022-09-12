<br>
<br>

<div align="center">
 <h2 align="center">Laravel Clean Architecture</h2>
 <p align="center">This is one way to make laravel project clean so it's easy to read</p>
</div>

<br />
<br />

## Implementation

This project using:

- ![Form Request Validation](https://img.shields.io/badge/-Form_Request_Validation-0D1117?style=flat)&nbsp;

- ![Repository Pattern](https://img.shields.io/badge/-Repository_Pattern-0D1117?style=flat)&nbsp;

- ![Clean Controller](https://img.shields.io/badge/-Clean_Controller-0D1117?style=flat)&nbsp;

- ![Swagger Documentation](https://img.shields.io/badge/-Swagger_Documentation-0D1117?style=flat)&nbsp;

- ![Testing](https://img.shields.io/badge/-Testing-0D1117?style=flat)&nbsp;


## Prerequisite

To run this project, what you have to prepare is:

![PHP v.7.3+](https://img.shields.io/badge/-PHP_v.7.3+-0D1117?style=flat&logo=php)&nbsp;
![Laravel 8.40](https://img.shields.io/badge/-Laravel_8.40+-0D1117?style=flat&logo=laravel)&nbsp;
![PostgreeSql](https://img.shields.io/badge/-PostgreeSql-0D1117?style=flat&logo=postgresql)&nbsp;
- 

Enable multiple extensions in the php.ini file as follows:
- pdo_pgsql
- fileinfo 
- pgsql 
- openssl 

Adding Swagger environment variable in file .env:
 ```sh
 L5_SWAGGER_CONST_HOST=(Laravel Server)/api
 ```
Example: L5_SWAGGER_CONST_HOST=http://127.0.0.1:8000/api


<br>

## Running 
If all the preparations have been made then to run it as follows:

Using bash:
 ```sh
 ./run.sh
 ```

Manual Installation:
1. Install or update the required packages
  ```sh
  composer update
  ```

2. Set app key
  ```sh
  php artisan:key generate
  ```

3. Create table and data constants with migrations and seeders
  ```sh
  php artisan migrate:fresh --seed
  ```

4. Test and make sure there are no errors
  ```sh
  php artisan test
  ```

5. Run laravel server
  ```sh
  php artisan serve
  ```

6. Open a browser and copy the following address into the search field
  ```sh
  http://127.0.0.1:8000/
  ```

## Contact

Yovie Alfa Guistuta - [@yoviealfa](https://www.instagram.com/yoviealfa/) - yoviealfaguistuta@gmail.com