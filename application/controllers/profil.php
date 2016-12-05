<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class profil extends CI_Controller
{

  function __construct()
  {
  //   $this->load->helper('');
    parent::__construct();

    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
  }

  function profil()
  {
    $this->load->view('profil/profil');
  }

}
