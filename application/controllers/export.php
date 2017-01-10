<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Export extends CI_Controller
{

  function __construct()
  {
    parent::__construct();

    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

    $iduser = $this->tank_auth->get_user_id();
    $user=$this->intervenant_model->getIntervenantById($iduser);
    if (!$this->tank_auth->is_logged_in()||$user['group_id']!=500) {
      redirect('');

    }

  }


  function index()
  {
    $base = $this->intervention_model->getTimeByIntervenant(1, 2016);
    var_dump($base);
  }

//===========users=========================================
  function getdirectForIntervenant($intervenantID){

  }
//===========end===========================================


//===========genders=======================================

//===========end===========================================


//===========sexuality=====================================

//===========end===========================================




}
