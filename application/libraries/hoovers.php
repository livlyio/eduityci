<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Hoovers 
	{
		public function __construct()
		{
		//	parent::__construct();

            $config = array(
            'server'      => 'http://hapi.hoovers.com/HooversAPI-40/rest/',
            'api_key'     => 'fvb86858wyymcarydggvxzmt',
            'http_user'    => 'developmentHAPI',
            'http_pass'    => 'hoover5API'
            //'api_name'    => 'Eduity'
            );
             
            $this->CI =& get_instance();
             
            $this->CI->load->library('rest');    
            $this->CI->rest->initialize($config);		
		}
        
        public function connect()
        {
            
        }
        
        private function post_request($url,$data)
        {
            return $this->CI->rest->post($url,$data);
        }
        
        private function get_request($url)
        {
            return $this->CI->rest->get($url);
        }
        
        public function search_company($company)
        {
            $url = 'search/company/advanced?hit_offset=0&max_records=20&sort_direction=ascending&order_by=company_name';
            
            $search = array('companyName' => $company);
            
            $out = $this->post_request($url,$search);
            
            print_r($out); die();
            
        }

        public function get_company_basic()
        {
            
        }
        
        public function get_company_details()
        {
            
        }


}
