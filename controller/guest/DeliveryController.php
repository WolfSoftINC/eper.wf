<?php
class DeliveryController {
  
  // index action
  function IndexAction() {
    if (isset($_POST['da'])) {

      // connect models
      Connect::model('delivery');
      Connect::model('handler');

      // keys
      $data = array(
        0 => array(
          'key' => 'delivery_id',
          'value' => NULL,
          'type' => 'int',
          'check' => false,
        ),
        1 => array(
          'key' => 'basket_id',
          'value' => 1,
          'type' => 'int',
        ),
        2 => array(
          'key' => 'user_id',
          'value' => $_COOKIE['user_id'],
          'type' => 'str',
        ),
        3 => array(
          'key' => 'country',
          'value' => DeliveryModel::country($_POST['country']),
          'type' => 'str',
        ),
        4 => array(
          'key' => 'city',
          'value' => DeliveryModel::city($_POST['city']),
          'type' => 'str',
        ),
        5 => array(
          'key' => 'address',
          'value' => DeliveryModel::address($_POST['address']),
          'type' => 'int',
        ),
        6 => array(
          'key' => 'dr',
          'value' => time(),
          'type' => 'int',
        ),
      );

      // check data
      HandlerModel::cData($data);

      // delivery registry
      $iDelivery = DeliveryModel::registry($data);
      if (!$iDelivery) exit('error');
      exit('success');
    } 
  }
}
?>