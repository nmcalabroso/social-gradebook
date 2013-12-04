<?php

class Student_model extends CI_Model{
    
    public function isRegisteredUser($username = null, $password = null){
        $this->db->select('*');
		$this->db->where('username',$username);
		$this->db->where('password',md5($password));

		$q = $this->db->get('Students'); 

        return $this->queryRowConversion($q);
    }
    
    private function queryConversion($query){
		if($query->num_rows()>0){
			foreach($query->result() as $rows){
				$data[] = $rows;
			}
			$query->free_result();
			return $data;
		}	
		return -1;
	}
    
    private function queryRowConversion($query){
		if($query->num_rows == 1){
			$data = $query->row();
			$query->free_result();
			return $data;
		}
		return -1;
	}
}