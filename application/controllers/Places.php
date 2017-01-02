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
    $places = $this->places_model->getActives();
    var_dump($places);

  }

  function edit($id){
    //$this->output->enable_profiler(true);
    $user = $this->tank_auth->get_user_id();
    $intervention = $this->input->post('intervention');
    if (null !== $intervention){
        if($intervention['id_intrevention']!=$id)
          return;
        if(false == ($this->tank_auth->get_groupId()==500))
          if(false==($intervention['intervenant_id']==$user)){
            redirect('/intervention');
            return;
          }
      if($intervention['person_id']==0){
        $intervention['person_id']=
          $this->person_model->insertPerson(
            "",
            $intervention['person']['origine_id'],
            $intervention['person']['ageGroup_id'],
            $intervention['person']['gender_id'],
            $intervention['person']['sexuality_id']
        );
      }else
        $this->person_model->update($intervention['person']);
      $this->meetings_model->update($intervention);
    }


    $intervention =  $this->meetings_model->getById($id);
    if(false == ($this->tank_auth->get_groupId()==500))
      if(false==($intervention['intervenant_id']==$user)){
        redirect('/intervention');
        return;
      }


    $places       = $this->place_model->getAll();
    $intervenant = $this->intervenant_model->getIntervenantById($user);
    $intervenants = array($intervenant['id']=> $intervenant['username']);
    $thematics    = $this->thematics_model->getTree();
    $materials    = $this->material_model->getAll();
    $genders      = $this->gender_model->getActivs();
    $sexuality    = $this->sexuality_model->getActivs();
    $ageGroups    =$this->agegroup_model->getActivs();
    $origins      = $this->origines_model->getFlatTree();
    $types = array(
      '1' => 'mail',
      '2' => 'entretient',
      '3' => 'télphone'
      );

    if($this->tank_auth->get_groupId()==500){
      $intervenants = $this->intervenant_model->getAllIntervenant();
    }

    $data = array(
      'intervention'  => $intervention,
      'places'        => $places,
      'intervenants'  => $intervenants,
      'thematics'     => $thematics,
      'materials'     => $materials,
      'genders'       => $genders,
      'sexuality'     => $sexuality,
      'ageGroups'     => $ageGroups,
      'origins'       => $origins,
      'types'         => $types
     );
     //var_dump($data);
    $this->load->view('formulaire/mettingEdit',$data);

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
