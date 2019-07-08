<?php
class Insert_user extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	
	public function create($data){
        $data['created_at'] = date("Y-m-d H:i:s");
        unset($data['passwordconf']);
        $password = md5($data['fuserpassword'], false);
        $data['fuserpassword'] = $password;
		$this->db->set($data);
		$this->db->insert('tusers');
        // echo $this->db->last_query();
		return $this->db->insert_id();
	}

    public function addUserMeta($insert){
        $this->db->set($insert);
        $this->db->insert('tusersmeta');
        return $this->db->insert_id();
    }
}
?>