<?php class Delete_trainingtype extends CI_Model {

	 public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function delete($ftraintypeid){
	    $this->db->where('ftraintypeid', $ftraintypeid);

	    return $this->db->delete('ttrainingtype');
    }
}
?>