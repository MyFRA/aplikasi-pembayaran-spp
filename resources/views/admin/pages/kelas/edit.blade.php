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
                <form action="{{ url('/app-admin/kelas/' . encrypt($kelas->id_kelas)) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_kelas" class="font-weight-bold">Nama Kelas <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" value="{{ old('nama_kelas') ? old('nama_kelas') : $kelas->nama_kelas }}" placeholder="nama kelas" autocomplete="off">
                    
                        @error('nama_kelas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="id_kompetensi_keahlian" class="font-weight-bold">Kompetensi Keahlian <span class="text-danger">*</span></label>
                        <select class="js-example-basic-single" name="id_kompetensi_keahlian" required="">
                          @foreach( $kompetensi_keahlian as $kompetensi )
                            <option value="{{ encrypt($kompetensi->id_kompetensi_keahlian) }}"
                                @if( old('id_kompetensi_keahlian') )
                                    {{ decrypt(old('id_kompetensi_keahlian')) == $kompetensi->id_kompetensi_keahlian ? 'selected' : '' }}
                                @else
                                    {{ $kelas->id_kompetensi_keahlian == $kompetensi->id_kompetensi_keahlian ? 'selected' : '' }}
                                @endif
                             >{{ $kompetensi->nama_kompetensi_keahlian }}</option>
                          @endforeach
                        </select>
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-between">    
                        <button class="btn btn-primary"><i class="fas fa-save mr-1"></i> Update</button>
                        <a href="{{ url('/app-admin/kelas/') }}" class="btn btn-dark">Kembali</a>
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