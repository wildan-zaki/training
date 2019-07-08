<?php
class Insert_position extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	
	public function create($data){
        $data['created_at'] = date("Y-m-d H:i:s");
		$this->db->set($data);
		$this->db->insert('tposition');
        // echo $this->db->last_query();
		return $this->db->insert_id();
	}
}
?>