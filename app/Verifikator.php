<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticable;

class Verifikator extends Authenticable
{
    //melindungi verifikator
    protected $guard = 'verifikator';

    protected $primaryKey = 'nip';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //data bersifat bisa diisi
    protected $fillable = [
        'nip','nama_verifikator', 'fp_verifikator', 'fp_verifikator_path', 'password'
    ];

    //data bersifat tersembunyi
    protected $hidden = [
        'nip', 'password', 'remember_token'
    ];
}
