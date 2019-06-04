
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Add_Teacher_Model extends CI_Model {

		public function get_subject_list()
			{
				$this->db->from('subject');
				$this->db->order_by('subject_name');
				$result = $this->db->get();
				//print_r($result); exit;
				$subject_array = array();
				if($result->num_rows() > 0) {
				foreach($result->result_array() as $row) {
				$subject_array[$row['subject_id']] = $row['subject_name'];
			}
			}

			     return $subject_array;

			}
			public function get_class()
			{
				$school_id=$this->session->userdata('uid'); 
				$query = $this->db->query("SELECT DISTINCT(class) FROM class_section where  school_id=$school_id");
				$result=$query->result();
				$array = json_decode(json_encode($result), true);
			//		print_r($array); exit;
				$class_array = array();
				foreach ($result as $key => $object) {
				    $class_array[$object->class] = $object->class;
				} 
						//print_r($class_array); exit;
			        return $class_array;

			}
			public function get_section($clsname)
			 { 
			 //	echo "55"; exit;
			  $school_id=$this->session->userdata('uid'); 
			  $this->db->where('class',$clsname);
			  $query = $this->db->get('class_section');
			  //print_r($query->result() ); exit;
			  $output = '<option value="">Select Section</option>';
			  foreach($query->result() as $row)
			  {
			   $output .= '<option value="'.$row->id.'">'.$row->section.'</option>';
			  }
			  return $output;
			 }

			 public function get_last_id(){

			 	$this->db->select_max('id');
				$query = $this->db->get('teachers_cred');
				//echo $query->num_rows(); exit;
				if ($query->num_rows() > 0)
    			{
						$result=$query->result_array();
						return $result[0]['id'];
				}else{
					return 0;
				}

			 }

			 public function saveteacher($teacher_data1,$teacher_data2,$tech_sub_data,$tech_class_data,$tech_salary_data){

			 	$this->db->insert('teachers_cred',$teacher_data1);
			 	$this->db->insert('teachers_data',$teacher_data2);
			 	$this->db->insert('teacher_subject',$tech_sub_data);
			 	$this->db->insert('teacher_class',$tech_class_data);
			 	$this->db->insert('teacher_salary',$tech_salary_data);

			 }

			 /*public function getclasssectionid($class,$section){
			 	echo $class;

			 	echo $section; exit;
			 	$query= $this->db->get_where('class_section',['class'=>$class,'section'=>$section]);
			 	print_r($query); exit;
			 }*/

	
}
?>