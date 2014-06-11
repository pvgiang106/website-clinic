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
    
    function verifyInsertMedicine() {
		$add_data = array(
					"ten_thuoc" => $_POST['tao_tenthuoc'],
					"don_vi_dung" => $_POST['tao_don_vi_dung']
				);
		if(isset($_POST['tao_sang'])){ $add_data['sang'] = 1;}
		if(isset($_POST['tao_trua'])){ $add_data['trua'] = 1;}
		if(isset($_POST['tao_toi'])){ $add_data['toi'] = 1;}
		var_dump($add_data);
		$this->mdmedicine->insertMedicine($add_data);
		redirect('admin/adminmedicine','refresh');
    }
	function verifyUpdateMedicine() {
		$id_thuoc = $_POST['id_thuoc'];
		$up_data = array(
					"ten_thuoc" => $_POST['capnhat_tenthuoc'],
					"don_vi_dung" => $_POST['capnhat_don_vi_dung']
				);
		if(isset($_POST['capnhat_sang'])){ $up_data['sang'] = 1;}
		if(isset($_POST['capnhat_trua'])){ $up_data['trua'] = 1;}
		if(isset($_POST['capnhat_toi'])){ $up_data['toi'] = 1;}
	//var_dump($_POST);
		$this->mdmedicine->updateMedicine($id_thuoc,$up_data);
		redirect('admin/adminmedicine','refresh');
    }

}

?>
