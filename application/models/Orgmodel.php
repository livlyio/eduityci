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
        $this->onet = $this->load->database('onetdb', TRUE);
        $this->load->model('onetmodel');
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
    
    function new_forecast($org,$unit,$occ)
    {
        $data = array('org_id' => $org,'unit_id' => $unit,'ouj_id' => $occ,'title' => 'Forecast Title','least' => '0','likely' => '0','most' => '0','projected' => '0000-00-00','notes' => '');
        $data['created'] = date("Y-m-d");
        $this->odb->insert('organizations_units_jobs_forecasts',$data);      
    }
    
    function update_forecast($get,$data)
    {
        $update[$data['name']] = $data['value'];
        $this->odb->where('org_id',$get->org);
        $this->odb->where('unit_id',$get->unit);
        $this->odb->where('ouj_id',$get->code);
        $this->odb->where('fc_id',$data['pk']);
        return $this->odb->update('organizations_units_jobs_forecasts',$update);      
    }
    
    function list_or_create_forecasts($org,$unit,$occ)
    {
        $list = $this->list_forecasts($org,$unit,$occ);
        if (!$list) {
            $this->new_forecast($org,$unit,$occ);
            $list = $this->list_forecasts($org,$unit,$occ);
        }
        return $list;   
    }
    
    function get_forecast_byid($fid)
    {
        
    }
    
    function list_forecasts($org,$unit,$occ)
    {
        $this->odb->where('org_id',$org);
        $this->odb->where('unit_id',$unit);
        $this->odb->where('ouj_id',$occ);
        $query = $this->odb->get('organizations_units_jobs_forecasts');
        
        return ($query->num_rows() > 0) ? $query->result() : false;
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
        
       // print_r($skills); die();
        
        foreach ($skills as $skill) {                    
        $data['org_id'] = $org;
        $data['unit_id'] = $unit;
        $data['oujob_id'] = $code;
        $data['onetsoc_code'] = $soc; 
        $data['element_id'] = $skill->element_id;
        $data['element_name'] = $skill->element_name;
        $data['description'] = $skill->description;
        $this->odb->insert('organizations_units_jobs_skills',$data);     
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