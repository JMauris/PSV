<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Home extends CI_Controller
{

  function __construct()
  {
    		$this->load->helper('url');
  }

  function index()
  {
    if (!$this->tank_auth->is_logged_in()) {
      redirect('/auth/login/');
    } else {
        	$this->load->view('home/home_form', $data);
    }
  }
}
