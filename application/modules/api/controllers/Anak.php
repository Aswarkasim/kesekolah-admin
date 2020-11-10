<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Anak extends REST_Controller
{


  public function index_get()
  {

    $this->load->model('admin/Admin_model', 'AM');

    $id_anak = $this->get('id_anak');
    $id_sekolah = $this->get('id_sekolah');
    $id_user = $this->get('id_user');
    if ($id_anak) {
      $child = $this->AM->detailChild($id_anak);
    } else if ($id_user) {
      $child = $this->AM->listChildInUser($id_user);
    } else if ($id_sekolah) {
      $child = $this->AM->listChildInSchool($id_sekolah);
    } else {
      $child = $this->db->get('tbl_anak')->result();
    }
    $this->response($child, REST_Controller::HTTP_OK);
  }
}
