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
                <form action="{{ url('/app-admin/siswa/' . encrypt($siswa->nisn)) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama" class="font-weight-bold">Nama Siswa <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') ? old('nama') : $siswa->nama }}" placeholder="nama siswa" autocomplete="off" id="nama">
                    
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nisn" class="font-weight-bold">NISN <span class="text-danger">*</span></label>
                        <input type="number" name="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn') ? old('nisn') : $siswa->nisn }}" placeholder="nisn" autocomplete="off" id="nisn">
                    
                        @error('nisn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nis" class="font-weight-bold">NIS <span class="text-danger">*</span></label>
                        <input type="number" name="nis" class="form-control @error('nis') is-invalid @enderror" value="{{ old('nis') ? old('nis') : $siswa->nis }}" placeholder="nis" autocomplete="off" id="nis">
                    
                        @error('nis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin" class="font-weight-bold">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select class="js-example-basic-single" name="jenis_kelamin" required="">
                          @foreach( $jenis_kelamins as $jenis_kelamin )
                            <option value="{{ $jenis_kelamin }}"
                                @if( old('jenis_kelamin') )
                                    {{ old('jenis_kelamin') == $jenis_kelamin ? 'selected' : '' }}
                                @else
                                    {{ $jenis_kelamin == $siswa->jenis_kelamin ? 'selected' : '' }}
                                @endif
                             >{{ $jenis_kelamin }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="no_telp" class="font-weight-bold">No Telp <span class="text-danger">*</span></label>
                        <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp') ? old('no_telp') : $siswa->no_telp }}" placeholder="no telp" autocomplete="off" id="no_telp">
                    
                        @error('no_telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="font-weight-bold">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" style="height: 100px" placeholder="alamat">{{ old('alamat') ? old('alamat') : $siswa->alamat }}</textarea>

                        @error('alamat')
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
                    <div class="form-group">
                        <label for="id_kelas" class="font-weight-bold">Kelas <span class="text-danger">*</span></label>
                        <select class="js-example-basic-single" name="id_kelas" required="">
                          @foreach( $kelass as $kelas )
                            <option value="{{ encrypt($kelas->id_kelas) }}"
                                @if( old(encrypt('id_kelas')) )
                                    {{ old(encrypt('id_kelas')) == $kelas->id_kelas ? 'selected' : '' }}
                                @else
                                    {{ $kelas->id_kelas == $siswa->id_kelas ? 'selected' : '' }}
                                @endif
                             >{{ $kelas->nama_kelas }}</option>
                          @endforeach
                        </select>
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-between">    
                        <button class="btn btn-primary"><i class="fas fa-save mr-1"></i> Update</button>
                        <a href="{{ url('/app-admin/siswa/kelas/' . encrypt($kelas->id_kelas)) }}" class="btn btn-dark">Kembali</a>
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