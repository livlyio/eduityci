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
        $this->load->model('Lv_model','lvmodel');
         if (!$this->session->userdata('is_user_login')) {
            redirect('user/home');
        }
    }

    public function index() {
  		$data['title'] = 'Welcome to the Smarty Website';
		$data['bold'] = true;
		$data['ip_address'] = $this->input->server('REMOTE_ADDR');
        $this->smarty->assign("css","");
        $this->smarty->assign('pg','dash');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/home.tpl', $data );
    }

    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */