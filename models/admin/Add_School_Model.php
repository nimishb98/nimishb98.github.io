<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Add_School_Model extends CI_Model {
	
	public function addschool($school_cred,$school_name_data){
		
		$this->db->insert('school_cred',$school_cred);  
		$this->db->insert('school_name',$school_name_data);  
  		$this->session->set_flashdata("success","School inserted successfully.");
        redirect('admin/Add_School');  
	}
		 public function get_last_id(){

			 	$this->db->select_max('id');
				$query = $this->db->get('school_cred');
				//echo $query->num_rows(); exit;
				if ($query->num_rows() > 0)
    			{
						$result=$query->result_array();
						return $result[0]['id'];
				}else{
					return 0;
				}

			 }
	
}

?>