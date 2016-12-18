<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class LoggedControler extends CI_Controller
{

  function __construct()
  {
    parent::__construct();

    if (!$this->tank_auth->is_logged_in()) {
      redirect('');
    }
    $iduser = $this->tank_auth->get_user_id();
    $user=$this->intervenant_model->getIntervenantById($iduser);


  }

}

 ?>
