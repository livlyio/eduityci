<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends CI_Controller {

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
        @$this->load->library('form_validation');
        @$this->load->library('flexi_auth');
    }

    public function index() {
        if ($this->input->post('register_user'))
		{			
			$this->load->model('flexi_auth_model');
			$this->flexi_auth_model->register_account();
		}
		
		// Get any status message that may have been set.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		


  		$data['title'] = 'Welcome to the Smarty Website';
		$data['bold'] = true;
		$data['ip_address'] = $this->input->server('REMOTE_ADDR');
        
        $form = $this->load->view('vwRegister','',TRUE);
        
        $this->smarty->assign("page_content",$form);
        $this->smarty->assign("page_title","Register Account");
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->assign('pg','org');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'home/register.tpl', $data );
        
     //   $arr['page'] ='home';
       // $this->load->view('vwHome',$arr);
    }

     public function do_login() {

        if ($this->session->userdata('is_client_login')) {
            redirect('home/loggedin');
        } else {
            $user = $_POST['username'];
            $password = $_POST['password'];

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
 /*
         * Code By Abhishek R. Kaushik
         * Sr. Software Developer 
         */
                $this->load->view('login');
            } else {
                $sql = "SELECT * FROM users WHERE user_name = '" . $user . "' AND user_hash = '" . md5($password) . "'";
                $val = $this->db->query($sql);


                if ($val->num_rows) {
                    foreach ($val->result_array() as $recs => $res) {

                        $this->session->set_userdata(array(
                            'id' => $res['id'],
                            'user_name' => $res['user_name'],
                            'email' => $res['email'],                            
                            'is_client_login' => true
                                )
                        );
                    }
                    redirect('calls/call');
                } else {
                    $err['error'] = 'Username or Password incorrect';
                    $this->load->view('login', $err);
                }
            }
        }
           }

        
    public function logout() {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('title');
         $this->session->unset_userdata('ag_country');
        
        $this->session->unset_userdata('is_client_login');
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('home', 'refresh');
    }

	function register_account()
	{
		// Redirect user away from registration page if already logged in.
		if ($this->flexi_auth->is_logged_in()) 
		{
			redirect('auth');
		}
		// If 'Registration' form has been submitted, attempt to register their details as a new account.
		else if ($this->input->post('register_user'))
		{			
			$this->load->model('flexi_auth_model');
			$this->flexi_auth_model->register_account();
		}
		
		// Get any status message that may have been set.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

        //print_r($this->data); die();

		$this->load->view('register_view', $this->data);
	}    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */