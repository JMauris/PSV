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
    if (!$this->tank_auth->is_logged_in()) {
      redirect('');
}
  }


  function index()
  {
    $user = $this->tank_auth->get_user_id();
    $intervenants_Actif = $this->intervenant_model->getAllIntervenant();
    $intervenants_Inactif = $this->intervenant_model->getAllOldIntervenant();
    $data = array(
      'intervenants_Actif' => $intervenants_Actif,
      'intervenants_Inactif' => $intervenants_Inactif,
      'user'  =>  $user
     );


    $this->load->view('administration/admin',$data);

  }

  function updateStatues()
  {
    $this->output->enable_profiler(true);
   $id = $this->input->post('intervenant');
   $currentIntervenant = $this->intervenant_model->getIntervenantById($id);
   if($currentIntervenant['activated']==1)
   {
     $currentIntervenant['activated']=0;
     }elseif ($currentIntervenant['activated']==0) {
       $currentIntervenant['activated']=1;
     }

     $this->intervenant_model->updateStatus($id,$currentIntervenant);

     redirect('/admin/');

  }

  function edit()
  {
    $this->output->enable_profiler(true);
    $intervenant = $this->input->post('intervenant');
    $data=$intervenant;
    var_dump($intervenant);
      $this->load->view('administration/intervenantEdit',$data);
      $this->load->view('auth/change_email_form');
      $this->load->view('auth/change_password_form');
      $this->load->view('auth/forgot_password_form');


}
}
