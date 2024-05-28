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
        <a href="<?= base_url('Dashboard/master_poli') ?>" class="btn btn-warning">Kembali</a>
    </div>
    <div class="app-content container py-5">
        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Data <strong><?= $data_poli['kode'] ?></strong></div>
            </div>
            <form action="<?= base_url('DataMaster/MasterPoli/update') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Poli</label>
                        <input type="text" class="form-control" name="kode" id="kode" value="<?= $data_poli['kode'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Kode Poli</label>
                        <textarea name="keterangan" class="form-control <?= session('errors.keterangan') ? 'is-invalid' : '' ?>" id="keterangan"><?= $data_poli['keterangan'] ?></textarea>
                        <div class="invalid-feedback">
                            <?= session('errors.keterangan') ?>
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

<script>
function deletePoli(id) {
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
                url: '<?= base_url('DataMaster/MasterPoli/delete') ?>',
                type: 'POST',
                data: {
                    kode_poli: id,
                },
                success: function(response) {
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    swalWithBootstrapButtons.fire({
                        title: "Dibatalkan",
                        text: "Kode Poli " + id + ' Gagal Dihapus',
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
                text: "Kode Poli " + id + ' Gagal Dihapus',
                icon: "error"
            });
        }
    });
}
</script>
<?= $this->endSection() ?>