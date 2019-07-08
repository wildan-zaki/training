<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Certificate_lib{
    private $CI;
    var $limit = 10;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('backend/certificate/Select_certificate');
        $this->CI->load->model('backend/certificate/Insert_certificate');
        $this->CI->load->model('backend/certificate/Update_certificate');
        $this->CI->load->model('backend/certificate/Delete_certificate');
        $this->CI->load->library('backend/media_lib');
    }

    public function create(){
        $data = $this->CI->input->post();
        $return = false;
        if(!empty($_FILES['ffilecertificate']) && $_FILES['ffilecertificate']['name'] != ""){
            $pathfile = pathinfo($_FILES['ffilecertificate']['name']);
            $config['upload_path'] = 'assets/backend/media/uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';
            $config['file_name'] = 'module_'.md5(date('YmdHis')).'.' . $pathfile['extension'];
            
            $this->CI->upload->initialize($config);
            if($this->CI->upload->do_upload('ffilecertificate')){
                $dokumen = $this->CI->upload->data();
                $dok['ffilecertificate'] = array(
                    'path' => '/' . $config['upload_path'] . $dokumen['file_name'],
                    'name' => $dokumen['file_name'],
                    'type' => $_FILES['ffilecertificate']['type'],
                    'timestamp' => time()
                );
                $data['fmediaid'] = $this->CI->media_lib->create($dok['ffilecertificate']);
                if($insert_id = $this->CI->Insert_certificate->create($data)){
                    $return = true;
                }
            }else{
                // something went really wrong show error page
                $error = array('error' => $this->CI->upload->display_errors()); //associate view variable $error with upload errors
                echo "<pre>";
                print_r($error);
                echo "<pre>";
                exit();
            }
        }
        // if($insert_id = $this->CI->Insert_certificate->create($data)){
        //     return true;
        // }
        return $return;
    }

    public function update(){
        $certificate = $this->get($this->CI->input->post('fcertificateid'));
        $data = $this->CI->input->post();
        
        $return = false;
        if(!empty($_FILES['ffilecertificate']) && $_FILES['ffilecertificate']['name'] != ""){
            $pathfile = pathinfo($_FILES['ffilecertificate']['name']);
            $config['upload_path'] = 'assets/backend/media/uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';
            $config['file_name'] = 'module_'.md5(date('YmdHis')).'.' . $pathfile['extension'];
            
            $this->CI->upload->initialize($config);
            if($this->CI->upload->do_upload('ffilecertificate')){
                $dokumen = $this->CI->upload->data();
                $dok['ffilecertificate'] = array(
                    'path' => '/' . $config['upload_path'] . $dokumen['file_name'],
                    'name' => $dokumen['file_name'],
                    'type' => $_FILES['ffilecertificate']['type'],
                    'timestamp' => time()
                );
                $data['fmediaid'] = $this->CI->media_lib->create($dok['ffilecertificate']);
                if($this->CI->Update_certificate->update($data)){
                    return $this->get($this->CI->input->post('fcertificateid'));
                }
            }else{
                // something went really wrong show error page
                $error = array('error' => $this->CI->upload->display_errors()); //associate view variable $error with upload errors
                echo "<pre>";
                print_r($error);
                echo "<pre>";
                exit();
            }
        }else{
            if($this->CI->Update_certificate->update($data)){
                return $this->get($this->CI->input->post('fcertificateid'));
            }
        }
        // if($insert_id = $this->CI->Insert_certificate->create($data)){
        //     return true;
        // }
        return $return;

        
    }

    public function delete($fcertificateid){
        if($this->CI->Delete_certificate->delete($fcertificateid)){
            return true;
        }
        return false;
    }

    public function get($fcertificateid){
        $certificate = $this->CI->Select_certificate->get($fcertificateid);
        return $certificate;
    }

    public function getAll(){
        return $this->CI->Select_certificate->getAll();
    }
}