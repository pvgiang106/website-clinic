<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Waitingappointment extends MX_Controller {
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
        $this->session->set_userdata('tab', 3);
        $data['id_phongkham'] = $this->session->userdata['logged_in']['id_phongkham'];
        // get all appoitment in database
        $waitingappoitment = $this->mdclinic->getlichkham($data['id_phongkham'],0);
		$response = array();
		foreach($waitingappoitment as $row) {
			$temp = array();
			$temp['id'] = $row->id_lichkham;
			$temp['start_date'] = $row->thoigian_batdau;
			$temp['end_date'] = $row->thoigian_ketthuc; 
			$temp['reason'] = $row->li_do_kham; 
			$temp['text'] = $row->email;
		 array_push($response,$temp);
		}
	   $data['jsoncode'] = json_encode($response);
        
        $data['waitingappoitment'] = $waitingappoitment;
        $data['module'] = 'clinic';
        $data['view_file'] = 'view_waiting_appointment';
        echo Modules::run('clinic/layout/render',$data);
    }
	function rejectappointment(){
		//Reject appointment
		$id_lichkham = $_GET['id_lichkham'];
		$this->mdclinic->deleteAppointment($id_lichkham);
		
		redirect('/clinic/waitingappointment','refresh');		
	}
	function acceptappointment(){
		//Accept appointment
		$id_lichkham = $_GET['id_lichkham'];
		$this->mdclinic->acceptAppointment($id_lichkham);
		
		redirect('/clinic/waitingappointment','refresh');	
	}
}

?>
