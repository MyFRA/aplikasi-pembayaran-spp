@extends('admin.layouts.app')

@section('content')
<x-header-breadcrumb :header="$title"/>
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4>{{ $title }}</h4>
            </div>
            <div class="card-body">
                @if(Session::get('failed')) 
                    <x-alert-bootstrap status="failed" :message="Session::get('failed')" />
                @endif
                <form action="{{ url('/app-admin/kompetensi-keahlian') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nama_kompetensi_keahlian" class="font-weight-bold">Nama Kompetensi Keahian <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kompetensi_keahlian" class="form-control @error('nama_kompetensi_keahlian') is-invalid @enderror" value="{{ old('nama_kompetensi_keahlian') }}" placeholder="nama kompetensi keahlian" autocomplete="off">
                    
                        @error('nama_kompetensi_keahlian')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-between">    
                        <button class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
                        <a href="{{ url('/app-admin/kompetensi-keahlian') }}" class="btn btn-dark">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection