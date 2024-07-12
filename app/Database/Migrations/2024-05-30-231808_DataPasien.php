<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataPasien extends Migration
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
            'no_ktp' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
            'gol_darah' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'default' => 'Tidak Diketahui',
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'tempat_lahir' => [
                'type' => 'MEDIUMTEXT',
                'null' => true,
            ],
            'bpjs' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'no_rm' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'agama' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'pendidikan' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
            'image' => [
                'type' => 'MEDIUMTEXT',
                'default' => 'https://via.placeholder.com/100',
            ],
            'jenis_kelamin' => [
                'type' => 'ENUM',
                'constraint' => ['L', 'P'],
                'null' => true,
            ],
            'tgl_lahir' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'provinsi' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ],
            'kota' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ],
            'kecamatan' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ],
            'kelurahan' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => true,
            ],
            'alamat' => [
                'type' => 'MEDIUMTEXT',
                'null' => true,
            ],
            'no_tlp' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => true,
            ],
            'pekerjaan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('no_ktp');
        $this->forge->createTable('pasien');
    }

    public function down()
    {
        $this->forge->dropTable('pasien');
    }
}
