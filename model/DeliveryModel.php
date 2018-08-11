<?php
class DeliveryModel {
  
  // check country
  public static function country($country) {
    return $country;
  }

  // check city 
  public static function city($city) {
    return $city;
  }

  public static function address($address) {
    return $address;
  }

  // delivery registry
  public static function registry($data) {

    // table
    $table = 'delivery';

    // insert into keys
    $ii = HandlerModel::ii($data);

    // values
    $values = HandlerModel::values($data);

    $db = Db::connect();
    // sql code
    $sql = "INSERT INTO $table ($ii) $values;";

    $result = $db->prepare($sql);

    // blind param
    $result = HandlerModel::bp($result, $data);

    if ($result->execute()){
      return $db->lastInsertId(); 
    } else return false;
  }
}
?>