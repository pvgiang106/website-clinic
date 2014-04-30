<?php

Class Mwebservice extends CI_Model {
    
    function allphongkham(){
        $response = array();
        $result = $this->db->get("phongkham");
        $num_rows = $result->num_rows();
        if($num_rows != 0){            
            $response["products"] = array();
            $result_array = $result->result_array();
       	    for($i=0;$i<$num_rows;$i++) {
		      array_push($response["products"], $result_array[$i]);
	       }
	       // success
	       $response["success"] = 1;
 
	       // echoing JSON response
	       return json_encode($response);
        }else{
            $respone['success'] = 0;
            $respone['message'] = "No clinic";
            return json_encode($respone);
        }
    }
    
    function insertUser($data){
        $respone = array();
        $insert = $this->db->insert('user_customer',$data);
        if($insert){
            $respone['success'] = 1;
            $respone['message'] = "user insert succsess";
            return json_encode($respone);
        }else{
            $respone['success'] = 0;
            $respone['message'] = "user insert fail";
            return json_encode($respone);
        }
    }
    
    function checkUser($email,$password){
        $response = array();
        $this->db->where('email',$email);
        $this->db->where('password',md5($password));
        $query = $this->db->get('user_customer');
        if($query->num_rows() == 1){
            $respone['success'] = true;
            $respone['message'] = "user is exist";
            return json_encode($respone);
        }else{
            $respone['success'] = false;
            $respone['message'] = "user not exist";
            return json_encode($respone);
        }
    }
    
    function listTime($id_phongkham){
        $response = array();
        $this->db->where('id_phongkham',$id_phongkham);
        $result = $this->db->get('lich_phongkham');
        $num_rows = $result->num_rows();
        if($num_rows != 0){            
            $response["lichphongkham"] = array();
            $result_array = $result->result_array();
       	    for($i=0;$i<$num_rows;$i++) {
		      array_push($response["lichphongkham"], $result_array[$i]);
	       }
	       // success
	       $response["success"] = 1;
 
	       // echoing JSON response
	       return json_encode($response);
        }else{
            $respone['success'] = 0;
            $respone['message'] = "No list time";
            return json_encode($respone);
        }
    }
    
    function listKham($id_phongkham,$email){
        $response = array();
        $this->db->where('id_phongkham',$id_phongkham);
        $this->db->where('email',$email);
        $result = $this->db->get('lich_kham');
        $num_rows = $result->num_rows();
        if($num_rows != 0){            
            $response["lichkham"] = array();
            $result_array = $result->result_array();
       	    for($i=0;$i<$num_rows;$i++) {
		      array_push($response["lichkham"], $result_array[$i]);
	       }
	       // success
	       $response["success"] = 1;
 
	       // return JSON response
	       return json_encode($response);
        }else{
            $respone['success'] = 0;
            $respone['message'] = "No appoitment";
            return json_encode($respone);
        }
    }
    
}