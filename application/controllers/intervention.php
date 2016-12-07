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
    $past = $this->demarches_model->getOld();
    $futur = $this->demarches_model->getFuturs();
    $places = $this->place_model->getAll();
    $intervenants = $this->intervenant_model->getAllIntervenant();
    $user = $this->tank_auth->get_user_id();
    
    $data = array(
      'futur' => $futur,
      'past' => $past,
      'places' => $places,
      'intervenants' => $intervenants,
      'user' => $user
     );
     var_dump($data);
    $this->load->view('dashBoard/intervention',$data);
  }

  function edit($id){
    $this->output->enable_profiler(true);
    $intervention = $this->input->post('intervention');
    if (null !== $intervention){
        if($intervention['id_intrevention']!=$id)
          return;

        $potentialyAdded = array_pop($intervention['persons']);
        if( 0 != $potentialyAdded['gender_id'])
          if( 0 != $potentialyAdded['sexuality_id'])
            if( 0 != $potentialyAdded['ageGroup_id']){
              $inserted = $this->person_model->getById(
                $this->person_model->insertPerson(
                  "",
                  $potentialyAdded['origine_id'],
                  $potentialyAdded['ageGroup_id'],
                  $potentialyAdded['gender_id'],
                  $potentialyAdded['sexuality_id']
                )
              );
              $inserted['quickAction']= 'added';
              array_push($intervention['persons'],$inserted);
            }

            $this->demarches_model->update($intervention);
    }


    $intervention =  $this->demarches_model->getById($id);
    $places       = $this->place_model->getAll();
    $intervenants = $this->intervenant_model->getAllIntervenant();
    $thematics    = $this->thematics_model->getTree();
    $materials    = $this->material_model->getAll();
    $genders      = $this->gender_model->getActivs();
    $sexuality    = $this->sexuality_model->getActivs();
    $ageGroups    =$this->agegroup_model->getActivs();
    $origins      = $this->origines_model->getFlatTree();

    $data = array(
      'intervention'  => $intervention,
      'places'        => $places,
      'intervenants'  => $intervenants,
      'thematics'     => $thematics,
      'materials'     => $materials,
      'genders'       => $genders,
      'sexuality'     => $sexuality,
      'ageGroups'     => $ageGroups,
      'origins'       => $origins
     );
     var_dump($data);
    $this->load->view('formulaire/interventionEdit',$data);
  }


  function create()
  {
    $intervenant_id = $this->input->post('intervenant');
    $date           = $this->input->post('date');
    $place_id       = $this->input->post('place');
    $kind_id        = 4;
    $this->demarches_model->insert($intervenant_id, $date, $place_id, $kind_id);

    redirect('intervention');
  }


}

 ?>
