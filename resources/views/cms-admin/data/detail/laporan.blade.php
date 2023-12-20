@extends('layouts.admin')
@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('cms-admin.data.daftarlaporan') }}" class="btn btn-icon"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <h1>Detail Laporan Harian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Menu</a></div>
            <div class="breadcrumb-item"><a href="#">Detail Laporan Harian</a></div>
        </div>
        </div>

        <div class="section-body">
             @foreach($datalaporan as $data)
            <h2 class="section-title">Detail Laporan Harian dengan kodeunik {{ $data->kodeunik_kegiatan }}</h2>
            <p class="section-lead">
                Data laporan kegiatan harian {{ $data->nama_k }} di Bidang {{ $data->nama_unit }} dalam Sub Bidang {{ $data->nama_sub }}
            </p>
            @endforeach

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Karyawan</h4>
                        </div>
                        <div class="card-body">
                            @foreach($datalaporan as $data)
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Karyawan</label>
                                <div class="col-sm-12 col-md-7">
                                    <h5 type="text" class="form-control">{{ $data->nama_k }}</h5>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Bagian / Sub Bagian</label>
                                <div class="col-sm-12 col-md-7">
                                    <h5 type="text" class="form-control">{{ $data->nama_unit }} / {{ $data->nama_sub }}</h5>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIP</label>
                                <div class="col-sm-12 col-md-7">
                                    <h5 type="text" class="form-control">{{ $data->nip }}</h5>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="card-header">
                            <h4>Laporan Harian</h4>
                        </div>
                        <div class="card-body">
                            @foreach($datalaporan as $data)
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kodeunik Kegitan</label>
                                <div class="col-sm-12 col-md-7">
                                    <h5 type="text" class="form-control">{{ $data->kodeunik_kegiatan }}</h5>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Kegiatan</label>
                                <div class="col-sm-12 col-md-7">
                                    <h5 type="text" class="form-control">{{ $data->tanggal_kegiatan->isoformat('dddd, D MMMM Y') }}</h5>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi Kegiatan</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea readonly name="deskripsi" style="height: 250px;" class="form-control">{{ $data->deskripsi_kegiatan }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Waktu Kegiatan dan Kuantitas</label>
                                <div class="col-sm-12 col-md-4">
                                    <h5 type="text" class="form-control">{{ $data->kuantitas_waktu_kegiatan }} Menit</h5>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <h5 type="text" class="form-control">{{ $data->waktu_kegiatan }} Kali</h5>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Hasil Kegiatan</label>
                                <div class="col-sm-12 col-md-7">
                                    <h5 type="text" class="form-control">{{ $data->satuan_kuantitas }}</h5>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Dokumentasi Kegiatan</label>
                                <div class="col-sm-12 col-md-7">
                                    <a class="form-control" href="{{ url('uploads/bukti_pendukung/')}}/{{ $data->bp_kegiatan }}" target=”_blank”>Lihat File Dokumentasi Kegiatan</a>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <form action="{{ route('cms-admin.data.destroylaporan',$data->id_kegiatan) }}" method="POST">
                                    <button class="btn btn-danger btn-flat hapus-laporan" type="submit" data-toggle="tooltip" name="delete">
                                    <a><i class="fa fa-trash"></i>@csrf @method('DELETE') Hapus Laporan</a>
                                    </button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
