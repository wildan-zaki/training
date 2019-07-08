<?php
class Insert_media extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function create($data){
        $this->db->set($data);
        $this->db->insert('tmedia');

        return $this->db->insert_id();
    }
}
?>