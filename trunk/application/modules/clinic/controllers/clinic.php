<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clinic extends MX_Controller {
    /*
     * contructor
     */

    function __construct() {
        parent::__construct();
        $this->load->model('mdclinic', '', TRUE);
        $this->load->library("pagination");
    }

    function index() {
        // get all user in database
        //$result = $this->mdclinic->listuser();
        //$this->session->set_userdata('tab', 0);
        
        //$data['result'] = $result;
        $data['module'] = 'clinic';
        $data['view_file'] = 'view_calendar_php';
        echo Modules::run('admin/layout/render',$data);
    }
}

?>
