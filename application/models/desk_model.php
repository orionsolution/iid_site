<?php
Class Desk_model extends CI_Model
{
	function get_queue($queue_type){
		$today=date("Y-m-d");
		if($queue_type=="Complete"):
			$sql="select b.mrdno,firstname,surname,visit_status,attended_by,in_time,out_time 
					from visit a, patient_mast b
					where a.mrdno=b.mrdno and visit_dt='$today' and visit_status in ('Close') 
					order by out_time desc";
		else:
			$sql="select b.mrdno,firstname,surname,visit_status,attended_by,in_time,out_time
					from visit a, patient_mast b
					where a.mrdno=b.mrdno and visit_dt='$today' and visit_status in ('Open','Pending','Queue') 
					order by visit_status,visit_id";		
		endif;
		//echo "<br>".$sql;
		
		$query = $this->db->query($sql);
		$result = $query->result_array();		
		return $result;
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
	function desk_status($status){
		$sql = "SELECT COUNT( visit_id ) as desk_count
					FROM visit
					WHERE visit_status in ($status) and visit_dt = '".date('Y-m-d')."'";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		foreach($result as $row):
			$desk_count = $row['desk_count'];
		endforeach;
		return $desk_count;	
	}
	function desk_status_done(){
		$query1 = "select * from `patient_mast` where `status`='done'";
		$q1 = $this->db->query($query1);
		$data = $q1->result();
		//print_r($data);exit;
		return $data;	
	}
	
	function done($mrd_no){
		$sql = "update `visit` set `visit_status`='Close', `out_time`= NOW() where `mrdNo`= $mrd_no and visit_dt = '". date('Y-m-d')."'";
		$q = $this->db->query($sql); 

	}
        
        public function remove_patient_entry($mrdno){
          $sql = "DELETE FROM visit WHERE `mrdno` = $mrdno AND `visit_dt` = CURDATE()";
          $this->db->query($sql);
        }
	
	function remove($mrd_no){
				$remove_p ="update `patient_mast` set `status`='no_queue' where `mrdNo`='$mrd_no'";
				$q = $this->db->query($remove_p);
			}
                       
	
}
?>
