<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Agama;
use App\Aktivitas;
use App\Http\Controllers\Controller;
use App\KepalaBidang;
use App\KepalaKantor;
use App\KepalaSubBidang;
use App\Rules\MatchOldPassword;
use App\SekretarisBadan;
use App\StatusPernikahan;
use App\SubUnit;
use App\Unit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilController extends Controller
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
     * Menampilkan halaman profil admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profil()
    {    
        $nip = Auth::user()->nip;

        #profil admin
        $profil = Admin::where('admins.nip', '=', $nip)->get();

        #foto profil admin
        $fotoprofil = Admin::where('nip', $nip)->pluck('fp_admin')->first();

        #admin
        $admin = Auth::user()->nama_admin;

        return view('cms-admin.profil.index', compact('nip', 'profil', 'fotoprofil', 'admin',));
    }


    /**
     * Proses Update Profil Admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateprofil(Request $request)
    {
        Admin::where('nip', Auth::user()->nip)->update([
            'nama_admin' => $request->get('Nama')
        ]);

        if (1) {
            Alert::success('Data Diperbarui', 'Data Diri Anda berhasil diperbarui.');

            return back();
        } else {
            Alert::toast('Gagal, Periksa Kembali data yang Anda kirim','error');

            return back();
        }
    }

    /**
     * Proses Mengupload Foto Profil.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upfoto(Request $request)
    {
        $request->validate([
            'fotoprofil' => 'required|file|mimes:jpeg,png,jpg|max:100'
        ]);

        if ($request->hasFile('fotoprofil')) {
            $folderPath = public_path('uploads/fotoprofil/admin/');
    
            $fpPath = $request->file('fotoprofil');
            $fpName = time() . '.' . $fpPath->getClientOriginalName();
       
            $file = $folderPath . $fpName;
    
            $request->fotoprofil->move(public_path('uploads/fotoprofil/admin/'), $fpName);
        }

        Admin::where('nip', Auth::user()->nip)->update([
            #code fotoprofil
            'fp_admin' => $fpName,
            'fp_admin_path' => $file
        ]);

        if (1) {
            Alert::success('Foto Profil berhasil diupload', 'Foto Profil anda berhasil diupload.');
            
            return back();
        } else {
            Alert::error('Gagal Mengirim', 'Periksa kembali data yang dikirim');

            return back();
        }
    }

    /**
     * Menghapus foto profil
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapusfp($id)
    {
        $admin = Admin::find($id);
        unlink('uploads/fotoprofil/admin/'.$admin->fp_admin);

        Admin::where('nip', Auth::user()->nip)->update([
            #code fotoprofil
            'fp_admin' => Null,
            'fp_admin_path' => Null
        ]);

        if (1) {
            Alert::success('Foto Profil Dihapus', 'Foto Profil anda telah dihapus.');
            return back();
        } else {
            Alert::error('Gagal menghapus data', 'Periksa kembali data yang anda hapus');
            return back();
        }
    }

    /**
     * Menampilkan halaman perbarui password profil admin
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function perbaruipassword()
    {    
        #admin
        $admin = Auth::user()->nama_admin;

        return view('cms-admin.profil.password', compact('admin'));
    }

    /**
     * Proses perbarui password.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updatepassword(Request $request)
    {

        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required','string', 'min:8',],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        Admin::find(auth()->user()->nip)->update(['password'=> Hash::make($request->new_password)]);

        if (1) {
            Alert::success('Password Diperbarui', 'Selalu buat password yang aman.');
            
            return back();
        } else {
            Alert::error('Gagal Memperbarui', 'Periksa kembali data yang dikirim');

            return back();
        }
    }
}
