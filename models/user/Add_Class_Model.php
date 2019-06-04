<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Add_Class_Model extends CI_Model {

	public function validateclass($cname,$csection){

	$login=$this->db->where(['class'=>$cname,'section'=>$csection]);
	$class=$this->db->get('class_section')->row();;
	//print_r($account); exit;
	if($class!= NULL){
		$this->session->set_flashdata('error','Class already exist.');
		redirect('user/Add_Class');
		return NULL;
		}
		else{
			return 1;
		}
	}
	
	public function savecls($clsdata){
		$this->db->insert('class_section',$clsdata);  
  		$this->session->set_flashdata("success","Class inserted successfully.");
        redirect('user/Add_Class');  
	}
	
}

?>