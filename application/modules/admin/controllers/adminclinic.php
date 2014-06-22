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
        $this->load->model('mdclinic', '', TRUE);
        $this->load->library("pagination");
        $this->load->library('form_validation');
        $this->load->helper('third_library');
    }

    function index() {
        $result = $this->mdclinic->listclinic();
        $this->session->set_userdata('tab', 1);
        $data['result'] = $result;
        $data['module'] = 'admin';
        $data['view_file'] = 'view_manager_clinic';
        echo Modules::run('admin/layout/render', $data);
    }

    function expireclinic($id_phongkham) {
        $this->mdclinic->expireclinic($id_phongkham);
        redirect('admin/Adminclinic');
    }
	function unexpireclinic($id_phongkham) {
        $this->mdclinic->unblockclinic($id_phongkham);
        redirect('admin/Adminclinic');
    }

    function insertclinic() {
        $data['module'] = 'admin';
        $data['view_file'] = 'view_insert_clinic';
        echo Modules::run('admin/layout/render', $data);
    }
	function verifyInsertclinic(){
		$pk_data = array(
					"name" => $_POST['name'],
					"phone" => $_POST['phone'],
					"address" => $_POST['street'],
					"district" => $_POST['district'],
					"provice" => $_POST['provice'],
					"feature" => $_POST['feature'],
					"website" => $_POST['website'],
					"register_day" => $_POST['register_day'],
					"expire_day" => $_POST['expire_day'],
					"toadoX" => $_POST['toadoX'],
					"toadoY" => $_POST['toadoY']
				);
		$this->mdclinic->insertclinic($pk_data);
		$new_id = $this->mdclinic->getClinicId($pk_data['phone']);
		$us_data = array(
						"id_phongkham" => $new_id[0]->id_phongkham,
						"email" => $_POST['email'],
						"name" => $_POST['name'],
						"password" => md5($_POST['password']),
						"role" => 0
					);	
		$this->mdclinic->insertUserClinic($us_data);
		redirect('admin/Adminclinic','refresh');
	}

    function updateClinic() {   
		$id_phongkham = $_GET['id_phongkham'];
		$data['info_phongkham'] = $this->mdclinic->getInfoClinic($id_phongkham);
		$data['info_user_phongkham'] = $this->mdclinic->getInfoUserClinic($id_phongkham);
        $data['module'] = 'admin';
        $data['view_file'] = 'view_update_clinic';
        echo Modules::run('admin/layout/render', $data);
    }
    
    function verifyUpdateclinic() {
		$pk_data = array(
					"name" => $_POST['name'],
					"phone" => $_POST['phone'],
					"address" => $_POST['street'],
					"district" => $_POST['district'],
					"provice" => $_POST['provice'],
					"feature" => $_POST['feature'],
					"website" => $_POST['website'],
					"expire_day" => $_POST['expire_day'],
					"toadoX" => (float)$_POST['toadoX'],
					"toadoY" => (float)$_POST['toadoY']
				);
		$this->mdclinic->updateClinic($_POST['id_phongkham'],$pk_data);
		$us_data = array(
						"email" => $_POST['email']
					);
		$this->mdclinic->updateUserClinic($_POST['id_phongkham'],$us_data);
        redirect('admin/Adminclinic');
    }
}

?>
