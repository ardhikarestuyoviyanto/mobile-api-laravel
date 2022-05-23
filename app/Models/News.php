<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = "news";
    protected $fillable = [
        "id",
        "judul",
        "tag_name",
        "isi",
        "gambar",
        "dilihat",
        "user_id",
        "kategori_id",
        "created_at",
        "updated_at"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function like(){
        return $this->hasMany(like::class);
    }
    
    static function getallnews(){
        return static::join('kategori', 'kategori.id', '=', 'news.kategori_id')
        ->join('users', 'users.id', '=', 'news.user_id')
        ->orderBy("id", "DESC")
        ->get(["news.id", "judul", "tag_name", "isi", "gambar", "dilihat", "users.nama AS author_name", "kategori.name AS kategori_name", "kategori.id AS kategori_id"]);
    }

    static function getbyidnews($id){
        return static::join('kategori', 'kategori.id', '=', 'news.kategori_id')
        ->join('users', 'users.id', '=', 'news.user_id')
        ->where('news.id', $id)
        ->first(["news.id", "judul", "tag_name", "isi", "gambar", "dilihat", "users.nama AS author_name", "kategori.name AS kategori_name"]);
    }

    static function getbykategorinews($id){
        return static::join('kategori', 'kategori.id', '=', 'news.kategori_id')
        ->join('users', 'users.id', '=', 'news.user_id')
        ->where("news.kategori_id", $id)
        ->orderBy("id", "DESC")
        ->get(["news.id", "judul", "tag_name", "isi", "gambar", "dilihat", "users.nama AS author_name", "kategori.name AS kategori_name", "kategori.id AS kategori_id"]);
    }

    static function getbytagnews($tagname){
        return static::join('kategori', 'kategori.id', '=', 'news.kategori_id')
        ->join('users', 'users.id', '=', 'news.user_id')
        ->where("news.tag_name", 'like', '%'.$tagname.'%')
        ->orderBy("id", "DESC")
        ->get(["news.id", "judul", "tag_name", "isi", "gambar", "dilihat", "users.nama AS author_name", "kategori.name AS kategori_name", "kategori.id AS kategori_id"]);
    }

}

