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
                <form action="{{ url('app-admin/siswa/' . $siswa->nisn . '/bayar/' . encrypt($spp->id_spp) . '/' . $month) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nisn" class="font-weight-bold">Nama Siswa <span class="text-danger">*</span></label>
                        <input type="text" placeholder="nama siswa" class="form-control" autocomplete="off" readonly="" value="{{ $siswa->nama }}">
                        <input type="hidden" name="nisn" value="{{ encrypt($siswa->nisn) }}">
                    </div>
                    <div class="form-group">
                        <label for="id_spp" class="font-weight-bold">SPP Tahun Ajaran <span class="text-danger">*</span></label>
                        <input type="text" placeholder="tahun ajaran" class="form-control" autocomplete="off" readonly="" value="{{ $spp->tahun_ajaran }}">
                        <input type="hidden" name="id_spp" value="{{ encrypt($spp->id_spp) }}">
                    </div>
                    <div class="form-group">
                        <label for="id_spp" class="font-weight-bold">SPP Bulan <span class="text-danger">*</span></label>
                        <input type="text" placeholder="bulan" class="form-control" autocomplete="off" readonly="" value="{{ $month }}">
                        <input type="hidden" name="bulan_spp" value="{{ $month }}">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_bayar" class="font-weight-bold">Jumlah Bayar</label>
                        <input type="text" name="jumlah_bayar" class="form-control @error('jumlah_bayar') @enderror" placeholder="jumlah bayar" value="{{ old('jumlah_bayar') }}" id="jumlah_bayar" autocomplete="off" required max="{{ $spp->nominal }}">
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-between">    
                        <button class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
                        <a href="{{url('/app-admin/siswa/' . encrypt($siswa->nisn) . '/lihat-spp')}}" class="btn btn-dark">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@section('script')
<script>
    const jumlah_bayar = document.getElementById('jumlah_bayar');
    jumlah_bayar.addEventListener('keydown', function(event) {
        return isNumberKey(event);
    });
    jumlah_bayar.addEventListener('keyup', function() {
        jumlah_bayar.value = convertRupiah(this.value, 'Rp. ');
    });
</script>
@endsection
@endsection