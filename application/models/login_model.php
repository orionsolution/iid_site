<?php
session_start();
class Login_model extends CI_Model
{
	function validate()
	{
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        //echo $username."-".$password;
        if($username || $password):
    		$this->db->where('user',$username);
    		$this->db->where('pswd',$password);
    		$query=$this->db->get('admin');
    		//echo $this->db->last_query();
    		if($query->num_rows()==1):
                //echo "<br>found";
                $data=array(
                		'admin_name'=>$username,
            	    	'admin_logged_in'=>true
            		    );
        		$this->session->set_userdata($data);
                return true;
            else:
                //echo "not found";
                return false;
            endif;
        else:
            echo "No Input";
            exit;
        endif;
	}


}


 ?>
