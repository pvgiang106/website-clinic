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
        $data['hotelID'] = '';
        $data['hotelName'] = '';
        $data['address'] = '';
        $data['description'] = '';
        $data['cityID'] = 31;
        $data['hotelStar'] = '';
        $data['module'] = 'admin';
        $data['view_file'] = 'view_insert_clinic';
        echo Modules::run('admin/layout/render', $data);
    }

    function verifyinsertclinic() {
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
            $data['hotelStar'] = $this->input->post('hotelStar');            
            
            $data['module'] = 'admin';
            $data['view_file'] = 'view_insert_hotel';
            echo Modules::run('admin/layout/render', $data);
        } else {      
            
            $data['hotelName'] = $this->input->post('hotelName');
            $data['address'] = $this->input->post('address');
            $data['description'] = $this->input->post('des');
            $data['hotelStar'] = $this->input->post('hotelStar');  
            
            $this->mdclinic->insertclinic($data);
            
            foreach ($this->mdclinic->gethotelID($this->input->post('hotelName')) as $tmp) {
                $hotelID = $tmp->hotelID;
            }
            if(!empty($_POST['facilities'])) {
                foreach ($_POST['facilities'] as $facilitiesrow) {                    
                    $datasubply['hotelID'] = $hotelID;
                    $datasubply['facilityID'] = $facilitiesrow;                    
                    $this->mdclinic->insertFacilitiesSubply($datasubply);
                }
            }
            
            redirect('admin/Adminclinic');
        }
    }

    function updatehotel($hotelID) {
        $result = $this->mdclinic->gethotel($hotelID);
        foreach ($result as $row) {
            $data['hotelID'] = $row->hotelID;
            $data['hotelName'] = $row->hotelName;
            $data['address'] = $row->address;
            $data['description'] = $row->description;
            $data['cityID'] = $row->cityID;
            $data['hotelStar'] = $row->hotelStar;
        }        
        $data['module'] = 'admin';
        $data['view_file'] = 'view_update_hotel';
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
