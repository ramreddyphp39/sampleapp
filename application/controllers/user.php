<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->library('session');

        $this->load->helper('url');
    }

    public function index() {
        if (($this->session->userdata('user_id') != "")) {
//redirect(site_url('home'));
            $this->load->view("home");
        } else {
            $this->load->view("register_view");
        }
    }

    public function login() {
        $rules = array(array('field' => 'l_email', 'label' => 'Email', 'rules' => 'required|valid_email'),
            array('field' => 'l_pass', 'label' => 'Password', 'rules' => 'required'));
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $auth = $this->user_model->login($this->input->post('l_email'), $this->input->post('l_pass'));
            if ($auth) {
                $this->load->view("home");
//redirect(site_url('home'));
            } else {
                $this->index();
            }
        }
    }

    public function register() {
        $this->load->view('register_view'); //loads the register_view.php file in views folder
       
    }

    public function do_register() {
        $rules = array(
            array('field' => 'username', 'label' => 'User Name', 'rules' => 'trim|required|min_length[4]|max_length[12]'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|is_unique[users.email]'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|min_length[6]'),
            //array('field' => 'photo', 'label' => 'Photo', 'rules' => 'required'),
            array('field' => 'gender', 'label' => 'Gender', 'rules' => 'required')
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register_view');
        } else {
            $this->user_model->register_user();
            $this->load->view('success');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(site_url());
    }

    public function display_all() {
        $data = array();
        $data['result'] = $this->user_model->display_users();
        $this->load->view('all_users', $data);
    }

    function delete_user($id = null) {
        $this->user_model->del_user($id);
        //$this->view('all_users', $data);
        $this->session->set_flashdata('message', '<p>Product were successfully deleted!</p>');
        redirect('user/display_all');
    }

    function edit_user($id) {
        $product = $this->user_model->get_user($id);
        $this->data['title'] = 'Edit User';
        $rules = array(
            array('field' => 'username', 'label' => 'User Name', 'rules' => 'trim|required|min_length[4]|max_length[12]'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email')
        );

        if (isset($_POST) && !empty($_POST)) {
            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'gender' => $this->input->post('gender'),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() === true) {
                $this->user_model->update_user($id, $data);

                $this->session->set_flashdata('message', "<p>User updated successfully.</p>");

                redirect(base_url() . 'index.php/user/display_all');
            }
        }

        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

        $this->data['product'] = $product;

        //display the edit user form
        $this->data['username'] = array(
            'name' => 'username',
            'id' => 'username',
            'type' => 'text',
            'style' => 'width:300px;',
            'value' => $this->form_validation->set_value('username', $product['username']),
        );

        $this->data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'type' => 'text',
            'value' => $this->form_validation->set_value('email', $product['email']),
        );







        $this->load->view('edit_user', $this->data);
    }

    function search_user() {
//$this->load->view('adduser');
        $search_trm = $this->input->post('search_term');
        $data['result'] = $this->user_model->searchByName($search_trm);
        if (!empty($data))
            $this->load->view('all_users', $data);
    }

    function get_users_auto() {

        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->user_model->get_auto_user($q);
        }
    }
    
   function upload(){
        $this->load->view('upload_form');
   }

}
