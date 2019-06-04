<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class All_Class_Model extends CI_Model {

	public function allclass(){
		echo $school_id=$this->session->userdata('uid'); 
		$query = $this->db->query("SELECT * FROM class_section where school_id=$school_id");
		$allclass=$query->result();
		//print_r($allclass); exit;
		return $allclass;
	}
	public function delclass($class_id){
		$this->db->delete('class_section', array('id' => $class_id)); 
	$this->session->set_flashdata('delete','Record deleted successfully.');
	redirect('user/All_Class');
	}

	
}

?>