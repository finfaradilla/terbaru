<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LaporanPeminjamanRi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_pasien' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'id_dokter' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'id_kamar' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'tanggal_masuk' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'jam_masuk' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'keluhan' => [
                'type' => 'MEDIUMTEXT',
                'null' => true,
            ],
            'tanggal_keluar' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'jam_keluar' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('laporan_peminjaman_ri');
    }

    public function down()
    {
        $this->forge->dropTable('laporan_peminjaman_ri');
    }
}
