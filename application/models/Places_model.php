<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Places_Model extends CI_Model
{
  const place_table           = 'place';
  const placeKind_table       ='place_kind';
  const placeKind_join_claus  = 'place.kind = place_kind.id_kind';


  const adresses_table        ='adresses';
  const city_table            ='citys';
  const city_join_claus       = 'adresses.city = citys.id_city';


  function __construct(){
    parent::__construct();
  }

  function getActives(){
    $this->db->select('*');
    $this->db->from(self::place_table);
    $this->db->join(self::placeKind_table, self::placeKind_join_claus);
    $this->db->where('actived', 1);
    $query = $this->db->get();
    $raw = $query->result_array();
    foreach ($raw as $key => $row)
      $this->_addAdress($raw[$key]);

    return $raw;
  }
  function _addAdress(&$place)
  {
    $id = $place['adresse'];
    if(null == $id)
      return;
    $this->db->select('*');
    $this->db->from(self::adresses_table);
    $this->db->join(self::placeKind_table, self::placeKind_join_claus);
    $this->db->join(self::city_table, self::city_join_claus);
    $this->db->where('id_adresse', $id);
    $query = $this->db->get();
    $raw = $query->result_array();
    $place['adresse'] = $raw;
  }
  /*
  function getOldByIntervenant($id){
    $this->db->select('*');
    $this->db->from(self::intervention_Table);
    $this->db->join(self::kind_Table, self::kind_join_claus);
    $this->db->join(self::place_Table, self::place_join_claus);
    $this->db->where('date <', 'CURRENT_DATE()', FALSE);
    $this->db->where('intervenant_id', $id);
    $this->db->where('parent', null);
    $this->db->order_by("date", "desc");
    $query = $this->db->get();
    $raw = $query->result_array();
    foreach ($raw as $key => $row) {
      unset($raw[$key]['intervenant_id']);
      unset($raw[$key]['duration']);
      unset($raw[$key]['extraCost']);
      unset($raw[$key]['distance']);
      unset($raw[$key]['parent']);
      unset($raw[$key]['person_id']);
      unset($raw[$key]['kind_id']);
      unset($raw[$key]['kind']);
      unset($raw[$key]['adresse']);
      unset($raw[$key]['actived']);
      if($raw[$key]['id_kind']==4)
        $raw[$key]['subClass']='demarche';
      else
        $raw[$key]['subClass']='meeting';
    }
    return $raw;
  }
  function getFuturs(){
    $this->db->select('*');
    $this->db->from(self::intervention_Table);
    $this->db->join(self::kind_Table, self::kind_join_claus);
    $this->db->join(self::intervenant_Table, self::intervenant_join_claus);
    $this->db->join(self::place_Table, self::place_join_claus);
    $this->db->where('date >=', 'CURRENT_DATE()', FALSE);
    $this->db->where('parent', null);
    $this->db->order_by("date", "desc");
    $query = $this->db->get();
    $raw = $query->result_array();
    foreach ($raw as $key => $row) {
      unset($raw[$key]['intervenant_id']);
      unset($raw[$key]['duration']);
      unset($raw[$key]['extraCost']);
      unset($raw[$key]['distance']);
      unset($raw[$key]['parent']);
      unset($raw[$key]['person_id']);
      unset($raw[$key]['kind_id']);
      unset($raw[$key]['kind']);
      unset($raw[$key]['adresse']);
      unset($raw[$key]['actived']);
      unset($raw[$key]['password']);
      unset($raw[$key]['email']);
      unset($raw[$key]['activated']);
      unset($raw[$key]['banned']);
      unset($raw[$key]['ban_reason']);
      unset($raw[$key]['new_password_key']);
      unset($raw[$key]['new_password_requested']);
      unset($raw[$key]['new_email']);
      unset($raw[$key]['new_email_key']);
      unset($raw[$key]['last_ip']);
      unset($raw[$key]['last_login']);
      unset($raw[$key]['created']);
      unset($raw[$key]['modified']);
      unset($raw[$key]['group_id']);
      if($raw[$key]['id_kind']==4)
        $raw[$key]['subClass']='demarche';
      else
        $raw[$key]['subClass']='meeting';
    }
    return $raw;
  }
  function getOld(){
    $this->db->select('*');
    $this->db->from(self::intervention_Table);
    $this->db->join(self::kind_Table, self::kind_join_claus);
    $this->db->join(self::intervenant_Table, self::intervenant_join_claus);
    $this->db->join(self::place_Table, self::place_join_claus);
    $this->db->where('date <', 'CURRENT_DATE()', FALSE);
    $this->db->where('parent', null);
    $this->db->order_by("date", "desc");
    $query = $this->db->get();
    $raw = $query->result_array();
    foreach ($raw as $key => $row) {
      unset($raw[$key]['intervenant_id']);
      unset($raw[$key]['duration']);
      unset($raw[$key]['extraCost']);
      unset($raw[$key]['distance']);
      unset($raw[$key]['parent']);
      unset($raw[$key]['person_id']);
      unset($raw[$key]['kind_id']);
      unset($raw[$key]['kind']);
      unset($raw[$key]['adresse']);
      unset($raw[$key]['actived']);
      unset($raw[$key]['password']);
      unset($raw[$key]['email']);
      unset($raw[$key]['activated']);
      unset($raw[$key]['banned']);
      unset($raw[$key]['ban_reason']);
      unset($raw[$key]['new_password_key']);
      unset($raw[$key]['new_password_requested']);
      unset($raw[$key]['new_email']);
      unset($raw[$key]['new_email_key']);
      unset($raw[$key]['last_ip']);
      unset($raw[$key]['last_login']);
      unset($raw[$key]['created']);
      unset($raw[$key]['modified']);
      unset($raw[$key]['group_id']);
      if($raw[$key]['id_kind']==4)
        $raw[$key]['subClass']='demarche';
      else
        $raw[$key]['subClass']='meeting';
    }
    return $raw;
  }


  function _delete(&$intervention){
    $this->db->where('id_intrevention',$intervention['id_intrevention']);
    $this->db->delete(self::intervention_Table);

  }
  function _populate(&$intervention){
    $this->_addIntervenant($intervention);
    $this->_addKind($intervention);
    $this->_addPlace($intervention);
    $this->_addMaterial($intervention);
    $this->_addThematics($intervention);
    $this->_addPersons($intervention);
  }
  function _addIntervenant(&$intervention){
    $intervention['intervenant'] =
        $this->intervenant_model->getIntervenantById($intervention['intervenant_id']);
  }
  function _addKind(&$intervention){
    $this->db->where('id_kind', $intervention['kind_id']);
    $query = $this->db->get('intrevention_kinds');
    $kind = $query->result_array(0);
    $intervention['kind'] = $kind[0];
  }
  function _addPlace(&$intervention){
    $intervention['place'] =
        $this->place_model->getById($intervention['place_id']);
  }
  function _addMaterial(&$intervention){
    $this->db->where('intrevention_id', $intervention['id_intrevention']);
    $query = $this->db->get(self::material_LinkTable);
    $rows = $query->result_array();
    $materialsForInter= array();
    foreach ($rows as $key => $row) {
      $materialsForInter[$row['material_id']]=$row['quantity'];
    }
    $intervention['materials']=$materialsForInter;
  }
  function _addThematics(&$intervention){
    $this->db->where('intervention_id', $intervention['id_intrevention']);
    $query = $this->db->get('intervention_has_thematics');
    $rows = $query->result_array();
    $thematics= array();
    foreach ($rows as $key => $row) {
        array_push($thematics, $row['thematic_id']);
    }
    $intervention['thematics']=$thematics;
  }
  function _updateThematics($interventionId, $thematicsIdsArray){

    $this->db->where('intervention_id',$interventionId);
    $this->db->delete(self::thematics_LinkTable);
    foreach ($thematicsIdsArray as $key => $value) {
      $row = array(
        'intervention_id' => $interventionId,
        'thematic_id' => $value
      );
      $this->db->insert(self::thematics_LinkTable, $row);
    }
  }
  function _updateMaterials($interventionId, $materialsArray){
    $this->db->where('intrevention_id',$interventionId);
    $this->db->delete(self::material_LinkTable);
    foreach ($materialsArray as $key => $value) {
      if($value >0){
        $row = array(
          'intrevention_id' => $interventionId,
          'material_id' => $key ,
          'quantity' => $value
        );
        $this->db->insert(self::material_LinkTable, $row);
      }
    }
  }
*/
}
