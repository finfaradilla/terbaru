<?= $this->extend('Dashboard/layout') ?>

<?php
function tanggal($tanggal) {
    // Array bulan dalam bahasa Indonesia
    $bulanIndonesia = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );
    
    // Memisahkan bagian dari tanggal
    $parts = explode('-', $tanggal);
    $tahun = $parts[0];
    $bulan = intval($parts[1]);
    $hari = intval($parts[2]);

    // Mengubah format tanggal
    return "$hari " . $bulanIndonesia[$bulan] . " $tahun";
}
?>

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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="fa-solid fa-folder-plus"></i>
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data
                                                <?= $title ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= base_url('DataMaster/MasterObat/save') ?>" method="POST">
                                                <?= csrf_field() ?>
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label for="kode" class="form-label">Kode Obat</label>
                                                        <input type="text" class="form-control" name="kode"
                                                            id="kode">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nama" class="form-label">Nama Obat</label>
                                                        <input type="text" class="form-control" name="nama"
                                                            id="nama">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="satuan" class="form-label">Satuan Obat</label>
                                                        <select name="satuan" id="satuan" class="form-control">
                                                            <option value="">---Satuan---</option>
                                                            <option value="Ampul">Ampul</option>
                                                            <option value="Botol">Botol</option>
                                                            <option value="Kapsul">Kapsul</option>
                                                            <option value="Kaplet">Kaplet</option>
                                                            <option value="Sachet">Sachet</option>
                                                            <option value="Sub">Sub</option>
                                                            <option value="Tablet">Tablet</option>
                                                            <option value="Tube">Tube</option>
                                                            <option value="Vial">Vial</option>
                                                            <option value="Bungkus">Bungkus</option>
                                                            <option value="Kotak">Kotak</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="type" class="form-label">Type</label>
                                                        <select name="type" id="type" class="form-control">
                                                            <option value="">---Type---</option>
                                                            <option value="Generik">Generik</option>
                                                            <option value="Paten">Paten</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="harga_modal" class="form-label">Harga Modal</label>
                                                        <input type="number" class="form-control" name="harga_modal"
                                                            id="harga_modal">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="harga_jual" class="form-label">Harga Jual</label>
                                                        <input type="number" class="form-control" name="harga_jual"
                                                            id="harga_jual">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="stok" class="form-label">Stok</label>
                                                        <input type="number" class="form-control" name="stok"
                                                            id="stok">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exp_date" class="form-label">Exp Date</label>
                                                        <input type="date" class="form-control" name="exp_date"
                                                            id="exp_date">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="supplier" class="form-label">Supplier</label>
                                                        <select name="supplier" id="supplier" class="form-control">
                                                            <option value="">---Supplier---</option>
                                                            <?php
                                                                foreach ($data_supplier as $key => $value) {
                                                            ?>
                                                            <option value="<?= $value['id'] ?>"><?= $value['nama'] ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container py-3">
                            <?php 
                                if (!empty(session('errors'))) {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <ol>
                                    <?php 
                                        foreach (session('errors') as $key => $value) {
                                    ?>
                                    <li><?= $value ?></li>
                                    <?php 
                                        }
                                    ?>
                                </ol>
                            </div>
                            <?php 
                                }
                            ?>

                            <?php 
                                if (!empty(session('validation')['type'])) {
                            ?>
                            <div class="alert alert-<?= session('validation')['type'] ?>" role="alert">
                                <?= session('validation')['pesan'] ?>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>

                        <div class="card-body p-0">
                            <table class="table table-sm">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 4%;">No</th>
                                        <th style="width: 20%">Kode</th>
                                        <th>Nama Obat</th>
                                        <th>Satuan</th>
                                        <th>Type</th>
                                        <th>Harga Modal</th>
                                        <th>Harga Jual</th>
                                        <th>Qty</th>
                                        <th>Exp Date</th>
                                        <th>Supplier</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (!empty($data_obat)) {
                                            $no = 1;
                                            foreach ($data_obat as $key => $value) {
                                    ?>
                                    <tr class="align-middle text-center">
                                        <td style="width: 4%; text-align: center;"><?= $no++ ?></td>
                                        <td><strong><?= $value['kode'] ?></strong></td>
                                        <td><?= $value['nama'] ?></td>
                                        <td><?= $value['satuan'] ?></td>
                                        <td><?= $value['type'] ?></td>
                                        <td>Rp <?= number_format($value['harga_modal']) ?></td>
                                        <td>Rp <?= number_format($value['harga_jual']) ?></td>
                                        <td>
                                            (<?= $value['stok'] ?>) <small class="badge text-bg-<?= ($value['stok'] >= 5) ? 'success' : (($value['stok'] <= 0) ? 'danger' : 'warning') ?>"><?= ($value['stok'] >= 5 ) ? 'Tersedia' : (($value['stok'] <= 0) ? 'Habis' : 'Hampir Habis') ?></small>
                                        </td>
                                        <td><?= tanggal($value['exp_date']) ?></td>
                                        <td><?= $value['supplier'] ?></td>
                                        <td>
                                            <a href="<?= base_url('DataMaster/MasterObat/edit/'.$value['id']) ?>" class="btn btn-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <button onclick="deleteObat('<?= $value['kode'] ?>')" class="btn btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                            }
                                        } else {
                                    ?>
                                    <tr class="align-middle">
                                        <td colspan='11' style="width: 4%; text-align: center; padding-top: 10px">
                                            <h5><strong>Tidak Ada Data</strong></h5>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function deleteObat(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Apakah Yakin?",
            text: "Apkah Kamu Yakin Ingin Menghapus Data " + id,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yakin",
            cancelButtonText: "Tidak",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('DataMaster/MasterObat/delete') ?>',
                    type: 'POST',
                    data: {
                        kode: id,
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        swalWithBootstrapButtons.fire({
                            title: "Dibatalkan",
                            text: "Kode Obat " + id + ' Gagal Dihapus',
                            icon: "error"
                        });
                    }
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire({
                    title: "Dibatalkan",
                    text: "Kode Obat " + id + ' Gagal Dihapus',
                    icon: "error"
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>