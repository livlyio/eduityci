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
        $this->load->library('flexigrid');
        $this->load->library('encrypt');
        $this->load->library('widget');
        $this->load->helper('data_helper');
        $this->load->helper('flexigrid');
        $this->load->model('Orgmodel','orgmodel');
        $this->load->model('Usermodel','usermodel');
        $this->load->model('onetmodel','onet');
 		$this->load->helper('url');
 		$this->load->helper('form');
       

        // Auth STDclass
  		$this->auth = new stdClass;
		// Load 'standard' flexi auth library by default.
		$this->load->library('flexi_auth');	
		// Check user is logged in.

        $this->get = $this->userlib->decode_segment('4');
        
       // print_r($this->get); die();
        
        $this->user = $this->userlib->user;
        $this->profile = $this->userlib->get_profile($this->user);
        $this->menu['org_menu'] = $this->userlib->org_menu();
        $this->menu['pg'] = 'org';
        $this->menu['base'] = base_url();
        
      //  print_r($this->menu); die();
        
        if (!$this->profile) {
            // User has no profile information, something went wrong.
            // Set a custom error message.
            log_message('error','No profile information existed for user: '. $this->user .' on dashboard, returned False.');
            $eid = $this->userlib->log_error('error','No profile exists for user: '. $this->user);
            $this->flexi_auth->set_error_message('There is an error with your account, please contact support. ERROR ID: '. $eid, TRUE);
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            $this->flexi_auth->logout();
            redirect('support');
        }

    }
    
    public function index()
    {

        redirect('user/dashboard');
    }

    public function view() 
    {      
        // Security Check_        
        $this->userlib->check_acl('ORG',$this->user,$this->get->org,'RO');
        // Passed security check, continue
        // Pull organization information
        $data = $this->orgmodel->get_org($this->get->org);  
        
        $data['org_info_panel'] = $this->widget->org_info_panel($data);
     
        // Additional Values for display
        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);
        $data['org_id'] = $this->userlib->encode($this->get->org);
        $data['query_str'] = $this->getquery($this->get->org,'0');
        $data['base'] = $this->menu['base'];
        $data['map'] = $this->userlib->PrintTree($this->orgmodel->get_unit_map($this->get->org));
        
        // Assign and show template  
        $this->smarty->assign("css",'<link rel="stylesheet" type="text/css" media="screen, print" href="'. site_url('/assets/css/slickmap.css') .'" />');
        $this->smarty->assign('pg','org');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/orghome.tpl', $data );
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
        $data['unit_info_panel'] = $this->widget->unit_info_panel($this->orgmodel->get_unit($this->get->unit));
        $data['query_str'] = $this->getquery();
        $data['base'] = $this->menu['base'];
        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);
        // Create breadcrumb links for easy navigation
        $data['jobs'] = '';
        
        foreach ($this->orgmodel->get_unit_socs($this->get->org,$this->get->unit) as $job) {
            $data['jobs'] .= '<tr style="cursor: pointer;" onclick="window.document.location=\''. site_url('user/organization/viewocc/'. $this->getquery(false,false,$job->oujob_id)) .'\';"><td>'.$job->onetsoc_code.'</td><td>'.$job->title.'</td><td>'.substr($job->description, 0, 200).'</td><td><a href="" title="View"> <i class="fam-zoom"></i></a><a href="" title="Edit"><i class="fam-user-edit"></i></a></td></tr>';
        }
        
      //  print_r($data['jobs']); die();
        
        $data['crumbs'] = $this->unitcrumbs($this->orgmodel->get_bcpath($this->get->unit));
        $data['org'] = $this->get->org;
        $data['unit'] = $this->get->unit;
        // Assign and display template
        $this->smarty->assign('pg','org');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/viewunit.tpl', $data );        
    }
    
    public function addsoc()
    {
       // print_r($this->input->post()); die();
    
    $this->orgmodel->add_soc($this->input->post('org'),$this->input->post('unit'),$this->input->post('code'));
        
    $get = $this->getquery($this->input->post('org'),$this->input->post('unit'));    
        
    redirect('user/organization/units/'.$get);  
        
    }
    
    public function viewocc()
    {
        // Security Check_
        $this->userlib->check_acl('UNT',$this->get->org,$this->get->unit,'RO');
        // Passed security check, continue

        $skills = $this->orgmodel->get_occ_skills($this->get->org,$this->get->unit,$this->get->code);

        $data['org_name'] = $this->orgmodel->org_name($this->get->org);

        $data['occ_info_panel'] = $this->widget->occ_info_panel($this->orgmodel->get_unit_soc($this->get->org,$this->get->unit,$this->get->code),$this->getquery());
        $data['generic_info_panel'] = $this->widget->generic_info_panel('Other Information','Example data.');       

        $data['skills'] = $this->widget->skills_list($skills,$this->getquery());
        
        $data['query_str'] = $this->getquery();
        $data['base'] = $this->menu['base'];
        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);
        // Create breadcrumb links for easy navigation
        $data['jobs'] = '';
        
        $data['crumbs'] = $this->unitcrumbs($this->orgmodel->get_bcpath($this->get->unit));
        $data['org'] = $this->get->org;
        $data['unit'] = $this->get->unit;
        // Assign and display template
        $this->smarty->assign('pg','org');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/viewocc.tpl', $data );     
        
    }
    
    public function occ_feed()
    {
        //List of all fields that can be sortable. This is Optional.
        //This prevents that a user sorts by a column that we dont want him to access, or that doesnt exist, preventing errors.
        $valid_fields = array(
            'element_name',
            'description',
            'element_id'
        );
        
        $this->flexigrid->validate_post('oujs_id', 'asc', $valid_fields);
        
        $records['records'] = $this->orgmodel->get_occ_skills($this->get->org,$this->get->unit,$this->get->code);
        $records['record_count'] = count($records['records']);
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
        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);
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
        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);

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
        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);
        // Load template
        $this->smarty->assign('pg','org');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/editunit.tpl', $data );                     
    }
    
    function search_jobs()
    {       
        if ($this->input->post('latestQuery')) {
           
	       $term = $this->input->post('latestQuery'); //save the query in a variable
	       $querylen = strlen($term); //count the number of characters in that query
	       $result = array(); //set up an array that we'll store the matched search terms in (and finally send back to the JavaScript)

           // if ($querylen < 3) return;
    
	       $jobs = $this->onet->search_jobs($term);
           
           foreach ($jobs as $job) {
           // $link = "http://localhost/user/organization/addocc/". $this->userlib->encode_query(array('org' => $this->get->org,'unit_id' => $this->get->unit,'onetsoc_code' => $job->onetsoc_code));
           
           $link = '<li><a id="link" href="#" onclick="post(\''.site_url('/user/organization/addsoc/').'\', {code: \''.$job->onetsoc_code.'\', org: \''. $this->input->post('org') .'\', unit: \''. $this->input->post('unit') .'\'});return false;">'.$job->title.'</a></li>';
           
                $result[$job->title] = $link;
           }
       
	echo json_encode($result); //encode the results list as a JavaScript object, and send it back to the JavaScript
    }        
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
        $out['unit'] = $unit ?: $this->get->unit;
        if ($code) $out['code'] = $code;
        elseif (isset($this->get->code)) $out['code'] = $this->get->code;
        else $out['code'] = '0';
        return $this->uri->assoc_to_uri($out);
    }

    function control_areas(){
        $term = $this->input->post('data', TRUE);
        $countries = $this->omodel->get_areas($term);
        echo json_encode($countries);
    }   
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */