<?php

Class Patient_model extends CI_Model {

  function get_param() {
    $section_arr = array("history", "examination", "diagnosis", "treatment", "Investigation");
    $param_arr = array();
    foreach ($section_arr as $curr_section):
      //echo "$curr_section <br>";
      $param_arr[$curr_section] = array();
      $head_sql = "select * from head_mast where section='$curr_section' order by seqno";
      $head_query = $this->db->query($head_sql);
      //echo "<hr>".$this->db->last_query();
      foreach ($head_query->result_array() as $head_row):
        //print_r($head_row);					
        $head_id = $head_row["head_id"];
        $head_name = $head_row["head"];
        $param_arr[$curr_section][$head_id]["head_id"] = $head_id;
        $param_arr[$curr_section][$head_id]["head_name"] = $head_name;
        $param_arr[$curr_section][$head_id]["parameters"] = array();
        $param_sql = "select * from param_data where head_id='$head_id' and parameter not like '?%'order by parameter";
        $param_query = $this->db->query($param_sql);
        //echo "<hr>".$this->db->last_query();
        foreach ($param_query->result_array() as $param_row):
          //echo "<br>------";
          //print_r($param_row);	
          $parameter = $param_row["parameter"];
          $parameter_id = $param_row["param_id"];
          if(!empty($param_row['short_form'])):
            $short_form = $param_row['short_form'];
            $param_arr[$curr_section][$head_id]["parameters"][] = array("parameter_id" => $parameter_id, "parameter" => $parameter,
              "short_form" => $short_form);
          else:
            $param_arr[$curr_section][$head_id]["parameters"][] = array("parameter_id" => $parameter_id, "parameter" => $parameter);
          endif;  
        endforeach;
      endforeach;
    endforeach;
    //echo "<hr>";
    //echo '<pre>';print_r($param_arr);exit;		
    return $param_arr;
  }

  function add_hist($mrd_no) {
    $head_id = $this->input->post('head_id');
    $param_id = $this->input->post('param_id');
    $info = $this->input->post('info');
	$visit_dt = $this->input->post('visit_dt');
	//echo "before condition visit_dt : " . $visit_dt;
	if(empty($visit_dt)):
		$visit_dt = date("Y-m-d H:i:s");
		$created_dt = strtotime($visit_dt);
		$check_date = date('Y-m-d');
		//echo 'inside if';
	else:
		//$visit_dt = str_replace(",", "", $visit_dt);
		$visit_dt = date("Y-m-d H:i:s",strtotime($visit_dt));
		$created_dt = strtotime(date("Y-m-d H:i:s"));
		$check_date = date('Y-m-d',strtotime($visit_dt));
		//echo 'inside else';
	endif;
	
	//echo "after condition visit dt: " . $visit_dt;
	
	
	$test_query = "SELECT * FROM pi_history where `param_id` = '$param_id' AND `head_id` = '$head_id' AND DATE(visit_dt) = '$check_date' AND `mrdno` = $mrd_no";
    $test_result = $this->db->query($test_query);

    if ($test_result->num_rows() > 0):
      $sql = "UPDATE pi_history 
			  SET `addinfo` = '$info' 
			  WHERE `param_id` = '$param_id' AND `head_id` = '$head_id'  AND date(visit_dt) = '$check_date' AND `mrdno` = $mrd_no";
      $this->db->query($sql);

    else:
      $sql = "insert into pi_history(`head_id`,`mrdno`,`param_id`,`visit_dt`,`created_dt`,`addinfo`)
		values ('$head_id',$mrd_no,'$param_id','$visit_dt','$created_dt','$info')";
		//echo "sql: " . $sql;exit;
      $this->db->query($sql);
    endif;
  }

  function add_exam($mrd_no) {
    $head_id = $this->input->post('head_id');
    $param_id = $this->input->post('param_id');
    $info = $this->input->post('info');
    $visit_dt = $this->input->post('visit_dt');
	if(empty($visit_dt)):
		$visit_dt = date("Y-m-d H:i:s");
		$created_dt = strtotime($visit_dt);
		$check_date = date('Y-m-d');
	else:
		$visit_dt = date("Y-m-d H:i:s",strtotime($visit_dt));
		$created_dt = strtotime(date("Y-m-d H:i:s"));
		$check_date = date('Y-m-d',strtotime($visit_dt));
	endif;
	
	
	$test_query = "SELECT * FROM pi_examination where `param_id` = '$param_id' AND `head_id` = '$head_id' AND DATE(visit_dt) = '$check_date' AND `mrdno` = $mrd_no";
    $test_result = $this->db->query($test_query);
	
	
	if ($test_result->num_rows() > 0):
      $sql = "UPDATE pi_examination 
			  SET `addinfo` = '$info' 
			  WHERE `param_id` = '$param_id' AND `head_id` = '$head_id'  AND date(visit_dt) = '$check_date' AND `mrdno` = $mrd_no";
      $this->db->query($sql);

    else:
      $sql = "insert into pi_examination(`head_id`,`mrdno`,`param_id`,`visit_dt`,`created_dt`,`addinfo`)
			  values ('$head_id',$mrd_no,'$param_id','$visit_dt','$created_dt','$info')";
      $this->db->query($sql);
    endif;
  }

  function add_diag($mrd_no) {
    $head_id = $this->input->post('head_id');
    $param_id = $this->input->post('param_id');
    $info = $this->input->post('info');
    $visit_dt = $this->input->post('visit_dt');
	
	if(empty($visit_dt)):
		$visit_dt = date("Y-m-d H:i:s");
		$created_dt = strtotime($visit_dt);
		$check_date = date('Y-m-d');
	else:
		$visit_dt = date("Y-m-d H:i:s",strtotime($visit_dt));
		$created_dt = strtotime(date("Y-m-d H:i:s"));
		$check_date = date('Y-m-d',strtotime($visit_dt));
	endif;
	
	
	$test_query = "SELECT * FROM pi_diagnosis where `param_id` = '$param_id' AND `head_id` = '$head_id' AND DATE(visit_dt) = '$check_date' AND `mrdno` = $mrd_no";
    $test_result = $this->db->query($test_query);
	
	
	if ($test_result->num_rows() > 0):
      $sql = "UPDATE pi_diagnosis 
			  SET `addinfo` = '$info' 
			  WHERE `param_id` = '$param_id' AND `head_id` = '$head_id'  AND date(visit_dt) = '$check_date' AND `mrdno` = $mrd_no";
      $this->db->query($sql);

    else:
      $sql = "insert into pi_diagnosis(`head_id`,`mrdno`,`param_id`,`visit_dt`,`created_dt`,`addinfo`)
			  values ('$head_id',$mrd_no,'$param_id','$visit_dt','$created_dt','$info')";
      $this->db->query($sql);
    endif;
  }

  function add_treat($mrd_no) {
    $head_id = $this->input->post('head_id');
    $param_id = $this->input->post('param_id');
    $start_date = $this->input->post('start_date');
    $stop_date = $this->input->post('stop_date');
    $info = $this->input->post('add_treat_info');
    $visit_dt = $this->input->post('visit_dt');
	$check_date;
	if(empty($visit_dt)):
		$visit_dt = date("Y-m-d H:i:s");
		$created_dt = strtotime($visit_dt);
		$check_date = date('Y-m-d');
	else:
		//$visit_dt = str_replace(",","",$visit_dt);
		$visit_dt = date("Y-m-d H:i:s",strtotime($visit_dt));
		$created_dt = strtotime(date("Y-m-d H:i:s"));
		$check_date = date('Y-m-d',strtotime($visit_dt));
	endif;
	
	//echo "$visit_dt, $created_dt, $check_date";exit;

    if (!empty($info)):
      $info = implode(',', $info);
    endif;


    if (!empty($start_date)):
      $start_date = date('Y-m-d', strtotime($start_date));
    endif;

    if (!empty($stop_date)):
      $stop_date = date('Y-m-d', strtotime($stop_date));
    endif;

    $test_query = "SELECT * FROM pi_treatment where `param_id` = '$param_id' AND DATE(visit_dt) = '$check_date' AND `mrdno` = $mrd_no";
    $test_result = $this->db->query($test_query);

    if ($test_result->num_rows() > 0):
      $sql = "UPDATE pi_treatment SET `Sdate` = '$start_date', `Stopdate` = '$stop_date', `addinfo` = '$info'                       WHERE `param_id` = '$param_id'  AND date(visit_dt) = '$check_date' AND `mrdno` = $mrd_no";
      $this->db->query($sql);

    else:
      $sql = "insert into  pi_treatment(`head_id`,`mrdno`,`param_id`,`visit_dt`,`created_dt`,`addinfo`,`Sdate`,`Stopdate`)values ('$head_id',$mrd_no,'$param_id','$visit_dt','$created_dt','$info','$start_date','$stop_date')";
      $this->db->query($sql);
    endif;
    
  }

  public function add_inv($mrd_no) {
    $column_name = $this->input->post('column_name');
    $column_value = $this->input->post('column_value');
	
	
	$visit_dt = $this->input->post('visit_dt');
	//echo 'visit_dt: ' . $visit_dt .'<br>';
	$check_date;
	//echo "column name: $column_name";
	//exit;
	
	if(empty($visit_dt)):
		$visit_dt = date("Y-m-d H:i:s");
		$created_dt = strtotime($visit_dt);
		$check_date = date('Y-m-d');
	else:
		//$visit_dt = str_replace(",","",$visit_dt);
		$visit_dt = date("Y-m-d H:i:s",strtotime($visit_dt));
		$created_dt = strtotime(date("Y-m-d H:i:s"));
		$check_date = date('Y-m-d',strtotime($visit_dt));
	endif;
	
	
	//echo "$visit_dt, $created_dt, $check_date";exit;
	
	
	$test_query = "SELECT * FROM pi_investigation where DATE(visit_dt) = '$check_date' AND `mrdno` = $mrd_no";
	
	//echo $test_query;
	//exit;
    $test_result = $this->db->query($test_query);

   if ($test_result->num_rows() > 0):
      $sql = "UPDATE pi_investigation SET `$column_name` = '$column_value'
			  WHERE date(visit_dt) = '$check_date' AND `mrdno` = $mrd_no";
      $this->db->query($sql);

    else:
      $sql = "INSERT INTO pi_investigation(`".$column_name."`,`mrdno`,`inv_source`,`visit_dt`,`created_dt`) VALUES('$column_value','$mrd_no','clinic','$visit_dt','$created_dt')";
      $this->db->query($sql);
    endif;
  }

  public function add_freq_inv($mrd_no){
	$cd4 = $this->input->post('cd4');
	$hiv_i_ii = $this->input->post('hiv_i_ii');
	$vdrl = $this->input->post('vdrl');
	$viral_load = $this->input->post('viral_load');
	$creatinine = $this->input->post('creatinine');
	$bsf = $this->input->post('bsf');
	$hbsag = $this->input->post('hbsag');
	$cryptococcus = $this->input->post('cryptococcus');
	$data = array();
	
	
	$visit_dt = $this->input->post('visit_dt');
	$check_date;
	//echo "column name: $column_name";
	//exit;
	
	if(empty($visit_dt)):
		$visit_dt = date("Y-m-d H:i:s");
		$created_dt = strtotime($visit_dt);
		$check_date = date('Y-m-d');
	else:
		//$visit_dt = str_replace(",","",$visit_dt);
		$visit_dt = date("Y-m-d H:i:s",strtotime($visit_dt));
		$created_dt = strtotime(date("Y-m-d H:i:s"));
		$check_date = date('Y-m-d',strtotime($visit_dt));
	endif;
	
	
	//echo "$visit_dt, $created_dt, $check_date";
	
	
	$test_query = "SELECT * FROM pi_investigation where DATE(visit_dt) = '$check_date' AND `mrdno` = $mrd_no";
	
	//echo $test_query;
	//exit;
    $test_result = $this->db->query($test_query);

    if ($test_result->num_rows() > 0):  
	  
	  if(!empty($cd4)):
		$data['CD4'] = $cd4;
	  endif;
	  
	  if(!empty($viral_load)):
		$data['VIRAL_LOAD'] = $viral_load;
	  endif;
	  
	  if(!empty($hiv_i_ii)):
		$data['HIV_I_II'] = $hiv_i_ii;
	  endif;
	  
	  if(!empty($vdrl)):
		$data['VDRL'] = $vdrl;
	  endif;
	  
	  if(!empty($creatinine)):
		$data['CREATININE'] = $creatinine;
	  endif;
	  
	  if(!empty($bsf)):
		$data['BSF'] = $bsf;
	  endif;
	  
	  if(!empty($hbsag)):
		$data['HBSAG'] = $hbsag;
	  endif;
	  
	  if(!empty($cryptococcus)):
		$data['CRYPTOCOCCUS ANTIGEN'] = $cryptococcus;
	  endif;
	  
	  $sql = $this->dbRowUpdate('pi_investigation',$data,"WHERE date(visit_dt) = '$check_date' AND `mrdno` = $mrd_no");	  
      //echo $sql;exit; 
	  $this->db->query($sql);

    else:
      $sql = "INSERT INTO pi_investigation(`mrdno`,`CD4`,`HIV_I_II`,`VDRL`,`CREATININE`,`VIRAL_LOAD`,`BSF`,`HBSAG`,`CRYPTOCOCCUS ANTIGEN`,`inv_source`,`visit_dt`,`created_dt`) VALUES('$mrd_no','$cd4','$hiv_i_ii','$vdrl','$creatinine','$viral_load','$bsf','$hbsag','$cryptococcus','clinic','$visit_dt','$created_dt')";
	  //echo $sql;exit;

	  $this->db->query($sql);
    endif;
  }
  
  function dbRowUpdate($table_name, $form_data, $where_clause=''){


    $whereSQL = '';
    if(!empty($where_clause))
    {

        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {

            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }

    $sql = "UPDATE ".$table_name." SET ";


    $sets = array();
    foreach($form_data as $column => $value)
    {
         $sets[] = "`".$column."` = '".$value."'";
    }
    $sql .= implode(', ', $sets);


    $sql .= $whereSQL;
	return $sql;
}
  
  
  

  function param($section) {
    $query = "SELECT  m.parameter 
			  FROM  mast_data m join head_mast h
			  WHERE  m.section =  '$section'
			  AND  m.head_id =  h.head_id";
    //echo $query;
    $q = $this->db->query($query);
    $data = $q->result();

    return $data;
  }

  function desk_status_queue($mrd_no) {
    $add_queue = "update `patient_mast` set `status`='queue' where `mrdNo`='$mrd_no'";
    $q = $this->db->query($add_queue);
    $query1 = "select * from `patient_mast` where `status`='queue'";
    $q1 = $this->db->query($query1);
    $data = $q1->result();
    //print_r($data);exit;
    return $data;
  }

  function desk_status() {
    $query1 = "select * from `patient_mast` where `status`='queue'";
    $q1 = $this->db->query($query1);
    $data = $q1->result();
    //print_r($data);exit;
    return $data;
  }

  function desk_status_done() {
    $query1 = "select * from `patient_mast` where `status`='done'";
    $q1 = $this->db->query($query1);
    $data = $q1->result();
    //print_r($data);exit;
    return $data;
  }

  
  function get_patient_visited_dates($mrdno, $count) {
    $query = "select date(visit_dt) as `visit_dt` from pi_history where mrdno=" . $mrdno . " union
			 select date(visit_dt) as `visit_dt` from pi_examination where mrdno=" . $mrdno . " union
			 select date(visit_dt) as `visit_dt` from pi_diagnosis where mrdno=" . $mrdno . " union
			 select date(visit_dt) as `visit_dt` from pi_treatment where mrdno=" . $mrdno . " union
			 select date(visit_dt) as `visit_dt` from pi_investigation where mrdno=" . $mrdno . " 
			 ORDER BY `visit_dt`  DESC ";

    if ($count != 'all'):
      $query .= "LIMIT 0," . $count . "";
    endif;
    //echo "<br> $query";
    $result = $this->db->query($query);
    $query_res = $result->result_array();
    $date_str = "";
    foreach ($query_res as $item) {
      $date_str .= "','" . $item['visit_dt'];
    }
    $date_str.="'";
    $date_str = substr($date_str, 2);

    return $date_str;
  }

  function get_curr_data($tb_name, $mrd_no, $date_str, $title) {
    if ($tb_name == "pi_treatment"):
      $sql = "select '$title' as `title`,'$tb_name' as `tablename`, parameter,visit_dt, created_dt,details_id,head, seqno, addinfo,Sdate,Stopdate from $tb_name a,param_data b, head_mast c where a.param_id = b.param_id and a.head_id=b.head_id and b.head_id = c.head_id and mrdno = $mrd_no and date(visit_dt) in ('$date_str') order by created_dt desc";
    else:
      $sql = "select '$title' as `title`,'$tb_name' as `tablename`, parameter,visit_dt, created_dt, details_id,head, seqno, addinfo from $tb_name a,param_data b, head_mast c where a.param_id = b.param_id and a.head_id=b.head_id and b.head_id = c.head_id and mrdno = $mrd_no and date(visit_dt) in ('$date_str') order by created_dt desc";
    endif;
	
		
    $query = $this->db->query($sql);
	// echo '<pre>';
	// print_r($query->result_array());
    return $query->result_array();
  }

  public function get_investigation_data($tb_name, $mrd_no, $date_str = "all") {
    if ($date_str == 'all'):
      $sql = "select * from `$tb_name` where `mrdno` = $mrd_no and date(`visit_dt`) != CURDATE() order by date(visit_dt) desc,details_id";
    else:
      $sql = "select * from `$tb_name` where `mrdno` = $mrd_no and date(`visit_dt`) != CURDATE() order by date(visit_dt) desc,details_id limit 1";
    endif;
	//echo $sql;exit;
    $query = $this->db->query($sql);
    return $query->result_array();
  }
  
  // get current investigation 
  
  public function get_curr_investigation_data($mrdno,$date){
	if(empty($date)):
		$date = date('Y-m-d');
	endif;	
	$sql = "select * from pi_investigation where `mrdno` = $mrdno and date(`visit_dt`) = '$date'";
	$query = $this->db->query($sql);
	return $query->result_array();
  }




  public function patient_info($mrd_no) {
    $sql = "SELECT mrdno, firstname, surname, date_of_birth, gender, hiv_year, art_year, children, spouse, diabetic, hypertension
				FROM patient_mast
				WHERE mrdno = $mrd_no
				LIMIT 1";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function patient_enter($mrd_no) {
    $sql = "update `visit` set `visit_status`='Open', `in_time`= NOW() where `mrdNo`= $mrd_no";
    $q = $this->db->query($sql);
  }

  public function get_patient_lab_data($mrd_no) {
    $sql = "SELECT creatinine, cd4, vldl, mrdno, report_dt
				FROM pi_investigation
				WHERE mrdno = $mrd_no
				ORDER BY report_dt DESC 
				LIMIT 1";

    $query = $this->db->query($sql);
    return $query->result_array();
  }

  function get_patient_last_visit($mrdno) {
    $query = "select visit_dt from pi_diagnosis where mrdno=" . $mrdno . " union 
		select visit_dt from pi_history where mrdno=" . $mrdno . "  union
		select visit_dt from pi_examination where mrdno=" . $mrdno . "  union
		select visit_dt from pi_treatment where mrdno=" . $mrdno . "  ORDER BY `visit_dt`  DESC
		LIMIT 1";
    //echo "<br> $query";
    $result = $this->db->query($query);
    $query_res = $result->result_array();
    foreach ($query_res as $row):
      $last_visit_date = $row['visit_dt'];
    endforeach;
    if (isset($last_visit_date)):
      return $last_visit_date;
    endif;
    //return $last_visit_date;
  }

  public function misc_data() {
    $data = array(
        'cities' => array('', 'Pune', 'Mumbai', 'Bangalore', 'Hyderabad', 'Chandigarh', 'Chennai', 'Jaipur', 'Delhi', 'Kolkata'),
        'education' => array('', 'S.S.C', 'H.S.C', 'Graduate', 'Post-Graduate'),
        'occupation' => array('', 'Service', 'Advocate', 'Software Engineer', 'Housewife', 'Farmer', 'Contractor'),
        'gender' => array('Male', 'Female'),
        'hiv_year' => range(date('Y'), 1990),
        'art_year' => range(date('Y'), 1990),
        'spouse' => array('None', 'Not Done', '+ve', '-ve'),
        'children' => array('None', '1', '2', '3', '> 3'),
        'diabetic' => array('Yes', 'No'),
        'hypertension' => array('Yes', 'No')
    );

    return $data;
  }

  public function add_patient() {

    // test if mrdno already present

    $mrdno = $this->input->post('mrdno');

    $sql = "SELECT `mrdno` FROM patient_mast where `mrdno` = $mrdno";
    $query = $this->db->query($sql);

    if ($query->num_rows() == 0):
      $patient_firstname = $this->input->post('firstname');
      $patient_surname = $this->input->post('lastname');
      $referred_by = $this->input->post('referredby');
      $present_city = $this->input->post('present_city');
      $permanent_place = $this->input->post('permanent_place');
      $contact_number = $this->input->post('contact_no');
      $emergency_number = $this->input->post('emer_no');
      $education = $this->input->post('education');
      $occupation = $this->input->post('occupation');
      $birth_date = $this->input->post('birth_date');
      $gender = $this->input->post('gender');
      $hiv_year = $this->input->post('hiv_year');
      $art_year = $this->input->post('art_year');
      $spouse = $this->input->post('spouse');
      $children = $this->input->post('children');
      $diabetic = $this->input->post('diabetic');
      $hypertension = $this->input->post('hypertension');


      // working with birth date
      $birth_date = str_replace('/', '-', $birth_date);
      $date_of_birth = date("Y-m-d", strtotime($birth_date));

      if ($date_of_birth == '1970-01-01' || $date_of_birth == '1969-12-31'):
        $date_of_birth = '';
      endif;


      $data = array(
          'mrdno' => $mrdno,
          'firstname' => $patient_firstname,
          'surname' => $patient_surname,
          'date_of_birth' => $date_of_birth,
          'telno' => $contact_number,
          'emer_no' => $emergency_number,
          'refdr' => $referred_by,
          'gender' => $gender,
          'edu' => $education,
          'occu' => $occupation,
          'present_city' => $present_city,
          'permanent_place' => $permanent_place,
          'hiv_year' => $hiv_year,
          'art_year' => $art_year,
          'spouse' => $spouse,
          'children' => $children,
          'diabetic' => $diabetic,
          'hypertension' => $hypertension
      );

      $this->db->insert('patient_mast', $data);
      $last_insert_id = $this->db->insert_id();
      $sql = "SELECT `mrdno` FROM patient_mast where `patient_id` = $last_insert_id";
      $query = $this->db->query($sql);
      $result = $query->result();
      foreach ($result as $row):
        $last_insert_mrdno = $row->mrdno;
      endforeach;

      return $last_insert_mrdno;

    //$sql = "update `patient_mast` set `mrdno`= $last_insert_id where `patient_id`= $last_insert_id";
    //$this->db->query($sql);

    endif;
  }

  public function edit_patient($mrd_no) {

    $sql = "SELECT mrdno, firstname, surname, gender, date_of_birth, refdr, telno, emer_no, edu, occu, present_city, permanent_place, perinfo, hiv_year, art_year, spouse, children, diabetic, hypertension
        FROM patient_mast
        WHERE mrdno = $mrd_no";

    $result = $this->db->query($sql);
    return $result->result_array();
  }

  public function update_patient($mrd_no) {
    $patient_firstname = $this->input->post('firstname');
    $patient_surname = $this->input->post('lastname');
    $referred_by = $this->input->post('referredby');
    $present_city = $this->input->post('present_city');
    $permanent_place = $this->input->post('permanent_place');
    $contact_number = $this->input->post('contact_no');
    $emergency_number = $this->input->post('emer_no');
    $education = $this->input->post('education');
    $occupation = $this->input->post('occupation');
    $birth_date = $this->input->post('birth_date');
    $gender = $this->input->post('gender');
    $per_info = $this->input->post('perinfo');
    $hiv_year = $this->input->post('hiv_year');
    $art_year = $this->input->post('art_year');
    $spouse = $this->input->post('spouse');
    $children = $this->input->post('children');
    $diabetic = $this->input->post('diabetic');
    $hypertension = $this->input->post('hypertension');

    // working with birth date

    $birth_date = str_replace('/', '-', $birth_date);
    $date_of_birth = date("Y-m-d", strtotime($birth_date));

    if ($date_of_birth == '1970-01-01' || $date_of_birth == '1969-12-31'):
      $date_of_birth = '';
    endif;

    $sql = "update `patient_mast` set `firstname`= '$patient_firstname', `surname`= '$patient_surname', `refdr`= '$referred_by', `present_city`= '$present_city', `permanent_place`= '$permanent_place', `telno`= '$contact_number', `emer_no`= '$emergency_number', `edu`= '$education', `occu`= '$occupation', `date_of_birth`= '$date_of_birth', `gender`= '$gender', `hiv_year` = '$hiv_year', `art_year` = '$art_year', `spouse` = '$spouse', `children` = '$children', `diabetic` = '$diabetic', `hypertension` = '$hypertension'  where `mrdno`= $mrd_no";

    $this->db->query($sql);

    return "updated";
  }

  public function delete_patient($pi_table, $details_id) {
    $sql = "delete from pi_$pi_table where details_id = $details_id";
//            echo $sql;
//            exit;
    $this->db->query($sql);
  }
  

  public function update_patient_pi($pi_table, $details_id, $add_info) {
    $sql = "update pi_$pi_table set `addinfo` = '$add_info' where details_id = $details_id";
//            echo $sql;
//            exit;
    $this->db->query($sql);
  }

  public function update_patient_pi_treatment($details_id) {
    $start_date = $this->input->post('start_date');
    $end_date = $this->input->post('end_date');
	$info = $this->input->post('info');
	if(!empty($info)):
		$info = implode(',', $info);
	else:
		$info = '';
	endif;
    

    $sql = "update pi_treatment set `Sdate` = '$start_date', `Stopdate` = '$end_date', `addinfo` = '$info' where `details_id` = $details_id";
//          echo $sql;
//          exit;
    $this->db->query($sql);
  }

  public function update_patient_pi_investigation($details_id, $column_name, $column_value) {
    $sql = "update pi_investigation set `$column_name` = '$column_value' where details_id = $details_id";
    $this->db->query($sql);
  }

  public function delete_patient_pi_investigation($details_id, $column_name) {
	$sql = "update pi_investigation set `$column_name` = NULL where details_id = $details_id";
    $this->db->query($sql);
  }

  public function get_cd4($mrdno, $count = "") {
    $sql = "select cd4, visit_dt from pi_investigation where `mrdno` = $mrdno and (cd4 != null or cd4 != '') order by visit_dt desc";
    if (!empty($count)):
      $sql .= " LIMIT $count";
      $query = $this->db->query($sql);
      return $query->result();
    endif;
    $query = $this->db->query($sql);
    $result = "";
	$query_result = $query->result();
	if(!empty($query_result)):
    foreach ($query->result() as $row):
      if ($row->cd4 && $row->visit_dt):
        $result .= "<li><a href=#><div class='fltleft'>$row->cd4</div><div class='fltright'>" . strtolower(date('d.M.y', strtotime($row->visit_dt))) . "</div><br class='clearfloat' /></a></li>";
      endif;
    endforeach;
	else:
		$result = "<li>No data present</li>";
	endif;

    return $result;
  }

  public function get_creatinine($mrdno, $count = "") {
    $sql = "select creatinine, visit_dt from pi_investigation where `mrdno` = $mrdno and (creatinine != null or creatinine != '') order by visit_dt desc";
    if (!empty($count)):
      $sql .= " LIMIT $count";
      $query = $this->db->query($sql);
      return $query->result();
    endif;
    $query = $this->db->query($sql);
    $result = "";
	$query_result = $query->result();
	if(!empty($query_result)):
    foreach ($query->result() as $row):
      if ($row->creatinine):
        $result .= "<li><a href=#><div class='fltleft'>$row->creatinine</div><div class='fltright'>" . strtolower(date('d.M.y', strtotime($row->visit_dt))) . "</div><br class='clearfloat' /></a></li>";
      endif;
    endforeach;
    if (isset($result)):
      return $result;
    else:
      $result = 'No data';
    endif;
	else:
		$result = "<li>No data present</li>";
	endif;

    return $result;
  }

  public function get_vl($mrdno, $count = "") {
    $sql = "SELECT viral_load, visit_dt
            FROM pi_investigation
            WHERE  `mrdno` = $mrdno
            AND (
            viral_load != NULL 
            OR viral_load !=  ''
            )
            ORDER BY visit_dt DESC ";
    if (!empty($count)):
      $sql .= " LIMIT $count";
      $query = $this->db->query($sql);
      return $query->result();
    endif;
    $query = $this->db->query($sql);
    $result = "";
  	$query_result = $query->result();
  	if(!empty($query_result)):
      foreach ($query->result() as $row):
        if ($row->viral_load):
          $result .= "<li><a href=#><div class='fltleft'>$row->viral_load</div><div class='fltright'>" . strtolower(date('d.M.y', strtotime($row->visit_dt))) . "</div><br class='clearfloat' /></a></li>";
        endif;
      endforeach;	
  	else:
  		$result = "<li>No data present</li>";
  	endif;

    return $result;
  }
  
  // get the short form of treatment medicine of past visits
  
  
  public function get_regimen($mrdno, $count = ""){	 
	   //echo '<pre>';
	  //$query = $this->db->query($sql);
	 // print_r($query->result());
	 // exit;
	 
	 $regimen_data = array();
	 $last_date = '';
	 
  if (!empty($count)){
	
	
    	// get the last visit date
    	
    	$last_visit_date_sql = "select b.short_form,a.visit_dt from pi_treatment a inner join param_data b on a.param_id  = b.param_id 
       where b.short_form != '' and a.mrdno = $mrdno order by visit_dt desc limit 1";
    	
    	$visit_date_query = $this->db->query($last_visit_date_sql);
    	$visit_date_result = $visit_date_query->result();
    	
    	foreach($visit_date_result as $row){
    		$last_visit_date = date('Y-m-d',strtotime($row->visit_dt));	
    	}
      
      if(isset($last_visit_date)){
          $last_visit_sql = "select b.short_form,a.visit_dt from pi_treatment a inner join param_data b on a.param_id  = b.param_id 
       where b.short_form != '' and a.mrdno = $mrdno and DATE(visit_dt) = '$last_visit_date' order by visit_dt desc";
       //echo $last_visit_sql;exit;
      $last_visit_query = $this->db->query($last_visit_sql);
      $last_visit_result =  $last_visit_query->result();
      //echo '<pre>';
      //print_r($last_visit_result);
      //exit;  
              
              
              foreach($last_visit_result as $curr_visit){
                $curr_date = date('Y-m-d',strtotime($curr_visit->visit_dt));
                  if($last_date == $curr_date){
                    $regimen_data[$last_date][] = $curr_visit->short_form;
                  }else{
                    $regimen_data[$curr_date][] = $curr_visit->short_form;
                  }
                $last_date = $curr_date;  
            }
              
            /*echo '<pre>';
            print_r($regimen_data);
            exit;*/
              
            return $regimen_data; 

        }

        return $regimen_data;
 }
  else{

        $sql = "select b.short_form,a.visit_dt from pi_treatment a inner join param_data b on a.param_id  = b.param_id 
           where b.short_form != '' and a.mrdno = $mrdno order by visit_dt desc";

       //echo "sql: $sql";exit;
      
        $query = $this->db->query($sql);
        $result = "";
        $query_result = $query->result();
      
      //echo '<pre>';
      //print_r($query_result);
      //exit;
      
      foreach($query_result as $curr_visit){
        $curr_date = date('Y-m-d',strtotime($curr_visit->visit_dt));
          if($last_date == $curr_date){
            $regimen_data[$last_date][] = $curr_visit->short_form;
          }else{
            $regimen_data[$curr_date][] = $curr_visit->short_form;
          }
        $last_date = $curr_date;  
      }
      
      //echo '<pre>';
      //print_r($regimen_data);
      //exit;
      
        if(!empty($regimen_data)):
        
        foreach($regimen_data as $last_date => $value):
              $str = '';
              foreach($value as $curr_data):
                $str .= $curr_data . " + ";
              endforeach;
              $str = rtrim($str,"+ ");
              //echo "str: $str <br>";
        
        $result .= "<li><a href=#><div class='fltleft' style='width:52%'>$str</div><div class='fltright' style='width:38%'>" . strtolower(date('d.M.y', strtotime($last_date))) . "</div><br class='clearfloat' /></a></li>";
        endforeach;
        
        else:
          $result = "<li>No data present</li>"; 
        endif;
        return $result;
}
	
	  
	  
	  
  }
  
  
  
 
  public function get_patient_weight($mrd_no, $count = "") {
    $sql = "SELECT addinfo, visit_dt
				FROM  `pi_examination` 
				WHERE  `head_id` = 8 
				AND  `mrdno` = $mrd_no 
				AND  `param_id` = 3 
                                AND (addinfo != NULL OR addinfo != '')  
				ORDER BY visit_dt DESC ";

    if (!empty($count)):
      $sql .= " LIMIT $count";
      $query = $this->db->query($sql);
      return $query->result();
    endif;
    $query = $this->db->query($sql);
    $result = "";
	$query_result = $query->result();
	if(!empty($query_result)):
    foreach ($query->result() as $row):
      if ($row->addinfo && $row->visit_dt):
        $result .= "<li><a href=#><div class='fltleft'>$row->addinfo</div><div class='fltright'>" . strtolower(date('d.M.y', strtotime($row->visit_dt))) . "</div><br class='clearfloat' /></a></li>";
      endif;
    endforeach;
	else:
		$result = "<li>No data present</li>";
	endif;

    return $result;
  }

  public function add_list_value($head_id, $parameter, $section) {
  
    //  if investigation
	// alter the table structure to add the list value
	
	if($head_id == 272):
		$sql_add = "ALTER TABLE `pi_investigation`
				    ADD `$parameter` varchar(50)";
		$this->db->query($sql_add);
	endif;
	
	
	$this->db->select_max('param_id');
    $this->db->from('param_data');
    $this->db->where('head_id', $head_id);
    $records = $this->db->get();
    foreach ($records->result() as $row):
      $next_parameter_id = $row->param_id;
    endforeach;
    $next_parameter_id = $next_parameter_id + 1;
    $sql = "insert into param_data(`section`,`parameter`,`head_id`,`param_id`) values ('$section','$parameter',$head_id,$next_parameter_id)";
    $this->db->query($sql);
	
	
	
		
	

    // get all the parameters

    $this->db->select('parameter, param_id');
    $this->db->from('param_data');
    $this->db->where('head_id', $head_id);
    $this->db->order_by('parameter', 'asc');
    $query = $this->db->get();
    $html = "";
    foreach ($query->result() as $row):
      if ($parameter == $row->parameter):
        $html .= "<option selected='selected' value=$row->param_id>$row->parameter</option>";
      else:
        $html .= "<option value=$row->param_id>$row->parameter</option>";
      endif;

    endforeach;
    return $html;     
  }

}

?>