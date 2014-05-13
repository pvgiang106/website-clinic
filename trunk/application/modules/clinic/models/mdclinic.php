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
    //Medical Profile menu
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
