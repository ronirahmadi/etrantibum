@extends('layouts.admin')
@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('cms-admin.data.daftargrup') }}" class="btn btn-icon"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <h1>Form Edit Grup</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Menu</a></div>
            <div class="breadcrumb-item"><a href="#">Form Edit Grup</a></div>
        </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Edit Grup</h2>
            <p class="section-lead">
                Lengkapi data berikut, untuk mengedit Grup.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        <h4>Lengkapi Data Berikut :</h4>
                        </div>
                        <div class="card-body">
                            @foreach($grup as $data)
                                <form action="{{ route('cms-admin.form.updategrup', $data->id_grup) }}" method="POST" enctype="multipart/form-data">
                                @method('patch')
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
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Grup :</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="Nama" class="form-control" value="{{ $data->nama_grup }}" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-success">Perbarui Grup</button>
                                </div>
                            </div>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
