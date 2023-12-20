<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporans';

    protected $primaryKey = 'kodeunik_laporan';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nip_verifikator', 'grup_id', 'tanggal_laporan', 'judul_laporan', 'deskripsi_laporan', 'lokasi_kec_laporan', 'lokasi_kel_laporan',
        'detail_lokasi_laporan', 'bukti_laporan', 'bukti_laporan_path', 'status_laporan', 'keterangan_verifikasi_laporan'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'tanggal_laporan'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $guarded = [
        'kodeuniK_laporan', 'nip_verifikator', 'grup_id'
    ];
}
