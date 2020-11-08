<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_CONTROLLER.php';

class User extends REST_Controller
{

  public function __construct()
  {
    parent::__construct();
  }


  public function index_get()
  {
    $id_user = $this->get('id_user');
    if ($id_user == '') {
      $user = $this->Crud_model->listing('tbl_user');
    } else {
      $user  = $this->Crud_model->listingOne('tbl_user', 'id_user', $id_user);
    }
    $this->response($user, REST_Controller::HTTP_OK);
  }

  function index_put()
  {
    $id_user = $this->put('id_user');
    $data = [
      'id_user'            => $id_user,
      'username'      => $this->put('username'),
      'email'         => $this->put('email'),
      'namalengkap'   => $this->put('namalengkap'),
      'gender'        => $this->put('gender'),
      'nohp'          => $this->put('nohp'),
      'alamat'        => $this->put('alamat'),
      'no_ktp'        => $this->put('no_ktp'),
      'nohp'          => $this->put('nohp')
    ];

    //$update = $this->Crud_model->edit('tbl_user', 'id_user', $id_user, $data);
    $this->db->where('id_user', $id_user);
    $update = $this->db->update('tbl_user', $data);
    if ($update) {
      $this->response($data, 202);
    } else {
      $this->response(array('status' => 'fail', 502));
    }
  }

  function index_delete()
  {
    $id_user = $this->delete('id_user');
    $this->db->where('id_user', $id_user);
    $delete = $this->db->delete('tbl_user');
    if ($delete) {
      $this->response(['status' => 'success'], 201);
    } else {
      $this->response(['status' => 'failed'], 502);
    }
  }
}
