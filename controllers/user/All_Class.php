<?php

defined('BASEPATH') OR exit('No direct script access allowed');
Class All_Class extends CI_Controller{

function __construct(){

	parent::__construct();
	$this->load->model('user/All_Class_Model');
	if(! $this->session->userdata('uid')){
	redirect('user/login');
	}
}

public function index(){
	$allclass1=$this->All_Class_Model->allclass();
	$this->load->view('user/All_Class',['allclass'=>$allclass1]);
	//print_r($allclass1); exit;	
		
}
public function deleteclass($class_id){
	$this->All_Class_Model->delclass($class_id);
}


}
?>