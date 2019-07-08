<?php class Update_user extends CI_Model {

	 public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function update($data){
	    unset($data['passwordconf']);

	    if($data['fuserpassword'] != ''){
            $password = md5($data['fuserpassword'], false);
            $data['fuserpassword'] = $password;
        }
        else{
	        unset($data['fuserpassword']);
        }

        $this->db->set($data);
        $this->db->where('fuserid', $data['fuserid']);

        return $this->db->update('tusers');
    }

    public function changePwd($data){
        $password = md5($data['fuserpassword'], false);
        $data['fuserpassword'] = $password;

        $this->db->set($data);
        $this->db->where('fuserid', $data['fuserid']);

        return $this->db->update('tusers');
    }

    public function saveToken($fuserid, $fremembermetoken){
        $this->db->set('fremembermetoken', $fremembermetoken);

        $this->db->where('fuserid', $fuserid);

        return $this->db->update('tusers');
    }

    public function removeToken($fuserid){
        $this->db->set('fremembermetoken', null);

        $this->db->where('fuserid', $fuserid);

        return $this->db->update('tusers');
    }

    public function updateUser($update,$where){
        $this->db->set($update);
        $this->db->where($where);
        $result = $this->db->update('tusers');
        echo $this->db->last_query();
        return $result;
    }
}
?>