<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Grup;
use App\Laporan;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class MainController extends Controller
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
     * Menampilkan halaman home kepalakantor.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {    
        $admin = Auth::user()->nama_admin;

        #total data
        $totaldisetujui = Laporan::join('users', 'users.nip', '=', 'laporans.kodeunik_laporan')
        ->where('laporans.status_laporan', '=', 'Disetujui')->count();
        
        $totalditolak = Laporan::join('users', 'users.nip', '=', 'laporans.kodeunik_laporan')
        ->where('laporans.status_laporan', '=', 'Ditolak')->count();

        $totaldiproses = Laporan::join('users', 'users.nip', '=', 'laporans.kodeunik_laporan')
        ->where('laporans.status_laporan', '=', 'Belum Diverifikasi')->count();

        $totalpegawai = User::count();

        $totalgrup = Grup::count();

        return view('cms-admin.index', compact('totalgrup','totalpegawai','totaldisetujui', 'totalditolak', 'totaldiproses','admin'));
    }

    /**
     * Menampilkan halaman data datalaporan pegawai untuk admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function daftarlaporan()
    {    
         $datalaporan = Laporan::leftjoin('users', 'users.nip', '=', 'laporans.kodeunik_laporan')
        ->leftjoin('grups', 'grups.id_grup', '=', 'users.grup_id')
        ->orderBy('laporans.created_at', 'desc')
        ->get();

        return view('cms-admin.data.daftarlaporan', compact('datalaporan'));
    }

    /**
     * Menampilkan halaman daftar laporan pegawai berdasarkan tanggal dan atau kategori.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function daftarlaporanfilter(Request $request)
    {    
        #total data
        $start_date = Carbon::parse($request->start_date)
                             ->toDateTimeString();

        $end_date = Carbon::parse($request->end_date)
                                ->toDateTimeString();

        $status = $request->input('status');


        if ($status === NULL) {
            
            $request->validate([
                'start_date' => 'required',
                'end_date' => 'required',
            ]);

            $hasilcari = Laporan::leftjoin('users', 'users.nip', '=', 'laporans.kodeunik_laporan')
            ->leftjoin('grups', 'grups.id_grup', '=', 'users.grup_id')
            ->whereBetween('tanggal_laporan',[$start_date,$end_date])
            ->orderBy('laporans.created_at', 'desc')
            ->get();
        } elseif ($request->start_date === NULL && $request->end_date === NULL) {
            
            $request->validate([
                'status' => 'required'
            ]);

            $hasilcari = Laporan::leftjoin('users', 'users.nip', '=', 'laporans.kodeunik_laporan')
            ->leftjoin('grups', 'grups.id_grup', '=', 'users.grup_id')
            ->where('status_laporan', '=', $status)
            ->orderBy('laporans.created_at', 'desc')
            ->get();
        } else {
            $hasilcari = Laporan::leftjoin('users', 'users.nip', '=', 'laporans.kodeunik_laporan')
            ->leftjoin('grups', 'grups.id_grup', '=', 'users.grup_id')
            ->whereBetween('tanggal_laporan',[$start_date,$end_date])
            ->where('status_laporan', '=', $status)
            ->orderBy('laporans.created_at', 'desc')
            ->get();
        }

        return view('cms-admin.data.searchlaporan', compact('status','hasilcari'));
    }


    /**
     * Menghapus laporan pegawai
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroylaporan($id_laporan)
    {
        $cekbukti = Laporan::where('bukti_laporan', NULL)->get();

        if ($cekbukti) {
            $delete = Laporan::find($id_laporan);
            $delete->delete();
        } else {
            $delete = Laporan::find($id_laporan);
            unlink('uploads/bukti_pendukung/'.$delete->bukti_laporan);
            $delete->delete();
        }

        if ($delete = 1) {
            Alert::success('Berhasil Dihapus', 'Laporan Harian telah dihapus.');
            return back();
        } else {
            Alert::error('Gagal menghapus data', 'Periksa kembali data yang anda hapus');
            return back();
        }
    }

    /**
     * Menampilkan halaman data detail laporan pegawai untuk admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detaildatalaporan($kodeunik_laporan)
    {    
        $admin = Auth::user()->nama_admin;

        $datalaporan = Laporan::leftjoin('users', 'users.nip', '=', 'laporans.kodeunik_laporan')
        ->leftjoin('grups', 'grups.id_grup', '=', 'users.grup_id')
        ->leftJoin('indonesia_provinces', 'indonesia_provinces.id', '=', 'users.provinsi_k')
        ->leftJoin('indonesia_cities', 'indonesia_cities.id', '=', 'users.kota_k')
        ->leftJoin('indonesia_districts', 'indonesia_districts.id', '=', 'users.kecamatan_k')
        ->leftJoin('indonesia_villages', 'indonesia_villages.id', '=', 'users.kelurahan_k')
        ->leftJoin('agamas', 'agamas.id', '=', 'users.agama_k')
        ->leftJoin('status_pernikahans', 'status_pernikahans.id', '=', 'users.status_pernikahan_k')
        ->where('laporans.kodeunik_laporan', '=', $kodeunik_laporan)
        ->get();

        return view('cms-admin.data.detail.laporan', compact('admin', 'datalaporan'));
    }

    /**
     * Menghapus laporan pegawai
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroylaporandidetail($id_laporan)
    {
        $cekbukti = Laporan::where('bukti_laporan', NULL)->get();

        if ($cekbukti) {
            $delete = Laporan::find($id_laporan);
            $delete->delete();
        } else {
            $delete = Laporan::find($id_laporan);
            unlink('uploads/bukti_pendukung/'.$delete->bukti_laporan);
            $delete->delete();
        }

        if ($delete = 1) {
            Alert::success('Berhasil Dihapus', 'Laporan Harian telah dihapus.');
            return redirect()->route('cms-admin.data.daftarlaporan');
        } else {
            Alert::error('Gagal menghapus data', 'Periksa kembali data yang anda hapus');
            return back();
        }
    }    

    /**
     * Menampilkan halaman data daftar grup untuk admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function daftargrup()
    {    
        $grup = Grup::where('id_grup', '!=', 1)
        ->orderBy('nama_grup', 'asc')
        ->get();

        return view('cms-admin.data.daftargrup', compact('grup'));
    }

    /**
     * Menampilkan form tambah grup oleh admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function formtambahgrup()
    {    
        return view('cms-admin.form.tambahgrup');
    }

    /**
     * Proses pengiriman data menambahkan grup.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function kirimdatagrup(Request $request)
    {    
        $request->validate([
            'Nama' => 'required',
        ]);

        $grup = new Grup();
        $grup->nama_grup = $request->input('Nama');
                
        $cekgrup = Grup::where('nama_grup', '=', $request->input('Nama'))->first();

        if ($cekgrup === null) {
            Alert::success('Grup Ditambahkan', 'Anda berhasil menambahkan Grup baru.');
            $grup->save();
            
            return back();
        } else {
            Alert::error('Gagal Mengirim', 'Periksa kembali data yang Anda masukkan.');

            return back();
        }
    }

    /**
     * Menampilkan form editgrup oleh admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editgrup($id)
    {    
        $grup = Grup::where('id_grup', $id)
        ->where('id_grup', '!=', 1)
        ->get();

        return view('cms-admin.form.editgrup', compact('grup'));
    }

    /**
     * Proses Update Grup admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updategrup(Request $request, $id)
    {
        Grup::where('id_grup', $id)->update([
            'nama_grup' => $request->get('Nama')
        ]);

        if (1) {
            Alert::success('Data Diperbarui', 'Data Grup berhasil diperbarui.');

            return back();
        } else {
            Alert::toast('Gagal, Periksa Kembali data yang Anda kirim','error');

            return back();
        }
    }


    /**
     * Menghapus grup
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapusgrup($id)
    {
        
        $delete = Grup::find($id);

        // Find all users belonging to the group
        User::where('grup_id', $id)->update(['grup_id' => 1]);

        //dd($delete);

        $delete->delete();
        
        if ($delete = 1) {
            Alert::success('Grup Dihapus', 'Grup telah dihapus.');
            return back();
        } else {
            Alert::error('Gagal menghapus data', 'Periksa kembali data yang anda hapus');
            return back();
        }
    }
}
