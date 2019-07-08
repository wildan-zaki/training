<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module extends CI_Controller {
    private $sess = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('backend/master_lib');
        $this->load->library('backend/module_lib');
        $this->load->library('backend/media_lib');
        $this->load->library('upload');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->sess = $this->session->all_userdata();
        if(!array_key_exists('logged_in', $this->sess) || !$this->sess['logged_in']){
            if(!$this->module_lib->cookieLogin()){
                redirect('backend/login');
            }
        }
    }

    public function index(){
        if($this->sess['froleid'] != 1){ // Not superadmin
            redirect('backend');
        }
        $data = array(
            'title' => 'Module List | Myproject',
            'name' => 'Module List',
            'slug' => array('module'),
            'view' => 'backend/module/index',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Module List' => null
            ),
            'data' => array()
        );
        $data['menu'] = $this->master_lib->side_menu($data['slug']);

        $this->load->view('backend/layouts/master', $data);
    }

    public function view($fmoduleid=null){
        if($this->sess['froleid'] != 1 && $this->sess['fmoduleid'] != $fmoduleid){ // Not admin trying to access another module
            redirect('backend');
        }

        if(!isset($fmoduleid) || empty($fmoduleid) || $fmoduleid==null){
            redirect('backend/module');
        }

        $module = $this->module_lib->get($fmoduleid);
        if(!$module){
            redirect('backend/module');
        }

        $data = array(
            'title' => $module->fmodulename . ' | Module Details | Myproject',
            'name' => 'Module Details',
            'slug' => array('module'),
            'view' => 'backend/module/details',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Module List' => base_url('backend/module'),
                $module->fmodulename => null,
            ),
            'data' => array(
                'module' => $module,
                'sess' => $this->sess
            )
        );
        $data['menu'] = $this->master_lib->side_menu($data['slug']);

        $this->load->view('backend/layouts/master', $data);
    }

    public function create(){
        if($this->sess['froleid'] != 1){ // Not superadmin
            redirect('backend');
        }

        $data = array(
            'title' => 'Create Module | Myproject',
            'name' => 'Create Module',
            'slug' => array('module'),
            'view' => 'backend/module/create',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Modules List' => base_url('backend/module'),
                'Create' => null
            ),
            'data' => array(
            )
        );
        $data['menu'] = $this->master_lib->side_menu($data['slug']);

        $this->load->view('backend/layouts/master', $data);
    }

    public function update($fmoduleid = null){
        if($this->sess['froleid'] != 1 && $this->sess['fmoduleid'] != $fmoduleid){ // Merchant trying to access another user
            redirect('backend');
        }

        if(!isset($fmoduleid) || empty($fmoduleid) || $fmoduleid==null){
            redirect('backend/module');
        }

        $module = $this->module_lib->get($fmoduleid);

        if(!$module){
            redirect('backend/module');
        }

        $data = array(
            'title' => $module->fmodulename . ' | Update Module | Myproject',
            'name' => 'Update Module',
            'slug' => array('module'),
            'view' => 'backend/module/update',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Module Lists' => base_url('backend/module'),
                'Details for ' . $module->fmodulename => base_url('backend/module/view/'.$module->fmoduleid),
                'Update for ' . $module->fmodulename => null
            ),
            'data' => array(
                'module' => $module,
            )
        );
        $data['menu'] = $this->master_lib->side_menu($data['slug']);

        $this->load->view('backend/layouts/master', $data);
    }

    public function doCreate(){

        $data = $this->input->post();

        if($this->sess['froleid'] != 1){ // Not superadmin
            redirect('backend');
        }
        $this->formValidation(array(
            array('field' => 'fmodulename', 'label' => 'Module Name', 'rules' => 'required')
        ));
        if(!$this->form_validation->run()){

            $this->session->set_flashdata('validated', 'error');
            $this->session->set_flashdata('validation_errors', validation_errors());

            $this->create();
            $this->session->set_flashdata('validated', null);

        }else{
           
            if(!$this->module_lib->create()){
                $this->session->set_flashdata('validated', 'error');
                $this->session->set_flashdata('validation_errors', validation_errors());

                $this->create();
                $this->session->set_flashdata('validated', null);
            }
            else{
                $this->session->set_flashdata('validated', 'success');
                redirect('backend/module/create');
            }
        }
    }

    public function doUpdate(){
        if($this->sess['froleid'] != 1){ // Merchant trying to access another module
            redirect('backend');
        }

        $this->formValidation(array(
            array('field' => 'fmodulename', 'label' => 'Module name', 'rules' => 'required')
        ));

        if(!$this->form_validation->run()){
            $this->session->set_flashdata('validated', 'error');
            $this->session->set_flashdata('validation_errors', validation_errors());
        }else{

            if(!$this->module_lib->update()){
                
                $this->session->set_flashdata('validated', 'error');
                $this->session->set_flashdata('validation_errors', validation_errors());
            }
            else{

                $this->session->set_flashdata('validated', 'success');
            }
        }

        redirect('backend/module/update/'.$this->input->post('fmoduleid'));
    }

    public function delete($fmoduleid=null){
        if($this->sess['froleid'] != 1 && $this->sess['fmoduleid'] != $fmoduleid){ // Not admin trying to access another module
            redirect('backend');
        }

        if(!isset($fmoduleid) || empty($fmoduleid) || $fmoduleid==null){
            $res = array(
                'status' => 0,
                'message' => 'Module ID can\'t be empty'
            );
        }
        else{
            if($this->module_lib->delete($fmoduleid)){
                $res = array(
                    'status' => 1,
                    'message' => 'Success deleting module'
                );
            }
            else{
                $res = array(
                    'status' => 0,
                    'message' => 'Failed deleting module. Internal Server Error. Please contact your system administrator.'
                );
            }
        }
        echo json_encode($res);
    }

    public function get($fmoduleid){
        echo json_encode($this->module_lib->get($fmoduleid));
    }

    public function getAll($froleid = null){
        echo json_encode($this->module_lib->getAll($froleid));
    }

    public function formValidation($custom_rules = array()){

        $config = array(
            array('field' => 'fmodulename', 'label' => 'Module Name', 'rules' => 'required'),
            array('field' => 'fmodulestatus', 'label' => 'Status', 'rules' => 'required|in_list[1,0]', 'errors' =>
                array('in_list'=>'Please select only available %s')),
        );

        if(count($custom_rules) > 0){
            foreach($custom_rules as $custom_rule){
                array_push($config, $custom_rule);
            }
        }

        $this->form_validation->set_rules($config);
    }
}