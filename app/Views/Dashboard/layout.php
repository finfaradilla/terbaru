<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>E-Klinik | <?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE v4 | Dashboard">
    <meta name="author" content="ColorlibHQ">
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard">
    <script src="https://kit.fontawesome.com/111b8c6336.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css"
        integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css"
        integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('dashboard') ?>/css/adminlte.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
        integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="<?= base_url('dashboard') ?>/assets/img/user2-160x160.jpg"
                                class="user-image rounded-circle shadow" alt="User Image">
                            <span class="d-none d-md-inline"><?= session()->get('name') ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header text-bg-primary">
                                <img src="<?= base_url('dashboard') ?>/assets/img/user2-160x160.jpg"
                                    class="rounded-circle shadow" alt="User Image">
                                <p>
                                    <?= session()->get('name') ?>
                                    <small><?= session()->get('name') ?>
                                        [<?= (session()->get('role') == 1) ? 'Admin' : 'User' ?>]</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <a href="<?= base_url('Auth/logout') ?>"
                                    class="btn btn-default btn-flat float-end">Logout</a>
                            </li>
                            <!--end::Menu Footer-->
                        </ul>
                    </li>
                    <!--end::User Menu Dropdown-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
        </nav>
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="<?= base_url() ?>" class="brand-link">
                    <img src="<?= base_url('uploads/logo/logo.png') ?>" alt="AdminLTE Logo"
                        class="brand-image opacity-75 shadow">
                    <span class="brand-text fw-light">Adi Rahayu</span>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= base_url() ?>" class="nav-link <?= ($name == 'dashboard') ? 'active' : '' ?>">
                                <i class="nav-icon fa-solid fa-table-columns"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item <?= (!empty($menu_open)) ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-boxes-stacked"></i>
                                <p>
                                    Data Master
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('Dashboard/master_poli') ?>"
                                        class="nav-link <?= ($name == 'master_poli') ? 'active' : '' ?>">
                                        <p>Master Poli</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Dashboard/master_dokter') ?>"
                                        class="nav-link <?= ($name == 'master_dokter') ? 'active' : '' ?>">

                                        <p>Master Dokter</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="<?= base_url('Dashboard/master_tindakan') ?>"
                                        class="nav-link <?= ($name == 'master_tindakan') ? 'active' : '' ?>">

                                        <p>Master Tindakan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Dashboard/master_diagnosa') ?>"
                                        class="nav-link <?= ($name == 'master_diagnosa') ? 'active' : '' ?>">

                                        <p>Master Diagnosa</p>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a href="<?= base_url('Dashboard/master_administrasi') ?>"
                                        class="nav-link <?= ($name == 'master_administrasi') ? 'active' : '' ?>">

                                        <p>Master Administrasi</p>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a href="<?= base_url('Dashboard/master_penunjang') ?>"
                                        class="nav-link <?= ($name == 'master_penunjang') ? 'active' : '' ?>">

                                        <p>Master Penunjang</p>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a href="<?= base_url('Dashboard/master_supplier') ?>"
                                        class="nav-link <?= ($name == 'master_supplier') ? 'active' : '' ?>">

                                        <p>Master Supplier</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Dashboard/master_obat') ?>"
                                        class="nav-link <?= ($name == 'master_obat') ? 'active' : '' ?>">

                                        <p>Master Obat</p>
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a href="<?= base_url('Dashboard/master_kamar') ?>"
                                        class="nav-link <?= ($name == 'master_kamar') ? 'active' : '' ?>">

                                        <p>Master Kamar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('/Pasien') ?>"
                                class="nav-link <?= ($name == 'pasien') ? 'active' : '' ?>">
                                <i class="nav-icon fa-solid fa-user-nurse"></i>
                                <p>Pasien</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/RawatJalan') ?>"
                                class="nav-link <?= ($name == 'rawat_jalan') ? 'active' : '' ?>">
                                <i class="nav-icon fa-regular fa-calendar-check"></i>
                                <p>Pendaftaran Rawat Jalan</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="<?= base_url('Dashboard/rajal') ?>"
                                class="nav-link <?= ($name == 'rajal') ? 'active' : '' ?>">
                                <i class="nav-icon fa-solid fa-folder-closed"></i>
                                <p>Pemeriksaan Rajal</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="<?= base_url('RawatInap') ?>"
                                class="nav-link <?= ($name == 'rawat_inap') ? 'active' : '' ?>">
                                <i class="nav-icon fa-solid fa-bed-pulse"></i>
                                <p>Pendaftaran Rawat Inap</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="<?= base_url('Dashboard/ranap') ?>"
                                class="nav-link <?= ($name == 'ranap') ? 'active' : '' ?>">
                                <i class="nav-icon fa-solid fa-folder-closed"></i>
                                <p>Pemeriksaan Ranap</p>
                            </a>
                        </li> -->

                        <li class="nav-item <?= (!empty($menu_open_laporan)) ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fa-chart-simple"></i>
                                <p>
                                    Laporan
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('Laporan/PeminjamanStatusRJ') ?>"
                                        class="nav-link <?= ($name == 'peminjaman_status_rj') ? 'active' : '' ?>">
                                        <p>Peminjaman Status (RJ)</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('Laporan/PeminjamanstatusRI') ?>"
                                        class="nav-link <?= ($name == 'peminjaman_status_ri') ? 'active' : '' ?>">
                                        <p>Peminjaman Status (RI)</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">SETTINGS</li>
                        <li class="nav-item">
                            <a href="<?= base_url('ManajemenUser') ?>"
                                class="nav-link <?= ($name == 'manajemen_user') ? 'active' : '' ?>">
                                <i class="fa-solid fa-headset"></i>
                                <p>Management User</p>
                            </a>
                        </li>
                    </ul>
                    <!--end::Sidebar Menu-->
                </nav>
            </div>
            <!--end::Sidebar Wrapper-->
        </aside>

        

        <?php echo $this->renderSection('content') ?>

        <footer class="app-footer">
            <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">Anything you want</div>
            <!--end::To the end-->
            <strong>
                Copyright &copy; 2014-2024&nbsp;
                <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)-->
    <!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script>
    <!--end::Required Plugin(Bootstrap 5)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <script src="<?= base_url('dashboard') ?>/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)-->
    <!--begin::OverlayScrollbars Configure-->
    <script>
    const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
    const Default = {
        scrollbarTheme: "os-theme-light",
        scrollbarAutoHide: "leave",
        scrollbarClickScroll: true,
    };
    document.addEventListener("DOMContentLoaded", function() {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (
            sidebarWrapper &&
            typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
        ) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- sortablejs -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
        integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ=" crossorigin="anonymous"></script>
    <!-- sortablejs -->
    <script>
    const connectedSortables =
        document.querySelectorAll(".connectedSortable");
    connectedSortables.forEach((connectedSortable) => {
        let sortable = new Sortable(connectedSortable, {
            group: "shared",
            handle: ".card-header",
        });
    });

    const cardHeaders = document.querySelectorAll(
        ".connectedSortable .card-header",
    );
    cardHeaders.forEach((cardHeader) => {
        cardHeader.style.cursor = "move";
    });
    </script> <!-- apexcharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
        integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
        integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
        integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY=" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Your other JavaScript files -->
</body>
<!--end::Body-->

</html>