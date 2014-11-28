<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * class verify data login and register
 */
class VerifyLogin extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user', '', TRUE);
        $this->load->helper('third_library');
    }

    /**
     * function run when controller login is active without param
     */
    function index() {
        
        if (!isset($_POST['email'])) {
            //User redirected to login page     
            $data['module'] = 'login';
            $data['view_file'] = 'login_view';
            echo Modules::run('login/layout/render', $data);
        } else {
            if ($this->check_database($_POST['email'],$_POST['password']) == TRUE) {
				$cookie_name = 'remember';
				// time cookie will be die
				$cookie_time = 3600*24*30;
				//$session_data = $this->session->userdata('logged_in');
				$session_data = $this->session->userdata('logged_in');
				setcookie('ci-session', 'email='."", time() - 3600);	// Unset cookie of user
				setcookie($cookie_name, 'email='.$session_data['email'].'&role='.$session_data['role'].'&id_user='.$session_data['id_user'].'&firstName='.$session_data['firstName'].'&lastName='.$session_data['lastName'],time() + $cookie_time);
            
                redirect('/login/index', 'refresh');
            } else {
                //$this->form_validation->set_message('Invalid username or password');
                $data['error'] = 'Invalid username or password';
                $data['module'] = 'login';
                $data['view_file'] = 'login_view';
                echo Modules::run('login/layout/render', $data);
            }
        }
    }
        
    /**
     * function is check email and password is correct
     * @param type $password : password of user
     * @return boolean : return true if email and password is correct
     *                      else return false
     */
    function check_database($email, $password) {
        //query the database
        $result = $this->user->login($email, $password);

        if ($result) {
            $sess_array = array();
            foreach ($result as $row) {
				if(!isset($row->role)){
					$role = 2;
					$id_user = role->customerID;
				}else{
					$role = $row->role;
					$userID = $row->partnerID;
				}				
                $sess_array = array(
                    'email' => $row->email,
                    'role' => $role,
                    'userID' => $userID,
					'firstName' => $row->firstName,
					'lastName' => $row->lastName
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * function is handle registation
     * set rule for data input
     */
    function register() {
        if (!isset($_POST['email']) {
            $data['error'] = '';
            $data['module'] = 'login';
            $data['view_file'] = 'register_view';
            echo Modules::run('login/layout/render', $data);
        } else {
            if ($this->check_email(isset($_POST['email']) == TRUE) {
                $data_user = array(
                    'firstName' => $_POST['firstName'],
					'firstName' => $_POST['lastName'],
                    'password' => md5($_POST['password']),
                    'email' => $this->input->post('email'),
                );
                $message = 'Welcome website voder!';
                $subject = 'Registation Success !';
                $sendMail = $this->sendmail($this->input->post('email'), $message, $subject);
                if ($sendMail) {
					if($_POST['userType'] == 'customer'){
						$this->user->insert_customer($data_user);
					}else{
						$this->user->insert_partner($data_user);
					}
				//auto login after register
                    $result = $this->user->login($data_user['email'], $_POST['password']);
                    if ($result) {
                        $sess_array = array();
                        foreach ($result as $row) {
							if(!isset($row->role)){
								$role = 2;
								$userID = $row->customerID;
							}else{
								$role = $row->role;
								$userID = $row->partnerID
							}
                            $sess_array = array(
                                'userID' => $userID,
                                'firstName' => $row->firstName,
								'lastName' => $row->lastName,
                                'email' => $row->email,
                                'role' => role
                            );

                            $this->session->set_userdata('logged_in', $sess_array);
                        }
                        redirect('/login/index', 'refresh');
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                $data['error'] = 'Email Invalid or Alredy used.';
                $data['module'] = 'login';
                $data['view_file'] = 'register_view';
                echo Modules::run('login/layout/render', $data);
            }
        }
    }

    /**
     * function is check $email is exist in database or not.
     * @param type $email : email you want to check
     * @return boolean : return false if $email is exist in database
     *                   return true if $email is new email in database
     */
    function check_email($email) {
        $result = $this->user->checkemail($email);

        if ($result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * function send mail from server address to $email
     * @param type $email : email you send to
     */
    function sendmail($email, $message, $subject) {
        /**
         * config email
         * send from email anhsangtrongdem.1991@gmail.com
         */
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => '465',
            'smtp_user' => 'anhsangtrongdem.1991@gmail.com',
            'smtp_pass' => 'anhsangtrongdem'//Nhớ đánh đúng user và pass nhé
        );
        // load library email in codeIgniter
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        // create email
        $this->email->from('anhsangtrongdem.1991@gmail.com', 'Social Network');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);

        //$path = $this->config->item('server_root');
        //$file = $path . '/ciexam/attachments/yourinfo.txt';
        //$this->email->attach($file);

        if ($this->email->send()) {            
            return TRUE;
        } else {
            show_error($this->email->print_debugger());
            return FALSE;
        }
    }

    function resetpass() {
        if (!isset($_POST['email'])) {
            $data['message'] = '';
            $data['module'] = 'login';
            $data['view_file'] = 'resetpassword_view';
            echo Modules::run('login/layout/render', $data);
        } else {
            if ($this->check_email($_POST['email']) == FALSE) {
                $this->load->helper('url');
                $result = $this->user->checkemail($_POST['email']);
                $user = $result[0];
				if(!isset($user->role){
					$userType = 'customer';
					$userId = $user->customerID;
				}else{
					$userType = 'business';
					$userId = $user->businessID;
				}
                $this->load->helper('string');
                $password = random_string('alnum', 6);
                
                $message = ('You have requested the new password, Here is you new password:' . $password);
                //echo $password;
                $subject = 'Reset Password .';
				$sendMail = $this->sendmail($_POST['email'], $message, $subject);
                if ($sendMail == TRUE) {
					$this->user->changepass($userId, $password, $userType);				
                    $data['module'] = 'login';
                    $data['view_file'] = 'view_sendmail_success';
                    echo Modules::run('login/layout/render', $data);
                } else {
                    $data['message'] = 'Invalid email !!!';
                    $data['module'] = 'login';
                    $data['view_file'] = 'resetpassword_view';
                    echo Modules::run('login/layout/render', $data);
                }
            } else {
                $data['message'] = 'Invalid email !!!';
                $data['module'] = 'login';
                $data['view_file'] = 'resetpassword_view';
                echo Modules::run('login/layout/render', $data);
            }
        }
    }

}

?>