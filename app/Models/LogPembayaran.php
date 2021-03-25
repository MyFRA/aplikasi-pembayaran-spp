<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPembayaran extends Model
{
    use HasFactory;
    protected $table        = 'log_pembayaran';
    protected $primaryKey   = 'id_log_pembayaran';
    protected $fillable     = ['id_log_pembayaran', 'id_pembayaran', 'id_petugas', 'tgl_bayar', 'jumlah_bayar'];
}
