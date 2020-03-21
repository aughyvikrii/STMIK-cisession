<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->model('M_Users');
    }

    public function index() {
        // If the user has logged in
        if( $this->session->userdata('username') ) redirect('login/admin_page');

        //tampung masukan form
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // create validation rules
        $this->form_validation->set_rules('username','username','required');
        $this->form_validation->set_rules('password','password','required');

        if( $this->form_validation->run() == TRUE ) { // if validation is successful

            // check user exists or not
            if( !$user = $this->M_Users->getUserByUsernamePassword($username,$password) ) die("<h1>Username / Password salah</h1>");
            else {

                if( !$user->last_login ) $user->last_login = date('Y-m-d H:i:s');
                $user->login_count += 1;

                // save data in session
                $this->session->set_userdata( (array) $user );

                // Update last login & login count
                $this->M_Users->UpdateLastAndCountLogin($username);

                // redirect to admin page
                redirect('login/admin_page');
            }

        } else { // else displays the login form
            $this->load->view('login/index');
        }

    }

    public function admin_page() {
        $this->load->view('login/admin_page');
    }

    public function logout() {
        $this->session->sess_destroy();

        redirect('login/index');
    }

    public function register(){
        if( $this->session->userdata('username') ) redirect('login/admin_page');

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('username','username','required');
        $this->form_validation->set_rules('password','password','required');

        if( $this->form_validation->run() == TRUE ) {
            
            if( ! $this->M_Users->username_exists($username) ) die('<h1>Username tidak dapat digunakan!</h1>');
            else {
                
                $insert = $this->M_Users->insert([
                    'username'  => $username,
                    'password'  => md5($password)
                ]);

                if( ! $insert ) die("Pendaftaran gagal!");
                else die("<h1>Pendaftaran berhasil! silahkan <a href='".site_url('login/index')."'>Login</a></h1>");
            }

        } else {
            $this->load->view('login/register');
        }
    }
}
