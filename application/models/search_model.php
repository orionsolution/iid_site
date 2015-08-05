<?php
Class Search_model extends CI_Model
{
	function get_patient($keyword){
		// check if search string contains space or not
		//echo $keyword;exit;
		if (strpos($keyword,'_') !== false) {
		    // if search string contains '_' than divide the string to search for first name and last name

		    $keyword_arr = explode('_',$keyword);

		    $query = "select mrdno,firstname,surname from `patient_mast` 
                        where firstname like '%".$keyword_arr[0]."%' or
                        surname like '%".$keyword_arr[1]."%' "; 

		}else{
			$query = "select mrdno,firstname,surname from `patient_mast` 
                        where mrdno like '$keyword' or 
                        firstname like '%$keyword%' or
                        surname like '%$keyword%' ";
		}

          
          
			$result = $this->db->query($query);          
			$data = $result->result();
			$this->check_queue_status();
			return $data;
	}
        
        public function check_queue_status(){
          $mrdno_queue = array();
          $mrdno_close = array();
          
          $queue_query = "SELECT mrdno FROM `visit` where `visit_dt` = CURDATE() AND `visit_status` IN ('Open','Queue')";
          $queue_result = $this->db->query($queue_query);
          
          if(!empty($queue_result)):
          foreach($queue_result->result() as $row):
            $mrdno_queue[] = $row->mrdno;
          endforeach;
          endif;
          
          $close_query = "SELECT mrdno FROM `visit` where `visit_dt` = CURDATE() AND `visit_status` = 'Close'";
          $close_result = $this->db->query($close_query);
          
          if(!empty($close_result)):
          foreach($close_result->result() as $row):
            $mrdno_close[] = $row->mrdno;
          endforeach;
          endif;
         
          
          $this->session->set_userdata('mrd_queue',$mrdno_queue);
          $this->session->set_userdata('mrd_close', $mrdno_close);
        }
        
	function queue_patient($mrdno){
		$today=date("Y-m-d");
		$sql="select * from visit where mrdno='$mrdno' and visit_dt='$today' and visit_status='Queue'";
		$query = $this->db->query($sql);
		$num = $query->num_rows();
		if($num==0):
			//Add Patient in Queue
			$data = array(
				'mrdno' => $mrdno,
				'attended_by' => 'Pujari',
				'in_time' => date("Y-m-d H:i:s"),
				'visit_dt' => date("Y-m-d"),
				'visit_status' => 'Queue'
			);
			$this->db->insert('visit', $data); 
			/*echo "<script type='text/javascript'>alert('Patient is added')</script>";*/
			//echo "Patient is added";
		//else:
			/*echo "<script type='text/javascript'>alert('Patient is already in queue')</script>";*/
			//echo "Patient is already in queue";
		endif;
	}

	function get_param(){
		$section_arr=array("history","examination","diagnosis","treatment");
		$param_arr=array();
		foreach ($section_arr as $curr_section):
			//echo "$curr_section <br>";
			$param_arr[$curr_section]=array();
			$head_sql="select * from head_mast where section='$curr_section' order by seqno";			
			$head_query = $this->db->query($head_sql);
			//echo "<hr>".$this->db->last_query();
			foreach($head_query->result_array() as $head_row):
				//print_r($head_row);					
				$head_id=$head_row["head_id"];
				$head_name=$head_row["head"];
				$param_arr[$curr_section][$head_id]["head_id"]=$head_id;
				$param_arr[$curr_section][$head_id]["head_name"]=$head_name;
				$param_arr[$curr_section][$head_id]["parameters"]=array();			
				$param_sql="select * from param_data where head_id='$head_id'";			
				$param_query = $this->db->query($param_sql);
				//echo "<hr>".$this->db->last_query();
				foreach($param_query->result_array() as $param_row):
					//echo "<br>------";
					//print_r($param_row);	
					$parameter=$param_row["parameter"];
					$parameter_id=$param_row["param_id"];
					$param_arr[$curr_section][$head_id]["parameters"][]=array("parameter_id"=>$parameter_id,"parameter"=>$parameter);
				endforeach;			
			endforeach;
		endforeach;
		//echo "<hr>";
		//echo '<pre>';print_r($param_arr);exit;		
		return $param_arr;		
	}
	
	function tab_visit($section){
		echo 'hi';
		$query = "select * from `head_mast` where `section`='$section'";
		echo $query;
		$q = $this->db->query($query);
		$data = $q->result();
		return $data;
		//print_r($data); exit;
	}
	
	
	function add_hist($mrd_no){		
						$head_id = $this->input->post('head_id');						
						$param_id = $this->input->post('param_id');						
						$info = $this->input->post('info');
						
					
		$sql = "insert into pi_history(`head_id`,`mrdno`,`param_id`,`visit_dt`,`addinfo`)values ($head_id,$mrd_no,$param_id,NOW(),'$info')"; 
						$q = $this->db->query($sql);
		}
	
	function add_exam($mrd_no){
		
						$head = $this->input->post('head');						
						$param = $this->input->post('param');						
						$info = $this->input->post('info');
						
						$sql = "SELECT head_id
								FROM head_mast
								WHERE head =  '$head'";
								
						$query = $this->db->query($sql);
						
						if($query->num_rows() > 0 ){					
							$row = $query->row();							
							$head_id = $row->head_id;
						}
	
						// get the parameter id
						
						$sql = "SELECT param_id
								FROM param_data
								WHERE parameter =  '$param'";
					
						$query = $this->db->query($sql);
						
						if($query->num_rows() > 0 ){							
							$row = $query->row();							
							$param_id = $row->param_id;
						}
					
		$sql = "insert into pi_examination(`head_id`,`mrdno`,`param_id`,`visit_dt`,`addinfo`)values ($head_id,$mrd_no,$param_id,NOW(),'$info')"; 
						$q = $this->db->query($sql);
						
	}
	
	function add_diag($mrd_no){
	
						$head = $this->input->post('head');						
						$param = $this->input->post('param');						
						$info = $this->input->post('info');
						
						$sql = "SELECT head_id
								FROM head_mast
								WHERE head =  '$head'";
								
						$query = $this->db->query($sql);
						
						if($query->num_rows() > 0 ){					
							$row = $query->row();							
							$head_id = $row->head_id;
						}
	
						// get the parameter id
						
						$sql = "SELECT param_id
								FROM param_data
								WHERE parameter =  '$param'";
					
						$query = $this->db->query($sql);
						
						if($query->num_rows() > 0 ){							
							$row = $query->row();							
							$param_id = $row->param_id;
						}
					
		$sql = "insert into pi_diagnosis(`head_id`,`mrdno`,`param_id`,`visit_dt`,`addinfo`)values ($head_id,$mrd_no,$param_id,NOW(),'$info')"; 
						$q = $this->db->query($sql);
						
	}
	
	function add_treat($mrd_no){
						$dosage = $_POST['dosage'];
						$times = $_POST['times'];
						$spl_instructions = $_POST['spl_instructions'];
						$start_date = $_POST['start_date'];
						$stop_date = $_POST['stop_date'];
						$duration = $_POST['duration'];
						$head = $_POST['head'];
						$param = $_POST['param'];
						$info = $_POST['diag_info'];
						
						
						$sql = "insert into treatment_info(`visit_dt`,`mrd_no`,`dosage`,`times`,`spl_instructions`,`start_date`,`stop_date`,`duration`,`head`,`section`,`param`,`info`)values(NOW(),'$mrd_no','$dosage','$times','$spl_instructions','$start_date','$stop_date','$duration','$head','diagnosis','$param','$info')";
						$q = $this->db->query($sql);
						
	}
	
	function visit_date($mrd_no){
	
							$sqld = "SELECT distinct DATE_FORMAT(  `created_dt` ,  '%d-%m-%y' ) AS created_dt
									 FROM visit
									 WHERE  `mrd_no` =  '$mrd_no' ORDER BY DATE_FORMAT(  `created_dt` ,  '%m-%d-%y' ) DESC";
							$q = $this->db->query($sqld);
							$data = $q->result();
							return $data;
	
	}
	
	function visit_hist($mrd_no,$date){
							
							$sql1 = "select *, DATE_FORMAT(created_dt, '%d-%m-%y') as created_dt from visit where section='history' and `mrd_no`='$mrd_no' and DATE_FORMAT(created_dt, '%d-%m-%y')='$date' ORDER BY `visit_id`";
									
							$q = $this->db->query($sql1);
							
							$data = $q->result_array();
							
							return $data;	
							
	}
	
	function visit_exam($mrd_no,$date){
							
							$sql2 = "select * from visit where section='examination' and `mrd_no`='$mrd_no' and DATE_FORMAT(created_dt, '%d-%m-%y')='$date' ORDER BY `visit_id`";
									
							$q = $this->db->query($sql2);
							
							$data = $q->result_array();
							
							return $data;	
							
	}
	
	function visit_diag($mrd_no,$date){
							
							$sql3 = "select * from visit where section='diagnosis' and `mrd_no`='$mrd_no' and DATE_FORMAT(created_dt, '%d-%m-%y')='$date' ORDER BY `visit_id`";
									
							$q = $this->db->query($sql3);
							
							$data = $q->result_array();
							
							
							return $data;	
							
	}
	
	function visit_treat($mrd_no,$date){
							
							$sql4 = "select * from visit where section='treatment' and `mrd_no`='$mrd_no' and DATE_FORMAT(created_dt, '%d-%m-%y')='$date' ORDER BY `visit_id`";
									
							$q = $this->db->query($sql4);
							
							$data = $q->result_array();
		
							return $data;	
							
	}
	
	function param($section){
						$query = "SELECT  m.parameter 
								  FROM  mast_data m join head_mast h
								  WHERE  m.section =  '$section'
								  AND  m.head_id =  h.head_id";
					   	//echo $query;
					    $q = $this->db->query($query);
						$data = $q->result();
		
						return $data;
	
	}
	
	
	
			function desk_status_queue($mrd_no){
				$add_queue = "update `patient_mast` set `status`='queue' where `mrdNo`='$mrd_no'";
				$q = $this->db->query($add_queue);
				$query1 = "select * from `patient_mast` where `status`='queue'";
				$q1 = $this->db->query($query1);
				$data = $q1->result();
				//print_r($data);exit;
				return $data;
			
			}
			function desk_status(){
				$query1 = "select * from `patient_mast` where `status`='queue'";
				$q1 = $this->db->query($query1);
				$data = $q1->result();
				//print_r($data);exit;
				return $data;	
			}
			function desk_status_done(){
				$query1 = "select * from `patient_mast` where `status`='done'";
				$q1 = $this->db->query($query1);
				$data = $q1->result();
				//print_r($data);exit;
				return $data;	
			}
			
			
	//--------------------author puja-----------------------------------//
	function get_history_head_details(){
		$query = "SELECT * FROM `head_mast` WHERE section like 'history' ORDER BY `head_mast`.`seqno` ASC";
		$result = $this->db->query($query);
		$data = $result->result();
		return $data;
	}
	function get_examination_head_details(){
		$query = "SELECT * FROM `head_mast` WHERE section like 'examination' ORDER BY `head_mast`.`seqno` ASC";
		$result = $this->db->query($query);
		$data = $result->result();
		return $data;
	}
	function get_diagnosis_head_details(){
		$query = "SELECT * FROM `head_mast` WHERE section like 'diagnosis' ORDER BY `head_mast`.`seqno` ASC";
		$result = $this->db->query($query);
		$data = $result->result();
		return $data;
	}
	function get_treatment_head_details(){
		$query = "SELECT * FROM `head_mast` WHERE section like 'treatment' ORDER BY `head_mast`.`seqno` ASC";
		$result = $this->db->query($query);
		$data = $result->result();
		return $data;
	}

	function get_history_param_details($head_id){
		$query = "SELECT *  FROM `param_data` WHERE `section` = 'history' AND `head_id` = ".$head_id."";
		$result = $this->db->query($query);
		$data = $result->result();
		return $data;
	}

	function get_mrd_visit($mrd_no){
		$query = "SELECT count(*),`visit_dt`,`mrd_no`  FROM `visit`  where `mrd_no`='".$mrd_no."' group BY DATE(`visit_dt`),`mrd_no` ORDER BY `visit`.`visit_dt` ASC";
		$result = $this->db->query($query);
		$data = $result->result();
		return $data;
	}

	function get_history_visits($mrd_no){
		$this->db->select('parameter,visit_dt,head,seqno,addinfo');
		$this->db->from('param_data'); 
		$this->db->join('pi_history', 'pi_history.head_id = param_data.head_id and pi_history.param_id = param_data.param_id');
		$this->db->join('head_mast', 'head_mast.head_id = param_data.head_id');
		$this->db->where('pi_history.mrdno',$mrd_no);
		$records = $this->db->get();
		echo "<hr>".$this->db->last_query();exit;
		return $records->result_array();
	}

	function get_examinations_visits($mrd_no){
		$this->db->select('parameter,visit_dt,head,seqno,addinfo');	
		$this->db->from('param_data'); 
		$this->db->join('pi_examination', 'pi_examination.head_id = param_data.head_id and pi_examination.param_id = param_data.param_id');
		$this->db->join('head_mast', 'head_mast.head_id = param_data.head_id');
		$this->db->where('pi_examination.mrdno',$mrd_no);
		$records = $this->db->get();
		return $records->result_array();
	}

	function get_diagnosis_visits($mrd_no){
		$this->db->select('parameter,visit_dt,head,seqno,addinfo');	
		$this->db->from('param_data'); 
		$this->db->join('pi_diagnosis', 'pi_diagnosis.head_id = param_data.head_id and pi_diagnosis.param_id = param_data.param_id');
		$this->db->join('head_mast', 'head_mast.head_id = param_data.head_id');
		$this->db->where('pi_diagnosis.mrdno',$mrd_no);
		$records = $this->db->get();
		return $records->result_array();
	}
	function get_treatment_visits($mrd_no){
		$this->db->select('parameter,visit_dt,head,seqno,addinfo');	
		$this->db->from('param_data'); 
		$this->db->join('pi_treatment', 'pi_treatment.head_id = param_data.head_id and pi_treatment.param_id = param_data.param_id');
		$this->db->join('head_mast', 'head_mast.head_id = param_data.head_id');
		$this->db->where('pi_treatment.mrdno',$mrd_no);
		$records = $this->db->get();
		return $records->result_array();
	}

	function get_head_param_details($head_id){
		$this->db->from('param_data');
		$this->db->join('head_mast', 'head_mast.head_id = param_data.head_id');
		$this->db->where('param_data.head_id',$head_id);
		$records = $this->db->get();
		$parameters_details = $records->result_array();
		foreach($parameters_details as $parameters){		//as key value try it(pending)
			$parameter[] = $parameters['parameter'];
		}
		return $parameter;

	}
	
	function get_visit_detail($section,$mrd_no,$visit_dt){
		switch($section):
			case 'history': 
				echo "<br>11";
				$sql="select parameter, addinfo from pi_history a, param_data b where a.param_id=b.param_id and b.section='history' 
						and mrdno='$mrd_no' and visit_dt='$visit_dt'";
				echo "<br>---$sql";
				break;
		endswitch;
		exit;
		$this->db->from($tb_name); 
		$this->db->join('param_data', $tb_name.'.param_id = param_data.param_id');
		//$this->db->join('head_mast', 'head_mast.head_id = param_data.head_id');
		$this->db->where('mrdno',$mrd_no);
		$this->db->where('visit_dt',$visit_dt);
		$records = $this->db->get();
		//echo "<hr>".$this->db->last_query();
		//print_r($records->result_array());
		//exit;
		return $records->result_array();
	}	

	function get_patient_visited_dates($mrdno, $count){
		$query = "select visit_dt from pi_diagnosis where mrdno=".$mrdno." union 
		select visit_dt from pi_history where mrdno=".$mrdno."  union
		select visit_dt from pi_examination where mrdno=".$mrdno."  union
		select visit_dt from pi_treatment where mrdno=".$mrdno."  ORDER BY `visit_dt`  DESC
		LIMIT 0,".$count ."";
		//echo "<br> $query";
		$result = $this->db->query($query);		
		$query_res = $result->result_array();
		$date_str = "";		
		foreach($query_res as $item){			
			$date_str .= "','".$item['visit_dt'];
		}	   
		$date_str.="'";
	   $date_str=substr($date_str,2);	   
	   return $date_str;
	}
	
	function get_data($tb_name,$mrd_no, $date_str){
		
		$sql = "select parameter,visit_dt, head, seqno, addinfo from $tb_name a,param_data b, head_mast c where a.param_id = b.param_id and a.head_id=b.head_id and b.head_id = c.head_id and mrdno = $mrd_no and visit_dt in ($date_str)";
		$query = $this->db->query($sql);
		return $query->result_array();
		
	}	
	//--------------------------author puja--------------------------------//
	
}
?>