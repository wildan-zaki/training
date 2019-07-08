<?php defined('BASEPATH') or exit('No direct script access allowed');

class Media_lib {
	private $CI;     
	
	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->helper('string');
		$this->CI->load->model('backend/media/Select_media');
		$this->CI->load->model('backend/media/Insert_media');
		$this->CI->load->model('backend/media/Update_media');
        $this->CI->load->model('backend/media/Delete_media');
        $this->CI->load->library('image_lib');
	}

	public function create($file){
	    $data = array(
            'fuserid' => $this->CI->session->userdata('fuserid'),
            'fmediapath' => $file['path'],
            'fmediaoriginalname' => $file['name'],
            'fmediatimestamp' => $file['timestamp'],
            'fmediatype' => $file['type'],
            'fmediastatus' => 1,
        );

        if(array_key_exists('ftype', $file)){
            $data['ftype'] = $file['ftype'];
        }
        if(array_key_exists('fmediacaption', $file)){
            $data['fmediacaption'] = $file['fmediacaption'];
        }

        return $this->CI->Insert_media->create($data);
    }

    public function delete($file_id){
        return $this->CI->Delete_media->delete($file_id);
    }

    public function do_resize($source_path, $target_path)
    {
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => TRUE,
            'create_thumb' => TRUE,
            'thumb_marker' => '_thumb',
            'width' => 150,
            'height' => 150
        );
        $this->load->library('image_lib', $config_manip);
        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }else{
            
        }
        // clear //
        $this->image_lib->clear();
    }
}