<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MasterDiagnosa extends Migration
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
            'kode' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'keterangan' => [
                'type' => 'MEDIUMTEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('master_diagnosa', true);
    }

    public function down()
    {
        $this->forge->dropTable('master_diagnosa', true);
    }
}
