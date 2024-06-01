<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Role extends Migration
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
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'unique' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('role');

        // Menambahkan data ke tabel role
        $data = [
            ['nama' => 'User'],
            ['nama' => 'Admin'],
            ['nama' => 'Kasir'],
            ['nama' => 'Petugas'],
        ];
        $this->db->table('role')->insertBatch($data);
    }

    public function down()
    {
        // Menghapus tabel role
        $this->forge->dropTable('role');
    }
}
