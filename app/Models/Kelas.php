<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table        = 'kelas';
    protected $primaryKey   = 'id_kelas';
    protected $fillable     = ['nama_kelas', 'id_kompetensi_keahlian'];

    public function kompetensiKeahlian()
    {
    	return $this->belongsTo('App\Models\KompetensiKeahlian', 'id_kompetensi_keahlian', 'id_kompetensi_keahlian');
    }
}
