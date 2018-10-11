<?php
use Cake\Routing\Router;
$baseurl = Router::url('/');
?>

<div class="container-fluid margin-top10 no_hor_padding_mobile">
  <div class="container">
<div class="breadcrumb col-xs-12 col-sm-12 col-md-12 col-lg-12 margin_top_150_tab">
	<div class="breadcrumb">
      <a href="<?php echo $baseurl;?>"><?php echo __d('user','Home');?></a>
      <span class="breadcrumb-divider1">/</span>
      <a href="#"><?php echo __d('user','View Profile');?></a>
     
     </div>
    </div>
      <section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
		<div class="user_image1">
			<?php
			$user_imges = $userdetail['profile_image'];
			if($user_imges == "")
				$user_imges = "usrimg.jpg";
			else
				$user_imges = $userdetail['profile_image'];
			echo '<div class="user_image" style="background: url('.SITE_URL.'media/avatars/thumb70/'.$user_imges.') no-repeat scroll 50% 0 / cover;"></div>';
			?>
		</div>
     <div class="profile_bg text-center margin_top_50minus">
     	<?php
     if(isset($loguser['id']) && $loguser['id'] == $userdetail['id'])
     {
     	echo '<a href="'.SITE_URL.'profile"><div class="text-right follow_btn_user_moble">
     	<button class="btn folow_btn_user_profile">'.__d('user','Edit Profile').'</button></div></a>';
     }
     else{
			if($userid != $userdetail['id']){
				foreach($flwrscnt as $flcnt){
					if($flcnt['follow_user_id'] == $userid){
						$flwrcntid[] = $flcnt['user_id'];
					}

				}
				if($userid != $userdetail['id']){
					if(!in_array($userdetail['id'],$flwrcntid)){
						$flw = true;
					}else{
						$flw = false;
					}
			if($flw)
			{
			echo '<span id="foll'.$userdetail['id'].'"><div class="text-right follow_btn_user_moble">
				<a href="javascript:void(0);" class="btn folow_btn_user_profile" onclick="getfollows('.$userdetail['id'].')">'.__d('user','Follow').'</a></div></span>';
			}
			else
			{
			echo '<span id="unfoll'.$userdetail['id'].'"><div class="text-right follow_btn_user_moble">
			<a href="javascript:void(0);" class="btn user_unfollowers" onclick="deletefollows('.$userdetail['id'].')">'.__d('user','Unfollow').'</a></div></span>';
			}
					if(isset($_SESSION['languagecode']) && $_SESSION['languagecode'] == 'ar')
					{
						echo '<span id="changebtn'.$userdetail['id'].'" style="float:left;"  class="margin-bottom20"></span>';
					}
					else
					{
						echo '<span id="changebtn'.$userdetail['id'].'" style="float:right;"  class="margin-bottom20"></span>';
					}
				}
			}
	}
	?>

