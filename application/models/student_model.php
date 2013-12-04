<?php

class Student_model extends CI_Model{
    
    public function getStudent($username = null, $password = null){
        $this->db->select('*');
		$this->db->where('username',$username);
		$this->db->where('password',md5($password));

		$q = $this->db->get('Students'); 

        return $this->queryRowConversion($q);
    }

    public function insertStudent($info){
    	if($this->isValidUsername($info['username'])){
    		$this->db->insert('Students',$info);
    		return true;
    	}
    	return false;
    }

    public function getUsers(){
    	$this->db->select('*');
    	$q = $this->db->get('Students');

    	return $this->queryConversion($q);
    }

    private function isValidUsername($username){
    	$this->db->select('username');
    	$this->db->where('username',$username);

    	$q = $this->db->get('Students');

    	if($q->num_rows() > 0){
    		return false;
    	}
    	return true;
    }
    
    private function queryConversion($query){
		if($query->num_rows()>0){
			foreach($query->result() as $rows){
				$data[] = $rows;
			}
			$query->free_result();
			return $data;
		}	
		return null;
	}
    
    private function queryRowConversion($query){
		if($query->num_rows() == 1){
			$data = $query->row();
			$query->free_result();
			return $data;
		}
		return null;
	}
}