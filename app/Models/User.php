<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{

    protected $table = "users";
    protected $fillable = [
        "id",
        "nama",
        "alamat",
        "email",
        "created_at",
        "updated_at"
    ];
    protected $hidden = [
        "password"
    ];

    public function news(){
        return $this->hasMany(News::class);
    }
}
