<?= $this->extend('Auth/layout') ?>

<?= $this->section('content') ?>
<div class="login-box">
    <div class="login-logo"> 
        <img src="<?= base_url('uploads/logo/logo.png') ?>" class="p-3" width="140vh" alt="Logo">
        <img src="<?= base_url('uploads/logo/text-logo.png') ?>" width="240vh" class="p-3" alt="Logo">
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <?php if (!empty(session()->getFlashdata('validation')['type'])): ?>
            <div class="alert alert-<?= session()->getFlashdata('validation')['type'] ?>" role="alert">
                <?= session()->getFlashdata('validation')['pesan'] ?>
            </div>
            <?php endif; ?>
            <p class="login-box-msg">Masukan Akun Terdaftar</p>
            <form action="<?= base_url('Auth/auth_login') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="input-group mb-3">
                    <input type="email" name='email'
                        class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" placeholder="Email" value="<?= old('email') ?>">
                    <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                    <div class="invalid-feedback">
                        <?= session('errors.email') ?>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name='password'
                        class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>"
                        placeholder="Password">
                    <div class="invalid-feedback">
                        <?= session('errors.password') ?>
                    </div>
                </div>
                <div class="row d-flex justify-content-center pb-5">
                    <div class="col-4">
                        <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">Sign In</button> </div>
                    </div>
                </div>
            </form>
            <!-- <p class="mb-1">
                <a href="<?= base_url('Auth/forgot_password') ?>">Lupa Password</a>
            </p>
            <p class="mb-0">
                <a href="<?= base_url('Auth/register') ?>" class="text-center">
                    Daftar Akun
                </a>
            </p> -->
        </div>
    </div>
</div>
<?= $this->endSection() ?>