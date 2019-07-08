<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    var $title = 'Login';
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/welcome
     *	- or -
     * 		http://example.com/welcome/index
     *	- or -
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
        $this->load->library('backend/master_lib');
        $this->load->library('backend/user_lib');

        $sess = $this->session->all_userdata();
        if(!array_key_exists('logged_in', $sess) || !$sess['logged_in']){
            if(!$this->user_lib->cookieLogin()){
                redirect('backend/login');
            }
        }
    }

    public function index()
    {
        $data = array(
            'title' => 'Dashboard | Project ',
            'name' => 'Dashboard',
            'slug' => array('dashboard'),
            'view' => 'backend/index',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Dashboard' => null
            ),
            'data' => array( )
        );
        $data['menu'] = $this->master_lib->side_menu($data['slug']);

        $this->load->view('backend/layouts/master', $data);
    }
}
