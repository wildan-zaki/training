<?php class Delete_user extends CI_Model {

	 public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function delete($fuserid){
	    $this->db->where('fuserid', $fuserid);

	    return $this->db->delete('tusers');
    }

    public function deleteGallery($fmediaid){
        $this->db->where('fmediaid', $fmediaid);
        if(!$this->db->delete('tmedia')){
            return false;
        }

        return true;
    }
}
?>