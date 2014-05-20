<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clinic extends MX_Controller {
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
        $this->session->set_userdata('tab', 0);
        $data['id_phongkham'] = $this->session->userdata['logged_in']['id_phongkham'];

		
		//send json event appoitment
        $lichkham = $this->mdclinic->getlichkham($data['id_phongkham'],1);		
		
		$response = array();
		foreach($lichkham as $row) {
			$temp = array();
			$temp['id'] = $row->id_lichkham;
			$day = $row->ngay_kham;
			$start_time = $row->thoigian_batdau;
			$temp['start_date'] = $day.' '.$start_time;
			$end_time = $row->thoigian_ketthuc; 
			$temp['end_date'] = $day.' '.$end_time; 
			$temp['reason'] = $row->li_do_kham; 
			$temp['text'] = $row->email;
		 array_push($response,$temp);
		}		
	    $data['json_appointment'] = json_encode($response);
		$data['lichkham'] = $lichkham;
		//end appointment
		//get and send available time
        $availabletime = $this->mdclinic->getAvailableTime($data['id_phongkham']);
		$response = array();
		$i = 0;
		foreach($availabletime as $row) {
			$temp = array();
			$temp['id'] = $i;			
			$day = $row->ngay_kham;
			$start_time = $row->thoigian_batdau;
			$end_time = $row->thoigian_ketthuc;
			$temp['start_date'] = $day.' '.$start_time;
			$temp['end_date'] = $day.' '.$end_time;
			$temp['text'] = $row->so_luong_kham;
			$i++;
		 array_push($response,$temp);
		}
		$data['json_availabletime'] = json_encode($response);
		$data['availabletime'] = $availabletime;
        //end available tiem
        $data['module'] = 'clinic';
        $data['view_file'] = 'view_appointment';
        echo Modules::run('clinic/layout/render',$data);
    }
	function updateData(){
		$this->mdclinic->updataAppointment($_GET['id_lichkham'],$_GET['lidokham']);
		redirect('/clinic','refresh');
	}
	function deleteData(){
		$id_lichkham = $_GET['id_lichkham'];
		$today = date("Y-m-d");
		$appoitment = $this->mdclinic->getInfoAppointment($id_lichkham);
		$appointment_day = $appoitment[0]->ngay_kham;
		if(strtotime($today)>strtotime($appointment_day)){
			echo "<script>alert('Cuoc hen da duoc thuc hien, khong the xoa');</script>";
			redirect('/clinic','refresh');
		}else{
			$this->mdclinic->deleteAppointment($id_lichkham);
			redirect('/clinic','refresh');
		}
	}
}

?>
