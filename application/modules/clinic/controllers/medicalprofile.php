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
		//get all id_lichkham
		$data['allid_lichkham'] = $this->mdclinic->getallIdLichkham();
		//Get allemail customer
		$data['allemail'] = $this->mdclinic->getallemailinprofile($data['id_phongkham']);
		if(isset($_GET['email'])){
			$email = $_GET['email'];
		}else{
			$email = $data['allemail'][0]->email;
		}
			// get all appoitment in database
			$chitietkham = $this->mdclinic->getprofile($email,$data['id_phongkham']);
			
			$response = array();
			foreach($chitietkham as $row) {
				$temp = array();
				$temp['id'] = $row->id_chitiet;
				$temp['email'] = $row->email;
				$temp['id_phongkham'] = $row->id_phongkham;
				$temp['id_lichkham'] = $row->id_lichkham;
				$temp['reason'] = $row->li_do_kham;
				$temp['trieu_chung'] = $row->trieu_chung;
				$temp['nhiet_do'] = $row->nhiet_do;
				$temp['huyet_ap'] = $row->huyet_ap; 
				$temp['mach'] = $row->mach;
				$temp['text'] = $row->chuan_doan;
				$temp['loi_khuyen'] = $row->loi_khuyen;
				$temp['start_date'] = $row->thoigian_batdau;
				$temp['end_date'] = $row->thoigian_ketthuc;								
				$temp['chi_phi'] = $row->chi_phi;
				
			 array_push($response,$temp);
			}
		    $data['jsoncode'] = json_encode($response);		
			$data['chitietkham'] = $chitietkham;
			
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
		if($this->mdclinic->checkmedicalprofile($_GET['id_chitiet']) == false){
			$this->mdclinic->updateMedicalprofile($data);
			redirect('/clinic/medicalprofile?email='.$_GET['email'],'refresh');
		}else{
			$data['id_chitiet'] = '';
			$this->mdclinic->insertMedicalprofile($data);
			redirect('/clinic/medicalprofile?email='.$_GET['email'],'refresh');
		}
	}
	function deleteData(){
		$id_chitiet = $_GET['id_chitiet'];
		$this->mdclinic->deleteMedicalprofile($id_chitiet);
		redirect('/clinic/medicalprofile?email='.$_GET['email'],'refresh');
	}
	
}

?>
