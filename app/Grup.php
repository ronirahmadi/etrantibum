<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grup extends Model
{
    protected $table = 'grups';

    protected $primaryKey = 'id_grup';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //data bersifat bisa diisi
    protected $fillable = [
        'nama_grup'
    ];

    //data bersifat tersembunyi
    protected $hidden = [
        'id_grup'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'grup_id');
    }
}
