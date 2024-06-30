<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRelasiTable extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('laporan_peminjaman_ri', [
            'id_pasien' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
                'after' => 'id'
            ],
            'id_dokter' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'null' => false,
                'after' => 'id_pasien'
            ],
            'id_kamar' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'null' => false,
                'after' => 'id_dokter'
            ]
        ]);

        $this->forge->modifyColumn('laporan_peminjaman_ri', [
            'id_dokter' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
                'after' => 'id_pasien'
            ]
        ]);

        $this->forge->modifyColumn('laporan_peminjaman_ri', [
            'id_kamar' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
                'after' => 'id_dokter'
            ]
        ]);

        $this->forge->modifyColumn('laporan_peminjaman_rj', [
            'id_pasien' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
                'after' => 'id'
            ]
        ]);

        $this->forge->modifyColumn('laporan_peminjaman_rj', [
            'id_dokter' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
                'after' => 'id_pasien'
            ]
        ]);

        $this->forge->modifyColumn('rawat_inap', [
            'id_pasien' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
                'after' => 'no_pendaftaran'
            ]
        ]);

        $this->forge->modifyColumn('rawat_jalan', [
            'id_pasien' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
                'after' => 'no_pendaftaran'
            ]
        ]);

        $this->db->query('ALTER TABLE `laporan_peminjaman_ri` ADD CONSTRAINT `FK_laporan_peminjaman_ri_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->db->query('ALTER TABLE `laporan_peminjaman_ri` ADD CONSTRAINT `FK_laporan_peminjaman_ri_master_dokter` FOREIGN KEY (`id_dokter`) REFERENCES `master_dokter` (`id`) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->db->query('ALTER TABLE `laporan_peminjaman_ri` ADD CONSTRAINT `FK_laporan_peminjaman_ri_master_kamar` FOREIGN KEY (`id_kamar`) REFERENCES `master_kamar` (`id`) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->db->query('ALTER TABLE `laporan_peminjaman_rj` ADD CONSTRAINT `FK_laporan_peminjaman_rj_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->db->query('ALTER TABLE `laporan_peminjaman_rj` ADD CONSTRAINT `FK_laporan_peminjaman_rj_master_dokter` FOREIGN KEY (`id_dokter`) REFERENCES `master_dokter` (`id`) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->db->query('ALTER TABLE `rawat_inap` ADD CONSTRAINT `FK_rawat_inap_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->db->query('ALTER TABLE `rawat_jalan` ADD CONSTRAINT `FK_rawat_jalan_pasien` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`) ON UPDATE CASCADE ON DELETE CASCADE');
    }

    public function down()
    {
        $this->db->query('ALTER TABLE `laporan_peminjaman_ri` DROP FOREIGN KEY `FK_laporan_peminjaman_ri_pasien`');
        $this->db->query('ALTER TABLE `laporan_peminjaman_ri` DROP FOREIGN KEY `FK_laporan_peminjaman_ri_master_dokter`');
        $this->db->query('ALTER TABLE `laporan_peminjaman_ri` DROP FOREIGN KEY `FK_laporan_peminjaman_ri_master_kamar`');
        $this->db->query('ALTER TABLE `laporan_peminjaman_rj` DROP FOREIGN KEY `FK_laporan_peminjaman_rj_pasien`');
        $this->db->query('ALTER TABLE `laporan_peminjaman_rj` DROP FOREIGN KEY `FK_laporan_peminjaman_rj_master_dokter`');
        $this->db->query('ALTER TABLE `rawat_inap` DROP FOREIGN KEY `FK_rawat_inap_pasien`');
        $this->db->query('ALTER TABLE `rawat_jalan` DROP FOREIGN KEY `FK_rawat_jalan_pasien`');

        $this->forge->modifyColumn('laporan_peminjaman_ri', [
            'id_pasien' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'null' => false
            ],
            'id_dokter' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'null' => false
            ],
            'id_kamar' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'null' => false
            ]
        ]);

        $this->forge->modifyColumn('laporan_peminjaman_ri', [
            'id_dokter' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'null' => false
            ]
        ]);

        $this->forge->modifyColumn('laporan_peminjaman_ri', [
            'id_kamar' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'null' => false
            ]
        ]);

        $this->forge->modifyColumn('laporan_peminjaman_rj', [
            'id_pasien' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'null' => false
            ]
        ]);

        $this->forge->modifyColumn('laporan_peminjaman_rj', [
            'id_dokter' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'null' => false
            ]
        ]);

        $this->forge->modifyColumn('rawat_inap', [
            'id_pasien' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'null' => false
            ]
        ]);

        $this->forge->modifyColumn('rawat_jalan', [
            'id_pasien' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'null' => false
            ]
        ]);
    }
}
