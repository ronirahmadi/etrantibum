@extends('layouts.admin')
@section('content')
<div class="main-content">
<section class="section">
          <div class="section-header">
            <h1>Data Pegawai</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Menu</a></div>
              <div class="breadcrumb-item"><a href="#">Data Pegawai</a></div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <h5 class="section-title">Daftar Pegawai Trantibum Satpol PP Kota Magelang</h5>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 tombol">
                            <a class="btn btn-success" href="{{ route('cms-admin.form.tambahpegawai') }}"><i class="fa fa-plus"></i>Tambah Pegawai</a>
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
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Grup</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($pegawai as $data)    
                          <tr>
                            <td class="number"></td>                            
                            <td>{{ $data->nip }}</td>
                            <td>{{ $data->nama_user }}</td>
                            <td>{{ $data->nama_grup }}</td>
                            <td>
                              <div class="row">
                                  <div class="col-4">
                                      <a href="{{ route('cms-admin.data.detail.pegawai',$data->nip) }}" class="btn btn-success"><i class="fa fa-pen"></i></a>
                                  </div>
                                  <div class="col-8">
                                      <form action="{{ route('cms-admin.data.daftarpegawai.hapuspegawai',$data->nip) }}" method="POST">
                                      <button type="submit" class="btn btn-xs btn-danger btn-flat hapus-pegawai" data-toggle="tooltip" name="delete">@csrf @method('DELETE')<i class="fa fa-trash"></i></button>
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
