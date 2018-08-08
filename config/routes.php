<?php
switch ($_SESSION['user']) {
  case 'guest':
    return array(

      // handler
      'shop/lhan' => 'shopHan/login',

      // box page
      'box' => 'box/page',

      // box
      'box/padd' => 'box/product/add',

      // product
      'product/list' => 'product/glist',

      'do' => 'user/do',
      'user/add_box' => 'user/add_box',
      
      'kalem' => 'shop/profile/kalem',

      // user handler
      'user/sreg' => 'user/sreg',
      'user/product' => 'user/product',
      'user/logout' => 'user/logout',   
      'user/slogin' => 'user/slogin',
      
      'contact' => 'contact/page',
      'shop/reg' => 'shop/reg',
      'shop/sreg' => 'shop/sreg',
      'shop/registry' => 'shop/registry',
      'shop/login' => 'shop/login',
      
      // user pages
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