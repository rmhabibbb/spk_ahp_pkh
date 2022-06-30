<?php
defined('BASEPATH') || exit('No direct script allowed');

class MY_Router extends CI_Router
{
	public function _set_request($seg = array())
	{
		parent::_set_request(str_replace('-', '_', $seg));
	}
}

/* End of file MY_Router.php */
/* Location: ./application/core/MY_Router.php */
