<?php

Class Edit_Class extends CI_Controller{

	function __construct(){

		parent::__construct();
		$this->load->model('user/Edit_Class_Model');
		if(! $this->session->userdata('uid')){
		redirect('user/login');
	}
}

public function index(){
	
		$this->load->view('user/error_404');
	
	
}

public function editclass($id){
	//echo $id; 	
	/*$eid = 	urldecode($id);
	echo $eid; exit;*/
	$edtdata=$this->Edit_Class_Model->geteditdata($id);
	$this->load->view('user/edit_class',['edtclass'=>$edtdata]);
	//print_r($edtdata);
}

public function update_class($id){
	//echo $id; exit;
	//$this->load->view('user/add_class'); 
	$this->form_validation->set_rules('cname','Class Name','required');
	$this->form_validation->set_rules('csection','Class Section','required');
	if($this->form_validation->run()){
			 $cname=$this->input->post('cname');
			 $csection=$this->input->post('csection');
			
			$validate=$this->Edit_Class_Model->updateclass($cname,$csection,$id);			
		}
		else{
			$this->load->view('user/Edit_Class');
}
}
}
?>