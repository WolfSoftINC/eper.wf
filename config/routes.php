<?php
switch ($_SESSION['user']) {
  case 'guest':
    return array(

      // handler
      'shop/lhan' => 'shopHan/login',

      // box
      '/box/padd' => 'box/product/add',

      // product
      'product/list' => 'product/glist',

      'do' => 'user/do',
      'user/add_box' => 'user/add_box',
      'box' => 'user/box',
      
      'kalem' => 'shop/profile/kalem',
      'user/product' => 'user/product',
      'user/logout' => 'user/logout',   
      'user/sreg' => 'user/sreg',
      'user/slogin' => 'user/slogin',
      'contact' => 'contact/page',

      'shop/reg' => 'shop/reg',
      'shop/sreg' => 'shop/sreg',
      'shop/registry' => 'shop/registry',
      'shop/login' => 'shop/login',
      
      'login' => 'user/login',
      'registry' => 'user/registry',
      
      '' => 'index/index',
    );
    break;
  
  case 'shop':  
    return array(
      'product/list' => 'product/glist',
      'product/addhan' => 'product/add',
      'products' => 'product/list',
      'product' => 'product/index',

      'logout' => 'shop/logout',

      '' => 'index/index',
    );
}
?>