<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject{

    protected $table = "users";
    protected $fillable = [
        "id",
        "nama",
        "alamat",
        "email",
        "created_at",
        "updated_at",
        "password"
    ];
    protected $hidden = [
        "password"
    ];

    public function news(){
        return $this->hasMany(News::class);
    }

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [
            'data' => [
                'id' => $this->id,
                'nama' => $this->nama,
                'email' => $this->email,
            ]
        ];
    }  

}
