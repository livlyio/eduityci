<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
User class 
Check permissions and profiles
Helper functions
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
        $this->ipaddr = $this->CI->input->ip_address();
        $auth = $this->CI->session->userdata('flexi_auth');
        $this->user = $auth['user_id'];
        $this->skey = "E9R3l2817Lr54vyNeT2dXkFM128MscRU"; // you can change it    
    }
    
    public function grant_rw_access($type,$uid,$tid)
    {
        $this->CI->usermodel->insert_permission($type,$uid,$tid,'RW');   
    }    
    
    public function grant_ro_access($type,$uid,$tid)
    {
        $this->CI->usermodel->insert_permission($type,$uid,$tid,'RO');
    }
    
    function check_logged_in()
    {
	$result = $this->CI->flexi_auth->is_logged_in(); 
        
    if (!$result) {
        // Create log message
        $message = 'A logged out user attempted unauthorized access to a protected area.  Session may have timed out.';
        // Save to database
        $eid = $this->log_error('security',$message);
        // Write to system log
        log_message('security',$message);
 		// Send notice to user	
        $this->CI->flexi_auth->set_error_message('Please Log in. Error ID: '. $eid, TRUE);
		$this->CI->session->set_flashdata('message', $this->CI->flexi_auth->get_messages());
        // Redirect to support
        redirect('auth');
        // Halt execution 
        die(); 
        } else {
            // User has requested permissions
            return;
        }
    }
    
    function check_acl($type,$uid,$tid,$privs = 'RO')
    {  
    // Result will be TRUE or FALSE    
    $result = $this->CI->usermodel->has_access_privs($type,$uid,$tid,$privs);    
    // If user does not have access
    if (!$result) {
        // Create log message
        $message = '[USR: '. $uid .'] attempted unauthorized access to ['. $type .': '. $tid .']';
        // Save to database
        $eid = $this->log_error('security',$message);
        // Write to system log
        log_message('security',$message);
 		// Send notice to user	
        $this->CI->flexi_auth->set_error_message('There was an error with your account, please contact support in reference to Error ID: '. $eid, TRUE);
		$this->CI->session->set_flashdata('message', $this->CI->flexi_auth->get_messages());
        // Redirect to support
        redirect('support');
        // Halt execution 
        die(); 
        } else {
            // User has requested permissions
            return;
        }
    }

    public function log_error($level,$message)
    {
       return $this->CI->usermodel->insert_error($level,$this->user,$message);      
    }    
    
    public function get_profile()
    {

        $this->profile = $this->CI->usermodel->get_profiles($this->user);
        return $this->profile;
    }
    
    // Menus and Tree generation
    
    public function org_menu()
    {
    $out = array();
    $i = 0;
    
    foreach ($this->profile as $p) {
        if ($p->profile_type == 'ORG') { 
           $enc = $this->encode_query(array('org_id' => $p->profile_type_id,'unit_id' => '0'));
           $out[$i]['url'] = site_url('user/organization/view/'. $enc);
           $out[$i]['anchor'] = $this->CI->orgmodel->org_name($p->profile_type_id);
           $i++; 
        }
    }
    return $this->make_menu('Organizations',$out);
    }
    
    function printTree($array,$child = '0'){
    $out = "<ul>\n";
    foreach($array as $item){
        if(is_array($item) && isset($item['unit_title'])){
                if(isset($item['children']) && is_array($item['children'])){
                    $out .= "<li><a href=\"". site_url('user/organization/units/'. $this->encode_query(array('org_id' => $item['org_id'],'unit_id' => $item['unit_id']))) ."\">".$item['unit_title']."</a>";
                    $out .= $this->PrintTree($item['children'],'1');
                    $out .= "</li>\n";
                } else {
                    $out .= "<li><a href=\"". site_url('user/organization/units/'. $this->encode_query(array('org_id' => $item['org_id'],'unit_id' => $item['unit_id']))) ."\">".$item['unit_title']."</a></li>\n";
                }   
        }  
    }
    $out .= "</ul>\n\n";
    return $out;
    }    
    
    function make_menu($name,$items = false) {
        if (!$items) {
            return '';
        } else {
            $out =
            '<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">'. $name .'<b class="caret"></b></a>
              <ul class="dropdown-menu">';
              
            $c = count($items);
            $i = 1;
    
                foreach ($items as $item) {
                    $out .= '<li><a href="'.$item['url'].'">'.$item['anchor'].'</a></li>'."\n";
                    if ($i < $c) { $out .= '<li class="divider"></li>'."\n"; }
                    $i++;
                }          
            $out .= '</ul>
            </li>';
        }
        return $out;
    }
    
	// Encryption and Decryption Functions
    
    public function decode_segment($loc = 4)
    {  
        $array = $this->decode_query($this->CI->uri->segment($loc));
        $object = (object) $array;
        return $object;
    }
    
    public function decode_query($string)
    {
        $dec = $this->decode($string);
        parse_str($dec, $output);
        return $output;  
    }
    
    public function encode_query($array)
    {
        return $this->encode(http_build_query($array));
    }
	
    public function safe_b64encode($string) {
	
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }
 
	public function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
	
    public function encode($value){ 
		
	    if(!$value){return false;}
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext)); 
    }
    
    public function decode($value){
		
        if(!$value){return false;}
        $crypttext = $this->safe_b64decode($value); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }
    
 }