<?php
$widgets = explode('(,)',$homepageModel['widgets']);
$sliders = json_decode($homepageModel['slider'], true);
$webslidercount = 0;
$appslidercount = 0;
foreach ($sliders as $key => $webslider) {
	if($webslider['mode'] == 'web')
		$webslidercount++;
	if($webslider['mode'] == 'app')
		$appslidercount++;
}
//$slidercount = count($sliders);
$sliderProperty = json_decode($homepageModel['properties'], true);
$sliderstyle = "style='box-shadow:none;height:".$sliderProperty['sliderheight'].";background-color:".$sliderProperty['sliderbg'].";'";


?>
	<section class="side-collapse-container margin_top165_mobile">
	<!--Stick floating div code-->
		<!--section class="container-fluid no-hor-padding sticker-cnt">
			<div id="sticker">
				<a href="default-homepage.html"><div class="normal_view default_view bold-font">Default View</div></a>
			</div>
			<div id="sticker">
				<a href=""><div class="active-view custom_view bold-font">custom view</div></a>
			</div>
		</section-->
		<!--E O Stick floating div code-->
	<!--Slider code-->
		<section class="container slider">
			<div id="myCarouselweb" class="carousel slide banner_slider col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators web">
			  	<?php
			  	for($i = 0; $i<$webslidercount; $i++)
			  	{
			  		if($i==0)
			  			echo '<li data-target="#myCarouselweb" data-slide-to="'.$i.'" class="active"></li>';
			  		else
			  			echo '<li data-target="#myCarouselweb" data-slide-to="'.$i.'"></li>';
			  	}
			  	?>
			  </ol>
			  <div class="carousel-inner web" role="listbox">
			  <?php
			  $sliderkey = 0;
			  foreach($sliders as $skey => $slider)
			  {
			  	if($slider['mode'] == 'web')
			  	{
				  	if($sliderkey == 0)
				  	{
						echo '<div class="item active">
						<div class="bg_img text-center">
						  <a href="'.$slider['link'].'" target="_blank" style="display:block;">
						  <img src="'.SITE_URL.'images/slider/'.$slider['image'].'" alt="'.$slider['image'].'"> </a>
						  </div>
						</div>';
					}
					else
					{
						echo '<div class="item">
						<div class="bg_img text-center">
							<a href="'.$slider['link'].'" target="_blank" style="display:block;">
						  		<img src="'.SITE_URL.'images/slider/'.$slider['image'].'" alt="'.$slider['image'].'">
						  	</a>
						 </div>
						</div>';
					}
					$sliderkey++;
				}
			  }
			  ?>
			  </div>
			  </div>
			  <div id="myCarouselapp" class="carousel slide banner_slider col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" data-ride="carousel">

			  <ol class="carousel-indicators app">
			  	<?php
			  	for($i = 0; $i<$appslidercount; $i++)
			  	{
			  		if($i==0)
			  			echo '<li data-target="#myCarouselapp" data-slide-to="'.$i.'" class="active"></li>';
			  		else
			  			echo '<li data-target="#myCarouselapp" data-slide-to="'.$i.'"></li>';
			  	}
			  	?>
			  </ol>


			  <div class="carousel-inner app" role="listbox">
			  <?php
			  $sliderkeys = 0;
			  foreach($sliders as $appkey => $appslider)
			  {
			  	if($appslider['mode'] == 'app')
			  	{
				  	if($sliderkeys == 0)
				  	{
						echo '<div class="item active">
						<div class="bg_img">
						  <img src="'.SITE_URL.'images/slider/'.$appslider['image'].'" alt="'.$appslider['image'].'">
						  </div>
						</div>';
					}
					else
					{
						echo '<div class="item">
						<div class="bg_img">
						  <img src="'.SITE_URL.'images/slider/'.$appslider['image'].'" alt="'.$appslider['image'].'">
						 </div>
						</div>';
					}
					$sliderkeys++;
				}
			  }
			  ?>
			  </div>
			  <!-- Left and right controls
			  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			  </a> -->
			</div>
		</section>
	<!--E O Slider code-->
	<!--Daily Deals-->
			<?php	date_default_timezone_set("Asia/KolKata");
				$date = date('d');
				$month = date('m');
				$year = date('Y');
				$today = $month.'/'.$date.'/'.$year;
				$date1 = date('Y-m-d H:i:s');
				$date2 = date("Y-m-d", strtotime($today)).' 24:00:00';
				$diff = abs(strtotime($date2) - strtotime($date1));

				$hours = floor(($diff % 86400) / 3600);
				$mins = floor(($diff % 86400 % 3600) / 60);
				$sec = ($diff % 60);

				?>
				<script type="text/javascript">
				// Initialize the Date object.
				//  The set methods should be filled in by PHP

				var _date = new Date();
				_date.setHours(<?php echo $hours; ?>);
				_date.setMinutes(<?php echo $mins; ?>);
				_date.setSeconds(<?php echo $sec; ?>);

				// Generates a HH:MM:SS string
				function parseDate(dateObj) {
				  var output = "";
				  if(dateObj.getHours() < 10) {
				      output += "";
				  }
				  output += dateObj.getHours() + ":";

				  if(dateObj.getMinutes() < 10) {
				   output += "0";
				  }
				  output += dateObj.getMinutes() + ":";

				  if(dateObj.getSeconds() < 10) {
				   output += "0";
				  }
				  output += dateObj.getSeconds();
				  console.log(output);
				  return output;
				}

				// Start the countdown
				setInterval(function() {
				    _date.setSeconds(_date.getSeconds() - 1);
				    document.getElementById('timer').innerHTML = parseDate(_date);
				}, 1000);
				 </script>

	<?php
	if(count($todaydeal) > 0)
	{
	?>
	<section class="container daily-deals">
		<div class="product_align_cnt col-sm-12 no-hor-padding">
			<div class="item-slider grid col-xs-12 col-sm-12 no-hor-padding">
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 no-hor-padding deal-counter">
					<h2 class="col-xs-12-col-sm-12 deals-heading bold-font">
						<?php echo __d('user','Today\'s Deal');?></h2>
					<div class="col-xs-12-col-sm-12 timer-container">
						<div class="timer-cnt">
							<img src="images/icons/timer.png">
							<span class="time bold-font" id="timer"></span>
						</div>
					</div>
					<div class="col-xs-12-col-sm-12 view-all-btn-container">
						<div class="btn primary-color-bg view-all-btn-cnt margin_bottom_mobile20">
							<a href="<?php echo SITE_URL.'viewmore/dailydeals';?>"><?php echo __d('user','View All');?><span class="view_all_arrow"></span></a>
						</div>
					</div>
				</div>


		<div class=" col-xs-12 col-sm-12 col-md-9 col-lg-9 no-hor-padding product-sec-slide heroSlider-fixed" id="sliderIdName">

         <!-- Slider -->
		 <div class="slider slider-for">
        <div class="slider responsive1">

<?php
foreach($todaydeal as $dealkey => $deal)
{

				$itemid = base64_encode($deal->id."_".rand(1,9999));

				$item_title = $deal['item_title'];
				$item_title_url = $deal['item_title_url'];
				$item_price = $deal['price'];
				$favorte_count = $deal['fav_count'];
				$username = $deal['user']['username'];
				$currencysymbol = $deal['forexrate']['currency_symbol'];
				$items_image = $deal['photos'][0]['image_name'];



						$item_image = $deal['photos'][0]['image_name'];
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


					$itemprice = $deal['price'];
	$discountprice = $itemprice * ( 1 - $deal['discount'] / 100 );

	$item_url = base64_encode($deal['id']."_".rand(1,9999));

	$user_currency_price =  $currencycomponent->conversion($deal['forexrate']['price'],$_SESSION['currency_value'],$itemprice);

	$user_currency_dealprice = $currencycomponent->conversion($deal['forexrate']['price'],$_SESSION['currency_value'],$discountprice);
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

				echo '<div class="item1 box_shadow_img fh5co-board-img">
				<div class="product_cnt clearfix">
					<a class="img-hover1" href="'.SITE_URL.'listing/'.$item_url.'">
					<div class="bg_product">
						<img src="'.$itemimage.'" class="img-responsive">
					</div></a>
				<div class="hover-visible">
				<span class="hover-icon-cnt like_hover" href="javascript:void(0)" onclick="itemcou('.$deal['id'].')">';
								
					if(count($likeditemid)!=0 &&  in_array($deal['id'],$likeditemid)){
							/*echo 	'<i class="fa fa-heart like-icon'.$deal['id'].'" id="like-icon'.$deal['id'].'"></i>*/
				echo '<img src="images/icons/liked-w.png" id="like-icon'.$deal['id'].'" class="like-icon'.$deal['id'].'">
								<span class="like-txt'.$deal['id'].' nodisply" id="like-txt'.$deal['id'].'" >'.$setngs['like_btn_cmnt'].'</span>';}
								else
								{
				/*echo 	'<i class="fa fa-heart-o like-icon'.$deal['id'].'" id="like-icon'.$deal['id'].'"></i>*/
			echo '<img src="images/icons/heart_icon.png" id="like-icon'.$deal['id'].'" class="like-icon'.$deal['id'].'">
												<span class="like-txt'.$deal['id'].' nodisply" id="like-txt'.$deal['id'].'" >'.$setngs['like_btn_cmnt'].'</span>';
								}
				echo '</span>
				<span class="hover-icon-cnt share_hover" href="javascript:void(0)" onclick="share_posts('.$deal['id'].');" data-toggle="'.$temp.'" data-target="'.$temp1.'" ><img src="'.SITE_URL.'images/icons/share_icon.png"></span>
					</div>

					';
				echo '<span id="figcaption_titles'.$deal['id'].'" figcaption_title ="'.$item_title.'" style="display:none;width:0px !important;"></span>';
				echo  '<span class="figcaption" id="figcaption_title_url'.$deal['id'].'" figcaption_url ="'.$item_title_url.'" style="display:none;width:0px !important;" >'.$item_title_url.'</span>';
				echo '<span id="price_vals'.$deal['id'].'" price_val="'.$_SESSION['currency_symbol'].$user_currency_price.'" style="display:none;width:0px !important;"></span>';
				echo '<a href="'.SITE_URL."people/".$username.'"  id="user_n'.$deal['id'].'" usernameval ="'.$username.'" style="display:none;width:0px !important;"></a>';
				echo '<span id="img_'.$deal['id'].'" class="nodisply" style="display:none;width:0px !important;">'.SITE_URL.'media/items/original/'.$items_image.'</span>';
				echo '<span class="fav_count" id="fav_count'.$deal['id'].'" fav_counts ="'.$favorte_count.'" style="display:none;width:0px !important;"></span>';
					echo '<div class="rate_section col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
						<div class="product_name bold-font col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
							<a class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" href="'.SITE_URL.'listing/'.$item_url.'">'.$deal['item_title'].'</a><br>
				<span class="price"><a class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" href="">';


				
				if(isset($_SESSION['currency_code'])){?>&#x200E;<?php
					//echo '('.$_SESSION['currency_symbol'].' '.$user_currency_dealprice.')';
					echo $_SESSION['currency_symbol'].' '.$user_currency_dealprice;
					}
					else{?>&#x200E;<?php
					//echo ' ('.$deal['forexrate']['currency_symbol'].' '.$discountprice.')';
						echo $deal['forexrate']['currency_symbol'].' '.$discountprice;
				}
					echo ' ';
				if(isset($_SESSION['currency_code'])){?>&#x200E;<?php
					echo '<strike class="bold-font">'.$_SESSION['currency_symbol'].' '.$user_currency_price.'</strike>';
				}
					else{?>&#x200E;<?php
				echo '<strike class="bold-font">'.$deal['forexrate']['currency_symbol'].' '.$itemprice.'</strike>';
			}
			
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
				<div class="preb slick-disabled" style="display: block;">
					<span class="fa fa-angle-left" aria-hidden="true"></span>
				</div>
				<div class="nexb" style="display: block;">
					<span class="fa  fa-angle-right" aria-hidden="true"></span>
				</div>
				</div>

      </div>


				<div class="nodisply carousel slide col-xs-12 col-sm-12 col-md-9 col-lg-9 no-hor-padding product-sec-slide deals-carousel" data-ride="carousel" data-interval="false" data-type="multi" data-interval="3000" id="itemCarousel">
				  <div class="carousel-inner">
    <?php
    foreach($todaydeal as $dealkey => $deal)
    {
    	if($dealkey == 0)
		echo '<div class="item active">';
		else
		echo '<div class="item">';
		if($deal['photos'][0]['image_name']=="")
		$itemimage = "usrimg.jpg";
		else
		$itemimage = $deal['photos'][0]['image_name'];
			echo '<div class="product_cnt col-lg-4 col-md-4 col-sm-6 col-xs-12">
				<a class="img-hover" href="javascript:void(0)">
					<img src="'.$baseurl.'media/items/original/'.$itemimage.'" class="img-responsive" />
					<div class="hover-visible">
						<span class="hover-icon-cnt like_hover" href="javascript:void(0)"><img src="images/icons/heart_icon.png"></span>
						<span class="hover-icon-cnt share_hover" href="javascript:void(0)" data-toggle="modal" data-target="#share-modal"><img src="images/icons/share_icon.png"></span>
					</div>
				</a>
				<div class="rate_section col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
					<div class="product_name bold-font col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
						<a class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" href="">'.$deal['item_title_url'].'</a><br/>
						<span class="price"><a class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" href="">'.$deal['forexrate']['currency_symbol'].$deal['price'].'</a></span>
					</div>
				</div>
			</div>
		</div>';
	}
	?>

				  </div>
				  <a class="left carousel-control" href="#itemCarousel" data-slide="prev"><i class="fa  fa-angle-left"></i></a>
				  <a class="right carousel-control" href="#itemCarousel" data-slide="next"><i class="fa  fa-angle-right"></i></a>
				</div>
			  <!-- end Bottom to top-->
			</div>
		</div>
	</section>
	<?php } ?>

	<?php foreach ($widgets as $widget){
	switch ($widget){
		case 'Recently Added':
			echo $this->element('recentlyadded');
			break;
		case 'Most Popular':
			echo $this->element('mostpopular');
			break;
		case 'Most Commented':
			echo $this->element('mostcommented');
			break;
		case 'Top Stores':
			echo $this->element('topstores');
			break;
		/*case 'Most Popular Categories':
			echo $this->element('popularcategory');
			break;*/
		case 'Featured Items':
			echo $this->element('featured');
			break;
	}
} ?>

	</section>
	<?php
if(isset($loguser['id']))
	echo '<input type="hidden" id="loguserid" value="'.$loguser['id'].'">';
else
	echo '<input type="hidden" id="loguserid" value="0">';

				echo '<input type="hidden" id="likebtncnt" value="'.$setngs['like_btn_cmnt'].'" />';
				echo '<input type="hidden" id="likedbtncnt" value="'.$setngs['liked_btn_cmnt'].'" />';
?>

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