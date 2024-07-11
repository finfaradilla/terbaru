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
                            <div class="row">
                                <div class="col-sm">
                                    <a href="<?= base_url('Laporan/PeminjamanStatusRJ/exportCSV') ?>" class="btn btn-success">
                                        <i class="fa-solid fa-file-csv" style="padding-right: 5px"></i> Export CSV
                                    </a>
                                </div>
                                <div class="col-sm-2 pt-1">
                                    <input type="date" id="dateFilter" class="form-control me-2" onchange="filterTableByDate()" placeholder="Filter by Tanggal Masuk">
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
                                        <th>Foto</th>
                                        <th>No. RM</th>
                                        <th>Nama</th>
                                        <th>Poli</th>
                                        <th>Dokter</th>
                                        <th>Tanggal & Jam</th>
                                        <th>Tgl & Jam Kembali</th>
                                    </tr>
                                </thead>
                                <tbody id="dataTable">
                                    <?php
                                        if (!empty($data)) {
                                            $no = 1;
                                            foreach ($data as $key => $value) {
                                    ?>
                                    <tr class="align-middle text-center">
                                        <td style="width: 4%; text-align: center;"><?= $no++ ?></td>
                                        <!-- <td class="d-flex justify-content-center">
                                            <div class="image-profile-container">
                                                <img src="" alt="Profile">
                                            </div>
                                        </td> -->
                                        <td><?= $value['data_pasien']['no_rm'] ?></td>
                                        <td><?= $value['data_pasien']['nama'] ?></td>
                                        <td><?= $value['data_laporan']['poli'] ?></td>
                                        <td><?= $value['data_dokter']['nama'] ?></td>
                                        <td>
                                            <div class="text-center" style="color: black;">
                                                <i class="fa-solid fa-clock"></i>
                                            </div>
                                            <?= $value['data_laporan']['tanggal'] . ' Jam ' . $value['data_laporan']['jam'] ?>
                                        </td>
                                        <?php
                                            if ($value['data_laporan']['tanggal_kembali'] != null) {
                                        ?>
                                            <td>
                                                <div class="text-center" style="color: green;">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                </div>
                                                <?= $value['data_laporan']['tanggal_kembali'] . ' Jam ' . $value['data_laporan']['jam_kembali'] ?>
                                            </td>
                                        <?php
                                            } else {
                                        ?>
                                            <td>
                                                <p>Belum Kembali</p>
                                                <a href="<?= base_url('Laporan/PeminjamanStatusRJ/sudahKembali/') . $value['data_laporan']['id'] ?>" class="btn btn-primary">Sudah Kembali</a>
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

<script>
    function filterTableByDate() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("dateFilter");
        filter = input.value;
        table = document.getElementById("dataTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the filter query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[6]; // Column index for "Tanggal Masuk"
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.includes(filter)) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }       
        }
    }
</script>
<?= $this->endSection() ?>