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
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Dashboard
                        </li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div class="col-lg-3 col-6">
                    <!--begin::Small Box Widget 1-->
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3><?= count($dataPasien); ?></h3>
                            <p>Pasien Terdaftar</p>
                        </div>
                        <div class="small-box-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <a href="<?= base_url('/Pasien') ?>" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                    <!--end::Small Box Widget 1-->
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3><?= count($dataDokter); ?></h3>
                            <p>Dokter</p>
                        </div>
                        <div class="small-box-icon">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <a href="<?= base_url('Dashboard/master_dokter') ?>" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                    <!--end::Small Box Widget 2-->
                </div>
                <!--end::Col-->
                <div class="col-lg-3 col-6">
                    <!--begin::Small Box Widget 3-->
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3><?= $jlm_rawat_jalan ?></h3>
                            <p>Rawat Jalan (Hari Ini)</p>
                        </div>
                        <div class="small-box-icon">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <a href="#" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">More info<i class="bi bi-link-45deg"></i> </a>
                    </div>
                </div>
                <!--end::Col-->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3><?= $jlm_rawat_inap ?></h3>
                            <p>Rawat Inap</p>
                        </div>
                        <div class="small-box-icon">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <a href="<?= base_url('RawatInap') ?>" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"> More info <i class="bi bi-link-45deg"></i> </a>
                    </div>
                </div>
                <!--end::Col-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>
<?= $this->endSection() ?>