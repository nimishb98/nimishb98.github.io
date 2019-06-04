<?php

defined('BASEPATH') OR exit('No direct script access allowed');
Class Email_Teachers_Details extends CI_Controller {
function __construct(){
parent::__construct();
//$this->load->model('user/Add_Class_Model');
if(! $this->session->userdata('uid')){
	redirect('user/login');
}
}
public function index(){
	//	$this->load->model('user/Add_Class_Model');
	
	$this->load->view('user/email_teacher_details'); 
	/*$userid = $this->session->userdata('uid');
	$this->load->model('User_Profile_Model');
$profiledetails=$this->User_Profile_Model->getprofile($userid);
$this->load->view('user/dashboard',['profile'=>$profiledetails]);*/

}

}
?>