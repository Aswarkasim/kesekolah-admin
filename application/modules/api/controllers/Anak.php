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

  function index_post()
  {

    $this->load->helper('string');

    $data = [
      'id_anak'       => random_string(),
      'nama_anak'     => $this->post('nama_anak'),
      'umur'          => $this->post('umur'),
      'id_user'       => $this->post('id_user'),
      'id_sekolah'    => $this->post('id_sekolah')
    ];
    $insert = $this->db->insert('tbl_anak', $data);
    if ($insert) {
      $this->response(['error' => 'false', 'data' => $data], REST_Controller::HTTP_OK);
    } else {
      $this->response(['error' => 'true'], 502);
    }
  }

  function is_jemput_put()
  {
    $id_anak = $this->put('id_anak');
    $data = [
      'is_jemput' => $this->put('is_jemput')
    ];
    $this->db->where('id_anak', $id_anak);
    $update = $this->db->update('tbl_anak', $data);
    if ($update) {
      $this->response(['error' => 'false', 'data' => $data], 200);
    } else {
      $this->response(['error' => 'true'], 502);
    }
  }

  function is_ready_put()
  {
    $id_anak = $this->put('id_anak');
    $data = [
      'is_ready' => $this->put('is_ready')
    ];
    $this->db->where('id_anak', $id_anak);
    $update = $this->db->update('tbl_anak', $data);
    if ($update) {
      $this->response(['error' => 'false', 'data' => $data], 200);
    } else {
      $this->response(['error' => 'true'], 502);
    }
  }
}
