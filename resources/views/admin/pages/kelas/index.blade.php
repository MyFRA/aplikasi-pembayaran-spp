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
                <a href="{{ url('/app-admin/kelas/create') }}" class="btn btn-primary mb-4">Tambah {{ $title }}</a>

                @if(Session::get('success'))
                    <x-alert-bootstrap status="success" :message="Session::get('success')" />
                @endif
                @if(Session::get('failed'))
                    <x-alert-bootstrap status="failed" :message="Session::get('failed')" />
                @endif

                @if( $classes->isEmpty() )
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
                                    <th>Kelas</th>
                                    <th>Kompetensi Keahlian</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach($classes as $class)
                                <tr>
                                    <td>{{ $loop->iteration + $classes->firstItem() - 1 }}</td>
                                    <td>{{ $class->nama_kelas }}</td>
                                    <td>{{ $class->kompetensiKeahlian->nama_kompetensi_keahlian }}</td>
                                    <td>
                                        <a href="{{ url('/app-admin/kelas/' . encrypt($class->id_kelas) . '/edit') }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger" onclick="deleteRow('Kelas {{ $class->nama_kelas }}', '{{ url('/app-admin/kelas/' . encrypt($class->id_kelas)) }}')"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            <div class="card-footer text-left mb-4">
                {{ $classes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection