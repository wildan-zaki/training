<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Position extends CI_Controller {
    private $sess = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('backend/master_lib');
        $this->load->library('backend/position_lib');
        $this->load->library('backend/role_lib');
        $this->load->library('upload');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->sess = $this->session->all_userdata();
        if(!array_key_exists('logged_in', $this->sess) || !$this->sess['logged_in']){
            if(!$this->position_lib->cookieLogin()){
                redirect('backend/login');
            }
        }
    }

    public function index(){
        if($this->sess['froleid'] != 1){ // Not superadmin
            redirect('backend');
        }
        $data = array(
            'title' => 'Position List | Myproject',
            'name' => 'Position List',
            'slug' => array('position'),
            'view' => 'backend/position/index',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Positon List' => null
            ),
            'data' => array()
        );
        $data['menu'] = $this->master_lib->side_menu($data['slug']);

        $this->load->view('backend/layouts/master', $data);
    }

    public function view($fpositionid=null){
        if($this->sess['froleid'] != 1 && $this->sess['fpositionid'] != $fpositionid){ // Not admin trying to access another position
            redirect('backend');
        }

        if(!isset($fpositionid) || empty($fpositionid) || $fpositionid==null){
            redirect('backend/position');
        }

        $position = $this->position_lib->get($fpositionid);
        if(!$position){
            redirect('backend/position');
        }

        $data = array(
            'title' => $position->fpositionname . ' | Position Details | Myproject',
            'name' => 'Position Details',
            'slug' => array('position'),
            'view' => 'backend/position/details',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Position List' => base_url('backend/position'),
                $position->fpositionname => null,
            ),
            'data' => array(
                'position' => $position,
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
            'title' => 'Create Position | Myproject',
            'name' => 'Create Position',
            'slug' => array('position'),
            'view' => 'backend/position/create',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Positions List' => base_url('backend/position'),
                'Create' => null
            ),
            'data' => array(
            )
        );
        $data['menu'] = $this->master_lib->side_menu($data['slug']);

        $this->load->view('backend/layouts/master', $data);
    }

    public function update($fpositionid = null){
        if($this->sess['froleid'] != 1 && $this->sess['fpositionid'] != $fpositionid){ // Merchant trying to access another user
            redirect('backend');
        }

        if(!isset($fpositionid) || empty($fpositionid) || $fpositionid==null){
            redirect('backend/position');
        }

        $position = $this->position_lib->get($fpositionid);
        if(!$position){
            redirect('backend/position');
        }

        $data = array(
            'title' => $position->fpositionname . ' | Update Position | Myproject',
            'name' => 'Update Position',
            'slug' => array('position'),
            'view' => 'backend/position/update',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Position Lists' => base_url('backend/position'),
                'Details for ' . $position->fpositionname => base_url('backend/position/view/'.$position->fpositionid),
                'Update for ' . $position->fpositionname => null
            ),
            'data' => array(
                'position' => $position,
                'roles' => $this->role_lib->getAll()
            )
        );
        $data['menu'] = $this->master_lib->side_menu($data['slug']);

        $this->load->view('backend/layouts/master', $data);
    }

    public function doCreate(){

        if($this->sess['froleid'] != 1){ // Not superadmin
            redirect('backend');
        }
        $this->formValidation(array(
            array('field' => 'fpositionname', 'label' => 'Position Name', 'rules' => 'required')
        ));
        if(!$this->form_validation->run()){

            $this->session->set_flashdata('validated', 'error');
            $this->session->set_flashdata('validation_errors', validation_errors());

            $this->create();
            $this->session->set_flashdata('validated', null);

        }else{
           
            if(!$this->position_lib->create()){
                $this->session->set_flashdata('validated', 'error');
                $this->session->set_flashdata('validation_errors', validation_errors());

                $this->create();
                $this->session->set_flashdata('validated', null);
            }
            else{
                $this->session->set_flashdata('validated', 'success');
                redirect('backend/position/create');
            }
        }
    }

    public function doUpdate(){
        if($this->sess['froleid'] != 1 && $this->sess['fpositionid'] != $this->input->post('fpositionid')){ // Merchant trying to access another position
            redirect('backend');
        }

        $this->formValidation(array(
            array('field' => 'fpositionname', 'label' => 'Position name', 'rules' => 'required')
        ));

        if(!$this->form_validation->run()){
            $this->session->set_flashdata('validated', 'error');
            $this->session->set_flashdata('validation_errors', validation_errors());
        }else{

            if(!$this->position_lib->update()){
                $this->session->set_flashdata('validated', 'error');
                $this->session->set_flashdata('validation_errors', validation_errors());
            }
            else{
                $this->session->set_flashdata('validated', 'success');
            }
        }

        redirect('backend/position/update/'.$this->input->post('fpositionid'));
    }

    public function delete($fpositionid=null){
        if($this->sess['froleid'] != 1 && $this->sess['fpositionid'] != $fpositionid){ // Not admin trying to access another position
            redirect('backend');
        }

        if(!isset($fpositionid) || empty($fpositionid) || $fpositionid==null){
            $res = array(
                'status' => 0,
                'message' => 'Position ID can\'t be empty'
            );
        }
        else{
            if($this->position_lib->delete($fpositionid)){
                $res = array(
                    'status' => 1,
                    'message' => 'Success deleting position'
                );
            }
            else{
                $res = array(
                    'status' => 0,
                    'message' => 'Failed deleting position. Internal Server Error. Please contact your system administrator.'
                );
            }
        }
        echo json_encode($res);
    }

    public function get($fpositionid){
        echo json_encode($this->position_lib->get($fpositionid));
    }

    public function getAll($froleid = null){
        echo json_encode($this->position_lib->getAll($froleid));
    }

    public function formValidation($custom_rules = array()){

        $config = array(
            array('field' => 'fpositionname', 'label' => 'Position Name', 'rules' => 'required'),
            array('field' => 'fpositionstatus', 'label' => 'Status', 'rules' => 'required|in_list[1,0]', 'errors' =>
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