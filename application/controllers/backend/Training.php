<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends CI_Controller {
    private $sess = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('backend/master_lib');
        $this->load->library('backend/training_lib');
        $this->load->library('backend/trainingtype_lib');
        $this->load->library('backend/role_lib');
        $this->load->library('backend/user_lib');
        $this->load->library('backend/position_lib');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->sess = $this->session->all_userdata();
        if(!array_key_exists('logged_in', $this->sess) || !$this->sess['logged_in']){
            if(!$this->training_lib->cookieLogin()){
                redirect('backend/login');
            }
        }
    }

    public function index(){
        if($this->sess['froleid'] != 1){ // Not superadmin
            redirect('backend');
        }
        $data = array(
            'title' => 'Training List | Myproject',
            'name' => 'Training List',
            'slug' => array('training'),
            'view' => 'backend/training/index',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Training List' => null
            ),
            'data' => array()
        );
        $data['menu'] = $this->master_lib->side_menu($data['slug']);

        $this->load->view('backend/layouts/master', $data);
    }

    public function view($ftrainplanid=null){

        if(!isset($ftrainplanid) || empty($ftrainplanid) || $ftrainplanid==null){
            redirect('backend/training');
        }

        $training = $this->training_lib->get($ftrainplanid);

        if(!$training){
            redirect('backend/training');
        }

        $data = array(
            'title' => $training->ftrainplanname . ' | Training Details | Myproject',
            'name' => 'Training Details',
            'slug' => array('training'),
            'view' => 'backend/training/details',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Training List' => base_url('backend/training'),
                $training->ftrainplanname => null,
            ),
            'data' => array(
                'training' => $training,
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

        $position = $this->position_lib->getAll();
        $where['tusers.froleid'] = 2; 
        $member = $this->user_lib->get_where($where,'*', false);

        $data = array(
            'title' => 'Create Training | Myproject',
            'name' => 'Create Training',
            'slug' => array('training'),
            'view' => 'backend/training/create',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Trainings List' => base_url('backend/training'),
                'Create' => null
            ),
            'data' => array(
                'type' => $this->trainingtype_lib->getAll(),
                'position' => $position,
                'member' => $member
            )
        );

        $data['menu'] = $this->master_lib->side_menu($data['slug']);

        $this->load->view('backend/layouts/master', $data);
    }

    public function update($ftrainplanid = null){
        if($this->sess['froleid'] != 1){ // Merchant trying to access another user
            redirect('backend');
        }

        if(!isset($ftrainplanid) || empty($ftrainplanid) || $ftrainplanid==null){
            redirect('backend/training');
        }

        $training = $this->training_lib->get($ftrainplanid);
        if(!$training){
            redirect('backend/training');
        }
        $position = $this->position_lib->getAll();
        $where['tusers.froleid'] = 2; 
        $member = $this->user_lib->get_where($where,'*', false);

        $data = array(
            'title' => $training->ftrainplanname . ' | Update Training | Myproject',
            'name' => 'Update Training',
            'slug' => array('training'),
            'view' => 'backend/training/update',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Training Lists' => base_url('backend/training'),
                'Details for ' . $training->ftrainplanname => base_url('backend/training/view/'.$training->ftrainplanid),
                'Update for ' . $training->ftrainplanname => null
            ),
            'data' => array(
                'training' => $training,
                'type' => $this->trainingtype_lib->getAll(),
                'position' => $position,
                'member' => $member
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
            array('field' => 'ftrainplanname', 'label' => 'Training Name', 'rules' => 'required')
        ));
        if(!$this->form_validation->run()){

            $this->session->set_flashdata('validated', 'error');
            $this->session->set_flashdata('validation_errors', validation_errors());

            $this->create();
            $this->session->set_flashdata('validated', null);

        }else{
           
            if(!$this->training_lib->create()){
                $this->session->set_flashdata('validated', 'error');
                $this->session->set_flashdata('validation_errors', validation_errors());

                $this->create();
                $this->session->set_flashdata('validated', null);
            }
            else{
                $this->session->set_flashdata('validated', 'success');
                redirect('backend/training/create');
            }
        }
    }

    public function doUpdate(){
        if($this->sess['froleid'] != 1){ // Merchant trying to access another training
            redirect('backend');
        }

        $this->formValidation(array(
            array('field' => 'ftrainplanname', 'label' => 'Training name', 'rules' => 'required'),
            array('field' => 'ftrainstartdate', 'label' => 'Start Date', 'rules' => 'required'),
            // array('field' => 'ftrainenddate', 'label' => 'End Date', 'rules' => 'required|callback_compareDate')
        ));

        if(!$this->form_validation->run()){
            $this->session->set_flashdata('validated', 'error');
            $this->session->set_flashdata('validation_errors', validation_errors());
        }else{

            if(!$this->training_lib->update()){
                $this->session->set_flashdata('validated', 'error');
                $this->session->set_flashdata('validation_errors', validation_errors());
            }
            else{
                $this->session->set_flashdata('validated', 'success');
            }
        }

        redirect('backend/training/update/'.$this->input->post('ftrainplanid'));
    }

    public function delete($ftrainplanid=null){
        if($this->sess['froleid'] != 1 && $this->sess['ftrainplanid'] != $ftrainplanid){ // Not admin trying to access another training
            redirect('backend');
        }

        if(!isset($ftrainplanid) || empty($ftrainplanid) || $ftrainplanid==null){
            $res = array(
                'status' => 0,
                'message' => 'Training ID can\'t be empty'
            );
        }
        else{
            if($this->training_lib->delete($ftrainplanid)){
                $res = array(
                    'status' => 1,
                    'message' => 'Success deleting training'
                );
            }
            else{
                $res = array(
                    'status' => 0,
                    'message' => 'Failed deleting training. Internal Server Error. Please contact your system administrator.'
                );
            }
        }
        echo json_encode($res);
    }

    public function getfinishmember($ftrainplanid) {
        echo json_encode($this->training_lib->getfinishmember($ftrainplanid));
    }

    public function get($ftrainplanid) {
        echo json_encode($this->training_lib->get($ftrainplanid));
    }

    public function getAll($froleid = null) {
        echo json_encode($this->training_lib->getAll($froleid));
    }

    public function formValidation($custom_rules = array()) {

        $config = array(
            array('field' => 'ftrainplanname', 'label' => 'Training Name', 'rules' => 'required'),
            array('field' => 'ftrainingstatus', 'label' => 'Status', 'rules' => 'required|in_list[1,0]', 'errors' =>
                array('in_list'=>'Please select only available %s')),
        );

        if(count($custom_rules) > 0){
            foreach($custom_rules as $custom_rule){
                array_push($config, $custom_rule);
            }
        }

        $this->form_validation->set_rules($config);
    }

    function compareDate() {
        $startDate = strtotime($_POST['ftrainstartdate']);
        $endDate = strtotime($_POST['ftrainenddate']);

        if($endDate > strtotime(date('Y-m-d'))){
            if ($endDate >= $startDate)
                return True;
            else {
                $this->form_validation->set_message('compareDate', '%s should be greater than Start Date.');
                return False;
            }  
        }else{

            $this->form_validation->set_message('compareDate', '%s should be greater than Today.');
                return False;
        }
    }

    function report(){

        $data = $this->training_lib->report();
        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "laporan-".time()."-download.pdf";
        $this->pdf->load_view('backend/layouts/pdf_output', $data);

        // $this->load->view('backend/layouts/pdf_output', $data);
   }
}