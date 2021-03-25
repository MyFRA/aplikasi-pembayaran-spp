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
                <a href="{{ url('/app-admin/kompetensi-keahlian/create') }}" class="btn btn-primary mb-4">Tambah {{ $title }}</a>
 
                @if(Session::get('success'))
                    <x-alert-bootstrap status="success" :message="Session::get('success')" />
                @endif
                @if(Session::get('failed'))
                    <x-alert-bootstrap status="failed" :message="Session::get('failed')" />
                @endif

                @if( $kompetensi_keahlian->isEmpty() )
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
                                    <th>Nama Kompetensi Keahlian</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach($kompetensi_keahlian as $kompetensi)
                                <tr>
                                    <td>{{ $loop->iteration + $kompetensi_keahlian->firstItem() - 1 }}</td>
                                    <td>{{ $kompetensi->nama_kompetensi_keahlian }}</td>
                                    <td>
                                        <a href="{{ url('/app-admin/kompetensi-keahlian/' . encrypt($kompetensi->id_kompetensi_keahlian) . '/edit') }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger" onclick="deleteRow('Kompetensi Keahlian {{ $kompetensi->nama_kompetensi_keahlian }}', '{{ url('/app-admin/kompetensi-keahlian/' . encrypt($kompetensi->id_kompetensi_keahlian)) }}')"><i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                
            </div>
            <div class="card-footer text-left mb-4">
                {{ $kompetensi_keahlian->links() }}
            </div>
        </div>
    </div>
</div>
@endsection