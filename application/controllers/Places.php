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


  function index(){
    $places = $this->places_model->getAll();
    $kinds = $this->places_model->getAllKinds();
    $data = array(
      'places' => $places,
      'kinds'  => $kinds
    );
    $this->load->view('dashBoard\places',$data);





  }
  function updatePlaces(){
    $places = $this->input->post('places');
    foreach ($places as $key => $place) {
        if( 1 == $place['actived_old']){
          // was activated
          if(false ==(isset($place['actived']))){
            $this->places_model->setPlaceActivation($key, 0);
            echo "\n unactivated".$key;
          }
        }else{
          // was NOT activated
          if(isset($place['actived'])){
            $this->places_model->setPlaceActivation($key, 1);
            echo "\n  activated".$key;
          }
        }
    }
    redirect('places');
  }
  function updateKinds(){
    $kinds = $this->input->post('kinds');
    foreach ($kinds as $key => $kind) {
      $kind['id_kind']=$key;
      if(false ==(isset($kind['kind_actived'])))
        $kind['kind_actived']=0;
      $this->places_model->updateKind($kind);
    }
    redirect('places');
  }
  function insertKind(){
    $kindName = $this->input->post('newKindName');
    $this->places_model->insertKind($kindName);
    redirect('places');
  }

  function edit($id){
    $sended = $this->input->post('place');
    echo "\n sended \n";
    var_dump($sended);
    if (null != $sended){
      $place = array(
        'id_lieu' => $sended['id_lieu'],
        'Name'    => $sended['Name'],
        'kind'    => $sended['kind']
      );
      $this->places_model->update($place);
      if($sended['adresseAction']== 'create')
        $this->places_model->insertAdress($id, $sended['adresse']['line_1'], $sended['adresse']['line_2'], $sended['adresse']['city']);
      elseif ($sended['adresseAction']== 'delete')
        $this->places_model->removeAdress($id);
      elseif ($sended['adresseAction']== 'update'){
        $adress = array(
          'place_Id'  => $id,
          'line_1'    => $sended['adresse']['line_1'],
          'line_2'    => $sended['adresse']['line_2'],
          'city'      => $sended['adresse']['city']
        );
        $this->places_model->updateAdress($adress);
      }
      redirect('places');
    }


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
    $place = $this->input->post('place');
    if (null != $place){
      $id = $this->places_model->insert($place['Name'], $place['kind']);
      if($place['adresseAction']== 'create')
        $this->places_model->insertAdress($id, $place['[adresse]']['line_1'], $place['[adresse]']['line_2'], $place['[adresse]']['city']);
      redirect('places');
    }


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
