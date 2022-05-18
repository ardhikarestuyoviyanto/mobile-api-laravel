# Instalation
- forked this repository
- git clone [your repository link after forked this repo]
- cd mobile-api-laravel
- create file .env
- copy value file from .env.example and paste to .env
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
....