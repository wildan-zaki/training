<?php class Delete_media extends CI_Model {

	 public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function delete($fmediaid){
	    $this->db->where('fmediaid', $fmediaid);

	    return $this->db->delete('tmedia');
    }
}
?>