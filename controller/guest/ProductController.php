<?php
class ProductController {
  // get list action
  function GlistAction() {
  if (isset($_POST['gl'])) {
    Connect::model('product');

    // shop id
    if (isset($_POST['shop_id'])) $shop_id = $_POST['shop_id'];
    else $shop_id = $_SESSION['shop_id'];

    $data  = array(
      'shop_id' => $shop_id,
    );

    $list = ProductModel::glist($data);
    echo json_encode($list);
  }
}
}
?>