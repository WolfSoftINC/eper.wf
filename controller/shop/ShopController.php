<?php
class ShopController {
  function LogoutAction() {

    // session
    $_SESSION['user'] = 'guest';
    $_SESSION['shop_id'] = null;

    // redirect
    header("Location: /");
  }
}
?>