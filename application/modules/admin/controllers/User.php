<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        is_logged_in_admin();
    }


    public function index()
    {
        $user = $this->Crud_model->listingOneAll('tbl_user', 'role', 'user');
        $data = [
            'add'      => 'admin/user/add',
            'edit'      => 'admin/user/edit/',
            'delete'      => 'admin/user/delete/',
            'user'      => $user,
            'content'   => 'admin/user/index'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function driver()
    {
        $user = $this->Crud_model->listingOneAll('tbl_user', 'role', 'driver');
        $data = [
            'add'      => 'admin/user/add',
            'edit'      => 'admin/user/edit/',
            'delete'      => 'admin/user/delete/',
            'user'      => $user,
            'content'   => 'admin/user/index'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    function userData()
    {

        $user = $this->Crud_model->listingUser();
        echo json_encode($user);
    }

    function add()
    {

        $this->load->helper('string');


        $valid = $this->form_validation;

        $valid->set_rules('username', 'Nama User', 'required');
        $valid->set_rules('email', 'Email', 'required|is_unique[tbl_user.email]|valid_email');
        $valid->set_rules('password', 'Password', 'required');
        $valid->set_rules('re_password', 'Retype Password', 'required|matches[password]');

        if ($valid->run() === FALSE) {
            $data = [
                'title'     => 'Tambah User',
                'add'       => 'admin/user/add',
                'back'      => 'admin/user',
                'content'   => 'admin/user/add'
            ];
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $i = $this->input;
            $data = [
                'id_user'      => random_string(),
                'username'     => $i->post('username'),
                'email'         => $i->post('email'),
                'namalengkap'         => $i->post('namalengkap'),
                'password'      => sha1($i->post('password')),
                'role'          => $i->post('role'),
                'gender'          => $i->post('gender'),
                'nohp'          => $i->post('nohp'),
                'no_ktp'          => $i->post('no_ktp'),
                'nohp'          => $i->post('nohp'),
                'latitude'          => $i->post('latitude'),
                'longtitude'          => $i->post('longtitude'),
                'is_active'     => $i->post('is_active')
            ];
            $this->Crud_model->add('tbl_user', $data);
            $this->session->set_flashdata('msg', 'ditambah');
            redirect('admin/user/add', 'refresh');
        }
    }

    function edit($id_user)
    {
        $user = $this->Crud_model->listingOne('tbl_user', 'id_user', $id_user);

        $valid = $this->form_validation;

        $valid->set_rules('username', 'Nama User', 'required');
        $valid->set_rules('email', 'Email', 'required|valid_email');
        $valid->set_rules('password', 'Password', 'matches[re_password]');
        $valid->set_rules('re_password', 'Retype Password', 'matches[password]');

        if ($valid->run() === FALSE) {
            $data = [
                'title'     => 'Edit ' . $user->username,
                'edit'       => 'admin/user/edit/',
                'back'      => 'admin/user',
                'user'      => $user,
                'content'   => 'admin/user/edit'
            ];
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $i = $this->input;

            $password = "";
            if ($i->post('password') != "") {
                $password = sha1($i->post('password'));
            } else {
                $password = $user->password;
            }
            $data = [
                'id_user'       => $id_user,
                'username'     => $i->post('username'),
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
            $this->Crud_model->edit('tbl_user', 'id_user', $id_user, $data);
            $this->session->set_flashdata('msg', 'diedit');
            redirect('admin/user/edit/' . $id_user, 'refresh');
        }
    }

    function delete($id_user)
    {

        $this->Crud_model->delete('tbl_user', 'id_user', $id_user);
        $this->session->set_flashdata('msg', 'dihapus');
        redirect('admin/user');
    }
}
