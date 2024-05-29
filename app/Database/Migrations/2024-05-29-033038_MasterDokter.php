<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MasterDokter extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE,
            ],
            'kode' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => TRUE,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
                'null'       => TRUE,
            ],
            'tarif' => [
                'type'       => 'INT',
                'constraint' => 50,
                'default'     => 0,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('master_dokter');
    }

    public function down()
    {
        $this->forge->dropTable('master_dokter');
    }
}
