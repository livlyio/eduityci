<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
User class to pull profile
*/

class Userlib
{
	public function __construct()
	{
		//parent::__construct();
		$this->CI =& get_instance();
        $this->CI->load->model('Usermodel','usermodel');
        $this->CI->load->model('Orgmodel','orgmodel');
        $this->CI->load->helper('data_helper');
        $this->CI->load->helper('url');
    
    }
    
    public function grant_rw_access($type,$uid,$tid)
    {
        $this->CI->usermodel->insert_permission($type,$uid,$tid,'RW');
        
    }
    
    public function has_access($type,$uid,$tid)
    {
        switch ($type) {
            case 'ORG':
                return $this->CI->usermodel->has_access_org($uid,$tid);
            break;
            case 'INV':
            
            break;
            case 'UNT':
                return $this->CI->usermodel->has_access_unit($uid,$tid);
            break;
            case 'OTH':
            
            break;
            default:
            return false;
            break;
        }
    }
    
    public function has_write_access($type,$uid,$tid)
    {
        switch ($type) {
            case 'ORG':
                return $this->CI->usermodel->has_access_org($uid,$tid,'RW');
            break;
            case 'INV':
            
            break;
            case 'UNT':
                return $this->CI->usermodel->has_access_unit($uid,$tid,'RW');
            break;
            case 'OTH':
            
            break;
            default:
            return false;
            break;
        }
    }    
    
    public function get_profile()
    {
    // User is logged in, get profile
        $auth = $this->CI->session->userdata('flexi_auth');
        $this->uid = $auth['user_id'];
        $this->profile = $this->CI->usermodel->get_profiles($this->uid);
        return $this->profile;
    }
    
    public function org_menu()
    {
    $out = array();
    $i = 0;
    
   // print_r($this->profile); die();
        
    foreach ($this->profile as $p) {
        if ($p->profile_type == 'ORG') { 
           $out[$i]['url'] = site_url('user/organization/view/'.$p->profile_type_id);
           $out[$i]['anchor'] = $this->CI->orgmodel->org_name($p->profile_type_id);
           $i++; 
        }
    }
    return make_menu('Organizations',$out);
    
    
    }
    
    
 }