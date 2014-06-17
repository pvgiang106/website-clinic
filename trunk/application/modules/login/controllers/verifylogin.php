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
        $this->load->library('form_validation');
        $this->load->helper('third_library');
    }

    /**
     * function run when controller login is active without param
     */
    function index() {
        //This method will have the credentials validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        
        $autologin = ($this->input->post('remember') == 'remember') ? 1 : 0;
        
        if ($this->form_validation->run() == FALSE) {
            //Field validation failed.  User redirected to login page     
            $data['error'] = '';
            $data['module'] = 'login';
            $data['view_file'] = 'login_view';
            echo Modules::run('login/layout/render', $data);
            //redirect('/login/index', 'refresh');
        } else {
            //echo $this->input->post('password');
            if ($this->check_database($this->input->post('password')) == TRUE) {

                if($autologin == 1){
                    $cookie_name = 'remember';
                    // time cookie will be die
                    $cookie_time = 3600*24*30;
                    //$session_data = $this->session->userdata('logged_in');
                    $session_data = $this->session->userdata('logged_in');
                    setcookie('ci-session', 'email='."", time() - 3600);	// Unset cookie of user
                    setcookie($cookie_name, 'email='.$session_data['email'].'&role='.$session_data['role'].'&id_phongkham='.$session_data['id_phongkham'].'&name='.$session_data['name'],time() + $cookie_time);
                    echo 'remember';
                    //redirect('/login/index/'.$session_data['userID'], 'refresh');
                }  else {
                    echo 'not remember ';
                    //redirect('/login/index/'.$session_data['userID'], 'refresh');
                }             
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
    function check_database($password) {
        //Field validation succeeded.  Validate against database
        $email = $this->input->post('email');

        //query the database
        $result = $this->user->login($email, $password);

        if ($result) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'email' => $row->email,
                    'role' => $row->role,
                    'id_phongkham' => $row->id_phongkham,
					'name' => $row->name
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return FALSE;
        }
    }

    /**
     * function is handle registation
     * set rule for data input
     */
    function register() {

        $this->form_validation->set_rules('firstname', 'First name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastname', 'Last name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[repassword]|xss_clean');
        $this->form_validation->set_rules('repassword', 'Re-Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('sex', 'Sex', 'trim|required|xss_clean');
        $this->form_validation->set_rules('day', '', 'trim|required|numeric');
        $this->form_validation->set_rules('month', '', 'trim|required|numeric');
        $this->form_validation->set_rules('year', '', 'trim|required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');

        $this->form_validation->set_message('numeric', 'Invalid number.');

        if ($this->form_validation->run() == FALSE) {
            $data['error'] = '';
            $data['module'] = 'login';
            $data['view_file'] = 'register_view';
            echo Modules::run('login/layout/render', $data);
        } else {
            if ($this->check_email($this->input->post('email')) == TRUE) {
                $datauser = array(
                    'username' => $this->input->post('firstname') . ' ' . $this->input->post('lastname'),
                    'password' => md5($this->input->post('password')),
                    'email' => $this->input->post('email'),
                );
                $message = 'Bạn đã đăng kí thành công tài khoản trên website Dulichbui !';
                $subject = 'Registation Success !';
                $test = $this->sendmail($this->input->post('email'), $message, $subject);
                if ($test == TRUE) {
                    $this->user->inserttouser($datauser);

                    echo $datauser['email'] . ' ' . $this->input->post('password');
                    $result = $this->user->login($datauser['email'], $this->input->post('password'));

                    //$birthday = date_create($this->input->post('year') . '-' . $this->input->post('month') . '-' . $this->input->post('day'));

                    if ($result) {
                        $sess_array = array();
                        foreach ($result as $row) {
                            $sess_array = array(
                                'userID' => $row->userID,
                                'username' => $row->username,
                                'avatar' => $row->avatar,
                                'role' => $row->role
                            );

                            $this->session->set_userdata('logged_in', $sess_array);
                            $profile = array(
                                'userID' => $row->userID,
                                'fullName' => $this->input->post('firstname') . ' ' . $this->input->post('lastname')
                            );
                            $this->user->inserttoprofile($profile);
                        }
                        redirect('/login/index', 'refresh');
                    } else {

                        //$this->form_validation->set_message('check_database', 'Invalid username or password');
                        echo 'vao day 1';
                        return false;
                    }
                } else {
                    echo 'vao day 2';
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
            $this->form_validation->set_message('check_email', 'Invalid email !!!');
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
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = '';
            $data['module'] = 'login';
            $data['view_file'] = 'resetpassword_view';
            echo Modules::run('login/layout/render', $data);
        } else {

            if ($this->check_email($this->input->post('email')) == FALSE) {
                $this->load->helper('url');
                $result = $this->user->checkemail($this->input->post('email'));
                $user = $result[0];
                $this->load->helper('string');
                $password = random_string('alnum', 6);
                $this->user->changepass($user->userID, $password);
                $message = ('You have requested the new password, Here is you new password:' . $password);
                //echo $password;
                $subject = 'Reset Password .';
                if ($this->sendmail($this->input->post('email'), $message, $subject) == TRUE) {
                                
                    $data['module'] = 'login';
                    $data['view_file'] = 'view_sendmail_success';
                    echo Modules::run('login/layout/render', $data);
                  //  redirect('/login', 'refresh');
                } else {
                    //$this->form_validation->set_message('valid_email', 'Invalid email !!!');
                    $data['message'] = 'Invalid email !!!';
                    $data['module'] = 'login';
                    $data['view_file'] = 'resetpassword_view';
                    echo Modules::run('login/layout/render', $data);
                }
            } else {
                //$this->form_validation->set_message('email', 'Invalid email !!!');
                $data['message'] = 'Invalid email !!!';
                $data['module'] = 'login';
                $data['view_file'] = 'resetpassword_view';
                echo Modules::run('login/layout/render', $data);
            }
        }
    }

}

?>