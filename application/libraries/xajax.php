<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once ("xajax_core/xajax.inc.php");

class CI_Xajax extends Xajax {

	function CI_Xajax()
	{
		parent::Xajax();

		log_message('debug', "Xajax Class Initialized");
	}

	function __construct()
	{
		parent::__construct();

		// Assign CodeIgniter object by reference to CI
		if ( method_exists( $this, 'assignByRef') )
		{
			$ci =& get_instance();
			$this->assignByRef("ci", $ci);
		}

		log_message('debug', "Xajax Class Initialized");
	}
    
    
}
?>