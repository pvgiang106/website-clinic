<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Waitingappointment extends MX_Controller {
    /*
     * contructor
     */

    function __construct() {
        parent::__construct();
        $this->load->model('mdclinic', '', TRUE);
        $this->load->library("pagination");
    }

    function index() {
        $this->session->set_userdata('tab', 3);
        $data['id_phongkham'] = $this->session->userdata['logged_in']['id_phongkham'];
        // get all appoitment in database
        $waitingappoitment = $this->mdclinic->getlichkham($data['id_phongkham'],0);
       
        
        $data['waitingappoitment'] = $waitingappoitment;
        $data['module'] = 'clinic';
        $data['view_file'] = 'view_waiting_appointment';
        echo Modules::run('clinic/layout/render',$data);
    }
}

?>
