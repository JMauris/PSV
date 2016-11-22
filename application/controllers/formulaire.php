<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class formulaire extends CI_Controller
{

  function __construct()
  {
  //   $this->load->helper('');
    parent::__construct();

    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
  }


  function prospret()
  {
  $this->load->view('formulaire/module1_form0');

    $this->load->view('formulaire/categorie_form');

  }

  function aideConseil()
  {
  $this->load->view('formulaire/module1_form');
  }

  function categorie()
  {
  $this->load->view('formulaire/categorie_form');
  }

  function infoPopulation()
  {
  $this->load->view('formulaire/infoPopulation_form');
  }
  function lieu()
  {
  $this->load->view('formulaire/lieu_form');
  }
  function materiel()
  {
  $this->load->view('formulaire/materiel_form');
  }
  function origine()
  {
  $this->load->view('formulaire/origine_form');
  }
  function thematique()
  {
  $this->load->view('formulaire/thematique_form');
  }
  function type()
  {
  $this->load->view('formulaire/type_form');
  }
  function end()
  {
  $this->load->view('formulaire/end_form');
  }





}

 ?>
