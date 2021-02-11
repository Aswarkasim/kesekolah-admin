<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('Crud_model');
  }


  public function index_get()
  {
    $id_user = $this->get('id_user');
    if ($id_user == '') {
      $user = $this->Crud_model->listing('tbl_user');
    } else {
      $user  = $this->Crud_model->listingOne('tbl_user', 'id_user', $id_user);
    }
    $this->response(['status' => 'success', 'error' => false, 'user' => $user], REST_Controller::HTTP_OK);
  }

  function index_put()
  {
    $id_user = $this->put('id_user');
    print_r($id_user);
    die;
    $data = [
      'id_user'            => $id_user,
      'username'      => $this->put('username'),
      'email'         => $this->put('email'),
      'namalengkap'   => $this->put('namalengkap'),
      'gender'        => $this->put('gender'),
      'nohp'          => $this->put('nohp'),
      'alamat'        => $this->put('alamat'),
      'no_ktp'        => $this->put('no_ktp')
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


  function gambar_put()
  {

    $this->load->library('upload');

    $id_user = $this->put('id_user');
    $user = $this->Crud_model->listingOne('tbl_user', 'id_user', $id_user);
    print_r($user);
    $this->response(['data' => $id_user], 200);
    die;

    if (!empty($_FILES['gambar']['name'])) {
      $config['upload_path']   = './assets/uploads/images/';
      $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
      $config['max_size']      = '100000'; // KB 
      $this->upload->initialize($config);

      if (!$this->upload->do_upload('gambar')) {
        $error = $this->upload->display_errors();
        $this->response([
          'status'    => false,
          'message'   => $error
        ], REST_Controller::HTTP_NOT_FOUND);
      } else {

        if ($user->gambar != "") {
          unlink($user->gambar);
        }

        $upload_data = ['uploads' => $this->upload->data()];
        $data = [
          'id_user'       => $id_user,
          'gambar'        => $config['upload_path'] . $upload_data['uploads']['file_name']
        ];
        // $update =   $this->Crud_model->edit('tbl_user', 'id_user', $id_user, $data);
        $this->db->where('id_user', $id_user);
        $update = $this->db->update('tbl_user', $id_user);

        if ($update) {
          $this->response(['data' => $data], REST_Controller::HTTP_OK);
        } else {
          $this->response(array('status' => 'fail', 502));
        }
      }
    }
  }


  public function do_upload()
  {
    $postData = $this->post();
    $config = array(
      'upload_path' => "img/logo",             //path for upload
      'allowed_types' => "gif|jpg|png|jpeg",   //restrict extension
      'max_size' => '100',
      'max_width' => '1024',
      'max_height' => '768',
      'file_name' => 'logo_' . date('ymdhis')
    );
    $this->load->library('upload', $config);

    if ($this->upload->do_upload('logo')) {
      $data = array('upload_data' => $this->upload->data());
      $path = $config['upload_path'] . '/' . $data['upload_data']['orig_name'];
      // Write query to store image details of login user { }
      $returndata = array('status' => 0, 'data' => 'user details', 'message' => 'image uploaded successfully');
      $this->set_response($returndata, 200);
    } else {
      $error = array('error' => $this->upload->display_errors());
      $returndata = array('status' => 0, 'data' => $error, 'message' => 'image upload failed');
      $this->set_response($returndata, 200);
    }
  }



  function file_put()
  {
    // Upload a file to the server
    $uploadDir = './assets/uploads/images/';
    $fileName = underscore($_FILES['file']['name']);
    $uploadFile = $uploadDir . $fileName;
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
      $response['status'] = 'Success';
      $response['nama_file'] = $uploadFile;
      $response['message'] = 'The file has been uploaded!';
    } else {
      $response['status'] =  'Failure';
    }
    $this->response($response, REST_Controller::HTTP_OK);
    //$this->response($_FILES);
  }
}
