<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Anak extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    is_logged_in_admin();
  }


  public function index()
  {

    $this->load->model('admin/Admin_model', 'AM');

    $anak = $this->AM->listAnak();
    $data = [
      'add'      => 'admin/anak/add',
      'edit'      => 'admin/anak/edit/',
      'delete'      => 'admin/anak/delete/',
      'anak'      => $anak,
      'content'   => 'admin/anak/index'
    ];

    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  function add()
  {

    $this->load->helper('string');

    $user = $this->Crud_model->listingOneAll('tbl_user', 'role', 'user');
    $sekolah =  $this->Crud_model->listing('tbl_sekolah');

    $valid = $this->form_validation;

    $valid->set_rules('nama_anak', 'Nama Anak', 'required');

    if ($valid->run() === FALSE) {
      $data = [
        'title'     => 'Tambah Anak',
        'add'       => 'admin/anak/add',
        'back'      => 'admin/anak',
        'user'      => $user,
        'sekolah'      => $sekolah,
        'content'   => 'admin/anak/add'
      ];
      $this->load->view('admin/layout/wrapper', $data, FALSE);
    } else {
      $i = $this->input;
      $data = [
        'id_anak'      => random_string(),
        'nama_anak'     => $i->post('nama_anak'),
        'umur'     => $i->post('umur'),
        'id_user'     => $i->post('id_user'),
        'id_sekolah'          => $i->post('id_sekolah')
      ];
      $this->Crud_model->add('tbl_anak', $data);
      $this->session->set_flashdata('msg', 'ditambah');
      redirect('admin/anak/add', 'refresh');
    }
  }

  function edit($id_anak)
  {
    $anak = $this->Crud_model->listingOne('tbl_anak', 'id_anak', $id_anak);
    $user = $this->Crud_model->listingOneAll('tbl_user', 'role', 'user');
    $sekolah =  $this->Crud_model->listing('tbl_sekolah');

    $valid = $this->form_validation;

    $valid->set_rules('nama_anak', 'Nama Anak', 'required');

    if ($valid->run() === FALSE) {
      $data = [
        'title'     => 'Edit ' . $anak->nama_anak,
        'edit'       => 'admin/anak/edit/',
        'back'      => 'admin/anak',
        'anak'      => $anak,
        'user'      => $user,
        'sekolah'      => $sekolah,
        'content'   => 'admin/anak/edit'
      ];
      $this->load->view('admin/layout/wrapper', $data, FALSE);
    } else {
      $i = $this->input;
      $data = [
        'id_anak'      => $id_anak,
        'nama_anak'     => $i->post('nama_anak'),
        'id_user'     => $i->post('id_user'),
        'id_sekolah'          => $i->post('id_sekolah')
      ];
      $this->Crud_model->edit('tbl_anak', 'id_anak', $id_anak, $data);
      $this->session->set_flashdata('msg', 'diedit');
      redirect('admin/anak/edit/' . $id_anak, 'refresh');
    }
  }

  function delete($id_anak)
  {

    $this->Crud_model->delete('tbl_anak', 'id_anak', $id_anak);
    $this->session->set_flashdata('msg', 'dihapus');
    redirect('admin/anak');
  }
}
