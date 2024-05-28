<?= $this->extend('Auth/layout') ?>

<?= $this->section('content') ?>
<div class="register-box">
    <div class="register-logo"> <a href="../index2.html"><b>Admin</b>LTE</a> </div> <!-- /.register-logo -->
    <div class="card">
        <div class="card-body register-card-body">
            <p class="register-box-msg">Daftar Akun</p>
            <form action="<?= base_url('Auth/auth_register') ?>" method="post" class="pb-5">
                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control <?= session('errors.name') ? 'is-invalid' : '' ?>" placeholder="Full Name" value="<?= old('name') ?>">
                    <div class="input-group-text">
                        <span class="bi bi-person"></span>
                    </div>
                    <div class="invalid-feedback">
                        <?= session('errors.name') ?>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" name='email' class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" placeholder="Email" value="<?= old('email') ?>">
                    <div class="input-group-text">
                        <span class="bi bi-envelope"></span>
                    </div>
                    <div class="invalid-feedback">
                        <?= session('errors.email') ?>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" placeholder="Password">
                    <div class="input-group-text">
                        <span class="bi bi-lock-fill"></span>
                    </div>
                    <div class="invalid-feedback">
                        <?= session('errors.password') ?>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-4">
                        <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">Daftar</button> </div>
                    </div>
                </div>
            </form>
            <p class="mb-0">
                <a href="<?= base_url('Auth') ?>" class="text-center">
                    Sudah Miliki Akun
                </a>
            </p>
        </div> 
    </div>
</div>
<?= $this->endSection() ?>