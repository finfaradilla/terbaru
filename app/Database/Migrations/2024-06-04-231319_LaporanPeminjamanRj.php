<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LaporanPeminjamanRj extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_pasien' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'poli' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'jam' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'tanggal_kembali' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'jam_kembali' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('laporan_peminjaman_rj');
    }

    public function down()
    {
        $this->forge->dropTable('laporan_peminjaman_rj');
    }
}
