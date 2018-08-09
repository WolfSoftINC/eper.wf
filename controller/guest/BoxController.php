<?php
class BoxController {

  // box page
  function PageAction(){
    Connect::head();

    Connect::view('d', 'header');
    Connect::view('', 'box/page');
    Connect::view('d', 'footer'); 
  }

  // Product action
  function ProductAction() {

    // product add
    if (isset($_POST['pa'])) {

      // connect model
      Connect::model('box');

      // product id
      $iProduct = $_POST['product_id'];

      // filter
      $filter = array(
        0 => array(
          'key' => 'product_id',
          'value' => $iProduct,
          'type' => 'int',
        ),

        1 => array(
          'key' => 'ip',
          'value' => $_SERVER['REMOTE_ADDR'],
          'type' => 'str',
        ),
      );

      // check product
      if (!BoxModel::cProduct($filter)) {

        // data
        $data = array(
          'product_id' => $iProduct,
          'ip' => $_SERVER['REMOTE_ADDR'],
          'number' => 1,
          'dr' => time(),
        );

        // add
        $iBuy = BoxModel::aProduct($data);
        if ($iBuy) {
          exit('success');
        } else exit('error');
      } else exit('error');
    }

    // get list
    if (isset($_POST['gl'])) {
      Connect::model('box');
      Connect::model('product');

      // data
      $data = array(
        'ip' => $_SERVER['REMOTE_ADDR'],
      );

      // product list
      $lProduct = BoxModel::lProduct($data);

      // product count
      $cProduct = count($lProduct);

      for ($i = 0; $i < $cProduct; $i++) {

        // keys
        $keys = array(
          'name' => 'name',
          'price' => 'price',
          'img' => 'img',
          'shop_id' => 'shop_id',
        );

        // filter
        $filter = array(
          0 => array(
            'key' => 'product_id',
            'value' => $lProduct[$i]['id'],
            'type' => 'int',
          ),
        );

        $dProduct = ProductModel::gd($filter, $keys);

        foreach($keys as $key) {
          $lProduct[$i][$key] = $dProduct[0][$key];
        }

      }

      echo json_encode($lProduct);
    }
  }

  // // change action
  // function ChangeAction() {
  //   $id = $_GET['id'];
  //   $s = $_POST['number'];
  //   $num = 0;

  //   for ($i = 0; $i < strlen($s) - 6; $i++)
  //   {
  //       $num *= 10;
  //       $num += ($s[$i]);
  //   }

  //   $_POST['number'] = $num;

  //   if (isset($_COOKIE['user_is']) && $_COOKIE['user_is'])
  //   {
  //     $db = Db::connect();
  //     $number = $_POST['number'];

  //     $uid = $_COOKIE['user_id'];
      
  //     $sql = "SELECT * FROM `want_buy` WHERE `product_id` = $id AND `user_id` = $uid;";

  //     $result = $db -> prepare($sql);
  //     $result -> execute();

  //     if ($row = $result -> fetch())
  //     {
  //       $result -> fetch();
  //       $num = $number + $row['number']; 
  //       $sql = "UPDATE `want_buy` SET `number` = $num WHERE `product_id` = $id AND `user_id` = $uid;";

  //       $result = $db -> prepare($sql);
  //       $result -> execute();
  //     }
  //     else
  //     {
  //       $t = time();
  //       $sql = "INSERT INTO `want_buy` (`id`, `product_id`, `user_id`, `dr`, `number`) VALUES (NULL, $id, $uid, $t, $number);";
  //       $result = $db->prepare($sql);
  //       $result->execute();
  //     }
  //   }
  //   else
  //   {
  //     if (!isset($_SESSION['box_product']) || !isset($_SESSION['box_time']) || !isset($_SESSION['box_number']) || !isset($_SESSION['box_was_deleted']))
  //     {
  //       $_SESSION['box_product'] = $_SESSION['box_time'] = $_SESSION['box_number'] = $_SESSION['box_was_deleted'] = array();
  //     }

  //     $bad = 0;

  //     for ($i = 0; $i < sizeof($_SESSION['box_product']); $i++)
  //     {
  //       if ($_SESSION['box_product'][$i] == $id && !$_SESSION['box_was_deleted'][$i])
  //       {
  //         $bad = 1;
  //         $_SESSION['box_number'][$i] += $_POST['number'];
          
  //         if ($_SESSION['box_number'][$i] > 100)
  //           $_SESSION['box_number'][$i] = 100;
  //       }
  //     }

  //     if (!$bad)
  //     {
  //       array_push($_SESSION['box_product'], $id);
  //       array_push($_SESSION['box_time'], time()); 
  //       array_push($_SESSION['box_number'], $_POST['number']);
  //       array_push($_SESSION['box_was_deleted'], 0);
  //     }
  //   }
    
  //   // redirect
  //   header("Location: ".$_SERVER['HTTP_REFERER']);
  // }
}
?>