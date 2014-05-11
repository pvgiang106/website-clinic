<?php

Class User extends CI_Model {
    
    public function record_count() {
        return $this->db->count_all("user");
    }
    
    function listuser(){
        $this->db->select('userID,email, username,sex,role,status');
        $this->db->from('user');
        $query = $this->db->get();        
        return $query->result();             
    }    
    
    function getuser($userID){
        $this->db->select('userID,email, username, password, avatar, role,status');
        $this->db->from('user');
        $this->db->where('userID',$userID);
        $query = $this->db->get();        
        return $query->result();             
    }
    
    function blockuser($userID) {
        $data = array(
            'status' => 'unblock'
        );
        $this->db->where('userID',$userID);
        $this->db->update('user',$data);
    }
    
    function unblockuser($userID) {
        $data = array(
            'status' => 'block'
        );
        $this->db->where('userID',$userID);
        $this->db->update('user',$data);
    }
}

?>
