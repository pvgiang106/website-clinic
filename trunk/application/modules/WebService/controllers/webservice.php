<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webservice extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('mwebservice', '', TRUE);
        $this->load->helper('third_library');
    }
	
	public function GetAllPhongkham()
	{
		$result = $this->mwebservice->allphongkham();
        return $result;
        $this->load->view('webservice');
	}
    public function InsertUser()
	{
	   $data=array(
                     "email" => "shinichi1691@gmail.com",
                     "name" => "Conan",
                     "mid_name"   => "Edogawa",
                     "phone"      => "0976135377",
                     "sex" => "Male",
                     "password" => "123456",
                     "birthday" => "10/06/1991",
                     "address" => "127/10 hoang hoa tham",
                     "provice" => "Ho Chi Minh",
                     "district" => "Tan binh",
                     "register_day" => "01/04/2014",
                     "height" => "1.61",
                     "weight" => "60" 
                    );
		$result = $this->mwebservice->insertUser($data);
        $this->load->view('webservice');
	}
    public function CheckUser()
	{
		$email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $result = $this->mwebservice->checkUser($email,$password);
        return $result;
        $this->load->view('webservice');
	}
    public function GetListTime()
	{
		$id_phongkham = $_REQUEST['id_phongkham'];
        $result = $this->mwebservice->listTime($id_phongkham);
        return $result;
        $this->load->view('webservice');
	}
    public function GetListKham()
	{
	   $id_phongkham = $_REQUEST['id_phongkham'];
       $email = $_REQUEST['email'];
	   $result = $this->mwebservice->listKham($id_phongkham,$email);
       return $result;
       $this->load->view('webservice');
    }
}