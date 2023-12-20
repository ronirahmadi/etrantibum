@extends('layouts.admin')
@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('cms-admin.data.daftarkepalasubbidang') }}" class="btn btn-icon"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <h1>Form Tambah Kepala Sub Bidang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Menu</a></div>
            <div class="breadcrumb-item"><a href="#">Form Tambah Kepala Sub Bidang</a></div>
        </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Kepala Sub Bidang</h2>
            <p class="section-lead">
                Lengkapi data berikut, untuk menambahkan Kepala Sub Bidang.
            </p>
            
             

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        <h4>Lengkapi Data Berikut :</h4>
                        </div>
                        <div class="card-body">
                                <form action="{{ route('cms-admin.form.kirimdataksb') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap Kepala Sub Bidang :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIP Kepala Sub Bidang :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" name="nip" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Unit Kepala Sub Bidang :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="unit" required>
                                            <option selected="true" disabled="disabled">--Pilih Unit--</option>
                                            @foreach ($unit as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sub Unit Kepala Sub Bidang :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="subunit" class="form-control" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input id="password" type="text" name="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-success">Tambah Kepala Sub Bidang</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
