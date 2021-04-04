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
                <h3 class="mb-4">Kelas {{ $kelas->nama_kelas }}</h3>

                @if( Auth::guard('petugas')->user()->level == 'admin' )
                    <a href="{{ url('/app-admin/siswa/' . encrypt($kelas->id_kelas) . '/create') }}" class="btn btn-primary mb-4">Tambah {{ $title }}</a> 
                @endif
                @if(Session::get('success'))
                    <x-alert-bootstrap status="success" :message="Session::get('success')" />
                @endif
                @if(Session::get('failed'))
                    <x-alert-bootstrap status="failed" :message="Session::get('failed')" />
                @endif

                @if( $rows_siswa->isEmpty() )
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
                            <tbody id="table-body">
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Nama siswa</th>
                                    <th>NISN</th>
                                    <th>NIS</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No HP</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach($rows_siswa as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ $siswa->photo != null ? asset('/storage/images/siswa/' . $siswa->photo) : asset('/images/icons/no-photo-rounded.png') }}" alt="" style="width: 75px; object-fit: cover; object-position: center" class="rounded"></td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>{{ $siswa->nisn }}</td>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->jenis_kelamin }}</td>
                                    <td>{{ $siswa->no_hp }}</td>
                                    <td>{{ $siswa->alamat }}</td>
                                    <td>
                                        <a href="{{ url('/app-admin/siswa/' . encrypt($siswa->nisn) . '/lihat-spp') }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i> Lihat SPP</a>
                                        @if( Auth::guard('petugas')->user()->level == 'admin' )
                                            <a href="{{ url('/app-admin/siswa/' . encrypt($siswa->nisn) . '/edit') }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger" onclick="deleteRow('Siswa {{ $siswa->nama }}', '{{ url('/app-admin/siswa/' . encrypt($siswa->nisn)) }}')"><i class="fas fa-trash"></i> Hapus</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                
            </div>
            <div class="card-footer text-left mb-4">
            </div>
        </div>
    </div>
</div>
@endsection