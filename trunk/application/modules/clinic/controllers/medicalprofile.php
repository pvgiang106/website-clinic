<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medicalprofile extends MX_Controller {
    /*
     * contructor
     */

    function __construct() {
        parent::__construct();
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
       
        
        $data['chitietkham'] = $chitietkham;
        $data['module'] = 'clinic';
        $data['view_file'] = 'view_medical_profile';
        echo Modules::run('clinic/layout/render',$data);
    }
}

?>
