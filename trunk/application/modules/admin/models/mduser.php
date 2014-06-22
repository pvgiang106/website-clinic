<?php

Class Mduser extends CI_Model {
    
    public function record_count() {
        return $this->db->count_all("user");
    }
    
    function listuser(){
		$this->db->from('user_customer');
		$this->db->where('status',1);
        $query = $this->db->get();        
        return $query->result();             
    }    
    	
	function deluser($email){
		$data=array(
					'status' => 0
				);
		$this->db->where('email',$email);
		$this->db->update('user_customer',$data);
		$this->db->where('email',$email);
		$this->db->update('lich_kham',$data);
	}

}

?>
