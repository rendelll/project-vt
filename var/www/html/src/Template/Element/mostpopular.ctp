	<!--Popular products-->
	
	<section class="container pop-products">
		<div class="product_align_cnt col-sm-12 no-hor-padding">
			<div class="item-slider grid col-xs-12 col-sm-12 no-hor-padding">
				<div class="section_header col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
					<h2 class="section_heading bold-font">
						<?php echo __d('user','Popular Products');?>
					</h2>
					<div class="view-all-btn btn primary-color-bg primary-color-bg pull-right">
						<a href="<?php echo SITE_URL.'viewmore/popular';?>"><?php echo __d('user','View All');?></a>
					</div>
				</div>
		<div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding product-sec-slide heroSlider-fixed" id="sliderIdName">

         <!-- Slider -->
		 <div class="slider slider-for">
        <div class="slider responsive3">
	<?php
	
	foreach ($mostpopularModel as $popularkey => $mostpopular) {
	$item_url = base64_encode($mostpopular['id']."_".rand(1,9999));

				$itemid = base64_encode($mostpopular->id."_".rand(1,9999));

				$item_title = $mostpopular['item_title'];
				$item_title_url = $mostpopular['item_title_url'];
				$item_price = $mostpopular['price'];
				$favorte_count = $mostpopular['fav_count'];
				$username = $mostpopular['user']['username'];
				$currencysymbol = $mostpopular['forexrate']['currency_symbol'];
				$items_image = $mostpopular['photos'][0]['image_name'];

		if($mostpopular['photos'][0]['image_name']=="")
		$itemimage = "usrimg.jpg";
		else
		$itemimage = $mostpopular['photos'][0]['image_name'];


		$item_image = $mostpopular['photos'][0]['image_name'];
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
					$itemprice = $mostpopular['price'];

			$user_currency_price =  $currencycomponent->conversion($mostpopular['forexrate']['price'],$_SESSION['currency_value'],$itemprice);
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
					</div></a>
				<div class="hover-visible">
				<span class="hover-icon-cnt like_hover" href="javascript:void(0)" onclick="itemcou('.$mostpopular['id'].')">';
								
					if(count($likeditemid)!=0 &&  in_array($mostpopular['id'],$likeditemid)){
							/*echo 	'<i class="fa fa-heart like-icon'.$mostpopular['id'].'" id="like-icon'.$mostpopular['id'].'"></i>*/
							echo '<img src="images/icons/liked-w.png" id="like-icon'.$mostpopular['id'].'" class="like-icon'.$mostpopular['id'].'">
								<span class="like-txt'.$mostpopular['id'].' nodisply" id="like-txt'.$mostpopular['id'].'" >'.$setngs['like_btn_cmnt'].'</span>';}
								else
								{
				/*echo 	'<i class="fa fa-heart-o like-icon'.$mostpopular['id'].'" id="like-icon'.$mostpopular['id'].'"></i>*/
				echo '<img src="images/icons/heart_icon.png" id="like-icon'.$mostpopular['id'].'" class="like-icon'.$mostpopular['id'].'">
												<span class="like-txt'.$mostpopular['id'].' nodisply" id="like-txt'.$mostpopular['id'].'" >'.$setngs['like_btn_cmnt'].'</span>';
								}
				echo '</span>
				<span class="hover-icon-cnt share_hover" href="javascript:void(0)" onclick="share_posts('.$mostpopular['id'].');" data-toggle="'.$temp.'" data-target="'.$temp1.'"><img src="'.SITE_URL.'images/icons/share_icon.png"></span>
					</div>

				';

				echo '<span id="figcaption_titles'.$mostpopular['id'].'" figcaption_title ="'.$item_title.'" style="display:none;width:0px !important;"></span>';
				echo  '<span class="figcaption" id="figcaption_title_url'.$mostpopular['id'].'" figcaption_url ="'.$item_title_url.'" style="display:none;width:0px !important;" >'.$item_title_url.'</span>';
				echo '<span id="price_vals'.$mostpopular['id'].'" price_val="'.$_SESSION['currency_symbol'].$user_currency_price.'" style="display:none;width:0px !important;"></span>';
				echo '<a href="'.SITE_URL."people/".$username.'"  id="user_n'.$mostpopular['id'].'" usernameval ="'.$username.'" style="display:none;width:0px !important;"></a>';
				echo '<span id="img_'.$mostpopular['id'].'" class="nodisply" style="display:none;width:0px !important;">'.SITE_URL.'media/items/original/'.$items_image.'</span>';
				echo '<span class="fav_count" id="fav_count'.$mostpopular['id'].'" fav_counts ="'.$favorte_count.'" style="display:none;width:0px !important;"></span>';

				echo '<div class="rate_section col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
					<div class="product_name bold-font col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
						<a class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" href="'.SITE_URL.'listing/'.$item_url.'">'.$mostpopular['item_title'].'</a><br/>
						<span class="price"><a class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" href="javascript:void(0);">';
					//new changes find discount price
							$discountprice = $user_currency_price * ( 1 - $mostpopular['discount'] / 100 );

						
					/*echo $discountprice = $itemprice * ( 1 - $mostpopular['discount'] / 100 );
					$user_currency_price =  $currencycomponent->conversion($mostpopular['forexrate']['price'],$_SESSION['currency_value'],$itemprice);
						if(isset($_SESSION['currency_code'])){?>&#x200E;<?php
					
					echo $_SESSION['currency_symbol'].' '.$user_currency_dealprice;
					}
					else{?>&#x200E;<?php
					
						echo $mostpopular['forexrate']['currency_symbol'].' '.$discountprice;
				}
					echo ' '; */
				if(isset($_SESSION['currency_code'])){?>&#x200E;<?php
					echo $_SESSION['currency_symbol'].' '.$user_currency_price;
				
					}
					else{?>&#x200E;<?php
					echo $mostpopular['forexrate']['currency_symbol'].' '.$itemprice;}
					
						echo '</a></span>
					</div>
				</div>
				</div>

	</div>';
	}
	?>


            </div>

        <ul class="slick-dots" style="display: block;"><li class="slick-active" aria-hidden="false"><button type="button" data-role="none">1</button></li><li aria-hidden="true"><button type="button" data-role="none">2</button></li></ul></div>


				<!-- control arrows -->
				<div class="prev2 preb slick-disabled" style="display: block;">
					<span class="fa fa-angle-left" aria-hidden="true"></span>
				</div>
				<div class="next2 nexb" style="display: block;">
					<span class="fa  fa-angle-right" aria-hidden="true"></span>
				</div>
				</div>
		</div>
	</div>
	</section>