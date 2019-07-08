<?php class Select_media extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getAll(){
	    $this->db->get('tmedia');
	    return $this->db->result();
    }

    public function get($fmediaid){
	    $this->db->where('fmediaid', $fmediaid);
	    return $this->db->row();
    }

    public function get_where($where,$single=true){
		$this->limit = 1;
		$this->db->select('*');	  
		$this->db->where($where);
		$query = $this->db->get('tmedia');
		//echo $this->db->last_query();
		if ($query->num_rows() > 0){
			if($single) return $query->row_array();
			else return $query->result_array();
		}
	}
}
?>