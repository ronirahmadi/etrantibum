@extends('layouts.admin')
@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Dashboard</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title"> Hai {{ $admin }}, Selamat Datang di E-Trantibum Satpol PP Kota Magelang</h2>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-check"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Disetujui</h4>
                    </div>
                    <div class="card-body">
                    {{ $totaldisetujui }}
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-times"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Ditolak</h4>
                    </div>
                    <div class="card-body">
                    {{ $totalditolak }}
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Belum Diverifikasi</h4>
                    </div>
                    <div class="card-body">
                    {{ $totaldiproses }}
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Seluruh Pegawai</h4>
                    </div>
                    <div class="card-body">
                    {{ $totalpegawai }}
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="fas fa-building"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Grup</h4>
                    </div>
                    <div class="card-body">
                    {{ $totalgrup }}
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection