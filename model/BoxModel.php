<?php
class BoxModel {

  // verification of existence product
  public static function cProduct($filter) {

    // filter
    $where = '';
    if ($filter) {
      $where = 'WHERE ';
      foreach($filter as $sort) {
        if ($sort['type'] == 'int') {
          $where .= '`'.$sort['key'].'` = '.$sort['value'].' AND ';
        } else {
          $where .= "`".$sort['key']."` = '".$sort['value']."' AND ";
        }
      }
      $where = substr($where, 0, -5);
    }

    // connect data
    $db = Db::connect();

    $sql = "SELECT COUNT(*) FROM want_buy $where;";
    $result = $db->prepare($sql);

    if ($result->execute()){
      $row = $result->fetch();

      return $row['COUNT(*)'];
    } else return false;
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

  // get product list
  public static function lProduct($data) {
    // connect data
    $db = Db::connect();

    // select element
    $keys = array(
      'id' => 'product_id',
      'number' => 'number',
    );
    $select = '';
    foreach($keys as $id => $key) {
      $select .= '`'.$key.'`, ';
    }
    $select = substr($select, 0, -2);


    // filter
    $filer = '';
    if (isset($data['ip'])) {
      $filter = "WHERE ip = '".$data['ip']."'";
    }


    // sql
    $sql = "SELECT $select FROM `want_buy` $filter;";
    
    $result = $db->prepare($sql);

    if ($result->execute()) {
      $list = array();
      
      $i = 0;
      while($row = $result->fetch()) {

        foreach($keys as $id => $key) {
          $list[$i][$id] = $row[$key];
        }

        $i++;
      }

      return $list;
    } else return false;
  }
}
?>