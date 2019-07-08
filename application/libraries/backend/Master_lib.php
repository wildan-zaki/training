<?php defined('BASEPATH') or exit('No direct script access allowed');

class Master_lib {
    private $CI;
    var $limit = 10;

    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('string');
        $this->CI->load->library('session');
    }

    public function side_menu($current_slug=array('dashboard')){
        $sess = $this->CI->session->all_userdata();
        $menu = array(
            'Dashboard' => array(
                'slug' => 'dashboard',
                'icon' => 'ion-earth',
                'url' => base_url('backend/dashboard')
            ),
            'User Management' => array(
                'slug' => 'user',
                'icon' => 'ion-android-social-user',
                'url' => null,
                'child' => array(
                    'User List' => array(
                        'slug' => 'user list',
                        'icon' => null,
                        'url' => base_url('backend/user')
                    ),
                    'Create User' => array(
                        'slug' => 'create user',
                        'icon' => null,
                        'url' => base_url('backend/user/create')
                    )
                )
            ),
            'Master Position' => array(
                'slug' => 'Position',
                'icon' => 'ion-android-contact',
                'url' => null,
                'child' => array(
                    'Position List' => array(
                        'slug' => 'position list',
                        'icon' => null,
                        'url' => base_url('backend/position')
                    ),
                    'Create Position' => array(
                        'slug' => 'create position',
                        'icon' => null,
                        'url' => base_url('backend/position/create')
                    )
                )
            ),
            'Master Certificate' => array(
                'slug' => 'Certificate',
                'icon' => 'ion-android-note',
                'url' => null,
                'child' => array(
                    'Certificate List' => array(
                        'slug' => 'certificate list',
                        'icon' => null,
                        'url' => base_url('backend/certificate')
                    ),
                    'Create Certificate' => array(
                        'slug' => 'create certificate',
                        'icon' => null,
                        'url' => base_url('backend/certificate/create')
                    )
                )
            ),
            'Training Management' => array(
                'slug' => 'training',
                'icon' => 'ion-briefcase',
                'url' => base_url('backend/training'),
                'child' => array(
                    'Training List' => array(
                        'slug' => 'training list',
                        'icon' => null,
                        'url' => base_url('backend/training')
                    ),
                    'Create Training' => array(
                        'slug' => 'create training',
                        'icon' => null,
                        'url' => base_url('backend/training/create')
                    ),
                    'Download Report' => array(
                        'slug' => 'download training',
                        'icon' => null,
                        'url' => base_url('backend/training/report')
                    )
                )
            ),
            'Module Management' => array(
                'slug' => 'Module',
                'icon' => 'ion-android-book',
                'url' => base_url('backend/module'),
                'child' => array(
                    'Module List' => array(
                        'slug' => 'module list',
                        'icon' => null,
                        'url' => base_url('backend/module')
                    ),
                    'Add Module' => array(
                        'slug' => 'Add module',
                        'icon' => null,
                        'url' => base_url('backend/module/create')
                    )
                )
            ),
            'Trainingtype Management' => array(
                'slug' => 'Trainingtype',
                'icon' => 'ion-android-friends',
                'url' => base_url('backend/trainingtype'),
                'child' => array(
                    'Trainingtype List' => array(
                        'slug' => 'trainingtype list',
                        'icon' => null,
                        'url' => base_url('backend/trainingtype')
                    ),
                    'Add Trainingtype' => array(
                        'slug' => 'Add trainingtype',
                        'icon' => null,
                        'url' => base_url('backend/trainingtype/create')
                    )
                )
            )
        );

        // Menu Filter for certain roles //
        
        switch($sess)
        {
            default:
                $res = $menu;
                break;
        }

        // if($sess['froleid'] == 1){ // Superadmin
        //     $selected_menu = array(
        //         'Dashboard',
        //         'Category',
        //         'Order' => array(
        //             'Sales Order', 'Delivery Order'
        //         ),
        //         'Product' => array(
        //             'Featured Products', 'Product Lists', 
        //         ),
        //         'Content',
        //         'User Management'
        //     );

        //     $res = $this->filterMenu($menu, $selected_menu);
        // }

        foreach($res as $key => $val){
            if($current_slug[0] == $val['slug']){
                $res[$key]['current'] = true;
            }
            if(array_key_exists('child', $res[$key])){
                foreach($res[$key]['child'] as $key_c => $val_c){
                    if(count($current_slug) > 1 && $current_slug[1] == $val_c['slug']){
                        $res[$key]['child'][$key_c]['current'] = true;
                    }
                }
            }
        }

        return $res;
    }

    public function filterMenu($menu = array(),$selected_menu = array()){
        $res = array();
        foreach($menu as $key => $val){
            foreach($selected_menu as $key_selected => $val_selected){
                if(is_array($selected_menu[$key_selected]) && $key == $key_selected){
                    $res[$key] = $val;
                    if(is_array($selected_menu[$key_selected]) && array_key_exists('child', $menu[$key])){
                        $child = array();
                        foreach($menu[$key]['child'] as $key_child => $val_child){
                            foreach($selected_menu[$key_selected] as $row_selected_child){
                                if($key_child == $row_selected_child){
                                    $child[$key_child] = $menu[$key]['child'][$key_child];
                                }
                            }
                        }
                        $res[$key]['child'] = $child;
                    }
                }
                else if(!is_array($selected_menu[$key_selected]) && $key == $selected_menu[$key_selected]){
                    $res[$key] = $val;
                }
            }
        }

        return $res;
    }
}

/* End of file Master_lib.php */
/* Location: ./application/libraries/Master_lib.php */