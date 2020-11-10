<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Auth extends REST_Controller
{


  public function __construct()
  {
    parent::__construct();
  }


  public function index_post()
  {
    $data = [
      'username' => $this->post('username'),
      'password' => sha1($this->post('password'))
    ];
    $this->db->where($data);
    $user = $this->db->get('tbl_user')->row();

    if ($user) {
      $this->response(['status' => 'success', 'error' => false, 'user' => $user], 201);
    } else {
      $this->response(['status' => 'failed', 'error' => false,], 502);
    }
  }
}

/* End of file Controllername.php */
