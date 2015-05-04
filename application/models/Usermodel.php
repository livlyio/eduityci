<?php

class Usermodel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->odb = $this->load->database('orgdb', TRUE);
        $this->load->helper('string');
    }
    
    function get_profile($uid)
    {
        $this->db->where('uacc_id',$uid);
        $query = $this->db->get('user_profiles');

        if ($query->num_rows() > 0) {
            return $query->row(); 
        }
        return false;        
        
    }
    
    function get_profiles($uid)
    {
        $this->db->where('uacc_id',$uid);
        $query = $this->db->get('user_profiles');

        if ($query->num_rows() > 0) {
            return $query->result(); 
        }
        return false;         
    }
    
    function has_access_privs($type,$uid,$tid,$perm = 'RO')
    {
        $this->db->where('uacc_id',$uid);
        $this->db->where('profile_type',$type);
        $this->db->where('profile_type_id',$tid);
        
        switch ($perm) {
            case 'RO':
                $this->db->where('allow_read','1');
            break;
            case 'RW':
                $this->db->where('allow_read','1');
                $this->db->where('allow_write','1');
            break;
            default:
                $this->db->where('allow_read','1');
            break;
        }

        $query = $this->db->get('user_profiles');
        return $query->num_rows() > 0;        
    }
    

    
    function insert_permission($type,$uid,$tid,$perm)
    {    
        $data['profile_type'] = $type;
        $data['uacc_id'] = $uid;
        $data['profile_type_id'] = $tid; 
        switch ($perm) {
            case 'RW':
            $data['allow_read'] = 1;
            $data['allow_write'] = 1;
            break;
            case 'RO':
            $data['allow_read'] = 1;
            break;
        }
    
        $this->db->insert('user_profiles',$data);
        return $this->db->insert_id();        
    }  
    
    function insert_error($level,$uid,$message)
    {
        $data['error_level'] = $level;
        $data['uacc_id'] = $uid;
        $data['message'] = $message;
        $data['ipaddr'] = $this->input->ip_address();
        $data['timestamp'] = date("Y-m-d H:i:s");
        
        $this->db->insert('error_log',$data);
        return $this->db->insert_id();
    }


}

?>