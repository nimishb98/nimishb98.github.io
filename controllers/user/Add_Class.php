<?php

defined('BASEPATH') OR exit('No direct script access allowed');
Class Add_Class extends CI_Controller {
function __construct(){
parent::__construct();
$this->load->model('user/Add_Class_Model');
if(! $this->session->userdata('uid')){
	redirect('user/login');
}
}
public function index(){
	//	$this->load->model('user/Add_Class_Model');
	
	$this->load->view('user/add_class'); 
	/*$userid = $this->session->userdata('uid');
	$this->load->model('User_Profile_Model');
$profiledetails=$this->User_Profile_Model->getprofile($userid);
$this->load->view('user/dashboard',['profile'=>$profiledetails]);*/

}
public function save_class(){
	//$this->load->view('user/add_class'); 
	$this->form_validation->set_rules('cname','Class Name','required');
	$this->form_validation->set_rules('csection','Class Section','required');
	if($this->form_validation->run()){
			 $cname=$this->input->post('cname');
			 $csection=$this->input->post('csection');
			
			$validate=$this->Add_Class_Model->validateclass($cname,$csection);			
			if($validate){
				$school_id=$this->session->userdata('uid');
				$clsdata= array(
								'class'=>$cname,
								'section'=>$csection,
								'school_id'=>$school_id,
								);
				$this->Add_Class_Model->savecls($clsdata);
			
			}
		}
		else{
			$this->load->view('user/Add_Class');
}
}
}
?>