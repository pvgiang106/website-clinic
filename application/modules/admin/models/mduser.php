<?php

Class Mduser extends CI_Model {
    
    public function record_count() {
        return $this->db->count_all("user");
    }
    
    function listuser(){
        $query = $this->db->get('user_customer');        
        return $query->result();             
    }    
    
    function getuser($userID){
        $this->db->select('userID,email, username, password, avatar, role,status');
        $this->db->from('user');
        $this->db->where('userID',$userID);
        $query = $this->db->get();        
        return $query->result();             
    }    

}

?>
