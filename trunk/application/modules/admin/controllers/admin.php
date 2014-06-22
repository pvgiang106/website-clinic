<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MX_Controller {
    /*
     * contructor
     */

    function __construct() {
        parent::__construct();
		if(!isset($this->session->userdata['logged_in']['email'])){
			redirect('/login', 'refresh');
		}
        $this->load->model('mduser', '', TRUE);
        $this->load->library("pagination");
    }

    function index() {
        // get all user in database
        $result = $this->mduser->listuser();
        $this->session->set_userdata('tab', 0);
        
        $data['result'] = $result;
        $data['module'] = 'admin';
        $data['view_file'] = 'view_manager_user';
        echo Modules::run('admin/layout/render',$data);
    }
	function deluser(){
		$email = $_GET['email'];
		$this->mduser->deluser($email);
		redirect('admin','refresh');
	}
}

?>
