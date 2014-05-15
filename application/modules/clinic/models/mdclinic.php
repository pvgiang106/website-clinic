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
		$this->db->where('id_lichkham',$id_lichkham);
		$this->db->delete('lich_kham');
	}
	function updataAppointment($id_lichkham,$li_do_kham){
		$data = array(
			"li_do_kham" => $li_do_kham
		);
		$this->db->where('id_lichkham',$id_lichkham);
		$this->db->update('lich_kham',$data);
	}
    //Medical Profile menu
	//get all email have detail of clinic
	function getallemailinprofile($id_phongkham){
		$this->db->select('email');
		$this->db->distinct();
		$this->db->from('chi_tiet_kham');
		$this->db->where('id_phongkham',$id_phongkham);
		$query = $this->db->get();
		return $query->result();
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
			$this->db->select('li_do_kham,thoigian_batdau,thoigian_ketthuc');
			$this->db->from('lich_kham');
			$this->db->where('id_lichkham',$row->id_lichkham);
			$query = $this->db->get();
			$lichkham = $query->result();
			$row->li_do_kham = $lichkham[0]->li_do_kham;
			$row->thoigian_batdau = $lichkham[0]->thoigian_batdau;
			$row->thoigian_ketthuc = $lichkham[0]->thoigian_ketthuc;
			
			array_push($result,$row);
		}
        return $result;             
    }
	function getallIdLichkham(){
		$this->db->select('id_lichkham');
		$this->db->from('lich_kham');
		//$this->db->where('email',$email);
		$query = $this->db->get();
		return $query->result();
	}
	function checkmedicalprofile($id_chitiet){
		$this->db->from('chi_tiet_kham');
		$this->db->where('id_chitiet',$id_chitiet);
		$query = $this->db->get();
		if($query){
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
    //Setuptime menu
    function insertAvailableTime($data) {
        $this->db->insert('lich_phongkham',$data);
    }
	function updateAvailableTime($id_phongkham,$ngay_kham,$thoigian_batdau,$thoigian_ketthuc,$data) {
        $this->db->where('id_phongkham',$id_phongkham);
		$this->db->where('ngay_kham',$ngay_kham);
		$this->db->where('thoigian_batdau',$thoigian_batdau);
		$this->db->where('thoigian_ketthuc',$thoigian_ketthuc);
        $this->db->update('lich_phongkham',$data);
    }      
    
}

?>
