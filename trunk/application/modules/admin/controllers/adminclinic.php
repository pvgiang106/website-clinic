<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adminclinic extends MX_Controller {
    /*
     * contructor
     */

    function __construct() {
        parent::__construct();
		if(!isset($this->session->userdata['logged_in']['email'])){
			redirect('/login', 'refresh');
		}
        $this->load->model('mdpartner', '', TRUE);
        $this->load->helper('third_library');
    }

    function index() {
        $result = $this->mdpartner->listclinic();
        $this->session->set_userdata('tab', 1);
        $data['result'] = $result;
        $data['module'] = 'admin';
        $data['view_file'] = 'view_manager_clinic';
        echo Modules::run('admin/layout/render', $data);
    }

    function insertPartner) {
        $data['module'] = 'admin';
        $data['view_file'] = 'view_insert_partner';
        echo Modules::run('admin/layout/render', $data);
    }
	function verifyInsertPartner(){
		$data = array(
					"firstName" => $_POST['firstName'],
					"lastName" => $_POST['lastName'],
					"email" => $_POST['email'],
					"password" => md5($_POST['password']),
					"phone" => $_POST['phone'],
					"address" => $_POST['street'],		
					"image" => $_POST['image'],
					"birthday" => $_POST['birthday'],
					"role" => $_POST['role']
				);
		$this->mdpartner->insertPartner($data);
		redirect('admin/Adminclinic','refresh');
	}

    function updatePartner() {   
		$partnerID = $_GET['partnerID'];
		$data['info_partner'] = $this->mdpartner->getInfoPartner($partnerID);
        $data['module'] = 'admin';
        $data['view_file'] = 'view_update_partner';
        echo Modules::run('admin/layout/render', $data);
    }
    
    function verifyUpdateclinic() {
		$data = array(
					"firstName" => $_POST['firstName'],
					"lastName" => $_POST['lastName'],
					"email" => $_POST['email'],
					"password" => md5($_POST['password']),
					"phone" => $_POST['phone'],
					"address" => $_POST['street'],		
					"image" => $_POST['image'],
					"birthday" => $_POST['birthday'],
					"role" => $_POST['role']
				);
		$this->mdpartner->updatePartner($_POST['id_phongkham'],$pk_data);

        redirect('admin/Adminclinic');
    }
}

?>
