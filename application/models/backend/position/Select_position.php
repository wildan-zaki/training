<?php class Select_position extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($fpositionid){
        $query = "SELECT u.*
                FROM tposition u
                WHERE u.fpositionid = ?";
        // echo $this->db->last_query();
        return $this->db->query($query, array($fpositionid))->row();
    }

    public function getAll($fpositionid = null){
		$query = "SELECT u.*, CASE WHEN fpositionstatus = 0 THEN 'Not Active' WHEN fpositionstatus = 1 THEN 'Active' END as positionstatus FROM tposition u";
        // echo $this->db->last_query();

        return $this->db->query($query, array($fpositionid))->result();
    }
}
?>