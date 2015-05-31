<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Widget {

	function Widget()
	{
		$this->widget_dir = APPPATH . "views/widgets";
        
		// Assign CodeIgniter object by reference to CI
			$this->CI =& get_instance();

		log_message('debug', "Widget Class Initialized");
	}

    function org_map($map,$data)
    {
        $data['map'] = $this->printTree($map);
        return $this->CI->load->view('widgets/orgmap',$data,TRUE); ;
    }

    function printTree($array,$child = '0'){
    $out = "<ul>\n";
    foreach($array as $item){
        if(is_array($item) && isset($item['unit_title'])){
                if(isset($item['children']) && is_array($item['children'])){
                    $out .= "<li><a href=\"". site_url('user/organization/units/'. $this->CI->uri->assoc_to_uri(array('org' => $item['org_id'],'unit' => $item['unit_id']))) ."\">".$item['unit_title']."</a>";
                    $out .= $this->PrintTree($item['children'],'1');
                    $out .= "</li>\n";
                } else {
                    $out .= "<li><a href=\"". site_url('user/organization/units/'. $this->CI->uri->assoc_to_uri(array('org' => $item['org_id'],'unit' => $item['unit_id']))) ."\">".$item['unit_title']."</a></li>\n";
                }   
        }  
    }
    $out .= "</ul>\n\n";
    return $out;
    }    
    
    function sortedit($heads,$data)
    {
        $arr['headings'] = $heads;
        $arr['items'] = $data;
        
     return $this->CI->load->view('widgets/sortable-editable',$arr,TRUE);     
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
    
    function unit_info_panel($data,$querystr)
    {
     //   $querystr = $data['query_str'];
    $arr['options']['color'] = 'blue';
    $arr['options']['title'] = 'Unit Profile'; 
    $arr['options']['width'] = '700px';
    $arr['options']['height'] = 'auto'; 
    $arr['data']['0']['name'] = 'Unit Name:';
    $arr['data']['0']['value'] = $data['unit_title'];    
    $arr['data']['1']['name'] = 'Description:';
    $arr['data']['1']['value'] = $data['unit_desc']; 
    $arr['data']['2']['name'] = 'Location:';
    $arr['data']['2']['value'] = $data['unit_location']; 
    $arr['data']['3']['name'] = 'Website:';
    $arr['data']['3']['value'] = $data['unit_website'];   
    $arr['buttons'] = '<tr><td></td><td><a href="'. site_url('/user/organization/edit_unit/'. $querystr) .'" class="btn btn-warning" role="button"><i class="fa fa-pencil-square-o"></i>&nbsp; Edit Attributes</a> &nbsp; &nbsp; 
    <a href="'. site_url('user/organization/add_unit/'. $querystr) .'" class="btn btn-info" role="button"><li class="fa fa-plus-square"></li>&nbsp; Add Unit</a> &nbsp;&nbsp; 
    <a href="'. site_url('user/organization/del_unit/'. $querystr) .'" class="btn btn-danger" role="button" onclick="javascript:return confirm(\'Are you sure you want to delete this item?\')"><i class="fa fa-times"></i>&nbsp; Delete Unit</a></td></tr>';

    return $this->CI->load->view('widgets/data-panel',$arr,TRUE);     
    }    

    function occ_preview_panel($data,$querystr,$buttons)
    {
    $arr['options']['color'] = 'blue';
    $arr['options']['title'] = $this->CI->lang->line('orgocc').' Profile'; 
    $arr['options']['width'] = '800px';
    $arr['options']['height'] = 'auto'; 
    $arr['data']['0']['name'] = $this->CI->lang->line('orgocc').' Name:';
    $arr['data']['0']['value'] = $data->ctitle;    
    $arr['data']['1']['name'] = 'Description:';
    $arr['data']['1']['value'] = $data->description; 
    $arr['data']['2']['name'] = 'ONET SOC Code:';
    $arr['data']['2']['value'] = $data->onetsoc_code;
    $arr['data']['3']['name'] = 'Other Titles:';
    $arr['data']['3']['value'] = $data->common; 
    $arr['data']['4']['name'] = 'Industry:';
    $arr['data']['4']['value'] = $data->title;     
       
    if (isset($data->onetsoc_code_suffix) && $data->onetsoc_code_suffix != '') { $arr['data']['2']['value'] .= '-'. $data->onetsoc_code_suffix; } 
    
    $arr['buttons'] = $buttons;
   
    return $this->CI->load->view('widgets/data-panel-multi',$arr,TRUE); 
 }
 
 function occ_preview_panel2($data,$querystr) {
    $arr2['options']['color'] = 'blue';
    $arr2['options']['title'] = 'Other Information'; 
    $arr2['options']['width'] = '800px';
    $arr2['data']['4']['name'] = 'Industry:';
    $arr2['data']['4']['value'] = 'data'; 
    $arr2['data']['5']['name'] = 'Average Wage:';
    $arr2['data']['5']['value'] = '$'.$data->A_MEDIAN;
    $arr2['data']['6']['name'] = 'Zone:';
    $arr2['data']['6']['value'] = 'data';    
    $arr2['data']['7']['name'] = 'Other:';
    $arr2['data']['7']['value'] = 'data'; 
    $arr2['data']['8']['name'] = 'Other:';
    $arr2['data']['8']['value'] = 'data';
    $arr2['buttons'] = '';
    
    $out = $this->CI->load->view('widgets/data-panel',$arr2,TRUE); 

    return $out;     
    }

    function short_occ_info_panel($data,$querystr,$buttons = true)
    {
         
    $arr['query_str'] = $querystr;   
    $arr['table_title'] = $this->CI->lang->line('orgocc').' Forecasts';
    $arr['options']['color'] = 'blue';
    $arr['options']['title'] = $this->CI->lang->line('orgocc').' Profile'; 
    $arr['options']['width'] = '900px';
    $arr['options']['height'] = 'auto'; 
    $arr['data']['0']['name'] = $this->CI->lang->line('orgocc').' Name:';
    $arr['data']['0']['value'] = $data->title;    
    $arr['data']['2']['name'] = 'ONET SOC Code:';
    $arr['data']['2']['value'] = $data->onetsoc_code;
            
    if (isset($data->onetsoc_code_suffix) && $data->onetsoc_code_suffix != '') { $arr['data']['2']['value'] .= '-'. $data->onetsoc_code_suffix; } 

    if ($buttons) $arr['buttons'] = '<tr><td></td><td><a href="'. site_url('/user/organization/occ_oper/func/edit/'. $querystr) .'" class="btn btn-warning" role="button"><i class="fa fa-pencil-square-o"></i>&nbsp; Edit Attributes</a> &nbsp; &nbsp; <a href="'. site_url('user/organization/occ_oper/func/clone/'. $querystr) .'" class="btn btn-info" role="button">Clone</a> &nbsp;&nbsp; <a href="'. site_url('user/organization/occ_oper/func/delete/'. $querystr) .'" class="btn btn-danger" role="button" onclick="javascript:return confirm(\'Are you sure you want to delete this occupation?\')"><i class="fa fa-times"></i>&nbsp; Delete '.$this->CI->lang->line('orgocc').'</a></td></tr>';
  
    return $this->CI->load->view('widgets/data-panel',$arr,TRUE);     
    }

    function forecast_info_panel($occ,$querystr,$buttons = true)
    {
         
    $arr['query_str'] = $querystr;   
    $arr['table_title'] = $this->CI->lang->line('orgocc').' Forecast';
    $arr['options']['color'] = 'blue';
    $arr['options']['title'] = $this->CI->lang->line('orgocc').' Profile'; 
    $arr['options']['width'] = '900px';
    $arr['options']['height'] = 'auto'; 
    $arr['data']['0']['name'] = 'Forecast For:';
    $arr['data']['0']['value'] = $occ->title;    
    $arr['data']['2']['name'] = 'Effective Date:';
    $arr['data']['2']['value'] = date("Y-m-d");
            
   // if (isset($data->onetsoc_code_suffix) && $data->onetsoc_code_suffix != '') { $arr['data']['2']['value'] .= '-'. $data->onetsoc_code_suffix; } 

    if ($buttons) $arr['buttons'] = '<tr><td></td><td><a href="'. site_url('/user/organization/occ_oper/func/edit/'. $querystr) .'" class="btn btn-warning" role="button"><i class="fa fa-pencil-square-o"></i>&nbsp; Edit Attributes</a> &nbsp; &nbsp; <a href="'. site_url('user/organization/occ_oper/func/clone/'. $querystr) .'" class="btn btn-info" role="button"><i class="fa fa-refresh"></i>&nbsp; Clone</a> &nbsp;&nbsp; <a href="'. site_url('user/organization/occ_oper/func/delete/'. $querystr) .'" class="btn btn-danger" role="button" onclick="javascript:return confirm(\'Are you sure you want to delete this occupation?\')"><i class="fa fa-times"></i>&nbsp; Delete '.$this->CI->lang->line('orgocc').'</a></td></tr>';
  
    return $this->CI->load->view('widgets/data-panel',$arr,TRUE);     
    }



    function occ_info_panel($data,$querystr,$buttons = true)
    {
    $arr['options']['color'] = 'blue';
    $arr['options']['title'] = $this->CI->lang->line('orgocc').' Profile'; 
    $arr['options']['width'] = '800px';
    $arr['options']['height'] = 'auto'; 
    $arr['data']['0']['name'] = $this->CI->lang->line('orgocc').' Name:';
    $arr['data']['0']['value'] = $data->title;    
    $arr['data']['1']['name'] = 'Description:';
    $arr['data']['1']['value'] = $data->description; 
    $arr['data']['2']['name'] = 'ONET SOC Code:';
    $arr['data']['2']['value'] = $data->onetsoc_code;
    $arr['data']['3']['name'] = 'Other Titles:';
    $arr['data']['3']['value'] = $data->common; 
    $arr['data']['4']['name'] = 'Industry:';
    $arr['data']['4']['value'] = $data->title;           
    $arr['data']['5']['name'] = 'Wage:';
    $arr['data']['5']['value'] = '$'.$data->wage;
            
    if (isset($data->onetsoc_code_suffix) && $data->onetsoc_code_suffix != '') { $arr['data']['2']['value'] .= '-'. $data->onetsoc_code_suffix; } 

    if ($buttons) $arr['buttons'] = '<tr><td></td><td><a href="'. site_url('/user/organization/forecast/'. $querystr) .'" class="btn btn-success" role="button"><i class="fa fa-bar-chart"></i>&nbsp; Forecast</a> &nbsp;
    <a href="'. site_url('/user/organization/occ_oper/func/edit/'. $querystr) .'" class="btn btn-warning" role="button"><i class="fa fa-pencil-square-o"></i>&nbsp; Edit Attributes</a> &nbsp; &nbsp; 
    <a href="'. site_url('user/organization/occ_oper/func/clone/'. $querystr) .'" class="btn btn-info" role="button"><i class="fa fa-refresh"></i>&nbsp; Clone</a> &nbsp;&nbsp; 
    <a href="'. site_url('user/organization/occ_oper/func/delete/'. $querystr) .'" class="btn btn-danger" role="button" onclick="javascript:return confirm(\'Are you sure you want to delete this item?\')"><i class="fa fa-times"></i>&nbsp; Delete '.$this->CI->lang->line('orgocc').'</a></td></tr>';
  
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
    
    function like_increase($percent,$number,$title,$description) {
        return $this->percent_info_box('fa-thumbs-o-up','bg-green',$title,$number,$percent,$description);
    }
    
    
    function percent_info_box($icon,$color,$title,$number,$progress,$description) {
        
        
        
    $out = '
              <div class="info-box '.$color.'">
                <span class="info-box-icon"><i class="fa '.$icon.'"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">'.$title.'</span>
                  <span class="info-box-number">'.$number.'</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: '.$progress.'"></div>
                  </div>
                  <span class="progress-description">
                    '.$description.'
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            </div>';
            
            return $out;
        
        
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
    
    function forecast_list($data)
    {
        if (!$data) return '';
        $arr['list'] = $data;
        return $this->CI->load->view('widgets/forecast',$arr,TRUE);
    }
    
    function forecast_details($data)
    {
        $arr['list'] = $data;
        return $this->CI->load->view('widgets/forecast_details',$arr,TRUE);
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

   function soc_skills_list($records,$querystr)
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
		$grid_js = build_grid_js('flex1',site_url("/user/organization/skill_feed/".$querystr),$colModel,'id','desc',$gridParams,$buttons);
		$data['js_grid'] = $grid_js;
		$data['version'] = "0.36";

		
		return $this->CI->load->view('widgets/standard-flexi-grid',$data,TRUE);        
    }    


  function make_list($type,$querystr,$title)
    {
        $this->CI->load->helper('flexigrid');
	
		/*
		 * 0 - display name
		 * 1 - width
		 * 2 - sortable
		 * 3 - align
		 * 4 - searchable (2 -> yes and default, 1 -> yes, 0 -> no.)
		 */

		$colModel['element_name'] = array('Name',300,TRUE,'left',1);
		$colModel['description'] = array('Description',800,TRUE,'left',1);
	//	$colModel['onetsoc_code'] = array('SOC Code',110,TRUE,'center',2);
		$colModel['element_id'] = array('ID',90,TRUE,'center',0);
//		$colModel['actions'] = array('Actions',80, FALSE, 'right',0);
		
		
		/*
		 * Aditional Parameters
		 */
		$gridParams = array(
		'width' => '1400',
		'height' => 400,
		'rp' => 15,
		'rpOptions' => '[10,15,20,25,40]',
		'pagestat' => 'Displaying: {from} to {to} of {total} items.',
		'blockOpacity' => 0.5,
		'title' => $title,
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
		$grid_js = build_grid_js('flexi_'.$type,site_url("/user/organization/get_feed/type/".$type."/".$querystr),$colModel,'id','desc',$gridParams,$buttons);
		$data['js_grid'] = $grid_js;
		$data['version'] = "0.36";
        $data['gridid'] = 'flexi_'.$type;

	//	return $data['js_grid'];
		return $this->CI->load->view('widgets/multi-flexi-grid',$data,TRUE);        
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