<?php class Select_user extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function checkEmail($user){
		$this->db->from('tusers');
		$this->db->where('fuseremail',$user['fuseremail']);
		return $this->db->count_all_results();
	}
	
	public function checkUsername($user){
		$this->db->from('tusers');  
		$this->db->where('fusername',$user['username']);
		return $this->db->count_all_results();
	}
	
	public function checkPass($user){
		$this->db->from('tusers');  
		$this->db->where('fuserid',$user['userID']);
		$this->db->where('fuserpassword',$user['currentPassword']);
		return $this->db->count_all_results();
	}
	
	public function checkLogin($user,$offset = FALSE){
		$this->limit = 1;
		$this->db->select('fuserid');
		$this->db->where('fuseremail',$user['fuseremail']);
		$this->db->where('fuserpassword',md5($user['fuserpassword'], false));
		$this->db->where('froleid',1);
		$query = $this->db->get('tusers', $this->limit, $offset);
		// echo $this->db->last_query();
		if ($query){
			return $query->row();
		}

		return false;
	}
	public function get_where($where,$field="*",$single=true){
		$this->db->select($field);	  
		$this->db->join('trole', 'tusers.froleid = trole.froleid');
		$this->db->where($where);
		$this->db->where_in('fuserstatus',array(0,1));
		$query = $this->db->get('tusers');
		echo $this->db->last_query();
		//if(!empty($_REQUEST['debug']))echo $this->db->last_query();
		if ($query->num_rows() > 0){
			if($single)
				return $query->row_array();
			else
				return $query->result_array();
		}
	}

	public function get($fuserid){
        $query = "SELECT u.*, r.*
                FROM tusers u
               	LEFT JOIN trole r ON u.froleid = r.froleid 
                WHERE u.fuserid = ?";
        // echo $this->db->last_query();
        return $this->db->query($query, array($fuserid))->row();
    }

    public function getAll($froleid = null){
		$query = "SELECT u.*, r.frolename, CASE WHEN fuserstatus = 0 THEN 'Not Active' WHEN fuserstatus = 1 THEN 'Active' END as userstatus
        FROM tusers u
        LEFT JOIN trole r ON u.froleid = r.froleid
        WHERE u.froleid = ?";
        
        return $this->db->query($query, array($froleid))->result();
    }
  
	public function get_count_meta($meta,$offset = FALSE){
		$this->db->from('tusersmeta');  
		$this->db->where($meta);	
		return $this->db->count_all_results();
	}

    public function checkExistingTokens($fremembermetoken){
	    $this->db->where('fremembermetoken', $fremembermetoken);

	    return $this->db->get('tusers')->row();
    }
	
}
?>