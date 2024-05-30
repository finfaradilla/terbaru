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
        <a href="<?= base_url('Dashboard/master_obat') ?>" class="btn btn-warning">Kembali</a>
    </div>
    <div class="app-content container py-5">
        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Data <strong><?= $data_obat['kode'] ?></strong></div>
            </div>
            <form action="<?= base_url('DataMaster/MasterObat/update') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Obat</label>
                        <input type="text" class="form-control" name="kode" id="kode" value="<?= $data_obat['kode'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Obat</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $data_obat['nama'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan Obat</label>
                        <select name="satuan" id="satuan" class="form-control">
                            <option value="">---Satuan---</option>
                            <option value="Ampul" <?= ('Ampul' == $data_obat['satuan']) ? 'selected' : '' ?>>Ampul</option>
                            <option value="Botol" <?= ('Botol' == $data_obat['satuan']) ? 'selected' : '' ?>>Botol</option>
                            <option value="Kapsul" <?= ('Kapsul' == $data_obat['satuan']) ? 'selected' : '' ?>>Kapsul</option>
                            <option value="Kaplet" <?= ('Kaplet' == $data_obat['satuan']) ? 'selected' : '' ?>>Kaplet</option>
                            <option value="Sachet" <?= ('Sachet' == $data_obat['satuan']) ? 'selected' : '' ?>>Sachet</option>
                            <option value="Sub" <?= ('Sub' == $data_obat['satuan']) ? 'selected' : '' ?>>Sub</option>
                            <option value="Tablet" <?= ('Tablet' == $data_obat['satuan']) ? 'selected' : '' ?>>Tablet</option>
                            <option value="Tube" <?= ('Tube' == $data_obat['satuan']) ? 'selected' : '' ?>>Tube</option>
                            <option value="Vial" <?= ('Vial' == $data_obat['satuan']) ? 'selected' : '' ?>>Vial</option>
                            <option value="Bungkus" <?= ('Bungkus' == $data_obat['satuan']) ? 'selected' : '' ?>>Bungkus</option>
                            <option value="Kotak" <?= ('Kotak' == $data_obat['satuan']) ? 'selected' : '' ?>>Kotak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="">---Type---</option>
                            <option value="Generik" <?= ('Generik' == $data_obat['type']) ? 'selected' : '' ?>>Generik</option>
                            <option value="Paten" <?= ('Paten' == $data_obat['type']) ? 'selected' : '' ?>>Paten</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="harga_modal" class="form-label">Harga Modal</label>
                        <input type="number" class="form-control" name="harga_modal" id="harga_modal" value="<?= $data_obat['harga_modal'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="harga_jual" class="form-label">Harga Jual</label>
                        <input type="number" class="form-control" name="harga_jual" id="harga_jual" value="<?= $data_obat['harga_jual'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stok" id="stok" value="<?= $data_obat['stok'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exp_date" class="form-label">Exp Date</label>
                        <input type="date" class="form-control" name="exp_date" id="exp_date" value="<?= $data_obat['exp_date'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="supplier" class="form-label">Supplier</label>
                        <select name="supplier" id="supplier" class="form-control">
                            <option value="">---Supplier---</option>
                            <?php
                               foreach ($data_supplier as $key => $value) {
                            ?>
                            <option value="<?= $value['kode'] ?>" <?= ($value['kode'] == $data_obat['supplier']) ? 'selected' : '' ?>><?= $value['nama'] ?></option>
                            <?php
                                }
                            ?>
                        </select>
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