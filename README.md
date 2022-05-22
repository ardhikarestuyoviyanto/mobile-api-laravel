# Instalation
- forked this repository
- git clone [your repository link after forked this repo]
- cd mobile-api-laravel
- Install PHP dependencies
    ```sh
    composer install
    ```
- create file .env
- copy value file from .env.example and paste to .env
- Generate key
    ```sh
    php artisan key:generate
    ```
- configurate database setting in .env file (line 11 - line 16)
- open terminal in this project, and run
```zsh
    php artisan migrate --seed -> running migrate with generate seeder
    php artisan migrate -> running migrate only
```
- run php artisan serve and access http://127.0.0.1:8000/api in your browser

# MVP (Fitur) Project
## Anonim Users
- Register
- Membaca Berita
- Melakukan Komen Berita
- Melakukan Like Pada Berita
- Search Berita (Judul)
- Get Berita By Kategori and Tag
## Sign-in Users
- Log-in
- Crud Berita
- Show List Berita By Author 

# Design Rest Api
1. Authentification

- Register

``` bash
-- POST
------------------------
/auth/register
--------------------------
-- Body Request
{
    "nama": "nama mu",
    "alamat": "alamat mu",
    "email": "email mu",
    "password": "password mu"
}

-- Response Success (Code 200)
{
    "message": "registrasi akun berhasil"
}

-- Response Bad (Code 400)
{
    "message": "email telah digunakan"
}

```
- Login

``` bash
-- POST
------------------------
/auth/login
--------------------------
-- Body Request
{
    "email": "email mu",
    "password": "password mu"
}

-- Response Success (Code 200)
{
    "message": "user succesfully log in",
    "token": "JWT TOKEN"
}

-- Response Bad (Code 400)
{
    "message": "email atau password salah"
}
