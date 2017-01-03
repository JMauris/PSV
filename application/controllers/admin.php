<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 */
class Admin extends CI_Controller
{

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


  function index()
  {

//$this->output->enable_profiler(true);


    $intervenants = $this->input->post('intervenants');
    if(null !== $intervenants)
    {
      foreach ($intervenants as $key => $intervenant) {
          if(FALSE==isset($intervenant['activated']))
            $intervenant['activated']=0;
          $this->intervenant_model->update($intervenant);

      }
    }
    $genres = $this->input->post('genres');
    if(null !== $genres)
    {
      foreach ($genres as $key => $genre) {
          if(FALSE==isset($genre['activated']))
            $genre['activated']=0;
          $this->gender_model->update($genre);

      }
    }
    $ageGroups = $this->input->post('ageGroups');
    if(null !== $ageGroups)
    {
      foreach ($ageGroups as $key => $ageGroup) {
          if(FALSE==isset($ageGroup['activated']))
            $ageGroup['activated']=0;
          $this->agegroup_model->update($ageGroup);

      }
    }
    $sexualitys = $this->input->post('sexualitys');
    if(null !== $sexualitys)
    {
      foreach ($sexualitys as $key => $sexuality) {
          if(FALSE==isset($sexuality['activated']))
            $sexuality['activated']=0;
          $this->sexuality_model->update($sexuality);

      }
    }

      $newGroupAge = $this->input->post('newGroupAge');
      if(null !== $newGroupAge)
      {
          $this->agegroup_model->insert_AgeGroup($newGroupAge);
      }

      $newSexuality = $this->input->post('newSexuality');
      if(null !== $newSexuality)
      {
          $this->sexuality_model->insert_sexuality($newSexuality);
      }

      $newGender = $this->input->post('newGender');
      if(null !== $newGender)
      {
          $this->gender_model->insert_gender($newGender);
      }

    $user = $this->tank_auth->get_user_id();
    $intervenants= $this->intervenant_model->getAllFullIntervenant();
    $genres= $this->gender_model->getAllFullGender();
    $sexualitys= $this->sexuality_model->getAllFullSexuality();
    $ageGroups= $this->agegroup_model->getAllFullAgeGroup();

    $roles = array(
      '300' => 'user' ,
      '500' => 'admin' ,
    );
    $data = array(
      'intervenants' => $intervenants,
      'genres'=> $genres,
      'sexualitys'=>$sexualitys,
      'ageGroups'=>$ageGroups,
      'roles' => $roles
     );

    //var_dump($data);
    $this->load->view('administration/admin',$data);

  }


}
