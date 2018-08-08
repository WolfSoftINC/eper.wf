<?php
class UserModel {

  // check name
  public static function name($name){
    if (strlen($name) == 0)
      return false;
    $name = trim($name);

    if (strlen($name) > 40) return false;
    else return htmlspecialchars($name);
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

  /*проверка телефон*/
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

  // password
  public static function cpassword($pass){
    require_once(ROOT.'/function/all/gen.php');

    if ((strlen($pass) < 7) AND (strlen($pass) > 25)) return false;
    else {
        $pass = code('3cvy7Xx', $pass);
        return ($pass);
    }
  }

  public static function registry($data) {

  }

}
?>