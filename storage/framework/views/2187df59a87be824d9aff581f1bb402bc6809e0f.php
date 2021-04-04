

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
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4>List Data <?php echo e($title); ?></h4>
            </div>
            <div class="card-body">
                <a href="<?php echo e(url('/app-admin/histori-pembayaran/cetak/index')); ?>" class="btn btn-sm btn-primary mb-3">Cetak Histori Pembayaran</a>
                <?php if(Session::get('success')): ?>
                    <?php if (isset($component)) { $__componentOriginalb41a9f76cdbb797a0d9c929463ddbcbd7e7b2f9c = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AlertBootstrap::class, ['status' => 'success','message' => Session::get('success')]); ?>
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

                <?php if( $logPembayarans->isEmpty() ): ?>
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="row w-100">
                            <div class="col-10 offset-1 col-lg-4 offset-lg-4">
                                <img src="<?php echo e(asset('/admin/assets/img/No data-amico.svg')); ?>" class="w-100">
                            </div>
                        </div>
                        <h2>Tidak ada data</h2>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>ID Pembayaran</th>
                                    <th>Petugas</th>
                                    <th>Siswa</th>
                                    <th>Tgl Bayar</th>
                                    <th>Jumlah Bayar</th>
                                    <th>SPP Tahun</th>
                                    <th>Spp Bulan</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php $__currentLoopData = $logPembayarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pembayaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration + $logPembayarans->firstItem() - 1); ?></td>
                                    <td><?php echo e((string) $pembayaran->id_log_pembayaran); ?></td>
                                    <td><?php echo e($pembayaran->nama_petugas); ?></td>
                                    <td><?php echo e($pembayaran->nama); ?></td>
                                    <td><?php echo e($pembayaran->tgl_bayar); ?></td>
                                    <td>Rp. <?php echo e(number_format($pembayaran->jumlah_bayar, 0, '.', '.')); ?></td>
                                    <td><?php echo e($pembayaran->tahun_ajaran); ?></td>
                                    <td><?php echo e($pembayaran->bulan_spp); ?></td>
                                    <td>
                                        <a href="<?php echo e(url('/app-admin/histori-pembayaran/' . $pembayaran->id_log_pembayaran)); ?>" class="btn btn-sm btn-success"><i class="fas fa-eye"></i> Detail Log Pembayaran</a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-footer text-left mb-4">
                <?php echo e($logPembayarans->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/tomy/E4B868F2B868C520/aplikasi-spp/resources/views/admin/pages/histori-pembayaran/index.blade.php ENDPATH**/ ?>