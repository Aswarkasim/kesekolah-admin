<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in_admin();
    }


    public function index()
    {
        $id_admin = $this->session->userdata('id_admin');
        $admin = $this->Crud_model->listingOne('tbl_admin', 'id_admin', $id_admin);

        $driver = $this->Crud_model->listingOneAll('tbl_user', 'role', 'driver');
        $user = $this->Crud_model->listingOneAll('tbl_user', 'role', 'user');
        $sekolah = $this->Crud_model->listing('tbl_sekolah');
        $anak = $this->Crud_model->listing('tbl_anak');

        $data = [
            'title'     => 'Dashboard',
            'admin'      => $admin,
            'driver'      => $driver,
            'user'      => $user,
            'sekolah'      => $sekolah,
            'anak'      => $anak,
            'content'   => 'admin/dashboard/index'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
}

/* End of file Dashboard.php */
