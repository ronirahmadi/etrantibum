<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticable;

class Admin extends Authenticable
{
    //melindungi admin
    protected $guard = 'admin';

    protected $primaryKey = 'nip';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //data bersifat bisa diisi
    protected $fillable = [
        'nip','nama_admin', 'fp_admin', 'fp_admin_path', 'password'
    ];

    //data bersifat tersembunyi
    protected $hidden = [
        'nip', 'password', 'remember_token'
    ];
}
