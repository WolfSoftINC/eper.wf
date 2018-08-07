<?php
class HandlerController {
  function LoginAction() {
    if (isset($_POST['lhans'])) {
      // connect models
      Connect::model('text');
      Connect::model('shop');

      // check login
      $login = TextModel::login($_POST['login']);
      if (!$login) {
        header('Location: '.$_SERVER['HTTP_REFERER']);
      }

      // check password
      $password = TextModel::password($_POST['password']);
      if (!$password) {
        header('Location: '.$_SERVER['HTTP_REFERER']);
      }

      $data = array(
        'login' => $login,
        'password' => $password,
      );

      $iShop = ShopModel::login($data);
      if ($iShop) {

        $_SESSION['shop_id'] = $iShop;
        $_SESSION['user'] = 'shop';

        // redirect
        header('Location: /');

      } else {
        header('Location: '.$_SERVER['HTTP_REFERER']);
      }

    }
  }
}
?>