@extends('layouts.admin')
@section('content')
<div class="main-content">
<section class="section">
          <div class="section-header">
            <h1>Data Kepala Sub Bidang</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Menu</a></div>
              <div class="breadcrumb-item"><a href="#">Data Kepala Sub Bidang</a></div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <h5 class="section-title">Daftar Kepala Sub Bidang</h5>
                          <p>
                          Kepala Sub Bidang di Bappenda Bogor
                          </p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 tombol">
                            <a class="btn btn-success" href="{{ route('cms-admin.form.tambahkepalasubbidang') }}"><i class="fa fa-plus"></i>Tambah Kepala Sub Bidang</a>
                        </div>
                    </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-4">
                        <thead>
                          <tr>
                            <th>
                              No
                            </th>
                            <th>Nama Lengkap</th>
                            <th>Unit</th>
                            <th>Sub Unit</th>
                            <th>NIP</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($kepalasubbidang as $data)    
                          <tr>
                            <td class="number"></td>
                            <td>{{ $data->nama_ksb }}</td>
                            <td>{{ $data->nama_unit }}</td>
                            <td>{{ $data->nama_sub }}</td>
                            <td>{{ $data->nip }}</td>
                            <td>
                              <div class="row">
                                  <div class="col-4">
                                      <a href="{{ route('cms-admin.data.detail.kepalasubbidang',$data->nip) }}" class="btn btn-success"><i class="fa fa-pen"></i></a>
                                  </div>
                                  <div class="col-8">
                                      <form action="{{ route('cms-admin.data.daftarkepalasubbidang.destroyksb',$data->nip) }}" method="POST">
                                      <button type="submit" class="btn btn-xs btn-danger btn-flat hapus-kepalasubbidang" data-toggle="tooltip" name="delete">@csrf @method('DELETE')<i class="fa fa-trash"></i></button>
                                      </form>
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