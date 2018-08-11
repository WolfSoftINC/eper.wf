<?php
switch ($_SESSION['user']) {
  case 'guest':
    return array(
      'profile' => 'user/profile',
      // handler
      'shop/lhan' => 'shopHan/login',

      // box
      'box/product' => 'box/product',
      'box/padd' => 'box/product',

      // box page
      'box/buy' => 'box/buy',
      'box' => 'box/page',

      // product
      'product/list' => 'product/glist',

      // delivery
      'delivery' => 'delivery/index',

      'do' => 'user/do',
      'user/add_box' => 'user/add_box',
      
      'kalem' => 'shop/profile/kalem',

      // user handler
      'user/auth' => 'user/auth',

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