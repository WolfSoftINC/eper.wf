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
    if (strlen($a) == 0) return false;
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
    
    // del all space
    $mail = trim($mail);
    str_replace(' ','',$mail);

    // check mail
    if (strlen($mail) == 0)
      return false;

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