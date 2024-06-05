<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ZTriggerLaporanPeminjamanRi extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE TRIGGER laporan_peminjaman_status_ri
            AFTER INSERT ON rawat_inap
            FOR EACH ROW
            BEGIN
                INSERT INTO laporan_peminjaman_ri (id_pasien, id_kamar, id_dokter, keluhan, tanggal_masuk, jam_masuk)
                VALUES (NEW.id_pasien, NEW.id_kamar, NEW.id_dokter, NEW.keluhan, NEW.tgl_masuk, NEW.jam_masuk);
            END;
        ");

        $this->db->query("
            CREATE TRIGGER laporan_peminjaman_status_ri_update
            AFTER UPDATE ON rawat_inap
            FOR EACH ROW
            BEGIN
                UPDATE laporan_peminjaman_ri
                SET id_pasien = NEW.id_pasien, id_kamar = NEW.id_kamar, id_dokter = NEW.id_dokter, keluhan = NEW.keluhan, tanggal_masuk = NEW.tgl_masuk, jam_masuk = NEW.jam_masuk, tanggal_keluar = NEW.tgl_keluar, jam_keluar = NEW.jam_keluar
                WHERE id_pasien = OLD.id_pasien AND id_kamar = OLD.id_kamar AND tanggal_masuk = OLD.tgl_masuk AND jam_masuk = OLD.jam_masuk;
            END;
        ");
    }

    public function down()
    {
        $this->db->query("
            DROP TRIGGER IF EXISTS laporan_peminjaman_status_ri;
        ");

        $this->db->query("
            DROP TRIGGER IF EXISTS laporan_peminjaman_status_ri_update;
        ");
    }
}
