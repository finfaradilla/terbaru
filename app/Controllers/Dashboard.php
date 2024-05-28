<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DataMaster\MasterPoliModel;
use App\Models\DataMaster\MasterDokterModel;

class Dashboard extends BaseController
{
    protected $ModelPoli;
    protected $ModelDokter;
    public function __construct()
    {
        $this->session = session();
        $this->ModelPoli = new MasterPoliModel();
        $this->ModelDokter = new MasterDokterModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'name' => 'dashboard',
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
}
