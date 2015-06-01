<?php
/**
 * ark Admin Panel for Codeigniter 
 * Author: Abhishek R. Kaushik
 * downloaded from http://devzone.co.in
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Organization extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('userlib');
        $this->load->library('encrypt');
        $this->load->library('widget');
        $this->load->library('script');
        
        $this->load->helper('data_helper');
        $this->load->model('account/account_model');
        $this->load->model('Orgmodel','orgmodel');
        $this->load->model('Usermodel','usermodel');
        $this->load->model('onetmodel','onet');
 		$this->load->helper('url');
 		$this->load->helper('form');
        $this->lang->load('label', 'english');
       


		//if not logged-in redirect to home
		if($this->account_model->is_logged_in() == FALSE)
		{
			redirect(base_url());
		}
		//if not verified
		if($this->account_model->is_verified() == FALSE)
		{
			//redirect to unverified account page				
			redirect(base_url().'unverifiedAccount');
		}
		//save logged-in user id and profile id for using in script
		$this->userid = $this->session->userdata('userid');
		$this->profileid = $this->session->userdata('profileid');

        $this->get = $this->userlib->decode_segment('4');
        
       // print_r($this->get); die();
       
        
        $this->user = $this->userlib->user;
        $this->profile = $this->userlib->get_profile($this->user);
        $this->menu['org_menu'] = $this->userlib->org_menu();
        $this->menu['pg'] = 'org';
        $this->menu['base'] = base_url();
        $this->load->library('../controllers/user/dashboard');
    }
    
    public function index()
    {

        redirect('user/dashboard');
    }
    
    public function create()
    {
        if ($this->input->post()) {
            $oid = $this->orgmodel->create_org($this->input->post(),$this->userid); 
            
            $this->profile_model->add_permit_org($oid,$this->userid,'1111'); // owner,read,write,delete
                     
            redirect('user/organization/view/org/'.$oid);
        }       
        
        $data['box_title'] = 'Create Organization';
        
        $this->dashboard->load_template('user/organization/org_form.tpl',$data,'orgn');       
    }
    
    public function settings()
    {
        if ($this->input->post()) {
            $oid = $this->orgmodel->create_org($this->input->post(),$this->userid);          
            redirect('user/organization/settings/org/'.$oid);
        }       
        
        $data['box_title'] = 'Create Organization';
        
        $this->dashboard->load_template('user/organization/org_settings.tpl',$data,'orgn');       
    }

    public function view() 
    {      
        // Security Check_        
       // $this->userlib->check_acl('ORG',$this->user,$this->get->org,'RO');
        // Passed security check, continue
        // Pull organization information
        $data = $this->orgmodel->get_org($this->get->org);  

        $data['query_str'] = $this->getquery($this->get->org,'0');
        $data['base'] = $this->menu['base'];
        $data['content'] = $this->widget->org_map($this->orgmodel->get_unit_map($this->get->org),$data);
        $data['info_panel'] = $this->widget->org_info_panel($data);
        
        $data['page_title'] = $data['org_name'];
        
        // Assign and show template  
        $out = $this->smarty->view( 'user/organization/org_view.tpl', $data,true);
        
        $this->dashboard->load_content($out,$data,'orgn');
    }
    
    

    public function units()
    {                    
        // Security Check_
        $this->userlib->check_acl('UNT',$this->get->org,$this->get->unit,'RO');
        // Passed security check, continue
        // Grab unit information
        $udata = $this->orgmodel->get_unit($this->get->unit);
        // Grab org information
        $odata = $this->orgmodel->get_org($this->get->org);
        // Merge with unit information for display
        $data = array_merge($udata,$odata);
        // Set additional variables for display
        //$data['unit_id'] = $this->userlib->encode($data['unit_id']);
        $data['unit_info_panel'] = $this->widget->unit_info_panel($this->orgmodel->get_unit($this->get->unit),$this->getquery());
        $data['query_str'] = $this->getquery();
        $data['base'] = $this->menu['base'];
        // Create breadcrumb links for easy navigation
        $data['crumbs'] = $this->unitcrumbs($this->orgmodel->get_bcpath($this->get->unit));
        
        $data['jobs'] = '';       
        foreach ($this->orgmodel->get_unit_socs($this->get->org,$this->get->unit) as $job) {
            $data['jobs'] .= '<tr style="cursor: pointer;" onclick="window.document.location=\''. site_url('user/organization/viewocc/'. $this->getquery(false,false,$job->oujob_id)) .'\';"><td>'.$job->onetsoc_code.'</td><td>'.$job->title.'</td><td>'.substr($job->description, 0, 200).'</td><td><a href="" title="View"> <i class="fam-zoom"></i></a><a href="" title="Edit"><i class="fam-user-edit"></i></a></td></tr>';
        }   
        
        $data['org'] = $this->get->org;
        $data['unit'] = $this->get->unit;
        $data['page_title'] = 'XYZ Corporation';
        $data['box_title'] = 'Plant A';
        $data['unit_updates'] = $this->widget->like_increase('70%','26','Ratings Increase','An increasae of 70%');
        
        
        // Assign and display template
        $out = $this->smarty->view( 'user/organization/viewunit.tpl', $data, true );   
        
        $this->dashboard->load_content($out,$data,'orgn');     
    }
    
    function onetsoc_search()
    {
        if ($this->input->post('string')) {
            switch ($this->input->post('options')) {
                case 'options':
                // Standard search
                $jobs = $this->onet->search_jobs_by_title($this->input->post('string'));
                break;
                case 'title':
                // search title and common names
                $jobs = $this->onet->search_jobs_by_title($this->input->post('string'));
                break;
                case 'description':
                // search description
                $jobs = $this->onet->search_jobs_by_descr($this->input->post('string'));
                break;
                case 'SOC_Code':
                // by soc code
                $jobs = $this->onet->search_jobs_by_soc($this->input->post('string'));
                break;
            }
            
	       if ($jobs) {
	           $data['results'] = $jobs;
            //$common = $this->onet->get_common_bysoc($job->onetsoc_code);
           } else { $data['results'] = array(); }            
        }
                // Assign and display template
               // print_r($data); die();
                
        $data['search'] = $this->input->post('string');
        $data['query_str'] = $this->getquery();
        $out = $this->smarty->view( 'user/organization/search_results.tpl', $data, true );   
        
        $this->dashboard->load_content($out,$data,'orgn');     
        }
        
    
  
    public function previewsoc()
    {
       // Security Check_
        $this->userlib->check_acl('UNT',$this->get->org,$this->get->unit,'RO');
        // Passed security check, continue

        $job = $this->onet->get_job_common($this->get->code,$this->get->common);
        $jd = $this->onet->get_basic_bysoc($this->get->code);
        $job->common = $this->onet->list_common($this->get->code);

        $data = $this->getview();
        $data['baseme'] = site_url('/user/organization/previewsoc/');
        $data['org_name'] = $this->orgmodel->org_name($this->get->org);

        $buttons = '<tr><td></td><td><a id="link" href="'.site_url('/user/organization/addsoc/'.$this->getquery()) .'/common/'.$this->get->common.'" class="btn btn-info" role="button">Use '.$this->lang->line('orgocc').'</a></td></tr>';

        $data['pageh'] = '<h1>Preview '.$this->lang->line('orgocc').'</h1>';
        $data['occ_info_panel'] = $this->widget->occ_preview_panel($job,$this->getquery(),$buttons);
        $data['generic_info_panel'] = $this->widget->occ_preview_panel2($jd,$this->getquery());      


        $out = $this->smarty->view( 'user/organization/previewocc.tpl', $data, true );   
        
        $this->dashboard->load_content($out,$data,'orgn');         
    }
    
    public function update_forecast()
    {        
    if ($this->orgmodel->update_forecast($this->get,$this->input->post())) {
        $yes[] = array(
            'success' => 'true',
            'msg' => 'update success for',
            'value' => $this->input->post('value')
        );
        echo json_encode($yes);
    } else {
        $no[] = array(
            'success' => 'false',
            'msg' => 'update failed',
            'value' => $this->input->post('value')
        );
        echo json_encode($no);        
    }   
    }
    
    
    public function del_forecast()
    {
        $this->orgmodel->del_forecast($this->get);     
        redirect(site_url('user/organization/forecast/'. $this->getquery()));
    }
    
    public function forecast()
    {
        // Security Check_
        $this->userlib->check_acl('UNT',$this->get->org,$this->get->unit,'RO');
        // Passed security check, continue

        //$data = $this->getview();
//        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);
        // Create breadcrumb links for easy navigation
        $data['jobs'] = '';        
        $data['crumbs'] = $this->unitcrumbs($this->orgmodel->get_bcpath($this->get->unit));
        $data['query_str'] = $this->getquery(); 
        $data['baseme'] = site_url('/user/organization/viewocc/');
        $data['org_name'] = $this->orgmodel->org_name($this->get->org);
        $data['info_panel'] = $this->widget->forecast_info_panel($this->orgmodel->get_unit_soc($this->get->org,$this->get->unit,$this->get->code,true),$this->getquery());      
        $data['update'] = "'".site_url('/user/organization/update_forecast/'.$this->getquery())."'";
        $data['baseme'] = site_url('/user/organization/viewocc/');
        $data['script'] = $this->script->editable();  

        $data['content'] = $this->widget->forecast_details($this->orgmodel->list_or_create_forecast($this->get));

        // Assign and display template
        $this->smarty->assign('pg','org');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/org_view.tpl', $data );      
    }    
    
    public function addsoc()
    {
    //    print_r($this->input->post()); die();
    $common = $this->onetmodel->get_common_byid($this->input->post('common'))->common_name;
    
    $code = $this->orgmodel->add_soc($this->input->post('org'),$this->input->post('unit'),$this->input->post('code'),$common);
        
    $get = $this->getquery($this->input->post('org'),$this->input->post('unit'),$code);    
        
    redirect('user/organization/viewocc/'.$get);  
        
    }
    
    public function getview()
    {
        $data = $this->getbasic();
        $data['tabcontent'] = $this->widget->make_list('work_activities',$this->getquery(),'Activities');
        $data['feedurl']['knowledge'] = "'http://localhost/user/organization/get_feed/type/knowledge/org/1/unit/25/code/32'";
        $data['feedurl']['work_context'] = "'http://localhost/user/organization/get_feed/type/work_context/org/1/unit/25/code/32'";
        $data['feedurl']['work_values'] = "'".site_url("/user/organization/get_feed/type/work_values/".$this->getquery())."'";
        $data['feedurl']['work_activities'] = "'".site_url("/user/organization/get_feed/type/work_activities/".$this->getquery())."'";
        $data['feedurl']['skills'] = "'".site_url("/user/organization/get_feed/type/skills/".$this->getquery())."'";
        return $data;
    }
    
    public function getbasic()
    {
        $data['query_str'] = $this->getquery();
        $data['base'] = $this->menu['base'];
//        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);
        // Create breadcrumb links for easy navigation
        $data['jobs'] = '';        
        $data['crumbs'] = $this->unitcrumbs($this->orgmodel->get_bcpath($this->get->unit));
        $data['org'] = $this->get->org;
        $data['unit'] = $this->get->unit;
        
        return $data;
    }
    
    public function viewocc()
    {
        // Security Check_
        $this->userlib->check_acl('UNT',$this->get->org,$this->get->unit,'RO');
        // Passed security check, continue

        $data = $this->getview();
        
        $data['baseme'] = site_url('/user/organization/viewocc/');
        $data['org_name'] = $this->orgmodel->org_name($this->get->org);
        $data['occ_info_panel'] = $this->widget->occ_info_panel($this->orgmodel->get_unit_soc($this->get->org,$this->get->unit,$this->get->code,true),$this->getquery());
        $data['pageh'] = '<h1>View '.$this->lang->line('orgocc').'</h1>';
        $data['generic_info_panel'] ='';    
        $data['script'] = $this->script->sortable();  
        $data['update'] = "'".site_url('/user/organization/update_occ_subset/'.$this->getquery())."'";
        
        //$data['update'] = "'post'";
        $data['tabcontent'] = $this->widget->sortedit(array('Soc Code','Title','Description'),$this->orgmodel->get_occ_skills($this->get->org,$this->get->unit,$this->get->code));

        // Assign and display template
        $out = $this->smarty->view( 'user/organization/viewocc.tpl', $data, true );   
        
        $this->dashboard->load_content($out,$data,'orgn');     
        
    }
    
    public function update_occ_subset()
    {
       // print_r($this->input->post());
        if ($this->input->post('dofunction') == 'reorder') {
            switch ($this->input->post('subset')) {
                case 'skills':
                $this->orgmodel->reorder_skills($this->getqvals(),explode(",",$this->input->post('order')));
                
                
                break;
            }
        }   
    }
    


    public function get_feed()
    {
        if (!is_numeric($this->get->code)) {
        //code is onet format
       } else {
        // code is internal id format
            $x = $this->orgmodel->get_unit_soc($this->get->org,$this->get->unit,$this->get->code);
            $this->get->code = $x['onetsoc_code'];
        }
    
        //List of all fields that can be sortable. This is Optional.
        //This prevents that a user sorts by a column that we dont want him to access, or that doesnt exist, preventing errors.
        $valid_fields = array(
            'element_name',
            'description',
            'element_id'
        );
        
        $perpage = '18';
        $page = ($this->input->post('page') - 1);
    
        
        $start = ($page * $perpage);
        
        $records = $this->orgmodel->get_soc_default_type($this->get->code,$this->get->type);
       // print_r($records);
        $numrecs = count($records);
        $split = array_chunk((array)$records,$perpage);
      //  echo "spages: ". $split ."<br />";
        $show = (object)$split[$page];
       // print_r($show); die();
        
        $this->flexigrid->validate_post('element_id', 'asc', $valid_fields);
        
        if (!in_array($this->get->type,array('skills','knowledge','work_styles','work_values','work_context','work_activities'))) {
            $this->get->type = 'work_activities';
        }
        
        $records['records'] = $show;  
        $records['record_count'] = $numrecs;
        $records['footmsg'] = 'test';
        
        $this->output->set_header($this->config->item('json_header'));
        
        /*
         * Json build WITH json_encode. If you do not have this function please read
         * http://flexigrid.eyeviewdesign.com/index.php/flexigrid/example#s3 to know how to use the alternative
         */
        $record_items = array();
        foreach ($records['records'] as $row) {
            $record_items[] = array(
            $row->element_id,
                $row->element_name,
                $row->description,
                $row->element_id,
                '<a href=\'#\'><img border=\'0\' src=\'' . $this->config->item('base_url') . 'assets/flexigrid/images/close.png\'></a> '
            );
        }
        
      //  print_r($records); die();
        
        //Print please
        $this->output->set_output($this->flexigrid->json_build($records['record_count'], $record_items, $records['footmsg']));
    } 


    public function occ_oper()
    {
        
       // print_r($this->get); die();
        switch($this->get->func) {
            case 'edit':
        // Security Check
        //$this->userlib->check_acl('UNT',$this->user,$this->get->unit,'RW'); 
        // Passed check
        // If submitting form proceed to save routine       
        if ($this->input->post('save_edits')) {
            $this->orgmodel->update_occ($this->get->code,$this->input->post());
            redirect('user/organization/viewocc/'.$this->getquery());         
        }       
        // Otherwise get occupation data
        $data['org_name'] = $this->orgmodel->org_name($this->get->org);

        $data['edit_form'] = $this->widget->edit_occ(site_url('user/organization/occ_oper/func/edit/'. $this->getquery()),$this->orgmodel->get_unit_soc($this->get->org,$this->get->unit,$this->get->code));
 

        // Create breadcrumb links for easy navigation
        $data['crumbs'] = $this->unitcrumbs($this->orgmodel->get_bcpath($this->get->unit));        
        $data['query_str'] = $this->getquery();
        $data['base'] = $this->menu['base'];
//        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);
        // Load template
        $this->smarty->assign('pg','org');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/edit-common.tpl', $data );  
            break;
            case 'delete':
            $this->orgmodel->delete_occ($this->get->code);
            redirect('user/organization/units/'.$this->getquery());
            break;
            case 'clone':
            die("NOT IMPLEMENTED");
            break;
            default:
            redirect('user/dashboard');
            break;
        }
        
    }


    

    
    public function add_unit()
    {
        if ($this->get->unit == '0') {
            // Home is parent, adding to Tier 1
            // Security Check
            $this->userlib->check_acl('ORG',$this->user,$this->get->org,'RW'); 
        } else {
            // Another unit is the parent, adding to Tier 2+
            // Security Check
            $this->userlib->check_acl('UNT',$this->user,$this->get->unit,'RW'); 
        }

        // Passed check, get org info
        $data = $this->orgmodel->get_org($this->get->org);  
                
        // When user submits form...
        if ($this->input->post('add_unit')) {
            // Save new unit
            $id = $this->orgmodel->add_unit($this->get->org,$this->get->unit,$this->input->post());
            // Auto grant read/write access to creator
            $this->userlib->grant_rw_access('UNT',$this->user,$id);
            // Redirect to view new unit
            redirect('/user/organization/units/'. $this->getquery($this->get->org,$id));
        } 
        // Otherwise display add unit page
        $data['query_str'] = $this->getquery();
//        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);

        // Create breadcrumb links for easy navigation
        if ($this->get->unit == '0') {
                $data['crumbs'] = '<a href="'. base_url() .'user/organization/view/'. $this->userlib->encode_query(array('org' => $this->get->org,'unit' => '0')) .'">Home</a>';

            } else { 
                $data['crumbs'] = $this->unitcrumbs($this->orgmodel->get_bcpath($this->get->unit));
            }
                 
        
        $this->smarty->assign('pg','org');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/addunit.tpl', $data );          
        
        
    }
    
    public function del_unit()
    { 
        // Security Check
        $this->userlib->check_acl('UNT',$this->user,$this->get->unit,'RW'); 
        // Passed check
        // Delete the unit
        $this->orgmodel->delete_unit($this->get->unit);
        // Go back to org home
        redirect('user/organization/view/'. $this->getquery($this->get->org,'0'));
    }
    
    public function edit_unit()
    { 
        // Security Check
        $this->userlib->check_acl('UNT',$this->user,$this->get->unit,'RW'); 
        // Passed check
        // If submitting form proceed to save routine       
        if ($this->input->post('save_unit')) {
            $this->orgmodel->update_unit($this->get->unit,$this->input->post());
            redirect('user/organization/units/'.$this->getquery());         
        }       
        // Otherwise get unit data
        $udata = $this->orgmodel->get_unit($this->get->unit);
        $odata = $this->orgmodel->get_org($this->get->org);
        $data = array_merge($udata,$odata);
        // Create breadcrumb links for easy navigation
        $data['crumbs'] = $this->unitcrumbs($this->orgmodel->get_bcpath($this->get->unit));        
        $data['query_str'] = $this->getquery();
        $data['base'] = $this->menu['base'];
//        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);
        // Load template
        $this->smarty->assign('pg','org');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/editunit.tpl', $data );                     
    }
    

    
    function unitcrumbs($bread)
    {
    $out = '<a href="'. base_url() .'user/organization/view/'. $this->getquery($bread['0']['org_id'],'0') .'">Home</a> ';
        foreach ($bread as $crumb) {
            $out .= ' &gt; <a href="'. base_url() .'user/organization/units/'. $this->getquery($bread['0']['org_id'],$crumb['unit_id']) .'">'.$crumb['unit_title'].'</a>';          
        }
    return $out;
    }
    
    function enc($data)
    {
        return $this->userlib->encode($data);
    }
    
    function segval()
    {
        return $this->userlib->decode($this->uri->segment('4'));
    }
    
    function check_acl($type, $privs = 'RO')
    {
        switch ($type) {
            case 'ORG':
            
            break;
            case 'UNT':
            $this->userlib->check_acl($type,$this->user,$this->get->unit,$privs); 
            break;
        }
    }
    
    // Generates URL Query string for controller functions
    
    function getquery($org = false, $unit = false, $code = false)
    {
        $out['org'] = $org ?: $this->get->org;
        
        if (!$unit) {
            // no unit specified, check query string
            if (isset($this->get->unit)) { $out['unit'] = $this->get->unit; }
            else { $out['unit'] = '0'; }
        } else { $out['unit'] = $unit; }
        
        if ($code) $out['code'] = $code;
        elseif (isset($this->get->code)) $out['code'] = $this->get->code;
       // else $out['code'] = '0';
        return $this->uri->assoc_to_uri($out);
    }

    function getqvals($obj = false)
    {
        $a = new stdClass();
        $a->org = isset($this->get->org) ? $this->get->org : '0';
        $a->unit = isset($this->get->unit) ? $this->get->unit : '0';
        $a->code = isset($this->get->code) ? $this->get->code : '0';
        return $a;
    }

    function control_areas(){
        $term = $this->input->post('data', TRUE);
        $countries = $this->omodel->get_areas($term);
        echo json_encode($countries);
    }   
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */