<?php

class Lv_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->helper('string');
    }
    
    function list_links()
    {
        $query = $this->db->get('redirects');

        if ($query->num_rows() > 0) {
            $result = $query->result_array(); 
            return $result;
        }
        return false;        
        
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

    function get_url($alias)
    {
    
        $this->db->select('url');

        $query = $this->db->get_where('redirects', array('alias' => $alias), 1, 0);

        if ($query->num_rows() > 0) {
            $row = $query->row(); 
            return $row->url;
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

/**

* Save a new Alias to the table

* @param type $url URL to shorten

* @param type $alias  The new Alias for this URL

*/

function save_new_alias($url, $alias, $name, $cat, $user)

{

$data = array(

'alias' => $alias,

'url' => $url,

'name' => $name,

'category' => $cat,

'user' => $user,

'created' => date("Y-m-d H:i:s")

);

$this->db->insert('redirects', $data);

}

}

?>