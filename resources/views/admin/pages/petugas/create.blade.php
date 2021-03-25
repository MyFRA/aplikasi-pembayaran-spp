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
                <form action="{{ url('/app-admin/petugas') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_petugas" class="font-weight-bold">Nama Petugas <span class="text-danger">*</span></label>
                        <input type="text" name="nama_petugas" class="form-control @error('nama_petugas') is-invalid @enderror" value="{{ old('nama_petugas') }}" placeholder="nama petugas" autocomplete="off" id="nama_petugas">
                    
                        @error('nama_petugas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="level" class="font-weight-bold">Level <span class="text-danger">*</span></label>
                        <select class="js-example-basic-single" name="level" required="">
                          @foreach( $levels as $level )
                            <option value="{{ $level }}"
                                @if( old('level') )
                                    {{ old('level') == $level ? 'selected' : '' }}
                                @endif
                             >{{ $level }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="username" class="font-weight-bold">Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="username" autocomplete="off" id="username">
                    
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="font-weight-bold">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="password" autocomplete="off" id="password">
                    
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="font-weight-bold">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" placeholder="password_confirmation" autocomplete="off" id="password_confirmation">
                    
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" class="form-control" name="photo">
                        @error('photo')
                            <span class="text-danger mt-2 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-between">    
                        <button class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
                        <a href="{{ url('/app-admin/petugas') }}" class="btn btn-dark">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('stylesheet')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

@endsection