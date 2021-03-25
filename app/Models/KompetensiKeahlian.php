<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KompetensiKeahlian extends Model
{
    use HasFactory;

    protected $table = 'kompetensi_keahlian';
    protected $primaryKey = 'id_kompetensi_keahlian';
    protected $fillable = ['nama_kompetensi_keahlian'];
}
