	<!--Featured-->
	<section class="container featured">
		<div class="product_align_cnt col-sm-12 no-hor-padding">
			<div class="item-slider grid col-xs-12 col-sm-12 no-hor-padding">
				<div class="section_header col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
					<h2 class="section_heading bold-font">
						<?php  global $loguser; echo __d('user','Featured');//print_r($loguser);?>
					</h2>
					<div class="view-all-btn btn primary-color-bg primary-color-bg pull-right">
						<a href="<?php echo SITE_URL.'viewmore/featured';?>">
							<?php echo __d('user','View All');?></a>
					</div>
				</div>
		<div class="  col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding product-sec-slide heroSlider-fixed">
		<?php
		if(isset($loguser['id']))
	echo '<input type="hidden" id="loguserid" value="'.$loguser['id'].'">';
else
	echo '<input type="hidden" id="loguserid" value="0">';

				echo '<input type="hidden" id="likebtncnt" value="'.$setngs['like_btn_cmnt'].'" />';
				echo '<input type="hidden" id="likedbtncnt" value="'.$setngs['liked_btn_cmnt'].'" />';
				?>

         <!-- Slider -->
        <div class="slider responsive" id="featured">

<?php



foreach($featuredModel as $featuredkey => $featured)
{
				
				
				$itemid = base64_encode($featured->id."_".rand(1,9999));

				$item_title = $featured['item_title'];
				$item_title_url = $featured['item_title_url'];
				$item_price = $featured['price'];
				$favorte_count = $featured['fav_count'];
				$username = $featured['user']['username'];
				$currencysymbol = $featured['forexrate']['currency_symbol'];
				$items_image = $featured['photos'][0]['image_name'];

		if($featured['photos'][0]['image_name']=="")
		$itemimage = "usrimg.jpg";
		else
		$itemimage = $featured['photos'][0]['image_name'];


		$item_image = $featured['photos'][0]['image_name'];
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

	$item_url = base64_encode($featured['id']."_".rand(1,9999));


					$itemprice = $featured['price'];
$user_currency_price =  $currencycomponent->conversion($featured['forexrate']['price'],$_SESSION['currency_value'],$itemprice);

if($loguser=="")
{
	$temp = ""; 
	$temp1= "";
}
else
{
	$temp = "modal";
	$temp1=  "#share-modal";
}
				echo '<div class="item1 box_shadow_img">
				<div class="product_cnt clearfix">
				<a class="img-hover1" href="'.SITE_URL.'listing/'.$item_url.'">
				<div class="bg_product">
					<img src="'.$itemimage.'" class="img-responsive" />
					</div>
					
				

				</a> <div class="hover-visible">
				<span class="hover-icon-cnt like_hover" href="javascript:void(0)" onclick="itemcou1('.$featured['id'].')">';
					if(count($likeditemid)!=0 &&  in_array($featured['id'],$likeditemid)){
							/*echo 	'<i class="fa fa-heart like-icon'.$featured['id'].'" id="like-icon'.$featured['id'].'"></i>*/
							echo '<img src="images/icons/liked-w.png" id="like-icon'.$featured['id'].'" class="like-icon'.$featured['id'].'">
								<span class="like-txt'.$featured['id'].' nodisply" id="like-txt'.$featured['id'].'" >'.$setngs['like_btn_cmnt'].'</span>';}
								else
								{
				/*echo 	'<i class="fa fa-heart-o like-icon'.$featured['id'].'" id="like-icon'.$featured['id'].'"></i>*/
				echo '<img src="images/icons/heart_icon.png" id="like-icon'.$featured['id'].'" class="like-icon'.$featured['id'].'">
												<span class="like-txt'.$featured['id'].' nodisply" id="like-txt'.$featured['id'].'" >'.$setngs['like_btn_cmnt'].'</span>';
								}
				echo '</span>
				<span class="hover-icon-cnt share_hover" href="javascript:void(0)" onclick="share_posts('.$featured['id'].');" data-toggle="'.$temp.'" data-target="'.$temp1.'"><img src="'.SITE_URL.'images/icons/share_icon.png"></span>
					</div>';



	
				echo '<span id="figcaption_titles'.$featured['id'].'" figcaption_title ="'.$item_title.'" style="display:none;width:0px !important;"></span>';
				echo  '<span class="figcaption" id="figcaption_title_url'.$featured['id'].'" figcaption_url ="'.$item_title_url.'" style="display:none;width:0px !important;" >'.$item_title_url.'</span>';
				echo '<span id="price_vals'.$featured['id'].'" price_val="'.$_SESSION['currency_symbol'].$user_currency_price.'" style="display:none;width:0px !important;"></span>';
				echo '<a href="'.SITE_URL."people/".$username.'"  id="user_n'.$featured['id'].'" usernameval ="'.$username.'" style="display:none;width:0px !important;"></a>';
				echo '<span id="img_'.$featured['id'].'" class="nodisply" style="display:none;width:0px !important;">'.SITE_URL.'media/items/original/'.$items_image.'</span>';
				echo '<span class="fav_count" id="fav_count'.$featured['id'].'" fav_counts ="'.$favorte_count.'" style="display:none;width:0px !important;"></span>';

				echo '<div class="rate_section col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
					<div class="product_name bold-font col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
						<a class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" href="'.SITE_URL.'listing/'.$item_url.'">'.$featured['item_title'].'</a><br/>
			<span class="price">
<a class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" href="javascript:void(0);">';
				if(isset($_SESSION['currency_code'])){?>&#x200E;<?php
					echo $_SESSION['currency_symbol'].' '.$user_currency_price;
				}
					else{?>&#x200E;<?php
					echo $featured['forexrate']['currency_symbol'].' '.$itemprice;}
echo '</a></span>
					</div>
				</div>
				</div>

	</div>';
}
?>


            </div>

        <ul class="slick-dots" style="display: block;"><li class="slick-active" aria-hidden="false"><button type="button" data-role="none">1</button></li><li aria-hidden="true"><button type="button" data-role="none">2</button></li></ul>

				<!-- control arrows -->
				<div class="prev preb slick-disabled" style="display: block;">
					<span class="fa fa-angle-left" aria-hidden="true"></span>
				</div>
				<div class="next nexb" style="display: block;">
					<span class="fa  fa-angle-right" aria-hidden="true"></span>
				</div>
				</div>
		</div>
	</div>
	</section>