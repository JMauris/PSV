<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Places_Model extends CI_Model
{
  const places_table            = 'place';
  const kind_table              = 'place_kind';
  const kind_join_claus         = 'place.kind = place_kind.id_kind';
  const adresses_table          = 'adresses';
  const adresses_join_claus     = 'adresses.place_Id = place.id_lieu';
  const citys_table             = 'citys';
  const citys_join_claus        = 'adresses.city = citys.id_city';


  function __construct(){
    parent::__construct();
  }
  //====================Selection=================================
  //==places opérations==
  function getAll(){
    $this->db->select('*');
    $this->db->from(self::places_table);
    $this->db->join(self::kind_table, self::kind_join_claus);
    $query =$this->db->get();

    $raw = $query->result_array();
    foreach ($raw as $key => $row)
      $this->_addAdress($raw[$key]);

    return $raw;
  }
  function getActives(){
    $this->db->select('*');
    $this->db->from(self::places_table);
    $this->db->join(self::kind_table, self::kind_join_claus);
    $this->db->where(self::places_table.'.actived', 1);
    $query =$this->db->get();

    $raw = $query->result_array();
    foreach ($raw as $key => $row)
      $this->_addAdress($raw[$key]);

    return $raw;
  }
  function getById($id){
    $this->db->select('*');
    $this->db->from(self::places_table);
    $this->db->join(self::kind_table, self::kind_join_claus);
    $this->db->where(self::places_table.'.id_lieu', $id);
    $query =$this->db->get();

    if ($query->num_rows() != 1){
        return null;
    }
    $raw = $query->result_array();
    $place = $raw['0'];
    $this->_addAdress($place);

    return $place;
  }
  function getCitys(){
    $this->db->select('*');
    $this->db->from(self::citys_table);
    $this->db->order_by("npa", "ASC");
    $this->db->where('activated', 1);
    $query =$this->db->get();
    $raw = $query->result_array();
    return $raw;
  }
  function getKinds(){
    $this->db->select('*');
    $this->db->from(self::kind_table);
    $this->db->order_by("descr", "ASC");
    $this->db->where('kind_actived', 1);
    $query =$this->db->get();
    $raw = $query->result_array();
    return $raw;
  }
  function getAllKinds(){
    $this->db->select('*');
    $this->db->from(self::kind_table);
    $this->db->order_by("descr", "ASC");
    $query =$this->db->get();
    $raw = $query->result_array();
    return $raw;
  }
  //====================Insertion=================================
  //==places opérations==
  function insert($name, $kind){
    $insertRow = array(
      'Name' => $name,
      'kind' => $kind
      );
   $this->db->insert(self::places_table, $insertRow);
   return $this->db->insert_id();
  }
  //==kinds opérations====
  function insertKind($name){
    $inserted = array('descr' => $name);
    return $this->db->insert(self::kind_table, $inserted);
  }
  //====================Update====================================
  //==places opérations==
  function setPlaceActivation($id,$activated){
    $this->db->where('id_lieu', $id);
    $partialRow = array('actived' => $activated);
    $this->db->update(self::places_table, $partialRow);
  }
  function update($place){
    $id = $place['id_lieu'];
    $line = array(
      'Name' => $place['Name'],
      'kind' => $place['kind']
    );
    $this->db->where('id_lieu', $id);
    $this->db->update(self::places_table, $line);
  }
  //==kinds opérations====
  function updateKind($kind){
    $line = array(
      'descr'         => $kind['descr'],
      'kind_actived'  => $kind['kind_actived']
    );
    $this->db->where('id_kind', $kind['id_kind']);
    $this->db->update(self::kind_table, $line);
  }
  //==adresses opérations=
  function insertAdress($placeId, $line_1, $line_2, $cityId){
    if($cityId == 0)
      return;
    $adresse = array(
      'place_Id' => $placeId,
      'line_1' => $line_1,
      'line_2' => $line_2,
      'city'   => $cityId
    );
    return $this->db->insert(self::adresses_table, $adresse);
  }
  function removeAdress($placeId){
    $this->db->where('place_Id', $placeId);
    $this->db->delete(self::adresses_table);
  }
  function updateAdress($adresse){
    $id = $adresse['place_Id'];
    $line = array(
      'line_1' => $adresse['line_1'],
      'line_2' => $adresse['line_2'],
      'city' => $adresse['city']
    );
    $this->db->where('place_Id', $id);
    $this->db->update(self::adresses_table, $line);
  }
  //==cities opérations===
  function unactivCity($id){
    echo "\n unactiv ".$id."\n";
    $line = array('activated' => 0);
    $this->db->where('id_city', $id);
    $this->db->update(self::citys_table, $line);
  }
  function activateCityByNpa($npa){
    $this->activateCityRange($npa, $npa);
  }
  function unactivateCityByNpa($npa){
    $this->unactivateCityRange($npa, $npa);
  }
  function activateCityRange($npaLow, $npaUp){
    $this->db->simple_query("UPDATE `citys` SET `activated` = '1'
        WHERE npa BETWEEN '$npaLow' AND '$npaUp';");
  }
  function unactivateCityRange($npaLow, $npaUp){
    $this->db->simple_query("UPDATE `citys` SET `activated` = '0'
        WHERE npa BETWEEN '$npaLow' AND '$npaUp';");
  }
  function activateCityByName($name){
    $this->db->simple_query("UPDATE `citys` SET `activated` = '1'
        WHERE name ='$name';");
  }
  function unactivateCityByName($name){
    $this->db->simple_query("UPDATE `citys` SET `activated` = '0'
        WHERE name ='$name';");
  }
  //====================Delete====================================
  //====================Internal==================================

  function _addAdress(&$place){
    $id = $place['id_lieu'];
    $this->db->select('*');
    $this->db->from(self::adresses_table);
    $this->db->join(self::citys_table, self::citys_join_claus);
    $this->db->where('place_Id', $id);
    $query = $this->db->get();
    if ($query->num_rows() != 1){
        return $place['adresse'] = NULL;
    }
    $raw = $query->result_array();
    $place['adresse'] = $raw[0];
  }

}
