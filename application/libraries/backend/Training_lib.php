<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Training_lib{
    private $CI;
    var $limit = 10;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('backend/training/Select_training');
        $this->CI->load->model('backend/training/Insert_training');
        $this->CI->load->model('backend/training/Update_training');
        $this->CI->load->model('backend/training/Delete_training');
        $this->CI->load->model('backend/user/Select_user');
        $this->CI->load->model('backend/position/Select_position');

        $this->CI->load->helper('cookie');
    }

    private function gettrainmember($data){

        $data['fuserid'] = array_filter($data['fuserid']);
        $data['position'] = array_filter($data['position']);

        $memb_res = array();
        $memby = $data;
        $total = count($memby['fuserid']);
        for($i=0;$i<$total;$i++)
        {

            //get user and position
            $where_user['fuserid'] = $memby['fuserid'][$i];
            $user = $this->CI->Select_user->get($where_user);

            $where_pos['fpositionid'] = $memby['position'][$i];
            $position = $this->CI->Select_position->get($where_pos);
            if(!empty($memby['position'][$i]))
            {
                
                $memb_res[] = array(
                        'fuserid' => $memby['fuserid'][$i],
                        'fusername' => $user->fusername,
                        'fpositionid' => $memby['position'][$i],
                        'fpositionname' => $position->fpositionname
                );
            }
        }
        if(!empty($memb_res))
        {
            $return = serialize($memb_res);   
        }
        return $return;
    }

    public function create(){
        $data = $this->CI->input->post();
        
        $dtdat = $data['ftrainmember'];
        $data['ftrainmember'] = $this->gettrainmember($dtdat);
        
        if($insert_id = $this->CI->Insert_training->create($data)){
            return true;
        }

        
        return false;
    }

    public function update(){
        $training = $this->get($this->CI->input->post('ftrainplanid'));
        $data = $this->CI->input->post();
        $dtdat = $data['ftrainmember'];
        $data['ftrainmember'] = $this->gettrainmember($dtdat);

        if($this->CI->Update_training->update($data)){
            return $this->get($this->CI->input->post('ftrainplanid'));
        }
        
    }

    public function delete($ftrainplanid){
        if($this->CI->Delete_training->delete($ftrainplanid)){
            return true;
        }
        return false;
    }

    public function get($ftrainplanid){
        $training = $this->CI->Select_training->get($ftrainplanid);
        return $training;
    }

    public function getfinishmember($ftrainplanid) {
        $where['ftrainplanid'] = $ftrainplanid;
        $training = $this->CI->Select_training->get_where($where);
        $member = unserialize($training['ftrainmember']);
        $members = array();
        foreach ($member as $mem) {
            $userid = $mem['fuserid'];
            $members[] = $this->CI->Select_user->get($userid);
        }
        // echo "<pre>";
        // print_r($members);
        // echo "<pre>";
        // exit();
        return $members;
    }

    public function getfinishtraining(){
        $where = "ttrainingplan.ftrainenddate < NOW()";
        $training = $this->CI->Select_training->get_where($where, false);
        return $training;
    }

    public function countfinish(){
        $where = "ttrainingplan.ftrainenddate < NOW()";
        $training = $this->CI->Select_training->count_where($where, false);
        return $training;
    }

    public function getAll(){
        return $this->CI->Select_training->getAll();
    }

    function report(){

        $tfinised = $this->getfinishtraining();
        $report = array(
            'title' => "Training Report",
            'total_training' => $this->CI->Select_training->countAll(),
            'total_finish' => $this->countfinish(),
            'finished_train' => $tfinised
        );

        return $report;
   }
}