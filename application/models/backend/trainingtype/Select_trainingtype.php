<?php class Select_trainingtype extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($ftraintypeid){
        $query = "SELECT u.*
                FROM ttrainingtype u
                WHERE u.ftraintypeid = ?";
        // echo $this->db->last_query();
        return $this->db->query($query, array($ftraintypeid))->row();
    }

    public function getAll($ftraintypeid = null){
		$query = "SELECT u.*, CASE WHEN ftraintypestatus = 0 THEN 'Not Active' WHEN ftraintypestatus = 1 THEN 'Active' END as trainingtypestatus FROM ttrainingtype u";
        // echo $this->db->last_query();
        return $this->db->query($query, array($ftraintypeid))->result();
    }
}
?>