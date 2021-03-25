<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Validator;
use App\Models\KompetensiKeahlian;

class KompetensiKeahlianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title'                 => 'Kompetensi Keahlian',
            'sidebar'               => 'kompetensi-keahlian',
            'kompetensi_keahlian'   => KompetensiKeahlian::orderBy('nama_kompetensi_keahlian', 'ASC')->simplePaginate(10)
        ];

        return view('admin.pages.kompetensi-keahlian.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title'     => 'Tambah Kompetensi Keahlian',
            'sidebar'   => 'kompetensi-keahlian'
        ];

        return view('admin.pages.kompetensi-keahlian.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kompetensi_keahlian'    => 'required|string|max:100',
        ], [
            'nama_kompetensi_keahlian.required' => 'nama kompetensi keahlian tidak boleh kosong',
            'nama_kompetensi_keahlian.string'   => 'nama kompetensi keahlian harus bersifat text',
            'nama_kompetensi_keahlian.max'      => 'nama kompetensi keahlian maksimal 100 karakter',
        ]);

        if( $validator->fails() ) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        if( KompetensiKeahlian::where('nama_kompetensi_keahlian', '=', $request->nama_kompetensi_keahlian)->exists() ) {
            return back()->withInput()
                        ->with('failed', 'Nama Kompetensi Keahlian sudah ditambahkan');
        }

        KompetensiKeahlian::create([
            'nama_kompetensi_keahlian'  => $request->nama_kompetensi_keahlian,
        ]);

        return redirect('/app-admin/kompetensi-keahlian')->with('success', 'Kompetensi Keahlian ' . $request->nama_kompetensi_keahlian . ' telah ditambahkan');
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
                'title'                 => 'Edit Kompetensi Keahlian',
                'sidebar'               => 'kompetensi-keahlian',
                'kompetensi_keahlian'   => KompetensiKeahlian::find(decrypt($id)),

            ];

            return view('admin.pages.kompetensi-keahlian.edit', $data);
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
                'nama_kompetensi_keahlian'    => 'required|string|max:100',
            ], [
                'nama_kompetensi_keahlian.required' => 'nama kompetensi keahlian tidak boleh kosong',
                'nama_kompetensi_keahlian.string'   => 'nama kompetensi keahlian harus bersifat text',
                'nama_kompetensi_keahlian.max'      => 'nama kompetensi keahlian maksimal 100 karakter',
            ]);

            if( $validator->fails() ) {
                return back()->withErrors($validator)
                            ->withInput();
            }

            $kompetensi_keahlian = KompetensiKeahlian::find(decrypt($id));

            if( KompetensiKeahlian::where('nama_kompetensi_keahlian', '=', $request->nama_kompetensi_keahlian)->exists() && $kompetensi_keahlian->nama_kompetensi_keahlian != $request->nama_kompetensi_keahlian ) {
                return back()->withInput()
                            ->with('failed', 'Nama Kompetensi Keahlian sudah digunakan');
            }

            $kompetensi_keahlian->update([
                'nama_kompetensi_keahlian'  => $request->nama_kompetensi_keahlian,
            ]);

            return redirect('/app-admin/kompetensi-keahlian')->with('success', 'Kompetensi Keahlian ' . $request->nama_kompetensi_keahlian . ' telah diupdate');
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
                $kompetensiKeahlian = KompetensiKeahlian::find(decrypt($id));

                if(KompetensiKeahlian::destroy($kompetensiKeahlian->id_kompetensi_keahlian)) {
                    return back()->with('success', 'Kompetensi Keahlian ' . $kompetensiKeahlian->nama_kompetensi_keahlian . ' telah dihapus');
                }
            } catch (\Throwable $th) {
                return back()->with('failed', 'Kompetensi Keahlian ' . $kompetensiKeahlian->nama_kompetensi_keahlian . ' gagal dihapus karena memiliki relasi');
            }
            return back()->with('failed', 'Kompetensi Keahlian ' . $kompetensiKeahlian->nama_kompetensi_keahlian . ' gagal dihapus');
        } catch (DecryptException $e) {
            return back()->with('failed', 'Kompetensi Keahlian gagal dihapus');
        }
    }
}