<?php
     echo '<h2 class="bold-font margin-top20" style="clear:both;">'.$userdetail['first_name'].'</h2>
     <p class="profile_text">@'.$userdetail['username_url'].'</p>
     <hr class="horizontal_line">
     <p class="profile_text margin-bottom5">'.$userdetail['shop']['shop_address'].'</p>
     <p class="description_text description_text">'.$userdetail['about'].'</p>';
    ?>
    <?php if($userdetail['website']!="") {?>
    <p class="profile_text"> <b>Web site:</b><?php echo $userdetail['website'];?></p>
    <?php } 
    if($userdetail['city']!="") {
    ?>
     <p class="profile_text"> <b>Location:</b><?php echo $userdetail['city'];?></p>
     <?php } ?>
     </div>
   </section>
  </div>
    </div>

	<section class="container-fluid side-collapse-container no_hor_padding_mobile">
		<div class="container">


			<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 margin-top10 no-hor-padding">


      <div id="parentVerticalTab">

            <ul class="resp-tabs-list">
            	<?php
            	if(count($_GET)==0)
            		echo '<li class="resp-tab-active">';
            	else
            		echo '<li>';
            	?>
                <a href="<?php echo $baseurl.'people/'.$_SESSION['username_urls'];?>"><span>
                	<?php
                	echo $setngs['liked_btn_cmnt'];
                	?>
                </span><span class="rtl_tab_list" style="padding-left:2px">(<?php echo $itemfavcount;?>)</span></a></li>
            	<?php
            	if(isset($_REQUEST['lists']))
            		echo '<li class="resp-tab-active">';
            	else
            		echo '<li>';
            	?>
                <a href="<?php echo $baseurl.'people/'.$_SESSION['username_urls'].'?lists';?>"><span><?php echo __d('user','Collection');?></span><span class="rtl_tab_list" style="padding-left:2px" >(<?php echo $itemListsCount; ?>)</span></a></li>
            	<?php
            	if(isset($_REQUEST['stores']))
            		echo '<li class="resp-tab-active">';
            	else
            		echo '<li>';
            	?>
                <a href="<?php echo $baseurl.'people/'.$_SESSION['username_urls'].'?stores';?>"><span><?php echo __d('user','Favourite Store');?></span><span class="rtl_tab_list" style="padding-left:2px">(<?php echo $storeCount;?>)</span></a></li>
            	<?php
            	if(isset($_REQUEST['followers']))
            		echo '<li class="resp-tab-active">';
            	else
            		echo '<li>';
            	?>
                <a href="<?php echo $baseurl.'people/'.$_SESSION['username_urls'].'?followers';?>"><span><?php echo __d('user','Followers');?></span><span class="rtl_tab_list" style="padding-left:2px">(<?php echo count($people_details);?>)</span></a></li>
            	<?php
            	if(isset($_REQUEST['followings']))
            		echo '<li class="resp-tab-active">';
            	else
            		echo '<li>';
            	?>
                <a href="<?php echo $baseurl.'people/'.$_SESSION['username_urls'].'?followings';?>"><span><?php echo __d('user','Following');?></span><span class="rtl_tab_list" style="padding-left:2px">(<?php echo count($people_details_for_following);?>)</span></a></li>
            </ul>

		<div class="resp-tabs-container">
			<?php
			$selectedTab = '';
			if(count($_GET)==0)
			{
				$selectedTab = 'fantacy';
			?>
			<?php if(count($itematas)>0) { ?>
                <div class="row hor-padding resp-tab-content padding-top0 resp-tab-content-active profile-content">
									<h2 class="user_profile_inner_heading padd_lft10_mobile"><?php echo __d('user','All Products');?></h2>
									<p class="margin-bottom40 padd_lft10_mobile txt_center_mobile time_text"><?php echo __d('user','as you');?> <?php echo $setngs['liked_btn_cmnt']; ?> <?php echo __d('user','always');?></p>
		<?php
		foreach($itematas as $itemdata)
		{
		$image_name = $itemdata[photos][0]['image_name'];
		$itemid = base64_encode($itemdata->id."_".rand(1,9999));
				$item_title = $itemdata['item_title'];
				$item_title_url = $itemdata['item_title_url'];
				$item_price = $itemdata['price'];
				$favorte_count = $itemdata['fav_count'];
				$username = $itemdata['user']['username'];
				$currencysymbol = $itemdata['forexrate']['currency_symbol'];
				$items_image = $itemdata['photos'][0]['image_name'];
				$dealprice = $item_price * ( 1 - $itemdata['discount'] / 100 );


					$itemprice = $itemdata['price'];

				$user_currency_price =  $currencycomponent->conversion($itemdata['forexrate']['price'],$_SESSION['currency_value'],$itemprice);

				echo '<span id="figcaption_titles'.$itemdata['id'].'" figcaption_title ="'.$item_title.'" ></span>';
				echo  '<span class="figcaption" id="figcaption_title_url'.$itemdata['id'].'" figcaption_url ="'.$item_title_url.'" style="position: relative; top: 10px; left: 7px;display:none;" >'.$item_title_url.'</span>';
				echo '<span id="price_vals'.$itemdata['id'].'" price_val="'.$_SESSION['currency_symbol'].$user_currency_price.'" ></span>';
				echo '<a href="'.SITE_URL."people/".$username.'"  id="user_n'.$itemdata['id'].'" usernameval ="'.$username.'"></a>';
				echo '<span id="img_'.$itemdata['id'].'" class="nodisply">'.SITE_URL.'media/items/original/'.$items_image.'</span>';
				echo '<span class="fav_count" id="fav_count'.$itemdata['id'].'" fav_counts ="'.$favorte_count.'" ></span>';

						$item_image = $itemdata['photos'][0]['image_name'];
						if($item_image == "")
						{
							$itemimage = SITE_URL.'media/items/original/usrimg.jpg';
						}
						else
						{
							$itemimage = WWW_ROOT.'media/items/original/'.$item_image;
							/*$header_response = get_headers($itemimage, 1);*/
							if (file_exists($itemimage))
							{
								$itemimage = SITE_URL.'media/items/original/'.$item_image;
							}
							else
							{
								$itemimage = SITE_URL.'media/items/original/usrimg.jpg';
							}
						}

		echo '<div class="product_cnt col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-bottom20">
		<figure class="animate-boxs">
				<a class="img-hover1 fh5co-board-img" href="'.$baseurl.'listing/'.$itemid.'">
				<div class="bg_product">
					<img src="'.$itemimage.'" class="img-responsive" />
					</div>
				</a>

			<div class="hover-visible">
				<span class="hover-icon-cnt like_hover" href="javascript:void(0)" onclick="itemcou('.$itemdata['id'].')">';

		foreach($itemdata['itemfavs'] as $useritemfav){
			if($useritemfav['user_id'] == $userid ){
				$usecoun[] = $useritemfav['item_id'];
			}
		}
		if(isset($usecoun) &&  in_array($itemdata['id'],$usecoun)){
			/*echo '<i class="fa fa-heart like-icon'.$itemdata['id'].'"></i>*/
			echo '<img src="'.SITE_URL.'images/icons/liked-w.png" id="like-icon'.$itemdata['id'].'" class="like-icon'.$itemdata['id'].'">
				<span class="like-txt'.$itemdata['id'].' nodisply">'.$setngs['liked_btn_cmnt'].'</span>';
		}
		else
		{
			/*echo '<i class="fa fa-heart-o like-icon'.$itemdata['id'].'"></i>*/
			echo '<img src="'.SITE_URL.'images/icons/heart_icon.png" id="like-icon'.$itemdata['id'].'" class="like-icon'.$itemdata['id'].'">
				<span class="like-txt'.$itemdata['id'].' nodisply">'.$setngs['like_btn_cmnt'].'</span>';
		}



				echo '</span>
				<span class="hover-icon-cnt share_hover" href="javascript:void(0)" onclick="share_posts('.$itemdata['id'].')" data-toggle="modal" data-target="#share-modal"><img src="'.SITE_URL.'images/icons/share_icon.png"></span>
			</div>
	</figure>
				<div class="rate_section padding-left0 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
					<div class="product_name bold-font col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
						<a class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" href="">'.$itemdata->item_title.'</a><br/>
						<span class="price"><a class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" href="">';
				if(isset($_SESSION['currency_code']))
					echo $_SESSION['currency_symbol'].$user_currency_price;
				else
					echo $itemdata['forexrate']['currency_symbol'].$itemprice;
						echo '</a></span>
					</div>
				</div>
		</div>';
		}
		?>

			</div>
			<?php } else {

					echo '<div class="text-center padding-top30 padding-bottom30">
						 <div class="outer_no_div">
						  <div class="empty-icon no_products_icon"></div>
						 </div>
						 <h5>'.__d('user','No Products').'</h5>
						</div>';
				}
				?>
		<?php } ?>

