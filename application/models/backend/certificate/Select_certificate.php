<?php class Select_certificate extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($fcertificateid){
        $query = "SELECT u.*, r.*, media.fmediapath as img
                FROM tcertificate u
                LEFT JOIN ttrainingplan r ON u.ftrainplanid = r.ftrainplanid
                LEFT JOIN tmedia media ON media.fmediaid = u.fmediaid
                WHERE u.fcertificateid = ?";

        // echo $this->db->last_query();
        return $this->db->query($query, array($fcertificateid))->row();
    }

    public function getAll($fcertificateid = null){
		$query = "SELECT u.*, CASE WHEN fcertificatestatus = 0 THEN 'Not Active' WHEN fcertificatestatus = 1 THEN 'Active' END as certificatestatus FROM tcertificate u";
        // echo $this->db->last_query();

        return $this->db->query($query, array($fcertificateid))->result();
    }
}
?>