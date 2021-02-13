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
    $this->response([
      'error'   => false,
      'message' => 'Success',
      'anak'    => $child
    ], REST_Controller::HTTP_OK);
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
      $this->response([
        'error' => false,
        'message' => 'Data anak berhasil ditambahkan',
      ], REST_Controller::HTTP_OK);
    } else {
      $this->response([
        'error' => true,
        'message' => 'Data anak gagal ditambahkan',
      ], 502);
    }
  }

  function listJemput_get()
  {
    $id_sekolah = $this->get('id_sekolah');
    $is_jemput  = $this->get('is_jemput');

    // $this->db->where('id_sekolah', $id_sekolah);
    // $this->db->where('is_jemput', $is_jemput);
    $this->load->model('admin/Admin_model', 'AM');

    $jemput = $this->AM->listJemput($id_sekolah, $is_jemput);

    if ($jemput) {
      $this->response($jemput, REST_Controller::HTTP_OK);
    } else {
      $this->response(array('status' => 'fail', 502));
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
      $this->response([
        'error' => false,
        'message' => 'Data jemput berhasil diubah',
        'data'  => $data
      ], 200);
    } else {
      $this->response([
        'error' => true,
        'message' => 'Data jemput gagal diubah',
      ], 502);
    }
  }

  function is_ready_put()
  {
    $id_anak = $this->put('id_anak');
    $data = [
      'id_anak'   => $id_anak,
      'is_ready' => $this->put('is_ready')
    ];
    $this->db->where('id_anak', $id_anak);
    $update = $this->db->update('tbl_anak', $data);
    if (!$update) {
      $this->response([
        'error' => false,
        'message' => 'Data siap anak berhasil diubah',
      ], 200);
    } else {
      $this->response([
        'error' => true,
        'message' => 'Data siap anak gagal diubah',
      ], 502);
    }
  }


  function is_ready_post()
  {
    $id_anak = $this->post('id_anak');
    $data = [
      'is_ready' => $this->post('is_ready')
    ];
    $this->db->where('id_anak', $id_anak);
    $update = $this->db->update('tbl_anak', $data);


    $this->db->where('id_anak', $id_anak);
    $get = $this->db->get('tbl_anak');
    if ($update) {
      $this->response([
        'error' => false,
        'anak'  => $id_anak,
        'message' => 'Data siap anak berhasil dipost',
      ], 200);
    } else {
      $this->response([
        'error' => true,
        'message' => 'Data siap anak gagal dipost',
      ], 502);
    }
  }

  function is_hadir_put()
  {

    $id_anak = $this->put('id_anak');
    $data = [
      'is_hadir' => $this->put('is_hadir')
    ];

    $this->db->where('id_anak', $id_anak);
    $update = $this->db->update('tbl_anak', $data);

    // $update = $this->Crud_model->edit('tbl_anak', 'id_anak', $id_anak, $data);

    if ($update) {
      $this->response([
        'error'     => false,
        'message'   => 'Data hadir anak berhasil diubah',
        'is_hadir'  => $data,
        'id_anak'   => $id_anak
      ], 200);
    } else {
      $this->response([
        'error' => true,
        'message' => 'Data hadir anak gagal diubah',
      ], 502);
    }
  }
}