<?php
if(isset($_REQUEST['lists'])){
	$selectedTab = 'lists';
?>

<div class="row hor-padding padding-top0 resp-tab-content hor_1 resp-tab-content-active profile-content">
				<div>
									<h2 class="margin-bottom40 user_profile_inner_heading padd_lft10_mobile" id="category-tabs"><?php echo __d('user','My Collections');?></h2>
	<?php
	if(count($itemListsAll)>0)
	{
	foreach($itemListsAll as $list)
	{
		$lists_name = $list['lists'];
		$listimage = $userdetail['profile_image'];
		if($listimage == "")
			$listimage = "usrimg.jpg";
        echo '<div class="product_cnt col-lg-4 col-md-4 col-sm-6 col-xs-6 margin-bottom20">
				<a href="javascript:void(0);" onclick="show_lists('.$list->id.');" data-toggle="modal" data-target="#user_lists">
					<div class="img_list_tab" style="background-image:url('.SITE_URL.'media/avatars/original/'.$listimage.');background-repeat:no-repeat;">

					<div class="trans">
						<p class="text-center trans_text white-txt">'.$lists_name.'</p>
					</div>
					</div>
				</a>
					</div>';
	}
}
else{
	echo '					<div class="text-center padding-top30 padding-bottom30">
										 <div class="outer_no_div">
										  <div class="empty-icon no_list_icon"></div>
										 </div>
										 <h5>'.__d('user','No List').'</h5>
										</div>';
}
	?>




										<!--div class="centered-text col-xs-12 col-sm-12 col-md-12 col-lg-12"><a href="">+ load more</a></div-->
				</div>

			   </div><!---tab2 content ends---->
			   <?php } ?>
