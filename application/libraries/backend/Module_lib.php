<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Module_lib{
    private $CI;
    var $limit = 10;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('backend/module/Select_module');
        $this->CI->load->model('backend/module/Insert_module');
        $this->CI->load->model('backend/module/Update_module');
        $this->CI->load->model('backend/module/Delete_module');
        $this->CI->load->library('backend/media_lib');
    }

    public function create(){
        
        $data = $this->CI->input->post();
        $return = false;
        if(!empty($_FILES['ffilemodule']) && $_FILES['ffilemodule']['name'] != ""){
            $pathfile = pathinfo($_FILES['ffilemodule']['name']);
            $config['upload_path'] = 'assets/backend/media/uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';
            $config['file_name'] = 'module_'.md5(date('YmdHis')).'.' . $pathfile['extension'];
            
            $this->CI->upload->initialize($config);
            if($this->CI->upload->do_upload('ffilemodule')){
                $dokumen = $this->CI->upload->data();
                $dok['ffilemodule'] = array(
                    'path' => '/' . $config['upload_path'] . $dokumen['file_name'],
                    'name' => $dokumen['file_name'],
                    'type' => $_FILES['ffilemodule']['type'],
                    'timestamp' => time()
                );
                $data['fmediaid'] = $this->CI->media_lib->create($dok['ffilemodule']);

                if($insert_id = $this->CI->Insert_module->create($data)){
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
        return $return;
    }

    public function update(){
        $module = $this->get($this->CI->input->post('fmoduleid'));
        $data = $this->CI->input->post();
        
        // echo "<pre>";
        // print_r($_FILES['ffilemodule']);
        // echo "<pre>";
        // exit();
        $return = false;
        if(!empty($_FILES['ffilemodule']) && $_FILES['ffilemodule']['name'] != ""){

            $pathfile = pathinfo($_FILES['ffilemodule']['name']);
            $config['upload_path'] = 'assets/backend/media/uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';
            $config['file_name'] = 'module_'.md5(date('YmdHis')).'.' . $pathfile['extension'];
            
            $this->CI->upload->initialize($config);
            if($this->CI->upload->do_upload('ffilemodule')){
                $dokumen = $this->CI->upload->data();
                $dok['ffilemodule'] = array(
                    'path' => '/' . $config['upload_path'] . $dokumen['file_name'],
                    'name' => $dokumen['file_name'],
                    'type' => $_FILES['ffilemodule']['type'],
                    'timestamp' => time()
                );
                $data['fmediaid'] = $this->CI->media_lib->create($dok['ffilemodule']);

                if($this->CI->Update_module->update($data)){
                    return $this->get($this->CI->input->post('fmoduleid'));
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
            if($this->CI->Update_module->update($data)){
                return $this->get($this->CI->input->post('fmoduleid'));
            }
        }

        echo "<pre>";
        print_r($return);
        echo "<pre>";
        return $return;
    }

    public function delete($fmoduleid){
        if($this->CI->Delete_module->delete($fmoduleid)){
            return true;
        }
        return false;
    }

    public function get($fmoduleid){
        $module = $this->CI->Select_module->get($fmoduleid);
        return $module;
    }

    public function getAll(){
        return $this->CI->Select_module->getAll();
    }
}