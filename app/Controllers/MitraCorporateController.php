<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\Config;

class MitraCorporateController extends BaseController
{

    private $db, $UserInfo;
    public function __construct()
    {
        $this->db = Config::connect();
    }

    public function index()
    {
        return view('pages/landing/landing');
    }

    public function supported_document()
    {
        $data = $this->db->table('support_doc_types')->get()->getResultObject();
        return $this->response->setJSON($data);
    }

}