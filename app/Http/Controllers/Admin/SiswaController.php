<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use App\Models\Pembayaran;
use App\Models\LogPembayaran;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_kelas)
    {
        try {
            $data = [
                'title'                 => 'Siswa',
                'sidebar'               => 'siswa',
                'kelas'                 => Kelas::find(decrypt($id_kelas)),
                'rows_siswa'            => Siswa::where('id_kelas', decrypt($id_kelas))->orderBy('nama', 'ASC')->get(),
            ];
    
            return view('admin.pages.siswa.index', $data);
        } catch (DecryptException $th) {
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_kelas)
    {
        try {
            $data = [
                'title'             => 'Tambah Siswa',
                'sidebar'           => 'kelas',
                'jenis_kelamins'    => ['laki-laki', 'perempuan'],
                'kelas'             => Kelas::find(decrypt($id_kelas)), 
            ];
    
            return view('admin.pages.siswa.create', $data);
        } catch (DecryptException $th) {
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
                'nisn'          => 'required|string|max:10',
                'nis'           => 'required|string|max:8',
                'nama'          => 'required|string|max:50',
                'jenis_kelamin' => 'required|string|in:laki-laki,perempuan',
                'no_telp'       => 'required|string|max:16',
                'photo'         => 'mimes:jpg,jpeg,png,svg,bmp'
            ], [
                'nisn.required'         => 'nisn tidak boleh kosong',
                'nisn.string'           => 'nisn harus bersifat text',
                'nisn.max'              => 'nisn maksimal 10 karakter',
                'nis.required'          => 'nis tidak boleh kosong',
                'nis.string'            => 'nis harus bersifat text',
                'nis.max'               => 'nis maksimal 8 karakter',
                'nama.required'         => 'nama tidak boleh kosong',
                'nama.string'           => 'nama harus bersifat karakter',
                'nama.max'              => 'nama maksimal 50 karakter',
                'no_telp.required'      => 'no telp tidak boleh kosong',
                'no_telp.string'        => 'no telp harus bersifat karakter',
                'no_telp.max'           => 'no telp tidak maksimal 16 karakter',
                'jenis_kelamin.required'=> 'jenis_kelamin tidak boleh kosong',
                'jenis_kelamin.string'  => 'jenis_kelamin harus bersifat karakter',
                'jenis_kelamin.in'      => 'jenis_kelamin tidak valid',
                'photo.mimes'           => 'ekstensi harus diantara jpg, jpeg, png, svg dan bmp'
            ]);
    
            
            if( $validator->fails() ) {
                return back()->withErrors($validator)
                            ->withInput();
            }

            if( strlen($request->nisn) > 10 ) {
                return back()->withInput()
                            ->with('failed', 'nisn maksimal sepuluh karakter');
            }

            if( Siswa::where('nisn', '=', $request->nisn)->exists() ) {
                return back()->withInput()
                            ->with('failed', 'nisn sudah digunakan');
            }
    
            $photo = $request->file('photo') ? '' : null;
    
            if($request->file('photo')) {
                $photo = $this->uploadFile('images/siswa', $request->file('photo'), $request->nama);
            }
            
            Siswa::create([
                'nisn'          => $request->nisn,
                'nis'           => $request->nis,
                'nama'          => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_telp'       => $request->no_telp,
                'alamat'        => $request->alamat,
                'nisn'          => $request->nisn,
                'photo'         => $photo,
                'id_kelas'      => decrypt($request->id_kelas),
            ]);
    
            return redirect('/app-admin/siswa/kelas/' . $request->id_kelas)->with('success', 'Siswa ' . $request->nama . ' telah ditambahkan');
        } catch (DecryptException $th) {
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
        //
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
                'title'             => 'Edit Siswa',
                'sidebar'           => 'kelas',
                'jenis_kelamins'    => ['laki-laki', 'perempuan'],
                'kelass'            => Kelas::orderBy('nama_kelas', 'ASC')->get(),
                'siswa'             => Siswa::find(decrypt($id)), 
            ];
    
            return view('admin.pages.siswa.edit', $data);
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
                'nisn'          => 'required|string|max:10',
                'nis'           => 'required|string|max:8',
                'nama'          => 'required|string|max:50',
                'jenis_kelamin' => 'required|string|in:laki-laki,perempuan',
                'no_telp'       => 'required|string|max:16',
                'photo'         => 'mimes:jpg,jpeg,png,svg,bmp'
            ], [
                'nisn.required'         => 'nisn tidak boleh kosong',
                'nisn.string'           => 'nisn harus bersifat text',
                'nisn.max'              => 'nisn maksimal 10 karakter',
                'nis.required'          => 'nis tidak boleh kosong',
                'nis.string'            => 'nis harus bersifat text',
                'nis.max'               => 'nis maksimal 8 karakter',
                'nama.required'         => 'nama tidak boleh kosong',
                'nama.string'           => 'nama harus bersifat karakter',
                'nama.max'              => 'nama maksimal 50 karakter',
                'no_telp.required'      => 'no telp tidak boleh kosong',
                'no_telp.string'        => 'no telp harus bersifat karakter',
                'no_telp.max'           => 'no telp tidak maksimal 16 karakter',
                'jenis_kelamin.required'=> 'jenis_kelamin tidak boleh kosong',
                'jenis_kelamin.string'  => 'jenis_kelamin harus bersifat karakter',
                'jenis_kelamin.in'      => 'jenis_kelamin tidak valid',
                'photo.mimes'           => 'ekstensi harus diantara jpg, jpeg, png, svg dan bmp'
            ]);
    
            
            if( $validator->fails() ) {
                return back()->withErrors($validator)
                            ->withInput();
            }

            if( strlen($request->nisn) > 10 ) {
                return back()->withInput()
                            ->with('failed', 'nisn maksimal sepuluh karakter');
            }

            $siswa = Siswa::find(decrypt($id));

            if( Siswa::where('nisn', '=', $request->nisn)->exists() && $request->nisn != $siswa->nisn ) {
                return back()->withInput('')
                            ->with('failed', 'nisn sudah digunakan');
            }

            $photo = $request->file('photo') ? '' : $siswa->photo;

            if($request->file('photo')) {
                $this->deleteFile('images/siswa' . $siswa->photo);
                $photo = $this->uploadFile('images/siswa', $request->file('photo'), $request->siswa);
            }
            
            $siswa->update([
                'nisn'          => $request->nisn,
                'nis'           => $request->nis,
                'nama'          => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_telp'       => $request->no_telp,
                'alamat'        => $request->alamat,
                'nisn'          => $request->nisn,
                'photo'         => $photo,
                'id_kelas'      => decrypt($request->id_kelas),
            ]);
    
            return redirect('/app-admin/siswa/kelas/' . encrypt($siswa->id_kelas) )->with('success', 'Siswa ' . $request->nama . ' telah diupdate');
        } catch (DecryptException $th) {
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
                $siswa = Siswa::find(decrypt($id));
            
                if(Siswa::destroy($siswa->nisn)) {
                    return back()->with('success', 'Siswa ' . $siswa->nama . ' telah dihapus');
                }
            } catch (\Throwable $th) {
                return back()->with('failed', 'Siswa ' . $siswa->nama . ' gagal dihapus karena memiliki relasi');
            }
            return back()->with('failed', 'Siswa ' . $siswa->nama . ' gagal dihapus');
        } catch (DecryptException $th) {
            return abort(404);
        }
    }

    public function getMonths()
    {
        return ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    }

    public function lihatSpp($nisn)
    {
        try {
            $siswa          = Siswa::find(decrypt($nisn));
            $months         = $this->getMonths();
            $spps           = Spp::orderBy('tahun_ajaran', 'DESC')->get();
            
            $all_spp_payments = [];

            foreach ($spps as $key => $spp) {
               $all_spp_payments[$key]['spp'] = $spp;

               foreach ($months as $month) {
                    $pembayaran = Pembayaran::where('bulan_spp', '=', $month)->where('nisn', '=', $siswa->nisn)->where('id_spp', '=', $spp->id_spp);
                    $spp        = Spp::find($spp->id_spp);

                   $all_spp_payments[$key]['months'][] = [
                        'id_pembayaran'         => $pembayaran->exists() ? $pembayaran->get()[0]->id_pembayaran : '',
                        'bulan'                 => $month,
                        'status'                => $pembayaran->exists() ? $pembayaran->get()[0]->status : 'Belum Bayar',
                        'kekurangan'            => $pembayaran->exists() ? $spp->nominal - $pembayaran->get()[0]->total_bayar : 0,
                        'link_add_pembayaran'   => $pembayaran->exists() ? url('/app-admin/siswa/' . encrypt($siswa->nisn) . '/bayar/' . encrypt($spp->id_spp) . '/' . $month . '/' .$pembayaran->get()[0]->id_pembayaran) : url('/app-admin/siswa/' . encrypt($siswa->nisn) . '/bayar/' . encrypt($spp->id_spp) . '/' . $month . '/create'),
                        'total_bayar'           => $pembayaran->exists() ? $pembayaran->get()[0]->total_bayar : 0,
                    ];
               }
            }

            $data = [
                'title'                 => 'Lihat SPP',
                'sidebar'               => 'siswa',
                'siswa'                 => $siswa,
                'spps'                  => Spp::orderBy('tahun_ajaran', 'DESC')->get(),
                'all_spp_payments'      => $all_spp_payments,
            ];  
    
            return view('admin.pages.siswa.lihat-spp', $data);
        } catch (DecryptException $th) {
            return abort(404);
        }
    }

    public function createPembayaranSpp($nisn, $id_spp, $month)
    {
        try {
            $data = [
                'title'             => 'Create SPP Siswa',
                'sidebar'           => 'siswa',
                'siswa'             => Siswa::find(decrypt($nisn)),
                'spp'               => Spp::find(decrypt($id_spp)),
                'month'             => $month,
            ];
    
            return view('admin.pages.siswa.create-spp', $data);
        } catch (DecryptException $th) {
            return abort(404);
        }
    }

    public function storePembayaranSpp(Request $request, $nisn, $id_spp, $month)
    {
        try {
            $validator = Validator::make($request->all(), [
                'jumlah_bayar'      => 'required',
            ], [
                'jumlah_bayar.required'     => 'jumlah bayar tidak boleh kosong',
            ]);
    
            if( $validator->fails() ) {
                return back()->withErrors($validator)
                            ->withInput();
            }
            
            if( !in_array($month, $this->getMonths()) ) {
                return back()->withInput()
                            ->with('failed', 'Bulan Spp tidak valid');
            }
    
            $spp            = Spp::find(decrypt($id_spp));
            $jumlah_bayar   = $this->parsingRupiahToInteger($request->jumlah_bayar);

            if( $jumlah_bayar > $spp->nominal ) {
                return back()->withInput()
                            ->with('failed', 'Jumlah bayar tidak boleh melebihi biaya SPP');
            }
            
            $id_pembayaran = (string) rand();
            while ($id_pembayaran[0] == 0) {
                $id_pembayaran = rand();
            }

            Pembayaran::create([
                'id_pembayaran' => $id_pembayaran,
                'nisn'          => $nisn,
                'id_spp'        => $spp->id_spp,
                'bulan_spp'     => $month,
                'total_bayar'   => $jumlah_bayar >= $spp->nominal ? $spp->nominal : $jumlah_bayar, 
                'status'        => $jumlah_bayar >= $spp->nominal ? 'Lunas' : 'Belum Lunas', 
            ]);

            $id_log_pembayaran = (string) rand();
            while ( $id_log_pembayaran[0] == 0) {
                $id_log_pembayaran = rand();
            }

            LogPembayaran::create([
                'id_log_pembayaran' => $id_log_pembayaran,
                'id_pembayaran'     => $id_pembayaran,
                'id_petugas'        => Auth::guard('petugas')->user()->id_petugas,
                'tgl_bayar'         => date('Y-m-d'),
                'jumlah_bayar'      => $jumlah_bayar,
            ]);

            return redirect('/app-admin/siswa/'. encrypt($nisn) . '/lihat-spp')->with('success', 'Pembayaran telah ditambakan');
        } catch (DecryptException $th) {
            return abort(404);
        }
    }

    public function editPembayaranSpp($nisn, $id_spp, $month, $id_pembayaran)
    {
        try {
            $data = [
                'title'             => 'Buat Pembayaran SPP Siswa',
                'sidebar'           => 'siswa',
                'siswa'             => Siswa::find(decrypt($nisn)),
                'spp'               => Spp::find(decrypt($id_spp)),
                'pembayaran'        => Pembayaran::find($id_pembayaran),
                'month'             => $month,
            ];
    
            return view('admin.pages.siswa.edit-spp', $data);
        } catch (DecryptException $th) {
            return abort(404);
        }
    }

    public function UpdatePembayaranSpp(Request $request, $nisn, $id_spp, $month, $id_pembayaran)
    {
        try {
            $validator = Validator::make($request->all(), [
                'jumlah_bayar'      => 'required',
            ], [
                'jumlah_bayar.required'     => 'jumlah bayar tidak boleh kosong',
            ]);
    
            if( $validator->fails() ) {
                return back()->withErrors($validator)
                            ->withInput();
            }
            
            if( !in_array($month, $this->getMonths()) ) {
                return back()->withInput()
                            ->with('failed', 'Bulan Spp tidak valid');
            }

            $spp            = Spp::find(decrypt($id_spp));

            $pembayaran     = Pembayaran::find($id_pembayaran);
            $jumlah_bayar   = $this->parsingRupiahToInteger($request->jumlah_bayar);

            if( $jumlah_bayar > $spp->nominal - $pembayaran->total_bayar ) {
                return back()->withInput()
                            ->with('failed', 'Jumlah bayar tidak boleh melebihi biaya SPP');
            }

            $pembayaran->update([
                'total_bayar'   => $jumlah_bayar + $pembayaran->total_bayar >= $spp->nominal ? $spp->nominal : $jumlah_bayar + $pembayaran->total_bayar, 
                'status'        => $jumlah_bayar + $pembayaran->total_bayar >= $spp->nominal ? 'Lunas' : 'Belum Lunas', 
            ]);

            $id_log_pembayaran = (string) rand();

            while ( $id_log_pembayaran[0] == 0) {
                $id_log_pembayaran = rand();
            }
            
            LogPembayaran::create([
                'id_log_pembayaran' => $id_log_pembayaran,
                'id_pembayaran'     => $id_pembayaran,
                'id_petugas'        => Auth::guard('petugas')->user()->id_petugas,
                'tgl_bayar'         => date('Y-m-d'),
                'jumlah_bayar'      => $jumlah_bayar,
            ]);

            return redirect('/app-admin/siswa/'. encrypt($nisn) . '/lihat-spp')->with('success', 'Pembayaran telah ditambakan');
        } catch (DecryptException $th) {
            return abort(404);
        }
    }
}
