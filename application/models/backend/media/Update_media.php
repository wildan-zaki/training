<?php class Update_media extends CI_Model {

	 public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function update($fmediaid, $data){
	     $this->db->set($data);
	     $this->db->where('fmediaid', $fmediaid);
	     return $this->db->update('tmedia');
    }
}
?>