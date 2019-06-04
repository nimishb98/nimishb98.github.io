<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Edit_Class_Model extends CI_Model {

	public function geteditdata($id){
		$query = $this->db->get_where('class_section',array('id' => $id));

		$edtdata=$query->result();
		//print_r($edtdata); exit;
		return $edtdata;
	}

	public function updateclass($class,$section,$id){

		$olddata=$this->db->where(['class'=>$class,'section'=>$section]);
		$dupcheck=$this->db->get('class_section')->row();;
		//print_r($dupcheck); exit;
		if($dupcheck!= NULL){
			$this->session->set_flashdata('error','Class already exist.');
			redirect('user/Edit_Class/editclass/'.$id);
			return NULL;
			}
			else{
				
				$data = array(
		               'class' => $class,
		               'section' => $section,
		            );
				$this->db->where('id', $id);
				$x=$this->db->update('class_section', $data); 
				if($x){

					$this->session->set_flashdata('success','Class updated successfully.');
					redirect('user/Edit_Class/editclass/'.$id);
				}
			}

	}
}

?>