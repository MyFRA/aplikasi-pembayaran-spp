<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Contracts\Auth\Authenticatable as AuthContracts;
use Illuminate\Auth\Authenticatable;

class Siswa extends Model implements AuthContracts
{
    use Authenticatable;
    use HasFactory;
    protected $table        = 'siswa';
    protected $primaryKey   = 'nisn';
    protected $fillable     = ['nisn', 'id_kelas', 'nis', 'nama', 'jenis_kelamin', 'no_hp', 'photo', 'alamat'];

    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas', 'id_kelas', 'id_kelas');
    }
}
