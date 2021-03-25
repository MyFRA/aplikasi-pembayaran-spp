<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\User;


class Petugas extends User
{
    use Authenticatable;
    use HasFactory;
    protected $table = 'petugas';
    protected $guard = 'petugas';
    protected $primaryKey = 'id_petugas';
    protected $fillable = ['username', 'nama_petugas', 'password', 'level', 'photo'];
}
