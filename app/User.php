<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //melindungi user
    protected $guard = 'users';

    protected $primaryKey = 'nip';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //data bersifat bisa diisi
    protected $fillable = [
        'nip','nama_user', 'fp_user', 'fp_user_path', 'password'
    ];

    //data bersifat tersembunyi
    protected $hidden = [
        'nip', 'password', 'remember_token'
    ];

    public function grup()
    {
        return $this->belongsTo(Grup::class, 'grup_id');
    }
}
