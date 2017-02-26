<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Reports extends CI_Controller
{
  const reportTypes = array(1 => 'direct', 2 => "indirect");
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
  //===========Direct=========================================
  function direct(){

  }
  function index()
  {
    $intervenants = $this->intervenant_model->getAllIntervenant();

    $selctData = array(
      'intervenants' => $intervenants,
      'reportTypes' => self::reportTypes
    );
    $this->load->view('reports/selector',$selctData);

    $selected = $this->input->post('select');
    if(null !== $selected){
      $meta = array(
        'year'      => $selected['year'],
        'userId'    => $selected['userId'],
        'userName'  => $intervenants[$selected['userId']],
        'kind'      => $selected['kind'],
        'kindName'  => self::reportTypes[$selected['kind']]
        );
      $raw = $this->intervention_model->getAnnualDirectReport(
        $meta['year'], $meta['userId']);
      $report = array();
      foreach ($raw as $eventDay) {
        $expDate = explode('-',$eventDay['date']); //[0>>day - 1>>month - 2>>year]
        $value = round ( $eventDay['duration']/15);
        if( $value == 0)
          $value = 1;
        $report
            [intval ($expDate[1])] // month
              [intval ($expDate[0])] // day
                = round ( $eventDay['duration']/15); //rounded value of 15'
      }
      $this->load->view('reports/reportHeader',$meta);
      switch ($meta['kind']) {
        case 1:
            $this->load->view('reports/direct',$data = array('report' => $report));
          break;

        default:
          # code...
          break;
      }

    }
  }

/*
  function index()
  {
    $user = $this->tank_auth->get_user_id();
    $intervenants= $this->intervenant_model->getAllFullIntervenant();
    $genres= $this->gender_model->getAllFullGender();
    $sexualitys= $this->sexuality_model->getAllFullSexuality();
    $ageGroups= $this->agegroup_model->getAllFullAgeGroup();
    $placeKinds = $this->placekinds_model->getAllFullKinds();

    $roles = array(
      '300' => 'user' ,
      '500' => 'admin' ,
    );

    $cities = $this->places_model->getCitys();
    $data = array(
      'intervenants' => $intervenants,
      'genres'=> $genres,
      'sexualitys'=>$sexualitys,
      'ageGroups'=>$ageGroups,
      'roles' => $roles,
      'placeKinds'=>$placeKinds,
      'cities'=> $cities
     );
     //var_dump($data);
    $this->load->view('administration/admin',$data);

  }

//===========users=========================================
  function user_edit(){
    $intervenants = $this->input->post('intervenants');
    if(null !== $intervenants)
      foreach ($intervenants as $key => $intervenant) {
          if(FALSE==isset($intervenant['activated']))
            $intervenant['activated']=0;
          $this->intervenant_model->update($intervenant);

      }
    redirect('admin');
  }
//===========end===========================================


//===========genders=======================================
  function gender_add(){
    $addedGender = $this->input->post('addedGender');
    if(null != $addedGender)
      if('Nouveau Genre' !=$addedGender)
        if('' !=$addedGender)
          $this->gender_model->insert_gender($addedGender);
    redirect('admin');
  }
  function gender_defaultEdit(){
    $genreDefault = $this->input->post('defaultGenre');
    if(null != $genreDefault)
      $this->gender_model->setDefaultName($genreDefault);
    redirect('admin');
  }
  function gender_edit(){
    $genres = $this->input->post('genres');
    if(null !== $genres) {
      foreach ($genres as $key => $genre) {
          if(FALSE==isset($genre['activated']))
            $genre['activated']=0;
          $this->gender_model->update($genre);
      }
    }
    redirect('admin');
  }
//===========end===========================================


//===========sexuality=====================================
  function sexuality_add(){
    $newSexuality = $this->input->post('addedSexuality');
    if(null !== $newSexuality)
      if('Nouvelle Sexualité' !=$newSexuality)
        if('' !=$newSexuality)
          $this->sexuality_model->insert_sexuality($newSexuality);

    //$this->output->enable_profiler(true);
    redirect('admin');
  }
  function sexuality_defaultEdit(){
    $sexualityDefault = $this->input->post('defaultSexuality');
    if(null !== $sexualityDefault)
      $this->sexuality_model->setDefaultName($sexualityDefault);
    redirect('admin');
  }
  function sexuality_edit(){
    $sexualitys = $this->input->post('sexualitys');
    if(null !== $sexualitys)
      foreach ($sexualitys as $key => $sexuality) {
          if(FALSE==isset($sexuality['activated']))
            $sexuality['activated']=0;
          $this->sexuality_model->update($sexuality);
      }

    //$this->output->enable_profiler(true);
    redirect('admin');
  }
//===========end===========================================


//===========age group=====================================
  function ageGroup_add(){
    $addedAgeGroup = $this->input->post('addedAgeGroup');
    if(null !== $addedAgeGroup)
      if("Nouveau groupe d'age" !=$addedAgeGroup)
        if('' !=$addedAgeGroup)
          $this->agegroup_model->insert_AgeGroup($addedAgeGroup);

    ////$this->output->enable_profiler(true);
    redirect('admin');
  }
  function ageGroup_defaultEdit(){
    $ageGroupDefault = $this->input->post('defaultAgeGroup');
    if(null !== $ageGroupDefault)
      $this->agegroup_model->setDefaultName($ageGroupDefault);
    redirect('admin');
  }
  function ageGroup_edit(){
    $ageGroups = $this->input->post('ageGroups');
    if(null !== $ageGroups)
      foreach ($ageGroups as $key => $ageGroup) {
          if(FALSE==isset($ageGroup['activated']))
            $ageGroup['activated']=0;
          $this->agegroup_model->update($ageGroup);
      }
    ////$this->output->enable_profiler(true);
    redirect('admin');
  }
//===========end===========================================



//===========PlaceKind=====================================
function placeKind_add(){
  $addedPlaceKind = $this->input->post('addedPlaceKind');
  if(null !== $addedPlaceKind)
    if("Nouveau type de lieu" !=$addedPlaceKind)
      if('' !=$addedPlaceKind)
        $this->placekinds_model->insert($addedPlaceKind);

  ////$this->output->enable_profiler(true);
  redirect('admin');
}
function placeKind_defaultEdit(){
  $placeKindDefault = $this->input->post('defaultPlaceKind');
  if(null !== $placeKindDefault)
    $this->placekinds_model->setDefaultName($placeKindDefault);
  redirect('admin');
}
function placeKind_edit(){
  $kinds = $this->input->post('placeKinds');
  if(null !== $kinds)
    foreach ($kinds as $key => $kind) {
      $kind['id_kind']=$key;
      if(false ==(isset($kind['kind_actived'])))
        $kind['kind_actived']=0;
      $this->placekinds_model->update($kind);
    }
  ////$this->output->enable_profiler(true);
  redirect('admin');
}
//===========end===========================================



//===========cities========================================
  function cities_GroupEdit(){
    $cities = $this->input->post('cities');
    if(null != $cities)
      foreach ($cities as $key => $city)
        if('unactiv' == $city['action'])
          $this->places_model->unactivCity($key);
    ////$this->output->enable_profiler(true);
    redirect('admin');
  }
  function cities_activByNPA(){
    $npa = $this->input->post('activatedNPA');
    if(null != $npa)
      $this->places_model->activateCityByNpa($npa);
    ////$this->output->enable_profiler(true);
    redirect('admin');
  }
  function cities_activByName(){
    $name = $this->input->post('activatedName');
    if(null != $name)
      $this->places_model->activateCityByName($name);
    ////$this->output->enable_profiler(true);
    redirect('admin');
  }
*/

}
