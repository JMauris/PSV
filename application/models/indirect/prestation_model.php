<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Prestation_Model extends CI_Model
{

  const prestation_Table      = 'prestation';
  const group_Table           = 'prestation-group';


  function __construct(){
    parent::__construct();
  }
  function getGroups(){
    $this->db->select('*');
    $this->db->order_by("position", "asc");
    $this->db->from(self::group_Table);
    $query =$this->db->get();

    $raw = $query->result_array();

    return $raw;
  }
  function getPrestations(){
    $queryTxt = "SELECT prestation.id_prestation,
    prestation.prestation_group,
    prestation.prestation_descr,
    prestation.isActiv,
    `prestation-group`.`position` as parent_position,
    prestation.position
FROM psv.prestation
join `prestation-group`
	on `prestation-group`.id_presstationGroup = prestation.prestation_group
order by parent_position , position";

    $query =$this->db->query($queryTxt);
    $raw = $query->result_array();

    return $raw;
  }

  function getTree(){
    $this->db->select('*');
    $this->db->order_by("position", "asc");
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
  function getFullTree(){
    $this->db->select('*');
    $this->db->order_by("position", "asc");
    $this->db->from(self::group_Table);
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
    $this->db->order_by("position", "asc");
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
  function fullPopulate(&$group){
    $this->db->select('*');
    $this->db->order_by("position", "asc");
    $this->db->from(self::prestation_Table);
    $this->db->where('prestation_group', $group['id_presstationGroup']);
    $query =$this->db->get();

    $raw = $query->result_array();
    $prestations = array();
    foreach ($raw as $key => $row){
      $prestations[$row['id_prestation']]= $row['prestation_descr'];
    }
    $group['prestations']=$prestations;
  }
  function addGroup($descr){
    $added = array(
      'presstationGroup_descr' => $descr);
    $this->db->insert(self::group_Table,$added);
  }
  function addPrest($groupId, $descr){
    $added = array(
      'prestation_group' => $groupId,
      'prestation_descr' => $descr
      );
    $this->db->insert(self::prestation_Table,$added);

  }
  function updateGroup($prestGroup){
    $this->db->select('*');
    $this->db->from(self::group_Table);
    $this->db->where('id_presstationGroup', $prestGroup['id_presstationGroup']);
    $query =$this->db->get();

    if ($query->num_rows() != 1)
        return;

    $grpRow = $query->result_array()[0];
    foreach($grpRow as $key => $value){
      if(true ==isset($prestGroup[$key]))
            $grpRow[$key]=$prestGroup[$key];
    }
    if($grpRow['position']<1)
      $grpRow['position']=1;
    $this->db->where('id_presstationGroup', $prestGroup['id_presstationGroup']);
    $this->db->update(self::group_Table, $grpRow);
  }
  function updatePrest($prest){
    $this->db->select('*');
    $this->db->from(self::prestation_Table);
    $this->db->where('id_prestation', $prest['id_prestation']);
    $query =$this->db->get();

    if ($query->num_rows() != 1)
        return;

    $prestRow = $query->result_array()[0];
    foreach($prestRow as $key => $value){
      if(true ==isset($prest[$key]))
            $prestRow[$key]=$prest[$key];
    }
    if($prestRow['position']<1)
      $prestRow['position']=1;
    $this->db->where('id_prestation', $prest['id_prestation']);
    $this->db->update(self::prestation_Table, $prestRow);
  }


}
