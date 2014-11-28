<?php
// echo
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends MX_Controller {
    /*
     * construct the class
     */

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url'));
    }

    /*
     * login
     */
    
            
    function index() {
        //$check = $this->session->userdata('logged_in');
        if (isset($this->session->userdata['logged_in']['email'])) {
            $session_data = $this->session->userdata('logged_in');
            if($session_data['role'] == 0) {
                // redirect to partner page              
                redirect('/partner', 'refresh');
            } else if ($session_data['role'] == 1) {
                // redirect to admin page
                redirect('/admin', 'refresh');
            } else if($session_data['role'] == 2) {
                // redirect to customer page              
                redirect('/customer', 'refresh');
            }
        } else {
            $cookie_name = 'remember';
            if (isset($_COOKIE[$cookie_name])) {
                parse_str($_COOKIE[$cookie_name]);
                echo $email;
                echo $role;
                echo $userID;
				echo $firstName;
				echo $lastName
                $user_info = array(
                    'email' => $email,
                    'role' => $role,
                    'userID' => $id_phongkham ,
					'firstName' => $firstName,
					'lastName' => $lastName
                );
                $this->session->set_userdata('logged_in', $user_info);
                redirect('/login/index/', 'refresh');
            } else {
                $this->load->helper(array('form'));
                $this->load->helper('third_library');
                $data['error'] = '';
                $data['module'] = 'login';
                $data['view_file'] = 'login_view';
                echo Modules::run('login/layout/render', $data);
            }
        }
    }

    function logout() {
	
        $this->session->sess_destroy();
        $cookiename = "remember";
        setcookie($cookiename, 'userID='."".'role='."", time() - 3600);
        //delete_cookie();
        
        redirect('/login/index');
    }
    
    function resetpassword(){
        $this->load->helper(array('form'));
        $data['message'] = '';
        $data['module'] = 'login';
        $data['view_file'] = 'resetpassword_view';
        echo Modules::run('login/layout/render', $data);
    }
}

?>
