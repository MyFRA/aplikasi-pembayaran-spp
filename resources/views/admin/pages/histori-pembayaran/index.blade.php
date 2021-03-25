@extends('admin.layouts.app')

@section('content')
<x-header-breadcrumb :header="$title"/>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4>List Data {{ $title }}</h4>
            </div>
            <div class="card-body">
                <a href="{{ url('/app-admin/histori-pembayaran/cetak/index') }}" class="btn btn-sm btn-primary mb-3">Cetak Histori Pembayaran</a>
                @if(Session::get('success'))
                    <x-alert-bootstrap status="success" :message="Session::get('success')" />
                @endif
                @if(Session::get('failed'))
                    <x-alert-bootstrap status="failed" :message="Session::get('failed')" />
                @endif

                @if( $logPembayarans->isEmpty() )
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="row w-100">
                            <div class="col-10 offset-1 col-lg-4 offset-lg-4">
                                <img src="{{ asset('/admin/assets/img/No data-amico.svg') }}" class="w-100">
                            </div>
                        </div>
                        <h2>Tidak ada data</h2>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>ID Pembayaran</th>
                                    <th>Petugas</th>
                                    <th>Siswa</th>
                                    <th>Tgl Bayar</th>
                                    <th>Jumlah Bayar</th>
                                    <th>SPP Tahun</th>
                                    <th>Spp Bulan</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach($logPembayarans as $pembayaran)
                                <tr>
                                    <td>{{ $loop->iteration + $logPembayarans->firstItem() - 1 }}</td>
                                    <td>{{ (string) $pembayaran->id_log_pembayaran }}</td>
                                    <td>{{ $pembayaran->nama_petugas }}</td>
                                    <td>{{ $pembayaran->nama }}</td>
                                    <td>{{ $pembayaran->tgl_bayar }}</td>
                                    <td>Rp. {{ number_format($pembayaran->jumlah_bayar, 0, '.', '.') }}</td>
                                    <td>{{ $pembayaran->tahun_ajaran }}</td>
                                    <td>{{ $pembayaran->bulan_spp }}</td>
                                    <td>
                                        <a href="{{ url('/app-admin/histori-pembayaran/' . $pembayaran->id_log_pembayaran) }}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i> Detail Log Pembayaran</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            <div class="card-footer text-left mb-4">
                {{ $logPembayarans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection