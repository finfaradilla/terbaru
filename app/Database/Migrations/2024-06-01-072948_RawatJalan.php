<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RawatJalan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_pasien' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'jam' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
                'null'       => true,
            ],
            'keluhan' => [
                'type' => 'MEDIUMTEXT',
                'null' => true,
            ],
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'administrasi' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'id_poli' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'id_dokter' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'no_pendaftaran' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('rawat_jalan');
    }

    public function down()
    {
        $this->forge->dropTable('rawat_jalan');
    }
}
