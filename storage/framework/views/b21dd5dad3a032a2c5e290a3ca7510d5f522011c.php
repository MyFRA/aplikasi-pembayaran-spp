

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
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4><?php echo e($title); ?></h4>
            </div>
            <div class="card-body">
                <?php if(Session::get('failed')): ?> 
                    <?php if (isset($component)) { $__componentOriginalb41a9f76cdbb797a0d9c929463ddbcbd7e7b2f9c = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AlertBootstrap::class, ['status' => 'failed','message' => Session::get('failed')]); ?>
<?php $component->withName('alert-bootstrap'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalb41a9f76cdbb797a0d9c929463ddbcbd7e7b2f9c)): ?>
<?php $component = $__componentOriginalb41a9f76cdbb797a0d9c929463ddbcbd7e7b2f9c; ?>
<?php unset($__componentOriginalb41a9f76cdbb797a0d9c929463ddbcbd7e7b2f9c); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                <?php endif; ?>
                <form action="<?php echo e(url('app-admin/siswa/' . $siswa->nisn . '/bayar/' . encrypt($spp->id_spp) . '/' . $month)); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="nisn" class="font-weight-bold">Nama Siswa <span class="text-danger">*</span></label>
                        <input type="text" placeholder="nama siswa" class="form-control" autocomplete="off" readonly="" value="<?php echo e($siswa->nama); ?>">
                        <input type="hidden" name="nisn" value="<?php echo e(encrypt($siswa->nisn)); ?>">
                    </div>
                    <div class="form-group">
                        <label for="id_spp" class="font-weight-bold">SPP Tahun Ajaran <span class="text-danger">*</span></label>
                        <input type="text" placeholder="tahun ajaran" class="form-control" autocomplete="off" readonly="" value="<?php echo e($spp->tahun_ajaran); ?>">
                        <input type="hidden" name="id_spp" value="<?php echo e(encrypt($spp->id_spp)); ?>">
                    </div>
                    <div class="form-group">
                        <label for="id_spp" class="font-weight-bold">SPP Bulan <span class="text-danger">*</span></label>
                        <input type="text" placeholder="bulan" class="form-control" autocomplete="off" readonly="" value="<?php echo e($month); ?>">
                        <input type="hidden" name="bulan_spp" value="<?php echo e($month); ?>">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_bayar" class="font-weight-bold">Jumlah Bayar</label>
                        <input type="text" name="jumlah_bayar" class="form-control <?php $__errorArgs = ['jumlah_bayar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="jumlah bayar" value="<?php echo e(old('jumlah_bayar')); ?>" id="jumlah_bayar" autocomplete="off" required max="<?php echo e($spp->nominal); ?>">
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-between">    
                        <button class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
                        <a href="<?php echo e(url('/app-admin/siswa/' . encrypt($siswa->nisn) . '/lihat-spp')); ?>" class="btn btn-dark">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->startSection('script'); ?>
<script>
    const jumlah_bayar = document.getElementById('jumlah_bayar');
    jumlah_bayar.addEventListener('keydown', function(event) {
        return isNumberKey(event);
    });
    jumlah_bayar.addEventListener('keyup', function() {
        jumlah_bayar.value = convertRupiah(this.value, 'Rp. ');
    });
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/tomy/E4B868F2B868C520/aplikasi-spp/resources/views/admin/pages/siswa/create-spp.blade.php ENDPATH**/ ?>