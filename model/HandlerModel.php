<?php
class HandlerModel {

  // check data
  public static function cData($data) {
    foreach($data as $e) {

      if (!isset($e['check'])) {
        if ($e['value'] == false) {
          $_SESSION[$e['key']] = 'error';
          header('Location: '.$_SERVER['HTTP_REFERER']);
        }
      }
    }

    return true;
  }

  // unsert into
  public static function ii($data) {

    $ii = '';
    foreach ($data as $e) {
      $ii .= '`'.$e['key'].'`, ';
    }
    $ii = substr($ii, 0, -2);

    return $ii;
  }

  // values
  public static function values($data) {

    $values = 'VALUES (';
    foreach ($data as $e) {
      $values .= ':'.$e['key'].', ';
    }
    $values = substr($values, 0, -2);
    $values .= ')';

    return $values;
  }

  // blind param
  public static function bp($result, $data) {
    foreach($data as $e){

      if ($e['type'] == 'int') {
        $result->bindParam(':'.$e['key'], $e['value'], PDO::PARAM_INT);
      } else {
        $result->bindParam(':'.$e['key'], $e['value'], PDO::PARAM_STR);
      }

    }

    return $result;
  }
}
?>