<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layout extends MX_Controller {

    function __construct() {
        parent::__construct();        
    }

    /**
     * function : render layout for website
     * @param type $data : data of view you want to include into layout
     */
    public function render($data) {
        // render view
        $data['tab'] = ($this->session->userdata('tab') == null) ? 0 : $this->session->userdata('tab');
        $this->load->helper('third_library');
		switch($data['view_file']){
			case 'view_medical_user':
				$this->load->view('clinic/view_medical_user',$data);
				break;
			case 'view_medical_profile':
				$this->load->view('clinic/view_medical_profile',$data);
				break;
			case 'view_faqs':
				$this->load->view('clinic/view_faqs',$data);
				break;
			default:
				$this->load->view('clinic/view_layout', $data);

		}
    }
}

?>
