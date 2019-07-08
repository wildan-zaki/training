<?php class Update_training extends CI_Model {

	 public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function update($data){
        $data['updated_at'] = date("Y-m-d");
        $this->db->set($data);
        $this->db->where('ftrainplanid', $data['ftrainplanid']);
        // echo $this->db->last_query();
        return $this->db->update('ttrainingplan');
    }
}
?>