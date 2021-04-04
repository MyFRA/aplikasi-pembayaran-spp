<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
  </form>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
      <?php if( Auth::guard('petugas')->check() ): ?>
        <img alt="image" src="<?php echo e(Auth::guard('petugas')->user()->photo ? asset('/storage/images/petugas/' . Auth::guard('petugas')->user()->photo) : asset('/images/icons/no-photo-rounded.png')); ?>" class="rounded-circle mr-1">
      <?php elseif( Auth::guard('siswa')->check() ): ?>
        <img alt="image" src="<?php echo e(Auth::guard('siswa')->user()->photo ? asset('/storage/images/siswa/' . Auth::guard('siswa')->user()->photo) : asset('/images/icons/no-photo-rounded.png')); ?>" class="rounded-circle mr-1">
      <?php endif; ?>
      <div class="d-sm-none d-lg-inline-block">Hi, <?php echo e(Auth::guard('petugas')->check() ? Auth::guard('petugas')->user()->nama_petugas : Auth::guard('siswa')->user()->nama); ?></div></a>
      <div class="dropdown-menu dropdown-menu-right">
        <?php if( Auth::guard('petugas')->check() ): ?>
        <a href="<?php echo e(url('/app-admin/petugas/' . encrypt(Auth::guard('petugas')->user()->id_petugas) . '/edit')); ?>" class="dropdown-item has-icon">
          <i class="far fa-user"></i> Edit Profil
        </a>
        <?php endif; ?>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item has-icon text-danger" onclick="logoutAction()">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav><?php /**PATH /media/tomy/E4B868F2B868C520/aplikasi-spp/resources/views/admin/layouts/partials/navbar.blade.php ENDPATH**/ ?>