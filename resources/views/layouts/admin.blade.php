<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>E-Trantibum Satpol PP Kota Magelang</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('img/logo-satpol-pp-kota-magelang.png') }}">

 <!-- General CSS Files -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
  <script type="text/javascript" src="{{ asset('js/excel/xlsx.bundle.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/excel/xlsx.extendscript.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/excel/xlsx.download.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/excel/main.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/pdf/main.js') }}"></script>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            @guest
            @else
            @if ($fotoprofil == NULL)
            <img alt="Foto Profil" src="{{ asset('img/avatar/avatar-1.png') }}" class="rounded-circle mr-2">
            @else
            <img alt="Foto Profil" src="{{ url('uploads/fotoprofil/admin/')}}/{{ $fotoprofil }}" class="rounded-circle mr-2">
            @endif
            <div class="d-sm-none d-lg-inline-block">Halo, {{ Auth::user()->nama_admin }}</div></a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Anda masuk sebagai<br>Admin</div>
                  <a href="{{ route('cms-admin.profil.index') }}" class="dropdown-item has-icon {{ (Request::route()->getName() == 'cms-admin.profil.index') ? 'active' : '' }}">
                    <i class="far fa-user"></i> Profil
                  </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                onClick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              </div>
            @endguest
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <img style="width: 15%;" src="{{ asset('img/logo-satpol-pp-kota-magelang.png') }}">
              <a href="#">Satpol PP</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
              <img style="width: 50%;" src="{{ asset('img/logo-satpol-pp-kota-magelang.png') }}">
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                    <li class="{{ (Request::route()->getName() == 'cms-admin.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('cms-admin.index') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                <li class="menu-header">Menu</li>
                  <li class="{{ (Request::route()->getName() == 'cms-admin.data.daftarlaporan') ? 'active' : '' }} {{ (Request::route()->getName() == 'cms-admin.data.searchlaporan') ? 'active' : '' }} {{ (Request::route()->getName() == 'cms-admin.data.detail.laporan') ? 'active' : '' }}"><a class="nav-link" href="{{ route('cms-admin.data.daftarlaporan') }}"><i class="fa fa-book"></i> <span>Data Kegiatan</span></a></li>       
                <li class="menu-header">Pengguna</li>
                  <li class="{{ (Request::route()->getName() == 'cms-admin.data.daftargrup') ? 'active' : '' }} {{ (Request::route()->getName() == 'cms-admin.form.tambahgrup') ? 'active' : '' }} {{ (Request::route()->getName() == 'cms-admin.data.kirimdatagrup') ? 'active' : '' }} {{ (Request::route()->getName() == 'cms-admin.data.editgrup') ? 'active' : '' }}"><a class="nav-link" href="{{ route('cms-admin.data.daftargrup') }}"><i class="fa fa-users"></i> <span>Data Grup</span></a></li>  
                  <li class="{{ (Request::route()->getName() == 'cms-admin.data.daftarpegawai') ? 'active' : '' }} {{ (Request::route()->getName() == 'cms-admin.data.detail.pegawai') ? 'active' : '' }} {{ (Request::route()->getName() == 'cms-admin.form.tambahpegawai') ? 'active' : '' }}"><a class="nav-link" href="{{ route('cms-admin.data.daftarpegawai') }}"><i class="fa fa-users"></i> <span>Pegawai</span></a></li>
                  <li class="{{ (Request::route()->getName() == 'cms-admin.data.daftarverifikator') ? 'active' : '' }} {{ (Request::route()->getName() == 'cms-admin.data.detail.verifikator') ? 'active' : '' }} {{ (Request::route()->getName() == 'cms-admin.form.tambahverifikator') ? 'active' : '' }}"><a class="nav-link" href="{{ route('cms-admin.data.daftarverifikator') }}"><i class="fa fa-users"></i> <span>Verifikator</span></a></li>
              </ul>
        </aside>
      </div>

      @include('sweetalert::alert')
      @yield('content')

      <footer class="main-footer">
        <div class="footer-left">
        Created by Roni Rahmadi & Gampang Rozaki
        </div>
        <div class="footer-right">
            Universitas Amikom Yogyakarta
        </div>
      </footer>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="https://cdn.tiny.cloud/1/jtna6wqgssh88n40erhsyp70l38h8mjytpqqs0z79fj0t6y9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>  
  <script src="{{ asset('js/app.js') }}"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
  <script src="{{ asset('js/stisla.js') }}"></script>
  <script src="{{ asset('js/scripts.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>
  <script src="{{ asset('js/addons/admin/dropdownid.js') }}"></script>
  <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
  @yield('scripts')
</body>
</html>
