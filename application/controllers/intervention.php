<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Intervention extends CI_Controller
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
    $past = $this->intervention_model->getOld();
    $futur = $this->intervention_model->getFuturs();
    $places = $this->place_model->getAll();
    $intervenants = $this->intervenant_model->getAllIntervenant();

    $data = array(
      'futur' => $futur,
      'past' => $past,
      'places' => $places,
      'intervenants' => $intervenants
     );

    $this->load->view('dashBoard/intervention',$data);
  }

  function edit($id){
    $intervention =  $this->intervention_model->getById($id);
    $places = $this->place_model->getAll();
    $intervenants = $this->intervenant_model->getAllIntervenant();

    $data = array(
      'intervention'  => $intervention,
      'places'        => $places,
      'intervenants'  => $intervenants
     );
    var_dump($data);
    $this->load->view('formulaire/interventionEdit',$data);
  }

  function create()
  {
    var_dump($this->input->post('date'));
    $intervenant_id = $this->input->post('intervenant');
    $date           = $this->input->post('date');
    $place_id       = $this->input->post('place');
    $kind_id        = 4;
    $this->intervention_model->insert($intervenant_id, $date, $place_id, $kind_id);

    //redirect('intervention');
  }


}

 ?>
