<div>
    <script>
        <?php if( $status == 'success' ): ?> 
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?php echo e($message); ?>',
            })
        <?php else: ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?php echo e($message); ?>',
            })
        <?php endif; ?> 
    </script>
</div><?php /**PATH C:\xampp\htdocs\ujikom-tomy-wibowo-xii-rpl-1\aplikasi-spp\resources\views/components/alert.blade.php ENDPATH**/ ?>