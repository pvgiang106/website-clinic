<?php

Class Mdclinic extends CI_Model {
    
    public function record_count() {
        return $this->db->count_all("partner");
    }
    
    function listPartner(){
        $query = $this->db->get('partner');        
        return $query->result();             
    }    
    
    function insertPartner($data){		
        $this->db->insert('partner',$data);            
    }

	function getInfoPartner($partnerID){
		$this->db->from('partner');
		$this->db->where('partnerID',$partnerID);
		$query = $this->db->get();
		return $query->result();
	}

	function updatePartner($partnerID,$data){
		$this->db->where('partnerID',$partnerID);
		$this->db->update('partner',$data);
	}

}

?>
