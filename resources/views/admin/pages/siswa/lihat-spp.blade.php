@extends('admin.layouts.app')

@section('content')
<div class="row">
<div class="col">
    <div class="card">
        <div class="card-header">
            <h4>List Data {{ $title }}</h4>
        </div>
        <div class="card-body">
        <h3 class="mb-4">Daftar SPP Siswa: {{ $siswa->nama }}</h3>


        <h3 class="mt-5 mb-3">SPP TAHUN AJARAN</h3>
        <div id="accordion">
            @foreach($all_spp_payments as $index => $all_spp_payment)
                <div class="accordion">
                    <div class="accordion-header collapsed" role="button" data-toggle="collapse" data-target="#panel-body-{{$index}}" aria-expanded="false">
                        <h4 style="font-size: 1.35rem">{{ $all_spp_payment['spp']->tahun_ajaran }}</h4>
                    </div>
                    <div class="accordion-body collapse" id="panel-body-{{$index}}" data-parent="#accordion">
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tbody id="table-body">
                                    <tr>
                                        <th>Bulan</th>
                                        <th>Status</th>
                                        <th>Total Bayar</th>
                                        <th>Aksi</th>
                                    </tr>
                                    @foreach($all_spp_payment['months'] as $month)
                                        <tr>
                                            <td>{{ $month['bulan'] }}</td>
                                            <td>
                                                @if( $month['status'] == 'Belum Bayar' )
                                                    <button class="btn btn-sm btn-danger">{{ $month['status'] }}</button>
                                                @elseif( $month['status'] == 'Belum Lunas' )
                                                    <button class="btn btn-sm btn-primary">{{ $month['status'] }}</button>
                                                    <button class="btn btn-sm btn-dark">Kekurangan Rp. {{ number_format($all_spp_payment['spp']->nominal - $month['total_bayar'], 0, '.', '.') }}</button>
                                                @elseif( $month['status'] == 'Lunas' )
                                                    <button class="btn btn-sm btn-success">{{ $month['status'] }}</button>
                                                @endif
                                                <button class="btn btn-sm btn-"></button>
                                            </td>
                                            <td>Rp. {{ number_format($month['total_bayar'], 0, '.', '.') }}</td>
                                            <td>
                                                @if( $month['status'] != 'Lunas' )
                                                    @if( Auth::guard('petugas')->check() )
                                                        <a class="btn btn-sm btn-success" href="{{ $month['link_add_pembayaran'] }}">Bayar Sekarang</a>
                                                    @endif
                                                    @if( $month['status'] != 'Belum Bayar' )
                                                        <a class="btn btn-sm btn-primary" href="{{ url('/app-admin/histori-pembayaran/siswa/' . $siswa->nisn) }}">Lihat Histori</a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
    </div>
    </div>
</div>
@endsection