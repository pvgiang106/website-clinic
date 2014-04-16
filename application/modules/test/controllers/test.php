 <?php
class Test extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper("url");
    }
    public function index(){
        $temp['title']="QHOnline Layout";
        $temp['template']='test_views';
        $temp['data']['info']="Welcome to CI Layout - QHOnline.Info";
        $this->load->view("layout/layout",$temp);
    }
}
?> 