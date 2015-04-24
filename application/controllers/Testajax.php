<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testajax extends CI_Controller
{

    public function __construct() {
      parent::__construct();
      $this->load->library('xajax');
      $rqstButton = $this->xajax->register(XAJAX_FUNCTION, 'showText');
      $this->xajax->register(XAJAX_FUNCTION, array('test_function', $this, 'test_function') );
      $this->xajax->processRequest();
    }

    public function test_function($number)
    {
      $objResponse = new xajaxResponse();
      $objResponse->Assign("SomeElementId","innerHTML", "Xajax is working. Lets add: ".($number+3));
      return $objResponse;
    }
    public function index()
    {
      $template['xajax_js'] = $this->xajax->getJavascript(base_url());
      $template['content'] = '<div id="SomeElementId"></div>&lt;input type="button" value="test"  onclick="xajax_test_function(2);"&gt;';
      $this->load->view('testajax', $template);
     }
}
?>