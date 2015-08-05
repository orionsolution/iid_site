<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	function __construct() {
	
        parent::__construct();
		
		$this->load->library('session');
		$this->load->model('search_model', '', TRUE);
    }
	
	public function index($keyword)
	{
		//echo 'keyword: '. $keyword;exit;
		$this->check_session();	
		$data["keyword"]=$keyword;
		$data['search_result'] = $this->search_model->get_patient($keyword);
		$this->load->view('common/search_view', $data); 

	}
	
	public function queue($mrdno)
	{
		$this->check_session();			
		$this->search_model->queue_patient($mrdno);	
		redirect("desk"); 
	}	
	
		
	function check_session(){
		if(!$this->session->userdata('admin_logged_in') || $this->session->userdata('admin_logged_in')==''){
			redirect("login");
		}
	}
	
}
