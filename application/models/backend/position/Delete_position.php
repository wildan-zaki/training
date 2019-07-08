<?php class Delete_position extends CI_Model {

	 public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function delete($fpositionid){
	    $this->db->where('fpositionid', $fpositionid);

	    return $this->db->delete('tposition');
    }
}
?>