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
    $thematics = $this->thematics_model->getTree();
    $data = array('thematics' =>$thematics);
    
    $this->load->view('test',$data);
  }

}

 ?>