<?php
if(isset($_REQUEST['stores'])){
	$selectedTab = 'stores';
if(count($shopsdet)>0){

			echo '<div class="row resp-tab-content padding-top0 resp-tab-content-active profile-content">
				<div>
									<h2 class="user_profile_inner_heading margin-bottom40 padd_lft10_mobile">'.__d('user','FAVOURITE STORE').'</h2>';

					foreach ($shopsdet as $shopdatas){  //print_r($shopdatas);
							$shop_name = $shopdatas['shop_name'];
							$shop_name_url = $shopdatas['shop_name_url'];
							$shop_img = $shopdatas['shop_image'];
							$merchant_name = $shopdatas['merchant_name'];
							$item_count = $shopdatas['item_count'];
							$shop_id = $shopdatas['id'];
							$shop_user_id = $shopdatas['user_id'];
							$follow_count = $shopdatas['follow_count'];
							$follow_shop = $shopdatas['follow_shop'];
							$shopBanner=$shopdatas['shop_banner'];
										if($shop_img == "")
							$shop_img = "usrimg.jpg";
							
							if(!empty($shopBanner))
							{
								$shop_bannerimg = SITE_URL.'media/avatars/original/'.$shopBanner;
							}
							else
							{
								$shop_bannerimg = SITE_URL.'images/banner_1.png';
							}
								
										echo '<div class="product_cnt col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-bottom20">
											<div class="favourite_store" style="background-image:url('.$shop_bannerimg.');background-repeat:no-repeat;">

											</div>
												<div class="user_favourite_image1 margin_top_40min">
														<a href='.SITE_URL.'stores/'.$shop_name_url.'><div class="user_favourite_image" style="background-image:url('.SITE_URL.'media/avatars/thumb70/'.$shop_img.');background-repeat:no-repeat;"></div></a>
													</div>
											<div class="user_favourite">
												<h4 class="margin-bottom0 extra_text_hide">'.$shop_name.'</h4>
												<p class="profile_text margin-bottom20 extra_text_hide">'.__d('user','By').' '.$merchant_name.'</p>';
							
							
            foreach($followcnt as $flcnt){
            	$flwrcntid[] = $flcnt['store_id'];
            }

			if($shop_id != $loguser['id']){
            	if(in_array($shop_id,$flwrcntid)  && isset($loguser['id']) ){
            		$flw = false;
            	}else{
            		$flw = true;
            	}
            	if($flw)
            	{
				echo '<span id="foll'.$shop_id.'"><div class="user_followers_butn btn">
				<a href="javascript:void(0);" onclick="getshopfollows('.$shop_id.')">'.__d('user','Follow Store').'</a></div></span>';
            	}
            	else
            	{
			echo '<span id="unfoll'.$shop_id.'"><div class="btn user_unfollowers">
			<a href="javascript:void(0);" onclick="deleteshopfollows('.$shop_id.')">'.__d('user','Unfollow Store').'</a></div></span>';
			}
	echo '<span id="changebtn'.$shop_id.'"></span>';
	}
											echo '</div>
										</div>';
										}


										}
										else
										{
								echo '<div class="text-center padding-top30 padding-bottom30">
										 <div class="outer_no_div">
										  <div class="empty-icon no_store_icon"></div>
										 </div>
										 <h5>'.__d('user','No Stores').'</h5>
										</div>';
										}
                echo '</div><!---tab3 content ends---->';
                }
                ?>
