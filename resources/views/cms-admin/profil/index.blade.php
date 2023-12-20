@extends('layouts.admin')
@section('content')
<div class="main-content">
    <section class="section">
          <div class="section-header">
            <h1>Profil</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Menu</a></div>
              <div class="breadcrumb-item">Profil</div>
            </div>
          </div>
          <div class="section-body">
            <h2 class="section-title">Hai, {{ $admin }}</h2>
            <p class="section-lead">
            Anda dapat melengkapi data dan menambahkan foto profil disini.
            </p>

            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-12">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        @if ($fotoprofil == NULL)
                        <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="profile-widget-picture">
                        @else
                        @foreach($profil as $data)
                        <img alt="image" src="{{ url('uploads/fotoprofil/admin/')}}/{{ $data->fp_admin }}" class="profile-widget-picture">
                        @endforeach
                        @endif
                    </div>
                    <div class="card-body">
                    <form method="post" action="{{ route('cms-admin.profil.updateprofil') }}">
                              @method('patch')
                              @csrf   
                        <div class="row">   
                        @foreach($profil as $data)                            
                          <div class="form-group col-md-6 col-12">
                                <label>Nama Lengkap</label>
                                  @method('patch')
                                  @csrf
                                <input class="form-control" type="text" name="Nama" value="{{ $data->nama_admin }}" required></input>
                          </div>
                          <div class="form-group col-md-6 col-12">
                              <label>NIP</label>
                              <div class="form-control">{{ $data->nip }}</div>
                          </div>
                        @endforeach 
                        </div>
                        
                        <div class="card-footer text-right">
                          <button class="btn btn-success mb-3" type="submit">Perbarui Data Diri</button>
			                    <a href="{{ route('cms-admin.profil.password') }}" class="btn btn-warning mb-3">Perbarui Password</a>
                        </div>
                      </form>
                    </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Foto Profil</h4>
                  </div>
                  @if ($fotoprofil == NULL)
                  <div class="card-body">
                  <form method="POST" action="{{ route('cms-admin.profil.upfoto') }}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label>File</label>
                        <input type="file" name="fotoprofil" class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" id="foto-profil">
                        <div class="form-text text-muted">Tipe/Format yang diizinkan .JPEG, .PNG, .JPG dengan maksimal ukuran 100Kb<br><strong>Rasio Foto 1:1</strong></div>
                      </div>
                      <button class="btn btn-success" type="submit">Upload</button>
                    </form>
                  </div>
                  @else
                  @foreach($profil as $data)
                  <div class="card-body">
                    <div class="form-group">
                      <label>File</label>
                      <div class="form-control">
                          <a href="{{ url('uploads/fotoprofil/admin/')}}/{{ $data->fp_admin }}" target=”_blank”>{{ $data->fp_admin }}</a>
                      </div>
                    </div>
                    <form action="{{ route('cms-admin.profil.hapusfp',$nip) }}" method="POST">
                      <button class="btn btn-danger" type="submit">
                        <a class="fa fa-trash">@csrf @method('PATCH') Hapus Foto Profil</a>
                      </button>
                    </form>
                  </div>
                  @endforeach
                  @endif
                </div>
              </div>          
            </div>
          </div>
    </section>
</div>
@endsection
