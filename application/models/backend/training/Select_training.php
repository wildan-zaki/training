<?php class Select_training extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($ftrainplanid){
        $query = "SELECT u.*, r.ftraintypename as traintype
                FROM ttrainingplan u
                LEFT JOIN ttrainingtype r ON u.ftraintypeid = r.ftraintypeid
                WHERE u.ftrainplanid = ?";
        // echo $this->db->last_query();
        return $this->db->query($query, array($ftrainplanid))->row();
    }

    public function getAll($ftrainplanid = null){
		$query = "SELECT u.*, r.ftraintypename as traintype, CASE WHEN ftrainingstatus = 0 THEN 'Not Active' WHEN ftrainingstatus = 1 THEN 'Active' END as trainingstatus FROM ttrainingplan u
        LEFT JOIN ttrainingtype r ON u.ftraintypeid = r.ftraintypeid";
        // echo $this->db->last_query();

        return $this->db->query($query, array($ftrainplanid))->result();
    }
    public function countAll($ftrainplanid = null){
        $query = "SELECT u.*, CASE WHEN ftrainingstatus = 0 THEN 'Not Active' WHEN ftrainingstatus = 1 THEN 'Active' END as trainingstatus FROM ttrainingplan u";
        // echo $this->db->last_query();
        return $this->db->query($query, array($ftrainplanid))->num_rows();
        // return $query->num_rows();
    }

    public function get_where($where, $single = true) {
        $this->db->select('*');
        $this->db->where($where);
        $this->db->join('ttrainingtype','ttrainingtype.ftraintypeid = ttrainingplan.ftraintypeid');
        $query = $this->db->get('ttrainingplan');
        // echo $this->db->last_query();
        //if(!empty($_REQUEST['debug']))echo $this->db->last_query();
        if ($query->num_rows() > 0){
            if($single)
                return $query->row_array();
            else
                return $query->result_array();
        }
    }

    public function count_where($where) {
        $this->db->select('*');
        $this->db->where($where);
        $query = $this->db->get('ttrainingplan');
        // echo $this->db->last_query();
        //if(!empty($_REQUEST['debug']))echo $this->db->last_query();

        return $query->num_rows();
    }
}
?>