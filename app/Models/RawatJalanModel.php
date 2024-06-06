<?php
namespace App\Models;

use CodeIgniter\Model;

class RawatJalanModel extends Model
{
    protected $table            = 'rawat_jalan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_pasien',
        'tanggal',
        'jam',
        'keluhan',
        'type',
        'administrasi',
        'id_poli',
        'id_dokter',
        'no_pendaftaran',
        'time',
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

    public function getAllPasien() {
        $query = $this->db->table('pasien')->get();
        return $query->getResultArray();
    }

    public function getAllDokter() {
        $query = $this->db->table('master_dokter')->get();
        return $query->getResultArray();
    }
    
    public function getAllPoli() {
        $query = $this->db->table('master_poli')->get();
        return $query->getResultArray();
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

    public function getPoliById($id) {
        $query = $this->db->table('master_poli')
                ->where('id', $id)
                ->get()
                ->getResultArray();
        if (count($query) >= 1) {
            return $query[0];
        } else {
            return [];
        }
    }

    public function jumlahRawatJalanHarian() {
        $query = $this->where('DATE(tanggal)', date('Y-m-d'))
                ->get()
                ->getResultArray();
        if (count($query) >= 1) {
            return count($query);
        } else {
            return 0;
        }
    }
}