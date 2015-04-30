<?php
/**
 * ark Admin Panel for Codeigniter 
 * Author: Abhishek R. Kaushik
 * downloaded from http://devzone.co.in
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
        $this->uid = $auth['user_id'];
        $this->profile = $this->userlib->get_profile($this->uid);
        $this->menu['org_menu'] = $this->userlib->org_menu();
        $this->menu['pg'] = 'dash';
        $this->menu['base'] = base_url();
        
      //  print_r($this->menu); die();
        
        if (!$this->profile) {
            // User has no profile information, something went wrong.
            // Set a custom error message.
            log_message('error','No profile information existed for user: '. $this->uid .' on dashboard, returned False.');
			$this->flexi_auth->set_error_message('There is an error with your account, please contact support.', TRUE);
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
            redirect('support');
        }

    }

    public function index() {
  		$data['title'] = 'Welcome to the Smarty Website';
		$data['bold'] = true;
		$data['ip_address'] = $this->input->server('REMOTE_ADDR');
        
        $data['navigation'] = $this->load->view('user/vwNavigation',$this->menu,TRUE);
        
     //   print_r($data); die();
        
        $this->smarty->assign("css","");
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/home.tpl', $data );
    }

    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */