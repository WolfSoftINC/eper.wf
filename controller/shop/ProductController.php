<?php
class ProductController {

  // index action
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
}
?>