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

    public function showByPembayaranId($id_pembayaran)
    {
        $data = [
            'title'                 => 'Histori Pembayaran',
            'sidebar'               => 'histori-pembayaran',
            'logPembayarans'        => LogPembayaran::join('pembayaran', 'log_pembayaran.id_pembayaran', '=', 'pembayaran.id_pembayaran')
                                                    ->join('spp', 'pembayaran.id_spp', '=', 'spp.id_spp')
                                                    ->join('petugas', 'log_pembayaran.id_petugas', '=', 'petugas.id_petugas')
                                                    ->join('siswa', 'pembayaran.nisn', '=', 'siswa.nisn')
                                                    ->where('pembayaran.id_pembayaran', '=', $id_pembayaran)
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
        return $pdf->stream('laporan-histori-pembayaran.pdf');
    }

    public function showKuitansi($id)
    {
        $pembayaran = LogPembayaran::join('pembayaran', 'log_pembayaran.id_pembayaran', '=', 'pembayaran.id_pembayaran')
                                    ->join('spp', 'pembayaran.id_spp', '=', 'spp.id_spp')
                                    ->join('petugas', 'log_pembayaran.id_petugas', '=', 'petugas.id_petugas')
                                    ->join('siswa', 'pembayaran.nisn', '=', 'siswa.nisn')->where('id_log_pembayaran', '=', $id)
                                    ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
                                    ->first();
        $data = [
            'pembayaran'    => $pembayaran,
            'terbilang'     => $this->toRupiah($pembayaran->jumlah_bayar . ',0', 0)
        ];

        $pdf = PDF::loadview('admin.pages.histori-pembayaran.kuitansi', $data);
        return $pdf->stream('kuitansi.pdf');
    }

    private function toRupiah($angka, $debug)
    {
        $angka = str_replace('.',',',$angka);
        $terbilang = '';
        list ($angka, $desimal) = explode(',',$angka);
        $panjang=strlen($angka);
        for ($b=0;$b<$panjang;$b++)
        {
            $myindex=$panjang-$b-1;
            $a_bil[$b]=substr($angka,$myindex,1);
        }
        if ($panjang>9)
        {
            $bil=$a_bil[9];
            if ($panjang>10)
            {
                $bil=$a_bil[10].$bil;
            }

            if ($panjang>11)
            {
                $bil=$a_bil[11].$bil;
            }
            if ($bil!='' && $bil!='000')
            {
                $terbilang .= $this->rp_satuan($bil,$debug). ' milyar';
            }
        
        }

        if ($panjang>6)
        {
            $bil=$a_bil[6];
            if ($panjang>7)
            {
                $bil=$a_bil[7].$bil;
            }

            if ($panjang>8)
            {
                $bil=$a_bil[8].$bil;
            }
            if ($bil!='' && $bil!='000')
            {
                $terbilang .= $this->rp_satuan($bil,$debug).' juta';
            }
        
        }
    
        if ($panjang>3)
        {
            $bil=$a_bil[3];
            if ($panjang>4)
            {
                $bil=$a_bil[4].$bil;
            }

            if ($panjang>5)
            {
                $bil=$a_bil[5].$bil;
            }
            if ($bil!='' && $bil!='000')
            {
                $terbilang .= $this->rp_satuan($bil,$debug).' ribu';
            }
        
        }

        $bil=$a_bil[0];
        if ($panjang>1)
        {
            $bil=$a_bil[1].$bil;
        }

        if ($panjang>2)
        {
            $bil=$a_bil[2].$bil;
        }
        //die($bil);
        if ($bil!='' && $bil!='000')
        {
            $terbilang .= $this->rp_satuan($bil,$debug);
        }
        return trim($terbilang);
    }

    private function rp_satuan($angka, $debug)
    {
    $a_str['1']='satu';
    $a_str['2']='dua';
    $a_str['3']='tiga';
    $a_str['4']='empat';
    $a_str['5']='lima';
    $a_str['6']='enam';
    $a_str['7']='tujuh';
    $a_str['8']='delapan';
    $a_str['9']='sembilan';
   
   
    $panjang=strlen($angka);
    for ($b=0;$b<$panjang;$b++)
    {
        $a_bil[$b]=substr($angka,$panjang-$b-1,1);
    }
   
    if ($panjang>2)
    {
        if ($a_bil[2]=='1')
        {
            $terbilang=' seratus';
        }
        else if ($a_bil[2]!='0')
        {
            $terbilang= ' '.$a_str[$a_bil[2]]. ' ratus';
        }
    }

    if ($panjang>1)
    {
        if ($a_bil[1]=='1')
        {
            if ($a_bil[0]=='0')
            {
                $terbilang .=' sepuluh';
            }
            else if ($a_bil[0]=='1')
            {
                $terbilang .=' sebelas';
            }
            else
            {
                $terbilang .=' '.$a_str[$a_bil[0]].' belas';
            }
            return $terbilang;
        }
        else if ($a_bil[1]!='0')
        {
            $terbilang .=' '.$a_str[$a_bil[1]].' puluh';
        }
    }
   
    if ($a_bil[0]!='0')
    {
        $terbilang .=' '.$a_str[$a_bil[0]];
    }
    return $terbilang;
  
    }
}
