<?php

class Onetmodel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->db = $this->load->database('eduity',true);
        $this->odb = $this->load->database('onetdb', TRUE);
        $this->load->helper('string');
    }
    
    function get_job_common($soc,$common) {
        $result = $this->get_job_bysoc($soc);
        $result->ctitle = $this->get_common_byid($common)->common_name;
        $result->ccode = $this->get_common_byid($common)->onetsoc_code;
        return $result;
    }
    
    function get_job_bysoc($soc)
    {
        $this->odb->where('onetsoc_code',$soc);
        $query = $this->odb->get('occupation_data');
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;        
    }
    
    
    function list_common($soc) {
        $common = '';
        $result = $this->get_common_bysoc($soc);
        if (is_array($result)) {
        foreach ($result as $key => $r) {
            if ($key != 0) $common .= ', ';
            $common .= $r->common_name;
        }
        return $common;
        }
        return '';
    }

    function search_common($term) {
      //  $part = explode(".",$soc);
      $this->odb->select('common_name AS title');
      $this->odb->select('onetsoc_code');
        $this->odb->like('common_name',$term);
        $this->odb->limit(20);
        $this->odb->order_by('common_name','DESC');
        $query = $this->odb->get('onet_common_names');
         if ($query->num_rows() > 0) {
            $result = $query->result(); 
         //   print_r($result); die();
            return $result;
        }
        return array();          
    }

    function get_common_byid($id) {
        $this->odb->where('common_id',$id);
        $query = $this->odb->get('onet_common_names');
         if ($query->num_rows() > 0) {
            return $query->row(); 
            
        }
        return false;          
    } 
    
    function get_common_bysoc($soc) {
        $part = explode(".",$soc);
        $this->odb->where('onetsoc_code',$part['0']);
        $query = $this->odb->get('onet_common_names');
         if ($query->num_rows() > 0) {
            $result = $query->result(); 
            return $result;
        }
        return false;          
    }

    function list_ttech($soc) {
        $tools = '';
        $tech = '';
        
        $result = $this->get_ttech_bysoc($soc,'Tools');
        
        foreach ($result as $key => $r) {
            if ($key != 0) $tools .= ', ';
            $tools .= $r->commodity_title;
        }
        
        $result = $this->get_ttech_bysoc($soc,'Technology');
        
        foreach ($result as $key => $r) {
            if ($key != 0) $tech .= ', ';
            $tech .= $r->commodity_title;
        }
                
        return array('tools' => $tools,'tech' => $tech);
    }
    
    function get_ttech_bysoc($soc,$type = false) {
       // $part = explode(".",$soc);
        $this->odb->where('onetsoc_code',$soc);
        if ($type != false) $this->odb->where('type',$type);
        $this->odb->group_by('commodity_code');
        $query = $this->odb->get('onet_tools_technology');
         if ($query->num_rows() > 0) {
            return $query->result(); 
        }
        return false;          
    }
    
    function get_basic_bysoc($soc) {
        $r1 = (array)$this->get_wage_bysoc($soc);
        $r2 = (array)$this->get_common_bysoc($soc);
        $result = array_merge($r1,$r2);
        return (object)$result;
       print_r($r1); die();
    }
    
    function get_wage_bysoc($soc) {
        $part = explode(".",$soc);
        $this->odb->where('OCC_CODE',$part['0']);
        $query = $this->odb->get('onet_wages');
         if ($query->num_rows() > 0) {
            $result = $query->row(); 
            return $result;
        }
        return false;         
    }
    
    function search_jobs($term)
    {
       // return $this->search_common($term);
        $this->odb->like('title',$term);
        $this->odb->or_like('description',$term);
       // }
        $this->odb->limit(20);
        $this->odb->order_by('title','DESC');
        $query = $this->odb->get('occupation_data');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $this->search_jobs_byacts($term);
        }
        return false;
    }

    function search_jobs_by_title($term)
    {
        $this->odb->like('title',$term);
        $this->odb->limit(20);
        $this->odb->order_by('title','DESC');
        $query = $this->odb->get('occupation_data');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } 
        return false;        
    }
    
    function search_jobs_by_soc($term)
    {
        $this->odb->like('onetsoc_code',$term);
        $this->odb->limit(20);
        $this->odb->order_by('title','DESC');
        $query = $this->odb->get('occupation_data');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } 
        return false;        
    }
    
    function search_jobs_byacts($term,$type = 'work_context')
    {
        $this->odb->select('occupation_data.title');
        $this->odb->select('occupation_data.onetsoc_code');
        $this->odb->like('content_model_reference.element_name',$term);
        $this->odb->or_like('content_model_reference.description',$term);
        $this->odb->join('content_model_reference','content_model_reference.element_id = '. $type .'.element_id');
        $this->odb->join('occupation_data',$type.'.onetsoc_code = occupation_data.onetsoc_code');
       
        $this->odb->limit(10);
      //  $this->odb->order_by('element_name','DESC');
        $this->odb->group_by('occupation_data.onetsoc_code');
        $query = $this->odb->get($type);
        
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