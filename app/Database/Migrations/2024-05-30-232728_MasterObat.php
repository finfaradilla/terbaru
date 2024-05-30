<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MasterObat extends Migration
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
                'constraint' => 50,
                'null'       => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
                'null'       => true,
            ],
            'satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'harga_modal' => [
                'type'       => 'INT',
                'constraint' => 15,
                'null'       => true,
            ],
            'harga_jual' => [
                'type'       => 'INT',
                'constraint' => 15,
                'null'       => true,
            ],
            'stok' => [
                'type'       => 'INT',
                'constraint' => 15,
                'null'       => true,
            ],
            'exp_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'supplier' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('master_obat');
    }

    public function down()
    {
        $this->forge->dropTable('master_obat');
    }
}
