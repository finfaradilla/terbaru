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
                                    <a href="<?= base_url('Pasien/index') ?>"
                                        class="btn btn-warning">Kembali</a>
                                </div>
                                <div class="app-content container py-5">
                                    <div class="card card-primary card-outline mb-4">
                                        <div class="card-header">
                                            <div class="card-title">Data
                                                <strong><?= $data_pasien['nama'] ?></strong>
                                            </div>
                                        </div>
                                        <form action="<?= base_url('Pasien/update') ?>" method="POST" enctype="multipart/form-data">
                                            <?= csrf_field() ?>
                                            <div class="card-body">
                                                <div class="container text-center">
                                                    <img src="<?= base_url($data_pasien['image']) ?>" alt="Profile" style="width: 20%; height: 20%">
                                                    <input type="hidden" name="image_old" value="<?= $data_pasien['image'] ?>">
                                                    <input type="hidden" name="no_rm" id="no_rm" value="<?= $data_pasien['no_rm'] ?>">
                                                    <input type="hidden" name="id_pasien" id="id_pasien" value="<?= $data_pasien['id'] ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_ktp" class="form-label">No. KTP</label>
                                                    <input type="number" class="form-control <?= session('errors.no_ktp') ? 'is-invalid' : '' ?>" name="no_ktp" id="no_ktp" value="<?= $data_pasien['no_ktp'] ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.no_ktp') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama</label>
                                                    <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" name="nama" id="nama" value="<?= $data_pasien['nama'] ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.nama') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="bpjs" class="form-label">No BPJS (Optional)</label>
                                                    <input type="number" class="form-control <?= session('errors.bpjs') ? 'is-invalid' : '' ?>" name="bpjs" id="bpjs" value="<?= $data_pasien['bpjs'] ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.bpjs') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control <?= session('errors.jenis_kelamin') ? 'is-invalid' : '' ?>">
                                                        <option value="">Pilih Jenis Kelamin</option>
                                                        <option value="L" <?= ($data_pasien['jenis_kelamin'] == 'L' ? 'selected' : '') ?>>Laki - Laki</option>
                                                        <option value="P" <?= ($data_pasien['jenis_kelamin'] == 'P' ? 'selected' : '') ?>>Perempuan</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.jenis_kelamin') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="gol_darah" class="form-label">Golongan Darah</label>
                                                    <select name="gol_darah" id="gol_darah" class="form-control <?= session('errors.gol_darah') ? 'is-invalid' : '' ?>">
                                                        <option value="">Pilih Golongan Darah</option>
                                                        <option value="Tidak Diketahui" <?= ($data_pasien['gol_darah'] == 'Tidak Diketahui') ? 'selected' : '' ?>>Tidak Diketahui</option>
                                                        <option value="A" <?= ($data_pasien['gol_darah'] == 'A' ? 'selected' : '') ?>>A</option>
                                                        <option value="B" <?= ($data_pasien['gol_darah'] == 'B' ? 'selected' : '') ?>>B</option>
                                                        <option value="AB" <?= ($data_pasien['gol_darah'] == 'AB' ? 'selected' : '') ?>>AB</option>
                                                        <option value="O" <?= ($data_pasien['gol_darah'] == 'O' ? 'selected' : '') ?>>O</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.gol_darah') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status Pernikahan</label>
                                                    <select name="status" id="status" class="form-control <?= session('errors.status') ? 'is-invalid' : '' ?>">
                                                        <option value="">Pilih Status Pernikahan</option>
                                                        <option value="Belum Kawin" <?= ($data_pasien['status'] == 'Belum Kawin' ? 'selected' : '') ?>>Belum Kawin</option>
                                                        <option value="Sudah Kawin" <?= ($data_pasien['status'] == 'Sudah Kawin' ? 'selected' : '') ?>>Sudah Kawin</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.status') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                                    <input type="date" class="form-control <?= session('errors.tgl_lahir') ? 'is-invalid' : '' ?>" name="tgl_lahir" id="tgl_lahir" value="<?= $data_pasien['tgl_lahir'] ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.tgl_lahir') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tmpt_lahir" class="form-label">Tempat Lahir</label>
                                                    <input type="text" class="form-control <?= session('errors.tmpt_lahir') ? 'is-invalid' : '' ?>" name="tmpt_lahir" id="tmpt_lahir" value="<?= $data_pasien['tempat_lahir'] ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.tmpt_lahir') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Foto</label>
                                                    <div class="image-container pb-4" id="show-img">
                                                        <img id="imageDisplay" src="" alt="Gambar Upload">
                                                    </div>
                                                    <input type="file"
                                                        class="form-control <?= session('errors.image') ? 'is-invalid' : '' ?>"
                                                        name="image" id="image">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.image') ?>
                                                    </div>
                                                </div>
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
                                                    <textarea name="alamat" id="alamat" class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>"><?= $data_pasien['alamat'] ?></textarea>
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.alamat') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_tlp" class="form-label">No Telp</label>
                                                    <input type="text" class='form-control <?= session('errors.no_tlp') ? 'is-invalid' : '' ?>' name="no_tlp" id="no_tlp" value="<?= $data_pasien['no_tlp'] ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.no_tlp') ?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                                    <input type="text" class='form-control <?= session('errors.pekerjaan') ? 'is-invalid' : '' ?>' name="pekerjaan" id="pekerjaan" value="<?= $data_pasien['pekerjaan'] ?>">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.pekerjaan') ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Update</button>
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
            var selected = ('<?= $data_pasien['provinsi'] ?>' == element.name) ? `selected` : '';
            console.log("Hasil : ", selected);
            option += `<option data-reg="${element.id}" value="${element.name}" ${selected}>${element.name}</option>`
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
                var selected = ('<?= $data_pasien['kota'] ?>' == element.name) ? `${element.name}` : '';
                option += `<option data-reg="${element.id}" value="${element.name}" ${selected}>${element.name}</option>`
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
                var selected = ('<?= $data_pasien['kecamatan'] ?>' == element.name) ? `${element.name}` : '';
                option += `<option data-reg="${element.id}" value="${element.name}" ${selected}>${element.name}</option>`
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
                var selected = ('<?= $data_pasien['kelurahan'] ?>' == element.name) ? `${element.name}` : '';
                option += `<option data-reg="${element.id}" value="${element.name}" ${selected}>${element.name}</option>`
            });
            document.getElementById('kelurahan').innerHTML = option;
        });
    })



    document.getElementById('image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const showImg = document.getElementById('show-img');
            showImg.style.display = 'block';
            const imgElement = document.getElementById('imageDisplay');
            imgElement.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

</script>
<?= $this->endSection() ?>