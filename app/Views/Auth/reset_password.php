<?= $this->extend('Auth/layout') ?>

<?= $this->section('content') ?>
<div class="register-box">
    <div class="register-logo"> <a href="../index2.html"><b>Admin</b>LTE</a> </div> <!-- /.register-logo -->
    <div class="card">
        <div class="card-body register-card-body">
            <?php if (!empty(session()->getFlashdata('validation')['type'])): ?>
            <div class="alert alert-<?= session()->getFlashdata('validation')['type'] ?>" role="alert">
                <?= session()->getFlashdata('validation')['pesan'] ?>
            </div>
            <?php endif; ?>
            <p class="register-box-msg">Reset Password</p>
            <form action="<?= base_url('Auth/auth_reset_password') ?>" method="post" class="pb-5">
                <div class="input-group mb-3">
                    <input type="email" name='email' class="form-control" placeholder="Email" value="<?= (!empty($email)) ? $email : old('email') ?>" readonly>
                    <input type="hidden" name='token' class="form-control" value="<?= (!empty($token)) ? $token : old('token') ?>" readonly>
                    <div class="input-group-text">
                        <span class="bi bi-envelope"></span>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name='password' class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" placeholder="Password Baru">
                    <div class="invalid-feedback">
                        <?= session('errors.password') ?>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                    </div>
                </div>
            </form>
            <p class="mb-0">
                <a href="<?= base_url('Auth') ?>" class="text-center">
                    Sudah Miliki Akun
                </a>
            </p>
            <p class="mb-0">
                <a href="<?= base_url('Auth/register') ?>" class="text-center">
                    Daftar Akun
                </a>
            </p>
        </div> 
    </div>
</div>
<?= $this->endSection() ?>