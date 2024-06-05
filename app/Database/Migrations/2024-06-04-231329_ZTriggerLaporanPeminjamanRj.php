<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ZTriggerLaporanPeminjamanRj extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE TRIGGER laporan_peminjaman_status_rj
            AFTER INSERT ON rawat_jalan
            FOR EACH ROW
            BEGIN
                INSERT INTO laporan_peminjaman_rj (id_pasien, id_dokter, keluhan, poli, tanggal, jam)
                VALUES (NEW.id_pasien, NEW.id_dokter, NEW.keluhan, NEW.id_poli, NEW.tanggal, NEW.jam);
            END;
        ");

        $this->db->query("
            CREATE TRIGGER laporan_peminjaman_status_rj_update
            AFTER UPDATE ON rawat_jalan
            FOR EACH ROW
            BEGIN
                UPDATE laporan_peminjaman_rj
                SET id_pasien = NEW.id_pasien, id_dokter = NEW.id_dokter, keluhan = NEW.keluhan, poli = NEW.id_poli, tanggal = NEW.tanggal, jam = NEW.jam
                WHERE id_pasien = OLD.id_pasien AND poli = OLD.id_poli AND tanggal = OLD.tanggal AND jam = OLD.jam;
            END;
        ");
    }

    public function down()
    {
        $this->db->query("
            DROP TRIGGER IF EXISTS laporan_peminjaman_status_rj;
        ");

        $this->db->query("
            DROP TRIGGER IF EXISTS laporan_peminjaman_status_rj_update;
        ");
    }
}
