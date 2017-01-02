<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$user = $this->tank_auth->get_user_id();
	    $past = $this->intervention_model->getOldByIntervenant($user);
	    $futur = $this->intervention_model->getFutursByIntervenant($user);

	    if($this->tank_auth->get_groupId()==500){
	      $past = $this->intervention_model->getOld();
	      $futur = $this->intervention_model->getFuturs();
	    }

	    $data = array(
	      'futur' => $futur,
	      'past' => $past
	     );
	    $this->load->view('dashBoard/general',$data);

/*
		$user_id	= $this->tank_auth->get_user_id();
		$user=$this->intervenant_model->getIntervenantById($user_id);
		$data['user']=$user;
		$this->load->view('welcome', $data);
		*/
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
