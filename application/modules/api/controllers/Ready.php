<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Ready extends REST_Controller
{
  function index_put()
  {
    $id_anak = $this->put('id_anak');
    $data = [
      'is_ready' => $this->put('is_ready')
    ];
    $this->db->where('id_anak', $id_anak);
    $update = $this->db->update('tbl_anak', $data);
    if ($update) {
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
}
