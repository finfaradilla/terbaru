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
                        <div class="card-header">
                            <a href="<?= base_url('Laporan/PeminjamanstatusRI/exportCSV') ?>" class="btn btn-success">
                                <i class="fa-solid fa-file-csv" style="padding-right: 5px"></i> Export CSV
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
                                        <th>Foto</th>
                                        <th>No. RM</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Kamar</th>
                                        <th>Diagnosa</th>
                                        <th>Dokter</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Tanggal keluar</th>
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
                                        <td class="d-flex justify-content-center">
                                            <div class="image-profile-container">
                                                <img src="<?= base_url($value['data_pasien']['image']) ?>" alt="Profile">
                                            </div>
                                        </td>
                                        <td><?= $value['data_pasien']['no_rm'] ?></td>
                                        <td><?= $value['data_pasien']['nama'] ?></td>
                                        <td><?= $value['data_pasien']['alamat'] ?></td>
                                        <td><?= $value['data_kamar']['nama'] ?></td>
                                        <td><?= $value['data_laporan']['keluhan'] ?></td>
                                        <td><?= $value['data_dokter']['nama'] ?></td>
                                        <td>
                                            <div class="text-center" style="color: black;">
                                                <i class="fa-solid fa-clock"></i>
                                            </div>
                                            <?= $value['data_laporan']['tanggal_masuk'] . ' Jam ' . $value['data_laporan']['jam_masuk'] ?>
                                        </td>
                                        <?php
                                            if ($value['data_laporan']['tanggal_keluar'] != null) {
                                        ?>
                                            <td>
                                                <div class="text-center" style="color: green;">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                </div>
                                                <?= $value['data_laporan']['tanggal_keluar'] . ' Jam ' . $value['data_laporan']['jam_keluar'] ?>
                                            </td>
                                        <?php
                                            } else {
                                        ?>
                                            <td>
                                                <div class="text-center" style="color: red;">
                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                </div>
                                                Belum Pulang
                                            </td>
                                        <?php
                                            }
                                        ?>
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
<?= $this->endSection() ?>