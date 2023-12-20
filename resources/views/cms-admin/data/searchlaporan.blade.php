@extends('layouts.sistem')
@section('content')
<div class="main-content">
<section class="section">
          <div class="section-header">
            <h1>Data Kegiatan</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Menu</a></div>
              <div class="breadcrumb-item"><a href="#">Data Kegiatan</a></div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <h5 class="section-title">Daftar Laporan</h5>
                          <p>
                            Laporan Harian Karyawan di Bappenda Bogor
                          </p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 tombol">
                            <button type="button" onclick="ExportExcel();" class="btn btn-success btn-sm"><i class="fa fa-file-excel"></i> Export Excel</button>
                            <button type="button" id="ExportPdf" onclick="ExportPdf()" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i> Export PDF</button>
                        </div>
                    </div>
                  <div class="card-body">
                        <form action="{{ route('cms-admin.data.searchlaporan.get') }}" method="GET">
                              <div class="row mb-3">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-6 mb-3">
                                  <input type="date" class="form-control" name="start_date">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-6 mb-3">
                                  <input type="date" class="form-control" name="end_date">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-6">
                                  <select class="form-control selectric" name="status">
                                      <option selected="true" disabled="disabled">--Pilih Status--</option>
                                      <option value="Belum Diverifikasi">Belum Diverifikasi</option>
                                      <option value="Disetujui">Disetujui</option>
                                      <option value="Ditolak">Ditolak</option>
                                  </select>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 col-3">
                                  <button class="btn btn-success" type="submit">Filter</button>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 col-3">
                                  <input class="btn btn-danger" type="button" value="Reset" onclick="location.assign('daftarlaporan')"/>
                                </div>
                              </div>
                        </form>
                    <div class="table-responsive">
                    <p>Menampilkan data hasil filter laporan</p>
                    <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                          <th>
                              No
                            </th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Tanggal Kegiatan</th>
                            <th>Deskripsi Kegiatan</th>
                            <th>Kuantitas Waktu</th>
                            <th>Waktu Kegiatan</th>
                            <th>Hasil Kegiatan</th>
                            <th>Dokumentasi</th>
                            <th>Status</th>
                            <th>Keterangan Verifikasi</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($datalaporan as $data)    
                          <tr>
                            <td class="number"></td>
                            <td>{{ $data->nama_k }}</td>
                            <td>{{ $data->nip }}</td>
                            <td>{{ $data->tanggal_kegiatan->isoformat('dddd, D MMMM Y') }}</td>
                            <td>{{ $data->deskripsi_kegiatan }}</td>
                            <td>{{ $data->kuantitas_waktu_kegiatan }} Kali</td>
                            <td>{{ $data->waktu_kegiatan }} Menit</td>
                            <td>{{ $data->satuan_kuantitas }}</td>
                            <td><a href="{{ url('uploads/bukti_pendukung/')}}/{{ $data->bp_kegiatan }}" target=”_blank”>{{ $data->bp_kegiatan }}</a></td>
                            <td>{{ $data->status_kegiatan }}</td>
                            <td>{{ $data->keterangan_verifikasi_kegiatan }}</td>
                            <td>
                                <div class="row">
                                  <div class="col-6">
                                    <form action="{{ route('cms-admin.data.destroylaporan',$data->id_kegiatan) }}" method="POST">
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat hapus-laporan" data-toggle="tooltip" name="delete">@csrf @method('DELETE')<i class="fa fa-trash"></i></button>
                                    </form>
                                  </div>
                                  <div class="col-6">
                                    <a class="btn btn-xs btn-success btn-flat" href="{{ route('cms-admin.data.detail.laporan',$data->kodeunik_kegiatan) }}"><i class="fa fa-eye"></i></a>
                                  </div>
                                </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
</div>
@endsection