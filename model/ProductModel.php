<?php
class ProductModel {
  
  // check name
  public static function name($name) {
    
    $name = trim($name);
    if ((strlen($name) > 64) OR (strlen($name) < 1)) {
      return false;
    } else {
      return htmlentities($name);
    }
  }

  // check price
  public static function price($price) {

    // price pattern
    $pattern = '/^[0-9]{1,32}$/';
    $pattern_float = '/^\d+(:?[.]\d{2})$/';

    // check
    if ((preg_match($pattern, $price) == '0') AND (preg_match($pattern_float, $price) == '0')) {
      return false;
    } else {
      return $price;
    }
  }

  // check descrip
  public static function descrip($descrip) {
    
    $descrip = trim($descrip);
    if ((strlen($descrip) > 256) OR (strlen($descrip) < 1)) {
      return false;
    } else {
      return $descrip;
    }
  }


  // add product
  public static function add($data){
    $db = Db::connect();

    // sql
    $sql = "INSERT INTO product (`product_id`, `name`, `price`, `descrip`, `img`, `shop_id`, dr) 
    VALUES (NULL, :name, :price, :descrip, :img, :shop_id, :dr);";

    $result = $db->prepare($sql);

    // blind param
    $result->bindParam(":name", $data['name'], PDO::PARAM_STR);
    $result->bindParam(":price", $data['price'], PDO::PARAM_INT);
    $result->bindParam(":descrip", $data['descrip'], PDO::PARAM_STR);
    $result->bindParam(":img", $data['img'], PDO::PARAM_STR);

    $result->bindParam(":shop_id", $data['shop_id'], PDO::PARAM_INT);
    $result->bindParam(":dr", $data['dr'], PDO::PARAM_INT);

    if ($result->execute()){
      return $db->lastInsertId(); 
    } else return false;
  }


  // get list
  public static function gList($data){

    $db = Db::connect();

    // filter
    $filter = '';
    $filter = 'WHERE shop_id = '.$data['shop_id'];

    // keys
    $select = '';
    $keys = array('product_id', 'name', 'price', 'img');
    foreach ($keys as $key) {
      $select .= '`'.$key.'`, ';
    }
    // del last simvol
    $select = substr($select, 0, -2);

    $sql = "SELECT $select FROM product $filter";

    $result = $db->prepare($sql);
    if ($result->execute()) {
      $list = array();

      $i = 0;
      while($row = $result->fetch()){

        foreach ($keys as $key) {
          $list[$i][$key] = $row[$key];
        }

        $i++;
      }

      return $list;
    } else return false;
  }

  // get data
  public static function gd($filter, $keys){

    $db = Db::connect();

    // filter
    $where = '';
    if ($filter) {
      $where = 'WHERE ';

      foreach($filter as $sort){

        if ($sort['type'] == 'int') {
          $where .= '`'.$sort['key'].'` ='.$sort['value'];
        } else {
          $where .= "`".$sort['key']."` ='".$sort['value']."'";
        }
        
      }
    }

    // keys
    $select = '';
    foreach ($keys as $key) {
      $select .= '`'.$key.'`, ';
    }
    // del last simvol
    $select = substr($select, 0, -2);

    // sql
    $sql = "SELECT $select FROM product $where";

    $result = $db->prepare($sql);
    if ($result->execute()) {
      $list = array();

      $i = 0;
      while($row = $result->fetch()){

        foreach ($keys as $key) {
          $list[$i][$key] = $row[$key];
        }

        $i++;
      }

      return $list;
    } else return false;
  }
}
?>