<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot extends CI_Controller {
    var $title = 'Login';
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/welcome
     *  - or -
     *      http://example.com/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->library('backend/user_lib');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }
    
    public function index()
    {
        $sess = $this->session->all_userdata();
        if(array_key_exists('logged_in', $sess) && $sess['logged_in']){
            session_destroy();
            redirect('backend/dashboard');
        }
        else{
            if($this->user_lib->cookieLogin()){
               redirect('backend/dashboard');
            }
        }

        $data = array(
            'title' => 'Forgot Password | Project',
            'view' => 'backend/auths/forgot',
            'data' => array()
        );

        $this->load->view('backend/layouts/auths/master', $data);
    }

    public function goto()
    {
        $return = false;
        if($action = $this->input->get_post('action',true)){
            switch($action){
                case 'forgotpassword':
                    $return = $this->user_lib->forgotPassword();
                    break;
                default:break;  
            }
        }
        
        if($return){
            redirect('/backend/forgot/landing');  
        }
    }

    public function landing() {
        $data = array(
            'title' => 'Forgot | Project',
            'view' => 'backend/auths/landing',
            'data' => array()
        );

        $this->load->view('backend/layouts/auths/master', $data);
    }

    
    public function process(){
        $this->session->set_flashdata('validated', 'success');
        echo json_encode($this->user_lib->userForgotPass());
        redirect('/backend/forgot/landing');  
    }

    public function logout(){
        $this->user_lib->logout();
        redirect('backend/login');
    }

    public function formValidation($custom_rules = array()){

        $config = array(
            array('field' => 'fuseremail', 'label' => 'Email', 'rules' => 'required'),
            array('field' => 'fuserpassword', 'label' => 'Password', 'rules' => 'required'),
        );

        if(count($custom_rules) > 0){
            foreach($custom_rules as $custom_rule){
                array_push($config, $custom_rule);
            }
        }

        $this->form_validation->set_rules($config);
    }
}
