<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MX_Controller {
    /*
     * contructor
     */

    function __construct() {
        parent::__construct();
		if(!isset($this->session->userdata['logged_in']['email'])){
			redirect('/login', 'refresh');
		}
        $this->load->model('mdcustomer', '', TRUE);
        $this->load->model('mdpartner', '', TRUE);
        $this->load->library("pagination");
    }

    function index() {
        // get all user in database
        $data['user'] = $this->session->userdata['logged_in'];
        if(isset($_GET['tab_active'])){
            $data['tab_active'] = $_GET['tab_active'];
        }else{
            $data['tab_active'] = 0;
        }
        $data['customer'] = $this->mdcustomer->listCustomer();
        $data['partner'] = $this->mdpartner->listPartner();
        $data['module'] = 'admin';
        $data['view_partner'] = 'view_manager_partner';
        $data['view_customer'] = 'view_manager_customer';
        echo Modules::run('admin/layout/render',$data);
    }
//==================================Customer=================================>
    function customer($customerID){
        $data['user'] = $this->session->userdata['logged_in'];
        $data['customer'] = $this->mdcustomer->getInfoCustomer($customerID)[0];
        $cardInfo = $this->mdcustomer->getInfoCustomerCard($customerID);
        if(sizeof($cardInfo) == 0){
            $data['cardInfo'] = null;
        }else{
            $data['cardInfo'] = $cardInfo[0];
        }
        $listTransaction = $this->mdcustomer->getListTransactionCustomer($customerID);
        for($i = 0; $i<sizeof($listTransaction);$i++){
            $transationID = $listTransaction[$i]->transactionID;
            $listItem = $this->mdcustomer->getTransactionDetail($transationID);
            $listTransaction[$i]->description = $listItem;
        }
        if(sizeof($listTransaction) == 0){
            $data['listTransaction'] = null;
        }else{
            $data['listTransaction'] = $listTransaction;
        }
        $data['partner'] = $this->mdpartner->listPartner();         
        $data['module'] = 'admin';
        $data['tab_active'] = 1;
        $data['view_partner'] = 'view_manager_partner';
        $data['view_customer'] = 'view_detail_customer';
        echo Modules::run('admin/layout/render',$data);
    }
    
    function addcustomer(){
        $data['user'] = $this->session->userdata['logged_in'];
        $data['partner'] = $this->mdpartner->listPartner();
        $data['module'] = 'admin';
        $data['tab_active'] = 1;
        $data['view_partner'] = 'view_manager_partner';
        $data['view_customer'] = 'view_add_customer';
        echo Modules::run('admin/layout/render',$data);
    }
    function editcustomer($customerID){
        $data['user'] = $this->session->userdata['logged_in'];
        $data['partner'] = $this->mdpartner->listPartner();
        $data['module'] = 'admin';
        $data['customerInfo'] = $this->mdcustomer->getInfoCustomer($customerID)[0];
        $cardInfo = $this->mdcustomer->getInfoCustomerCard($customerID);
        if(sizeof($cardInfo) == 0){
            $data['cardInfo'] = false;
        }else{
            $data['cardInfo'] = $cardInfo[0];
        }
        $data['tab_active'] = 1;
        $data['view_partner'] = 'view_manager_partner';
        $data['view_customer'] = 'view_edit_customer';
        echo Modules::run('admin/layout/render',$data);
    }
//<===================================Partner==============================>
    function partner(){
        $data['user'] = $this->session->userdata['logged_in'];
        $data['partner'] = $this->mdpartner->listPartner();
        $data['customer'] = $this->mdcustomer->listCustomer();
        $data['module'] = 'admin';
        $data['tab_active'] = 0;
        $data['view_partner'] = 'view_detail_menu';
        $data['view_customer'] = 'view_manager_customer';
        echo Modules::run('admin/layout/render',$data);
    }
    function addpartner(){
        $data['user'] = $this->session->userdata['logged_in'];
        $data['customer'] = $this->mdcustomer->listCustomer();
        $data['module'] = 'admin';
        $data['tab_active'] = 0;
        $data['view_partner'] = 'view_add_partner';
        $data['view_customer'] = 'view_manager_customer';
        echo Modules::run('admin/layout/render',$data);
    }
}

?>
