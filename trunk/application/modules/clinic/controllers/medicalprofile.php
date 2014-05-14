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
		//Get email customer
		//$email = $_REQUEST['email'];
		$email = 'demo1@email.com';
        $data['id_phongkham'] = $this->session->userdata['logged_in']['id_phongkham'];
        // get all appoitment in database
        $chitietkham = $this->mdclinic->getprofile($email,$data['id_phongkham']);
		
		$response = array();
		foreach($chitietkham as $row) {
			$temp = array();
			$temp['id'] = $row->id_chitiet;
			$temp['email'] = $row->email;
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
}

?>
