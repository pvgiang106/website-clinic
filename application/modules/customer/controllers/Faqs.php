<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faqs extends MX_Controller {
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
		$data['datraloi'] = $this->mdclinic->getFaqs($data['id_phongkham'],1);
		$data['chuatraloi'] = $this->mdclinic->getFaqs($data['id_phongkham'],0);
        $data['module'] = 'clinic';
        $data['view_file'] = 'view_faqs';
        echo Modules::run('clinic/layout/render',$data);
    }
	function updateFaq(){
		$email = $_POST['email'];
		$id_phongkham = $data['id_phongkham'] = $this->session->userdata['logged_in']['id_phongkham'];
		$question = $_POST['question'];
		$answer = $_POST['answer'];
		$id_faq = $_POST['id_faq'];
		$tieu_de = $_POST['tieu_de'];
		$data = array(
					"answer" => $answer
				);
		$this->mdclinic->updateFaq($id_faq,$data);
		$noidung = 'Câu hỏi chủ đề : '.$tieu_de.' đã có câu trả lời';
		$this->mdclinic->insertThongbao($email,$noidung);
		redirect('/clinic/faqs?option=chuatraloi','refresh');
	}
}

?>
