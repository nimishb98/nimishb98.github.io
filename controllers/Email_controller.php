<?php 
   class Email_controller extends CI_Controller { 
 
      function __construct() { 
         parent::__construct(); 
         $this->load->library('session'); 
         $this->load->helper('form'); 
      } 
		
      public function index() { 
	
         $this->load->helper('form'); 
         $this->load->view('email_form'); 
      } 
  
      public function send_mail() { 
         $from_email = "medicmediocrity@gmail.com"; 
         $to_email = $this->input->post('email'); 
   
         //Load email library 
         $this->load->library('email'); 
   
         $this->email->from($from_email, 'Your Name'); 
         $this->email->to($to_email);
         $this->email->subject('Email Test'); 
         $this->email->message('Testing the email class.'); 
         $config = array(
          'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
          'smtp_host' => 'smtp.gmail.com', 
          'smtp_port' => 465,
          'smtp_user' => 'medicmediocrity@gmail.com',
          'smtp_pass' => 'medicmediocrity@098',
);
         $this->email->initialize($config);
         //Send mail 
         if($this->email->send()) 
         $this->session->set_flashdata("email_sent","Email sent successfully."); 
         else 
         show_error($this->email->print_debugger());
      } 
   } 
?>