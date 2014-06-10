<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adminmedicine extends MX_Controller {
    /*
     * contructor
     */

    function __construct() {
        parent::__construct();
		if(!isset($this->session->userdata['logged_in']['email'])){
			redirect('/login', 'refresh');
		}
        $this->load->model('mdmedicine', '', TRUE);
        $this->load->library("pagination");
        $this->load->library('form_validation');
        $this->load->helper('third_library');
    }

    function index() {
        $result = $this->mdmedicine->listmedicine();
        $this->session->set_userdata('tab', 2);
        $data['result'] = $result;
        $data['module'] = 'admin';
        $data['view_file'] = 'view_manager_medicine';
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
					"toadoX" => $_POST['toadoX'],
					"toadoY" => $_POST['toadoY']
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
