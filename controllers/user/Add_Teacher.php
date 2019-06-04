<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Add_Teacher extends CI_Controller {
function __construct(){
$data = array ();
parent::__construct();
if(! $this->session->userdata('uid')){
	redirect('login');
}
}
public function index(){
	$this->load->model('user/Add_Teacher_Model');
 	$id=$this->Add_Teacher_Model->get_last_id() + 1;
	$idlen= strlen ($id); 
	if($idlen==1){
		$id='TECH0000'.$id;
	}
	if($idlen==2){
		$id='TECH000'.$id;
	}
	if($idlen==3){
		$id='TECH00'.$id;
	}
	if($idlen==4){
		$id='TECH0'.$id;
	}
	if($idlen==5){
		$id='TECH'.$id;
	}
	$data['id']=$id;
	$subject_list = $this->Add_Teacher_Model->get_subject_list();
	$class_list = $this->Add_Teacher_Model->get_class();
	//print_r($class_list); exit;
//	$section_list = $this->Add_Teacher_Model->get_section();
	$data['subject_list']=$subject_list;
//	$data['section_list']=$section_list;
	$data['class_list']=$class_list;
	$this->load->view('user/add_teacher',$data); 
}

public function fetch_section()
 {
 	$this->load->model('user/Add_Teacher_Model');
	$this->Add_Teacher_Model->get_section(); 
  if($this->input->post('class1'))
  {
  //	echo "TTT";
   echo $x= $this->Add_Teacher_Model->get_section($this->input->post('class1')); 
  }
 }

 public function save_teacher(){
 		/**/

 	
 	$id=$this->input->post('id');

 	$this->load->model('user/Add_Teacher_Model');
 	$id=$this->Add_Teacher_Model->get_last_id() + 1;
	$idlen= strlen ($id); 
	if($idlen==1){
		$id='TECH0000'.$id;
	}
	if($idlen==2){
		$id='TECH000'.$id;
	}
	if($idlen==3){
		$id='TECH00'.$id;
	}
	if($idlen==4){
		$id='TECH0'.$id;
	}
	if($idlen==5){
		$id='TECH'.$id;
	}
	$data['id']=$id;
	$subject_list = $this->Add_Teacher_Model->get_subject_list();
	$class_list = $this->Add_Teacher_Model->get_class();
	//print_r($class_list); exit;
//	$section_list = $this->Add_Teacher_Model->get_section();
	$data['subject_list']=$subject_list;
//	$data['section_list']=$section_list;
	$data['class_list']=$class_list;
	$config= [
 			'upload_path'=>'profile_images',
 			'allowed_types' => 'jpg|jpeg|gif|png',
 			'overwrite' => TRUE,
 			'file_name' => $id,
 			
 			];
 	//print_r($config); exit;
 	$img = $this->input->post('userfile');
 	$this->load->library('upload',$config);
 	$this->upload->initialize($config);
 		$this->form_validation->set_rules('fname','First name','required');
		$this->form_validation->set_rules('lname','Last name','required');
		$this->form_validation->set_rules('jdate','Joining date','required');
		$this->form_validation->set_rules('bdate','Birth date','required');
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('gender','Gender','required');
		$this->form_validation->set_rules('cpassword', ' Comfirm Password', 'required|matches[password]');
		$this->form_validation->set_rules('mno','Mobile number','required|max_length[10]');
		$this->form_validation->set_rules('class','Class','required');
		$this->form_validation->set_rules('subject','Subject','required');
		$this->form_validation->set_rules('section','Section','required');
		$this->form_validation->set_rules('salary','Salary','required');
		if($this->form_validation->run() && $this->upload->do_upload()){
			$img_name_data=$this->upload->data();
			//print_r($img_name_data); exit;
			$fname=$this->input->post('fname');
			$lname=$this->input->post('lname');
			$jdate=$this->input->post('jdate');
			$bdate=$this->input->post('bdate');
			$email=$this->input->post('email');
			$password=$this->input->post('password');
			$gender=$this->input->post('gender');
			$mno=$this->input->post('mno');
			$class=$this->input->post('class');
			$subject=$this->input->post('subject');
			$section=$this->input->post('section');
			$address=$this->input->post('address');
			$salary=$this->input->post('salary');
			$photo=$img_name_data['raw_name'].$img_name_data['file_ext'];
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
			$cdata = array(
							
							);
			$msg=$this->load->view('user/email_teacher_details',['id' =>$id,
							'name' => $fname. " " . $lname,
							'password' => $password],TRUE);
			$this->email->message($msg);
			$this->email->set_newline("\r\n");

			if($this->email->send()){
				echo "string"; exit;
			} else{
				show_error($this->email->print_debugger());
			exit; }
			//$cls_id=$this->Add_Teacher_Model->getclasssectionid($class,$section); exit;
			$teacher_data1= array(
									'teacher_id'=>$id,
									'school_id'=>$this->session->userdata('uid'),
									'email'=>$email,
									'password'=>$password
						   		);
			$teacher_data2= array(
									'teacher_id'=>$id,
									'first_name'=>$fname,
									'last_name'=>$lname,
									'joining_date'=>$jdate,
									'birth_date'=>$bdate,
									'gender'=>$gender,
									'mobile'=>$mno,
									'photo'=>$photo
						   		);
			$tech_sub_data= array(
									'teacher_id'=>$id,
									'subject_id'=>$subject
								);
			$tech_class_data= array(
									'teacher_id'=>$id,
									'class_section_id'=>$section
								);
			$tech_salary_data= array(
									'teacher_id'=>$id,
									'salary'=>$salary
								);

			$save_teacher=$this->Add_Teacher_Model->saveteacher($teacher_data1,$teacher_data2,$tech_sub_data,$tech_class_data,$tech_salary_data);
			//$this->load->view('user/add_teacher',$data);
			}else{
			$data['upload_error']=$this->upload->display_errors();
			$this->load->view('user/add_teacher',$data);
		}

 }
}
?>