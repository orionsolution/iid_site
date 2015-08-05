<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('user_admin_model', '', TRUE);
    }

    function index() {
        if ($this->session->userdata('admin_logged_in')=="Yes") {
            redirect('desk', 'refresh');
			//redirect('welcome', 'refresh');
        } else {
            $this->load->helper('form');
            $this->load->view('login');
        }
    }

    function logout() {
		/*$reset_patient = $this->user_admin_model->reset_patient();*/
        $this->session->unset_userdata('admin_logged_in');
        $this->session->unset_userdata('curr_mrdno');
        //session_destroy();
        redirect('login', 'refresh');
    }
		
    function verifylogin() {
		$this->load->library('form_validation');
        $this->form_validation->set_rules('user', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pswd', 'Password', 'trim|required|xss_clean|callback_check_database');
		$this->form_validation->set_error_delimiters('<span class="error">','</span><br />');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            redirect('login', 'refresh');
        }
    }

    function check_database($password) {
        $username = $this->input->post('user');
        $result = $this->user_admin_model->login($username, $password);
        if ($result):
            $this->session->set_userdata('admin_logged_in',"Yes");
            return TRUE;
        else:
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        endif;
    }
		
    function check_session(){
		if(!$this->session->userdata('admin_logged_in') || $this->session->userdata('admin_logged_in')==''){
			redirect("login");
		}
	}
}
