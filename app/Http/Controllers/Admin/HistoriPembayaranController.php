<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Models\LogPembayaran;

class HistoriPembayaranController extends Controller
{
    public function index()
    {
        $data = [
            'title'                 => 'Histori Pembayaran',
            'sidebar'               => 'histori-pembayaran',
            'logPembayarans'        => LogPembayaran::join('pembayaran', 'log_pembayaran.id_pembayaran', '=', 'pembayaran.id_pembayaran')
                                                    ->join('spp', 'pembayaran.id_spp', '=', 'spp.id_spp')
                                                    ->join('petugas', 'log_pembayaran.id_petugas', '=', 'petugas.id_petugas')
                                                    ->join('siswa', 'pembayaran.nisn', '=', 'siswa.nisn')
                                                    ->orderBy('log_pembayaran.created_at', 'DESC')->simplePaginate(10)
        ];

        return view('admin.pages.histori-pembayaran.index', $data);
    }

    public function show($id)
    {
        $data = [
            'title'         => 'Detail Histori Pembayaran',
            'sidebar'       => 'histori-pembayaran',
            'pembayaran'    => LogPembayaran::join('pembayaran', 'log_pembayaran.id_pembayaran', '=', 'pembayaran.id_pembayaran')
                                        ->join('spp', 'pembayaran.id_spp', '=', 'spp.id_spp')
                                        ->join('petugas', 'log_pembayaran.id_petugas', '=', 'petugas.id_petugas')
                                        ->join('siswa', 'pembayaran.nisn', '=', 'siswa.nisn')->where('id_log_pembayaran', '=', $id)
                                        ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
                                        ->first(),
        ];

        return view('admin.pages.histori-pembayaran.show', $data);
    }

    public function showByNisn($nisn)
    {
        $data = [
            'title'                 => 'Histori Pembayaran',
            'sidebar'               => 'histori-pembayaran',
            'logPembayarans'        => LogPembayaran::join('pembayaran', 'log_pembayaran.id_pembayaran', '=', 'pembayaran.id_pembayaran')
                                                    ->join('spp', 'pembayaran.id_spp', '=', 'spp.id_spp')
                                                    ->join('petugas', 'log_pembayaran.id_petugas', '=', 'petugas.id_petugas')
                                                    ->join('siswa', 'pembayaran.nisn', '=', 'siswa.nisn')
                                                    ->where('siswa.nisn', '=', $nisn)
                                                    ->orderBy('log_pembayaran.created_at', 'DESC')->simplePaginate(10)
        ];

        return view('admin.pages.histori-pembayaran.index', $data);
    }

    public function cetakIndex()
    {
        $pembayarans = LogPembayaran::join('pembayaran', 'log_pembayaran.id_pembayaran', '=', 'pembayaran.id_pembayaran')
                                    ->join('spp', 'pembayaran.id_spp', '=', 'spp.id_spp')
                                    ->join('petugas', 'log_pembayaran.id_petugas', '=', 'petugas.id_petugas')
                                    ->join('siswa', 'pembayaran.nisn', '=', 'siswa.nisn')
                                    ->orderBy('log_pembayaran.created_at', 'DESC')->get();

        $pdf = PDF::loadview('admin.pages.histori-pembayaran.cetak-pembayaran', [ 'pembayarans' => $pembayarans] );
        return $pdf->download('laporan-histori-pembayaran.pdf');
    }
}
