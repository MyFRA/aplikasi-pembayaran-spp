@extends('admin.layouts.app')

@section('content')
<x-header-breadcrumb :header="$title"/>

@if(Auth::guard('petugas')->check())
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
            <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Jumlah Petugas</h4>
            </div>
            <div class="card-body">
            {{ $total_petugas }}
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Jumlah Siswa</h4>
            </div>
            <div class="card-body">
                {{ $jumlah_siswa }}
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
            <i class="fas fa-money-bill"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Jumlah Dana SPP</h4>
            </div>
            <div class="card-body">
            Rp. {{ number_format($jml_dana_pembayaran, 0, '.', '.') }}
            </div>
        </div>
        </div>
    </div>
</div>
@endif
<div class="row">
    <div class="col card p-5">
        <h2 class="text-center">Selamat Datang {{ Auth::guard('petugas')->check() ? Auth::guard('petugas')->user()->nama_petugas : Auth::guard('siswa')->user()->nama }}</h2>
        <p class="mt-4">Selamat datang di aplikasi pembayaran SPP. Di sini anda bisa mengelola data pembayaran spp dengan mudah</p>
    </div>
</div>
@endsection