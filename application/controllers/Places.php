<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Places extends CI_Controller
{

  function __construct()
  {
    parent::__construct();

    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    if (!$this->tank_auth->is_logged_in()) {
      redirect('');
    }

  }


  function index()
  {
    $places = $this->places_model->getAll();

    $data = array(
      'places' => $places
    );
    var_dump($data);
    $this->load->view('dashBoard\places',$data);





  }

  function edit($id=-1){
    $place = $this->places_model->getById($id);
    $citys = $this->places_model->getCitys();
    $kinds = $this->places_model->getKinds();
    $data = array(
      'place' => $place,
      'citys' => $citys,
      'kinds' => $kinds
    );
    $this->load->view('formulaire\lieuEdit',$data);
  }


  function create()
  {
    $citys = $this->places_model->getCitys();
    $kinds = $this->places_model->getKinds();
    $data = array(
      'citys' => $citys,
      'kinds' => $kinds
    );
    $this->load->view('formulaire\lieuEdit',$data);
  }


}

 ?>
