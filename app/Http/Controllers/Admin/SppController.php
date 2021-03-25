<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encrytion\DecryptException;
use Illuminate\Http\Request;

use App\Models\Spp;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title'                 => 'Spp',
            'sidebar'               => 'spp',
            'rows_spp'              => Spp::orderBy('tahun_ajaran', 'DESC')->simplePaginate(10)
        ];

        return view('admin.pages.spp.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title'         => 'Tambah Spp',
            'sidebar'       => 'spp',
        ];

        return view('admin.pages.spp.create', $data);
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
                'nominal'           => 'required',
                'tahun_pertama'     => 'required|numeric|min:1000,max:9999|lt:' . $request->tahun_kedua,
                'tahun_kedua'       => 'required|numeric|min:1000,max:9999|gt:' . $request->tahun_pertama,
            ], [
                'nominal.required'          => 'nominal tidak boleh kosong',
                'tahun_pertama.numeric'     => 'tahun pertama harus bersifat angka',
                'tahun_pertama.min'         => 'tahun pertama minimal 1000',
                'tahun_pertama.max'         => 'tahun pertama maksimal 9999',
                'tahun_pertama.lt'          => 'tahun pertama harus kurang dari tahun kedua',
                'tahun_pertama.required'    => 'tahun pertama tidak boleh kosong',
                'tahun_kedua.required'      => 'tahun kedua tidak boleh kosong',
                'tahun_kedua.numeric'       => 'tahun kedua harus bersifat angka',
                'tahun_kedua.min'           => 'tahun kedua minimal 1000',
                'tahun_kedua.max'           => 'tahun kedua maksimal 9999',
                'tahun_kedua.lt'            => 'tahun kedua harus lebih dari tahun pertama',
            ]);

            if( $validator->fails() ) {
                return back()->withErrors($validator)
                            ->withInput();
            }

            $tahun_ajaran = $request->tahun_pertama . '/' . $request->tahun_kedua;
    
            if( Spp::where('tahun_ajaran', '=', $tahun_ajaran)->exists() ) {
                return back()->withInput()
                            ->with('failed', 'Spp untuk tahun ajaran ' . $tahun_ajaran . ' sudah ditambahkan');
            }

            Spp::create([
                'tahun_ajaran'      => $tahun_ajaran,
                'nominal'           => $this->parsingRupiahToInteger($request->nominal),
            ]);
    
            return redirect('/app-admin/spp')->with('success', 'Spp tahun ajaran ' . $tahun_ajaran . ' telah ditambahkan');
        } catch (\DecryptException $th) {
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
            $spp = Spp::find(decrypt($id));
            $data = [
                'title'         => 'Edit Spp',
                'sidebar'       => 'spp',
                'spp'           => $spp,
                'tahun_pertama' => explode('/', $spp->tahun_ajaran)[0],
                'tahun_kedua'   => explode('/', $spp->tahun_ajaran)[1],
            ];
    
            return view('admin.pages.spp.edit', $data);
        } catch (DecryptException $th) {
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
                'nominal'           => 'required',
                'tahun_pertama'     => 'required|numeric|min:1000,max:9999|lt:' . $request->tahun_kedua,
                'tahun_kedua'       => 'required|numeric|min:1000,max:9999|gt:' . $request->tahun_pertama,
            ], [
                'nominal.required'          => 'nominal tidak boleh kosong',
                'tahun_pertama.numeric'     => 'tahun pertama harus bersifat angka',
                'tahun_pertama.min'         => 'tahun pertama minimal 1000',
                'tahun_pertama.max'         => 'tahun pertama maksimal 9999',
                'tahun_pertama.lt'          => 'tahun pertama harus kurang dari tahun kedua',
                'tahun_pertama.required'    => 'tahun pertama tidak boleh kosong',
                'tahun_kedua.required'      => 'tahun kedua tidak boleh kosong',
                'tahun_kedua.numeric'       => 'tahun kedua harus bersifat angka',
                'tahun_kedua.min'           => 'tahun kedua minimal 1000',
                'tahun_kedua.max'           => 'tahun kedua maksimal 9999',
                'tahun_kedua.lt'            => 'tahun kedua harus lebih dari tahun pertama',
            ]);
    
            if( $validator->fails() ) {
                return back()->withErrors($validator)
                            ->withInput();
            }

            $tahun_ajaran = $request->tahun_pertama . '/' . $request->tahun_kedua;
            $spp = Spp::find(decrypt($id));
    
            if( Spp::where('tahun_ajaran', '=', $tahun_ajaran)->exists() && $tahun_ajaran != $spp->tahun_ajaran ) {
                return back()->withInput()
                            ->with('failed', 'Spp untuk tahun ajaran ' . $tahun_ajaran . ' sudah ditambahkan');
            }

            $spp->update([
                'tahun_ajaran'      => $tahun_ajaran,
                'nominal'           =>  $this->parsingRupiahToInteger($request->nominal),
            ]);
    
            return redirect('/app-admin/spp')->with('success', 'Spp tahun ajaran ' . $tahun_ajaran . ' telah diupdate');
        } catch (\DecryptException $th) {
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
                $spp = Spp::find(decrypt($id));

                if(Spp::destroy($spp->id_spp)) {
                    return back()->with('success', 'Spp tahun ajaran ' . $spp->tahun_ajaran . ' telah dihapus');
                }
            } catch (\Throwable $th) {
                return back()->with('failed', 'Spp tahun ajaran ' . $spp->tahun_ajaran . ' gagal dihapus karena memiliki relasi');
            }
            return back()->with('failed', 'Spp tahun ajaran ' . $spp->tahun_ajaran . ' gagal dihapus');
        } catch (DecryptException $e) {
            return back()->with('failed', 'Spp tahun ajaran ' . $spp->tahun_ajaran . ' gagal dihapus');
        }
    }
}
