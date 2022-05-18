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
}

