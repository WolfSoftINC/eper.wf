<?php
class UserModel {
  
  public static function clogin($login){
    if (strlen($login) == 0)
      return false;
    $login = trim($login);

    if ((strlen($login) < 7) || (strlen($login) > 25) || (!preg_match('/^[a-zA-Z0-9_.]{7,25}$/',$login)) || (substr($login,0,1) == '_') || (substr($login,0,1) == '.')) return false;
    else return htmlspecialchars(trim($login));
  }

  // update login
  public static function update_login($id, $login)
  {
    $db = Db::connect();

    $sql = "UPDATE  `user41367_dev`.`user` SET  `login` =  :login WHERE  `user`.`user_id` = $id;";
    $result = $db->prepare($sql);
    $result->bindParam(":login", $login, PDO::PARAM_STR);
    
    $ok =  $result->execute();
    
    return $ok;
  }

  // check name
  public static function name($name){
    $name = trim($name);

    // check length
    if ((strlen($name) > 40) OR (strlen($name) < 1)) return false;
    else return htmlspecialchars($name);
  }
  // update name
  public static function update_name($id, $name)
  {
    $db = Db::connect();

    $sql = "UPDATE  `user41367_dev`.`user` SET  `name` =  :name WHERE  `user`.`user_id` = $id;";
    $result = $db->prepare($sql);
    $result->bindParam(":name", $name, PDO::PARAM_STR);
    
    $ok =  $result->execute();
    
    return $ok;
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

  // update phone
  public static function update_phone($id, $name)
  {
    $db = Db::connect();

    $sql = "UPDATE  `user41367_dev`.`user` SET  `name` =  :name WHERE  `user`.`user_id` = $id;";
    $result = $db->prepare($sql);
    $result->bindParam(":name", $name, PDO::PARAM_STR);
    
    $ok =  $result->execute();
    
    return $ok;
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