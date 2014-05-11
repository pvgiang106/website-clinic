<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MX_Controller {
    /*
     * contructor
     */

    function __construct() {
        parent::__construct();
        $this->load->model('mduser', '', TRUE);
        $this->load->library("pagination");
    }

    function index() {
        // get all user in database
        $result = $this->user->listuser();
        $this->session->set_userdata('tab', 0);
        
        $data['result'] = $result;
        $data['module'] = 'admin';
        $data['view_file'] = 'view_manager_user';
        echo Modules::run('admin/layout/render',$data);
    }
}

?>
