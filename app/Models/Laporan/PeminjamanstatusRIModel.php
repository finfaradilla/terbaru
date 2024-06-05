<?php

namespace App\Models\Laporan;

use CodeIgniter\Model;

class PeminjamanstatusRIModel extends Model
{
    protected $table            = 'laporan_peminjaman_ri';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_pasien',
        'id_kamar',
        'tanggal_masuk',
        'jam_masuk',
        'tanggal_keluar',
        'jam_keluar',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function getPasienById($id) {
        $query = $this->db->table('pasien')
                ->where('id', $id)
                ->get()
                ->getResultArray();
        if (count($query) >= 1) {
            return $query[0];
        } else {
            return [];
        }
    }

    public function getKamarById($id) {
        $query = $this->db->table('master_kamar')
                ->where('id', $id)
                ->get()
                ->getResultArray();
        if (count($query) >= 1) {
            return $query[0];
        } else {
            return [];
        }
    }

    public function getDokterById($id) {
        $query = $this->db->table('master_dokter')
                ->where('id', $id)
                ->get()
                ->getResultArray();
        if (count($query) >= 1) {
            return $query[0];
        } else {
            return [];
        }
    }
}
