<?php 
use App\Models\Kelas;

$sidebarKelass = Kelas::orderBy('nama_kelas', 'ASC')->get();

?>
<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="<?php echo e(url('/app-admin')); ?>">Aplikasi SPP</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="<?php echo e(url('/app-admin')); ?>">Spp</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>

        <li class="<?php echo e($sidebar == 'dashboard' ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('/app-admin')); ?>"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
        
        <?php if( Auth::guard('petugas')->check() ): ?>
        <?php if( Auth::guard('petugas')->user()->level == 'admin' ): ?>
            <li class="<?php echo e($sidebar == 'kompetensi-keahlian' ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('/app-admin/kompetensi-keahlian')); ?>"><i class="fas fa-laptop-code"></i> <span>Kompetensi Keahlian</span></a></li>
            <li class="<?php echo e($sidebar == 'kelas' ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('/app-admin/kelas')); ?>"><i class="fas fa-laptop-code"></i> <span>Kelas</span></a></li>
            <li class="<?php echo e($sidebar == 'spp' ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('/app-admin/spp')); ?>"><i class="fas fa-money-bill"></i> <span>SPP</span></a></li>
          <?php endif; ?>
          
          <li class="<?php echo e($sidebar == 'petugas' ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('/app-admin/petugas')); ?>"><i class="far fa-user"></i> <span>Petugas</span></a></li>  
      <?php endif; ?>
        <?php if(Auth::guard('siswa')->check()): ?>
        <li class="<?php echo e($title == 'Lihat SPP' ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('/app-admin/siswa/' . encrypt(Auth::guard('siswa')->user()->nisn) . '/lihat-spp')); ?>"><i class="fas fa-money-bill"></i> <span>Lihat SPP</span></a></li>
        <?php endif; ?>
        <li class="<?php echo e($sidebar == 'histori-pembayaran' ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(Auth::guard('petugas')->check() ? url('/app-admin/histori-pembayaran') : url('/app-admin/histori-pembayaran/siswa/' . Auth::guard('siswa')->user()->nisn)); ?>"><i class="fas fa-laptop-code"></i> <span>Histori Pembayaran</span></a></li>
        <?php if(Auth::guard('petugas')->check()): ?>
          <li class="<?php echo e($sidebar == 'siswa' ? 'active' : ''); ?> nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-graduation-cap"></i><span>Siswa</span></a>
            <ul class="dropdown-menu">
              <?php $__currentLoopData = $sidebarKelass; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sidebarKelas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a class="nav-link" href="<?php echo e(url('/app-admin/siswa/kelas/' . encrypt($sidebarKelas->id_kelas))); ?>"><?php echo e($sidebarKelas->nama_kelas); ?></a></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </li>
        <?php endif; ?>
      </ul>

      <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <a href="#" class="btn btn-danger btn-lg btn-block btn-icon-split" onclick="logoutAction()">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
  </aside>
</div><?php /**PATH /media/tomy/E4B868F2B868C520/aplikasi-spp/resources/views/admin/layouts/partials/sidebar.blade.php ENDPATH**/ ?>