<?php class Delete_certificate extends CI_Model {

	 public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function delete($fcertificateid){
	    $this->db->where('fcertificateid', $fcertificateid);

	    return $this->db->delete('tcertificate');
    }
}
?>