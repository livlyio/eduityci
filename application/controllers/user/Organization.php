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
        $this->load->model('Orgmodel','orgmodel');
        $this->load->model('Usermodel','usermodel');
        $this->load->model('onetmodel','omodel');
        
        $auth = $this->session->userdata('flexi_auth');
        $uid = $auth['user_id'];
        
        $this->profile = $this->usermodel->get_profile($uid);
       // print_r($this->profile); die();
    }

    public function index() {
  		$data['title'] = 'Eduity';
		$data['bold'] = true;
		$data['ip_address'] = $this->input->server('REMOTE_ADDR');
        
        $data['orginfo'] = $this->orgmodel->get_org($this->profile->organization_id);
        
        $mdata = $this->orgmodel->get_unit_map($this->profile->organization_id);        
        $map = $this->printTree($mdata);
        
        $this->smarty->assign('map',$map);
        $this->smarty->assign("css",'<link rel="stylesheet" type="text/css" media="screen, print" href="../assets/css/slickmap.css" />');
        $this->smarty->assign('pg','org');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/orghome.tpl', $data );
    }
    
    function printTree($array,$child = '0'){
    $out = "<ul>\n";
    foreach($array as $item){
        if(is_array($item) && isset($item['unit_title'])){
                if(isset($item['children']) && is_array($item['children'])){
                    $out .= "<li><a href=\"". base_url() . 'user/organization/units/'. $item['unit_id'] ."\">".$item['unit_title']."</a>";
                    $out .= $this->printTree($item['children'],'1');
                    $out .= "</li>\n";
                } else {
                    $out .= "<li><a href=\"". base_url() . 'user/organization/units/'. $item['unit_id'] ."\">".$item['unit_title']."</a></li>\n";
                }   
        }  
    }
    $out .= "</ul>\n\n";
    return $out;
    }


    public function units()
    {
        $unitid = $this->uri->segment('4');
        $udata = $this->orgmodel->get_unit($this->profile->organization_id,$unitid);
        if (!$udata) {
            //Unit doesn't exist for this org
            redirect('user/organization');
        }
      //  print_r($udata); die();
      
        $data = array();
        
        $this->smarty->assign('info',$udata);
        $this->smarty->assign('pg','org');
  		$this->smarty->assign("Name","Collaborative Workforce Planning");
        $this->smarty->view( 'user/viewunit.tpl', $data );        
    }

 function control_areas(){
    $term = $this->input->post('data', TRUE);
    $countries = $this->omodel->get_areas($term);
    echo json_encode($countries);
}   
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */