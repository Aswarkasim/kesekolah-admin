<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';


class Sekolah extends REST_Controller
{

  public function __construct()
  {
    parent::__construct();
  }


  public function index_get()
  {
    $sekolah = $this->Crud_model->listing('tbl_sekolah');
    $this->response(['status' => 'success', 'error' => false, 'user' => $sekolah], REST_Controller::HTTP_OK);
  }
}

/* End of file Controllername.php */
