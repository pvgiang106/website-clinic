<?php

Class Mdlhotel extends CI_Model {
    
    public function record_count() {
        return $this->db->count_all("hotel");
    }
    
    function listhotel(){
        $this->db->select('hotelID,hotelName,hotelStar,address,cityID');
        $this->db->from('hotel');
        $query = $this->db->get();        
        return $query->result();             
    }    
    
    function gethotel($hotelID){
        $this->db->select('hotelID,hotelName,hotelStar,address,cityID,description');
        $this->db->from('hotel');
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
    
    function getCityName($cityID) {
        $this->db->select('cityName');
        $this->db->from('city');
        $this->db->where('cityID',$cityID);
        $query = $this->db->get();        
        return $query->result();
    }
    
    function getCityID($cityName) {
        $this->db->select('cityID');
        $this->db->from('city');
        $this->db->where('cityName',$cityName);
        $query = $this->db->get();        
        return $query->result();
    }
    
    function getListCity() {
        $this->db->select('cityName,cityID');
        $this->db->from('city');
        $query = $this->db->get();        
        return $query->result();
    }
    
    function getHotelFacilities() {
        $this->db->select('facilityID,facilityName');
        $this->db->from('hotel_facilities');
        $query = $this->db->get();        
        return $query->result();
    }
    
    function getHotelFacilitiesSubply($hotelID) {
        $this->db->select('facilityID');
        $this->db->from('hotel_supply_facility');
        $this->db->where('hotelID',$hotelID);
        $query = $this->db->get();        
        return $query->result();
    }
    
    function getFacilitiesName($facilityID) {
        $this->db->select('facilityName');
        $this->db->from('hotel_facilities');
        $this->db->where('facilityID',$facilityID);
        $query = $this->db->get();        
        return $query->result();
    }
    
    function insertFacilitiesSubply($data) {
        $this->db->insert('hotel_supply_facility',$data);
    }
    
    function deleteFacilitiesSubply($hotelID,$facilityID) {
        $this->db->where('hotelID',$hotelID);
        $this->db->where('facilityID',$facilityID);
        $this->db->delete('hotel_supply_facility');
    }

//    function checkfacilities($facilityID) {
//        $this->db->select('facilityName');
//        $this->db->from('hotel_supply_facility');
//        $this->db->where('facilityID',$facilityID);
//        $query = $this->db->get();        
//        return $query->result();
//    }    
}

?>
