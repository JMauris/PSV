<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Admin extends CI_Controller
{

  function __construct(){
    parent::__construct();
/*
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

    $iduser = $this->tank_auth->get_user_id();
    $user=$this->intervenant_model->getIntervenantById($iduser);
    if (!$this->tank_auth->is_logged_in()||$user['group_id']!=500) {
      redirect('');

    }
*/
  }


  function index(){
    $user = $this->tank_auth->get_user_id();
    $intervenants= $this->intervenant_model->getAllFullIntervenant();
    unset($intervenants[0]);
    $genres= $this->gender_model->getAllFullGender();
    $sexualitys= $this->sexuality_model->getAllFullSexuality();
    $ageGroups= $this->agegroup_model->getAllFullAgeGroup();
    $materials =  $this->material_model->getAllForAdmin();
    $placeKinds = $this->placekinds_model->getAllFullKinds();
    $prestationGroups = $this->prestation_model->getGroups();
    $prestations = $this->prestation_model->getPrestations();
    $thematicsTree = $this->thematics_model->getAdminTree();
    $origines = $this->origines_model->getAdminTree();
    $origineSelector = $this->origines_model->getFlatTree();


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
      'materials' => $materials,
      'placeKinds'=>$placeKinds,
      'prestationGroups'=>$prestationGroups,
      'prestations'=>$prestations,
      'thematicsTree' => $thematicsTree,
      'origines' =>   $origines,
      'origineSelector' => $origineSelector,
      'cities'=> $cities
     );

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
      if('Nouveau Sexe' !=$addedGender)
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
      if("Nouveau groupe d'âge" !=$addedAgeGroup)
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

//===========thematics_Sct==================================
function thematics_add(){
  $addedthema = $this->input->post('addedthema');
  if(null !== $addedthema)
    if("Nouvelle catégorie" !=$addedthema['name'])
      if('' !=$addedthema['name'])
        $this->thematics_model->insert($addedthema['parent'],$addedthema['name']);

  ////$this->output->enable_profiler(true);
  redirect('admin');
}
function thematics_edit(){
  $themaTree = $this->input->post('themaTree');
  if(null !== $themaTree)
    foreach ($themaTree['children'] as $topKey => $topLvlThema) {
      if(false ==(isset($topLvlThema['isActiv']))){
        $themaTree['children'][$topKey]['isActiv']=0;
        foreach ($topLvlThema['children'] as $lowKey => $lowLvlThema)
          $themaTree['children'][$topKey]['children'][$lowKey]['isActiv']=0;
      }else {
        foreach ($topLvlThema['children'] as $lowKey => $lowLvlThema)
          if(false ==(isset($lowLvlThema['isActiv'])))
            $themaTree['children'][$topKey]['children'][$lowKey]['isActiv']=0;
      }
    }

  $this->thematics_model->updateTree($themaTree);
  ////$this->output->enable_profiler(true);
  //redirect('admin');
  redirect('admin');
}
//===========end===========================================

//===========Material_Sct==================================
function material_add(){
  $addedMatterial = $this->input->post('addedMatterial');
  $addedMatterial = $this->input->post('addedMatterial');
  if(null !== $addedMatterial)
    if("Nouveau materiel" !=$addedMatterial)
      if('' !=$addedMatterial)
        $this->material_model->insert($addedMatterial);

  ////$this->output->enable_profiler(true);
  redirect('admin');
}
function material_edit(){
  $materials = $this->input->post('materials');
  if(null !== $materials)
    foreach ($materials as $key => $material) {
      $material['id_material']=$key;
      if(false ==(isset($material['actived'])))
        $material['actived']=0;
      $this->material_model->update($material);
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

//===========prestGrp======================================
function prestGrp_add(){
  $addedPrestGrp = $this->input->post('addedPrestGrp');
  if(null !== $addedPrestGrp)
    if("Nouveau groupe de prestations" !=$addedPrestGrp)
      if('' !=$addedPrestGrp)
        $this->prestation_model->addGroup($addedPrestGrp);

  ////$this->output->enable_profiler(true);
  redirect('admin');
}
function prestGrp_edit(){
  $prestationGroups = $this->input->post('prestationGroups');
  if(null !== $prestationGroups)
    foreach ($prestationGroups as $key => $prestationGroup) {
      $prestationGroup['id_presstationGroup']=$key;
      if(false ==(isset($prestationGroup['isActiv'])))
        $prestationGroup['isActiv']=0;
      $this->prestation_model->updateGroup($prestationGroup);
    }
  ////$this->output->enable_profiler(true);
  redirect('admin');
}
//===========end===========================================

//===========Prestation====================================
function prest_add(){
  $addedPrestDescr = $this->input->post('addedPrestDescr');
  $addedPrestGrp = $this->input->post('addedPrestGrp');
  if(null !== $addedPrestGrp)
    if(null !== $addedPrestDescr)
      if("Nouvelle prestation" !=$addedPrestDescr)
        if('' !=$addedPrestDescr)
          $this->prestation_model->addPrest($addedPrestGrp,$addedPrestDescr);

  ////$this->output->enable_profiler(true);
  redirect('admin');
}
function prest_edit(){
  $prestations = $this->input->post('prestations');
  if(null !== $prestations)
    foreach ($prestations as $key => $prestation) {
      $prestation['id_prestation']=$key;
      if(false ==(isset($prestation['isActiv'])))
        $prestation['isActiv']=0;
      $this->prestation_model->updatePrest($prestation);
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
//============end===========================================

//==========Origines========================================
function origines_add(){
  $addOrigine = $this->input->post('addOrigine');
  if(null !== $addOrigine){
       if("Nouvelle origine" !=$addedthema['name']){
         if(''!=$addOrigine['name']){
           $this->origines_model->insert($addOrigine['parent'],$addOrigine['name']);
         }
       }
    }
    redirect('admin');
}

function origine_defaultEdit(){
  $origineDefault=$this->input->post('origineDefault');
  if(null!=$origineDefault)
    $this->origines_model->setDefaultName($origineDefault);
  redirect('admin');
}
function origines_edit(){
  $origines = $this->input->post('origines');
  if(null !== $origines)
    foreach ($origines as $key => $origine) {
      if(false==isset($origine['actived']))
        $origine['actived']=0;
      $this->origines_model->updateElement($origine);
    }
      redirect('admin');
}

//============end===========================================


}
