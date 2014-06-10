<?php

Class Mdmedicine extends CI_Model {
    
    public function record_count() {
        return $this->db->count_all("hotel");
    }
    
    function listmedicine(){
        $query = $this->db->get('thuoc');        
        return $query->result();             
    }    
    
}

?>
