<?php
class UserModel {

  // check name
  public static function name($name){
    $name = trim($name);

    // check length
    if ((strlen($name) > 40) OR (strlen($name) < 1)) return false;
    else return htmlspecialchars($name);
  }

  // check phone
  public static function phone($a){
    if (strlen($a) == 0)
      return false;
    $a = preg_replace('~[^0-9]+~','',$a);

    // check
    if ((strlen($a) > 20) || (strlen($a) < 7)) return false;
    else {
      $a = '+996 ('.substr($a, strlen($a)-9, 3).') '.substr($a, strlen($a)-6, 3).' - '.substr($a, strlen($a)-3, 3);
      return htmlspecialchars($a);
    }
  }

  // check mail
  public static function mail($mail){
    if (strlen($mail) == 0)
      return false;
    str_replace(' ','',$mail);

    if (preg_match("/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)*\.([a-zA-Z]{2,6})$/", $mail)) {
      return htmlspecialchars($mail);
    } else {
      return false;
    }
  }

  // check password
  public static function password($pass){

    if ((strlen($pass) < 7) AND (strlen($pass) > 32)) return false;
    else {
      return htmlspecialchars($pass);
    }
  }

  // get user data
  public static function get_data($data){
    $db = Db::connect();
    $id = $data['id'];
    
    $sql = "SELECT * FROM  `user` WHERE  `user_id` = $id";
    $keys = array("user_id", "login", "password", "name", "phone", "mail", "dr");
    
    $result = $db -> prepare($sql);
    $result -> execute();
    
    $row = $result -> fetch();
    $list = array();

    foreach($keys as $key) {
      $list[$key] = $row[$key];
    }

    return $list;
  }

  // user registry
  public static function registry($data) {
    $db = Db::connect();

    // insert into keys
    $ii = HandlerModel::ii($data);

    // values
    $values = HandlerModel::values($data);

    // sql code
    $sql = "INSERT INTO user ($ii) $values;";

    $result = $db->prepare($sql);

    // blind param
    $result = HandlerModel::bp($result, $data);

    if ($result->execute()){
      return $db->lastInsertId(); 
    } else return false;
  }

}
?>