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
                <form action="{{ url('/app-admin/spp') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="tahun_ajaran" class="font-weight-bold">Tahun Ajaran <span class="text-danger">*</span></label>
                        <div class="d-flex align-items-center">
                            <div>
                                <input type="number" class="form-control @error('tahun_pertama') is-invalid @enderror" name="tahun_pertama" id="tahun_pertama" placeholder="tahun pertama" value="{{ old('tahun_pertama') }}" autocomplete="off" min="1000" max="9999">
                                @error('tahun_pertama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mx-3">
                                <h4>/</h4>
                            </div>
                            <div>
                                <input type="number" class="form-control @error('tahun_kedua') is-invalid @enderror" name="tahun_kedua" id="tahun_kedua" placeholder="tahun kedua" value="{{ old('tahun_kedua') }}" autocomplete="off" min="1000" max="9999">
                                @error('tahun_kedua')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nominal" class="font-weight-bold">Nominal SPP <span class="text-danger">*</span></label>
                        <input type="text" name="nominal" class="form-control @error('nominal') is-invalid @enderror" value="{{ old('nominal') }}" placeholder="nominal spp" autocomplete="off" id="nominal">
                    
                        @error('nominal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-between">    
                        <button class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
                        <a href="{{ url('/app-admin/spp') }}" class="btn btn-dark">Kembali</a>
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
<script>
    const nominal = document.getElementById('nominal');
    nominal.addEventListener('keydown', function(event) {
        return isNumberKey(event);
    });
    nominal.addEventListener('keyup', function() {
        nominal.value = convertRupiah(this.value, 'Rp. ');
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

@endsection