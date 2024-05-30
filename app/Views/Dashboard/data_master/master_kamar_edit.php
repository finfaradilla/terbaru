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
        <a href="<?= base_url('Dashboard/master_kamar') ?>" class="btn btn-warning">Kembali</a>
    </div>
    <div class="app-content container py-5">
        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Data <strong><?= $data_kamar['kode'] ?></strong></div>
            </div>
            <form action="<?= base_url('DataMaster/MasterKamar/update') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Kamar</label>
                        <input type="text" class="form-control" name="kode" id="kode" value="<?= $data_kamar['kode'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Kamar</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $data_kamar['nama'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Nama Kamar</label>
                        <select name="kelas" id="kelas" class="form-control">
                            <option value="">---Pilih Kamar---</option>
                            <option value="Reguler" <?= ($data_kamar['kelas'] == 'Reguler') ? 'selected' : '' ?>>Reguler</option>
                            <option value="VIP A" <?= ($data_kamar['kelas'] == 'VIP A') ? 'selected' : '' ?>>VIP A</option>
                            <option value="VIP B" <?= ($data_kamar['kelas'] == 'VIP B') ? 'selected' : '' ?>>VIP B</option>
                            <option value="VIP C" <?= ($data_kamar['kelas'] == 'VIP C') ? 'selected' : '' ?>>VIP C</option>
                            <option value="VIP D" <?= ($data_kamar['kelas'] == 'VIP D') ? 'selected' : '' ?>>VIP D</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tarif" class="form-label">Tarif</label>
                        <input type="number" class="form-control" name="tarif" id="tarif" value="<?= $data_kamar['tarif'] ?>">
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