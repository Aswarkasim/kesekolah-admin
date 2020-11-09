<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sekolah extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    is_logged_in_admin();
  }


  public function index()
  {
    $sekolah = $this->Crud_model->listing('tbl_sekolah');
    $data = [
      'add'      => 'admin/sekolah/add',
      'edit'      => 'admin/sekolah/edit/',
      'delete'      => 'admin/sekolah/delete/',
      'sekolah'      => $sekolah,
      'content'   => 'admin/sekolah/index'
    ];

    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  function add()
  {

    $this->load->helper('string');

    $valid = $this->form_validation;

    $valid->set_rules('nama_sekolah', 'Nama Sekolah', 'required');

    if ($valid->run() === FALSE) {
      $data = [
        'title'     => 'Tambah Sekolah',
        'add'       => 'admin/sekolah/add',
        'back'      => 'admin/sekolah',
        'content'   => 'admin/sekolah/add'
      ];
      $this->load->view('admin/layout/wrapper', $data, FALSE);
    } else {
      $i = $this->input;
      $data = [
        'id_sekolah'      => random_string(),
        'nama_sekolah'     => $i->post('nama_sekolah'),
        'alamat'     => $i->post('alamat'),
        'lokasi'     => $i->post('lokasi'),
        'latitude'          => $i->post('latitude'),
        'longtitude'          => $i->post('longtitude')
      ];
      $this->Crud_model->add('tbl_sekolah', $data);
      $this->session->set_flashdata('msg', 'ditambah');
      redirect('admin/sekolah/add', 'refresh');
    }
  }

  function edit($id_sekolah)
  {
    $sekolah = $this->Crud_model->listingOne('tbl_sekolah', 'id_sekolah', $id_sekolah);

    $valid = $this->form_validation;

    $valid->set_rules('sekolahname', 'Nama Sekolah', 'required');
    $valid->set_rules('email', 'Email', 'required|valid_email');
    $valid->set_rules('password', 'Password', 'matches[re_password]');
    $valid->set_rules('re_password', 'Retype Password', 'matches[password]');

    if ($valid->run() === FALSE) {
      $data = [
        'title'     => 'Edit ' . $sekolah->sekolahname,
        'edit'       => 'admin/sekolah/edit/',
        'back'      => 'admin/sekolah',
        'sekolah'      => $sekolah,
        'content'   => 'admin/sekolah/edit'
      ];
      $this->load->view('admin/layout/wrapper', $data, FALSE);
    } else {
      $i = $this->input;

      $password = "";
      if ($i->post('password') != "") {
        $password = sha1($i->post('password'));
      } else {
        $password = $sekolah->password;
      }
      $data = [
        'id_sekolah'       => $id_sekolah,
        'sekolahname'     => $i->post('sekolahname'),
        'email'         => $i->post('email'),
        'namalengkap'         => $i->post('namalengkap'),
        'password'      => $password,
        'role'          => $i->post('role'),
        'gender'          => $i->post('gender'),
        'nohp'          => $i->post('nohp'),
        'no_ktp'          => $i->post('no_ktp'),
        'nohp'          => $i->post('nohp'),
        'latitude'          => $i->post('latitude'),
        'longtitude'          => $i->post('longtitude'),
        'is_active'     => $i->post('is_active')
      ];
      $this->Crud_model->edit('tbl_sekolah', 'id_sekolah', $id_sekolah, $data);
      $this->session->set_flashdata('msg', 'diedit');
      redirect('admin/sekolah/edit/' . $id_sekolah, 'refresh');
    }
  }

  function delete($id_sekolah)
  {

    $this->Crud_model->delete('tbl_sekolah', 'id_sekolah', $id_sekolah);
    $this->session->set_flashdata('msg', 'dihapus');
    redirect('admin/sekolah');
  }
}
