<?php

Class User extends CI_Model {

    function login($email, $password) {
        $this->db->select('userID,email, username, password, avatar, role');
        $this->db->from('user');
        $this->db->where('email', $email);
        $this->db->where('password',  md5($password));
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function checkemail($email) {
        $this->db->select('email,userID');
        $this->db->from('user');
        $this->db->where('email',$email);
        $this->db->limit(1);
        
        $query = $this->db->get();
        
        if($query->num_rows() == 1){
            return $query->result();
        } else {
            return FALSE;
        }
    }
    
    
    
    function inserttouser($data){
        $this->db->insert('user',$data);
    }
    // insert data into profile
    function inserttoprofile($dataprofile){
        $this->db->insert('profile',$dataprofile);
    }
    
    // change pass for user
    function changepass($id,$pass){
        $this->db->where('userID',$id);
        $this->db->update('user',array('password'=>  md5($pass)));
    }
    
    
}

?>
