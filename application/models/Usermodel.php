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
    
    function has_access_org($uid,$tid,$perm = false)
    {
        $this->db->where('uacc_id',$uid);
        $this->db->where('profile_type','ORG');
        $this->db->where('profile_type_id',$tid);
        if ($perm) { $this->db->where('permission',$perm); }
        $query = $this->db->get('user_profiles');
        return $query->num_rows() > 0;                    
    }

    function has_access_unit($uid,$tid)
    {
        $this->db->where('uacc_id',$uid);
        $this->db->where('profile_type','UNT');
        $this->db->where('profile_type_id',$tid);
        $query = $this->db->get('user_profiles');
        return $query->num_rows() > 0;                    
    }
    
    function insert_permission($type,$uid,$tid,$perm)
    {
        $data['profile_type'] = $type;
        $data['uacc_id'] = $uid;
        $data['profile_type_id'] = $tid; 
        $data['permission'] = $perm;
    
        $this->db->insert('user_profiles',$data);
        return $this->db->insert_id();        
    }  
    


}

?>