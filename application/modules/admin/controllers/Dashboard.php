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

        $data = [
            'title'     => 'Dashboard',
            'user'      => $admin,
            'content'   => 'admin/dashboard/indexs'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
}

/* End of file Dashboard.php */
