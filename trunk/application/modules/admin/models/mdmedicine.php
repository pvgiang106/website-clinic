<?php

Class Mdmedicine extends CI_Model {
    
    public function record_count() {
        return $this->db->count_all("hotel");
    }
    
    function listmedicine(){
        $query = $this->db->get('thuoc');        
        return $query->result();             
    }    
    function insertMedicine($data){
		$this->db->insert('thuoc',$data);
	}
	function updateMedicine($id_thuoc,$data){
		$this->db->where('id_thuoc',$id_thuoc);
		$this->db->update('thuoc',$data);
	}
}

?>
