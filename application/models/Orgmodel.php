<?php

class Orgmodel extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->db = $this->load->database('eduity',true);
        $this->odb = $this->load->database('orgdb', TRUE);
        $this->onet = $this->load->database('onetdb', TRUE);
        $this->load->model('onetmodel');
        $this->load->helper('string');
    }
    
    function new_org($data)
    {
        
        
    }
    
    function create_org($data,$uid)
    {
         
         $in['org_name'] = $data['org_name'];
         $in['org_desc'] = $data['description'];
         $in['org_location'] = $data['city'] .", ". $data['state'];
         $in['website'] = $data['website'];
         $in['owner_id'] = $uid;
         $this->odb->insert('organizations',$in);
         
         $oid = $this->odb->insert_id();
         
         $this->save_attribs($oid,$data);
         
         return $oid;
    }
    
    function save_attribs($oid,$data)
    {
      foreach ($data as $k => $d) {    
        $in = new StdClass();
        $in->org_id = $oid; // ID of org from main organizations table, example: 55
        $in->key = $k; // Key value for attribute, example: org_location
        $in->attrib = $d; // The actual attribute data, example: Chattanooga, TN
        $this->odb->insert('organizations_attributes',$in);
      }     
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
    
    function new_forecast($get)
    {
        $data = array('org_id' => $get->org,'unit_id' => $get->unit,'oujob_id' => $get->code);
        $data['created'] = date("Y-m-d");
        $fcid = $this->odb->insert('organizations_forecasts',$data);
        $this->new_forecast_sets($get,$fcid);
        return $fcid;
    }
    
    function new_forecast_sets($get,$fcid)
    {
        foreach (array('least','likely','most') as $fcset) {
            $data = array('org_id' => $get->org,'unit_id' => $get->unit,'oujob_id' => $get->code,'fcast_id' => $fcid,'fcast_set' => $fcset);
            $data['created'] = date("Y-m-d");
            $this->odb->insert('organizations_forecasts_sets',$data); 
        }     
    }
    
    function get_forecast_details($get)
    {
        $this->odb->where('org_id',$get->org);
        $this->odb->where('unit_id',$get->unit);
        $this->odb->where('oujob_id',$get->code);
        $query = $this->odb->get('organizations_forecasts_sets');
        
        return ($query->num_rows() > 0) ? $query->result() : false;        
    }
    
    function get_forecast_created($get)
    {
        $this->odb->where('org_id',$get->org);
        $this->odb->where('unit_id',$get->unit);
        $this->odb->where('oujob_id',$get->code);
        $this->odb->limit('1');
        $query = $this->odb->get('organizations_forecasts_sets');
        
        return ($query->num_rows() > 0) ? $query->row() : false;        
       
    }
    
    function update_forecast($get,$data)
    {
        $update['fcast_'.$data['name']] = $data['value'];
        $this->odb->where('org_id',$get->org);
        $this->odb->where('unit_id',$get->unit);
        $this->odb->where('oujob_id',$get->code);
        $this->odb->where('fset_id',$data['pk']);
        return $this->odb->update('organizations_forecasts_sets',$update);      
    }
    
    function del_forecast($get)
    {
        $data = array('fcast_6mo' => 0,'fcast_12mo' => 0,'fcast_18mo' => 0,'fcast_24mo' => 0,'fcast_36mo' => 0,'fcast_48mo' => 0,'fcast_60mo' => 0);
        $this->odb->where('org_id',$get->org);
        $this->odb->where('unit_id',$get->unit);
        $this->odb->where('oujob_id',$get->code);
        $this->odb->where('fset_id',$get->fcast);
        return $this->odb->update('organizations_forecasts_sets',$data);      
    }

    
    function list_or_create_forecast($get)
    {
        $list = $this->get_forecast_details($get);
        if (!$list) {
            $this->new_forecast($get);
            $list = $this->get_forecast_details($get);
        }
        return $list;   
    }
    
    function get_forecast_byid($get)
    {
        $this->odb->where('org_id',$get->org);
        $this->odb->where('unit_id',$get->unit);
        $this->odb->where('oujob_id',$get->code);
        $this->odb->where('fcast_id',$get->fcast);
        $query = $this->odb->get('organizations_forecasts');

        return ($query->num_rows() > 0) ? $query->result() : false; 
          
    }
    
    function list_forecasts($get)
    {
        $this->odb->where('org_id',$get->org);
        $this->odb->where('unit_id',$get->unit);
        $this->odb->where('oujob_id',$get->code);
        $query = $this->odb->get('organizations_forecasts');
        
        
        if ($query->num_rows() > 0) {
            $results = $query->result();
            return $results;
           } else return false;
    }
    
    function get_bcpath($unit,$org = 0)
    {
        $this->crumbs = array();
        
        $this->crumbs['0'] = $this->get_unit($unit);
        
        $id = $this->crumbs['0']['parent_id'];
        
        while ($id != '0') {
            $data = $this->get_unit($id);
            $this->crumbs[] = $data;
            $id = $data['parent_id'];
        }
       // print_r($this->crumbs); die();
        return array_reverse($this->crumbs);  
    }

    function get_unit($unitid)
    {
        $query = $this->odb->get_where('organizations_units', array('unit_id' => $unitid), 1, 0);

        if ($query->num_rows() > 0) {
            return $query->row_array(); 
        }
        return false;
    }
     
    function add_soc($org,$unit,$soc,$title)
    {
        $data['org_id'] = $org;
        $data['unit_id'] = $unit;
        $data['onetsoc_code'] = $soc;
        $data['title'] = $title;
        
        $this->odb->insert('organizations_units_jobs',$data);
        $code = $this->odb->insert_id();
        
        $this->add_soc_default_skills($org,$unit,$soc,$code);
        
        return $code;
    } 
    
    function update_occ($oujob,$data)
    {
        unset($data['save_edits']);
        $this->odb->where('oujob_id',$oujob);
        $this->odb->update('organizations_units_jobs',$data);
        return true;
    }
    
    function delete_occ($oujob)
    {
        $this->odb->where('oujob_id',$oujob);
        $this->odb->delete('organizations_units_jobs');
        
        $this->odb->where('oujob_id',$oujob);
        $this->odb->delete('organizations_units_jobs_skills');
            
        return true;   
    }    
     
    
    function get_unit_soc($org,$unit,$code,$obj = false)
    {
        $this->odb->select('*');
        //If they have entered a custom title or description, return the custom values
        $this->odb->select("IF(organizations_units_jobs.title IS NULL or organizations_units_jobs.title = '', occupation_data.title, organizations_units_jobs.title) as title ",FALSE);
        $this->odb->select("IF(organizations_units_jobs.description IS NULL or organizations_units_jobs.description = '', occupation_data.description, organizations_units_jobs.description) as description ",FALSE);
        $this->odb->where('org_id',$org);
        $this->odb->where('unit_id',$unit);
        $this->odb->where('oujob_id',$code);
        $this->odb->join('eduity_onet.occupation_data', 'occupation_data.onetsoc_code = organizations_units_jobs.onetsoc_code');

        $query = $this->odb->get('organizations_units_jobs');
 
        if ($query->num_rows() > 0) {
            if ($obj) {
            $r1 = $query->row();
            $r1->common = $this->onetmodel->list_common($r1->onetsoc_code);
            $r1->wage = $this->onetmodel->get_wage_bysoc($r1->onetsoc_code)->A_MEDIAN;
            return $r1;                
            } else {  
            $r1 = $query->row_array();
            $r1['common'] = $this->onetmodel->list_common($r1['onetsoc_code']);
            $r1['wage'] = $this->onetmodel->get_wage_bysoc($r1['onetsoc_code'])->A_MEDIAN;
            return $r1; 
            }
        }
        log_message('error', 'Orgmodel->get_unit_soc() did not return a value.');
        return '';        
    }
    
    function get_unit_socs($org,$unit)
    {
        $this->odb->where('org_id',$org);
        $this->odb->where('unit_id',$unit);
        $this->odb->join('eduity_onet.occupation_data', 'occupation_data.onetsoc_code = organizations_units_jobs.onetsoc_code');
        $query = $this->odb->get('organizations_units_jobs');
        return $query->result();
    }  
    
    function get_occ_skills($org,$unit,$code) 
    {
        $this->odb->select('*');
        //If they have entered a custom title or description, return the custom values
        $this->odb->select("IF(organizations_units_jobs_skills.element_name IS NULL or organizations_units_jobs_skills.element_name = '', content_model_reference.element_name, organizations_units_jobs_skills.element_name) as element_name ",FALSE);
        $this->odb->select("IF(organizations_units_jobs_skills.description IS NULL or organizations_units_jobs_skills.description = '', content_model_reference.description, organizations_units_jobs_skills.description) as description ",FALSE);
        $this->odb->where('org_id',$org);
        $this->odb->where('unit_id',$unit);
        $this->odb->where('oujob_id',$code);
        $this->odb->order_by('order');
        $this->odb->join('eduity_onet.content_model_reference','content_model_reference.element_id = organizations_units_jobs_skills.element_id');

        $query = $this->odb->get('organizations_units_jobs_skills');
 
        if ($query->num_rows() > 0) {
            return $query->result(); 
        }
        log_message('error', 'Orgmodel->get_unit_soc() did not return a value.');
        return '';    
    }
   
    function get_soc_default_type($soc,$type)
    {
        $this->onet->where($type.'.onetsoc_code',$soc);
     //   $this->onet->where($type.'.not_relevant !=','Y');
        $this->onet->join('content_model_reference','content_model_reference.element_id = '.$type.'.element_id');
        $this->onet->group_by('element_name');
        $query = $this->onet->get($type);
        return $query->result();
    }   
    
    function get_soc_default_skills($soc)
    {
        $this->onet->where('skills.onetsoc_code',$soc);
        $this->onet->where('skills.not_relevant !=','Y');
        $this->onet->join('content_model_reference','content_model_reference.element_id = skills.element_id');
        $query = $this->onet->get('skills');
        return $query->result();
    }
    
    function get_soc_default_knows($soc)
    {
        $this->onet->where('knowledge.onetsoc_code',$soc);
        $this->onet->where('knowledge.not_relevant !=','Y');
        $this->onet->join('content_model_reference','content_model_reference.element_id = knowledge.element_id');
        $query = $this->onet->get('knowledge');
        return $query->result();
    }    
    
    function add_soc_default_skills($org,$unit,$soc,$code)
    {    
        $skills = $this->get_soc_default_skills($soc);
        
        $i=0;
        
        foreach ($skills as $skill) {                    
        $data['org_id'] = $org;
        $data['unit_id'] = $unit;
        $data['oujob_id'] = $code;
        $data['onetsoc_code'] = $soc; 
        $data['element_id'] = $skill->element_id;
        $data['element_name'] = $skill->element_name;
        $data['description'] = $skill->description;
        $data['order'] = $i; $i++;
        $this->odb->insert('organizations_units_jobs_skills',$data);     
        }
       
    } 
    
    function reorder_skills($get,$order)
    {
        foreach ($order as $key => $skill) {
            $this->odb->where('org_id',$get->org);
            $this->odb->where('unit_id',$get->unit);
            $this->odb->where('oujob_id',$get->code);
            $this->odb->where('oujs_id',$skill); 
            $this->odb->update('organizations_units_jobs_skills',array('order' => $key));           
        }
    }
    
    function add_unit($orgid,$parent,$data)
    {
        unset($data['add_unit']);
        unset($data['parent_id']);
        $data['parent_id'] = $parent;
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