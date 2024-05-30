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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md">
                    <div class="card">

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

                        <div class="card-body">
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
                                                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a>
                                                    </li>
                                                    <li class="breadcrumb-item active" aria-current="page">
                                                        <?= $title ?>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <a href="<?= base_url('Dashboard/master_diagnosa') ?>"
                                        class="btn btn-warning">Kembali</a>
                                </div>
                                <div class="app-content container py-5">
                                    <div class="card card-primary card-outline mb-4">
                                        <div class="card-header">
                                            <div class="card-title">Data
                                                <strong><?= $data_pasien['kode'] ?></strong>
                                            </div>
                                        </div>
                                        <form action="<?= base_url('DataMaster/MasterAdministrasi/update') ?>"
                                            method="POST">
                                            <?= csrf_field() ?>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" name="nama" id="nama"
                                                        value="<?= $data_pasien['nama'] ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jenis_kelamin" class="form-label">Keterangan</label>
                                                    <select name="jenis_kelamin" id="jenis_kelamin">
                                                        <option value="">-----Pilih Jenis Kelamin-----</option>
                                                        <option value="L">Laki - Laki</option>
                                                        <option value="P">Perempuan</option>
                                                    </select>

                                                </div>
                                                <div class="mb-3">
                                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                                    <input type="date"
                                                        class="form-control <?= session('errors.tgl_lahir') ? 'is-invalid' : '' ?>"
                                                        name="tgl_lahir" id="tartgl_lahir" value="<?= $data_pasien['tgl_lahir'] ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.tgl_lahir') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <textarea name="alamat" id="alamat" class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>"></textarea>
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.alamat') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_tlp" class="form-label">No Telp</label>
                                                    <input type="text" class='form-control <?= session('errors.no_tlp') ? 'is-invalid' : '' ?>' name="no_tlp" id="no_tlp">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.no_tlp') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                                    <input type="text" class='form-control <?= session('errors.pekerjaan') ? 'is-invalid' : '' ?>' name="pekerjaan" id="pekerjaan">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.pekerjaan') ?>
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