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
        $this->load->helper('data_helper');
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

        
        if ($this->uri->total_segments() >= '4') {
            $this->get = $this->userlib->decode_segment();
        }
        
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
        //Assign ID value(s) from encrypted URI string
        $this->org = $this->get->org_id; // Org ID  
        // Security Check_        
        $this->userlib->check_acl('ORG',$this->user,$this->org,'RO');
        // Passed security check, continue
        // Pull organization information
        $data = $this->orgmodel->get_org($this->org);       
        // Additional Values for display
        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);
        $data['org_id'] = $this->userlib->encode($this->org);
        $data['query_str'] = $this->userlib->encode_query(array('org_id' => $this->org,'unit_id' => '0'));
        $data['base'] = $this->menu['base'];
        $data['map'] = $this->userlib->PrintTree($this->orgmodel->get_unit_map($this->org));
        // Assign and show template  
        $this->smarty->assign("css",'<link rel="stylesheet" type="text/css" media="screen, print" href="'. site_url('/assets/css/slickmap.css') .'" />');
        $this->smarty->assign('pg','org');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/orghome.tpl', $data );
    }

    public function units()
    {
        $this->org = $this->get->org_id; // Org ID
        $this->unit = $this->get->unit_id;  // Unit ID   
        // Security Check_
        $this->userlib->check_acl('UNT',$this->user,$this->unit,'RO');
        // Passed security check, continue
        // Grab unit information
        $udata = $this->orgmodel->get_unit($this->unit);
        // Grab org information
        $odata = $this->orgmodel->get_org($this->org);
        // Merge with unit information for display
        $data = array_merge($udata,$odata);
        // Set additional variables for display
        //$data['unit_id'] = $this->userlib->encode($data['unit_id']);
        $data['query_str'] = $this->userlib->encode_query(array('org_id' => $this->org,'unit_id' => $this->unit));
        $data['base'] = $this->menu['base'];
        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);
        // Create breadcrumb links for easy navigation
        $data['crumbs'] = $this->unitcrumbs($this->orgmodel->get_bcpath($this->unit));
        // Assign and display template
        $this->smarty->assign('pg','org');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/viewunit.tpl', $data );        
    }
    
    public function add_unit()
    {
        // Grab data ID from encrypted URI
        $this->org = $this->get->org_id; // Org ID
        $this->unit = $this->get->unit_id;  // Parent Unit ID  
        
        if ($this->unit == '0') {
            // Home is parent, adding to Tier 1
            // Security Check
            $this->userlib->check_acl('ORG',$this->user,$this->org,'RW'); 
        } else {
            // Another unit is the parent, adding to Tier 2+
            // Security Check
            $this->userlib->check_acl('UNT',$this->user,$this->unit,'RW'); 
        }

        // Passed check, get org info
        $data = $this->orgmodel->get_org($this->org);     
                
        // When user submits form...
        if ($this->input->post('add_unit')) {
            // Save new unit
            $id = $this->orgmodel->add_unit($this->org,$this->unit,$this->input->post());
            // Auto grant read/write access to creator
            $this->userlib->grant_rw_access('UNT',$this->user,$id);
            // Redirect to view new unit
            redirect('/user/organization/units/'. $this->userlib->encode_query(array('org_id' => $this->org,'unit_id' => $id)));
        } 
        // Otherwise display add unit page
        $data['query_str'] = $this->userlib->encode_query(array('org_id' => $this->org,'unit_id' => $this->unit));
        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);

        // Create breadcrumb links for easy navigation
        $data['crumbs'] = $this->unitcrumbs($this->orgmodel->get_bcpath($this->unit));         
        
        $this->smarty->assign('pg','org');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/addunit.tpl', $data );          
        
        
    }
    
    public function del_unit()
    {
        // Grab data ID from encrypted URI
        $this->org = $this->get->org_id; // Org ID
        $this->unit = $this->get->unit_id;  // Unit ID  
        // Security Check
        $this->userlib->check_acl('UNT',$this->user,$this->unit,'RW'); 
        // Passed check
        // Delete the unit
        $this->orgmodel->delete_unit($this->unit);
        // Go back to org home
        redirect('user/organization/view/'. $this->userlib->encode_query(array('org_id' => $this->org,'unit_id' => '0')));
    }
    
    public function edit_unit()
    {
        // Grab data ID from encrypted URI
        $this->org = $this->get->org_id; // Org ID
        $this->unit = $this->get->unit_id;  // Unit ID  
        // Security Check
        $this->userlib->check_acl('UNT',$this->user,$this->unit,'RW'); 
        // Passed check
        // If submitting form proceed to save routine       
        if ($this->input->post('save_unit')) {
            $this->orgmodel->update_unit($this->unit,$this->input->post());
            redirect('user/organization/units/'.$this->userlib->encode_query(array('org_id' => $this->org,'unit_id' => $this->unit)));         
        }       
        // Otherwise get unit data
        $udata = $this->orgmodel->get_unit($this->unit);
        $odata = $this->orgmodel->get_org($this->org);
        $data = array_merge($udata,$odata);
        // Create breadcrumb links for easy navigation
        $data['crumbs'] = $this->unitcrumbs($this->orgmodel->get_bcpath($this->unit));        
        $data['query_str'] = $this->userlib->encode_query(array('org_id' => $this->org,'unit_id' => $this->unit));
        $data['base'] = $this->menu['base'];
        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);
        // Load template
        $this->smarty->assign('pg','org');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/editunit.tpl', $data );                     
    }
    
    function search_jobs()
    {
        if ($this->input->post('lastQuery')) {
            
	       $query = $this->input->post('lastQuery'); //save the query in a variable
	       $querylen = strlen($query); //count the number of characters in that query
	       $result = array(); //set up an array that we'll store the matched search terms in (and finally send back to the JavaScript)
	
            if ($querylen < 3) return;
    
	       $jobs = $this->onet->search_jobs($query);
           
           foreach ($jobs as $job) {
                $result[$job->title] = $job->onetsoc_code;
           }
       
	echo json_encode($result); //encode the results list as a JavaScript object, and send it back to the JavaScript
    }        
    }
    
    function unitcrumbs($bread)
    {
    $out = '<a href="'. base_url() .'user/organization/view/'. $this->userlib->encode_query(array('org_id' => $bread['0']['org_id'],'unit_id' => '0')) .'">Home</a> ';
        foreach ($bread as $crumb) {
            $out .= ' &gt; <a href="'. base_url() .'user/organization/units/'. $this->userlib->encode_query(array('org_id' => $bread['0']['org_id'],'unit_id' => $crumb['unit_id'])) .'">'.$crumb['unit_title'].'</a>';          
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
            $this->userlib->check_acl($type,$this->user,$this->unit,$privs); 
            break;
        }
    }
    
    

    function control_areas(){
        $term = $this->input->post('data', TRUE);
        $countries = $this->omodel->get_areas($term);
        echo json_encode($countries);
    }   
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */