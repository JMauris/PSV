<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Meeting extends CI_Controller
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
    $this->output->enable_profiler(true);
    $past = $this->meetings_model->getOld();
    $futur = $this->meetings_model->getFuturs();
    $places = $this->place_model->getAll();
    $intervenants = $this->intervenant_model->getAllIntervenant();
    $user = $this->tank_auth->get_user_id();
    $type = array(
      '1' => 'mail',
      '2' => 'entretient',
      '3' => 'télphone'
      );

    $data = array(
      'futur' => $futur,
      'past' => $past,
      'places' => $places,
      'intervenants' => $intervenants,
      'user' => $user,
      'type'=> $type
     );
     var_dump($data);
    $this->load->view('dashBoard/meeting',$data);

  }

  function edit($id){


  }


  function create()
  {
    $intervenant_id = $this->input->post('intervenant');
    $date           = $this->input->post('date');
    $kind_id           = $this->input->post('moyen');
    $place_id       = $this->input->post('place');
    $this->meetings_model->insert($intervenant_id, $date, $place_id, $kind_id);

    redirect('meeting');
  }


}

 ?>
