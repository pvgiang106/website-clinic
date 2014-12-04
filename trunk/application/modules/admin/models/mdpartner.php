<?php

Class Mdpartner extends CI_Model {
    
    public function record_count() {
        return $this->db->count_all("partner");
    }
    
    function listPartner(){
        $this->db->from('partner');
        $this->db->where('inactive',0);
		$query = $this->db->get();       
        return $query->result();            
    }    
    
    function insertPartner($data){		
        $this->db->insert('partner',$data);            
    }

	function getInfoPartner($partnerID){
		$this->db->from('partner');
		$this->db->where('partnerID',$partnerID);
        $this->db->where('inactive',0);
		$query = $this->db->get();
		return $query->result();
	}
	function getCustomerID($email){
		$this->db->select('partnerID');
		$this->db->from('partner');
		$this->db->where('email',$email);
        $this->db->where('inactive',0);
		$query = $this->db->get();
		return $query->result();
	}
	function updatePartner($partnerID,$data){
		$this->db->where('partnerID',$partnerID);
		$this->db->update('partner',$data);
	}
	function getListBusiness($partnerID){
		$this->db->from('partner');
		$this->db->where('businessID',$partnerID);
		$query = $this->db->get();
		return $query->result();
	}
	function getMenu($businessID){
		$this->db->from('menu');
		$this->db->where('businessID',$businessID);
		$query = $this->db->get();
		return $query->result();
	}
	function getMenuItemID($menuID){
		$this->db->select('itemID');
		$this->db->from('item_detail');
		$this->db->where('menuID',$menuID);
		$query = $this->db->get();
		return $query->result();
	}
	function getItemDetail($itemID){
		$this->db->from('item_detail');
		$this->db->where('itemID',$itemID);
		$query = $this->db->get();
		return $query->result();
	}
	function getListTransactionPartner($businessID){
		$this->db->from('transaction');
		$this->db->where('businessID',$businessID);
		$query = $this->db->get();
		return $query->result();
	}
	function getTransactionDetail($transactionID){
		$this->db->from('transaction');
		$this->db->where('transactionID',$transactionID);
		$query = $this->db->get();
		return $query->result();
	}
	function getTransactionItem($transactionID){
		$this->db->from('transaction_detail');
		$this->db->where('transactionID',$transactionID);
		$query = $this->db->get();
		return $query->result();
	}

}

?>
