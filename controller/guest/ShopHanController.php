<?php
class ShopHanController {
  function LoginAction() {
    if (isset($_POST['sl'])) {
      // connect models
      Connect::model('text');
      Connect::model('shop');

      // check login
      $login = TextModel::login($_POST['login']);
      if (!$login) {
        $_SESSION['sl']['login'] = 'Не верный логин';
        header('Location: '.$_SERVER['HTTP_REFERER']);
      }

      // check password
      $password = TextModel::password($_POST['password']);
      if (!$password) {
        $_SESSION['sl']['password'] = 'Не верный пароль';
        header('Location: '.$_SERVER['HTTP_REFERER']);
      }

      // data
      $data = array(
        'login' => $login,
        'password' => $password,
      );

      // check login
      $iShop = ShopModel::login($data);
      if ($iShop) {

        // session
        $_SESSION['shop_id'] = $iShop;
        $_SESSION['user'] = 'shop';

        // redirect
        header('Location: /');

      } else {

        $_SESSION['sl']['password'] = 'Не верный логин или пароль';
        
        // redirect
        header('Location: '.$_SERVER['HTTP_REFERER']);
      }
    }
  }
}
?>