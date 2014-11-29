<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medicalprofile extends MX_Controller {
    /*
     * contructor
     */

    function __construct() {
        parent::__construct();
		if(!isset($this->session->userdata['logged_in']['email'])){
			redirect('/login', 'refresh');
		}
        $this->load->model('mdclinic', '', TRUE);
        $this->load->library("pagination");
    }

    function index() {
		$this->session->set_userdata('tab', 1);
        $data['id_phongkham'] = $this->session->userdata['logged_in']['id_phongkham'];
		
		$data['info_user'] = $this->mdclinic->getInfoAllUser($data['id_phongkham']);
		$data['module'] = 'clinic';
		$data['view_file'] = 'view_medical_user';
		echo Modules::run('clinic/layout/render',$data);
    }
	//chi tiet kham benh nhan
	function medicaluserprofile(){
		$data['id_phongkham'] = $this->session->userdata['logged_in']['id_phongkham'];
		//get all id_lichkham
		$data['all_lichkham'] = $this->mdclinic->getallIdLichkham($data['id_phongkham'],$_GET['email']);
		//get email
		$email = $_GET['email'];
		// get all appoitment in database
		$chitietkham = $this->mdclinic->getprofile($email,$data['id_phongkham']);		
		$data['detailprofile'] = $chitietkham;
		$data['allMedicine'] = $this->mdclinic->allMedicine();
		$data['module'] = 'clinic';
		$data['view_file'] = 'view_medical_profile';
		echo Modules::run('clinic/layout/render',$data);
	}
	//Update medical profile
	function insertData(){
		$data = array(
					"id_chitiet" => $_POST['id_chitiet'],
					"id_lichkham" => $_POST['id_lichkham'],
					"id_phongkham" => $this->session->userdata['logged_in']['id_phongkham'],
					"email" => $_POST['email'],
					"loi_khuyen" => $_POST['loi_khuyen'],
					"chuan_doan" => $_POST['chuan_doan'],
					"nhiet_do" => $_POST['nhiet_do'],
					"trieu_chung" => $_POST['trieu_chung'],
					"huyet_ap" => $_POST['huyet_ap'],
					"mach" => $_POST['mach'],
					"chi_phi" => $_POST['chi_phi']
				);
			
			$this->mdclinic->insertMedicalprofile($data);
			$str_thuoc = $_POST['arrId_thuoc'];
			$arrId_thuoc = explode(';',$str_thuoc);
			$id_chitiet = $this->mdclinic->getIdChitiet($_POST['id_lichkham']);
			for($i=0;$i<sizeof($arrId_thuoc)-1;$i++){
				$data = array(
							"id_chitiet" => $id_chitiet[0]->id_chitiet,
							"id_thuoc" => $arrId_thuoc[$i]
						);
				$this->mdclinic->insertToathuoc($data);
			}
			redirect('/clinic/medicalprofile/medicaluserprofile?email='.$_POST['email'].'&name='.$_POST['name']);
	}
	function updateData(){
		$data = array(
					"id_chitiet" => $_POST['edit_id_chitiet'],
					"id_lichkham" => $_POST['edit_id_lichkham'],
					"id_phongkham" => $this->session->userdata['logged_in']['id_phongkham'],
					"email" => $_POST['email'],
					"loi_khuyen" => $_POST['edit_loi_khuyen'],
					"chuan_doan" => $_POST['edit_chuan_doan'],
					"nhiet_do" => $_POST['edit_nhiet_do'],
					"trieu_chung" => $_POST['edit_trieu_chung'],
					"huyet_ap" => $_POST['edit_huyet_ap'],
					"mach" => $_POST['edit_mach'],
					"chi_phi" => $_POST['edit_chi_phi']
				);

				$this->mdclinic->updateMedicalprofile($data);
				$this->mdclinic->deleteToathuoc($_POST['edit_id_chitiet']);
				$str_thuoc = $_POST['edit_arrId_thuoc'];
				$arrId_thuoc = explode(';',$str_thuoc);
				$id_chitiet = $this->mdclinic->getIdChitiet($_POST['edit_id_lichkham']);
				for($i=0;$i<sizeof($arrId_thuoc)-1;$i++){
					$data = array(
								"id_chitiet" => $id_chitiet[0]->id_chitiet,
								"id_thuoc" => $arrId_thuoc[$i]
							);
					$this->mdclinic->insertToathuoc($data);
				}
				
			redirect('/clinic/medicalprofile/medicaluserprofile?email='.$_POST['email'].'&name='.$_POST['name']);
	}
	function deleteData(){
		$id_chitiet = $_GET['id_chitiet'];
		$this->mdclinic->deleteMedicalprofile($id_chitiet);
		redirect('/clinic/medicalprofile/medicaluserprofile?email='.$_GET['email'].'&name='.$_GET['name']);
	}
	function deleteUser(){
		$email = $_GET['email'];
		$this->mdclinic->deluser($email);
		redirect('clinic/medicalprofile','refresh');
	}
	
}

?>
