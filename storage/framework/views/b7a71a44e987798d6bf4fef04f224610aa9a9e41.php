
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('/admin/assets/css/login.css')); ?>">
    <title>Login Siswa</title>
</head>
<body>
    <div class="container">
        <div class="login-wrapper">
            <div class="bg-people-wrapper bg-login-siswa">
            </div>
            <div class="form-login-wrapper">
                <div class="inner-form-login-wrapper">
                    <form action="" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="logo-text-section">
                            <img src="<?php echo e(asset('/admin/assets/img/logo-smk.png')); ?>" alt="logo">
                            <h3>Masuk Siswa</h3>
                        </div>
                        <div class="form-section">
                            <?php if(Session::get('failed')): ?>
                                <div style="background-color: #FC544B; color: #fff; padding: 10px; font-size: 13px; margin-bottom: 14px; border-radius: 5px">
                                    <?php echo e(Session::get('failed')); ?>

                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <input type="nama" name="nama" id="nama" placeholder="nama" class="" value="">
                            </div>
                            <div class="form-group">
                                <input type="nisn" name="nisn" id="nisn" placeholder="nisn" class="" value="">
                            </div>
                            <div class="form-group">
                                <button type="submit">Masuk</button>
                                <span class="back">Kembali ke <a href="<?php echo e(url('/')); ?>">Halaman Utama</a></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH /media/tomy/E4B868F2B868C520/aplikasi-spp/resources/views/auth/siswa/login.blade.php ENDPATH**/ ?>