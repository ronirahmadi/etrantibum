<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Aktivitas;
use App\Grup;
use App\Http\Controllers\Controller;
use App\Laporan;
use App\User;
use App\Verifikator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    $this->middleware('auth:admin');
    }

    /**
     * Menampilkan halaman data daftar pegawai untuk admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function daftarpegawai()
    {    
        $pegawai = User::leftJoin('grups', 'grups.id_grup', '=', 'users.grup_id')
        ->orderBy('users.nama_user', 'asc')
        ->get();

        return view('cms-admin.data.daftarpegawai', compact('pegawai'));
    }

    /**
     * Menampilkan halaman data detail pegawai untuk admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function datadetailpegawai($nip)
    {    
        $usergrup = Auth::user()->grup_id;

        #datagrup
        $grup = Grup::pluck("nama_grup","id_grup");

        #profil pegawai
        $profil = DB::table('users')->where('users.nip', '=', $nip)
        ->leftJoin('grups', 'grups.id_grup', '=', 'users.grup_id')
        ->get();

        #foto profil pegawai
        $fotoprofil = User::where('nip', $nip)->pluck('fp_user')->first();

        #total data
        $totaldisetujui = Laporan::leftjoin('grups', 'laporans.grup_id', '=', 'grups.id_grup')
        ->where('grups.id_grup','=', $usergrup)
        ->where('laporans.status_laporan', '=', 'Disetujui')->count();
        $totalditolak = Laporan::leftjoin('grups', 'laporans.grup_id', '=', 'grups.id_grup')
        ->where('grups.id_grup','=', $usergrup)
        ->where('laporans.status_laporan', '=', 'Ditolak')->count();
        $totaldiproses = Laporan::leftjoin('grups', 'laporans.grup_id', '=', 'grups.id_grup')
        ->where('grups.id_grup','=', $usergrup)
        ->where('laporans.status_laporan', '=', 'Belum Diverifikasi')->count();
        

        return view('cms-admin.data.detail.pegawai', compact('grup','fotoprofil','profil','totaldisetujui', 'totalditolak', 'totaldiproses'));
    }


    /**
     * Menampilkan form tambah pegawai oleh admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function formtambahpegawai()
    {    
        $grup = Grup::pluck("nama_grup","id_grup");

        return view('cms-admin.form.tambahpegawai', compact('grup'));
    }


    /**
     * Proses pengiriman data menambahkan pegawai.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function kirimdatapegawai(Request $request)
    {    
        $request->validate([            
            'NIP' => 'required',
            'Grup' => 'required',
            'Nama' => 'required',
            'Password' => 'required|string|min:8'
        ]);

        $nip = $request->input('NIP');

        $Nipmodels = [User::class, Verifikator::class, Admin::class];

        foreach ($Nipmodels as $datanip) {
            $PeriksaNIP = $datanip::where('nip', $nip)->first();

            if ($PeriksaNIP !== null) {
                // NIP sudah digunakan di salah satu tabel
                Alert::error('Gagal Mengirim', 'NIP sudah digunakan.');
                return back();
            }
        }

        // Jika loop selesai dan belum return, artinya NIP belum digunakan di semua tabel
        $pegawai = new User();
        $pegawai->nip = $nip;
        $pegawai->grup_id = $request->input('Grup');
        $pegawai->nama_user = $request->input('Nama');
        $pegawai->password = Hash::make($request->password);

        if ($pegawai->save()) {
            Alert::success('Pegawai Ditambahkan', 'Anda berhasil menambahkan pegawai baru.');
            return back();
        } else {
            Alert::error('Gagal Mengirim', 'Gagal menyimpan data pegawai.');
            return back();
        }
    }

    /**
     * Proses perbarui Nama pegawai oleh admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function perbaruidatapegawai(Request $request, $nip)
    {
        $request->validate([
            'Nama' => 'required',
            'Grup' => 'required'
        ]);

        User::where('nip', $nip)->update([
            'nama_user' => $request->get('Nama'),            
            'grup_id' => $request->get('Grup')
        ]);

        if (1) {
            Alert::success('Data Diperbarui', 'Data pegawai berhasil diperbarui.');

            return back();
        } else {
            Alert::toast('Gagal, Periksa Kembali data yang Anda kirim','error');

            return back();
        }
    }

    /**
     * Proses memperbarui password pegawai.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function perbaruipasswordpegawai(Request $request, $nip)
    {    
        $request->validate([
            'password' => ['required', 'string', 'min:8']
        ]);
    
        $pegawaiData = $request->only(["password"]);
        $pegawaiData['password'] = Hash::make($pegawaiData['password']);
        User::where('nip', $nip)->update($pegawaiData);
    
        if (1) {
            Alert::success('Password Diperbarui', 'Password pegawai berhasil diperbarui.');
            
            return back();
        } else {
            Alert::error('Gagal Mengirim', 'Periksa kembali data yang dikirim');
    
            return back();
        }
    }

    /**
     * Menghapus pegawai
     *
     * @param  int  $nip
     * @return \Illuminate\Http\Response
     */
    public function hapuspegawai($nip)
    {
        $cekdatausers = User::where('fp_user', NULL)->get();

        if ($cekdatausers) {
            $delete = User::where('nip',$nip);
            $delete->delete();
        } else {
            $delete = User::where('nip',$nip);
            unlink('uploads/fotoprofil/pegawai/'.$delete->fp_user);
            $delete->delete();
        }

        if ($delete = 1) {
            Alert::success('Pegawai Dihapus', 'Data Pegawai telah dihapus.');
            return back();
        } else {
            Alert::error('Gagal menghapus data', 'Periksa kembali data yang anda hapus');
            return back();
        }
    }

    /**
     * Menampilkan halaman data daftar kepalasubbidang untuk admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function daftarkepalasubbidang()
    {    
        $kepalasubbidang = KepalaSubBidang::leftJoin('indonesia_provinces', 'indonesia_provinces.id', '=', 'kepala_sub_bidangs.provinsi_ksb')
        ->leftJoin('indonesia_cities', 'indonesia_cities.id', '=', 'kepala_sub_bidangs.kota_ksb')
        ->leftJoin('indonesia_districts', 'indonesia_districts.id', '=', 'kepala_sub_bidangs.kecamatan_ksb')
        ->leftJoin('indonesia_villages', 'indonesia_villages.id', '=', 'kepala_sub_bidangs.kelurahan_ksb')
        ->leftJoin('agamas', 'agamas.id', '=', 'kepala_sub_bidangs.agama_ksb')
        ->leftJoin('status_pernikahans', 'status_pernikahans.id', '=', 'kepala_sub_bidangs.status_pernikahan_ksb')
        ->leftJoin('units', 'units.id', '=', 'kepala_sub_bidangs.unit_id_ksb')
        ->leftJoin('sub_units', 'sub_units.id', '=', 'kepala_sub_bidangs.subunit_id_ksb')
        ->orderBy('kepala_sub_bidangs.nama_ksb', 'asc')
        ->get();

        return view('cms-admin.data.daftarkepalasubbidang', compact('kepalasubbidang'));
    }

    /**
     * Menampilkan halaman data detail kepalasubbidang untuk admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function datadetailkepalasubbidang($nip)
    {    
        #profil karyawan
        $profil = DB::table('kepala_sub_bidangs')->where('kepala_sub_bidangs.nip', '=', $nip)
        ->leftJoin('indonesia_provinces', 'indonesia_provinces.id', '=', 'kepala_sub_bidangs.provinsi_ksb')
        ->leftJoin('indonesia_cities', 'indonesia_cities.id', '=', 'kepala_sub_bidangs.kota_ksb')
        ->leftJoin('indonesia_districts', 'indonesia_districts.id', '=', 'kepala_sub_bidangs.kecamatan_ksb')
        ->leftJoin('indonesia_villages', 'indonesia_villages.id', '=', 'kepala_sub_bidangs.kelurahan_ksb')
        ->leftJoin('agamas', 'agamas.id', '=', 'kepala_sub_bidangs.agama_ksb')
        ->leftJoin('status_pernikahans', 'status_pernikahans.id', '=', 'kepala_sub_bidangs.status_pernikahan_ksb')
        ->get();

        $mainprofil = DB::table('kepala_sub_bidangs')->where('kepala_sub_bidangs.nip', '=', $nip)
        ->leftJoin('units', 'units.id', '=', 'kepala_sub_bidangs.unit_id_ksb')
        ->leftJoin('sub_units', 'sub_units.id', '=', 'kepala_sub_bidangs.subunit_id_ksb')
        ->get();

        #foto profil karyawan
        $fotoprofil = KepalaSubBidang::where('nip', $nip)->pluck('fp_ksb')->first();

        return view('cms-admin.data.detail.kepalasubbidang', compact('fotoprofil','mainprofil','profil'));
    }

    /**
     * Menampilkan form tambah kepalasubbidang oleh admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function formtambahkepalasubbidang()
    {    
        $unit = Unit::pluck("nama_unit","id");

        return view('cms-admin.form.tambahkepalasubbidang', compact('unit'));
    }

    public function getsub2($id)
    {
        $subunit = SubUnit::where("unit_id",$id)
                    ->pluck('nama_sub','id');
        return json_encode($subunit);
    }

    /**
     * Proses pengiriman data menambahkan kepalasubbidang.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function kirimdataksb(Request $request)
    {    
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'unit' => 'required',
            'subunit' => 'required',
            'password' => 'required|string|min:8'
        ]);

        $karyawan = new KepalaSubBidang();
        
        $karyawan->nama_ksb = $request->input('nama');
        $karyawan->nip = $request->input('nip');
        $karyawan->unit_id_ksb = $request->input('unit');
        $karyawan->subunit_id_ksb = $request->input('subunit');
        $karyawan->password = Hash::make($request->password);
                
        $ceknip = KepalaSubBidang::where('nip', '=', $request->input('nip'))->first();

        if ($ceknip === null) {
            Alert::success('Kepala Sub Bidang Ditambahkan', 'Anda berhasil menambahkan Kepala Sub Bidang baru.');
            $karyawan->save();
            
            return back();
        } else {
            Alert::error('Gagal Mengirim', 'Periksa kembali data yang Anda masukkan.');

            return back();
        }
    }

    /**
     * Proses perbarui Nama Kepala Sub Bidang oleh admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function perbaruinamaksb(Request $request, $nip)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        KepalaSubBidang::where('nip', $nip)->update([
            'nama_ksb' => $request->get('nama')
        ]);

        if (1) {
            Alert::success('Data Diperbarui', 'Data Kepala Sub Bidang berhasil diperbarui.');

            return back();
        } else {
            Alert::toast('Gagal, Periksa Kembali data yang Anda kirim','error');

            return back();
        }
    }

    /**
     * Proses memperbarui password kepalasubbidang.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function perbaruipasswordksb(Request $request, $nip)
    {    
        $request->validate([
            'password' => ['required', 'string', 'min:8']
        ]);
    
        $KepalaSubBidangData = $request->only(["password"]);
        $KepalaSubBidangData['password'] = Hash::make($KepalaSubBidangData['password']);
        KepalaSubBidang::where('nip', $nip)->update($KepalaSubBidangData);
    
        if (1) {
            Alert::success('Password Diperbarui', 'Password Kepala Sub Bidang berhasil diperbarui.');
            
            return back();
        } else {
            Alert::error('Gagal Mengirim', 'Periksa kembali data yang dikirim');
    
            return back();
        }
    }

    /**
     * Menghapus Kepala Sub Bidang
     *
     * @param  int  $nip
     * @return \Illuminate\Http\Response
     */
    public function hapusverifikator($nip)
    {
        $cekdataksb = KepalaSubBidang::where('fp_ksb', NULL)->get();

        if ($cekdataksb) {
            $delete = KepalaSubBidang::where('nip',$nip);
            $delete->delete();
        } else {
            $delete = KepalaSubBidang::where('nip',$nip);
            unlink('uploads/fotoprofil/karyawan/'.$delete->fp_ksb);
            $delete->delete();
        }
        
        if ($delete = 1) {
            Alert::success('Kepala Sub Bidang Dihapus', 'Kepala Sub Bidang telah dihapus.');
            return back();
        } else {
            Alert::error('Gagal menghapus data', 'Periksa kembali data yang anda hapus');
            return back();
        }
    }
}