<?php
if(isset($_REQUEST['followers'])){
	$selectedTab = 'followers';

echo '<div class="row resp-tab-content padding-top0 resp-tab-content-active profile-content">';
if(count($people_details) > 0)
{
						echo '<div>
									<h2 class="user_profile_inner_heading margin-bottom40 padd_lft10_mobile">'.__d('user','Followers').'</h2>';
foreach($people_details as $ppl){
			$profile_img = $ppl['profile_image'];
			$user_nam_url = $ppl['username_url'];
			if($profile_img == "")
				$profile_img = "usrimg.jpg";
                     echo '<div class="product_cnt col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-bottom20 following'.$ppl['id'].'">
											<div class="user_follower_image1">




											<a href='.SITE_URL.'people/'.$user_nam_url.'><div class="user_follower_image" style="background-image:url('.SITE_URL.'media/avatars/thumb70/'.$profile_img.')"></div></a>
														
													</div>
											<div class="user_followers">
												<h4 class="margin-bottom0 extra_text_hide">'.$ppl['first_name'].'</h4>
												<p class="profile_text margin-bottom20 extra_text_hide">@'.$ppl['username'].'</p>';
						foreach($followerscnt as $flcnt){
							$followerscntid[] = $flcnt['user_id'];

						}

			if($userid != $ppl['id']){
			//print_r($ppls['User']['id']);echo "<=>".$loguser[0]['User']['id']."/";print_r($flwrcntid);
							/*if(in_array($ppls['User']['id'],$flwrcntid)  && isset($loguser[0]['User']['id']) ){
								$flw = false;
							}else {
							    $flw = true;
						        }*/
							if(in_array($ppl['id'],$followerscntid)  && isset($loguser['id']) ){
								$flw = false;
							}else {
							    $flw = true;
						        }
			if($flw)
			{
			echo '<span id="foll'.$ppl['id'].'"><div class="user_followers_butn btn">
				<a href="javascript:void(0);" onclick="getfollows('.$ppl['id'].')">'.__d('user','Follow').'</a></div></span>';
			}
			else
			{
			echo '<span id="unfoll'.$ppl['id'].'"><div class="btn user_unfollowers">
			<a href="javascript:void(0);" onclick="deletefollows('.$ppl['id'].')">'.__d('user','Unfollow').'</a></div></span>';
			}

			echo '<span id="changebtn'.$ppl['id'].'" ></span>';
			}
										echo '</div></div>';


					}
					echo '</div>';

					}else{





								echo '<div class="text-center padding-top30 padding-bottom30">
										 <div class="outer_no_div">
										  <div class="empty-icon no_follow_icon"></div>
										 </div>
										 <h5>'.__d('user','No Followers').'</h5>
										</div>';
										}
                echo '</div><!---tab4 content ends---->';
                  } ?>
 <?php
if(isset($_REQUEST['followings'])){
	$selectedTab = 'followings';
echo '<div class="row padding-top0 resp-tab-content resp-tab-content-active profile-content">';
if(count($people_details_for_following)>0){


								 echo '<div>
									<h2 class="user_profile_inner_heading margin-bottom40 padd_lft10_mobile">'.__d('user','Following').'</h2>';
		foreach($people_details_for_following as $ppl){
			$profile_img = $ppl['profile_image'];
			$user_nam_url = $ppl['username_url'];
			if($profile_img == "")
				$profile_img = "usrimg.jpg";
                    echo '<div class="product_cnt col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-bottom20 following'.$ppl['id'].'">
											<div class="user_follower_image1">




											<a href='.SITE_URL.'people/'.$user_nam_url.'><div class="user_follower_image" style="background-image:url('.SITE_URL.'media/avatars/thumb70/'.$profile_img.')"></div></a>
														
													</div>
											<div class="user_followers">
												<h4 class="margin-bottom0 extra_text_hide">'.$ppl['first_name'].'</h4>
												<p class="profile_text margin-bottom20 extra_text_hide">@'.$ppl['username'].'</p>';
						foreach($followerscnt as $flcnt){
							$followerscntid[] = $flcnt['user_id'];

						}

			if($userid != $ppl['id']){
			//print_r($ppls['User']['id']);echo "<=>".$loguser[0]['User']['id']."/";print_r($flwrcntid);
							/*if(in_array($ppls['User']['id'],$flwrcntid)  && isset($loguser[0]['User']['id']) ){
								$flw = false;
							}else {
							    $flw = true;
						        }*/
							if(in_array($ppl['id'],$followerscntid)  && isset($loguser['id']) ){
								$flw = false;
							}else {
							    $flw = true;
						        }
			if($flw)
			{
			echo '<span id="foll'.$ppl['id'].'"><div class="user_followers_butn btn">
				<a href="javascript:void(0);" onclick="getfollows('.$ppl['id'].')">'.__d('user','Follow').'</a></div></span>';
			}
			else
			{
			echo '<span id="unfoll'.$ppl['id'].'"><div class="btn user_unfollowers">
			<a href="javascript:void(0);" onclick="deletefollows('.$ppl['id'].')">'.__d('user','Unfollow').'</a></div></span>';
			}

			echo '<span id="changebtn'.$ppl['id'].'" ></span>';
			}
										echo '</div></div>';


					}
					echo '</div>';

										}else {

								echo '<div class="text-center padding-top30 padding-bottom30">
										 <div class="outer_no_div">
										  <div class="empty-icon no_follow_icon"></div>
										 </div>
										 <h5>'.__d('user','No Following').'</h5>
										</div>';
										}
                echo '</div><!---tab5 content ends---->';
                } ?>

			   </div><!---tab1 content ends---->

            </div>
      </div>


			</section>
		</div>
	</section>
