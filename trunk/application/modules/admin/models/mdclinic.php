<?php

Class Mdclinic extends CI_Model {
    
    public function record_count() {
        return $this->db->count_all("hotel");
    }
    
    function listclinic(){
        $query = $this->db->get('phongkham');        
        return $query->result();             
    }    
    
    function insertclinic($data){		
        $this->db->insert('phongkham',$data);            
    }
    
    function getClinicId($phone) {
		$this->db->select('id_phongkham');
        $this->db->from('phongkham');
        $this->db->where('phone',$phone);
        $query = $this->db->get();        
        return $query->result();
    }
    function insertUserClinic($data){
		$this->db->insert('user_phongkham',$data);
	}
	function getInfoClinic($id_phongkham){
		$this->db->from('phongkham');
		$this->db->where('id_phongkham',$id_phongkham);
		$query = $this->db->get();
		return $query->result();
	}
	function getInfoUserClinic($id_phongkham){
		$this->db->from('user_phongkham');
		$this->db->where('id_phongkham',$id_phongkham);
		$this->db->where('role',0);
		$query = $this->db->get();
		return $query->result();
	}
	function updateClinic($id_phongkham,$data){
		$this->db->where('id_phongkham',$id_phongkham);
		$this->db->update('phongkham',$data);
	}
	function updateUserClinic($id_phongkham,$data){
		$this->db->where('id_phongkham',$id_phongkham);
		$this->db->where('role',0);
		$this->db->update('user_phongkham',$data);
	}
    function expireclinic($id_phongkham) {
		$data = array(
				'status' => 0
			);
        $this->db->where('id_phongkham',$id_phongkham);
		$this->db->where('role', 0);
        $this->db->update('user_phongkham',$data);

        $this->db->where('id_phongkham',$id_phongkham);
        $this->db->update('phongkham',$data);
    }
	function unblockclinic($id_phongkham){
		$data = array(
				'status' => 1
			);
        $this->db->where('id_phongkham',$id_phongkham);
		$this->db->where('role', 0);
        $this->db->update('user_phongkham',$data);
		
		$this->db->where('id_phongkham',$id_phongkham);
        $this->db->update('phongkham',$data);
	}
}

?>
