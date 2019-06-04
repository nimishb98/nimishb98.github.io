
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Add_Teacher_Model extends CI_Model {
		function get_subject_list()
			{
			$this->db->from('subject');
			$this->db->order_by('subject_name');
			$result = $this->db->get()->row();
			print_r($result); exit;
			/*$subject_array = array();
			if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
			$subject_array[$row['subject_id']] = $row['subject_name'];
			}
			}

			        return $subject_array;

			}*/

	
}
?>