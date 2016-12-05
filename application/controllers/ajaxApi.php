<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class AjaxApi extends CI_Controller
{

  function __construct()
  {
  //   $this->load->helper('');
    parent::__construct();

  }
  public function origines()
  {
    $origines = $this->origines_model->getOriginsTree();
    var_dump($origines);
  }

}

 ?>
