

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginal46181af093c0588736b695b142193e4826bffbfd = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\HeaderBreadcrumb::class, ['header' => $title]); ?>
<?php $component->withName('header-breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal46181af093c0588736b695b142193e4826bffbfd)): ?>
<?php $component = $__componentOriginal46181af093c0588736b695b142193e4826bffbfd; ?>
<?php unset($__componentOriginal46181af093c0588736b695b142193e4826bffbfd); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

<?php if(Auth::guard('petugas')->check()): ?>
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
            <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Jumlah Petugas</h4>
            </div>
            <div class="card-body">
            <?php echo e($total_petugas); ?>

            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Jumlah Siswa</h4>
            </div>
            <div class="card-body">
                <?php echo e($jumlah_siswa); ?>

            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
            <i class="fas fa-money-bill"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
            <h4>Jumlah Dana SPP</h4>
            </div>
            <div class="card-body">
            Rp. <?php echo e(number_format($jml_dana_pembayaran, 0, '.', '.')); ?>

            </div>
        </div>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="row">
    <div class="col card p-5">
        <h2 class="text-center">Selamat Datang <?php echo e(Auth::guard('petugas')->check() ? Auth::guard('petugas')->user()->nama_petugas : Auth::guard('siswa')->user()->nama); ?></h2>
        <p class="mt-4">Selamat datang di aplikasi pembayaran SPP. Di sini anda bisa mengelola data pembayaran spp dengan mudah</p>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/tomy/E4B868F2B868C520/aplikasi-spp/resources/views/admin/pages/home/index.blade.php ENDPATH**/ ?>