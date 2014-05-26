<?php

Class Mdclinic extends CI_Model {
    //appointment menu
    function getlichkham($id_phongkham,$status){
        $this->db->from('lich_kham');
        $this->db->where('id_phongkham',$id_phongkham);
		$this->db->where('status',$status);
        $query = $this->db->get();        
        return $query->result();             
    }
	function getInfoAppointment($id_lichkham){
		$this->db->from('lich_kham');
		$this->db->where('id_lichkham',$id_lichkham);
		$query = $this->db->get();
		return $query->result();
	}
	function acceptAppointment($id_lichkham){
		$data = array(
					'status' => true
				);
		$this->db->where('id_lichkham',$id_lichkham);
		$this->db->update('lich_kham',$data);
	}
	function deleteAppointment($id_lichkham){
		$data = array(
					'status' => 0
				);
		$this->db->where('id_lichkham',$id_lichkham);
		$this->db->update('lich_kham',$data);
	}
	function insertAppointment($data){		
		$this->db->insert('lich_kham',$data);
	}
	function checkAppointment($id_lichkham){
		$this->db->from('lich_kham');
		$this->db->where('id_lichkham',$id_lichkham);
		$query = $this->db->get();
		if($query->num_rows() != 0){
			return true;
		}else{
			return false;
		}
	}
    //Medical Profile menu
	//get all email have detail of clinic
	function getallemailinlichkham($id_phongkham){
		$this->db->select('email');
		$this->db->distinct();
		$this->db->from('lich_kham');
		$this->db->where('id_phongkham',$id_phongkham);
		$query = $this->db->get();
		return $query->result();
	}
	//get infomation of user had detail medical
	function getInfoUser($id_phongkham){
		$email_arr = $this->getallemailinlichkham($id_phongkham);
		$result = array();
		foreach($email_arr as $row){
			$this->db->from('user_customer');
			$this->db->where('email',$row->email);
			$query = $this->db->get();
			$temp = $query->result();
			array_push($result,$temp[0]);
		}
		return $result;
	}
	//get profile of one email
    function getprofile($email,$id_phongkham){
        $this->db->from('chi_tiet_kham');
        $this->db->where('email',$email);
		$this->db->where('id_phongkham',$id_phongkham);
        $query = $this->db->get();
		$listcchitietkham = $query->result();
		$result = array();
		foreach($listcchitietkham as $row){
			//get thoi gian kham cua moi chi tiet kham
			$this->db->select('li_do_kham,ngay_kham,thoigian_batdau,thoigian_ketthuc');
			$this->db->from('lich_kham');
			$this->db->where('id_lichkham',$row->id_lichkham);
			$query = $this->db->get();
			$lichkham = $query->result();
			$row->li_do_kham = $lichkham[0]->li_do_kham;
			$row->ngay_kham = $lichkham[0]->ngay_kham;
			$row->thoigian_batdau = $lichkham[0]->thoigian_batdau;
			$row->thoigian_ketthuc = $lichkham[0]->thoigian_ketthuc;
			
			array_push($result,$row);
		}
        return $result;             
    }
	function getallIdLichkham($id_phongkham,$email){
		$this->db->from('lich_kham');
		$this->db->where('id_phongkham',$id_phongkham);
		$this->db->where('email',$email);
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->result();
	}
	function checkmedicalprofile($id_chitiet){
		$this->db->from('chi_tiet_kham');
		$this->db->where('id_chitiet',$id_chitiet);
		$query = $this->db->get();
		if($query->num_rows() != 0){
			return true;
		}else{
			return false;
		}
	}
	function updateMedicalprofile($data){
		$this->db->where('id_chitiet',$data['id_chitiet']);
		$this->db->update('chi_tiet_kham',$data);
	}
	function insertMedicalprofile($data){
		$this->db->insert('chi_tiet_kham',$data);
	}
	function deleteMedicalprofile($id_chitiet){
		$this->db->where('id_chitiet',$id_chitiet);
		$this->db->delete('chi_tiet_kham');
	}
	//Get available time
	function getAvailableTime($id_phongkham){
		$this->db->from('lich_phongkham');
		$this->db->where('id_phongkham',$id_phongkham);
		$query = $this->db->get();
		return $query->result();
	}

    function insertAvailableTime($data) {
        $this->db->insert('lich_phongkham',$data);
    }
	function deleteAvailableTime($id_phongkham,$ngay_kham,$thoigian_batdau,$thoigian_ketthuc) {
        $this->db->where('id_phongkham',$id_phongkham);
		$this->db->where('ngay_kham',$ngay_kham);
		$this->db->where('thoigian_batdau',$thoigian_batdau);
		$this->db->where('thoigian_ketthuc',$thoigian_ketthuc);
        $this->db->delete('lich_phongkham');
    }      
    
}

?>
