<?php
class Select_role extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAll(){
        $this->db->select('*');
        return $this->db->get('trole')->result();
    }
}