<?php

Class User extends CI_Model {

    function login($email, $password) {
        $this->db->select('id_phongkham,email, name, password, role');
        $this->db->from('user_phongkham');
        $this->db->where('email', $email);
        $this->db->where('password',  md5($password));
		 $this->db->where('status', 1);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function checkemail($email) {
        $this->db->select('email,id_phongkham');
        $this->db->from('user_phongkham');
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
        $this->db->insert('user_phongkham',$data);
    }
    // insert data into profile
    function inserttoprofile($dataprofile){
        $this->db->insert('profile',$dataprofile);
    }
    
    // change pass for user
    function changepass($id,$pass){
        $this->db->where('id_phongkham',$id);
        $this->db->update('user_phongkham',array('password'=>  md5($pass)));
    }
    
    
}

?>
