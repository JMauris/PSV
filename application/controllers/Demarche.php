<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Demarche extends CI_Controller
{

  function __construct()
  {
    parent::__construct();

    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $iduser = $this->tank_auth->get_user_id();
    $user=$this->intervenant_model->getIntervenantById($iduser);
  }


  function index()
  {
    ////$this->output->enable_profiler(true);
    $user = $this->tank_auth->get_user_id();
    $past = $this->demarches_model->getOldByIntervenant($user);
    $futur = $this->demarches_model->getFutursByIntervenant($user);
    $places = $this->placekinds_model->getSelector();
    $intervenant = $this->intervenant_model->getIntervenantById($user);
    $intervenants = array($intervenant['id']=> $intervenant['username']);

    if($this->tank_auth->get_groupId()==500){
      $intervenants = $this->intervenant_model->getAllIntervenant();
      $past = $this->demarches_model->getOld();
      $futur = $this->demarches_model->getFuturs();
    }

    $data = array(
      'futur' => $futur,
      'past' => $past,
      'places' => $places,
      'intervenants' => $intervenants,
      'user' => $user
     );
     //var_dump($data);
    $this->load->view('dashBoard/intervention',$data);
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
            redirect('/demarche');
            return;
          }

          $addedPersons = $intervention['addedPersons'];
          for ($i=0; $i < $addedPersons['quantity'] ; $i++) {
            $inserted = $this->person_model->getById(
              $this->person_model->insertPerson(
                "",
                $addedPersons['origine_id'],
                $addedPersons['ageGroup_id'],
                $addedPersons['gender_id'],
                $addedPersons['sexuality_id']
              )
            );
            $inserted['quickAction']= 'added';
            if(false== isset($intervention['persons']))
              $intervention['persons'] = array();
            array_push($intervention['persons'],$inserted);
          }

          {
            $nullMeetings = array();
            if(false == isset($intervention['interventions']))
              $intervention['interventions']= array();

            foreach ($intervention['interventions'] as $key => $meeting)
              if( 0 >= $meeting['duration'])
                array_push($nullMeetings, $key);
            foreach ($nullMeetings as $value)
              unset($intervention['interventions'][$value]);
          }
          /*echo "contoleur/demarche/var_intervention\n";
          var_dump($intervention);*/
          $this->demarches_model->update($intervention);
    }


    $intervention =  $this->demarches_model->getById($id);
    if(false == ($this->tank_auth->get_groupId()==500))
      if(false==($intervention['intervenant_id']==$user)){
        redirect('/demarche');
        return;
      }


    $places = $this->placekinds_model->getSelector();
    $intervenant  = $this->intervenant_model->getIntervenantById($user);
    $intervenants = array($intervenant['id']=> $intervenant['username']);
    $thematics    = $this->thematics_model->getTree();
    $materials    = $this->material_model->getAll();
    $genders      = $this->gender_model->getActivs();
    $sexuality    = $this->sexuality_model->getActivs();
    $ageGroups    =$this->agegroup_model->getActivs();
    $origins      = $this->origines_model->getFlatTree();

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
      'origins'       => $origins
     );
     /*echo "contoleur/demarche/var_intervention\n";
     var_dump($data['intervention']);*/
    $this->load->view('formulaire/interventionEdit',$data);
  }


  function create()
  {
    $intervenant_id = $this->input->post('intervenant');
    $date           = $this->input->post('date');
    $place_id       = $this->input->post('place');
    $kind_id        = 4;
    $newId = $this->demarches_model->insert($intervenant_id, $date, $place_id, $kind_id);

    redirect('demarche/edit/'.$newId);
  }


}

 ?>
