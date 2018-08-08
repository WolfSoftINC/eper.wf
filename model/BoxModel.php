<?php
class BoxModel {

  // verification of existence product
  public static function cProduct($data) {

    // connect data
    $db = Db::connect();

    // sql
    $sql = "SELECT * FROM `want_buy` WHERE `product_id` = $id AND `user_id` = $uid;";
    $result = $db -> prepare($sql);
    $result -> execute();
  }

  // add product
  public static function aProduct($data) {

    // connect data
    $db = Db::connect();

    $sql = "INSERT INTO `want_buy` (`id`, `product_id`, `number`, `ip`, `dr`)
            VALUES (NULL, :product_id, :number, :ip, :dr);";
    $result = $db->prepare($sql);

    // blind param
    $result->bindParam(":product_id", $data['product_id'], PDO::PARAM_INT);
    $result->bindParam(":number", $data['number'], PDO::PARAM_INT);
    $result->bindParam(":ip", $data['ip'], PDO::PARAM_STR);
    $result->bindParam(":dr", $data['dr'], PDO::PARAM_INT);

    if ($result->execute()){
      return $db->lastInsertId(); 
    } else return false;
  }
}
?>