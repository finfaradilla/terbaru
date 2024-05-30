<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DataMaster\MasterPoliModel;
use App\Models\DataMaster\MasterDokterModel;
use App\Models\DataMaster\MasterTindakanModel;
use App\Models\DataMaster\MasterDiagnosaModel;
use App\Models\DataMaster\MasterAdministrasiModel;
use App\Models\DataMaster\MasterPenunjangModel;
use App\Models\DataMaster\MasterSupplierModel;
use App\Models\DataMaster\MasterObatModel;
use App\Models\DataMaster\MasterKamarModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->ModelPoli = new MasterPoliModel();
        $this->ModelDokter = new MasterDokterModel();
        $this->ModelTindakan = new MasterTindakanModel();
        $this->ModelDiagnosa = new MasterDiagnosaModel();
        $this->ModelAdministrasi = new MasterAdministrasiModel();
        $this->ModelPenunjang = new MasterPenunjangModel();
        $this->ModelSupplier = new MasterSupplierModel();
        $this->ModelObat = new MasterObatModel();
        $this->ModelKamar = new MasterKamarModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'name' => 'dashboard',
            'dataDokter' => $this->ModelDokter->findAll(),
        ];
        return view('Dashboard/index', $data);
    }

    public function master_poli()
    {
        $data = [
            'title' => 'Master Poli',
            'name' => 'master_poli',
            'menu_open' => true,
            'data_poli' => $this->ModelPoli->findAll(),
        ];
        return view('Dashboard/data_master/master_poli', $data);
    }

    public function master_dokter()
    {
        $data = [
            'title' => 'Master Dokter',
            'name' => 'master_dokter',
            'menu_open' => true,
            'data_dokter' => $this->ModelDokter->findAll(),
        ];
        return view('Dashboard/data_master/master_dokter', $data);
    }

    public function master_tindakan()
    {
        $data = [
            'title' => 'Master Tindakan',
            'name' => 'master_tindakan',
            'menu_open' => true,
            'data_tindakan' => $this->ModelTindakan->findAll(),
        ];
        return view('Dashboard/data_master/master_tindakan', $data);
    }

    public function master_diagnosa()
    {
        $data = [
            'title' => 'Master Diagnosa',
            'name' => 'master_diagnosa',
            'menu_open' => true,
            'data_diagnosa' => $this->ModelDiagnosa->findAll(),
        ];
        return view('Dashboard/data_master/master_diagnosa', $data);
    }

    public function master_administrasi()
    {
        $data = [
            'title' => 'Master Administrasi',
            'name' => 'master_administrasi',
            'menu_open' => true,
            'data_administrasi' => $this->ModelAdministrasi->findAll(),
        ];
        return view('Dashboard/data_master/master_administrasi', $data);
    }

    public function master_penunjang()
    {
        $data = [
            'title' => 'Master Penunjang',
            'name' => 'master_penunjang',
            'menu_open' => true,
            'data_penunjang' => $this->ModelPenunjang->findAll(),
        ];
        return view('Dashboard/data_master/master_penunjang', $data);
    }

    public function master_supplier()
    {
        $data = [
            'title' => 'Master Supplier',
            'name' => 'master_supplier',
            'menu_open' => true,
            'data_supplier' => $this->ModelSupplier->findAll(),
        ];
        return view('Dashboard/data_master/master_supplier', $data);
    }

    public function master_obat()
    {
        $data = [
            'title' => 'Master Obat',
            'name' => 'master_obat',
            'menu_open' => true,
            'data_obat' => $this->ModelObat->findAll(),
            'data_supplier' => $this->ModelSupplier->findAll(),
        ];
        return view('Dashboard/data_master/master_obat', $data);
    }
    
    public function master_kamar()
    {
        $data = [
            'title' => 'Master Kamar',
            'name' => 'master_kamar',
            'menu_open' => true,
            'data_kamar' => $this->ModelKamar->findAll(),
        ];
        return view('Dashboard/data_master/master_kamar', $data);
    }
}
