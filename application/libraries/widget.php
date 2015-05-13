<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Widget {

	function Widget()
	{
		$this->widget_dir = APPPATH . "views/widgets";
        
		// Assign CodeIgniter object by reference to CI
			$this->CI =& get_instance();

		log_message('debug', "Widget Class Initialized");
	}
    
    function org_info_panel($data)
    {
    $arr['options']['color'] = 'blue';
    $arr['options']['title'] = 'Organization Profile'; 
    $arr['options']['width'] = '600px';
    $arr['options']['height'] = 'auto'; 
    $arr['data']['0']['name'] = 'Company Name:';
    $arr['data']['0']['value'] = $data['org_name'];    
    $arr['data']['1']['name'] = 'Description:';
    $arr['data']['1']['value'] = $data['org_desc']; 
    $arr['data']['2']['name'] = 'Location:';
    $arr['data']['2']['value'] = $data['org_location']; 
    $arr['data']['3']['name'] = 'Website:';
    $arr['data']['3']['value'] = $data['website'];   
    return $this->CI->load->view('widgets/data-panel',$arr,TRUE);     
    }
    
    function unit_info_panel($data)
    {
    $arr['options']['color'] = 'blue';
    $arr['options']['title'] = 'Unit Profile'; 
    $arr['options']['width'] = '600px';
    $arr['options']['height'] = 'auto'; 
    $arr['data']['0']['name'] = 'Unit Name:';
    $arr['data']['0']['value'] = $data['unit_title'];    
    $arr['data']['1']['name'] = 'Description:';
    $arr['data']['1']['value'] = $data['unit_desc']; 
    $arr['data']['2']['name'] = 'Location:';
    $arr['data']['2']['value'] = $data['unit_location']; 
    $arr['data']['3']['name'] = 'Website:';
    $arr['data']['3']['value'] = $data['unit_website'];   
    return $this->CI->load->view('widgets/data-panel',$arr,TRUE);     
    }    

    function occ_info_panel($data,$querystr)
    {
    $arr['options']['color'] = 'blue';
    $arr['options']['title'] = 'Occupation Profile'; 
    $arr['options']['width'] = 'auto';
    $arr['options']['height'] = 'auto'; 
    $arr['data']['0']['name'] = 'Occupation Name:';
    $arr['data']['0']['value'] = $data['title'];    
    $arr['data']['1']['name'] = 'Description:';
    $arr['data']['1']['value'] = $data['description']; 
    $arr['data']['2']['name'] = 'ONET SOC Code:';
    $arr['data']['2']['value'] = $data['onetsoc_code'];
    if (isset($data['onetsoc_code_suffix']) && $data['onetsoc_code_suffix'] != '') { $arr['data']['2']['value'] .= '-'. $data['onetsoc_code_suffix']; } 
    $arr['buttons'] = '<tr><td></td><td><a href="'. site_url('/user/organization/occ_oper/func/edit/'. $querystr) .'" class="btn btn-warning" role="button">Edit Attributes</a> &nbsp; &nbsp; <a href="'. site_url('user/organization/occ_oper/func/clone/'. $querystr) .'" class="btn btn-info" role="button">Clone</a> &nbsp;&nbsp; <a href="'. site_url('user/organization/occ_oper/func/delete/'. $querystr) .'" class="btn btn-danger" role="button" onclick="javascript:return confirm(\'Are you sure you want to delete this occupation?\')">Delete Occupation</a></td></tr>';
  
    return $this->CI->load->view('widgets/data-panel',$arr,TRUE);     
    }

    function generic_info_panel($title,$data)
    {
    $arr['options']['color'] = 'grey';
    $arr['options']['title'] = $title;
    $arr['options']['height'] = 'auto'; 
    $arr['data'] = $data;
    return $this->CI->load->view('widgets/open-panel',$arr,TRUE);     
    } 
    
    function standard_table($title,$thead,$tbody)
    {
    $arr['color'] = 'grey';
    $arr['title'] = $title;
    $arr['height'] = 'auto'; 
    $arr['thead'] = $thead;
    $arr['tbody'] = $tbody;
    return $this->CI->load->view('widgets/standard-table',$arr,TRUE);     
    }   
    
    function edit_occ($post,$data)
    {       
    $arr['fields']['0'] = array('title' => 'Occupation Name','size' => '50','name' => 'title','value' => $data['title']);    
    $arr['fields']['1'] = array('title' => 'Description','type' => 'textbox', 'size' => '5','name' => 'description','value' => $data['description']);
    $arr['fields']['2'] = array('title' => 'Custom SOC Suffix','size' => '50','name' => 'onetsoc_code_suffix','value' => $data['onetsoc_code_suffix']);
        
    $arr['post'] = $post;
    $arr['title'] = 'Edit Occupation';
    
    return $this->CI->load->view('widgets/edit-form',$arr,TRUE); 
    }
    
    function skills_list($records,$querystr)
    {
        $this->CI->load->helper('flexigrid');
	
	/*	$options = '';
		foreach( $records as $v ) {
			$options .= $v['name'] . ';';
		}
		$options = substr($options, 0, -1);*/

		/*
		 * 0 - display name
		 * 1 - width
		 * 2 - sortable
		 * 3 - align
		 * 4 - searchable (2 -> yes and default, 1 -> yes, 0 -> no.)
		 */

		$colModel['element_name'] = array('Name',260,TRUE,'left',1);
		$colModel['description'] = array('Description',700,TRUE,'left',1);
	//	$colModel['onetsoc_code'] = array('SOC Code',110,TRUE,'center',2);
		$colModel['element_id'] = array('Skill ID',90,TRUE,'center',0);
		$colModel['actions'] = array('Actions',80, FALSE, 'right',0);
		
		
		/*
		 * Aditional Parameters
		 */
		$gridParams = array(
		'width' => 'auto',
		'height' => 400,
		'rp' => 15,
		'rpOptions' => '[10,15,20,25,40]',
		'pagestat' => 'Displaying: {from} to {to} of {total} items.',
		'blockOpacity' => 0.5,
		'title' => 'Occupational Skills',
		'showTableToggleBtn' => true
		);
		
		/*
		 * 0 - display name
		 * 1 - bclass
		 * 2 - onpress
		 */
		$buttons[] = array('Delete','delete','test');
		$buttons[] = array('separator');
		$buttons[] = array('Select All','add','test');
		$buttons[] = array('DeSelect All','delete','test');
		$buttons[] = array('separator');


		//Build js
		//View helpers/flexigrid_helper.php for more information about the params on this function
		$grid_js = build_grid_js('flex1',site_url("/user/organization/occ_feed/".$querystr),$colModel,'id','desc',$gridParams,$buttons);
		$data['js_grid'] = $grid_js;
		$data['version'] = "0.36";

		
		return $this->CI->load->view('widgets/standard-flexi-grid',$data,TRUE);        
    }    

/*	function __construct()
	{
	//	parent::__construct();

		$this->widget_dir = APPPATH . "views/widgets";
		$this->assign( 'APPPATH', APPPATH );
		$this->assign( 'BASEPATH', BASEPATH );

		// Assign CodeIgniter object by reference to CI
		if ( method_exists( $this, 'assignByRef') )
		{
			$ci =& get_instance();
			$this->assignByRef("ci", $ci);
		}

		log_message('debug', "Smarty Class Initialized");
	}*/
    
    }

?>