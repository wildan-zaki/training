<?php class Update_module extends CI_Model {

	 public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function update($data){
        $data['updated_at'] = date("Y-m-d H:i:s");
        $this->db->set($data);
        $this->db->where('fmoduleid', $data['fmoduleid']);

        return $this->db->update('tmodule');
    }
}
?>