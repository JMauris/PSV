<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Test extends CI_Controller
{

  function __construct()
  {
  //   $this->load->helper('');
    parent::__construct();

  }
  public function index()
  {
    var_dump("null");
      $this->load->view('formulaire/participant');
  }

}

 ?>
