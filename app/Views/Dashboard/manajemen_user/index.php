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
                            <a href="<?= base_url('/ManajemenUser/tambah') ?>" class="btn btn-primary">
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
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No Hp</th>
                                        <th>Role</th>
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
                                        <td class="d-flex justify-content-center">
                                            <div class="image-profile-container">
                                                <img src="<?= base_url(($value['data_manajemen_user']['image'] == null) ? '/uploads/default/default.png' : $value['data_manajemen_user']['image']) ?>" alt="Profile">
                                            </div>
                                        </td>
                                        <td><?= $value['data_manajemen_user']['name'] ?> <?php if(session()->get('email') == $value['data_manajemen_user']['email']) { ?> <span class='badge text-bg-success'>Kamu</span> <?php } ?></td>
                                        <td><?= $value['data_manajemen_user']['email'] ?></td>
                                        <td><?= $value['data_manajemen_user']['no_hp'] ?></td>
                                        <td><?= "<span class='badge text-bg-primary'>".$value['data_role']['nama']."</span>" ?></td>
                                        <?php
                                            if ($value['data_manajemen_user']['email'] == session()->get('email')) {
                                        ?>
                                        <td width="10%">
                                            <a href="<?= base_url('ManajemenUser/edit/'.$value['data_manajemen_user']['id']) ?>" class="btn btn-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                        <?php
                                            } else {
                                        ?>
                                        <td width="10%">
                                            <a href="<?= base_url('ManajemenUser/edit/'.$value['data_manajemen_user']['id']) ?>" class="btn btn-warning">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <button onclick="deleteUsers('<?= $value['data_manajemen_user']['id'] ?>', '<?= $value['data_manajemen_user']['name'] ?>')" class="btn btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
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
    function deleteUsers(id, nama) {
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
                    url: '<?= base_url('ManajemenUser/delete') ?>',
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
                            text: "User " + nama + ' Gagal Dihapus',
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
                    text: "User " + nama + ' Gagal Dihapus',
                    icon: "error"
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>