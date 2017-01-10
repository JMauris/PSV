<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Indirect extends CI_Controller
{

  function __construct()
  {
    parent::__construct();

    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $iduser = $this->tank_auth->get_user_id();
    $user=$this->intervenant_model->getIntervenantById($iduser);
    if (!$this->tank_auth->is_logged_in()) {
      redirect('');
    }

  }


  function index(){
    //indirect_model
    $userId = $this->tank_auth->get_user_id();
    $places = $this->placekinds_model->getSelector();
    $intervenant = $this->intervenant_model->getIntervenantById($userId);
    $intervenants = array($intervenant['id']=> $intervenant['username']);
    $prestations = $this->prestation_model->getTree();
    $futurs = $this->indirect_model->getFuturByOwner($userId);
    $past = $this->indirect_model->getOldByOwner($userId);

    if($this->tank_auth->get_groupId()==500){
      $intervenants = $this->intervenant_model->getAllIntervenant();
      $past = $this->indirect_model->getOlds();
      $futurs = $this->indirect_model->getFuturs();
    }


    $data = array(
      'futurs' => $futurs,
      'past' => $past,
      'places' => $places,
      'intervenants' => $intervenants,
      'user' => $userId
     );
    //var_dump($data);
    $this->load->view('dashBoard/indirect',$data);
  }

  function edit($id){
    $user = $this->tank_auth->get_user_id();
    $indirect = $this->input->post('indirect');
    if (null !== $indirect){
        if($indirect['id_indirect']!=$id)
          return;
        if(false == ($this->tank_auth->get_groupId()==500))
          if(false==($indirect['id_indirect']==$user)){
            redirect('/indirect');
            return;
          }
      $this->indirect_model->update($indirect);
    }



    $iduser = $this->tank_auth->get_user_id();
    $indirect = $this->indirect_model->getById($id);
    $places = $this->placekinds_model->getSelector();
    $intervenant = $this->intervenant_model->getIntervenantById($iduser);
    $intervenants = $this->intervenant_model->getAllIntervenant();
    $prestations = $this->prestation_model->getTree();

    if($this->tank_auth->get_groupId()==500){

    }

    $data = array(
      'indirect'=>$indirect,
      'places'        => $places,
      'intervenants'  => $intervenants,
      'prestations' => $prestations
     );
    //var_dump($data);
    $this->load->view('formulaire/indirectEdit',$data);

  }


  function create(){
    $added = $this->input->post('added');
    if(0 == $added['owner'])
      redirect('indirect');
    if(0 == $added['place'])
      redirect('indirect');
    $insertedId = $this->indirect_model->insert($added['owner'], $added['place'], $added['date']);
    redirect('indirect/edit/'.$insertedId);
  }


}

 ?>
