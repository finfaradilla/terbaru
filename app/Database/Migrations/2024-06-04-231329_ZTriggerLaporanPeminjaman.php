<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ZTriggerLaporanPeminjaman extends Migration
{
    public function up()
    {
        $this->db->query("
            CREATE TRIGGER laporan_peminjaman_status_rj
            AFTER INSERT ON rawat_jalan
            FOR EACH ROW
            BEGIN
                INSERT INTO laporan_peminjaman_rj (id_pasien, poli, tanggal, jam)
                VALUES (NEW.id_pasien, NEW.id_poli, NEW.tanggal, NEW.jam);
            END
        ");
    }

    public function down()
    {
        $this->db->query("
            DROP TRIGGER IF EXISTS laporan_peminjaman_status_rj
        ");
    }
}
