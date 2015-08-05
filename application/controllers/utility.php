<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utility extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('utility_model', '', TRUE);
		
    }
    	
	public function index(){
		// This function is to create new investigation table from old one
		$this->utility_model->generate_tb();		
	}
}
