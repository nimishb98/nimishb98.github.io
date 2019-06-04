<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Login extends CI_Controller {

	public function index()
	{
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		if($this->form_validation->run()){
			 $username=$this->input->post('username');
			 $password=$this->input->post('password');
			$active=1;
			$this->load->model('User_Login_Model');
			$validate=$this->User_Login_Model->validatelogin($username,$password,$active);			
			if($validate){
				$this->session->set_userdata('uid',$validate);
				return redirect('user/dashboard');
			}else{
				//echo "string" ; exit;
				$this->session->set_flashdata('error', 'Invalid details. Please try again with valid details');
				redirect('Login');
			}
		}else{
			$this->load->view('Login');
		}
	}

	
}
