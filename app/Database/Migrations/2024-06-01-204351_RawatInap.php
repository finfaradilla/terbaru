<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RawatInap extends Migration
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
            'no_pendaftaran' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ],
            'id_pasien' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
            'keluhan' => [
                'type' => 'MEDIUMTEXT',
                'null' => true,
            ],
            'tgl_masuk' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'jam_masuk' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'id_kamar' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'tgl_keluar' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'jam_keluar' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'id_dokter' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('rawat_inap');
    }

    public function down()
    {
        $this->forge->dropTable('rawat_inap');
    }
}
