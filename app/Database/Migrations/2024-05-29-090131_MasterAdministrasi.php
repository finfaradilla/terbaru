<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MasterAdministrasi extends Migration
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
            'tarif' => [
                'type'       => 'INT',
                'constraint' => 20,
                'default'    => 0,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('master_administrasi', true);
    }

    public function down()
    {
        $this->forge->dropTable('master_administrasi', true);
    }
}
