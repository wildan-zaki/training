<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Position_lib{
    private $CI;
    var $limit = 10;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('backend/position/Select_position');
        $this->CI->load->model('backend/position/Insert_position');
        $this->CI->load->model('backend/position/Update_position');
        $this->CI->load->model('backend/position/Delete_position');
    }

    public function create(){
        $data = $this->CI->input->post();
        if($insert_id = $this->CI->Insert_position->create($data)){
            return true;
        }
        return false;
    }

    public function update(){
        $position = $this->get($this->CI->input->post('fpositionid'));
        $data = $this->CI->input->post();

        if($this->CI->Update_position->update($data)){
            return $this->get($this->CI->input->post('fpositionid'));
        }
    }

    public function delete($fpositionid){
        if($this->CI->Delete_position->delete($fpositionid)){
            return true;
        }
        return false;
    }

    public function get($fpositionid){
        $position = $this->CI->Select_position->get($fpositionid);
        return $position;
    }

    public function getAll(){
        return $this->CI->Select_position->getAll();
    }
}