<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
  function listAnak()
  {
    $this->db->select('tbl_anak.*,
                            tbl_user.alamat, 
                            tbl_user.latitude, 
                            tbl_user.longtitude, 
                            tbl_sekolah.nama_sekolah')
      ->from('tbl_anak')
      ->join('tbl_user', 'tbl_anak.id_user = tbl_user.id_user', 'LEFT')
      ->join('tbl_sekolah', 'tbl_anak.id_sekolah = tbl_sekolah.id_sekolah', 'LEFT');
    return $this->db->get()->result();
  }


  function listChildInSchool($id_sekolah)
  {
    $this->db->select('tbl_anak.*,
                            ttbl_user.alamat, 
                            tbl_user.latitude, 
                            tbl_user.longtitude, 
                            tbl_sekolah.nama_sekolah')
      ->from('tbl_anak')
      ->join('tbl_user', 'tbl_anak.id_user = tbl_user.id_user', 'LEFT')
      ->join('tbl_sekolah', 'tbl_anak.id_sekolah = tbl_sekolah.id_sekolah', 'LEFT')
      ->where('tbl_anak.id_sekolah', $id_sekolah);
    return $this->db->get()->result();
  }

  function listChildInUser($id_user)
  {
    $this->db->select('tbl_anak.*,
                            tbl_user.alamat, 
                            tbl_user.latitude, 
                            tbl_user.longtitude, 
                            tbl_sekolah.nama_sekolah')
      ->from('tbl_anak')
      ->join('tbl_user', 'tbl_anak.id_user = tbl_user.id_user', 'LEFT')
      ->join('tbl_sekolah', 'tbl_anak.id_sekolah = tbl_sekolah.id_sekolah', 'LEFT')
      ->where('tbl_anak.id_user', $id_user);
    return $this->db->get()->result();
  }

  function detailChild($id_anak)
  {
    $this->db->select('tbl_anak.*,
                            tbl_user.alamat, 
                            tbl_user.latitude, 
                            tbl_user.longtitude, 
                            tbl_sekolah.nama_sekolah')
      ->from('tbl_anak')
      ->join('tbl_user', 'tbl_anak.id_user = tbl_user.id_user', 'LEFT')
      ->join('tbl_sekolah', 'tbl_anak.id_sekolah = tbl_sekolah.id_sekolah', 'LEFT')
      ->where('tbl_anak.id_anak', $id_anak);
    return $this->db->get()->row();
  }
}

/* End of file ModelName.php */
