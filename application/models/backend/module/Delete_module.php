<?php class Delete_module extends CI_Model {

	 public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function delete($fmoduleid){
	    $this->db->where('fmoduleid', $fmoduleid);

	    return $this->db->delete('tmodule');
    }
}
?>