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
			$infouser = $this->mdclinic->getInfoUser($row->email);
			$temp['reason'] = $row->li_do_kham; 
			$temp['text'] = $infouser[0]->mid_name.' '.$infouser[0]->name;
			$temp['email'] = $row->email;
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
			$temp['text'] = 'Số lượng khám tối đa: '.$row->so_luong_kham;
			$temp['cur_regis']= $row->current_register;
			if($first_hour > $start_time){$first_hour = $start_time;}
			if($last_hour < $end_time){$last_hour = $end_time;}
			$i++;
		 array_push($response,$temp);
		}
		$data['first_hour'] = $first_hour;
		$data['last_hour'] = $last_hour;
		$data['json_availabletime'] = json_encode($response);
		$data['availabletime'] = $availabletime;

		$data['allMedicine'] = $this->mdclinic->allMedicine();
		$data['allCustomer'] = $this->mdclinic->getInfoCustomer();
        $data['module'] = 'clinic';
        $data['view_file'] = 'view_appointment';
        echo Modules::run('clinic/layout/render',$data);
    }
	function insertData(){
		//get time
		//var_dump($_GET);
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
		$email = $_POST['ct_email'];
		$id_lichkham = $_POST['ct_id_lichkham'];
		$lidohuy = $_POST['ct_lidohuy'];
		$ngay_kham = $_POST['ct_ngaykham'];
		$thoigian = $_POST['ct_thoigian'];
		$noidung = 'Cuộc hẹn ngày : '.$ngay_kham.' lúc '.$thoigian.' bị hủy vì lí do : '.$lidohuy;
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
			$tmp_tg = explode("-",$thoigian);
			$cakham = $this->mdclinic->findcakham($this->session->userdata['logged_in']['id_phongkham'],$ngay_kham,$tmp_tg[0]);
			$this->mdclinic->updatelich_phongkham($cakham[0]->id_phongkham,$cakham[0]->ngay_kham,$cakham[0]->thoigian_batdau,$cakham[0]->thoigian_ketthuc,$cakham[0]->current_register-1);
			$this->mdclinic->deleteAppointment($id_lichkham,$lidohuy);
			$this->mdclinic->insertThongbao($email,$noidung);
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
		$start_time = date('H:i:s',$start_date_int);
		$end_time = date('H:i:s',$end_date_int);		
		$int_start_time = strtotime($start_time);
		$int_end_time = strtotime($end_time);
		$thoigiancakham = ($int_end_time - $int_start_time)/$socakham;
		$tmp = $start_date_int;
		
		$data = array();
		while($tmp<=$end_date_int){
			$ngay_kham = date('Y-m-d',$tmp);
			$tmp += 86400;
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
			}
			else{
				echo "<script> alert('Thời gian đã qua hoặc đã được cài đặt trước đó');</script>";
				redirect('/clinic?option=setuptime','refresh');
			}
		}
		redirect('/clinic?option=setuptime','refresh');
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
	function createDetail(){
		$data = array(
					"id_lichkham" => $_POST['id_lichkham'],
					"id_phongkham" => $this->session->userdata['logged_in']['id_phongkham'],
					"email" => $_POST['email'],
					"loi_khuyen" => $_POST['loi_khuyen'],
					"chuan_doan" => $_POST['chuan_doan'],
					"nhiet_do" => $_POST['nhiet_do'],
					"trieu_chung" => $_POST['trieu_chung'],
					"huyet_ap" => $_POST['huyet_ap'],
					"mach" => $_POST['mach'],
					"chi_phi" => $_POST['chi_phi']
				);
			if($this->mdclinic->checkmedicalprofilrByIdlichkham($_POST['id_lichkham'])){
				$this->mdclinic->updateMedicalprofilebyIdlichkham($_POST['id_lichkham'],$data);
			}else{
				$this->mdclinic->insertMedicalprofile($data);
			}
			$str_thuoc = $_POST['arrId_thuoc'];
			$arrId_thuoc = explode(';',$str_thuoc);
			$id_chitiet = $this->mdclinic->getIdChitiet($_POST['id_lichkham']);
			for($i=0;$i<sizeof($arrId_thuoc)-1;$i++){
				$data = array(
							"id_chitiet" => $id_chitiet[0]->id_chitiet,
							"id_thuoc" => $arrId_thuoc[$i]
						);
				$this->mdclinic->insertToathuoc($data);
			}
			redirect('/clinic?option=appointment','refresh');
	}
	function hentaikham(){
		$id_phongkham = $this->session->userdata['logged_in']['id_phongkham'];
		$ngay_kham = $_POST['tk_ngay'];
		$strtime = $_POST['tk_thoigian'];
		$lidokham = $_POST['tk_lido'];
		$email = $_POST['tk_email'];
		$id_lichkham = $_POST['tk_id_lichkham'];
		$temp = explode('-',$strtime);
		$tmp_start_time = $temp[0];
		$tmp_end_time = $temp[1];
		$lich_phongkham = $this->mdclinic->findlich_phongkham($id_phongkham,$ngay_kham,$tmp_start_time,$tmp_end_time);
		//chi thoi gian kham cua nguoi dang ki
		$current_register = $lich_phongkham[0]->current_register;
		$max_register = $lich_phongkham[0]->so_luong_kham;
		$str_startdate = $ngay_kham.' '.$tmp_start_time;
		$str_enddate = $ngay_kham.' '.$tmp_end_time;
		$int_startdate = strtotime($str_startdate);
		$int_enddate = strtotime($str_enddate);
		$time_cakham = ($int_enddate-$int_startdate)/$max_register;
		$int_start_time = $int_startdate+$time_cakham*$current_register;
		$int_end_time = $int_start_time+$time_cakham;
		$start_time = date("H:i",$int_start_time);
		$end_time = date("H:i",$int_end_time);
		//var_dump($start_time);
		$newregister = $current_register + 1;
		$this->mdclinic->updatelich_phongkham($id_phongkham,$ngay_kham,$tmp_start_time,$tmp_end_time,$newregister);
		$data = array(
					"email" => $email,
					"id_phongkham" => $id_phongkham,
					"li_do_kham" => $lidokham,
					"ngay_kham" => $ngay_kham,
					"thoigian_batdau" => $start_time,
					"thoigian_ketthuc" => $end_time,
					"tai_kham" => $id_lichkham,
					"status" => 1,
					"li_do_huy" => ''
				);
		$this->mdclinic->insertAppointment($data);;
		redirect('/clinic','refresh');
	}
	function taocuochen(){
		$id_phongkham = $this->session->userdata['logged_in']['id_phongkham'];
		$email = $_POST['tao_email'];
		$ngay_kham = $_POST['tao_ngaykham'];
		$lidokham = $_POST['tao_lido'];
		//update lich_phongkham
		$temp = explode('-',$_POST['tao_thoigian']);
		$tmp_start_time = $temp[0];
		$tmp_end_time = $temp[1];
		$lich_phongkham = $this->mdclinic->findlich_phongkham($id_phongkham,$ngay_kham,$tmp_start_time,$tmp_end_time);
		$current_register = $lich_phongkham[0]->current_register;
		$max_register = $lich_phongkham[0]->so_luong_kham;
		$str_startdate = $ngay_kham.' '.$tmp_start_time;
		$str_enddate = $ngay_kham.' '.$tmp_end_time;
		$int_startdate = strtotime($str_startdate);
		$int_enddate = strtotime($str_enddate);
		$time_cakham = ($int_enddate-$int_startdate)/$max_register;
		$i = 0;
		for($i;$i<$max_register;$i++){
		var_dump($i);
			$int_start_time = $int_startdate+$i*$time_cakham;
			$int_end_time = $int_start_time+$time_cakham;
			$start_time = date("H:i",$int_start_time);
			$end_time = date("H:i",$int_end_time);
			var_dump($start_time.' '.$end_time);
			if($this->mdclinic->checkEmptyTime($id_phongkham,$ngay_kham,$start_time,$end_time) == true){
				break;
			}
		}
		$newregister = $current_register + 1;
		$this->mdclinic->updatelich_phongkham($id_phongkham,$ngay_kham,$tmp_start_time,$tmp_end_time,$newregister);
		$data = array(
					"email" => $email,
					"id_phongkham" => $id_phongkham,
					"li_do_kham" => $lidokham,
					"ngay_kham" => $ngay_kham,
					"thoigian_batdau" => $start_time,
					"thoigian_ketthuc" => $end_time,
					"tai_kham" => '0',
					"status" => 1,
					"li_do_huy" => ''
				);
		$this->mdclinic->insertAppointment($data);;
		redirect('/clinic','refresh');
	}
	
}

?>
