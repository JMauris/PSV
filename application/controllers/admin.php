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

  //  //$this->output->enable_profiler(true);
    $intervenants = $this->input->post('intervenants');
    if(null !== $intervenants)
    {
      foreach ($intervenants as $key => $intervenant) {
          if(FALSE==isset($intervenant['activated']))
            $intervenant['activated']=0;
          $this->intervenant_model->update($intervenant);

      }
    }


    $user = $this->tank_auth->get_user_id();
    $intervenants= $this->intervenant_model->getAllFullIntervenant();
    $roles = array(
      '300' => 'user' ,
      '500' => 'admin' ,
    );
    $data = array(
      'intervenants' => $intervenants,
      'roles' => $roles
     );


    $this->load->view('administration/admin',$data);

  }

  function updateStatues()
  {
    ////$this->output->enable_profiler(true);
  /* $id = $this->input->post('intervenants');

   $currentIntervenant = $this->intervenant_model->getIntervenantById($id);
   if($currentIntervenant['activated']==1)
   {
     $currentIntervenant['activated']=0;
     }elseif ($currentIntervenant['activated']==0) {
       $currentIntervenant['activated']=1;
     }

     $this->intervenant_model->updateStatus($id,$currentIntervenant);

     redirect('/admin/');*/

  }

  function edit()
  {
    ////$this->output->enable_profiler(true);
    $intervenant = $this->input->post('intervenant');
    $data=$intervenant;
    var_dump($intervenant);
    /*  $this->load->view('administration/intervenantEdit',$data);
      $this->load->view('auth/change_email_form');
      $this->load->view('auth/change_password_form');
      $this->load->view('auth/forgot_password_form');*/


}
}
