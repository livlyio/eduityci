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
        $this->load->helper('data_helper');
        $this->load->model('Orgmodel','orgmodel');
        $this->load->model('Usermodel','usermodel');
        $this->load->model('onetmodel','omodel');
 		$this->load->helper('url');
 		$this->load->helper('form');

        // Auth STDclass
  		$this->auth = new stdClass;
		// Load 'standard' flexi auth library by default.
		$this->load->library('flexi_auth');	
		// Check user is logged in.
		if (! $this->flexi_auth->is_logged_in()) 
		{
			// Set a custom error message.
			$this->flexi_auth->set_error_message('You must login as a user to access this area.', TRUE);
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
			redirect('auth');
		}
        
        $auth = $this->session->userdata('flexi_auth');
        $this->user = $auth['user_id'];
        $this->profile = $this->userlib->get_profile($this->user);
        $this->menu['org_menu'] = $this->userlib->org_menu();
        $this->menu['pg'] = 'org';
        $this->menu['base'] = base_url();
        
      //  print_r($this->menu); die();
        
        if (!$this->profile) {
            // User has no profile information, something went wrong.
            // Set a custom error message.
            log_message('error','No profile information existed for user: '. $this->user .' on dashboard, returned False.');
			$this->flexi_auth->logout();
            $this->flexi_auth->set_error_message('There is an error with your account, please contact support.', TRUE);
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            redirect('support');
        }

    }
    
    public function index()
    {
        
    }

    public function view() 
    {
        
        
        // Pull organization information
        // $data = $this->orgmodel->get_org($this->org); 
        
        $this->org = $this->uri->segment('4');
        
        // Security Check_
        if (!$this->userlib->has_access('ORG',$this->user,$this->org)) {
            log_message('hacker','UserID: '. $this->user .' attempted unauthorized access to OrgID: '. $oid);
 			$this->flexi_auth->set_error_message('There is an error with your account, please contact support.', TRUE);
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            redirect('support');
        }
        
        $data = $this->orgmodel->get_org($this->org); 
        
        
        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);
        $data['org_id'] = $this->org;
        $data['title'] = 'Eduity';
		$data['bold'] = true;
		$data['ip_address'] = $this->input->server('REMOTE_ADDR');
        
        $mdata = $this->orgmodel->get_unit_map($this->org);        
        $map = printTree($mdata);
          
        
        $this->smarty->assign('map',$map);
        $this->smarty->assign("css",'<link rel="stylesheet" type="text/css" media="screen, print" href="'. site_url('/assets/css/slickmap.css') .'" />');
        $this->smarty->assign('pg','org');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/orghome.tpl', $data );
    }
    



    public function units()
    {
        $this->unit = $this->uri->segment('4');
        
        // Security Check_
        if (!$this->userlib->has_access('UNT',$this->user,$this->unit)) {
            log_message('hacker','UserID: '. $this->user .' attempted unauthorized access to UnitID: '. $this->unit);
 			$this->flexi_auth->set_error_message('There is an error with your account or you attempted to access an area you have not been authorized, please contact support.', TRUE);
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            redirect('support');
        }        
        
        $udata = $this->orgmodel->get_unit($this->unit);
        
        if (!$udata) {
            //Unit doesn't exist
            log_message('error','Unit '. $this->unit .' does not exist UID: '. $this->user);         
            redirect('user/dashboard');
        }
        $odata = $this->orgmodel->get_org($udata['org_id']);
        $data = array_merge($udata,$odata);
        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);
        $this->smarty->assign('pg','org');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/viewunit.tpl', $data );        
    }
    
    public function add_unit()
    {
        $this->org = $this->uri->segment('4');
        
        // Security Check_
        if (!$this->userlib->has_write_access('ORG',$this->user,$this->org)) {
            log_message('hacker','UserID: '. $this->user .' attempted unauthorized access to add units to OrgID: '. $this->org);
 			$this->flexi_auth->set_error_message('There is an error with your account or you attempted to access an area you have not been authorized, please contact support.', TRUE);
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            redirect('support');
        }         
        
        if ($this->input->post('add_unit')) {
           // print_r($this->input->post()); die();
            $id = $this->orgmodel->add_unit($this->org,$this->input->post());
            $this->userlib->grant_rw_access('UNT',$this->user,$id);
            redirect('/user/organization/units/'.$id);
        }
        
        $data = $this->orgmodel->get_org($this->org);
        $data['parents'] = '';
        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);
        $data['org_id'] = $this->org;
        
        $units = $this->orgmodel->get_units($this->org);
        
        foreach ($units as $row) {
            if ($row['parent_id'] != 0) {
                foreach ($units as $r) {
                    if ($r['unit_id'] == $row['parent_id']) {
                       $data['parents'] .= '<option value="'. $row['unit_id'] .'">'. $r['unit_title'] .' &gt; '. $row['unit_title'] .'</option>'; 
                    }
                }
            } else {
            $data['parents'] .= '<option value="'. $row['unit_id'] .'">Main &gt; '. $row['unit_title'] .'</option>'; 
           }    
        }
       // die($data['parents']);
        
        
        $this->smarty->assign('pg','org');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/addunit.tpl', $data );          
        
        
    }
    

 function control_areas(){
    $term = $this->input->post('data', TRUE);
    $countries = $this->omodel->get_areas($term);
    echo json_encode($countries);
}   
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */