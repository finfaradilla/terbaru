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
    <div class="container">
        <a href="<?= base_url('Dashboard/master_diagnosa') ?>" class="btn btn-warning">Kembali</a>
    </div>
    <div class="app-content container py-5">
        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Data <strong><?= $data_administrasi['kode'] ?></strong></div>
            </div>
            <form action="<?= base_url('DataMaster/MasterAdministrasi/update') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Administrasi</label>
                        <input type="text" class="form-control" name="kode" id="kode" value="<?= $data_administrasi['kode'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control <?= session('errors.keterangan') ? 'is-invalid' : '' ?>" id="keterangan"><?= $data_administrasi['keterangan'] ?></textarea>
                        <div class="invalid-feedback">
                            <?= session('errors.keterangan') ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="tarif" class="form-label">Tarif</label>
                        <input type="text" class="form-control <?= session('errors.tarif') ? 'is-invalid' : '' ?>" name="tarif" id="tarif" value="<?= $data_administrasi['tarif'] ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.tarif') ?>
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
<?= $this->endSection() ?>