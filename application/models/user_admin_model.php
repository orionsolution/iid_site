<?php
Class User_admin_model extends CI_Model
{
	function login($username, $password)
	{
		$this -> db -> select('id, username, password');
		$this -> db -> from('admin');
		$this -> db -> where('username = ' . "'" . $username . "'"); 
		$this -> db -> where('password = ' . "'" . $password . "'"); 
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}

	}
	
	/*function reset_patient(){
		$done = "update `personalinformation` set `status`='no_queue'";
		//echo $done;
		$q = $this->db->query($done); 
	}*/
	 
}
?>