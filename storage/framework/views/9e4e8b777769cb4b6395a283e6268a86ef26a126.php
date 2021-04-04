<!DOCTYPE html>
<html lang="en">
<?php echo $__env->make('admin.layouts.partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('stylesheet'); ?>
<body style="background: #ededed">
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>

        <!-- Navbar -->
          <?php echo $__env->make('admin.layouts.partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End of Navbar -->
        
        <!-- Sidebar -->
          <?php echo $__env->make('admin.layouts.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End of Sidebar -->

        <!-- Main Content -->
        <div class="main-content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!-- End of Main Content -->

        <!-- Form -->
        <form method="POST" action="" id="form-delete">
          <?php echo csrf_field(); ?>
          <?php echo method_field('DELETE'); ?>
        </form>

        <form method="POST" action="<?php echo e(url('/app-admin/logout')); ?>" id="admin-form-logout">
          <?php echo csrf_field(); ?>
        </form>
        <!-- End of Form -->
        
        <!-- Footer -->
        <?php echo $__env->make('admin.layouts.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End of Footer -->

        <?php $__env->startSection('script'); ?>
          <?php if(Session::get('failed')): ?>
              <?php if (isset($component)) { $__componentOriginald4c8f106e1e33ab85c5d037c2504e2574c1b0975 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Alert::class, ['status' => 'failed','message' => Session::get('failed')]); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginald4c8f106e1e33ab85c5d037c2504e2574c1b0975)): ?>
<?php $component = $__componentOriginald4c8f106e1e33ab85c5d037c2504e2574c1b0975; ?>
<?php unset($__componentOriginald4c8f106e1e33ab85c5d037c2504e2574c1b0975); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
          <?php endif; ?>

          <?php if(Session::get('success')): ?>
              <?php if (isset($component)) { $__componentOriginald4c8f106e1e33ab85c5d037c2504e2574c1b0975 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Alert::class, ['status' => 'success','message' => Session::get('success')]); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginald4c8f106e1e33ab85c5d037c2504e2574c1b0975)): ?>
<?php $component = $__componentOriginald4c8f106e1e33ab85c5d037c2504e2574c1b0975; ?>
<?php unset($__componentOriginald4c8f106e1e33ab85c5d037c2504e2574c1b0975); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
          <?php endif; ?>
        <?php $__env->stopSection(); ?>

        <!-- Page Specified Script -->
        <?php echo $__env->yieldContent('script'); ?>
        <!-- End of Specified Script -->

    </div>
  </div>
</body>
</html>
<?php /**PATH /media/tomy/E4B868F2B868C520/aplikasi-spp/resources/views/admin/layouts/app.blade.php ENDPATH**/ ?>