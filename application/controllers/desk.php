<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Desk extends CI_Controller {

	function __construct() {
	
        parent::__construct();
		
		$this->load->library('session');
		$this->load->model('desk_model', '', TRUE);
    }
	
	public function index()
	{
		$this->check_session();
		$status = "'Queue','Open'";
		$data['desk_count'] = $this->desk_model->desk_status($status);
		$data['pending_count'] = $data['desk_count'];
		$completed_status = "'Close'";
		$data['completed_count'] = $this->desk_model->desk_status($completed_status);
		$data["pending_queue"] = $this->desk_model->get_queue('Pending');
		$data["done_queue"] = $this->desk_model->get_queue('Complete');
		$data['main_content'] = 'desk';		
		$this->load->view('common/template', $data);
	}
	public function test(){
		$data["pending_queue"] = $this->desk_model->get_queue('Pending');
		print_r($data["pending_queue"]);
		
		$data["done_queue"] = $this->desk_model->get_queue('Complete');
		print_r($data["done_queue"]);
		
	}
	
	public function search()
	{
		//echo'hi';exit;
		$desk_status = $this->desk_model->desk_status();
			//print_r($desk_status);exit;
			$data['desk_status']= $desk_status;
			$desk_status_done = $this->desk_model->desk_status_done();
			//print_r($desk_status);exit;
			$data['desk_status_done']= $desk_status_done;
		$data['main_content'] = 'common/data';
		
		//print_r($data);
		$this->load->view('common/template', $data);
	}
	public function desk_status($mrd_no=""){
		$this->check_session();
		$search = $this->desk_model->search_patient();
		
		if(empty($search)){
			$data['msg'] = "<div class='error-summary'>Patient Doesnot exist</div>";
		}
		else {
			$data['search']= $search;
		}
		if($mrd_no!=""){
			$desk_status = $this->desk_model->desk_status_queue($mrd_no);
			//print_r($desk_status);exit;
			$data['desk_status']= $desk_status;
			$desk_status_done = $this->desk_model->desk_status_done();
			//print_r($desk_status);exit;
			$data['desk_status_done']= $desk_status_done;
		}
		elseif($mrd_no==""){
			$desk_status = $this->desk_model->desk_status();
			//print_r($desk_status);exit;
			$data['desk_status']= $desk_status;
			$desk_status_done = $this->desk_model->desk_status_done();
			//print_r($desk_status);exit;
			$data['desk_status_done']= $desk_status_done;
		}
		$data['main_content'] = 'desk';
		$this->load->view('common/template', $data);
	}
	
	public function done($mrd_no=""){
		$this->check_session();
		$status = "'Queue','Open'";
		$data['desk_count'] = $this->desk_model->desk_status($status);
		$data['pending_count'] = $data['desk_count'];
		$completed_status = "'Close'";
		$data['completed_count'] = $this->desk_model->desk_status($completed_status);
		$done = $this->desk_model->done($mrd_no);
		//$desk_status = $this->desk_model->desk_status();
			//print_r($desk_status);exit;
		//$data['desk_status']= $desk_status;
		//$desk_status_done = $this->desk_model->desk_status_done();
			//print_r($desk_status);exit;
		//$data['desk_status_done']= $desk_status_done;
		
		$data["pending_queue"] = $this->desk_model->get_queue('Pending');
		$data["done_queue"] = $this->desk_model->get_queue('Complete');
                $this->session->unset_userdata('curr_mrdno');
		//$data['main_content'] = 'desk';		
		//$this->load->view('common/template', $data);
                redirect("desk");
	}
	
	
	public function remove($mrd_no=""){
		$this->check_session();
		$remove = $this->desk_model->remove($mrd_no);
		$data['main_content'] = 'desk';
		$this->load->view('common/template', $data);
		redirect("desk/desk_status");
	}
        
        public function remove_patient_entry($mrdno){
          $this->desk_model->remove_patient_entry($mrdno);
          redirect("desk");
        }
	
	
	function check_session(){
		if(!$this->session->userdata('admin_logged_in') || $this->session->userdata('admin_logged_in')==''){
			redirect("login");
		}
	}
	
}
