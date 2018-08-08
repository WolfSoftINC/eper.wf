<?php
class UserController {

  // registry page
  function RegistryAction() {
    Connect::head();

    Connect::view('d', 'header');
    Connect::view('', 'user/registry');
    Connect::view('d', 'footer');
  }

  // user login
  function LoginAction() {
    Connect::head();
    
    Connect::view('d', 'header');
    if (isset($_COOKIE['user_is']) && $_COOKIE['user_is']) {
      Connect::view('', 'user/log_out');
    }
    else {
      Connect::view('', 'user/login');
      Connect::view('', 'user/registry');
    }
    Connect::view('d', 'footer');
  }


  // logout
  function LogoutAction() {
    if (isset($_POST['logout']))
    {
      setcookie("user_is", 0, time() + (86400 * 99), "/");
      setcookie("user_id", "", time() + (86400 * 99), "/");
      setcookie("user_name", "", time() + (86400 * 99), "/");
      setcookie("user_phone", "", time() + (86400 * 99), "/");
      setcookie("user_mail", "", time() + (86400 * 99), "/");
      
      header("Location: http://eper.wf");
    }
  }

  //product delete, cancel, and buy action
  function DoAction() {
    $db = db::connect();

    $id = $_GET['id'];

    if (isset($_POST['is_del']))
    {
      if (isset($_COOKIE['user_is']) && $_COOKIE['user_is'])
      {
        $uid = $_COOKIE['user_id'];
        $sql = "DELETE FROM want_buy WHERE `product_id` = $id AND `user_id` = $uid;";
        $result = $db->prepare($sql);
        $result -> execute();
      }
      else
      {
        for($i = 0; $i < sizeof($_SESSION['box_product']); $i++)
        {
          if ($_SESSION['box_product'][$i] == $id)
          {
            $_SESSION['box_was_deleted'][$i] = 1;
          }
        }
      }
    }
    if (isset($_POST['is_buy']))
    {
      $s = $_POST['number'];
      $num = 0;
      
      for ($i = 0; $i < strlen($s) - 6; $i++)
      {
        $num *= 10;
        $num += ($s[$i]);
      }

      $t = time();
      
      if (isset($_COOKIE['user_is']) && $_COOKIE['user_is'])
      {
        $uid = $_COOKIE['user_id'];
        $sql = "DELETE FROM want_buy WHERE `product_id` = $id AND `user_id` = $uid;";
        $result = $db->prepare($sql);
        $result -> execute();
        
        $uid = $_COOKIE['user_id'];
        $time = time();
        $sql = "INSERT INTO `eper`.`buy` (`id`, `product_id`, `number`, `user_id`, `time`, `shop_id`, `dr`) VALUES (NULL, $id, $num, $uid, $t, 1, $time);";

        $result = $db -> prepare($sql);
        $result -> execute();
      }
      else
      {
        
        $_SESSION['is_buy'] = $id;
        header("Location: /login");
        exit();
      }
    }

    if (isset($_POST['is_cancel']))
    {
      $db = db::connect();
      $sql = "DELETE FROM `buy` WHERE `id` = $id";
      $result = $db -> prepare($sql);
      $result -> execute();
      header("Location: /box");
    }

    header("Location: ".$_SERVER['HTTP_REFERER']);
  }

  // shop profile
  function ShopAction() {
    Connect::head();
    Connect::view('d', 'header');
    Connect::view('', 'user/product');
    Connect::view('d', 'footer');

  }

