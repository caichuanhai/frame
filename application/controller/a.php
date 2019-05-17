<?php if (!defined('SITEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class a extends CCH_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function b($a1, $a2)
	{
		$this->load->view('index.html', array('the' => 'variables', 'go' => 'here'));
	}
}