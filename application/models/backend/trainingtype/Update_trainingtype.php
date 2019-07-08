<?php class Update_trainingtype extends CI_Model {

	 public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function update($data){
        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->set($data);
        $this->db->where('ftraintypeid', $data['ftraintypeid']);

        return $this->db->update('ttrainingtype');
    }
}
?>