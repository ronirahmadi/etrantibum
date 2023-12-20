@extends('layouts.admin')
@section('content')
<div class="main-content">
    <section class="section">
          <div class="section-header">
	    <div class="section-header-back">
             <a href="{{ route('cms-admin.data.daftarkepalasubbidang') }}" class="btn btn-icon"><i class="fas fa-arrow-left"> Kembali</i></a>
            </div>
            <h1>Profil</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Menu</a></div>
              <div class="breadcrumb-item">Profil</div>
            </div>
          </div>
          <div class="section-body">
            @foreach($mainprofil as $data)
            <h2 class="section-title">Data NIP {{ $data->nip }}</h2>
            @endforeach
            <p class="section-lead">
            Anda dapat mengganti kata sandi kepala sub bidang.
            </p>

            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        @if ($fotoprofil == NULL)
                        <img alt="image" src="{{ asset('img/avatar/avatar-2.png') }}" class="profile-widget-picture">
                        @else
                        @foreach($mainprofil as $data)
                        <img alt="image" src="{{ url('uploads/fotoprofil/kepalasubbidang/')}}/{{ $data->fp_ksb }}" class="profile-widget-picture">
                        @endforeach
                        @endif
                    </div>
                    <div class="card-body"> 
                        <div class="row">   
                        @foreach($mainprofil as $data)                            
                          <div class="form-group col-md-6 col-12">
                              <label>Nama Lengkap</label>
                              <form method="POST" action="{{ route('cms-admin.data.detail.kepalasubbidang.perbaruinamaksb', $data->nip) }}">
                                @method('patch')
                                @csrf
                                <input class="form-control" type="text" name="nama" value="{{ $data->nama_ksb }}" required></input>
                                <button class="btn btn-success" type="submit" id="save-btn">Perbarui Nama</button>
                              </form>
                          </div>
                          <div class="form-group col-md-6 col-12">
                              <label>NIP</label>
                              <div class="form-control">{{ $data->nip }}</div>
                          </div>
                          <div class="form-group col-md-6 col-12">
                              <label>Unit</label>
                              <div class="form-control">{{ $data->nama_unit }}</div>
                          </div>
                          <div class="form-group col-md-6 col-12">
                              <label>Sub Unit</label>
                              <div class="form-control">{{ $data->nama_sub }}</div>
                          </div>
                        @endforeach 
                        @foreach($profil as $data)
                          <div class="form-group col-md-3 col-12">
                              <label>Telepon</label>
                              <div class="form-control">{{ $data->no_telepon_ksb }}</div>
                          </div>
                          <div class="form-group col-md-3 col-12">
                              <label>Tanggal Lahir</label>
                              <div class="form-control">{{ $data->tanggal_lahir_ksb }}</div>
                          </div>
                          <div class="form-group col-md-3 col-12">
                              <label>Agama</label>
                              <div class="form-control">{{ $data->nama_agama }}</div>
                          </div>
                          <div class="form-group col-md-3 col-12">
                              <label>Status Pernikahan</label>
                              <div class="form-control">{{ $data->nama_status }}</div>
                          </div>
                          <div class="form-group col-md-6 col-12">
                                <label>Alamat Tempat Tinggal</label>
                                <textarea style="height: 250px;" readonly class="form-control">{{ $data->alamat_ksb }}</textarea>
                            </div>
                          <div class="form-group col-md-6 col-12">
                              <label>Pilih Provinsi</label>
                              <div class="form-control">{{ $data->name_prov }}</div>
                              <label>Pilih Kota/Kabupaten</label>
                              <div class="form-control">{{ $data->name_kot }}</div>
                              <label>Pilih Kecamatan</label>
                              <div class="form-control">{{ $data->name_dis }}</div>
                              <label>Pilih Kelurahan</label>
                              <div class="form-control">{{ $data->name_vil }}</div>
                          </div>
                        @endforeach
                        </div>
                    </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Foto Profil</h4>
                  </div>
                  @foreach($mainprofil as $data)
                  <div class="card-body">
                    <div class="form-group">
                      <label>File</label>
                      <div class="form-control">
                          <a href="{{ url('uploads/fotoprofil/kepalasubbidang/')}}/{{ $data->fp_ksb }}" target=”_blank”>{{ $data->fp_ksb }}</a>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <form method="POST" action="{{ route('cms-admin.data.kepalasubbidang.perbaruipasswordksb', $data->nip) }}">
                    @method('patch')
                    @csrf
                    <div class="card-header">
                      <h4>Perbarui Kata Sandi Kepala Sub Bidang</h4>
                    </div>
                    <div class="card-body">
                      @if ($errors->has('new_password'))
                          <div class="alert alert-danger">
                              <ul>
                                  <li>{{ $errors->first('new_password') }}</li>
                              </ul>
                          </div>
                      @endif
                      <div class="form-group">
                        <label for="inputNewPassword">Kata Sandi Baru</label>
                        <input id="new_password" type="password" class="form-control" name="password" autocomplete="password">
                        <small id="passwordHelpBlock" class="form-text text-muted">
                          Kata Sandi Anda harus 8-20 karakter.
                        </small>
                      </div>
                      <div class="card-footer bg-whitesmoke text-md-right">
                        <button class="btn btn-success" type="submit" id="save-btn">Perbarui Kata Sandi</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>           
            </div>
          </div>
    </section>
</div>
@endsection
