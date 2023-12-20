@extends('layouts.admin')
@section('content')
<div class="main-content">
    <section class="section">
          <div class="section-header">
            <h1>Profil</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Menu</a></div>
              <div class="breadcrumb-item">Profil</div>
              <div class="breadcrumb-item">Perbarui Password</div>
            </div>
          </div>
          <div class="section-body">
            <h2 class="section-title">Hai, {{ $admin }}</h2>
            <p class="section-lead">
            Anda dapat mengubah kata sandi disini
            </p>
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <form method="POST" action="{{ route('cms-admin.change.password') }}">
                    @method('patch')
                    @csrf
                    <div class="card-header">
                      <h4>Perbarui Kata Sandi</h4>
                    </div>
                    <div class="card-body">
                      @if ($errors->has('current_password'))
                          <div class="alert alert-danger">
                              <ul>
                                  <li>{{ $errors->first('current_password') }}</li>
                              </ul>
                          </div>
                      @endif
                      @if ($errors->has('new_password'))
                          <div class="alert alert-danger">
                              <ul>
                                  <li>{{ $errors->first('new_password') }}</li>
                              </ul>
                          </div>
                      @endif
                      @if ($errors->has('new_confirm_password'))
                          <div class="alert alert-danger">
                              <ul>
                                  <li>{{ $errors->first('new_confirm_password') }}</li>
                              </ul>
                          </div>
                      @endif
                      <div class="form-group">
                        <label for="inputCurrentPassword">Kata Sandi Sebelumnya</label>
                        <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                      </div>
                      <div class="form-group">
                        <label for="inputNewPassword">Kata Sandi Baru</label>
                        <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="new-password">
                        <small id="passwordHelpBlock" class="form-text text-muted">
                          Kata Sandi Anda harus 8-20 karakter.
                        </small>
                      </div>
                      <div class="form-group">
                        <label for="inputNewPasswordConfirmation">Konfirmasi Kata Sandi Baru</label>
                        <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="new-confirm-password">
                        <small id="passwordHelpBlock" class="form-text text-muted">
                          Sama dengan kata sandi baru Anda.
                        </small>
                      </div>
                      <div class="card-footer bg-whitesmoke text-right">
                        <button class="btn btn-success mb-3" type="submit" id="save-btn">Perbarui Kata Sandi</button>
                        <a href="{{ route('cms-admin.profil.index') }}" class="btn btn-warning mb-3">Perbarui Password</a>
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