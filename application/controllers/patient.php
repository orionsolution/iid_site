<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Patient extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('patient_model', '', TRUE);
    $this->load->model('desk_model', '', TRUE);
  }

  public function index() {
    $this->check_session();
    $data['main_content'] = 'visit_view';
    $this->load->view('common/template', $data);
    //$this->load->patient_model();
  }
  
  
  // method to load data on visit view

  public function visit($mrd_no) {
	$this->check_session();
    $data['mrd_no'] = $mrd_no;
    $this->patient_model->patient_enter($mrd_no);
    $status = "'Queue','Open'";
    $data['desk_count'] = $this->desk_model->desk_status($status);
    $data['param_arr'] = $this->patient_model->get_param();
    $data['patient_info'] = $this->patient_model->patient_info($mrd_no);
    $data['patient_weight_details'] = $this->patient_model->get_patient_weight($mrd_no, 1);
    $data['patient_cd4_details'] = $this->patient_model->get_cd4($mrd_no, 1);
    $data['patient_creatinine_details'] = $this->patient_model->get_creatinine($mrd_no, 1);
    $data['patient_vl_details'] = $this->patient_model->get_vl($mrd_no, 1);
    $data['patient_regimen_details'] = $this->patient_model->get_regimen($mrd_no,1);
    $data['last_visit_date'] = $this->patient_model->get_patient_last_visit($mrd_no);
    $data['patient_lab_data'] = $this->patient_model->get_patient_lab_data($mrd_no);
    $data['date_cnt'] = 3;
    $data['curr_visit_arr'] = $this->get_curr_visit_records($mrd_no,date('Y-m-d'));
	
    $data['main_content'] = 'patient/visit_view';
    $this->session->set_userdata('curr_mrdno', $mrd_no);
    $this->load->view('common/template', $data);
  }

  public function patient_history($mrd_no) {
    $this->check_session();
    $data['mrd_no'] = $mrd_no;
    $this->patient_model->patient_enter($mrd_no);
    $status = "'Queue','Open'";
    $data['desk_count'] = $this->desk_model->desk_status($status);
    $data['param_arr'] = $this->patient_model->get_param();
    $data['patient_info'] = $this->patient_model->patient_info($mrd_no);
    $data['patient_weight_details'] = $this->patient_model->get_patient_weight($mrd_no, 1);
    $data['patient_cd4_details'] = $this->patient_model->get_cd4($mrd_no, 1);
    $data['patient_creatinine_details'] = $this->patient_model->get_creatinine($mrd_no, 1);
    $data['patient_vl_details'] = $this->patient_model->get_vl($mrd_no, 1);
    $data['last_visit_date'] = $this->patient_model->get_patient_last_visit($mrd_no);
    $data['patient_lab_data'] = $this->patient_model->get_patient_lab_data($mrd_no);
    $data['date_cnt'] = 'all';
    $data['main_content'] = 'patient/patient_history_view';
    $this->load->view('common/template', $data);
  }
  
  // to load data on add past view

  public function add_past_data($mrd_no) {
    $this->check_session();
    $data['mrd_no'] = $mrd_no;
    $this->patient_model->patient_enter($mrd_no);
    $status = "'Queue','Open'";
    $data['desk_count'] = $this->desk_model->desk_status($status);
    $data['param_arr'] = $this->patient_model->get_param();
    $data['patient_info'] = $this->patient_model->patient_info($mrd_no);    
    $data['last_visit_date'] = $this->patient_model->get_patient_last_visit($mrd_no);
    $data['patient_lab_data'] = $this->patient_model->get_patient_lab_data($mrd_no);
    $data['date_cnt'] = 3;
    $data['past_date'] = $this->input->post('past_date');
    $data['main_content'] = 'patient/past_data_view';
    $this->session->set_userdata('curr_mrdno', $mrd_no);
    $this->load->view('common/template', $data);
  }

  
  // to load data on add record view
  
  public function record($mrd_no, $visit_cnt = 'all') {
	$this->check_session();
    $data['date_cnt'] = '';
    $data["mrd_no"] = $mrd_no;
    $data["visit_cnt"] = $visit_cnt;	
    $date_str = $this->patient_model->get_patient_visited_dates($mrd_no, $visit_cnt);
    if ($date_str == ''):
	  $data['visit_arr'] = '';
	  $data['investigation_visit'] = '';
	  $this->load->view('patient/record_view', $data);
	else:	
		$past_date = trim($date_str,"'");
		if ($visit_cnt == 'all'):
		  $data['investigation_visit'] = $this->patient_model->get_investigation_data('pi_investigation', $mrd_no, $visit_cnt);
		else:
		  $data['investigation_visit'] = $this->patient_model->get_investigation_data('pi_investigation', $mrd_no, 1);
		endif;
		$date_arr = explode(",", str_replace("'", "", $date_str));
		$curr_visit_dt = '';
		$visit_arr = array();
		foreach ($date_arr as $curr_date):
		  $visit_arr[$curr_date] = $this->get_curr_visit_records($mrd_no,$curr_date);
		endforeach;
		$data['visit_arr'] = $visit_arr;
		$this->load->view('patient/record_view', $data);
	endif;
  }

  
  //get data for past record
  
  public function past_record($mrdno){
    $this->check_session();
    $data['date_cnt'] = '';
    $data["mrd_no"] = $mrdno;
    $past_date = $this->input->get('past_date');
	$past_date = str_replace(",","",$past_date);
	$view_name = $this->input->get('view_name');
    $past_date = date('Y-m-d', strtotime($past_date));
	
	$data['curr_inv_arr'] = $this->patient_model->get_curr_investigation_data($mrdno,$past_date);
	
    $history_data = $this->patient_model->get_curr_data('pi_history', $mrdno, $past_date, 'HIS');
    $examination_data = $this->patient_model->get_curr_data('pi_examination', $mrdno, $past_date, 'EXA');
    $diagnosis_data = $this->patient_model->get_curr_data('pi_diagnosis', $mrdno, $past_date, 'DIA');
    $treatment_data = $this->patient_model->get_curr_data('pi_treatment', $mrdno, $past_date, 'TRE');

    $curr_visit_arr = array();
    foreach ($history_data as $curr_hist):
      $curr_tm = $curr_hist['created_dt'];
      $curr_visit_arr[$curr_tm] = $curr_hist;
    endforeach;

    foreach ($examination_data as $curr_exam):
      $curr_tm = $curr_exam['created_dt'];      		
      $curr_visit_arr[$curr_tm] = $curr_exam;
    endforeach;

    foreach ($diagnosis_data as $curr_dia):
      $curr_tm = $curr_dia['created_dt'];      		
      $curr_visit_arr[$curr_tm] = $curr_dia;
    endforeach;

    foreach ($treatment_data as $curr_tre):
      $curr_tm = $curr_tre['created_dt'];      		
      $curr_visit_arr[$curr_tm] = $curr_tre;
    endforeach;



    krsort($curr_visit_arr);
    $data['curr_visit_arr'] = $curr_visit_arr;
	
	if(!empty($view_name)):
		$this->load->view($view_name,$data);
	else:
		$this->load->view('patient/past_record_view', $data);
	endif;
    
  }
  
  
  // get data for current visit records

  public function get_curr_visit_records($mrdno, $curr_dt) {
	$this->check_session();
    $history_data = $this->patient_model->get_curr_data('pi_history', $mrdno, $curr_dt, 'HIS');
    $examination_data = $this->patient_model->get_curr_data('pi_examination', $mrdno, $curr_dt, 'EXA');
    $diagnosis_data = $this->patient_model->get_curr_data('pi_diagnosis', $mrdno, $curr_dt, 'DIA');
    $treatment_data = $this->patient_model->get_curr_data('pi_treatment', $mrdno, $curr_dt, 'TRE');


     $curr_visit_arr = array();
    foreach ($history_data as $curr_hist):
      $curr_tm = $curr_hist['created_dt'];
      $curr_visit_arr[$curr_tm][] = $curr_hist;
    endforeach;

    foreach ($examination_data as $curr_exam):
      $curr_tm = $curr_exam['created_dt'];		
      $curr_visit_arr[$curr_tm][] = $curr_exam;
    endforeach;

    foreach ($diagnosis_data as $curr_dia):
      $curr_tm = $curr_dia['created_dt'];		
      $curr_visit_arr[$curr_tm][] = $curr_dia;
    endforeach;

    foreach ($treatment_data as $curr_tre):
		//echo "<pre>";print_r($curr_tre);echo "</pre><br>";
      $curr_tm = $curr_tre['created_dt'];		
      $curr_visit_arr[$curr_tm][] = $curr_tre;
    endforeach;


    krsort($curr_visit_arr);
	
	// if($curr_dt=="2014-03-11"):
		// echo "<br> 11-mar-2014";
		// print_r($curr_visit_arr);		
		// //exit;
	// endif;
	
	// if(!empty($curr_visit_arr)):
		// return $curr_visit_arr;
	// else:
		// return $curr_visit_arr = array();
	// endif;
    return $curr_visit_arr;
  }
  
  // add data in pi_history table

  public function add_hist($mrd_no = "") {
    $add_hist = $this->patient_model->add_hist($mrd_no);
  }
  
  // add data in pi_examination table

  public function add_exam($mrd_no = "") {
    $add_exam = $this->patient_model->add_exam($mrd_no);
  }
  
  // add data in pi_diagnosis table

  public function add_diag($mrd_no = "") {
    $add_diag = $this->patient_model->add_diag($mrd_no);
  }
  
  // add data in pi_treatment table

  public function add_treat($mrd_no = "") {
    $add_treat = $this->patient_model->add_treat($mrd_no);
  }
  
  // add data in pi_investigation table

  public function add_inv($mrd_no = "") {
    $add_inv = $this->patient_model->add_inv($mrd_no);
  }
  
  public function add_freq_inv($mrd_no = ""){
	$this->patient_model->add_freq_inv($mrd_no);
  }
  
  

  /*   * *********** dharmesh **************** */

  // public function search_patient() {
    // echo "Some value return";
  // }
  
  
  // to display the add patient view

  public function add() {
    $this->check_session();
    $status = "'Queue','Open'";
    $data['desk_count'] = $this->desk_model->desk_status($status);
    $data['main_content'] = 'patient/add_view';
    $data['misc_data'] = $this->patient_model->misc_data();
    $this->load->view('common/template', $data);
  }
  
  // to add new patient into the database

  public function add_patient() {
    $this->check_session();
    $status = "'Queue','Open'";
    $data['desk_count'] = $this->desk_model->desk_status($status);
    $data['mrdno'] = $this->patient_model->add_patient();

    if (isset($data['mrdno'])):
      $mrdno = $data['mrdno'];
      redirect("search/queue/$mrdno");

    else:
      redirect("patient/add?add_error=yes");

    endif;
  }
  
  // to delete patient pi record from respective table except investigation table

  public function delete_patient_pi($pi_table, $details_id) {
    $this->patient_model->delete_patient($pi_table, $details_id);
  }
  
  // to update patient pi record from respective table except (history, diagnosis, examination)

  public function update_patient_pi($pi_table, $details_id) {
    $add_info = $this->input->post('info');
    $this->patient_model->update_patient_pi($pi_table, $details_id, $add_info);
  }
  
  // to update patient pi record for treatment table

  public function update_patient_pi_treatment($details_id) {
    $this->patient_model->update_patient_pi_treatment($details_id);
  }

  // function only to update records in  pi_investigation table 

  public function update_patient_pi_investigation($details_id) {
    $column_name = $this->input->post('column_name');
    $column_value = $this->input->post('info');
    $this->patient_model->update_patient_pi_investigation($details_id, $column_name, $column_value);
  }

  // function only to delete records in pi_investigation table 
  
  public function delete_patient_pi_investigation($details_id) {
	$column_name = $this->input->post('column_name');
    $this->patient_model->delete_patient_pi_investigation($details_id,$column_name);
  }
  
  // get patient cd4, creatinine vldl, weight from pi_investigation table using ajax calls

  public function get_cd4($mrdno) {
    $result = $this->patient_model->get_cd4($mrdno);
    echo $result;
  }

  public function get_creatinine($mrdno) {
    $result = $this->patient_model->get_creatinine($mrdno);
    echo $result;
  }

  public function get_vl($mrdno) {
    $result = $this->patient_model->get_vl($mrdno);
    echo $result;
  }
  
  public function get_regimen($mrdno) {
    $result = $this->patient_model->get_regimen($mrdno);
    echo $result;
  }

  public function get_patient_weight($mrdno) {
    $result = $this->patient_model->get_patient_weight($mrdno);
    echo $result;
  }
  
  // add new parameter for the respective tabs in param data table 

  public function add_list_value() {
    $head_id = $this->input->post('head_id');
    $parameter = $this->input->post('list_value');
    $section = $this->input->post('sec_name');
    $result = $this->patient_model->add_list_value($head_id, $parameter, $section);
    echo $result;
  }
  
  // update patient information

  public function update_patient_info($mrd_no) {
    $this->check_session();
    $data['mrd_no'] = $mrd_no;
    $status = "'Queue','Open'";
    $data['desk_count'] = $this->desk_model->desk_status($status);
    $data['updated'] = $this->patient_model->update_patient($mrd_no);
    $data['main_content'] = 'patient/thankyou_view';
    $this->load->view('common/template', $data);
  }

  // public function edit_patient($mrd_no) {
    // $this->check_session();
    // $status = "'Queue','Open'";
    // $data['desk_count'] = $this->desk_model->desk_status($status);
    // $data['edit_info'] = $this->patient_model->edit_patient($mrd_no);
    // $data['main_content'] = 'patient/edit_view';
    // $data['misc_data'] = $this->patient_model->misc_data();
    // $data['mrd_no'] = $mrd_no;
    // $this->load->view('common/template', $data);
  // }
  
  
  // to display patient current profile details

  public function profile($mrd_no) {
    $data['mrd_no'] = $mrd_no;
    $status = "'Queue','Open'";
    $data['desk_count'] = $this->desk_model->desk_status($status);
    $data['edit_info'] = $this->patient_model->edit_patient($mrd_no);
    $data['misc_data'] = $this->patient_model->misc_data();
    $data['main_content'] = 'patient/profile_view';
    $this->load->view('common/template', $data);
  }

  function check_session() {
    if (!$this->session->userdata('admin_logged_in') || $this->session->userdata('admin_logged_in') == '') {
      redirect("login");
    }
  }

}
