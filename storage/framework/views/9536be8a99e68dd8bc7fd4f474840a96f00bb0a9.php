

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
                <form action="<?php echo e(url('/app-admin/kelas')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="nama_kelas" class="font-weight-bold">Nama Kelas <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kelas" class="form-control <?php $__errorArgs = ['nama_kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('nama_kelas')); ?>" placeholder="nama kelas" autocomplete="off">
                    
                        <?php $__errorArgs = ['nama_kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group">
                        <label for="id_kompetensi_keahlian" class="font-weight-bold">Kompetensi Keahlian <span class="text-danger">*</span></label>
                        <select class="js-example-basic-single" name="id_kompetensi_keahlian" required="">
                          <?php $__currentLoopData = $kompetensi_keahlian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kompetensi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e(encrypt($kompetensi->id_kompetensi_keahlian)); ?>"
                                <?php if( old('id_kompetensi_keahlian') ): ?>
                                    <?php echo e(decrypt(old('id_kompetensi_keahlian')) == $kompetensi->id_kompetensi_keahlian ? 'selected' : ''); ?>

                                <?php endif; ?>
                             ><?php echo e($kompetensi->nama_kompetensi_keahlian); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group d-flex justify-content-between">    
                        <button class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
                        <a href="<?php echo e(url('/app-admin/kelas')); ?>" class="btn btn-dark">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('stylesheet'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/tomy/E4B868F2B868C520/aplikasi-spp/resources/views/admin/pages/kelas/create.blade.php ENDPATH**/ ?>