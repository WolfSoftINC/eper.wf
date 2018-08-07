<?php
class ImageModel {

  // upload image
  public static function upload($file_name, $url) {

    // move uploaded
    move_uploaded_file($_FILES[$file_name]['tmp_name'], $url);
  }

  // get type
  public static function gtype($name) {

    $names = (explode(".", $name));
    $type = array_pop($names);
		return $type;
  }
}
?>