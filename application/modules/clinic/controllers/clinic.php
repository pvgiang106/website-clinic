<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
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
		
		$first_hour = 24;// chia lich
		$last_hour = 0;
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
			if($first_hour > $start_time){$first_hour = $start_time;}
			if($last_hour < $end_time){$last_hour = $end_time;}
			$i++;
		 array_push($response,$temp);
		}
		$data['first_hour'] = $first_hour;
		$data['last_hour'] = $last_hour;
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
		$today = date("Y-m-d H:i");
		var_dump($today);
		$appoitment = $this->mdclinic->getInfoAppointment($id_lichkham);
		$temp_day = $appoitment[0]->ngay_kham;
		$temp_endtime = $appoitment[0]->thoigian_ketthuc;
		$appointment_day = $temp_day.' '.$temp_endtime;
		var_dump($appointment_day);
		if($today>$appointment_day){
			echo "<script>alert('Cuoc hen da duoc thuc hien, khong the xoa');</script>";
			redirect('/clinic','refresh');
		}else{
			//$this->mdclinic->deleteAppointment($id_lichkham);
			redirect('/clinic','refresh');
		}
	}
}

?>
