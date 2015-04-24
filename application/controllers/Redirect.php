<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redirect extends CI_Controller {

/**

* Method to redirect from an alias to a full URL

*/
    function __construct()
    {
         parent::__construct();
         $alias = '';
         $url = '';
         $ip = '';
         $host = '';
         $refer = '';
         $this->load->model('Lv_model','lvmodel'); 
         $this->load->helper('url');  
    }

    public function index() {

        $alias = $this->uri->segment(1);
        $url = $this->lvmodel->get_url($alias);
        
        if ($url != false) {
            $this->lvmodel->save_stat($alias, $url, $ip, $host, $refer);
            redirect($url, ‘refresh’);
        } else { $this->notfound(); }
    }

    public function notfound()
    {
        die("The requested URL could not be found.");
    }


}

/* End of file redirect.php */

/* Location: ./application/controllers/redirect.php */