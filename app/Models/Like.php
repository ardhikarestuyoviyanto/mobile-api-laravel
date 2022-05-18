<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $table = "like";
    protected $fillable = [
        "id",
        "device_id",
        "news_id",
        "created_at",
        "updated_at"
    ];

    public function news(){
        return $this->belongsTo(News::class);
    }
}
