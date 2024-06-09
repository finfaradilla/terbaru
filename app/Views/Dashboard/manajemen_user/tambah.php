<?= $this->extend('Dashboard/layout') ?>

<?= $this->section('content') ?>
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><?= $title ?></h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?= $title ?>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">
                            <main class="app-main">
                                <div class="container">
                                    <a href="<?= base_url('ManajemenUser') ?>"
                                        class="btn btn-warning">Kembali</a>
                                </div>
                                <div class="app-content container py-5">
                                    <div class="card card-primary card-outline mb-4">
                                        <div class="card-header">
                                            <div class="card-title"><?= $title ?></div>
                                        </div>
                                        <form action="<?= base_url('ManajemenUser/simpan') ?>" method="POST" enctype="multipart/form-data">
                                            <?= csrf_field() ?>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nama</label>
                                                    <input type="text" class="form-control <?= session('errors.name') ? 'is-invalid' : '' ?>" name="name" id="name" value="<?= old('name') ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.name') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="text" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" name="email" id="email" value="<?= old('email') ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.email') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_hp" class="form-label">No HP</label>
                                                    <input type="number" class="form-control <?= session('errors.no_hp') ? 'is-invalid' : '' ?>" name="no_hp" id="no_hp" value="<?= old('no_hp') ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.no_hp') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="text" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" name="password" id="password" value="<?= old('password') ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.password') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="role" class="form-label">Pilih Role</label>
                                                    <select name="role" id="role" class="form-control <?= session('errors.role') ? 'is-invalid' : '' ?>">
                                                        <option value="">Pilih Role</option>
                                                        <?php
                                                            foreach ($data_role as $key => $value) {
                                                        ?>
                                                            <option value="<?= $value['id'] ?>"><?= $value['nama'] ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.role') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Foto</label>
                                                    <input type="file" class="form-control <?= session('errors.image') ? 'is-invalid' : '' ?>" name="image" id="image">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.image') ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>