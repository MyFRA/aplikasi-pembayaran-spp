<?php 
use App\Models\Kelas;

$sidebarKelass = Kelas::orderBy('nama_kelas', 'ASC')->get();

?>
<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ url('/app-admin') }}">Aplikasi SPP</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ url('/app-admin') }}">Spp</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>

        <li class="{{ $sidebar == 'dashboard' ? 'active' : '' }}"><a class="nav-link" href="{{ url('/app-admin') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
        
        @if( Auth::guard('petugas')->check() )
        @if( Auth::guard('petugas')->user()->level == 'admin' )
            <li class="{{ $sidebar == 'kompetensi-keahlian' ? 'active' : '' }}"><a class="nav-link" href="{{ url('/app-admin/kompetensi-keahlian') }}"><i class="fas fa-laptop-code"></i> <span>Kompetensi Keahlian</span></a></li>
            <li class="{{ $sidebar == 'kelas' ? 'active' : '' }}"><a class="nav-link" href="{{ url('/app-admin/kelas') }}"><i class="fas fa-laptop-code"></i> <span>Kelas</span></a></li>
            <li class="{{ $sidebar == 'spp' ? 'active' : '' }}"><a class="nav-link" href="{{ url('/app-admin/spp') }}"><i class="fas fa-money-bill"></i> <span>SPP</span></a></li>
          @endif
          
          <li class="{{ $sidebar == 'petugas' ? 'active' : '' }}"><a class="nav-link" href="{{ url('/app-admin/petugas') }}"><i class="far fa-user"></i> <span>Petugas</span></a></li>  
      @endif
        @if(Auth::guard('siswa')->check())
        <li class="{{ $title == 'Lihat SPP' ? 'active' : '' }}"><a class="nav-link" href="{{ url('/app-admin/siswa/' . encrypt(Auth::guard('siswa')->user()->nisn) . '/lihat-spp') }}"><i class="fas fa-money-bill"></i> <span>Lihat SPP</span></a></li>
        @endif
        <li class="{{ $sidebar == 'histori-pembayaran' ? 'active' : '' }}"><a class="nav-link" href="{{ Auth::guard('petugas')->check() ? url('/app-admin/histori-pembayaran') : url('/app-admin/histori-pembayaran/siswa/' . Auth::guard('siswa')->user()->nisn) }}"><i class="fas fa-laptop-code"></i> <span>Histori Pembayaran</span></a></li>
        @if(Auth::guard('petugas')->check())
          <li class="{{ $sidebar == 'siswa' ? 'active' : '' }} nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-graduation-cap"></i><span>Siswa</span></a>
            <ul class="dropdown-menu">
              @foreach($sidebarKelass as $sidebarKelas)
                <li><a class="nav-link" href="{{ url('/app-admin/siswa/kelas/' . encrypt($sidebarKelas->id_kelas)) }}">{{ $sidebarKelas->nama_kelas }}</a></li>
              @endforeach
            </ul>
          </li>
        @endif
      </ul>

      <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <a href="#" class="btn btn-danger btn-lg btn-block btn-icon-split" onclick="logoutAction()">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
  </aside>
</div>