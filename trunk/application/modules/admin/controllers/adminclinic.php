<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Adminclinic extends MX_Controller {
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
        $this->load->library('form_validation');
        $this->load->helper('third_library');
    }

    function index() {
        $result = $this->mdclinic->listclinic();
        $this->session->set_userdata('tab', 1);
        $data['result'] = $result;
        $data['module'] = 'admin';
        $data['view_file'] = 'view_manager_clinic';
        echo Modules::run('admin/layout/render', $data);
    }

    function expireclinic($id_phongkham) {
        $this->mdclinic->expireclinic($id_phongkham);
        redirect('admin/Adminclinic');
    }

    function insertclinic() {
        $data['module'] = 'admin';
        $data['view_file'] = 'view_insert_clinic';
        echo Modules::run('admin/layout/render', $data);
    }
	function verifyInsertclinic(){
		$pk_data = array(
					"name" => $_POST['name'],
					"phone" => $_POST['phone'],
					"address" => $_POST['street'],
					"district" => $_POST['district'],
					"provice" => $_POST['provice'],
					"feature" => $_POST['feature'],
					"website" => $_POST['website'],
					"register_day" => $_POST['register_day'],
					"expire_day" => $_POST['expire_day'],
					"toadoX" => $_POST['toadoX'],
					"toadoY" => $_POST['toadoY']
				);
		$this->mdclinic->insertclinic($pk_data);
		$new_id = $this->mdclinic->getClinicId($pk_data['phone']);
		$us_data = array(
						"id_phongkham" => $new_id[0]->id_phongkham,
						"email" => $_POST['email'],
						"name" => $_POST['name'],
						"password" => md5($_POST['password']),
						"role" => 0
					);	
		$this->mdclinic->insertUserClinic($us_data);
		redirect('admin/Adminclinic','refresh');
	}

    function updateClinic() {   
		$id_phongkham = $_GET['id_phongkham'];
		$data['info_phongkham'] = $this->mdclinic->getInfoClinic($id_phongkham);
		$data['in_user_phongkham'] = $this->mdclinic->getInfoUserClinic($id_phongkham);
        $data['module'] = 'admin';
        $data['view_file'] = 'view_update_clinic';
        echo Modules::run('admin/layout/render', $data);
    }
    
    function verifyUpdateHotel($hotelID) {
        $this->form_validation->set_rules('hotelName', 'Name', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');

        $result = $this->mdclinic->getCityID($this->input->post('city'));
        foreach ($result as $row) {
                $data['cityID'] = $row->cityID;
            }
        if ($this->form_validation->run() == FALSE) {
                        
            $data['hotelName'] = $this->input->post('hotelName');
            $data['address'] = $this->input->post('address');
            $data['description'] = $this->input->post('des');
            $data['hotelID'] = $hotelID;
            $data['hotelStar'] = $this->input->post('hotelStar');            
            
            $data['module'] = 'admin';
            $data['view_file'] = 'view_update_hotel';
            echo Modules::run('admin/layout/render', $data);
        } else {            
            
            $data['hotelName'] = $this->input->post('hotelName');
            $data['address'] = $this->input->post('address');
            $data['description'] = $this->input->post('des');
            $data['hotelStar'] = $this->input->post('hotelStar'); 
            
            $facsubply = $this->mdclinic->getHotelFacilitiesSubply($hotelID);
            foreach ($facsubply as $facsubplyrow) {
                $this->mdclinic->deleteFacilitiesSubply($hotelID, $facsubplyrow->facilityID);
            }
                    
            if(!empty($_POST['facilities'])) {
                foreach ($_POST['facilities'] as $facilitiesrow) {                    
                    $datasubply['hotelID'] = $hotelID;
                    $datasubply['facilityID'] = $facilitiesrow;                    
                    $this->mdclinic->insertFacilitiesSubply($datasubply);
                }
            }
            
            $this->mdclinic->updatehotel($hotelID,$data);
            redirect('admin/Adminclinic');
        }
    }
}

?>
