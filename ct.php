<?php
/**
* Connect HTML Code
*/
class Connect {
	/**/
	public static function head(){

    /* get url */
    $url = trim($_SERVER['REQUEST_URI'],'/');

    /* Connect model */
    Connect::model('head');

    /* get page data */
    $dPage = HeadModel::get($url);

    /*  */
    
    if ($dPage == 'ePer') $title = $dPage;
    else $title = $dPage['title'].' | ePer';
    $descrip = $dPage['descrip'].'. ePer';
    $keywords = $dPage['keywords'].', ePer';
    $index = $dPage['index'];

    /**/
    echo('<!DocType html>');
    echo('<html lang="ru">');

    echo '<head>';

    echo('<meta http-equiv="X-UA-Compatible" content="IE=Edge" />');

    /*Иконка*/
    echo('<link rel="shortcut icon" href="/img/logo.png">');

    /* charset */
    echo('<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>');

    echo('<meta name="viewport" content="width=device-width, initial-scale=1">');

    /*robots*/
    echo("<meta name='robots' content='$index'/>");

    /*page title*/
    echo("<title>$title</title>");

    /*page descrip*/
    echo("<meta name='description' content='$descrip' />");
    
    /*page keywords*/
    echo("<meta name='keywords' content='$keywords'>");

    /*author*/
    echo('<meta name="author" content="ePer">');

    /* index */
    if ($index) {
      
      if (isset($dPage['ftitle'])) $ftitle = $dPage['ftitle'];
      else $ftitle = $dPage['title'];

      /**/
      if (isset($dPage['fdescrip'])) $fdescrip = $dPage['fdescrip'];
      else $fdescrip = $dPage['descrip'];

      /**/
      if (isset($dPage['poster'])) $poster = $dPage['poster'];
      else $poster = '/img/post/index.jpg';

      echo('<meta property="og:type" content="article">');

      echo('<meta property="og:title" content="'.$ftitle.'">');

      /**/
      echo('<meta property="og:description" content="'.$fdescrip.'">');

      /*poster*/
      echo('<meta property="og:image" content="http://insight.com.kg/'.$poster.'">');

      echo('<meta property="og:url" content="http://insight.com.kg/'.$url.'">');
    }

    ?>
    <link rel="stylesheet" type="text/css" href="/css/grid.css">
    <script src="/static/js/jquery.js"></script>
    <script src="/static/js/ajax.js"></script>

    <script src="/js/guest/box.js"></script>
    <script src="/js/ct.js"></script>
    <?php

    if (!isset($_SESSION['dev'])) {
      ?>
        <script>
          Connect.js('/guest/metrica');
        </script>
      <?php
    }

    $style = 'common.fonts.product.shop-profile';

    /* css style user */
    $AStyle = '';
    $GStyle = '.guest';
    $SStyle = '.shop';
    
    switch ($_SESSION['user']) {
      case 'admin':
        $style .= $AStyle;
        break;
      
      case 'guest':
        $style .= $GStyle;
        break;

      case 'shop': $style .= $SStyle; break;
    }

    /*Подключаем стили*/
    if ($style) {
      $style = explode('.',$style);
      echo '<script type="text/javascript">';
      foreach($style as $nameStyle){
        printf("Connect.css('%s');", $nameStyle);
      }
      echo '</script>';
    }
    /**/
    echo '</head><body>';
	}

  /* Connect js */
  public static function js($script) {
    printf('
      <script type="text/javascript">cjs("/js/guest/%s.js");</script>
    ',$script);
  }

	// connect html file
	public static function view($category, $view_name){

    $dir = '';

    // view name
    $view_name = $view_name.'.html';

    // directory
    switch ($category) {
      case 'd': $dir = $_SESSION['user'].'/default'; break;
      case 'lp': $dir = 'lp'; break;
      case 'all': $dir = 'all'; break;
      default: $dir = $_SESSION['user'];
    }

    // view url
    $view_url = ROOT.'/views/'.$dir.'/'.$view_name;
    
    // check exixts file
    if (file_exists($view_url))	require($view_url);
    else if (isset($_SESSION['dev'])) echo 'File Not fount';
	}

  /* Connect model */
  public static function model($model) {
    /* model name */
    $model_name = ucfirst($model);
    $model_name = $model_name.'Model';

    $model_url = ROOT.'/model/'.$model_name.'.php';

    if (file_exists($model_url)) require($model_url);
    else if (isset($_SESSIOn['dev'])) echo 'File not found';
  }

  // Connect handler
  public static function handler($handler) {

    /* handler name */
    $han_name = ucfirst($handler);
    $han_name = $han_name.'Handler';

    $han_url = ROOT.'/Handlers/'.$han_name.'.php';

    if (file_exists($han_url)) require($han_url);
    else if (isset($_SESSION['dev'])) echo 'File not found';
  }
}

?>