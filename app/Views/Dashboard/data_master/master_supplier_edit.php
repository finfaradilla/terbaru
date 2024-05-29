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
        <a href="<?= base_url('Dashboard/master_supplier') ?>" class="btn btn-warning">Kembali</a>
    </div>
    <div class="app-content container py-5">
        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Data <strong><?= $data_supplier['kode'] ?></strong></div>
            </div>
            <form action="<?= base_url('DataMaster/MasterSupplier/update') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Supplier</label>
                        <input type="text" class="form-control" name="kode" id="kode" value="<?= $data_supplier['kode'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" name="nama" id="nama" value="<?= $data_supplier['nama'] ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.nama') ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>" id="alamat"><?= $data_supplier['alamat'] ?></textarea>
                        <div class="invalid-feedback">
                            <?= session('errors.alamat') ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="sales" class="form-label">Sales Rep</label>
                        <input type="text" class="form-control <?= session('errors.sales') ? 'is-invalid' : '' ?>" name="sales" id="sales" value="<?= $data_supplier['sales'] ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.sales') ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="no_tlp" class="form-label">No Tlp</label>
                        <input type="text" class="form-control <?= session('errors.no_tlp') ? 'is-invalid' : '' ?>" name="no_tlp" id="no_tlp" value="<?= $data_supplier['no_tlp'] ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.no_tlp') ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" name="email" id="email" value="<?= $data_supplier['email'] ?>">
                        <div class="invalid-feedback">
                            <?= session('errors.email') ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</main>
<?= $this->endSection() ?>