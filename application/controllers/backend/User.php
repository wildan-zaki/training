<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    private $sess = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('backend/master_lib');
        $this->load->library('backend/user_lib');
        $this->load->library('backend/role_lib');
        $this->load->library('upload');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->sess = $this->session->all_userdata();
        if(!array_key_exists('logged_in', $this->sess) || !$this->sess['logged_in']){
            if(!$this->user_lib->cookieLogin()){
                redirect('backend/login');
            }
        }
    }

    public function index(){
        if($this->sess['froleid'] != 1){ // Not superadmin
            redirect('backend');
        }
        $data = array(
            'title' => 'Users List | Myproject',
            'name' => 'Users List',
            'slug' => array('user'),
            'view' => 'backend/users/index',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Users List' => null
            ),
            'data' => array()
        );
        $data['menu'] = $this->master_lib->side_menu($data['slug']);

        $this->load->view('backend/layouts/master', $data);
    }

    public function view($fuserid=null){
        if($this->sess['froleid'] != 1 && $this->sess['fuserid'] != $fuserid){ // Not admin trying to access another user
            redirect('backend');
        }

        if(!isset($fuserid) || empty($fuserid) || $fuserid==null){
            redirect('backend/user');
        }

        $user = $this->user_lib->get($fuserid);
        if(!$user){
            redirect('backend/user');
        }

        $data = array(
            'title' => $user->fusername . ' | User Details | Myproject',
            'name' => 'User Details',
            'slug' => array('user'),
            'view' => 'backend/users/details',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Users List' => base_url('backend/user'),
                $user->fusername => null,
            ),
            'data' => array(
                'user' => $user,
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
            'title' => 'Create User | Myproject',
            'name' => 'Create User',
            'slug' => array('user'),
            'view' => 'backend/users/create',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Users List' => base_url('backend/user'),
                'Create' => null
            ),
            'data' => array(
            )
        );
        $data['menu'] = $this->master_lib->side_menu($data['slug']);

        $this->load->view('backend/layouts/master', $data);
    }

    public function update($fuserid = null){
        if($this->sess['froleid'] != 1 && $this->sess['fuserid'] != $fuserid){ // Merchant trying to access another user
            redirect('backend');
        }

        if(!isset($fuserid) || empty($fuserid) || $fuserid==null){
            redirect('backend/user');
        }

        $user = $this->user_lib->get($fuserid);
        if(!$user){
            redirect('backend/user');
        }

        $data = array(
            'title' => $user->fusername . ' | Update User | Myproject',
            'name' => 'Update User',
            'slug' => array('user'),
            'view' => 'backend/users/update',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'User Lists' => base_url('backend/user'),
                'Details for ' . $user->fusername => base_url('backend/user/view/'.$user->fuserid),
                'Update for ' . $user->fusername => null
            ),
            'data' => array(
                'user' => $user,
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
            array('field' => 'fuseremail', 'label' => 'Email', 'rules' => 'required|valid_email|is_unique[tusers.fuseremail]'),
            array('field' => 'fuserpassword', 'label' => 'Password', 'rules' => 'required|min_length[6]|max_length[12]'),
            array('field' => 'passwordconf', 'label' => 'Password Confirmation', 'rules' => 'matches[fuserpassword]')
        ));

        if(!$this->form_validation->run()){
            $this->session->set_flashdata('validated', 'error');
            $this->session->set_flashdata('validation_errors', validation_errors());

            $this->create();
            $this->session->set_flashdata('validated', null);
        }else{
            if(!$this->user_lib->create()){
                $this->session->set_flashdata('validated', 'error');
                $this->session->set_flashdata('validation_errors', validation_errors());

                $this->create();
                $this->session->set_flashdata('validated', null);
            }
            else{
                $this->session->set_flashdata('validated', 'success');
                redirect('backend/user/create');
            }
        }
    }

    public function doUpdate(){
        if($this->sess['froleid'] != 1 && $this->sess['fuserid'] != $this->input->post('fuserid')){ // Merchant trying to access another user
            redirect('backend');
        }

        if($this->input->post('fuserpassword') && $this->input->post('fuserpassword') != ''){
            $this->formValidation(array(
                array('field' => 'fuseremail', 'label' => 'Email', 'rules' => 'required|valid_email|callback_is_email_unique_except_self'),
                array('field' => 'fuserpassword', 'label' => 'Password', 'rules' => 'required|min_length[6]|max_length[12]'),
                array('field' => 'passwordconf', 'label' => 'Password Confirmation', 'rules' => 'matches[fuserpassword]')
            ));
        }
        else{
            $this->formValidation(array(
                array('field' => 'fuseremail', 'label' => 'Email', 'rules' => 'required|valid_email|callback_is_email_unique_except_self')
            ));
        }

        if(!$this->form_validation->run()){
            $this->session->set_flashdata('validated', 'error');
            $this->session->set_flashdata('validation_errors', validation_errors());
        }else{

            if(!$this->user_lib->update()){
                $this->session->set_flashdata('validated', 'error');
                $this->session->set_flashdata('validation_errors', validation_errors());
            }
            else{
                $this->session->set_flashdata('validated', 'success');
            }
        }

        redirect('backend/user/update/'.$this->input->post('fuserid'));
    }

    public function delete($fuserid=null){
        if($this->sess['froleid'] != 1 && $this->sess['fuserid'] != $fuserid){ // Not admin trying to access another user
            redirect('backend');
        }

        if($this->sess['fuserid'] == $fuserid){
            redirect('backend');
        }

        if(!isset($fuserid) || empty($fuserid) || $fuserid==null){
            $res = array(
                'status' => 0,
                'message' => 'User ID can\'t be empty'
            );
        }
        else{
            if($this->user_lib->delete($fuserid)){
                $res = array(
                    'status' => 1,
                    'message' => 'Success deleting user'
                );
            }
            else{
                $res = array(
                    'status' => 0,
                    'message' => 'Failed deleting user. Internal Server Error. Please contact your system administrator.'
                );
            }
        }
        echo json_encode($res);

    }

    public function changePwd(){
        $config = array(
            array('field' => 'fuserpassword', 'label' => 'Password', 'rules' => 'required|min_length[6]|max_length[12]'),
            array('field' => 'passwordconf', 'label' => 'Password Confirmation', 'rules' => 'matches[fuserpassword]')
        );

        $this->form_validation->set_rules($config);

        if(!$this->form_validation->run()){
            $this->session->set_flashdata('validated', 'error');
            $this->session->set_flashdata('validation_errors', validation_errors());
        }else{
            if(!$this->user_lib->changePwd()){
                $this->session->set_flashdata('validated', 'error');
                $this->session->set_flashdata('validation_errors', validation_errors());
            }
            else{
                $this->session->set_flashdata('validated', 'success');
            }
        }

        redirect($this->session->flashdata('current_url'));
    }

    public function get($fuserid){
        echo json_encode($this->user_lib->get($fuserid));
    }

    public function get_branch($fuserid){
        echo json_encode($this->user_lib->get_allbranch($fuserid));
    }

    public function getAll($froleid = null){
        echo json_encode($this->user_lib->getAll($froleid));
    }

    public function formValidation($custom_rules = array()){

        $role_ids = array();
        foreach($this->role_lib->getAll() as $role){
            array_push($role_ids, $role->froleid);
        }

        $config = array(
            array('field' => 'froleid', 'label' => 'Role', 'rules' => 'required|in_list['.implode(",",$role_ids).']'),
            array('field' => 'fusername', 'label' => 'Full Name', 'rules' => 'required'),
            array('field' => 'fuserbirthdate', 'label' => 'Date of Birth', 'rules' => 'required'),
            array('field' => 'fuserstatus', 'label' => 'Status', 'rules' => 'required|in_list[1,0]', 'errors' =>
                array('in_list'=>'Please select only available %s')),
        );

        if(count($custom_rules) > 0){
            foreach($custom_rules as $custom_rule){
                array_push($config, $custom_rule);
            }
        }

        $this->form_validation->set_rules($config);
    }

    public function is_email_unique_except_self($str){

        if($this->user_lib->isEmailUniqueExceptSelf($str)){
            return true;
        }

        $this->form_validation->set_message('is_email_unique_except_self', 'The {field} has been taken');
        return false;
    }
}