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
        
        // Load Account Model
		$this->load->model('account/account_model');
        $this->load->model('message/message_model');
		$this->load->model('profile/profile_model');
		$this->load->model('profile/personal_profile_model');
		$this->load->model('media/photo_model');
        // Check User Authentication
		//if not logged-in redirect to login
		if($this->account_model->is_logged_in() == FALSE)
		{
			redirect(base_url('login'));
            die();
		}
		//if not verified
		if($this->account_model->is_verified() == FALSE)
		{
			//redirect to unverified account page				
			redirect(base_url().'unverifiedAccount');
            die();
		}
        
        // Standard libraries
        $this->load->library('form_validation');
		$this->load->library('uploading');
		$this->load->library('photo');
		$this->load->helper('url');
        // Called stream controller as a library
        $this->load->library('../controllers/stream/stream');
      
        /**
         * The $this->info object is used to store variables that are 
         * displayed in templates or worked with in some other way
         * */ 
        $this->info = new stdClass();
        // Set up some empty properties
        $this->info->org_menu = '';
        $this->info->options = '';            
		//save logged-in user id and profile id for using in script
        $this->info->uid = $this->session->userdata('userid');
		$this->info->pid = $this->session->userdata('profileid');
		//fetch details that are common to settings pages
		$this->info->basic_details = $this->profile_model->get_profile_details();
        //get display name
		$this->info->display_name = $this->info->basic_details['display_name'];
		//get profile picture
		$this->info->profile_pic =  $this->info->basic_details['photo'];
        //get user name
		$this->info->user_name = $this->account_model->get_account_details('name');
        // get org permissions
        $this->info->orgs = $this->account_model->get_org_permits_names();
        // Create our uri query object
        $this->get = (object)$this->uri->uri_to_assoc(4);      
    }

    public function index() {
        
        $data['page_content'] = '';
        $this->info->ngroup = 'dash';
        $data['optional'] = $this->optional();
        $data['topnav'] = $this->notifications();
        $data['sidebar'] = $this->sidebar();
       
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/dashboard.tpl', $data );
    }

    public function notifications()
    {   
        $this->info->notes['msgs']['recent'] = $this->message_model->get_unread_msgs();
        $this->info->notes['msgs']['count'] = $this->message_model->count_unread_msgs()->count; 
        $this->info->notecount = count($this->stream->data['notifications']);
        $this->info->user_full_name = $this->stream->data['signed_user_display'];
        $this->info->user_profile_pic = $this->stream->data['signed_user_photo'];
                
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        return $this->smarty->view( 'user/topnav.tpl', $this->info, true);        
    }
    
    public function sidebar()
    {
        return $this->smarty->view( 'user/sidebar.tpl', $this->info, true);  
    }
    
    public function not_found()
    {
        $input = "<h1>Not Found</h1><br /><strong> The resource you were attempting to access does not exist.</strong>";
        $this->load_content($input,array(),'orgn');
    }

    public function load_template_nobox($template,$data,$ngroup)
    {
        $data['page_content'] = $this->smarty->view($template,$data,true);
        $this->info->ngroup = $ngroup;
        $data['topnav'] = $this->notifications();
        $data['sidebar'] = $this->sidebar();
        $data['optional'] = $this->optional();
       
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/only.tpl', $data ); 
    }

    public function load_template($template,$data,$ngroup)
    {
        $data['page_content'] = $this->smarty->view($template,$data,true);
        $this->info->ngroup = $ngroup;
        $data['topnav'] = $this->notifications();
        $data['sidebar'] = $this->sidebar();
        $data['optional'] = $this->optional();
       
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/content.tpl', $data ); 
    }

    public function load_content($input,$data,$ngroup)
    {
        $this->info->ngroup = $ngroup;
        $data['page_content'] = $input;
        $data['topnav'] = $this->notifications();
        $data['sidebar'] = $this->sidebar();
        $data['optional'] = $this->optional();
       
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/content.tpl', $data );        
    }

    public function timeline()
    {
        $data['page_content'] = $this->stream->get();
        $this->info->ngroup = 'dash';
        $data['topnav'] = $this->notifications();
        $data['sidebar'] = $this->sidebar();
        $data['optional'] = $this->optional();
       
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/timeline.tpl', $data );               
    }
    
    private function optional($input = false)
    {
        if (!$input) return $this->info->options;
        else { $this->info->options = $input; }     
    }
    
    public function calendar()
    {
    $this->optional('<!-- fullCalendar 2.2.5-->
    <link href="http://localhost/adminlte/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/adminlte/plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media="print" />');

        
        $this->load_template_nobox('user/individual/calendar.tpl',array(),'cald');
    }
    
    public function mailbox()
    {
        $this->load_template_nobox('user/individual/messages.tpl',array(),'cald');
    }
    

    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */