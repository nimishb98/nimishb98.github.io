<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class User_Login_Model extends CI_Model {

	public function validatelogin($username,$password,$active){

	$login=$this->db->where(['email'=>$username,'password'=>$password]);
	$account=$account=$this->db->get('admin_user')->row();;
	//print_r($account); exit;
	if($account!= NULL){
		$dbstatus=$account->active;
		if($dbstatus==$active){
			return $account->id;
		}else{
			
			$this->session->set_flashdata('error','Your account is not active contact admin');
			redirect('Login');
			return NULL;
		}
	}
	return NULL;
}
}
?>