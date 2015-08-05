<?php
Class Patient_form_model extends CI_Model
{
	function add_patient()
	{
		/*$data=array(
					'mrdNo'=>$this->input->post('mrdNo'),
					'title'=>$this->input->post('title'),
					'firstname'=>$this->input->post('firstname'),
					'surname'=>$this->input->post('surname'),
					'birth_date'=>$this->input->post('birth_date'),           		
			         );*/
					$mrdNo = $_POST['mrdNo'];
					$title = $_POST['title'];
					$contact = $_POST['contact'];
					$alt_contact = $_POST['alt_contact'];
					$firstname = $_POST['firstname'];
					$surname = $_POST['surname'];
					$birth_date = $_POST['birth_date'];
					$refdr = $_POST['refdr'];
					$PresentCity = $_POST['PresentCity'];
					$PermanentCity = $_POST['PermanentCity'];
					$Edu = $_POST['Edu'];
					$Occu = $_POST['Occu'];
					$perinfo = $_POST['perinfo'];
					$sqldate = "select CURDATE()";
					$res_date = mysql_query($sqldate);
					$res_date = mysql_fetch_assoc($res_date);
					$curr_date = $res_date['CURDATE()'];
					$age = $curr_date - $birth_date;
					$status = 'not_queue';
					$query = "INSERT INTO `patient_mast`(`mrdNo`,`title`,`contact`,`alt_contact`,`firstname`,`surname`,`birth_date`,`age`,`refdr`,`PresentCity`,`PermanentPlace`,`Edu`,`Occu`,`perinfo`,`status`) VALUES('$mrdNo','$title','$contact','$alt_contact','$firstname','$surname','$birth_date','$age','$refdr','$PresentCity','$PermanentCity','$Edu','$Occu','$perinfo','$status')";
					$q = $this->db->query($query);
	
	}
	
	function find_patient($mrd){
				$query = "select * from `patient_mast` where `mrdNo`='$mrd'";
				$q = $this->db->query($query);
				$data = $q->result();
				//print_r($data);//exit;
				return $data;
	}
	
	function show_patient($mrd_no){
				$query = "select * from `patient_mast` where `mrdNo`='$mrd_no'";
				$q = $this->db->query($query);
				$data = $q->result();
				//print_r($data);//exit;
				return $data;
	}
	function update_patient($mrd_no){
					$mrdNo = $_POST['mrdNo'];
					$title = $_POST['title'];
					$contact = $_POST['contact'];
					$alt_contact = $_POST['alt_contact'];
					$firstname = $_POST['firstname'];
					$surname = $_POST['surname'];
					$birth_date = $_POST['birth_date'];
					$refdr = $_POST['refdr'];
					$PresentCity = $_POST['PresentCity'];
					$PermanentCity = $_POST['PermanentCity'];
					$Edu = $_POST['Edu'];
					$Occu = $_POST['Occu'];
					$perinfo = $_POST['perinfo'];
					$sqldate = "select CURDATE()";
					$res_date = mysql_query($sqldate);
					$res_date = mysql_fetch_assoc($res_date);
					$curr_date = $res_date['CURDATE()'];
					$age = $curr_date - $birth_date;
					//$status = 'not_queue';
					$query = "update `patient_mast` set `title`='$title',`contact`='$contact',`alt_contact`='$alt_contact',`firstname`='$firstname',`surname`='$surname',`birth_date`='$birth_date',`age`='$age',`refdr`='$refdr',`PresentCity`='$PresentCity',`PermanentPlace`='$PermanentCity',`Edu`='$Edu',`Occu`='$Occu',`perinfo`='$perinfo' where `mrdNo`='$mrd_no'";
					$q = $this->db->query($query);
	}
}
?>