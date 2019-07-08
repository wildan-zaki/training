<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trainingtype_lib{
    private $CI;
    var $limit = 10;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('backend/trainingtype/Select_trainingtype');
        $this->CI->load->model('backend/trainingtype/Insert_trainingtype');
        $this->CI->load->model('backend/trainingtype/Update_trainingtype');
        $this->CI->load->model('backend/trainingtype/Delete_trainingtype');
    }

    public function create(){
        $data = $this->CI->input->post();
        if($insert_id = $this->CI->Insert_trainingtype->create($data)){
            return true;
        }
        return false;
    }

    public function update(){
        $trainingtype = $this->get($this->CI->input->post('ftraintypeid'));
        $data = $this->CI->input->post();

        if($this->CI->Update_trainingtype->update($data)){
            return $this->get($this->CI->input->post('ftraintypeid'));
        }
    }

    public function delete($ftraintypeid){
        if($this->CI->Delete_trainingtype->delete($ftraintypeid)){
            return true;
        }
        return false;
    }

    public function get($ftraintypeid){
        $trainingtype = $this->CI->Select_trainingtype->get($ftraintypeid);
        return $trainingtype;
    }

    public function getAll(){
        return $this->CI->Select_trainingtype->getAll();
    }
}