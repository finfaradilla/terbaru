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
                            <div class="row">
                                <div class="col-sm">
                                    <a href="<?= base_url('/Pasien/tambah') ?>" class="btn btn-primary">
                                        <i class="fa-solid fa-folder-plus"></i>
                                    </a>
                                </div>
                                <div class="col-sm-2 pt-1">
                                    <input type="text" id="searchBar" class="form-control mb-3" onkeyup="searchTable()" placeholder="Cari Pasien...">
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
                                        <th style="width: 10%">Foto</th>
                                        <th>No RM</th>
                                        <th>BPJS</th>
                                        <th>Nama Pasien</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Tempat Lahir</th>
                                        <th>Alamat</th>
                                        <th>No Telp</th>
                                        <th>Pekerjaan</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="dataTable">
                                    <?php
                                        if (!empty($data_pasien)) {
                                            $no = 1;
                                            foreach ($data_pasien as $key => $value) {
                                    ?>
                                    <tr class="align-middle text-center">
                                        <td style="width: 4%; text-align: center;"><?= $no++ ?></td>
                                        <td class="d-flex justify-content-center">
                                            <div class="image-profile-container">
                                                <img src="<?= base_url($value['image']) ?>" alt="Profile">
                                            </div>
                                        </td>
                                        <td><?= $value['no_rm'] ?></td>
                                        <td><?= ($value['bpjs'] != null) ? "<span class='badge text-bg-success'>BPJS: ".substr($value['bpjs'], 0, 5).'</span>' : "<span class='badge text-bg-primary'>Umum</span>" ?>
                                        </td>
                                        <td><?= $value['nama'] ?></td>
                                        <td><?= $value['jenis_kelamin'] ?></td>
                                        <td><?= $value['tgl_lahir'] ?></td>
                                        <td><?= $value['tempat_lahir'] ?></td>
                                        <td><?= $value['alamat'] ?></td>
                                        <td><?= $value['no_tlp'] ?></td>
                                        <td><?= $value['pekerjaan'] ?></td>
                                        <td>
                                            <a href="<?= base_url('Pasien/edit/'.$value['id']) ?>"
                                                class="btn btn-warning m-1">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <button onclick="deletePasien('<?= $value['id'] ?>')"
                                                class="btn btn-danger m-1">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            <a href="<?= base_url('RawatInap/tambahRI/'.$value['id']) ?>"
                                                class="btn btn-primary m-1">
                                                +RI
                                            </a>
                                            <a href="<?= base_url('RawatJalan/tambahRJ/'.$value['id']) ?>"
                                                class="btn btn-primary m-1">
                                                +RJ
                                            </a>
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
function deletePasien(id) {
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
                url: '<?= base_url('Pasien/delete') ?>',
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
                        text: "Pasien " + id + ' Gagal Dihapus',
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
                text: "Pasien " + id + ' Gagal Dihapus',
                icon: "error"
            });
        }
    });
}
</script>

<script>
function searchTable() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchBar");
    filter = input.value.toUpperCase();
    table = document.getElementById("dataTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[4]; // Column index for "Nama Pasien"
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>
<?= $this->endSection() ?>