<?php
		if(empty($userid)){
		echo "<input type='hidden' id='gstid' value='0' />";
	}else{
		echo "<input type='hidden' id='gstid' value='".$userid."' />";
	}
	echo "<input type='hidden' id='selectedtab' value='".$selectedTab."' />";
				echo '<input type="hidden" id="likebtncnt" value="'.$setngs['like_btn_cmnt'].'" />';
				echo '<input type="hidden" id="likedbtncnt" value="'.$setngs['liked_btn_cmnt'].'" />';
	?>

		<!--User list popup-->
	<div class="modal fade" id="user_list" role="dialog" tabindex="-1" >
		<div class="login-popup modal-dialog">

		  <!-- Modal content-->
		  <div class="pop-up modal-content user_list_width" style="width:100%;">
			<div class="pop-up-cnt login-body modal-body" style="width:100%;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<div>
				<div class="signup-left-cnt col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding scroll_user">
							<!---- list products---->
							<div id="listproducts">

							</div>
							<!---- list products---->

							</div>

				</div>
			</div>
			</div>
		  </div>
		</div>
			<!--User list popup-->

	<!-- Share Modal -->
	<div id="share-modal" class="modal fade" role="dialog">
	  <div class="modal-dialog downloadapp-modal">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-body">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="share-container margin-bottom20">
				<div class="share-cnt-row">
					<h2 class="bold-font text-center"><?php echo __d('user','SHARE THIS THING');?></h2>
					<div class="popup-heading-border"></div>
				</div>
				<div class="share-cnt-row">
					<div class="share-details-cnt margin-top30">

					<?php
						echo '<div class="share-details">
							<div class="share-img margin-right20"><img id="share_img" class="img-responsive" src=""></div>
							<div class="share-details-txt">
								<div class="bold-font" id="share_title"></div>
								<div class="">'.__d('user','By').' <span id="share_username"></span></div>
								<div class="bold-font margin-top20" id="share_price"></div>
							</div>
						</div>';
					?>

					</div>
				</div>
				<div class="share-cnt-row">
					<div class="share-details-cnt margin-top30 share-icons-cnt padding-top20 padding-bottom20">
						<div class="share-details margin-top10 margin-bottom10">
							<a href="" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="share-icons fa fa-facebook-official facebook" target="_blank"></a>
							<a href="" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="share-icons fa fa-twitter-square twitter" target="_blank"></a>
							<a href="" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="share-icons fa  fa-google-plus-square google" target="_blank"></a>
							<a href="" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="share-icons fa fa-linkedin-square linkedin" target="_blank"></a>
							<a href="" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');" class="share-icons fa fa-stumbleupon stumbleupon" target="_blank"></a>
							<a href="" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="share-icons fa fa-tumblr-square tumblr" target="_blank"></a>
						</div>
					</div>
				</div>
				<!--div class="share-cnt-row">
					<div class="share-details-cnt margin-top30">
						<a href="" class="share-popup-btn btn primary-color-bg bold-font">CANCEL</a>
					</div>
				</div-->
			</div>
		  </div>
		</div>

	  </div>
	</div>
	<!-- Share modal -->

<script type="text/javascript">
var sIndex = <?php echo $startIndex; ?>, offSet = 15, isPreviousEventComplete = true, isDataAvailable = true;
var baseurl = getBaseURL();var selectedtab = $('#selectedtab').val();

