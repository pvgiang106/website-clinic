<?php

Class Mdclinic extends CI_Model {
    
    public function record_count() {
        return $this->db->count_all("hotel");
    }
    
    function getlichkham($id_phongkham){
        $this->db->from('lich_kham');
        $this->db->where('id_phongkham',$id_phongkham);
        $query = $this->db->get();        
        return $query->result();             
    }    
    
    function gethotel($hotelID){
        $this->db->select('hotelID,hotelName,hotelStar,address,cityID,description');
        $this->db->from('lich_phongkham');
        $this->db->where('hotelID',$hotelID);
        $query = $this->db->get();        
        return $query->result();             
    }
    
    function gethotelID($hotelname) {
        $this->db->select('hotelID');
        $this->db->from('hotel');
        $this->db->where('hotelName',$hotelname);
        $query = $this->db->get();        
        return $query->result();
    }
            
    function deletehotel($hotelID) {
        $this->db->where('hotelID',$hotelID);
        $this->db->delete('hotel');
    }
    
    function updatehotel($hotelID,$data) {
        $this->db->where('hotelID',$hotelID);
        $this->db->update('hotel',$data);
    }
    
    function inserthotel($data){
        $this->db->insert('hotel',$data);
    }   
}

?>
