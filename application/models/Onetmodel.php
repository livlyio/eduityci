<?php

class Onetmodel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->odb = $this->load->database('onetdb', TRUE);
        $this->load->helper('string');
    }
    
    function search_jobs($query)
    {
        $this->odb->like('title',$query);
        $this->odb->limit(10);
        $query = $this->odb->get('occupation_data');
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    
    function get_areas($term)
    {
        $this->odb->select('title');
        
        $this->odb->from('occupation_data');
        $this->odb->like('title',$term,'after');
        $this->odb->limit(10);
        $query = $this->odb->get();
         
        return $query->result();
    }
    
    function get_org($id)
    {
        $this->odb->where('org_id',$id);
        $query = $this->odb->get('organizations');

        if ($query->num_rows() > 0) {
            $result = $query->row_array(); 
            return $result;
        }
        return false;        
        
    }
    
}


?>