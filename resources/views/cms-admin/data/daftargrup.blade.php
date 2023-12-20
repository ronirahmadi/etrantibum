@extends('layouts.admin')
@section('content')
<div class="main-content">
<section class="section">
          <div class="section-header">
            <h1>Data Grup</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Menu</a></div>
              <div class="breadcrumb-item"><a href="#">Data Grup</a></div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <h5 class="section-title">Daftar Grup Patroli Trantibum Satpol PP Kota Magelang</h5>
                          <p>Ketika Grup Dihapus maka user yang bergabung di Grup tersebut akan otomatis masuk ke kategori "Tidak Memiliki Grup"</p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 tombol">
                            <a class="btn btn-success" href="{{ route('cms-admin.form.tambahgrup') }}"><i class="fa fa-plus"></i>Tambah Grup</a>
                        </div>
                    </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-5">
                        <thead>
                          <tr>
                            <th>
                              No
                            </th>
                            <th>Nama Grup</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($grup as $data)    
                          <tr>
                            <td class="number"></td>
                            <td>{{ $data->nama_grup }}</td>
                            <td>
                              <div class="row">
                                <div class="col-4">
                                  <a href="{{ route('cms-admin.form.editgrup',$data->id_grup) }}" class="btn btn-success"><i class="fa fa-pen"></i></a>
                                </div>
                                <div class="col-8">
                                  <form action="{{ route('cms-admin.data.daftargrup.hapusgrup',$data->id_grup) }}" method="POST">
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat hapus-grup" data-toggle="tooltip" name="delete">@csrf @method('DELETE')<i class="fa fa-trash"></i></button>
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