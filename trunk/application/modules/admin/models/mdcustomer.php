<?php

Class Mdcustomer extends CI_Model {
    
    public function record_count() {
        return $this->db->count_all("customer");
    }
    
    function listCustomer(){
        $query = $this->db->get('customer');        
        return $query->result();             
    }    
    
    function insertCustomer($data){		
        $this->db->insert('customer',$data);            
    }
	
	function getInfoCustomer($customerID){
		$this->db->from('customer');
		$this->db->where('customerID',$customerID);
		$query = $this->db->get();
		return $query->result();
	}

	function updateCustomer($customerID,$data){
		$this->db->where('customerID',$customerID);
		$this->db->update('phongkham',$data);
	}
}

?>
