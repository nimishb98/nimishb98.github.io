<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class All_Teacher extends CI_Controller{

function __construct(){

	parent::__construct();
	$this->load->model('user/All_Teacher_Model');
	if(! $this->session->userdata('uid')){
	redirect('user/login');
	}
}

public function index(){
	$this->load->view('user/all_teacher');
}


}
?>