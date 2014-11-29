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
	function deleteAppointment($id_lichkham,$lidohuy){
		$data = array(
					'status' => 0,
					'li_do_huy' =>$lidohuy
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
	//find lich_phongkham
	function findlich_phongkham($id_phongkham,$ngay_kham,$thoigian_batdau,$thoigian_ketthuc){
		$this->db->from('lich_phongkham');
		$this->db->where('id_phongkham',$id_phongkham);
		$this->db->where('ngay_kham',$ngay_kham);
		$this->db->where('thoigian_batdau',$thoigian_batdau);
		$this->db->where('thoigian_ketthuc',$thoigian_ketthuc);
		$query = $this->db->get();
		return $query->result();
	}
	// update lich_phongkham
	function updatelich_phongkham($id_phongkham,$ngay_kham,$thoigian_batdau,$thoigian_ketthuc,$newregister){
		$data = array(
					"current_register" => $newregister
				);
		$this->db->where('id_phongkham',$id_phongkham);
		$this->db->where('ngay_kham',$ngay_kham);
		$this->db->where('thoigian_batdau',$thoigian_batdau);
		$this->db->where('thoigian_ketthuc',$thoigian_ketthuc);
		
		$this->db->update('lich_phongkham',$data);
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
	function getInfoAllUser($id_phongkham){
		$email_arr = $this->getallemailinlichkham($id_phongkham);
		$result = array();
		foreach($email_arr as $row){
			$this->db->from('user_customer');
			$this->db->where('email',$row->email);
			$this->db->where('status',1);
			$query = $this->db->get();
			if($query->num_rows() != 0){
				$temp = $query->result();
				array_push($result,$temp[0]);
			}
		}
		return $result;
	}
	//get info user by email
	function getInfouser($email){
		$this->db->from('user_customer');
		$this->db->where('email',$email);
		$query = $this->db->get();
		return $query->result();
	}
	function getInfoCustomer(){
		$query = $this->db->get('user_customer');
		return $query->result();
	}
	//find thoi gian thuoc ca kham nao
	function findcakham($id_phongkham,$ngay_kham,$thoigian){
		$this->db->from('lich_phongkham');
		$this->db->where('id_phongkham',$id_phongkham);
		$this->db->where('ngay_kham',$ngay_kham);
		$this->db->where('thoigian_batdau <=',$thoigian);
		$this->db->where('thoigian_ketthuc >',$thoigian);
		$query = $this->db->get();
		return $query->result();
	}
	//find id_chitiet by id_lichkham
	function getIdChitiet($id_lichkham){
		$this->db->select('id_chitiet');
		$this->db->from('chi_tiet_kham');
		$this->db->where('id_lichkham',$id_lichkham);
		$query = $this->db->get();
		return $query->result();
	}
	// insert to toa_thuoc
	function insertToathuoc($data){
		$this->db->insert('toa_thuoc',$data);
	}
	//check time available to create appointment
	function checkEmptyTime($id_phongkham,$ngay_kham,$start_time,$end_time){
		$this->db->from('lich_kham');
		$this->db->where('id_phongkham',$id_phongkham);
		$this->db->where('ngay_kham',$ngay_kham);
		$this->db->where('status',1);
		$this->db->where('thoigian_batdau',$start_time);
		$this->db->where('thoigian_ketthuc',$end_time);
		$query = $this->db->get();
		if($query->num_rows() != 0){
			return false;
		}else{
			return true;
		}
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
	function checkmedicalprofilrByIdlichkham($id_lichkham){
		$this->db->from('chi_tiet_kham');
		$this->db->where('id_lichkham',$id_lichkham);
		$query = $this->db->get();
		if($query->num_rows() != 0){
			return $query->result();
		}else{
			return false;
		}
	}
	function updateMedicalprofilebyIdlichkham($id_lichkham,$data){
		$this->db->where('id_lichkham',$id_lichkham);
		$this->db->update('chi_tiet_kham',$data);
	}
	function insertMedicalprofile($data){
		$this->db->insert('chi_tiet_kham',$data);
	}
	function deleteMedicalprofile($id_chitiet){
		$this->db->where('id_chitiet',$id_chitiet);
		$this->db->delete('chi_tiet_kham');
		$this->db->where('id_chitiet',$id_chitiet);
		$this->db->delete('toa_thuoc');
	}
	function deleteToathuoc($id_chitiet){
		$this->db->where('id_chitiet',$id_chitiet);
		$this->db->delete('toa_thuoc');
	}
	function getToathuoc($id_chitiet){
		$this->db->where('id_chitiet',$id_chitiet);
		$query = $this->db->get('toa_thuoc');
		return $query->result();
	}
	function getTenthuoc($id_thuoc){
		$this->db->where('id_thuoc',$id_thuoc);
		$query = $this->db->get('thuoc');
		return $query->result();
	}
	//Get available time
	function getAvailableTime($id_phongkham){
		$this->db->from('lich_phongkham');
		$this->db->where('id_phongkham',$id_phongkham);
		$query = $this->db->get();
		$size = $query->num_rows();
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
    
	//update data in thong_bao table
	function insertThongbao($email,$noidung){
		$data=array(
				"email" => $email,
				"noi_dung" => $noidung,
				"status" => 0
			);
		$this->db->insert('thong_bao',$data);
	}
	//faq page
	function getFaqs($id_phongkham,$status){
		if($status == 0){
			$this->db->from('faq');
			$this->db->where('id_phongkham',$id_phongkham);
			$this->db->where('answer','');
			$query = $this->db->get();
			return $query->result();
		}else{
			$this->db->from('faq');
			$this->db->where('id_phongkham',$id_phongkham);
			$this->db->where('answer !=','');
			$query = $this->db->get();
			return $query->result();
		}
	}
	function updateFaq($id_faq,$data){
		$this->db->where('id_faq',$id_faq);
		$this->db->update('faq',$data);
	}
	// medicine page
	function allMedicine(){
		$query = $this->db->get('thuoc');
		return $query->result();
	}
	function deluser($email){
		$data = array(
					'status' => 0
				);
		$this->db->where('email',$email);
		$this->db->update('user_customer',$data);
		$data['li_do_huy'] = "Tài khoản đã bị xóa";
		$this->db->where('email',$email);
		$this->db->update('lich_kham',$data);
	}
}

?>
