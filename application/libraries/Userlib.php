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
        // Critical error
        $this->critical_error('Attempted unauthorized access to ['. $type .': '. $tid .']');
        die(); 
        } else {
            // User has requested permissions
            return;
        }
    }
    
    public function critical_error($input)
    {
        // Create log message
        $message = '[USR: '. $this->user .'] '.$input;
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
    }

    public function log_error($level,$message)
    {
       if (!isset($this->user)) $this->user = '0';
       return $this->CI->usermodel->insert_error($level,$this->user,$message);      
    }    
    
    public function get_profile()
    {
        $this->profile = $this->CI->usermodel->get_profiles($this->user);
        return $this->profile;
    }
    
    public function create_profile($id)
    {
        $this->CI->usermodel->insert_permission('DASH',$id,'0','RW');
    }
    
    // Menus and Tree generation
    
    public function org_menu()
    {
    $out = array();
    $i = 0;
    
    if (!$this->profile) return array();
    
    foreach ($this->profile as $p) {
        if ($p->profile_type == 'ORG') { 
           $enc = $this->encode_query(array('org' => $p->profile_type_id,'unit' => '0'));
           $out[$i]['url'] = site_url('user/organization/view/'. $enc);
           $out[$i]['anchor'] = $this->CI->orgmodel->org_name($p->profile_type_id);
           $i++; 
        }
    }
    return $this->make_menu('Organizations',$out);
    }
    

    
    function make_menu($name,$items = false) {
        if (!$items) {
            return '';
        } else {
            $out = '';
              
            $c = count($items);
            $i = 1;
    
                foreach ($items as $item) {
                    $out .= '<li><a href="'.$item['url'].'"><i class="fa fa-sitemap"></i>'.$item['anchor'].'</a></li>';
                   // if ($i < $c) { $out .= '<li class="divider"></li>'."\n"; }
                    $i++;
                }          
            $out .= '</li>';
        }
        return $out;
    }
    
	// Encryption and Decryption Functions
    
    public function decode_segment($loc = 4)
    {  
        $seg = $this->CI->uri->uri_to_assoc($loc);
        $object = (object) $seg;
        return $object;
        
        $seg = $this->CI->uri->segment($loc);
        if (strpos($seg,'.php') || strpos($seg,'.css') || strpos($seg,'.js')) { return; }
        $array = $this->decode_query($this->CI->uri->segment($loc));
        // Check to make sure we have some value not 0
        if (array_sum($array) <= 0) { $this->critical_error('Query segment contains null values. ['. $this->CI->uri->segment($loc) .']'); die(); }
        // Values are in array, send back as an object
        $object = (object) $array;
        return $object;
    }
    
    public function decode_query($string)
    {
        $dec = $this->decode($string);
        // Check if decoded data contains gibberish
        if (preg_match( '/[\\x80-\\xff]+/' , $dec ) > 0) {
            // Something went seriously wrong or user is trying to enter their own strings.
            $this->critical_error('Query segment is invalid. ['. $string .']');
            die();
        }
        parse_str($dec, $output);
        return $output;  
    }
    
    public function encode_query($array)
    {
        return $this->CI->uri->assoc_to_uri($array);
        
       // return $this->encode(http_build_query($array));
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