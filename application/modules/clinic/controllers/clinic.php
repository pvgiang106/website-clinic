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

		/*-- Task appointment --*/
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
		//get and send available time. It use two task : appointment and setuptime
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
		/*-- End task appoinment --*/
		
		/*-- Task setuptime */
      		
		/*-- End task setuptime --*/
		
		/*-- Task confirm appointment --*/
		$waitingappoitment = $this->mdclinic->getlichkham($data['id_phongkham'],0);
		$response = array();
		foreach($waitingappoitment as $row) {
			$temp = array();
			$temp['id'] = $row->id_lichkham;
			$ngay_kham = $row->ngay_kham;
			$start_time = $row->thoigian_batdau;
			$end_time= $row->thoigian_ketthuc;
			$temp['start_date'] = $ngay_kham.' '.$start_time;
			$temp['end_date'] = $ngay_kham.' '.$end_time;			
			$temp['reason'] = $row->li_do_kham; 
			$temp['text'] = $row->email;
		 array_push($response,$temp);
		}
	    $data['json_wait_appointment'] = json_encode($response);        
        $data['waitingappoitment'] = $waitingappoitment;
		/*-- End task confirm appoinment --*/
		
        $data['module'] = 'clinic';
        $data['view_file'] = 'view_appointment';
        echo Modules::run('clinic/layout/render',$data);
    }
	function insertData(){
		//get time
		$day_start_string = substr( $_GET['start_date'], 4, 17 );
		$day_end_string = substr( $_GET['end_date'], 4, 17 );

		$start_date_int = strtotime($day_start_string);
		$end_date_int = strtotime($day_end_string);
		
		$start_time = date('H:i',$start_date_int);
		$end_time = date('H:i',$end_date_int);
		$ngay_kham = date("Y-m-d",$start_date_int);

		//end get time
		$email = $_GET['email'];
		$id_phongkham = $this->session->userdata['logged_in']['id_phongkham'];
		$id_lichkham = $_GET['id_lichkham'];
		$lidokham = $_GET['lidokham'];
		$data = array(
			"id_lichkham" => '',
			"email" => $email,
			"li_do_kham" => $lidokham,
			"id_phongkham" => $id_phongkham,
			"ngay_kham" => $ngay_kham,
			"thoigian_batdau" => $start_time,
			"thoigian_ketthuc" => $end_time,
			"tai_kham" => $id_lichkham,
			"status" => 1
		);
		$today = date("Y-m-d H:i:s");
		$appointment = $ngay_kham.' '.$start_time;
		if($today < $appointment){
			$this->mdclinic->insertAppointment($data);
			redirect('/clinic','refresh');
		}else {
			echo "<script>alert('Không thể tạo cuộc hẹn trong thời gian này');</script>";
			redirect('/clinic','refresh');
		}
	}
	function deleteData(){
		$id_lichkham = $_GET['id_lichkham'];
		$today = date("Y-m-d H:i:s");
		$appoitment = $this->mdclinic->getInfoAppointment($id_lichkham);
		$temp_day = $appoitment[0]->ngay_kham;
		$temp_startime = $appoitment[0]->thoigian_batdau;
		$appointment_day = $temp_day.' '.$temp_startime;
		//var_dump(strtotime($appointment_day));
		//var_dump(strtotime($today));
		if($today>$appointment_day){
			echo "<script>alert('Cuoc hen da duoc thuc hien, khong the xoa');</script>";
			redirect('/clinic','refresh');
		}else{
			$this->mdclinic->deleteAppointment($id_lichkham);
			redirect('/clinic','refresh');
		}
	}
	function insertAvailableTime(){
		
		$availabletime = $this->mdclinic->getAvailableTime($this->session->userdata['logged_in']['id_phongkham']);
		
		$day_start_string = substr( $_GET['start_date'], 4, 17 );
		$day_end_string = substr( $_GET['end_date'], 4, 17 );

		$start_date_int = strtotime($day_start_string);
		$end_date_int = strtotime($day_end_string);
		
		$socakham = $_GET['socakham'];
		$thoigiancakham = ($end_date_int - $start_date_int)/$socakham;
		
		$start_time = date('H:i:s',$start_date_int);
		$end_time = date('H:i:s',$end_date_int);
		$ngay_kham = date("Y-m-d",$start_date_int);
		
		$data = array();
		
		for($i = 0;$i<$socakham;$i++){
			$data[$i] = array(
				"id_phongkham" => $this->session->userdata['logged_in']['id_phongkham'],
				"ngay_kham" => $ngay_kham,
				"thoigian_batdau" => date('H:i',strtotime($start_time)+$i*$thoigiancakham),
				"thoigian_ketthuc" => date('H:i',strtotime($start_time)+($i+1)*$thoigiancakham),
				"so_luong_kham" => $_GET['soluongkham']
			);
		}
		$flag = true;
		foreach($availabletime as $row){
			if($ngay_kham == $row->ngay_kham){
				if($start_time < $row->thoigian_batdau && $end_time > $row->thoigian_batdau){
				
					$flag = false;
					break;
				}
				if($start_time >= $row->thoigian_batdau && $start_time < $row->thoigian_ketthuc ){
					$flag = false;
					break;
				}
			}
		}
		$today = date('Y-m-d');
		if($ngay_kham < $today){
			$flag = false;
		}
		
		if($flag == true){
			for($i=0;$i<$socakham;$i++){
				$this->mdclinic->insertAvailableTime($data[$i]);
			}
			redirect('/clinic?option=setuptime','refresh');
		}
		else{
			echo "<script> alert('Thời gian đã qua hoặc đã được cài đặt trước đó');</script>";
			redirect('/clinic?option=setuptime','refresh');
		}
		
	}
	function deleteAvailableTime(){
		$id_phongkham = $this->session->userdata['logged_in']['id_phongkham'];
		
		$day_start_string = substr( $_GET['start_date'], 4, 17 );
		$day_end_string = substr( $_GET['end_date'], 4, 17 );

		$start_date_int = strtotime($day_start_string);
		$end_date_int = strtotime($day_end_string);
		
		$start_time = date('H:i',$start_date_int);
		$end_time = date('H:i',$end_date_int);
		$ngay_kham = date("Y-m-d",$start_date_int);
		$today = date('Y-m-d');
		if($ngay_kham < $today){
			echo "<script> alert('Thời gian đã qua, không thể hủy');</script>";
			redirect('/clinic?option=setuptime','refresh');
		}else{
			$this->mdclinic->deleteAvailableTime($id_phongkham,$ngay_kham,$start_time,$end_time);
			redirect('/clinic?option=setuptime','refresh');
		}
	}
	function rejectAppointment(){
		//Reject appointment
		$id_lichkham = $_GET['id_lichkham'];
		$this->mdclinic->deleteAppointment($id_lichkham);
		
		redirect('/clinic?option=confirm','refresh');		
	}
	function acceptAppointment(){
		//Accept appointment
		$id_lichkham = $_GET['id_lichkham'];
		$this->mdclinic->acceptAppointment($id_lichkham);
		
		redirect('/clinic?option=confirm','refresh');	
	}
}

?>
