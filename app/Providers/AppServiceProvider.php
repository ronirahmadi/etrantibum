<?php

namespace App\Providers;

use App\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //admin
        View::composer('layouts.admin', function($fotoprofil)
        {
            $nip_admin = Auth::user()->nip;

            $fotoprofil->with('fotoprofil', Admin::where('nip', $nip_admin)->pluck('fp_admin')->first());
        });
    }
}
