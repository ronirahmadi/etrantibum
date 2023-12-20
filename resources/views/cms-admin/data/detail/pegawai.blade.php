@extends('layouts.admin')
@section('content')
<div class="main-content">
    <section class="section">
          <div class="section-header">
            <div class="section-header-back">
              <a href="{{ route('cms-admin.data.daftarpegawai') }}" class="btn btn-icon"><i class="fas fa-arrow-left"> Kembali</i></a>
            </div>
            <h1>Profil</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Menu</a></div>
              <div class="breadcrumb-item">Profil</div>
            </div>
          </div>
          <div class="section-body">
            @foreach($profil as $data)
            <h2 class="section-title">Data NIP {{ $data->nip }}</h2>
            @endforeach
            <p class="section-lead">
            Anda dapat mengganti kata sandi Pegawai.
            </p>

            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        @if ($fotoprofil == NULL)
                        <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="profile-widget-picture">
                        @else
                        @foreach($profil as $data)
                        <img alt="image" src="{{ url('uploads/fotoprofil/pegawai/')}}/{{ $data->fp_user }}" class="profile-widget-picture">
                        @endforeach
                        @endif                    
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Disetujui</div>
                                <div class="profile-widget-item-value">{{ $totaldisetujui }}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Ditolak</div>
                                <div class="profile-widget-item-value">{{ $totalditolak }}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Belum Diverifikasi</div>
                                <div class="profile-widget-item-value">{{ $totaldiproses }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">                      
                      <form method="POST" action="{{ route('cms-admin.data.detail.pegawai.perbaruidatapegawai', $data->nip) }}">
                          <div class="row">   
                          @foreach($profil as $data)                            
                            <div class="form-group col-md-6 col-12">
                                <label>Nama Lengkap</label>
                                  @method('patch')
                                  @csrf
                                <input class="form-control" type="text" name="Nama" value="{{ $data->nama_user }}" required></input>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Grup</label>
                                <select class="form-control selectric" name="Grup" required>
                                    <option selected="true" value="{{ $data->grup_id }}">{{ $data->nama_grup }}</option>
                                    @foreach ($grup as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                          @endforeach 
                          </div>
                          <button class="btn btn-success" type="submit" id="save-btn">Perbarui Data</button>
                      </form>
                    </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Foto Profil</h4>
                  </div>
                  @foreach($profil as $data)
                  <div class="card-body">
                    <div class="form-group">
                      <label>File</label>
                      <div class="form-control">
                          <a href="{{ url('uploads/fotoprofil/pegawai/')}}/{{ $data->fp_user }}" target=”_blank”>{{ $data->fp_user }}</a>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <form method="POST" action="{{ route('cms-admin.data.pegawai.perbaruipasswordpegawai', $data->nip) }}">
                    @method('patch')
                    @csrf
                    <div class="card-header">
                      <h4>Perbarui Kata Sandi Pegawai</h4>
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
