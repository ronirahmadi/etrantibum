<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    $this->middleware('auth');
    }

    /**
     * Menampilkan halaman home karyawan.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {    
        return view('user.index');
    }
}
