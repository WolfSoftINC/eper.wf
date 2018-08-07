<?php
class ProductHandler {

  // product add handler
  public static function add() {
    Connect::model('product');

    // product name
    $name = ProductModel::name($_POST['name']);
    if (!$name) {
      $_SESSION['ap']['name'] = 'error';
      header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    // product price
    $price = ProductModel::price($_POST['price']);
    if (!$price) {
      $_SESSION['ap']['price'] = 'error';
      header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    // product descrip
    $descrip = ProductModel::descrip($_POST['descrip']);
    if (!$descrip) {
      $_SESSION['ap']['descrip'] = 'error';
      header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    // product img
    if (isset($_FILES['img'])) {
      
      Connect::model('image');
      $img = $_FILES['img'];
      
      // image type
      $tImage = ImageModel::gtype($img['name']);
    } else {

      $_SESSION['ap']['img'] = 'error';
      // redirect
      header("Location: ".$_SESSION['HTTP_REFERER']);
    }

    // data
    $data = array(
      'name' => $name,
      'price' => $price,
      'descrip' => $descrip,
      'img' => $tImage,
      'shop_id' => $_SESSION['shop_id'],
      'dr' => time(),
    );

    $iProduct = ProductModel::add($data);
    if ($iProduct) {

      // image upload
      $uImage = ROOT.'/img/product/'.$iProduct.'.'.$tImage;
      ImageModel::upload('img', $uImage);

      // redirect
      header("Location: /products");
    } else {
      
      // redirect
      header("Location: ".$_SERVER['HTTP_REFERER']);
    }
  }
}
?>