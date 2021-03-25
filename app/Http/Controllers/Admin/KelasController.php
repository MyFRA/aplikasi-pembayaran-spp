<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\KompetensiKeahlian;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title'                 => 'Kelas',
            'sidebar'               => 'kelas',
            'classes'               => Kelas::orderBy('nama_kelas', 'ASC')->simplePaginate(10)
        ];

        return view('admin.pages.kelas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $data = [
                'title'                 => 'Tambah Kelas',
                'sidebar'               => 'kelas',
                'kompetensi_keahlian'   => KompetensiKeahlian::orderBy('nama_kompetensi_keahlian')->get(),
            ];

            return view('admin.pages.kelas.create', $data);
        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_kelas'    => 'required|string|max:30',
            ], [
                'nama_kelas.required' => 'nama kelas tidak boleh kosong',
                'nama_kelas.string'   => 'nama kelas harus bersifat text',
                'nama_kelas.max'      => 'nama kelas maksimal 30 karakter',
            ]);

            if( $validator->fails() ) {
                return back()->withErrors($validator)
                            ->withInput();
            }

            if( Kelas::where('nama_kelas', '=', $request->nama_kelas)->exists() ) {
                return back()->withInput()
                            ->with('failed', 'Nama kelas sudah digunakan');
            }

            Kelas::create([
                'id_kompetensi_keahlian'    => decrypt($request->id_kompetensi_keahlian),
                'nama_kelas'                => $request->nama_kelas,
            ]);

            return redirect('/app-admin/kelas/')->with('success', 'Kelas ' . $request->nama_kelas . ' telah ditambahkan');
        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = [
                'title'                 => 'Edit Kelas',
                'sidebar'               => 'kelas',
                'kompetensi_keahlian'   => KompetensiKeahlian::orderBy('nama_kompetensi_keahlian')->get(),
                'kelas'                 => Kelas::find(decrypt($id)),
            ];

            return view('admin.pages.kelas.edit', $data);
        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_kelas'    => 'required|string|max:30',
            ], [
                'nama_kelas.required' => 'nama kelas tidak boleh kosong',
                'nama_kelas.string'   => 'nama kelas harus bersifat text',
                'nama_kelas.max'      => 'nama kelas maksimal 30 karakter',
            ]);

            if( $validator->fails() ) {
                return back()->withErrors($validator)
                            ->withInput();
            }

            $kelas = Kelas::find(decrypt($id));

            if( Kelas::where('nama_kelas', '=', $request->nama_kelas)->exists() && $request->nama_kelas != $kelas->nama_kelas ) {
                return back()->withInput()
                            ->with('failed', 'Nama kelas sudah digunakan');
            }

            $kelas->update([
                'id_kompetensi_keahlian'    => decrypt($request->id_kompetensi_keahlian),
                'nama_kelas'                => $request->nama_kelas,
            ]);

            return redirect('/app-admin/kelas/')->with('success', 'Kelas ' . $request->nama_kelas . ' telah diupdate');
        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            try {
                $kelas = Kelas::find(decrypt($id));

                if(Kelas::destroy($kelas->id_kelas)) {
                    return back()->with('success', 'Kelas ' . $kelas->nama_kelas . ' telah dihapus');
                }
            } catch (\Throwable $th) {
                return back()->with('failed', 'Kelas ' . $kelas->nama_kelas . ' gagal dihapus karena memiliki relasi');
            }
            return back()->with('failed', 'Kelas ' . $kelas->nama_kelas . ' gagal dihapus');
        } catch (DecryptException $e) {
            return back()->with('failed', 'Kelas gagal dihapus');
        }
    }
}
