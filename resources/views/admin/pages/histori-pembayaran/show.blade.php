@extends('admin.layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pembayaran ~ Detail</h1>
    </div>          
    <div class="section-body">
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                    <h4>Pembayaran ~ Detail</h4>
                    </div>
                    <div class="card-body">
                    <div class="mb-3">
                        <h6 class="text-dark">Ringkasan Pembayaran</h6>
                        <div class="group mt-2 px-3">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <th>ID Histori Pembayaran</th>
                                            <td>{{ $pembayaran->id_log_pembayaran }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Petugas</th>
                                            <td>{{ $pembayaran->nama_petugas }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Siswa</th>
                                            <td>{{ $pembayaran->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Kelas</th>
                                            <td>{{ $pembayaran->nama_kelas }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Bayar</th>
                                            <td>{{ $pembayaran->tgl_bayar }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah Bayar</th>
                                            <td>Rp. {{ number_format($pembayaran->jumlah_bayar, 0, '.', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <th>SPP Tahun Ajaran</th>
                                            <td>{{ $pembayaran->tahun_ajaran }}</td>
                                        </tr>
                                        <tr>
                                            <th>SPP Bulan</th>
                                            <td>{{ $pembayaran->bulan_spp }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ url('/app-admin/histori-pembayaran/1349570873/kuitansi') }}" class="btn btn-success">Lihat Kuitansi</a>
                    @if(Auth::guard('petugas')->check())
                    <a href="{{ url('/app-admin/histori-pembayaran') }}" class="btn btn-dark">Kembali</a>
                    @elseif(Auth::guard('siswa')->check())
                    <a href="{{ url('/app-admin/histori-pembayaran/siswa/' . Auth::guard('siswa')->user()->nisn) }}" class="btn btn-dark">Kembali</a>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection