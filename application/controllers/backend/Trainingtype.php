<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trainingtype extends CI_Controller {
    private $sess = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('backend/master_lib');
        $this->load->library('backend/trainingtype_lib');
        $this->load->library('backend/role_lib');
        $this->load->library('upload');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->sess = $this->session->all_userdata();
        if(!array_key_exists('logged_in', $this->sess) || !$this->sess['logged_in']){
            if(!$this->trainingtype_lib->cookieLogin()){
                redirect('backend/login');
            }
        }
    }

    public function index(){
        if($this->sess['froleid'] != 1){ // Not superadmin
            redirect('backend');
        }
        $data = array(
            'title' => 'Trainingtype List | Myproject',
            'name' => 'Trainingtype List',
            'slug' => array('trainingtype'),
            'view' => 'backend/trainingtype/index',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Trainingtype List' => null
            ),
            'data' => array()
        );
        $data['menu'] = $this->master_lib->side_menu($data['slug']);

        $this->load->view('backend/layouts/master', $data);
    }

    public function view($ftraintypeid=null){
        if($this->sess['froleid'] != 1 && $this->sess['ftraintypeid'] != $ftraintypeid){ // Not admin trying to access another trainingtype
            redirect('backend');
        }

        if(!isset($ftraintypeid) || empty($ftraintypeid) || $ftraintypeid==null){
            redirect('backend/trainingtype');
        }

        $trainingtype = $this->trainingtype_lib->get($ftraintypeid);
        if(!$trainingtype){
            redirect('backend/trainingtype');
        }

        $data = array(
            'title' => $trainingtype->ftraintypename . ' | Trainingtype Details | Myproject',
            'name' => 'Trainingtype Details',
            'slug' => array('trainingtype'),
            'view' => 'backend/trainingtype/details',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Trainingtype List' => base_url('backend/trainingtype'),
                $trainingtype->ftraintypename => null,
            ),
            'data' => array(
                'trainingtype' => $trainingtype,
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
            'title' => 'Create Trainingtype | Myproject',
            'name' => 'Create Trainingtype',
            'slug' => array('trainingtype'),
            'view' => 'backend/trainingtype/create',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Trainingtypes List' => base_url('backend/trainingtype'),
                'Create' => null
            ),
            'data' => array(
            )
        );
        $data['menu'] = $this->master_lib->side_menu($data['slug']);

        $this->load->view('backend/layouts/master', $data);
    }

    public function update($ftraintypeid = null){
        if($this->sess['froleid'] != 1 && $this->sess['ftraintypeid'] != $ftraintypeid){ // Merchant trying to access another user
            redirect('backend');
        }

        if(!isset($ftraintypeid) || empty($ftraintypeid) || $ftraintypeid==null){
            redirect('backend/trainingtype');
        }

        $trainingtype = $this->trainingtype_lib->get($ftraintypeid);
        if(!$trainingtype){
            redirect('backend/trainingtype');
        }

        $data = array(
            'title' => $trainingtype->ftraintypename . ' | Update Trainingtype | Myproject',
            'name' => 'Update Trainingtype',
            'slug' => array('trainingtype'),
            'view' => 'backend/trainingtype/update',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Trainingtype Lists' => base_url('backend/trainingtype'),
                'Details for ' . $trainingtype->ftraintypename => base_url('backend/trainingtype/view/'.$trainingtype->ftraintypeid),
                'Update for ' . $trainingtype->ftraintypename => null
            ),
            'data' => array(
                'trainingtype' => $trainingtype,
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
            array('field' => 'ftraintypename', 'label' => 'Trainingtype Name', 'rules' => 'required')
        ));
        if(!$this->form_validation->run()){

            $this->session->set_flashdata('validated', 'error');
            $this->session->set_flashdata('validation_errors', validation_errors());

            $this->create();
            $this->session->set_flashdata('validated', null);

        }else{
           
            if(!$this->trainingtype_lib->create()){
                $this->session->set_flashdata('validated', 'error');
                $this->session->set_flashdata('validation_errors', validation_errors());

                $this->create();
                $this->session->set_flashdata('validated', null);
            }
            else{
                $this->session->set_flashdata('validated', 'success');
                redirect('backend/trainingtype/create');
            }
        }
    }

    public function doUpdate(){
        if($this->sess['froleid'] != 1 && $this->sess['ftraintypeid'] != $this->input->post('ftraintypeid')){ // Merchant trying to access another trainingtype
            redirect('backend');
        }

        $this->formValidation(array(
            array('field' => 'ftraintypename', 'label' => 'Trainingtype name', 'rules' => 'required')
        ));

        if(!$this->form_validation->run()){
            $this->session->set_flashdata('validated', 'error');
            $this->session->set_flashdata('validation_errors', validation_errors());
        }else{

            if(!$this->trainingtype_lib->update()){
                $this->session->set_flashdata('validated', 'error');
                $this->session->set_flashdata('validation_errors', validation_errors());
            }
            else{
                $this->session->set_flashdata('validated', 'success');
            }
        }

        redirect('backend/trainingtype/update/'.$this->input->post('ftraintypeid'));
    }

    public function delete($ftraintypeid=null){
        if($this->sess['froleid'] != 1 && $this->sess['ftraintypeid'] != $ftraintypeid){ // Not admin trying to access another trainingtype
            redirect('backend');
        }

        if(!isset($ftraintypeid) || empty($ftraintypeid) || $ftraintypeid==null){
            $res = array(
                'status' => 0,
                'message' => 'Trainingtype ID can\'t be empty'
            );
        }
        else{
            if($this->trainingtype_lib->delete($ftraintypeid)){
                $res = array(
                    'status' => 1,
                    'message' => 'Success deleting trainingtype'
                );
            }
            else{
                $res = array(
                    'status' => 0,
                    'message' => 'Failed deleting trainingtype. Internal Server Error. Please contact your system administrator.'
                );
            }
        }
        echo json_encode($res);
    }

    public function get($ftraintypeid){
        echo json_encode($this->trainingtype_lib->get($ftraintypeid));
    }

    public function getAll(){
        echo json_encode($this->trainingtype_lib->getAll());
    }

    public function formValidation($custom_rules = array()){

        $config = array(
            array('field' => 'ftraintypename', 'label' => 'Trainingtype Name', 'rules' => 'required'),
            array('field' => 'ftraintypestatus', 'label' => 'Status', 'rules' => 'required|in_list[1,0]', 'errors' =>
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