$(window).scroll(function () {
	 //if ($(document).height() - 50 <= $(window).scrollTop() + $(window).height()) {
	if ($(window).scrollTop() >= ($(document).height() - $(window).height())*0.5) {
	  if (isPreviousEventComplete && isDataAvailable) {

	    isPreviousEventComplete = false;
		var baseurl = getBaseURL()+"getmoreprofile";
	    $(".LoaderImage").css("display", "block");
if(selectedtab!='write_review')
{
	    $.ajax({
	      type: "POST",
	      url: baseurl+'?startIndex=' + sIndex + '&offset=' + offSet + '&tab=' + selectedtab,
	      data: {},
	      beforeSend: function () {
	    	  $('#infscr-loading').show();
			},
		  dataType: 'html',
	      success: function (responce) {
	      	$('#infscr-loading').hide();
	      	if($.trim(responce)=='')
	      	$(window).unbind('scroll');
	      	else if ($.trim(responce) != 'false') {
		      	if (selectedtab == 'added') {
			        $('.profile-content').append(responce);
		      	}else if (selectedtab == 'fantacy') {
			        $('.profile-content').append(responce);
		      	}else if (selectedtab == 'ownit') {
			        $('.profile-content').append(responce);
		      	}else if (selectedtab == 'wantit') {
			        $('.profile-content').append(responce);
		      	}else if (selectedtab == 'lists') {
			        $('.profile-content').append(responce);
		      	}else if (selectedtab == 'followers') {
			        $('.profile-content').append(responce);
		      	}else if (selectedtab == 'followings') {
			        $('.profile-content').append(responce);
		      	}
		      	else if (selectedtab == 'stores') {
			        $('.profile-content').append(responce);
		      	}
	        }else {
	            isDataAvailable = false;
			}
	        sIndex = sIndex + offSet;
	        isPreviousEventComplete = true;
	      }
	    });
}
	  }
	 }
	 });
</script>

	<!-- Add to list popup -->
		<div id="add-to-list" class="modal fade" role="dialog" tabindex="-1" >
	  <div class="modal-dialog login-popup">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-body padding_btm45_mobile padding-top30">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="share-container margin-bottom20">
				<div class="share-cnt-row">
					<h2 class="bold-font text-center">Add to your Collection</h2>
					<div class="popup-heading-border"></div>
				</div>
				<div class="share-cnt-row">
					<div class="share-details-cnt margin-top30">
						<div class="share-details">
							<div class="col-sm-6 col-xs-12">
								<img id="selectimgs" class="img-responsive center-block" src="images/Home/home-2.png" width="325">
							</div>
							<div class="col-sm-6 col-xs-12">
							<div class="right_border">
							<form class="categorycls" id="categorycls">
							<?php
							foreach($items_list_data as $list_item){
							echo '<div class="checkbox checkbox-primary padding-bottom15 edit_popup_border margin-bottom20">
								<input id="'.$list_item['id'].'" name="category_items[]" value="'.$list_item['lists'].'" type="checkbox">
								<label for="'.$list_item['id'].'">'.$list_item['lists'].'</label>
							</div>';
							}
							foreach($prnt_cat_data as $main_cat){
							echo '<div class="checkbox checkbox-primary padding-bottom15 edit_popup_border margin-bottom20">
								<input id="'.$main_cat['id'].'" name="category_items[]" value="'.$main_cat['category_name'].'" type="checkbox">
								<label for="'.$main_cat['id'].'">'.$main_cat['category_name'].'</label>
							</div>';
							}
							echo '<div class="appen_div" ></div>';
							?>
							</form>
							</div>
							<div class="input-group list_create">
								  <input type="text" id="new-create-list" name="list_name" class="form-control no_border" placeholder="List Name">
								  <span class="input-group-btn btn primary-color-bg" id="list_createid">
									<a href="javascript:void(0);" >Create</a>
								  </span>
							</div><!-- /input-group -->
							<div id="listerr" style="display:none;color:red;font-size:13px;">Enter list name</div>
							</div>
							</div>

						</div>
					</div>
					<div class="share-cnt-row padding-top30 text-center">
						<a href="javascript:void(0);" id="btn-doneid" class="edit_popup_button btn primary-color-bg bold-font transparent_border">Done</a>
						<a href="javascript:void(0);" class="edit_popup_button btn primary-color-border-btn bold-font margin-left10 btn-unfancy"><?php echo $setngs['unlike_btn_cmnt'];?></a>
				</div>
				</div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
		<!-- Add to list popup -->