  // user check login
  function SloginAction() {
    if (isset($_POST['login']))
    {
        Connect::model('shop');

        $data = array();

        $data['phone'] = ShopModel::phone($_POST['phone']);
        $data['password'] = ShopModel::password($_POST['password']);

        $user = ShopModel::user_login($data);

        if (!$user)
          header('Location:'.$_SERVER['HTTP_REFERER']);
        else
        {
          setcookie("user_is", 1, time() + (86400 * 99), "/");
          setcookie("user_id", $user['id'], time() + (86400 * 99), "/");
          setcookie("user_name", $user['name'], time() + (86400 * 99), "/");
          setcookie("user_phone", $user['phone'], time() + (86400 * 99), "/");
          setcookie("user_mail", $user['mail'], time() + (86400 * 99), "/");

          if (isset($_SESSION['is_buy']) && $_SESSION['is_buy'])
          {
            $db = Db::connect();

            for ($i = 0; $i < sizeof($_SESSION['box_product']); $i++)
            {
              if ($_SESSION['box_was_deleted'][$i])
                continue;
              
              $pid = $_SESSION['box_product'][$i];
              $uid = $user['id'];
              $t = $_SESSION['box_time'][$i];
              $number = $_SESSION['box_number'][$i];

              if ($_SESSION['is_buy'] == $pid)
              {
                $sql = "SELECT * FROM `want_buy` WHERE `product_id` = $pid AND `user_id` = $uid;";

                $result = $db -> prepare($sql);
                $result -> execute();
                
                if ($row = $result -> fetch())
                {
                  $result -> fetch();
                  $num = $number + $row['number']; 
                  $sql = "UPDATE `want_buy` SET `number` = $num WHERE `product_id` = $pid AND `user_id` = $uid;";

                  $result = $db -> prepare($sql);
                  $result -> execute();
                }
                else
                {
                $time = time();
                $sql = "INSERT INTO `eper`.`buy` (`id`, `product_id`, `number`, `user_id`, `time`, `shop_id`, `dr`) VALUES (NULL, $pid, $number, $uid, $t, 1, $time);"; 
                $result = $db->prepare($sql);
                $result -> execute();
                }
              }
              else
              {
                $sql = "INSERT INTO `eper`.`want_buy` (`id`, `product_id`, `user_id`, `number`, `dr`) VALUES (NULL, $pid, $uid, $number, $t);";
                $result = $db->prepare($sql);
                $result -> execute();
              }
            }

            header("Location: http://eper.wf/box"); 
            exit();
          }
        }

      header("Location: http://eper.wf");
    }
  }

  // box

  // Product Profile

  function ProductAction(){
    Connect::head();
     Connect::view('d', 'header');
    
    if (!isset($_SESSION['box_product']))
    {
      $_SESSION['box_product'] = $_SESSION['box_time'] = $_SESSION['box_number'] = array();
    }

    if (isset($_GET['id']))
    {
      $_SESSION['product_id'] = $_GET['id'];
       Connect::view('', 'user/product_profile');
    }
    Connect::view('d', 'footer');
  }

  // user registry
  function SregAction() {
    if (isset($_POST['reg'])) {
      Connect::model('shop');
      Connect::model('user');
        
      $data = array();
      $keys = array("name", "phone", "mail", "password");

      foreach ($keys as $key)
      {
        switch ($key)
        {
          case 'name': $data[$key] = ShopModel::name($_POST[$key]); break;
          case 'phone': $data[$key] = ShopModel::phone($_POST[$key]); break;
          case 'mail': $data[$key] = ShopModel::mail($_POST[$key]); break;
          case 'password': $data[$key] = ShopModel::password($_POST[$key]); break;
        }
          
        if (!$data[$key]) 
        {
            $_SESSION['sreg'][$key] = 'error';
            header("Location: ".$_SERVER['HTTP_REFERER']);
        }
      }

      $data['dr'] = time();

      $user_id = ShopModel::user_registry($data);

      if (!$user_id)
        header("Location: ".$_SERVER['HTTP_REFERER']);
      else 
      {
        setcookie("user_is", 1, time() + (86400 * 99), "/");
        setcookie("user_id", $user_id, time() + (86400 * 99), "/");
        setcookie("user_name", $data['name'], time() + (86400 * 99), "/");
        setcookie("user_phone", $data['phone'], time() + (86400 * 99), "/");
        setcookie("user_mail", $data['mail'], time() + (86400 * 99), "/");

        if (isset($_SESSION['is_buy']) && $_SESSION['is_buy'])
        {
          $db = Db::connect();

          for ($i = 0; $i < sizeof($_SESSION['box_product']); $i++)
          {
            if ($_SESSION['box_was_deleted'][$i])
                  continue;

              $pid = $_SESSION['box_product'][$i];
            $uid = $user_id;
            $t = $_SESSION['box_time'][$i];
            $number = $_SESSION['box_number'][$i];

            if ($_SESSION['is_buy'] == $pid)
            {
              $time = time();
              $sql = "INSERT INTO `eper`.`buy` (`id`, `product_id`, `number`, `user_id`, `time`, `shop_id`, `dr`) VALUES (NULL, $pid, $number, $uid, $t, 1, $time);";
              $result = $db->prepare($sql);
              $result -> execute();
            }
            else
            {
              $sql = "INSERT INTO `eper`.`want_buy` (`id`, `product_id`, `user_id`, `number`, `dr`) VALUES (NULL, $pid, $uid, $number, $t);";
              $result = $db->prepare($sql);
              $result -> execute();
            }
          }

          header("Location: http://eper.wf/box"); 
          exit();
        }
      }

      header("Location: http://eper.wf");
    }
  }
}
?>