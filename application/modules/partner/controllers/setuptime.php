<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setuptime extends MX_Controller {
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
        // get all appoitment in database
        $availabletime = $this->mdclinic->getAvailableTime($data['id_phongkham']);
		
		$response = array();
		$first_hour = 24;// chia lich
		$last_hour = 0;
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
		$data['json_timeavailable'] = json_encode($response);
        
        $data['availabletime'] = $availabletime;
        $data['module'] = 'clinic';
        $data['view_file'] = 'view_set_available_time';
        echo Modules::run('clinic/layout/render',$data);
    }
	function insertData(){
		
		$availabletime = $this->mdclinic->getAvailableTime($this->session->userdata['logged_in']['id_phongkham']);
		
		$day_start_string = substr( $_GET['start_date'], 4, 17 );
		$day_end_string = substr( $_GET['end_date'], 4, 17 );

		$start_date_int = strtotime($day_start_string);
		$end_date_int = strtotime($day_end_string);
		
		$socakham = $_GET['socakham'];
		$thoigiancakham = ($end_date_int - $start_date_int)/$socakham;
		
		$start_time = date('H:i',$start_date_int);
		$end_time = date('H:i',$end_date_int);
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
				if($start_time < $row->thoigian_batdau){
					if($end_time >  $row->thoigian_batdau){
						$flag = false;
						break;
					}
				}
				if($start_time >= $row->thoigian_batdau&& $start_time < $row->thoigian_ketthuc ){
					$flag = false;
					break;
				}
			}
		}
		$today = date('Y-m-d');
		var_dump($ngay_kham);
		if($ngay_kham < $today){
			$flag = false;
		}
		
		if($flag == true){
			for($i=0;$i<$socakham;$i++){
				$this->mdclinic->insertAvailableTime($data[$i]);
			}
			redirect('/clinic/setuptime','refresh');
		}
		else{
			echo "<script> alert('Thời gian đã qua hoặc đã được cài đặt trước đó');</script>";
			redirect('/clinic/setuptime','refresh');
		}
		
	}
	function deleteData(){
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
			redirect('/clinic/setuptime','refresh');
		}else{
			$this->mdclinic->deleteAvailableTime($id_phongkham,$ngay_kham,$start_time,$end_time);
			redirect('/clinic/setuptime','refresh');
		}
	}
}

?>
