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
                        <div class="card-body">
                            <main class="app-main">
                                <div class="container">
                                    <a href="<?= base_url('Pasien') ?>"
                                        class="btn btn-warning">Kembali</a>
                                </div>
                                <div class="app-content container py-5">
                                    <div class="card card-primary card-outline mb-4">
                                        <div class="card-header">
                                            <div class="card-title">Data
                                                <strong>KODE PASIEN</strong>
                                            </div>
                                        </div>
                                        <form action="<?= base_url('Pasien/simpan') ?>" method="POST" enctype="multipart/form-data">
                                            <?= csrf_field() ?>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="no_ktp" class="form-label">No. KTP</label>
                                                    <input type="number" class="form-control <?= session('errors.no_ktp') ? 'is-invalid' : '' ?>" name="no_ktp" id="no_ktp" value="<?= old('no_ktp') ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.no_ktp') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama</label>
                                                    <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" name="nama" id="nama" value="<?= old('nama') ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.nama') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="bpjs" class="form-label">No BPJS (Optional)</label>
                                                    <input type="number" class="form-control <?= session('errors.bpjs') ? 'is-invalid' : '' ?>" name="bpjs" id="bpjs" value="<?= old('bpjs') ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.bpjs') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control <?= session('errors.jenis_kelamin') ? 'is-invalid' : '' ?>">
                                                        <option value="">Pilih Jenis Kelamin</option>
                                                        <option value="L" <?= (old('jenis_kelamin') == 'L') ? 'selected' : '' ?>>Laki - Laki</option>
                                                        <option value="P" <?= (old('jenis_kelamin') == 'P') ? 'selected' : '' ?>>Perempuan</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.jenis_kelamin') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="gol_darah" class="form-label">Golongan Darah</label>
                                                    <select name="gol_darah" id="gol_darah" class="form-control <?= session('errors.gol_darah') ? 'is-invalid' : '' ?>"">
                                                        <option value="">Pilih Golongan Darah</option>
                                                        <option value="Tidak Diketahui" <?= (old('gol_darah') == 'Tidak Diketahui') ? 'selected' : '' ?>>Tidak Diketahui</option>
                                                        <option value="A" <?= (old('gol_darah') == 'A') ? 'selected' : '' ?>>A</option>
                                                        <option value="B" <?= (old('gol_darah') == 'B') ? 'selected' : '' ?>>B</option>
                                                        <option value="AB" <?= (old('gol_darah') == 'AB') ? 'selected' : '' ?>>AB</option>
                                                        <option value="O" <?= (old('gol_darah') == 'O') ? 'selected' : '' ?>>O</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.gol_darah') ?>
                                                    </div>
                                                </div>



                                                <div class="mb-3">
                                                    <label for="agama" class="form-label">Agama</label>
                                                    <select name="agama" id="agama" class="form-control <?= session('errors.agama') ? 'is-invalid' : '' ?>" onchange="toggleLainLainInput()">
                                                        <option value="">Pilih Agama</option>
                                                        <option value="Islam" <?= (old('agama') == 'Islam') ? 'selected' : '' ?>>Islam</option>
                                                        <option value="Kristen Protestan" <?= (old('agama') == 'Kristen Protestan') ? 'selected' : '' ?>>Kristen Protestan</option>
                                                        <option value="Katolik" <?= (old('agama') == 'Katolik') ? 'selected' : '' ?>>Katolik</option>
                                                        <option value="Hindu" <?= (old('agama') == 'Hindu') ? 'selected' : '' ?>>Hindu</option>
                                                        <option value="Budha" <?= (old('agama') == 'Budha') ? 'selected' : '' ?>>Budha</option>
                                                        <option value="Konghucu" <?= (old('agama') == 'Konghucu') ? 'selected' : '' ?>>Konghucu</option>
                                                        <option value="Penghayat" <?= (old('agama') == 'Penghayat') ? 'selected' : '' ?>>Penghayat</option>
                                                        <option value="Lain-lain" <?= (old('agama') == 'Lain-lain') ? 'selected' : '' ?>>Lain-lain</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.agama') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3" id="lain-lain-input" style="display: none;">
                                                    <label for="agama_lain" class="form-label">Agama Lain</label>
                                                    <input type="text" class="form-control <?= session('errors.agama_lain') ? 'is-invalid' : '' ?>" name="agama_lain" id="agama_lain" value="<?= old('agama_lain') ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.agama_lain') ?>
                                                    </div>
                                                </div>
                                                <script>
                                                    function toggleLainLainInput() {
                                                        var agamaSelect = document.getElementById('agama');
                                                        var lainLainInput = document.getElementById('lain-lain-input');
                                                        if (agamaSelect.value === 'Lain-lain') {
                                                            lainLainInput.style.display = 'block';
                                                        } else {
                                                            lainLainInput.style.display = 'none';
                                                        }
                                                    }
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        toggleLainLainInput();
                                                    });
                                                </script>



                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status Pernikahan</label>
                                                    <select name="status" id="status" class="form-control <?= session('errors.status') ? 'is-invalid' : '' ?>">
                                                        <option value="">Pilih Status Pernikahan</option>
                                                        <option value="Belum Kawin" <?= (old('status') == 'Belum Kawin') ? 'selected' : '' ?>>Belum Kawin</option>
                                                        <option value="Sudah Kawin" <?= (old('status') == 'Sudah Kawin') ? 'selected' : '' ?>>Sudah Kawin</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.status') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                                    <input type="date"
                                                        class="form-control <?= session('errors.tgl_lahir') ? 'is-invalid' : '' ?>"
                                                        name="tgl_lahir" id="tgl_lahir" value="<?= old('tgl_lahir') ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.tgl_lahir') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tmpt_lahir" class="form-label">Tempat Lahir</label>
                                                    <input type="text" class="form-control <?= session('errors.tmpt_lahir') ? 'is-invalid' : '' ?>" name="tmpt_lahir" id="tmpt_lahir" value="<?= old('tmpt_lahir') ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.tmpt_lahir') ?>
                                                    </div>
                                                </div>
                                                <!-- <div class="mb-3">
                                                    <label for="image" class="form-label">Foto</label>
                                                    <input type="file"
                                                        class="form-control <?= session('errors.image') ? 'is-invalid' : '' ?>"
                                                        name="image" id="image">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.image') ?>
                                                    </div>
                                                </div> -->
                                                <div class="mb-3">
                                                    <label for="provinsi" class="form-label">Provinsi</label>
                                                    <select id="provinsi" name="provinsi" class="form-control <?= session('errors.provinsi') ? 'is-invalid' : '' ?>">
                                                        <option value="">-- Pilih Nama Propinsi --</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.provinsi') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kota" class="form-label">Kota</label>
                                                    <select id="kota" name="kota" class="form-control <?= session('errors.kota') ? 'is-invalid' : '' ?>">
                                                        <option value="">-- Pilih Provinsi Terlebih Dahulu --</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.kota') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                                    <select id="kecamatan" name="kecamatan" class="form-control <?= session('errors.kecamatan') ? 'is-invalid' : '' ?>">
                                                        <option value="">-- Pilih Nama Kecamatan --</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.kecamatan') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kelurahan" class="form-label">Kelurahan</label>
                                                    <select id="kelurahan" name="kelurahan" class="form-control <?= session('errors.kelurahan') ? 'is-invalid' : '' ?>">
                                                        <option value="">-- Pilih Nama Kelurahan --</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.kelurahan') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <textarea name="alamat" id="alamat" class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>"><?= old('alamat') ?></textarea>
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.alamat') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_tlp" class="form-label">No Telp</label>
                                                    <input type="text" class='form-control <?= session('errors.no_tlp') ? 'is-invalid' : '' ?>' name="no_tlp" id="no_tlp" value="<?= old('no_tlp') ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.no_tlp') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                                    <input type="text" class='form-control <?= session('errors.pekerjaan') ? 'is-invalid' : '' ?>' name="pekerjaan" id="pekerjaan" value="<?= old('pekerjaan') ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.pekerjaan') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="pendidikan" class="form-label">Pendidikan</label>
                                                    <select name="pendidikan" id="pendidikan" class="form-control <?= session('errors.pendidikan') ? 'is-invalid' : '' ?>">
                                                        <option value="">Pilih Pendidikan</option>
                                                        <option value="Tidak Sekolah" <?= (old('pendidikan') == 'Tidak Sekolah' ? 'selected' : '') ?>>Tidak Sekolah</option>
                                                        <option value="SD" <?= (old('pendidikan') == 'SD' ? 'selected' : '') ?>>SD</option>
                                                        <option value="SLTP (sederajat)" <?= (old('pendidikan') == 'SLTP (sederajat)' ? 'selected' : '') ?>>SLTP (sederajat)</option>
                                                        <option value="SLTA (sederajat)" <?= (old('pendidikan') == 'SLTA (sederajat)' ? 'selected' : '') ?>>SLTA (sederajat)</option>
                                                        <option value="D1-D3 (sederajat)" <?= (old('pendidikan') == 'D1-D3 (sederajat)' ? 'selected' : '') ?>>D1-D3 (sederajat)</option>
                                                        <option value="D4" <?= (old('pendidikan') == 'D4' ? 'selected' : '') ?>>D4</option>
                                                        <option value="S1" <?= (old('pendidikan') == 'S1' ? 'selected' : '') ?>>S1</option>
                                                        <option value="S2" <?= (old('pendidikan') == 'S2' ? 'selected' : '') ?>>S2</option>
                                                        <option value="S3" <?= (old('pendidikan') == 'S3' ? 'selected' : '') ?>>S3</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.pendidikan') ?>
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
    fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
    .then(response => response.json())
    .then(provinces => {
        var data = provinces;
        var option = `<option value="">-- Pilih Nama Provinsi --</option>`;
        data.forEach(element => {
            option += `<option data-reg="${element.id}" value="${element.name}">${element.name}</option>`
        });
        document.getElementById('provinsi').innerHTML = option;
    });

    const pilihKota = document.getElementById('provinsi');
    pilihKota.addEventListener('change', (element) => {
        var provinsiIndex = element.target.options[element.target.selectedIndex].dataset.reg;
        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsiIndex}.json`)
        .then(response => response.json())
        .then(kota => {
            var data = kota;
            var option = `<option value="">-- Pilih Nama Kota --</option>`;
            data.forEach(element => {
                option += `<option data-reg="${element.id}" value="${element.name}">${element.name}</option>`
            });
            document.getElementById('kota').innerHTML = option;
        });
    })

    const pilihKecamatan = document.getElementById('kota');
    pilihKecamatan.addEventListener('change', (element) => {
        var kotaIndex = element.target.options[element.target.selectedIndex].dataset.reg;
        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kotaIndex}.json`)
        .then(response => response.json())
        .then(kecamatan => {
            var data = kecamatan;
            var option = `<option value="">-- Pilih Nama Kecamatan --</option>`;
            data.forEach(element => {
                option += `<option data-reg="${element.id}" value="${element.name}">${element.name}</option>`
            });
            document.getElementById('kecamatan').innerHTML = option;
        });
    })

    const pilihKelurahan = document.getElementById('kecamatan');
    pilihKelurahan.addEventListener('change', (element) => {
        var kecamatanIndex = element.target.options[element.target.selectedIndex].dataset.reg;
        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatanIndex}.json`)
        .then(response => response.json())
        .then(kecamatan => {
            var data = kecamatan;
            var option = `<option value="">-- Pilih Kelurahan --</option>`;
            data.forEach(element => {
                option += `<option data-reg="${element.id}" value="${element.name}">${element.name}</option>`
            });
            document.getElementById('kelurahan').innerHTML = option;
        });
    })
</script>
<?= $this->endSection() ?>