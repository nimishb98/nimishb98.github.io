<?php

defined('BASEPATH') OR exit('No direct script access allowed');
Class Add_School extends CI_Controller {
function __construct(){
//sglobal ($data);
parent::__construct();
$this->load->model('admin/Add_School_Model');
if(! $this->session->userdata('uid')){
	redirect('login');
}
}
public function index(){
	//	$this->load->model('user/Add_Class_Model');
	
	//$this->load->view('admin/add_school'); 
	$id=$this->Add_School_Model->get_last_id() + 1;
	$idlen= strlen ($id); 
	if($idlen==1){
		$id='SCHL0000'.$id;
	}
	if($idlen==2){
		$id='SCHL000'.$id;
	}
	if($idlen==3){
		$id='SCHL00'.$id;
	}
	if($idlen==4){
		$id='SCHL0'.$id;
	}
	if($idlen==5){
		$id='SCHL'.$id;
	}
	$data['id']=$id;
	
	//$data['ss']='ssssss';
	//print_r($data); exit;
	//echo $id; exit;
	$this->load->view('admin/add_school',$data);

}
public function save_school(){
	$id=$this->Add_School_Model->get_last_id() + 1;
	$idlen= strlen ($id); 
	if($idlen==1){
		$id='SCHL0000'.$id;
	}
	if($idlen==2){
		$id='SCHL000'.$id;
	}
	if($idlen==3){
		$id='SCHL00'.$id;
	}
	if($idlen==4){
		$id='SCHL0'.$id;
	}
	if($idlen==5){
		$id='SCHL'.$id;
	}
	$data['id']=$id;	
	//$this->load->view('user/add_class'); 
	$this->form_validation->set_rules('password','Password','required');
	$this->form_validation->set_rules('email','Email','required');
	$this->form_validation->set_rules('sname','School name','required');
	$this->form_validation->set_rules('cpassword', ' Comfirm Password', 'required|matches[password]');
	if($this->form_validation->run()){
		$sch_id=$this->input->post('id');
		$email=$this->input->post('email');
		$password=$this->input->post('password');
		$sname=$this->input->post('sname');
		$school_cred_data=array(
									'school_id'=>$sch_id,
									'email'=>$email,
									'password'=>$password
									);
		$school_name_data=array(
									'school_id'=>$sch_id,
									'name'=>$sname
									);
		$from_email = "medicmediocrity@gmail.com"; 
			 $config = array(
	 			'mailtype' =>'html',
	          'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
	          'smtp_host' => 'ssl://smtp.googlemail.com', 
	          'smtp_port' => 465,
	          'smtp_user' => 'medicmediocrity@gmail.com',
	          'smtp_pass' => 'medicmediocrity@098',
				);
		$this->load->library('email',$config);
			$this->email->from($from_email, 'Nimish');
			$this->email->to($email);
			$this->email->subject('Your Account Credientials Preschool');
			
			$msg=$this->load->view('admin/welcome_school_email',['id' =>$id,
							'name' => $sname,
							'password' => $password],TRUE);
			$this->email->message($msg);
			$this->email->set_newline("\r\n");

			if($this->email->send()){
				$this->session->set_flashdata("successmail","Credientials Sent.");
			} else{
				$this->session->set_flashdata("successmail","Error while sending credentials");
			 }
		$this->Add_School_Model->addschool($school_cred_data,$school_name_data);
				
	 
	

			
		}
		else{
			$this->load->view('admin/Add_School',$data);
}
}
}
?>