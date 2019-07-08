<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role_lib{
    private $CI;
    var $limit = 10;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('backend/role/Select_role');
    }

    public function getAll(){
        return $this->CI->Select_role->getAll();
    }
}