<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificate extends CI_Controller {
    private $sess = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('backend/master_lib');
        $this->load->library('backend/certificate_lib');
        $this->load->library('backend/role_lib');
        $this->load->library('backend/training_lib');

        $this->load->library('upload');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->sess = $this->session->all_userdata();
        if(!array_key_exists('logged_in', $this->sess) || !$this->sess['logged_in']){
            if(!$this->certificate_lib->cookieLogin()){
                redirect('backend/login');
            }
        }
    }

    public function index(){
        if($this->sess['froleid'] != 1){ // Not superadmin
            redirect('backend');
        }
        $data = array(
            'title' => 'Certificate List | Myproject',
            'name' => 'Certificate List',
            'slug' => array('certificate'),
            'view' => 'backend/certificate/index',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Certificate List' => null
            ),
            'data' => array()
        );
        $data['menu'] = $this->master_lib->side_menu($data['slug']);

        $this->load->view('backend/layouts/master', $data);
    }

    public function view($fcertificateid=null){
        if($this->sess['froleid'] != 1 && $this->sess['fcertificateid'] != $fcertificateid){ // Not admin trying to access another certificate
            redirect('backend');
        }

        if(!isset($fcertificateid) || empty($fcertificateid) || $fcertificateid==null){
            redirect('backend/certificate');
        }

        $certificate = $this->certificate_lib->get($fcertificateid);
        $selected_train = $certificate->ftrainplanid;
        if(!$certificate){
            redirect('backend/certificate');
        }

        $data = array(
            'title' => $certificate->fcertificatenumber . ' | Certificate Details | Myproject',
            'name' => 'Certificate Details',
            'slug' => array('certificate'),
            'view' => 'backend/certificate/details',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Certificate List' => base_url('backend/certificate'),
                $certificate->fcertificatenumber => null,
            ),
            'data' => array(
                'certificate' => $certificate,
                'training' => $this->training_lib->getfinishtraining(),
                'membertra' => $this->training_lib->getfinishmember($selected_train),
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
            'title' => 'Create Certificate | Myproject',
            'name' => 'Create Certificate',
            'slug' => array('certificate'),
            'view' => 'backend/certificate/create',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Certificates List' => base_url('backend/certificate'),
                'Create' => null
            ),
            'data' => array(
                'training' => $this->training_lib->getfinishtraining()
            )
        );
        $data['menu'] = $this->master_lib->side_menu($data['slug']);

        $this->load->view('backend/layouts/master', $data);
    }

    public function update($fcertificateid = null){
        if($this->sess['froleid'] != 1){ // user
            redirect('backend');
        }

        if(!isset($fcertificateid) || empty($fcertificateid) || $fcertificateid==null){
            redirect('backend/certificate');
        }

        $certificate = $this->certificate_lib->get($fcertificateid);
        $selected_train = $certificate->ftrainplanid;
        if(!$certificate){
            redirect('backend/certificate');
        }

        $data = array(
            'title' => $certificate->fcertificatenumber . ' | Update Certificate | Myproject',
            'name' => 'Update Certificate',
            'slug' => array('certificate'),
            'view' => 'backend/certificate/update',
            'breadcrumb' => array(
                'Home' => base_url('backend'),
                'Certificate Lists' => base_url('backend/certificate'),
                'Details for ' . $certificate->fcertificatenumber => base_url('backend/certificate/view/'.$certificate->fcertificateid),
                'Update for ' . $certificate->fcertificatenumber => null
            ),
            'data' => array(
                'certificate' => $certificate,
                'training' => $this->training_lib->getfinishtraining(),
                'membertra' => $this->training_lib->getfinishmember($selected_train),
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
            array('field' => 'fcertificatenumber', 'label' => 'Certificate Number', 'rules' => 'required')
        ));
        if(!$this->form_validation->run()){

            $this->session->set_flashdata('validated', 'error');
            $this->session->set_flashdata('validation_errors', validation_errors());

            $this->create();
            $this->session->set_flashdata('validated', null);

        }else{
           
            if(!$this->certificate_lib->create()){
                $this->session->set_flashdata('validated', 'error');
                $this->session->set_flashdata('validation_errors', validation_errors());
                // exit();
                $this->create();
                $this->session->set_flashdata('validated', null);
                
            }
            else{
                $this->session->set_flashdata('validated', 'success');
                redirect('backend/certificate/create');
            }
        }
    }

    public function doUpdate(){
        if($this->sess['froleid'] != 1){ // certificate
            redirect('backend');
        }

        $this->formValidation(array(
            array('field' => 'fcertificatenumber', 'label' => 'Certificate Number', 'rules' => 'required')
        ));
        if(!$this->form_validation->run()){
            $this->session->set_flashdata('validated', 'error');
            $this->session->set_flashdata('validation_errors', validation_errors());
        }else{
            if(!$this->certificate_lib->update()){

                $this->session->set_flashdata('validated', 'error');
                $this->session->set_flashdata('validation_errors', validation_errors());
            }
            else{
                $this->session->set_flashdata('validated', 'success');
            }
        }

        redirect('backend/certificate/update/'.$this->input->post('fcertificateid'));
    }

    public function delete($fcertificateid=null){
        if($this->sess['froleid'] != 1 && $this->sess['fcertificateid'] != $fcertificateid){ // Not admin trying to access another certificate
            redirect('backend');
        }

        if(!isset($fcertificateid) || empty($fcertificateid) || $fcertificateid==null){
            $res = array(
                'status' => 0,
                'message' => 'Certificate ID can\'t be empty'
            );
        }
        else{
            if($this->certificate_lib->delete($fcertificateid)){
                $res = array(
                    'status' => 1,
                    'message' => 'Success deleting certificate'
                );
            }
            else{
                $res = array(
                    'status' => 0,
                    'message' => 'Failed deleting certificate. Internal Server Error. Please contact your system administrator.'
                );
            }
        }
        echo json_encode($res);
    }

    public function get($fcertificateid){
        echo json_encode($this->certificate_lib->get($fcertificateid));
    }

    public function getAll($froleid = null){
        echo json_encode($this->certificate_lib->getAll($froleid));
    }

    public function formValidation($custom_rules = array()){

        $config = array(
            array('field' => 'fcertificatenumber', 'label' => 'Certificate Number', 'rules' => 'required'),
            array('field' => 'fcertificatestatus', 'label' => 'Status', 'rules' => 'required|in_list[1,0]', 'errors' =>
                array('in_list'=>'Please select only available %s')),
        );

        if(count($custom_rules) > 0){
            foreach($custom_rules as $custom_rule){
                array_push($config, $custom_rule);
            }
        }

        $this->form_validation->set_rules($config);
    }

    function mypdf(){

        $data = array(
            "dataku" => array(
                "nama" => "Petani Kode",
                "url" => "http://petanikode.com"
            )
        );

        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "laporan-petanikode.pdf";
        $this->pdf->load_view('backend/layouts/pdf_output', $data);
   }
}