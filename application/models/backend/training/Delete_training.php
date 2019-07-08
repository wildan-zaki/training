<?php class Delete_training extends CI_Model {

	 public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function delete($ftrainingid){
	    $this->db->where('ftrainingid', $ftrainingid);

	    return $this->db->delete('ttraining');
    }
}
?>