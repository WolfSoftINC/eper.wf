<?php
class ProductController {

  // index action page
  function IndexAction() {
    Connect::head();

    Connect::view('d', 'sidebar');

    echo '<div id="page__layout">';

    Connect::view('d', 'header');


    if ($_GET['act'] == 'add') {
      Connect::view('', 'product/add');
    }
    
    echo '<div>';
  }

  function ListAction() {
    Connect::head();

    Connect::view('d', 'sidebar');

    echo '<div id="page__layout">';

    Connect::view('d', 'header');

    Connect::view('', 'products');
    
    echo '<div>';
  }

  // add handler
  function AddAction() {
    if (isset($_POST['pa'])) {
      Connect::handler('product');

      ProductHandler::add();
    }
  }

  // get list action
  function GlistAction() {
    if (isset($_POST['gl'])) {
      Connect::model('product');

      $data  = array(
        'shop_id' => $_SESSION['shop_id'],
      );

      $list = ProductModel::glist($data);
      echo json_encode($list);
    }
  }
}
?>