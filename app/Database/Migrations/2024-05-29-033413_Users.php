<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
                'null'       => FALSE,
                'unique'     => TRUE,
            ],
            'password_hash' => [ // Use password_hash column for secure passwords
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 250,
                'null'       => FALSE,
            ],
            'role' => [ // Adjust data type and constraint if needed for roles
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => TRUE,
                'default'     => 0,
            ],
            'reset_token' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => TRUE,
            ],
            'reset_expiry' => [
                'type'       => 'INT',
                'constraint' => 150,
                'default'     => 0,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
