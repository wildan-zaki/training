<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_lib {
	private $CI;     
	
	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->helper('string');
        $this->CI->load->model('backend/user/Select_user');
		$this->CI->load->model('backend/user/Insert_user');
		$this->CI->load->model('backend/user/Update_user');
        $this->CI->load->model('backend/user/Delete_user');
        $this->CI->load->helper('cookie');
        // $this->CI->load->library('backend/media_lib');
	}

	public function sign_in($data){

	    $check = $this->checkLogin($data);

	    if($check){
	        if($this->CI->input->post('rememberme')){
                // Update random string to userdata
                $token_exists = false;
                $token = $this->generateRandomString();
                while($token_exists){
                    $token = $this->generateRandomString();

                    if(!$this->checkExistingTokens($token)){
                        $token_exists = true;
                    }
                    else{
                        $token_exists = false;
                    }
                }

                $this->saveToken($check->fuserid, $token);
            }

	        return array(
	            'status' => 1,
                'data' => $this->get($check->fuserid)
            );
        }

        return array(
            'status' => 0,
            'message' => 'User is not found'
        );
    }

    public function create(){
	    $data = $this->CI->input->post();
        if($insert_id = $this->CI->Insert_user->create($data)){
            return true;
        }
        return false;
    }

    public function update(){
        $user = $this->get($this->CI->input->post('fuserid'));
        $data = $this->CI->input->post();

        if($this->CI->Update_user->update($data)){
            return $this->get($this->CI->input->post('fuserid'));
        }

        return false;
    }

    public function delete($fuserid) {
        $user = $this->get($fuserid);

        if($this->CI->Delete_user->delete($fuserid)){
            return true;
        }

        return false;
    }

    public function saveToken($fuserid, $fremembermetoken){
        return $this->CI->Update_user->saveToken($fuserid, $fremembermetoken);
    }

    public function cookieLogin(){
        $token = get_cookie('project_remember_me');

        if($token){
            $auth = $this->sign_in($token);
            if($auth && $auth['status'] == 1){
                $auth['data']->logged_in = true;
                $server = isset($_SERVER['HTTP_HOST']) ?
                    $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
                $cookie = array(
                    'name'   => 'project_remember_me',
                    'value'  => $auth['data']->fremembermetoken,
                    'expire' => time() + 1209600,  // Two weeks
                    'domain' => $server,
                    'path'   => '/'
                );
                set_cookie($cookie);
                unset($auth['data']->fuserpassword);
                $this->CI->session->set_userdata(json_decode(json_encode($auth['data']), true));
                return true;
            }
            delete_cookie('project_remember_me');
            return false;
        }

        return false;
    }

    public function webLogin($data){

        $auth = $this->sign_in($data);
        if($auth && $auth['status'] == 1){
            $auth['data']->logged_in = true;
            if($this->CI->input->post('rememberme')){
                $server = isset($_SERVER['HTTP_HOST']) ?
                    $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
                $cookie = array(
                    'name'   => 'project_remember_me',
                    'value'  => $auth['data']->fremembermetoken,
                    'expire' => time() + 1209600,  // Two weeks
                    'domain' => $server,
                    'path'   => '/'
                );
                set_cookie($cookie);
            }
            unset($auth['data']->fuserpassword);
            $this->CI->session->set_userdata(json_decode(json_encode($auth['data']), true));

            return true;
        }

        return false;
    }

    public function checkExistingTokens($fremembermetoken){
        return $this->CI->Select_user->checkExistingTokens($fremembermetoken);
    }

    public function changePwd(){
        $data = array(
            'fuserpassword' => $this->CI->input->post('fuserpassword'),
            'fuserid' => $this->CI->session->get_userdata()['fuserid']
        );

        return $this->CI->Update_user->changePwd($data);
    }

    public function logout(){
        $sess = $this->CI->session->all_userdata();
        $this->CI->Update_user->removeToken($sess['fuserid']);
        $this->CI->session->sess_destroy();
        delete_cookie('project_remember_me');
    }

    function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getAll($froleid = null){
	    $users = $this->CI->Select_user->getAll($froleid);
        // $users_temp = array();
        // if(!empty($users)){
        //     foreach ($users as $user) {
        //             $key['fmetakey'] = 'customer_code';
        //             $key['tusersmeta.fuserid'] = $user->fuserid;
        //             $user_meta = $this->CI->Select_user->get_meta_where($key);
        //             $user->usercode = $user_meta['fmetavalue'];
        //             $users_temp[] = $user;
        //     }
        //     $users = $users_temp;
        // }
        return $users;
    }

    public function userSendMail($email,$token=""){
        $emailConfig = array(
           'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'rozergix@gmail.com',
            'smtp_pass' => 'wildan123!@#',
            'mailtype'  => 'html', 
            'charset'   => 'utf-8',
            'starttls'  => true,
            //'newline'    => "\r\n"
        );
        $emailConfig['newline'] = "\r\n";
        
        $from = array('email' => 'rozergix@gmail.com', 'name' => 'My Training');
        $to = $email['to'];
        $subject = $email['subject'];
         
        $message = $this->CI->load->view('email/header','',true);
        $message .= $email['message'];
        $message .= $this->CI->load->view('email/footer','',true);
        
        // Load CodeIgniter Email library
        $this->CI->load->library('email', $emailConfig);
        $this->CI->email->set_newline("\r\n");

        //$this->CI->email->set_newline("\r\n");
        $this->CI->email->from($from['email'], $from['name']);
        $this->CI->email->to($to);
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);
        
        if(!empty($email['attachment'])){
            foreach ($email['attachment'] as $attachment){
                $this->CI->email->attach($attachment);  
            }
        }
        
        if (!$this->CI->email->send()) {
            // Raise error message
            echo '<pre>';print_r($this->CI->email->print_debugger());echo '</pre>';
        }else {
            return 1;
        }
    }

    public function userForgotPass(){
        $return = false;
        if($where['fuseremail'] = $this->CI->input->post('fuseremail',TRUE)){
            $email = $where['fuseremail'];
            if($user = $this->CI->Select_user->get_where($where)){
                $this->CI->load->helper('string');  
                $userx['fporgotcode'] = random_string('alnum', 10);

                if($this->CI->Update_user->updateUser($userx,$where)){
                    $data['fullname'] = ucwords($user['fusername']);
                    $data['url'] = site_url().'backend/forgot/goto/?action=forgotpassword&key='.$userx['fporgotcode'].'&auth='. rawurlencode($email);
                    $emails['to'] = $email;
                    $emails['subject'] = 'Reset Your Password';
                    $emails['message'] = $this->CI->load->view('email/reset',$data,true);
                    if($this->userSendMail($emails)){
                        $return = true;
                    }
                }
            }
        }
        return $where;
    }

    public function forgotPassword(){
        $where['fporgotcode'] = $this->CI->input->get('key',TRUE);
        $where['fuseremail'] = rawurldecode($this->CI->input->get('auth',TRUE));
        if($user = $this->CI->Select_user->get_where($where)){
            $data['fullname'] = ucwords($user['fusername']);
            $data['password'] = random_string('alnum', 10);
            $emails['to'] = $where['fuseremail'];
            $emails['subject'] = 'Your New Password';
            $emails['message'] = $this->CI->load->view('email/password',$data,true);
            if($this->userSendMail($emails)){
                $update['fporgotcode'] = '';
                $update['fuserpassword'] = md5($data['password']);
                $this->CI->Update_user->updateUser($update,$where);
                return true;
            }   
        }else{
            return false;
        }
    }
	
	public function checkLogin($data){

        if(!is_array($data)){ // Request from COOKIE sign in
            return $this->checkExistingTokens($data);
        }

        // Request from normal sign in
		return $this->CI->Select_user->checkLogin($data);
	}

	public function get($fuserid){
		$user = $this->CI->Select_user->get($fuserid);
        return $user;
	}

    public function get_where($where,$field="*",$single=true){
        $user = $this->CI->Select_user->get_where($where,$field,$single);
        return $user;
    }

	public function isEmailUniqueExceptSelf($email){
	    $user = $this->get($this->CI->input->post('fuserid'));
	    $users = $this->getall();

	    foreach($users as $row){
	        if($row->fuseremail == $email && $row->fuserid != $user->fuserid){
	            return false;
            }
        }

        return true;
    }

    public function deleteGallery($fmediaid, $img){
        if($img != "" && $img != null && file_exists(FCPATH . $img)){
            unlink(FCPATH . $img);
        }

        return $this->CI->Delete_user->deleteGallery($fmediaid);
    }
}

/* End of file User_lib.php */
/* Location: ./application/libraries/User_lib.php */