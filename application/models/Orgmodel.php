<?php

class Orgmodel extends CI_Model {

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
    
    function org_name($id)
    {
        $this->odb->select('org_name');
        $this->odb->where('org_id',$id);
        $query = $this->odb->get('organizations');

        if ($query->num_rows() > 0) {
            $result = $query->row(); 
            return $result->org_name;
        }
        log_message('error', 'Orgmodel->org_name() did not return a value.');
        return '';          
    }
    
    function get_units($id)
    {
        $this->odb->where('org_id',$id);
        $query = $this->odb->get('organizations_units');
        if ($query->num_rows() > 0) {
            return $query->result_array(); 
        }
        return false;        
               
    }
    
    
    function get_unit_map($id)
    {
        $this->odb->where('org_id',$id);
        $query = $this->odb->get('organizations_units');
        $rowz = $query->result_array();
        $tree = $this->buildTree($rowz);
        return $tree;     
    }
    
    function buildTree(array $elements, $parentId = 0) {
    $branch = array();
    foreach ($elements as $element) {
        if ($element['parent_id'] == $parentId) {
            $children = $this->buildTree($elements, $element['unit_id']);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[] = $element;
        }
    }
    return $branch;
    }

    function get_unit($unitid)
    {
        $query = $this->odb->get_where('organizations_units', array('unit_id' => $unitid), 1, 0);

        if ($query->num_rows() > 0) {
            return $query->row_array(); 
        }
        return false;
    }
    
    function add_unit($orgid,$data)
    {
        unset($data['add_unit']);
        
        $data['org_id'] = $orgid;
        
        $this->odb->insert('organizations_units',$data);
        return $this->odb->insert_id();
    }    
    
    function update_unit($unitid,$data)
    {
        unset($data['save_unit']);
        unset($data['unit_id']);
        $this->odb->where('unit_id',$unitid);
        $this->odb->update('organizations_units',$data);
        return true;
    }
    
    function delete_unit($unitid)
    {
        $this->odb->where('unit_id',$unitid);
        $this->odb->delete('organizations_units');
        return true;   
    }
    

}

?>