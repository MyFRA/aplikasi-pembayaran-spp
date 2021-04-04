

<?php $__env->startSection('content'); ?>
<div class="row">
<div class="col">
    <div class="card">
        <div class="card-header">
            <h4>List Data <?php echo e($title); ?></h4>
        </div>
        <div class="card-body">
        <h3 class="mb-4">Daftar SPP Siswa: <?php echo e($siswa->nama); ?></h3>


        <h3 class="mt-5 mb-3">SPP TAHUN AJARAN</h3>
        <div id="accordion">
            <?php $__currentLoopData = $all_spp_payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $all_spp_payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="accordion">
                    <div class="accordion-header collapsed" role="button" data-toggle="collapse" data-target="#panel-body-<?php echo e($index); ?>" aria-expanded="false">
                        <h4 style="font-size: 1.35rem"><?php echo e($all_spp_payment['spp']->tahun_ajaran); ?></h4>
                    </div>

                    <div class="accordion-body collapse" id="panel-body-<?php echo e($index); ?>" data-parent="#accordion">
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tbody id="table-body">
                                    <tr>
                                        <th>Bulan</th>
                                        <th>Status</th>
                                        <th>Total Bayar</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php $__currentLoopData = $all_spp_payment['months']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($month['bulan']); ?></td>
                                            <td>
                                                <?php if( $month['status'] == 'Belum Bayar' ): ?>
                                                    <button class="btn btn-sm btn-danger"><?php echo e($month['status']); ?></button>
                                                <?php elseif( $month['status'] == 'Belum Lunas' ): ?>
                                                    <button class="btn btn-sm btn-primary"><?php echo e($month['status']); ?></button>
                                                    <button class="btn btn-sm btn-dark">Kekurangan Rp. <?php echo e(number_format($all_spp_payment['spp']->nominal - $month['total_bayar'], 0, '.', '.')); ?></button>
                                                <?php elseif( $month['status'] == 'Lunas' ): ?>
                                                    <button class="btn btn-sm btn-success"><?php echo e($month['status']); ?></button>
                                                <?php endif; ?>
                                                <button class="btn btn-sm btn-"></button>
                                            </td>
                                            <td>Rp. <?php echo e(number_format($month['total_bayar'], 0, '.', '.')); ?></td>
                                            <td>
                                                <?php if( $month['status'] != 'Lunas' ): ?>
                                                    <?php if( Auth::guard('petugas')->check() ): ?>
                                                        <a class="btn btn-sm btn-success" href="<?php echo e($month['link_add_pembayaran']); ?>">Bayar Sekarang</a>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if( $month['status'] != 'Belum Bayar' ): ?>
                                                    <a class="btn btn-sm btn-primary" href="<?php echo e(url('/app-admin/histori-pembayaran/siswa/' . $month['id_pembayaran'] . '/pembayaran')); ?>">Lihat Histori</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        </div>
    </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/tomy/E4B868F2B868C520/aplikasi-spp/resources/views/admin/pages/siswa/lihat-spp.blade.php ENDPATH**/ ?>