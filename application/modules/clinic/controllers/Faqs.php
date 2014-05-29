<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faqs extends MX_Controller {
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
        $this->session->set_userdata('tab', 2);
        $data['id_phongkham'] = $this->session->userdata['logged_in']['id_phongkham'];

        $data['module'] = 'clinic';
        $data['view_file'] = 'view_faqs';
        echo Modules::run('clinic/layout/render',$data);
    }
}

?>
