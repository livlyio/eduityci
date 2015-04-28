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
    
    function count_links(){
        $query = $this->db->get('redirects');
        return $query->num_rows();         
    }
    
    function get_links($start,$stop)
    {
        $query = $this->db->get('redirects',$start,$stop);

        if ($query->num_rows() > 0) {
            $result = $query->result_array(); 
            return $result;
        }
        return false;        
        
    }

    function get_unit($orgid,$unitid)
    {
        $query = $this->odb->get_where('organizations_units', array('unit_id' => $unitid,'org_id' => $orgid), 1, 0);

        if ($query->num_rows() > 0) {
            return $query->row_array(); 
        }
        return false;
    }
    
    function save_stat($alias, $realurl, $clientip, $hostname, $referer)
    {
     return;   
    }
    
    function count_bycat($cat) {
        $this->db->where(array('category' => $cat));
        $query = $this->db->get('redirects');
        return $query->num_rows();  
    }
    
    
    function create($inurl, $name, $cat, $user)
    {
    $long_url = prep_url($inurl);

    //$link_length = $this->config->item(‘link_length’);
    $link_length = '3';

    $alias = random_string('nozero', '1') . random_string('alnum', $link_length);

    while ($this->does_alias_exist($alias))
    {
        $alias = random_string('nozero', '1') . random_string('alnum', $link_length);
    }

    $this->save_new_alias($long_url, $alias, $name, $cat, $user);

    return base_url() . $alias;
    }


/**

* Method to see if a generated Alias already exists in the table

* @param type $alias String to check to see if it exists

* @return Bool True or False

*/

    function does_alias_exist($alias)
    {
        $this->db->select('id');
        $query = $this->db->get_where('redirects', array('alias' => $alias), 1, 0);
        if ($query->num_rows() > 0) { return true; }
    
        return false;
    }

}

?>