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
                @if( Auth::guard('petugas')->user()->level == 'admin' )
                <a href="{{ url('/app-admin/petugas/create') }}" class="btn btn-primary mb-4">Tambah {{ $title }}</a>
                @endif
                @if(Session::get('success'))
                    <x-alert-bootstrap status="success" :message="Session::get('success')" />
                @endif
                @if(Session::get('failed'))
                    <x-alert-bootstrap status="failed" :message="Session::get('failed')" />
                @endif

                @if( $rows_petugas->isEmpty() )
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
                                    <th>Photo</th>
                                    <th>Nama Petugas</th>
                                    <th>Level</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach($rows_petugas as $petugas)
                                <tr>
                                    <td>{{ $loop->iteration + $rows_petugas->firstItem() - 1 }}</td>
                                    <td><img src="{{ $petugas->photo != null ? asset('/storage/images/petugas/' . $petugas->photo) : asset('/images/icons/no-photo-rounded.png') }}" alt="" style="width: 75px; object-fit: cover; object-position: center" class="rounded"></td>
                                    <td>{{ $petugas->nama_petugas }}</td>
                                    <td>{{ $petugas->level }}</td>
                                    <td>
                                        @if( Auth::guard('petugas')->user()->id_petugas == $petugas->id_petugas )
                                            <a href="{{ url('/app-admin/petugas/' . encrypt($petugas->id_petugas) . '/edit') }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                        @elseif( Auth::guard('petugas')->user()->level == 'admin' && $petugas->level == 'admin' )
                                            <a href="" class="btn btn-sm btn-dark">Akses Tidak Diijinkan</a>
                                        @elseif( Auth::guard('petugas')->user()->level == 'admin' && $petugas->level == 'petugas' )
                                            <a href="{{ url('/app-admin/petugas/' . encrypt($petugas->id_petugas) . '/edit') }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger" onclick="deleteRow('Petugas {{ $petugas->nama_petugas }}', '{{ url('/app-admin/petugas/' . encrypt($petugas->id_petugas)) }}')"><i class="fas fa-trash"></i> Hapus</a>
                                        @else
                                            <a href="" class="btn btn-sm btn-dark">Akses Tidak Diijinkan</a>
                                        @endif

                                        @if( Auth::guard('petugas')->user()->id_petugas == $petugas->id_petugas )
                                            <a href="{{ url('/app-admin/petugas/tanda-tangan') }}" class="btn btn-sm btn-light">Tanda Tangan</a>
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
                {{ $rows_petugas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection