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
		$data['jsoncode'] = json_encode($response);
        
        $data['availabletime'] = $availabletime;
        $data['module'] = 'clinic';
        $data['view_file'] = 'view_set_available_time';
        echo Modules::run('clinic/layout/render',$data);
    }
	function updateData(){
		
		$availabletime = $this->mdclinic->getAvailableTime($this->session->userdata['logged_in']['id_phongkham']);
		
		$day_start_string = substr( $_GET['start_date'], 4, 17 );
		$day_end_string = substr( $_GET['end_date'], 4, 17 );

		$start_date_int = strtotime($day_start_string);
		$end_date_int = strtotime($day_end_string);
		
		$start_time = date('H:i',$start_date_int);
		$end_time = date('H:i',$end_date_int);
		$ngay_kham = date("Y-m-d",$start_date_int);
		
		$data = array(
			"id_phongkham" => $this->session->userdata['logged_in']['id_phongkham'],
			"ngay_kham" => $ngay_kham,
			"thoigian_batdau" => $start_time,
			"thoigian_ketthuc" => $end_time,
			"so_luong_kham" => $_GET['so_luong_kham'],
		);
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
		$today = date('today');
		if($ngay_kham < $today){
			$flag = false;
		}
		if($flag == true){
			$this->mdclinic->insertAvailableTime($data);
			redirect('/clinic/setuptime','refresh');
		}else{
			echo "<script> alert('This time has setup before or this time is past'); </script>";
			redirect('/clinic/setuptime','refresh');
		}
		
	}
}

?>
