<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Prestation_Model extends CI_Model
{

  const prestation_Table      = 'prestation';
  const group_Table           = 'prestation-group';
  const group_join_claus      = 'prestation.prestation_group = prestation-group.id_presstationGroup';
  const indirect_Link_LinkTable     = 'indirect_has_prestations';
  const indirect_join_clause = 'indirect_has_prestations.indirect_id =prestation.id_prestation';


  function __construct(){
    parent::__construct();
  }

  function getTree(){
    $this->db->select('*');
    $this->db->from(self::group_Table);
    $this->db->where('isActiv', 1);
    $query =$this->db->get();

    $raw = $query->result_array();

    $root = array();
    foreach ($raw as $key => $row){
      $root[$row['id_presstationGroup']]['id_presstationGroup']= $row['id_presstationGroup'];
      $root[$row['id_presstationGroup']]['presstationGroup_descr']= $row['presstationGroup_descr'];
      $this->_populateTree($root[$row['id_presstationGroup']]);
    }
    return $root;
  }

  function _populateTree(&$group){
    $this->db->select('*');
    $this->db->from(self::prestation_Table);
    $this->db->where('prestation_group', $group['id_presstationGroup']);
    $this->db->where('isActiv', 1);
    $query =$this->db->get();

    $raw = $query->result_array();
    $prestations = array();
    foreach ($raw as $key => $row){
      $prestations[$row['id_prestation']]= $row['prestation_descr'];
    }
    $group['prestations']=$prestations;
  }


}
