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
    ```sh
        php artisan migrate --seed -> running migrate with generate seeder
        php artisan migrate -> running migrate only
    ```
- create jwt secret
    ``` sh
        php artisan jwt:secret
    ```
- Storage link
    ``` sh
        php artisan storage:link    
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
1. Authentification (DONE)

- Register (DONE)

``` bash
# POST
# ------------------------
# /auth/register
# --------------------------
# Body Request Type Raw Json
{
    "nama": "STRING",
    "alamat": "STRING",
    "email": "STRING",
    "password": "STRING"
}

# Response Success (Code 201)
{
    "message": "registrasi akun berhasil"
}

# Response Bad (Code 400)
{
    "message": "email telah digunakan"
}

```
- Login (DONE)

``` bash
# POST
# ------------------------
# /auth/login
# --------------------------

# Body Request Type Raw Json
{
    "email": "STRING",
    "password": "STRING"
}

# Response Success (Code 200)
{
    "message": "user succesfully log in",
    "token": "$JWT_TOKEN"
}

# Response Bad (Code 400)
{
    "message": "email atau password salah"
}
```
2. User (with authentification jwt token)

- Create News
``` bash
# POST
# --------------------
# /user/news
# ---------------------

# Authentification
{
    "Baerer $this_token"
}

# Body Request Type Form Data
{
    "judul":"STRING",
    "isi":"STRING",
    "gambar":"FILE",
    "tag_name":"STRING", # with separator (,) ex : viral,medsos 
    "kategori_id":"INT",
}

# Response Success (Code 201)
{
    "message":"Berita berhasil disimpan"
}

# Response Unautorized (Code 401)
{
    "message": "sesi anda telah habis, silahkan login ulang"
}
```

- Get All News
``` bash
# GET
# --------------------
# /user/news
# ---------------------

# Authentification
{
    "Baerer $this_token"
}

# Response Success (Code 200)
{
    "total": "INT",
    "data": [
        {
            "id": "INT"
            "judul":"STRING",
            "isi":"STRING",
            "gambar":"STRING",
            "dilihat":"INT",
            "kategori_name":"STRING",
            "tag_name":"STRING", # with separator (,) ex : viral,medsos 
            "total_like": "INT",
        },
    ]
}

# Response Unautorized (Code 401)
{
    "message": "sesi anda telah habis, silahkan login ulang"
}
```
- Get By Id News

``` bash
# GET
# --------------------
# /user/news/:id
# ---------------------

# Authentification
{
    "Baerer $this_token"
}

# Body Request Type Raw Json
{
    "id": "INT",
}

# Response Success (Code 200)
{
    "judul":"STRING",
    "isi":"STRING",
    "gambar":"STRING",
    "tag_name":"STRING", # with separator (,) ex : viral,medsos 
    "kategori_id":"INT",
}

# Response Unautorized (Code 401)
{
    "message": "sesi anda telah habis, silahkan login ulang"
}
```

- Update News

``` bash
# PUT
# ------------------
# /user/news/:id
# ------------------

# Authentification
{
    "Baerer $this_token"
}

# Body Request Type Form Data
{
    "judul":"STRING",
    "isi":"STRING",
    "gambar":"FILE",
    "tag_name":"STRING", # with separator (,) ex : viral,medsos 
    "kategori_id":"INT",
}

# Response Success (Code 200)
{
    "message":"Berita berhasil diupdate"
}

# Response Unautorized (Code 401)
{
    "message": "sesi anda telah habis, silahkan login ulang"
}
```
- Delete News

``` bash
# DELETE
# ----------------------
# /user/news/:id
#-----------------------

# Authentification
{
    "Baerer $this_token"
}

# Response Success (Code 200)
{
    "message":"Berita berhasil dihapus"
}

# Response Unautorized (Code 401)
{
    "message": "sesi anda telah habis, silahkan login ulang"
}
```
3. Anonim Users (DONE)

- Get All News  (DONE)
``` bash
# GET
# --------------------
# /news
# ---------------------

# Response Success (Code 200)
{
    "total": "INT",
    "data": [
        {
            "id": "INT"
            "judul":"STRING",
            "tag_name":"STRING", # with separator (,) ex : viral,medsos,
            "isi": "STRING", 
            "gambar":"STRING",
            "dilihat":"INT",
            "author_name": "STRING",
            "kategori_name":"STRING",
            "kategori_id": "STRING",
            "total_like": "INT",
        },
    ]
}
```

- Get By Id News (Anonim Read News) (DONE)
``` bash
# GET
# ----------------------
# /news/:id
# ----------------------

# Response Success (Code 200)
{
    "data":{
        "id": "INT"
        "judul":"STRING",
        "tag_name":"STRING", # with separator (,) ex : viral,medsos 
        "isi":"STRING",
        "gambar":"STRING",
        "dilihat":"INT",
        "kategori_name":"STRING",
        "author_name": "STRING",
        "total_like": "INT",
        "comment":{
            [
                {
                    "nama": "STRING",
                    "email": "STRING",
                    "value_comment": "STRING"
                },
            ]
        }
    },
}
```
- Create Comment From News  (DONE)

``` bash
# POST
# -----------------------
# /comment
# -----------------------

# Body Request Type Raw JSON
{
    "nama":"STRING",
    "email":"STRING",
    "news_id":"INT",
    "value_comment": "STRING",
}

# Response Success Code(201)
{
    "message": "Komentar anda berhasil dipublish"
}
```
- Like News (DONE)
``` bash
# POST
# ----------------
# /like
# ---------------

# Body Request Type Raw JSON
{
    "device_id":"STRING",
    "news_id":"INT",
}

# Response Success Code(201)
{
    "message": "Like Berita Berhasil"
}

# Response Bad Request Code (400)
{
    "message": "Anda telah melakukan like pada berita ini"
}
```
- Get News By Kategori  (DONE)

``` bash
# GET
# --------------------------
# /search/kategori/:id
# --------------------------

# Response Success (Code 200)
{
    "kategori_name": "Politik",
    "total": "INT",
    "data": [
        {
            "id": "INT"
            "judul":"STRING",
            "tag_name":"STRING", # with separator (,) ex : viral,medsos 
            "isi":"STRING",
            "gambar":"STRING",
            "author_name": "STRING",
            "kategori_name": "STRING",
            "kategori_id": "INT",
            "total_like": "INT"
        },
    ]
}
```
- Get News By Tag Name  (DONE)

``` bash
# GET
# --------------------------
# /search/tag
# --------------------------

# Response Success (Code 200)
{
    "tag_name": "Politik",
    "total": "INT",
    "data": [
        {
            "id": "INT"
            "judul":"STRING",
            "tag_name":"STRING", # with separator (,) ex : viral,medsos 
            "isi":"STRING",
            "gambar":"STRING",
            "author_name": "STRING",
            "kategori_name": "STRING",
            "kategori_id": "INT",
            "total_like": "INT"
        },
    ]
}
```
