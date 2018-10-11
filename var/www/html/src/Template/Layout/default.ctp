<?php
use Cake\Routing\Router;
/**
* CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
* @link          http://cakephp.org CakePHP(tm) Project
* @since         0.10.0
* @license       http://www.opensource.org/licenses/mit-license.php MIT License
*/

$cakeDescription = $setngs['site_title'];
?>
<!DOCTYPE html>
<html>
<head>
  <?= $this->Html->charset() ?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- title>
      <?//= $cakeDescription ?>:
      <?php
      //  echo " - ".$title_for_layout;
      ?>
      <?//= $this->fetch('title') ?>
    </title -->

    <title>
      <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?php
  //print_r($_SESSION);
    ?>

    <?= $this->Html->css('frontcss/bootstrap.min.css') ?>
    <?php
    if(isset($_SESSION['languagecode']) && $_SESSION['languagecode'] == "ar")
    {
      ?>
      <?= $this->Html->css('bootstrap-rtl.css') ?>
      <?php } ?>
      <?= $this->Html->css('jquery-ui.css') ?>
      <?= $this->Html->css('frontcss/common.css') ?>
      <?= $this->Html->css('frontcss/core.css') ?>
      <?php
      if(isset($_SESSION['languagecode']) && $_SESSION['languagecode'] == "ar")
      {
        ?>
        <?= $this->Html->css('rtl.css') ?>
        <?php } ?>
        <?= $this->Html->css('frontcss/slider.css') ?>
        <?= $this->Html->css('frontcss/font-awesome.css') ?>

        <?= $this->Html->css('assets/plugins/toast-master/css/jquery.toast.css') ?>
        <?= $this->Html->css('assets/plugins/datatables/media/css/jquery.dataTables.min.css') ?>
        <!--?= $this->Html->css('assets/plugins/datatables/media/css/buttons.dataTables.min.css') ?-->
        <?= $this->Html->css('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') ?>

        <?= $this->Html->script('jquery.min.js') ?>
        <?= $this->Html->script('bootstrap.min.js') ?>
        <?= $this->Html->script('front.js') ?>
        <?= $this->Html->script('jquery.waypoints.min.js') ?>
        <?= $this->Html->script('jquery.magnific-popup.min.js') ?>
        <?= $this->Html->script('main.js') ?>
        <?= $this->Html->script('easyResponsiveTabs.js') ?>
        <?= $this->Html->script('assets/plugins/datatables/jquery.dataTables.min.js') ?>
        <?= $this->Html->script('jquery-ui.1.12.js') ?>
        <?= $this->Html->script('sticky-sidebar.js') ?>
        <?= $this->Html->script('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
        <style type="text/css">
          .test
          {

            padding: 1px;
          }
          .errcls{
            display: none;
          }
          .a{
            cursor:pointer;
          }
        </style>
      </head>
      <body>
        <?php
        $baseurl = Router::url('/');
        ?>
        <header>
          <nav class="navbar navbar-inverse navbar-fixed-top top-header secondary-color-bg">
            <div class="container">
              <ul class="nav navbar-nav website-header-left-link navbar-left">
                <?php
                echo '<li><a href="'.SITE_URL.'merchant">'.__d('user','Sell On').' '.$setngs['site_name'].'</a></li>';
                if(count($loguser)==0)
                {
                  echo '<li><a href="'.SITE_URL.'login">'.__d('user','Gift Card').'</a></li>';
                }
                else
                {
                  echo '<li><a href="'.SITE_URL.'creategiftcard">'.__d('user','Gift Card').'</a></li>';
                }
                ?>
                <li><a href="" data-toggle="modal" data-dismiss="modal" data-target="#app-modal"><?php echo __d('user','Download App');?></a></li>
                <li><a href="<?php echo SITE_URL.'allstores';?>"><?php echo __d('user','All Stores');?></a></li>
              </ul>
              <ul class="nav navbar-nav website-header-right-link navbar-right">
                <a class="sm-logo navbar-brand website-logo img-responsive" href="javascript:void(0)" style="display:none;"></a>
                <li class="dropdown txt-uppercase">
                  <a class="dropdown-toggle bold-font" data-toggle="dropdown" href="javascript:void(0)">
                    <?php if($_SESSION['languagecode']=='') { echo substr('ENGLISH',0,3); } else { echo substr($_SESSION['languagename'],0,3); } ?>
                    <i class="fa fa-angle-down"></i></a>
                    <ul class="dropdown-menu lang-dd">
                      <?php
                      foreach ($languages as $lang) {
                        echo'<li><a>'.substr($lang['languagename'],0,3).'</a></li>';
                        ?>
                        <input type="hidden" class="selectlang<?php echo substr($lang['languagename'],0,3); ?>" value="<?php echo $lang['languagename'];?>"/>
                        <?php
                      }
                      ?>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a class="dropdown-toggle bold-font" data-toggle="dropdown" href="javascript:void(0)">
                      <?php
                      if(isset($_SESSION['currency_code']))
                        echo $_SESSION['currency_code'];
                      else
                      {
                       //echo '<pre>';print_r($languages[0]);die;
                        echo $languages[0]['countrycode'];
                      }
                      ?>
                      <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu curr-dd">
                      <?php
                      foreach ($languages as $lang) {
                        echo'<li><a href="'.SITE_URL.'changecurrency/'.$lang['countrycode'].'">'.$lang['countrycode'].'</a></li>';
                      }
                      ?>
                    </ul>
                  </li>
                  <?php
                  if(count($loguser)>0)
                  {
                    $username=strlen($loguser['first_name']) > 10 ? substr($loguser['first_name'],0,10)."..." : $loguser['first_name'];

                    echo '<li class="dropdown header-profile"><a class="dropdown-toggle nav-menu-profile-padding" data-toggle="dropdown" href="javascript:void(0)"><div><div class="profile-circle"><span class="prof-pic" style="display:none;">M</span></div><div class="welcome-text"><div class="name bold-font">'.$username.'</div></div></div></a>
                    <ul class="dropdown-menu">
                      <li><a href="'.SITE_URL.'people/'.$loguser['username_url'].'">'.__d('user','My Profile').'</a></li>
                      <li><a href="'.SITE_URL.'search/people">'.__d('user','Find Friends').'</a></li>
                      <li><a href="'.SITE_URL.'invite_friends">'.__d('user','Invite Friends').'</a></li>
                      <li><a href="'.SITE_URL.'group_gift_lists">'.__d('user','Group Gift List').'</a></li>
                      <li><a href="'.SITE_URL.'purchases">'.__d('user','Track Orders').'</a></li>
                      <li><a href="'.SITE_URL.'profile">'.__d('user','Settings').'</a></li>
                      <li class="margin-top10"><a class="centered-text top-border" href="'.SITE_URL.'logout">'.__d('user','Sign Out').'</a></li>
                    </ul>
                  </li>
                  <li class="dropdown notif"><a class="nav-menu-padding" data-toggle="dropdown" href="javascript:void(0)" onclick="shownoti();"><span class="notification"></span>';
        //echo $loguser['unread_notify_cnt'];
                    if($userDetailss['unread_notify_cnt']>0)
                      echo '<span id="noticnt" class="counter-label">'.$userDetailss['unread_notify_cnt'].'</span>';
                    echo '<span class="mobile-menu-txt">';echo __d('user','Notifications'); echo'</span></a>
                    <ul class="notification-dd dropdown-menu" id="pushappend">
                      <li class="notification-text"></li>
                    </ul>
                  </li>
                  <li class="dropdown feeds"><a class="dropdown-toggle nav-menu-padding" href="'.SITE_URL.'livefeeds"><span class="live-feeds"></span>';
                    if($userDetailss['unread_livefeed_cnt']>0)
                      echo '<span id="feedcnt" class="counter-label">'.$userDetailss['unread_livefeed_cnt'].'</span>';
                    echo '<span class="mobile-menu-txt" style="display:none;">Live Feeds</span></a>
                  </li>
                  <li class="dropdown cart"><a class="dropdown-toggle nav-menu-padding" data-toggle="dropdown" href="javascript:void(0)" onclick="showcarthov();"><span class="website-shopping-cart img-responsive"></span>';
                    if(isset($defaultcart_total_itms) && !empty($defaultcart_total_itms) && $defaultcart_total_itms>0)
                      echo '<span id="cartnoti" class="counter-label">'.$defaultcart_total_itms.'</span>';
                    echo '</a>
                    <ul class="notification-dd dropdown-menu">
                      <li class="dd-heading bold-font">'.__d('user','My cart').':</li>
                      <div class="notification-list-cnt" id="cartmousehoverval">';
            // CART SECTION
                        $imageurl=$baseurl.'listing/'.base64_encode($setcart['itemid']."_".rand(1,9999));
                        foreach($defaultcart as $setcart){
                          if ($setcart['image']!="")
                            { $itemimageurl=SITE_URL.'media/items/thumb70/'.$setcart['image'];
                        }else{
                          $itemimageurl=$baseurl.'media/items/original/usrimg.jpg';
                        }
                        echo '<li class="notification-list">
                        <a class="square-profile" href="'.$imageurl.'">
                          <div class="profile-square" style="background:url('.$itemimageurl.')" ></div></a>
                          <div class="notification-detail">
                            <a href="'.SITE_URL.'cart">
                              <span class="product-name-text extra_text_tablecell test">'.$setcart['name'].'</span>
                              <span class="product-qty">'.__d('user','Qty').' :'.$setcart['qty'].'</span>
                              <span class="product-price-text">'.__d('user','Price').' :'.$setcart['price'].'</span>
                            </a>
                          </div>
                        </li>';

                      }
                      echo'</div>
                      <li class="dd-footer top-border">
                        <div class="all-notification-text"><a class="centered-text" href="'.SITE_URL.'cart">'.__d('user','Checkout').'</a></div>
                      </li>
                    </ul>
                  </li>';
                  echo '<input type="hidden" id="logguserid" value="'.$loguser['id'].'">';
                }
                else
                {
                  echo '<li class="dropdown header-profile"><a class="dropdown-toggle nav-menu-profile-padding" href="'.SITE_URL.'login"><div><div class="welcome-text"><div class="name bold-font">'.__d('user','Login').'</div></div></div></a>

                </li>
                <li class="dropdown header-profile"><a class="dropdown-toggle nav-menu-profile-padding" href="'.SITE_URL.'signup"><div><div class="welcome-text"><div class="name bold-font">'.__d('user','Signup').'</div></div></div></a>

                </li>';
                echo '<input type="hidden" id="logguserid" value="0">';
              }
              ?>
            </ul>
          </div>
        </nav>
        <nav class="navbar navbar-inverse mobile-top-menu">
          <div class="container-fluid no-hor-padding">
            <div class="navbar-header-rtl-disp navbar-header primary-color-bg">
              <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="side-slide-btn navbar-toggle pull-left">
                <img src="<?php echo $baseurl;?>images/icons/nav.png" width="24px" height="24px">
              </button>
              <div class="fantacy-logo">
                <a href="<?php echo SITE_URL;?>" class="navbar-brand website-logo img-responsive" > 
                  <img src="<?php echo $baseurl;?>images/logo/<?php echo $setngs->site_logo; ?>" alt="homepage" />
                </a>
              </div>
              <?php
              if(count($loguser)>0)
              {
                echo '<button type="button" class="cart-btn-cnt navbar-toggle pull-right" data-toggle="collapse" data-target="#mobile-cart" onclick="showcarthov();">
                <span class="website-shopping-cart img-responsive"></span>';
                if(isset($defaultcart_total_itms) && !empty($defaultcart_total_itms) && $defaultcart_total_itms>0)
                  echo '<span id="cartnoti" class="counter-label">'.$defaultcart_total_itms.'</span>';
                echo '</button>
                <button type="button" class="notif-btn-cnt navbar-toggle pull-right" data-toggle="collapse" data-target="#notificationid" onclick="shownotiresp();">
                  <span class="website-notif img-responsive"></span>';
                  if($userDetailss['unread_notify_cnt']>0)
                    echo '<span id="noticnts" class="counter-label">'.$userDetailss['unread_notify_cnt'].'</span>';
                  echo '</button>';
                }
                ?>
              </div>
              <div class="mobile-search primary-color-bg">
                <span class="search" href="javascript:void(0)">
                  <span class="second_header_search">
                    <input id="search-queryresp" name="q" class="text" autocomplete="off" onkeyup="indexSearchresp(event);" maxlength="180" type="text" placeholder="<?php echo __d('user','Search for products, brand and more...');?>">
                  </span>
                  <a class="search-icon-link nodisply" href="javascript:void(0);" onclick="indcallresp(event);">
                    <?php echo __d('user','Search');?></a>
                    <div class="feed-search nodisply">
                      <div class="loading"><i></i></div>
                      <ul class="thing">
                      </ul>
            <!--<ul id="usesrchresp" style="left:-16%;top:61%;" class="dropdown-menu minwidth_72 margin_left20per padding-bottom0 padding-top0">
          </ul>-->
          <ul id="usesrchresp" tabindex="0" class="ui-menu ui-widget ui-widget-content ui-autocomplete ui-front" style="display: none; top: 93px; left: 305px; width: 821px;">
          </ul>
          <!--input type="button" value="<?php echo __('Search');?>" class="searchbttn" onclick="indcall(event);"-->
          <!--<a href="#" class="more">See full search results</a>-->
        </div>
      </span>
    </div>
    <div class="navbar-inverse side-collapse in" id="side-navigation">
      <?php
      if(count($loguser)>0)
      {
        $username=strlen($userDetailss['first_name']) > 10 ? substr($userDetailss['first_name'],0,10)."..." : $userDetailss['first_name'];
        echo '<div class="collapse navbar-collapse">
        <ul class="nav navbar-nav primary-color-bg">
          <li class="header-profile"><a class="nav-menu-profile-padding primary-color-bg" data-toggle="dropdown" href="javascript:void(0)"><div class="blocked-display"><div class="profile-circle"><span class="prof-pic">';
            $profile_image = $userDetailss['profile_image'];
            if($profile_image == "")
              $profile_image = "usrimg.jpg";
            echo '<img src="'.SITE_URL.'media/avatars/thumb70/'.$profile_image.'" style="width:40px;height:40px;">';
            echo '</span></div><div class="welcome-text"><div class="welcome">'.__d('user','Welcome').'</div><div class="name">'.$username.'</div></div></div></a><div class="mobile-signout"><a class="primary-color-bg" href="'.SITE_URL.'logout"><img src="'.SITE_URL.'images/icons/logout.png" width="24px"></a></div>
          </li>

          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">';
            if($_SESSION['languagecode']=='') { echo 'ENGLISH'; } else{ echo $_SESSION['languagename']; }
            echo '<i class="fa fa-angle-down pull-right"></i></a>
            <ul class="dropdown-menu langdd">';
              foreach ($languages as $lang) {
                echo'<li><a>'.$lang['languagename'].'</a></li>'; 
              }
              echo '</ul>
            </li>
            <li class="dropdown"><a class="dropdown-toggle mobile-menu-bottom-border" data-toggle="dropdown" href="javascript:void(0)">';
              if(isset($_SESSION['currency_code']))
                echo $_SESSION['currency_code'];
              else
              {
              //echo '<pre>';print_r($languages[0]);die;
                echo $languages[0]['countrycode'];
              }
              echo '<i class="fa fa-angle-down pull-right"></i></a>
              <ul class="dropdown-menu">';
                foreach ($languages as $lang) {
                  echo'<li><a href="'.SITE_URL.'changecurrency/'.$lang['countrycode'].'">'.$lang['countrycode'].'</a></li>';
                }
                echo '</ul>
              </li>
              <li><a href="'.SITE_URL.'livefeeds">'.__d('user','Live Feeds').'</a></li>
              <li><a href="'.SITE_URL.'purchases">'.__d('user','My Orders').'</a></li>
              <li><a href="'.SITE_URL.'messages">'.__d('user','Message').'</a></li>
              <li><a href="'.SITE_URL.'viewmore/dailydeals">'.__d('user','Daily Deals').'</a></li>
              <li><a href="'.SITE_URL.'invite_friends">'.__d('user','Invite and Earn').'</a></li>
              <li><a class="mobile-menu-bottom-border" href="'.SITE_URL.'search/people">'.__d('user','Find Friends').'</a></li>
              <li><a href="'.SITE_URL.'groupgifts">'.__d('user','Group Gift').'</a></li>
              <li><a class="mobile-menu-bottom-border" href="'.SITE_URL.'merchant">'.__d('user','Sell on').' '.$setngs['site_name'].'</a></li>
              <li><a href="'.SITE_URL.'profile">'.__d('user','Settings').'</a></li>
              <li><a href="'.SITE_URL.'help/faq">'.__d('user','Help').'</a></li>

              <li><a href="" data-toggle="modal" data-dismiss="modal" data-target="#app-modal">'.__d('user','Download App').'</a></li>
            </ul>
          </div>';
        }
        else
        {
          echo '<div class="collapse navbar-collapse">
          <ul class="nav navbar-nav primary-color-bg">

            <li class="header-profile"><a class="nav-menu-profile-padding primary-color-bg" data-toggle="dropdown" href="javascript:void(0)"><div class="blocked-display"><div class="profile-circle"><span class="prof-pic">
              <img src="'.SITE_URL.'media/avatars/thumb70/usrimg.jpg" style="width:40px;height:40px;">
            </span></div><div class="welcome-text"><div class="welcome">'.__d('user','Welcome').'</div><div class="name">'.__d('user','Guest').'</div></div></div></a><div class="mobile-signout"></div>
          </li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">';
            if($_SESSION['languagecode']=='') { echo 'ENGLISH'; } else{ echo $_SESSION['languagename']; }
            echo '<i class="fa fa-angle-down pull-right"></i></a>
            <ul class="dropdown-menu langdd">';
              foreach ($languages as $lang) {
                echo'<li><a>'.$lang['languagename'].'</a></li>';
              }
              echo '</ul>
            </li>
            <li class="dropdown"><a class="dropdown-toggle mobile-menu-bottom-border" data-toggle="dropdown" href="javascript:void(0)">';
              if(isset($_SESSION['currency_code']))
                echo $_SESSION['currency_code'];
              else
              {
              //echo '<pre>';print_r($languages[0]);die;
                echo $languages[0]['countrycode'];
              }
              echo '<i class="fa fa-angle-down pull-right"></i></a>
              <ul class="dropdown-menu">';
                foreach ($languages as $lang) {
                  echo'<li><a href="'.SITE_URL.'changecurrency/'.$lang['countrycode'].'">'.$lang['countrycode'].'</a></li>';
                }
                echo '</ul>
              </li>

              <li><a href="'.SITE_URL.'login">'.__d('user','Login').'</a></li>
              <li><a href="'.SITE_URL.'signup">'.__d('user','Signup').'</a></li>
            </ul>
          </div>
          ';
        }
        ?>
      </div>
      <?php
      if(count($loguser)>0)
      {
        echo '<div class="collapse navbar-collapse" id="mobile-cart">
        <ul class="nav navbar-nav">
          <div class="notification-list-cnt" id="cartmousehovervals">';
            $imageurl=$baseurl.'listing/'.base64_encode($setcart['itemid']."_".rand(1,9999));
            foreach($defaultcart as $setcart){
              if ($setcart['image']!="")
                { $itemimageurl=SITE_URL.'media/items/thumb70/'.$setcart['image'];
            }else{
              $itemimageurl=SITE_URL.'media/items/original/usrimg.jpg';
            }
            echo '<li><a href="href="'.$imageurl.'""><span class="square-profile"><div class="profile-square" style="background:url('.$itemimageurl.')"></div></span>
            <span class="product-name-text">'.$setcart['name'].'</span>
            <span class="product-qty">'.__d('user','Qty').' : '.$setcart['qty'].'</span>
            <span class="product-price-text">'.__d('user','Price').' : '.$setcart['price'].'</span></a></li>';
          }
          echo '</div>

          <li class="dd-footer top-border">
            <div class="all-notification-text"><a class="centered-text" href="'.SITE_URL.'cart">'.__d('user','Checkout').'</a></div>
          </li>
        </ul>
      </div>
      <div class="collapse navbar-collapse" id="notificationid">
        <ul class="nav navbar-nav" id="pushappends">

        </ul>
      </div>';
    }
    ?>

  </div>
</nav>
<nav class="navbar navbar-inverse navbar-fixed-top website-header primary-color-bg">
  <div class="container">
    <div class="navbar-header col-sm-12 no-hor-padding">
      <button type="button" class="navbar-toggle resp_btn" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="fantacy-logo">
        <a href="<?php echo SITE_URL;?>" class="navbar-brand website-logo img-responsive"> 
          <!--<img src="<?php echo SITE_URL;?>images/logo/<?php  echo $setngs->site_logo; ?>" alt="homepage"/>-->
          <img src="<?php echo SITE_URL;?>images/logo/<?php  echo $setngs->site_logo; ?>" alt="homepage"/>
        </a>
      </div>
      <span href="javascript:void(0)" class="search"><span class="second_header_search">
        <input id="search-query" name="q" class="text" autocomplete="off" onkeyup="indexSearch(event);" maxlength="180" type="text" placeholder="<?php echo __d('user','Search for products, brand and more...');?>"></span>
        <a class="search-icon-link" href="javascript:void(0);" onclick="indcall(event);">
          <?php echo __d('user','Search');?></a>
        </span>
        <!--<form class="search">
          <div class="ui-widget second_header_search">
            <input class="tags" type="text" placeholder="Search for products, brand and more...">
          </div>
          <a class="search-icon-link" href="">Search</a>
        </form>-->
        <div class="feed-search nodisply">
          <div class="loading"><i></i></div>
          <ul class="thing">
          </ul>
          <ul id="usesrch" class="dropdown-menu minwidth_72 margin_left20per padding-bottom0 padding-top0">
          </ul>
          <!--input type="button" value="<?php echo __('Search');?>" class="searchbttn" onclick="indcall(event);"-->
          <!--<a href="#" class="more">See full search results</a>-->
        </div>
        <a class="mobile-cart" href="javascript:void(0)"><span class="website-shopping-cart-mobile img-responsive"></span><span id="bounce" class="counter-label-mobile">0</span></a>
      </div>
    </div>
  </nav>
  <div class="second_header container-fluid">
    <div class="container">
      <div class="pn-ProductNav_Wrapper" id="pn-ProductNav_Wrapper">
        <div class="gradient_left"></div>
        <div class="gradient_div"></div>
        <nav id="pnProductNav" class="pn-ProductNav">
          <div id="pnProductNavContents" class="pn-ProductNav_Contents">
            <ul id="hpane">
             <?php
             $catcount = count($prnt_cat_data)-1;
             foreach ($prnt_cat_data as $key => $cat) {
              echo '<li>
              <a href="'.SITE_URL.'shop/'.$cat['category_urlname'].'" class="pn-ProductNav_Link" aria-selected="true">'.$cat['category_name'].'</a>
            </li>';
            echo '<span class="divider"></span>';
            
          }
          ?>
        </ul>
        <span id="pnIndicator" class="pn-ProductNav_Indicator"></span>
      </div>
    </nav>
    <a id="pnAdvancerLeft" href="javascript:void(0)" class="pn-Advancer pn-Advancer_Left btn_left" >
      <i class="fa fa-angle-left"></i>
    </a>
    <a id="pnAdvancerRight" href="javascript:void(0)" class="pn-Advancer pn-Advancer_Right btn_right">
      <i class="fa fa-angle-right"></i>
    </a>
  </div>
</div>  
</div>
</header>
<!--- Modal Codes -->
<!--Login popup-->
<div class="modal fade" id="Login" role="dialog">
  <div class="login-popup modal-dialog">

    <!-- Modal content-->
    <div class="pop-up modal-content">
      <div class="pop-up-cnt login-body modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="login-left-cnt col-xs-12 col-sm-7 col-md-7 col-lg-7 no-hor-padding">
          <h2 class="login-header-text bold-font txt-uppercase col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">Login to Fantacy</h2>
          <form>
            <div class="email-addr padding-bottom15 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
              <div class="popup-label-text col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">Email Address:</div>
              <input type="text" class="popup-input col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" name="fname" placeholder="Enter your email address">
            </div>
            <div class="pwd padding-bottom15 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
              <div class="popup-label-text col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">Password:</div>
              <input type="password" class="popup-input col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" name="fname" placeholder="Enter your password">
            </div>
            <div class="remember-pwd padding-bottom15 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
              <input type="checkbox" value="" class="remember-me-checkbox">
              <div class="remember-me-txt">Remember me</div>
            </div>
            <div class="login-forget-pwd col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
              <a href="" class="btn primary-color-bg col-xs-4 col-sm-4 col-md-4 col-lg-4 no-hor-padding"><span class="login-text bold-font txt-uppercase">Login</span></a>
              <a href="" class="forgot-pwd-txt">Forgot password?</a>
            </div>
          </form>
          <div class="or bold-font">OR</div>
        </div>
        <div class="login-right-cnt col-xs-12 col-sm-5 col-md-5 col-lg-5 no-hor-padding">
          <div class="social-buttons col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
            <a href="" class="social-button fb-button bold-font txt-uppercase col-xs-12 col-sm-12 col-md-12 col-lg-12">facebook</a>
            <a href="" class="social-button google-button bold-font txt-uppercase col-xs-12 col-sm-12 col-md-12 col-lg-12">google</a>
            <a href="" class="social-button twitter-button bold-font txt-uppercase col-xs-12 col-sm-12 col-md-12 col-lg-12">twitter</a>
            <div class="new-to-website col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">New to Fantacy? <a href="" data-toggle="modal" data-target="#sign-up" class="sign-up-now-txt bold-font txt-uppercase">Sign up now</a></div>
          </div>
        </div>
      </div>
      <div class="login-footer modal-footer col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
        Interested in selling?<a href="<?php echo SITE_URL.'merchant';?>">Get started</a>
      </div>
    </div>

  </div>
</div>
<!--E O Login popup-->

<!--Signup popup-->
<div class="modal fade" id="sign-up" role="dialog">
  <div class="login-popup modal-dialog">

    <!-- Modal content-->
    <div class="pop-up modal-content">
      <div class="pop-up-cnt login-body modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="signup-left-cnt col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
          <h2 class="login-header-text bold-font txt-uppercase col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">Join Fantacy Today</h2>
          <form>
            <div class="email-addr padding-bottom15 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
              <div class="popup-label-text col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">Full Name:</div>
              <input type="text" class="popup-input col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" name="fname" placeholder="Enter your Full Name">
            </div>
            <div class="email-addr padding-bottom15 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
              <div class="popup-label-text col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">User Name:</div>
              <input type="text" class="popup-input col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" name="fname" placeholder="Enter your User Name">
            </div>
            <div class="email-addr padding-bottom15 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
              <div class="popup-label-text col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">Email Address:</div>
              <input type="text" class="popup-input col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" name="fname" placeholder="Enter your email address">
            </div>
            <div class="pwd padding-bottom15 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
              <div class="popup-label-text col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">Password:</div>
              <input type="password" class="popup-input col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" name="fname" placeholder="Enter your password">
            </div>
            <div class="pwd padding-bottom15 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
              <div class="popup-label-text col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">Captcha:</div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
                <div class="captcha-bg col-xs-12 col-sm-12 col-md-6 col-lg-6 no-hor-padding"><div class="captcha-code bold-font">zpmc9j</div></div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 padding-right0 margin-top20">Can't read? <a href="">Reload.</a></div>
              </div>
            </div>
            <div class="pwd padding-bottom15 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
              <div class="popup-label-text col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">Enter the security code shown above:</div>
              <input type="text" class="popup-input col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" name="fname" placeholder="Enter your password">
            </div>
            <div class="login-forget-pwd col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding padding-bottom15">
              <a href="" class="btn primary-color-bg col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding"><span class="login-text bold-font txt-uppercase">Join Fantacy</span></a>
            </div>
            <div class="signup-tc col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding padding-bottom15">
              By clicking the "Join Fantacy" you are agree that you have read and agree the Fantacy "Terms and Conditions"
            </div>
            <div class="centered-text col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
              ----or use your mail----
            </div>
          </form>
        </div>
        <div class="signup-right-cnt col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding margin-top30">
          <div class="social-buttons col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
            <a href="" class="social-button fb-button bold-font txt-uppercase col-xs-12 col-sm-12 col-md-12 col-lg-12">facebook</a>
            <a href="" class="social-button google-button bold-font txt-uppercase col-xs-12 col-sm-12 col-md-12 col-lg-12">google +</a>
            <div class="new-to-website col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">Already a member? <a href="" data-toggle="modal" data-target="#sign-up" class="sign-up-now-txt bold-font txt-uppercase">Login</a></div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<!--E O Signup popup-->

<!-- Download App Modal -->
<div id="app-modal" class="modal fade" role="dialog">
  <div class="modal-dialog downloadapp-modal">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h1 class="modal-title bold-font margin-bottom15"><?php echo $setngs['site_name'].__d('user',' App');?></h1>
        <div class="modal-header-subheading">
          <?php echo __d('user','Fast, Simple & Delightful. All it takes is 30 seconds to Download!');?></div>
        </div>
        <div class="modal-body">
          <div class="download-app-container margin-bottom20">
            <div class="download-app-col">
              <a href="<?php echo $mobilepages['ioslink'];?>" class="download-app-icon-cnt right-float" target="_blank">
                <img class="download-app-icon primary-color-bg" src="<?php echo SITE_URL;?>images/icons/apple-white-icon.png">
                <div class="download-app-icon-label margin-top30">
                  <?php echo __d('user','iOS app store');?></div>
                </a>
              </div>
              <div class="download-app-col">
                <a href="<?php echo $mobilepages['androidlink'];?>" class="download-app-icon-cnt left-float" target="_blank">
                  <img class="download-app-icon primary-color-bg" src="<?php echo SITE_URL;?>images/icons/android-white-icon.png">
                  <div class="download-app-icon-label margin-top30">
                    <?php echo __d('user','Android play store');?></div>
                  </a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- Share Modal -->
      <div id="share-modals" class="modal fade" role="dialog">
        <div class="modal-dialog downloadapp-modal">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="share-container margin-bottom20">
                <div class="share-cnt-row">
                  <h2 class="bold-font text-center">SHARE THIS THING</h2>
                  <div class="popup-heading-border"></div>
                </div>
                <div class="share-cnt-row">
                  <div class="share-details-cnt margin-top30">
                    <div class="share-details">
                      <div class="share-img margin-right20"><img class="img-responsive" src="images/Home/home-3.jpeg"></div>
                      <div class="share-details-txt">
                        <div class="bold-font">Sparx Brown Casual Shoes</div>
                        <div class="">By Mobile Mela Kingdom</div>
                        <div class="bold-font margin-top20">$150 ($120)</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="share-cnt-row">
                  <div class="share-details-cnt margin-top30 share-icons-cnt padding-top20 padding-bottom20">
                    <div class="share-details margin-top10 margin-bottom10">
                      <a href="" class="share-icons fa fa-facebook-official"></a>
                      <a href="" class="share-icons fa fa-twitter-square"></a>
                      <a href="" class="share-icons fa  fa-google-plus-square"></a>
                      <a href="" class="share-icons fa fa-linkedin-square"></a>
                      <a href="" class="share-icons fa fa-tumblr-square"></a>
                    </div>
                  </div>
                </div>
                <div class="share-cnt-row">
                  <div class="share-details-cnt margin-top30">
                    <a href="" class="share-popup-btn btn primary-color-bg bold-font">CANCEL</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!--- E O Modal Codes -->
      <section class="side-collapse-container">
        <!--Stick floating div code-->
        <section class="container-fluid no-hor-padding sticker-cnt" style="display: none;">
          <div id="sticker">
            <a href=""><div class="active-view default_view bold-font">Default View</div></a>
          </div>
          <div id="sticker">
            <a href="homepage.html"><div class="normal_view custom_view bold-font">custom view</div></a>
          </div>
        </section>
        <!--E O Stick floating div code-->
      </section>
      <input type="hidden" id="languagecode" value="<?php echo $_SESSION['languagecode'];?>">
      <!--section class="container-fluid no-hor-padding sticker-cnt"-->
      <section class="container-fluid side-collapse-container">
        <?php $a=$this->request->controller.'/'.$this->request->action; 
        if($a!='Users/login') { ?>
        <?= $this->Flash->render() ?>
        <?php } ?>
        <?= $this->fetch('content') ?>
      </section>
      <div id="backtotop"><?php echo __d('user','<i class="fa fa-angle-up"></i>'); ?></div>

      <footer class="container-fluid footer_section margin-top40" id="footer">
        <div class="container">
          <div class="footer_container col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
            <div class="footer_column col-xs-12 col-sm-4 col-md-4 col-lg-4 no-hor-padding">
              <ul class="no-hor-padding">
                <?php
                echo '<li class="footer_links"><a href="'.SITE_URL.'help/faq">'.__d('user','FAQ').'</a></li>
                <li class="footer_links"><a href="'.SITE_URL.'help/contact">'.__d('user','Contact').'</a></li>
                <li class="footer_links"><a href="'.SITE_URL.'help/copyright">'.__d('user','Copyright policy').'</a></li>
                <li class="footer_links"><a href="'.SITE_URL.'help/terms_sales">'.__d('user','Terms of sales').'</a></li>
                <li class="footer_links"><a href="'.SITE_URL.'help/terms_service">'.__d('user','Terms of service').'</a></li>
                <li class="footer_links"><a href="'.SITE_URL.'help/terms_condition">'.__d('user','Terms & condition').'</a></li>
                <li class="footer_links"><a href="'.SITE_URL.'help/privacy">'.__d('user','Privacy').'</a></li>

                <li class="footer_links"><a href="'.SITE_URL.'addto">'.__d('user','Resources').'</a></li>';
                ?>
              </ul>
            </div>

            <div class="vertical_line"></div>

            <div class="footer_column col-xs-12 col-sm-4 col-md-4 col-lg-4 no-hor-padding">
              <ul class="no-hor-padding">
                <?php
                if(count($loguser)>0)
                {
                  echo '<li class="footer_links"><a href="'.SITE_URL.'profile">'.__d('user','My account').'</a></li>
                  <li class="footer_links"><a href="'.SITE_URL.'cart">'.__d('user','My cart').'</a></li>

                  <li class="footer_links"><a href="'.SITE_URL.'purchases">'.__d('user','Track orders').'</a></li>
                  ';
                }
                else
                {
                  echo '<li class="footer_links"><a href="'.SITE_URL.'login">'.__d('user','My account').'</a></li>
                  <li class="footer_links"><a href="'.SITE_URL.'login">'.__d('user','My cart').'</a></li>

                  <li class="footer_links"><a href="'.SITE_URL.'login">'.__d('user','Track orders').'</a></li>
                  ';
                }
                ?>
              </ul>
              <div class="hor_footer_divider"></div>
              <ul class="no-hor-padding">
                <li class="footer_labels">
                  <?php echo __d('user','Interested in selling?');?></li>
                  <li class="footer_links padding-top0"><a class="primary-color-txt txt-uppercase" href="<?php echo SITE_URL.'merchant';?>"><?php echo __d('user','get started');?></a></li>
                </ul>
              </div>

              <div class="footer_column col-xs-12 col-sm-4 col-md-4 col-lg-4 no-hor-padding">
                <ul class="no-hor-padding">
                  <?php
                  echo '<li class="footer_links"><a href="'.SITE_URL.'help/about">'.__d('user','About').'</a></li>
                  <li class="footer_links"><a href="'.SITE_URL.'help/documentation">'.__d('user','Documentation').'</a></li>
                  <li class="footer_links"><a href="'.SITE_URL.'help/press">'.__d('user','Press').'</a></li>
                  <li class="footer_links"><a href="'.SITE_URL.'help/pricing">'.__d('user','Pricing').'</a></li>
                  <li class="footer_links"><a href="'.SITE_URL.'help/talk">'.$setngs['site_name'].' '.__d('user','Talk').'</a></li>';
                  ?>
                </ul>
                <div class="hor_footer_divider"></div>
                <ul class="no-hor-padding">
                  <li class="footer_links_bold"><?php echo __d('user','Social media');?></li>
                  <li class="social_icons">
                    <?php
                    $socialLink = $setngs['social_page'];
                    $socialLink = json_decode($socialLink,true);
                    echo '<a href="'.$socialLink['facebook_link'].'" target="_blank"><span class="social_icon_fb"></span></a>
                    <a href="'.$socialLink['twitter_link'].'" target="_blank"><span class="social_icon_twitter"></span></a>
                    <a href="'.$socialLink['instagram_link'].'" target="_blank"><span class="social_icon_instagram"></span></a>';
                    ?>

                  </li>
                </ul>
              </div>
              <?php
              if($setngs['footer_active'] == 'yes')
              {
                echo '<div class="copyrights col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding margin-top20 margin-bottom20">';
                ?>
                <div class="powerd-by">
                 <?php echo $setngs->footer_left; ?>
               </div>
               <div class="product-name">
                 <?php echo $setngs->footer_right; ?>
               </div>


             </div>
             <?php }
             ?>
           </div>
         </div>
       </footer>

       <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
       <!-- Magnific Popup -->
       <!-- staggered grid js -->
       <script src="<?php echo $baseurl;?>js/salvattore.min.js"></script>
       <script src="<?php echo SITE_URL.'js/frontjs/slider.js';?>"></script>
       <script src="<?php echo SITE_URL.'js/multiple-emails.js';?>"></script>
       <script src="<?php echo SITE_URL.'js/frontjs/custom.js';?>"></script>
       <?php
       if(isset($_SESSION['languagecode']) && $_SESSION['languagecode'] == "ar")
       {
        ?>
        <script src="<?php echo SITE_URL.'js/frontjs/slider_rtl.js';?>"></script>
        <?php } else { ?>
        <script src="<?php echo SITE_URL.'js/frontjs/slider_ltr.js';?>"></script>
        <?php } ?>
        <script src="<?php echo SITE_URL.'js/jquery.translate.js';?>"></script>
        <script src="<?php echo SITE_URL.'js/translate.js';?>"></script>
        <!-- Main JS -->
        <script type="text/javascript">

          $(document).ready(function(){
            setTimeout(function(){ $("#notify-message").hide(); }, 5000);
          });
          function shownotiresp()
          {
            var BaseURL=getBaseURL();
            var loguserid = $('#logguserid').val();
    //var loadingimg = $('.loading').val();
    if(pushnoii){
      pushnoii=false;
        //alert(loguserid);
        $.ajax({
          url: BaseURL+"getpushajax/",
          type: "post",
          data : { 'loginuserid': loguserid},
          dataType: "html",
          beforeSend: function() {
            $('.loading').show();
            //$(button).attr("disabled", "disabled");
          },
          success: function(responce){
              //alert(responce);
              $('#noticnts').hide();
              //$(".feed-notification").show();
              $('#pushappends').html(responce);
            }
          });
      }
    }

    /***************search menu***************************/

    $( function() {
      var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
      ];
      $( ".tags" ).autocomplete({
        source: availableTags
      });
    } ); 


    /************Nav right to left slide************/
  </script>
  <style>
    #ui-id-1.ui-menu {
      overflow-x: hidden;
      overflow-y: scroll;
      min-height: 50px;
      max-height: 150px;
    }


    .scrollbar
    {
      padding: 0 11px;
    }

  </style>
</body>
<?php
if($googlecode['status'] == 'yes') {
  echo "<pre>";print_r($googlecode['google_code']);
}
?>
</html>
