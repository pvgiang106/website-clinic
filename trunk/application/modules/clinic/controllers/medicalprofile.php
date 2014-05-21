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
		
		$data['info_user'] = $this->mdclinic->getInfoUser($data['id_phongkham']);
		$data['module'] = 'clinic';
		$data['view_file'] = 'view_medical_user';
		echo Modules::run('clinic/layout/render',$data);
    }
	//chi tiet kham benh nhan
	function medicaluserprofile(){
		$data['id_phongkham'] = $this->session->userdata['logged_in']['id_phongkham'];
		//get all id_lichkham
		$data['allid_lichkham'] = $this->mdclinic->getallIdLichkham();
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
	function updateData(){
		$data = array(
					"id_chitiet" => $_GET['id_chitiet'],
					"id_lichkham" => $_GET['id_lichkham'],
					"id_phongkham" => $this->session->userdata['logged_in']['id_phongkham'],
					"email" => $_GET['email'],
					"loi_khuyen" => $_GET['loi_khuyen'],
					"chuan_doan" => $_GET['chuan_doan'],
					"nhiet_do" => $_GET['nhiet_do'],
					"trieu_chung" => $_GET['trieu_chung'],
					"huyet_ap" => $_GET['huyet_ap'],
					"mach" => $_GET['mach'],
					"chi_phi" => $_GET['chi_phi']
				);
		if($this->mdclinic->checkmedicalprofile($_GET['id_chitiet']) == true){
			$this->mdclinic->updateMedicalprofile($data);
			redirect('/clinic/medicalprofile?email='.$_GET['email'],'refresh');
		}else{
			$data['id_chitiet'] = '';
			$this->mdclinic->insertMedicalprofile($data);
			redirect('/clinic/medicalprofile?email='.$_GET['email'],'refresh');
		}
	}
	function deleteData(){		
		if($_GET['email'] != 'undefined'){
			$id_chitiet = $_GET['id_chitiet'];
			$this->mdclinic->deleteMedicalprofile($id_chitiet);
			redirect('/clinic/medicalprofile?email='.$_GET['email'],'refresh');
		}
		else{
			redirect('/clinic/medicalprofile','refresh');
		}
	}
	
}

?>
