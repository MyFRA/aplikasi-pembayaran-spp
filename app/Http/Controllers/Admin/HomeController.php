<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Petugas;
use App\Models\Siswa;
use App\Models\Pembayaran;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title'                 => 'Dashboard',
            'sidebar'               => 'dashboard',
            'total_petugas'         => Petugas::count(),
            'jumlah_siswa'          => Siswa::count(),
            'jml_dana_pembayaran'   => Pembayaran::sum('total_bayar'),
        ];

        return view('admin.pages.home.index', $data);
    }
}
