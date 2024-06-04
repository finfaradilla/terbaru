<?= $this->extend('Dashboard/layout') ?>

<?php
function tanggal($tanggal) {
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
    $parts = explode('-', $tanggal);
    $tahun = $parts[0];
    $bulan = intval($parts[1]);
    $hari = intval($parts[2]);
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
                            <a href="<?= base_url('/RawatInap/tambah') ?>" class="btn btn-primary">
                                <i class="fa-solid fa-folder-plus"></i>
                            </a>
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
                                        <th>No Pendaftar</th>
                                        <th>Foto</th>
                                        <th>No RM</th>
                                        <th>Nama Pasien</th>
                                        <th>Type Faskes</th>
                                        <th>Keluhan Utama</th>
                                        <th>Tgl & Jam Masuk</th>
                                        <th>Kamar</th>
                                        <th>Sudah Pulang</th>
                                        <th>Dokter</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (!empty($data)) {
                                            $no = 1;
                                            foreach ($data as $key => $value) {
                                    ?>
                                    <tr class="align-middle text-center">
                                        <td style="width: 4%; text-align: center;"><?= $no++ ?></td>
                                        <td><?= $value['data_rawat_inap']['no_pendaftaran'] ?></td>
                                        <td class="d-flex justify-content-center">
                                            <div class="image-profile-container">
                                                <img src="<?= base_url($value['data_pasien']['image']) ?>" alt="Profile">
                                            </div>
                                        </td>
                                        <td><?= $value['data_pasien']['no_rm'] ?></td>
                                        <td><?= $value['data_pasien']['nama'] ?></td>
                                        <td><?= ($value['data_rawat_inap']['type'] == 'BPJS') ? "<span class='badge text-bg-success'>".$value['data_rawat_inap']['type'].'</span>' : "<span class='badge text-bg-primary'>".$value['data_rawat_inap']['type']."</span>" ?></td>
                                        <td><?= $value['data_rawat_inap']['keluhan'] ?></td>
                                        <td width='10%'><?= $value['data_rawat_inap']['tgl_masuk'] . " Jam " . $value['data_rawat_inap']['jam_masuk'] ?></td>
                                        <td><?= $value['data_kamar']['nama'] . " | " . $value['data_kamar']['kelas']?></td>
                                        <td><?= ($value['data_rawat_inap']['tgl_keluar'] != null) ? $value['data_rawat_inap']['tgl_keluar'] . ' Jam ' . $value['data_rawat_inap']['jam_keluar'] : "<span class='badge text-bg-warning'>Belum Pulang</span><br>" ?> <?php if($value['data_rawat_inap']['tgl_keluar'] == null) { ?><button onclick="pulangkan('<?= $value['data_rawat_inap']['id'] ?>', '<?= $value['data_rawat_inap']['no_pendaftaran'] ?>')" class='btn btn-primary m-2' style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Pulangkan</button><?php }?></td>
                                        <td><?= $value['data_dokter']['nama'] ?></td>
                                        <td width="12%">
                                            <a href="<?= base_url('RawatInap/edit/'.$value['data_rawat_inap']['id']) ?>" class="btn btn-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <button onclick="deleteRawatInap('<?= $value['data_rawat_inap']['id'] ?>', '<?= $value['data_rawat_inap']['no_pendaftaran'] ?>')" class="btn btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    

                                    <?php
                                            }
                                        } else {
                                    ?>
                                    <tr class="align-middle">
                                        <td colspan='12' style="width: 4%; text-align: center; padding-top: 10px">
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
    function deleteRawatInap(id, nama) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Apakah Yakin?",
            text: "Apkah Kamu Yakin Ingin Menghapus Data " + nama,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yakin",
            cancelButtonText: "Tidak",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('RawatInap/delete') ?>',
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
                            text: "No Pendafataran " + nama + ' Gagal Dihapus',
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
                    text: "No Pendafataran " + nama + ' Gagal Dihapus',
                    icon: "error"
                });
            }
        });
    }

    function pulangkan(id, nama) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Apakah Yakin?",
            text: "Apkah Kamu Yakin Ingin Menghapus Data " + nama,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yakin",
            cancelButtonText: "Tidak",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('RawatInap/pulangkan') ?>',
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
                            text: "No Pendafataran " + nama + ' Gagal Pulangkan',
                            icon: "error"
                        });
                    }
                });
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire({
                    title: "Dibatalkan",
                    text: "No Pendafataran " + nama + ' Gagal Dihapus',
                    icon: "error"
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>