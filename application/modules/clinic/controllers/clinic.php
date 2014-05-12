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
        $this->session->set_userdata('tab', 0);
        $data['id_phongkham'] = $this->session->userdata['logged_in']['id_phongkham'];
        // get all appoitment in database
        $lichkham = $this->mdclinic->getlichkham($data['id_phongkham']);
       
        
        $data['lichkham'] = $lichkham;
        $data['module'] = 'clinic';
        $data['view_file'] = 'view_calendar_php';
        echo Modules::run('clinic/layout/render',$data);
    }
}

?>
