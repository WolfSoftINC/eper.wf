<?php
class ShopController {

  // profile action
  function ProfileAction() {
    Connect::head();

    Connect::view('d', 'header');
    Connect::view('', 'shop/profile');
    Connect::view('d', 'footer');
  }

  // login page
  function LoginAction() {
    Connect::head();

    Connect::view('d', 'header');
    Connect::view('', 'shop/login');
    Connect::view('d', 'footer');
  }

  function RegistryAction() {
    Connect::head();

    Connect::view('d', 'header');
    Connect::view('', 'shop/registry');
    Connect::view('d', 'footer');
  }

  // registry houlder
  function RegAction() {
    if (isset($_POST['reg'])) {
      Connect::model('shop');

      $data = array();
      $keys = array("name", "login", "phone", "mail", "password");

      // check
      foreach ($keys as $key) {

        switch ($key) {
          case 'name': $data[$key] = ShopModel::name($_POST[$key]); break;
          case 'login': $data[$key] = ShopModel::clogin($_POST[$key]); break;
          case 'phone': $data[$key] = ShopModel::phone($_POST[$key]); break;
          case 'mail': $data[$key] = ShopModel::mail($_POST[$key]); break;
          case 'password': $data[$key] = ShopModel::password($_POST[$key]); break;
        }

        if (!$data[$key]) {
          $_SESSION['sreg'][$key] = 'error';
          header("Location: ".$_SERVER['HTTP_REFERER']);
        }
      }

      $data['dr'] = time();

      $shop_id = ShopModel::registry($data);
      if (!$shop_id) {
        header("Location: ".$_SERVER['HTTP_REFERER']);
      } else {
        header("Location: http://eper.com/shop/sreg");
      }
    }
  }

  // result
 function SregAction() {
    Connect::head();

    Connect::view('d', 'header');
    Connect::view('', 'shop/sreg');
    Connect::view('d', 'footer');
  }
}
?>