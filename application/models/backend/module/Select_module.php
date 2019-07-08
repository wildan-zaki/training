<?php class Select_module extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($fmoduleid){
        $query = "SELECT u.*, media.fmediapath as img
                FROM tmodule u
                LEFT JOIN tmedia media ON media.fmediaid = u.fmediaid
                WHERE u.fmoduleid = ?";
        return $this->db->query($query, array($fmoduleid))->row();
        echo $this->db->last_query();
    }

    public function getAll($fmoduleid = null){
		$query = "SELECT u.*, CASE WHEN fmodulestatus = 0 THEN 'Not Active' WHEN fmodulestatus = 1 THEN 'Active' END as modulestatus, media.fmediapath as img FROM tmodule u
            LEFT JOIN tmedia media ON media.fmediaid = u.fmediaid
            ";
        // echo $this->db->last_query();

        return $this->db->query($query, array($fmoduleid))->result();
    }
}
?>