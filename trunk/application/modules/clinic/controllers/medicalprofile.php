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
			redirect('/clinic/medicalprofile/medicaluserprofile?email='.$_POST['email'].'&name='.$_POST['name'],'refresh');
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
			var_dump($data);
			$this->mdclinic->updateMedicalprofile($data);
			redirect('/clinic/medicalprofile/medicaluserprofile?email='.$_POST['email'].'&name='.$_POST['name'],'refresh');
	}
	function deleteData(){
		$id_chitiet = $_GET['id_chitiet'];
		$this->mdclinic->deleteMedicalprofile($id_chitiet);
		redirect('/clinic/medicalprofile/medicaluserprofile?email='.$_GET['email'].'&name='.$_GET['name'],'refresh');
	}
	
}

?>
