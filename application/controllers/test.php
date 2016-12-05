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

    $test = $this->person_model->getByIntervention(3);
    var_dump($test);
  }

}

 ?>
