<?php
use Cake\Routing\Router;
$baseurl = Router::url('/');
?>

		<section class="container margin_top165_mobile">


<?php
if($displaybanner == "yes")
{
	if(count($bannerdatas)>0)
	{
		echo '<section class="breadcrumb col-xs-12 col-sm-12 col-md-12 col-lg-12 margin_top_150_tab">';
		echo $bannerdatas['html_source'];
		echo '</section>';
	}
}
//echo $bannerdatas;
?>

			<div class="prod-cnt col-xs-12 col-sm-12 col-lg-12 no-hor-padding">
				<div class="col-xs-12 col-sm-12 col-md-6 no-hor-padding">
					<div class="product-slider-cnt item-slider">
						<div id="carousel" class="carousel slide product-slider" data-ride="carousel" data-interval="false">
							<div class="carousel-inner">
							<?php
							$j = 0;
							foreach($photos as $photo)
							{



								$item_image = $photo['image_name'];
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
								if($j==0)
								echo '<div class="item active thumb-image">';
								else
								echo '<div class="item">';
								echo '<img src="'.$itemimage.'" data-imagezoom="true">
								</div>';
								$j++;
							}

								$submitID = $item_datas['videourrl'];

								if (strpos($submitID, '/') === false) {
									$videoID = $submitID;
								}else {
									preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $submitID, $matches);
									if (isset($matches[1]))
									{
										$videoID = $matches[1];
									}else {
										$videoID = '';
									}
								}
								//echo $videoID;die;

								echo '<div class="item" id="video_carousel">
								<iframe id="iframeYoutube" width="100%" height="315"  src="https://www.youtube.com/embed/'.$videoID.'" frameborder="0" allowfullscreen></iframe>

								</div>';


							?>
							</div>
						</div>
						<?php
						if(count($photos)>1)
						{
							?>
						<div class="clearfix">
							<div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding product-sec-slide heroSlider-fixed" id="sliderIdName">
										 <div class="slider slider-for">
        							<div class="slider responsive_product">

									<?php
									$k = 0;
									foreach($photos as $photo)
									{

								$item_image = $photo['image_name'];
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
										echo '<div class="item0">';
										echo '<div data-target="#carousel" data-slide-to="'.$k.'" class="thumb"><img src="'.$itemimage.'"></div>';
										$k++;
										echo '</div>';
									}
							if($item_datas['videourrl']!="")
							{
								$submitID = $item_datas['videourrl'];

								if (strpos($submitID, '/') === false) {
									$videoID = $submitID;
								}else {
									preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $submitID, $matches);
									if (isset($matches[1]))
									{
										$videoID = $matches[1];
									}else {
										$videoID = '';
									}
								}
								//echo $videoID;die;
									echo '<div class="item0">
									<div data-target="#carousel" data-slide-to="'.$k.'" class="thumb">
									<div class="videooverlaydiv"></div>
									<a  href="javascript:void(0);"><img src="http://i1.ytimg.com/vi/' .$videoID. '/1.jpg" style="width:70px;height:70px;" /></a>
									</div></div>';
								}

									?>


        </div>


				<!-- control arrows -->
				<div class="prev2 preb cr-prev">
					<span class="fa fa-angle-left" aria-hidden="true"></span>
				</div>
				<div class="next2 cr-next nexb">
					<span class="fa  fa-angle-right" aria-hidden="true"></span>
				</div>
				</div>

      </div>
						</div><!-- /clearfix -->
<?php } else if(count($photos)==1 && $item_datas['videourrl'] != "") { ?>

						<div class="clearfix">
							<div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding product-sec-slide heroSlider-fixed" id="sliderIdName">
										 <div class="slider slider-for">
        							<div class="slider responsive_product">

									<?php
									$k = 0;
									foreach($photos as $photo)
									{

								$item_image = $photo['image_name'];
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
										echo '<div class="item0">';
										echo '<div data-target="#carousel" data-slide-to="'.$k.'" class="thumb"><img src="'.$itemimage.'"></div>';
										$k++;
										echo '</div>';
									}

								$submitID = $item_datas['videourrl'];

								if (strpos($submitID, '/') === false) {
									$videoID = $submitID;
								}else {
									preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $submitID, $matches);
									if (isset($matches[1]))
									{
										$videoID = $matches[1];
									}else {
										$videoID = '';
									}
								}
								//echo $videoID;die;
									echo '<div class="item0">
									<div data-target="#carousel" data-slide-to="'.$k.'" class="thumb">
									<div class="videooverlaydiv" onclick="showvideourll(\''.$videoID.'\');"></div>
									<a  href="javascript:void(0);" onclick="showvideourll(\''.$videoID.'\');"><img src="http://i1.ytimg.com/vi/' .$videoID. '/1.jpg" style="width:70px;height:70px;" /></a>
									</div></div>';

									/*echo '';
										echo '<div data-target="#carousel" data-slide-to="'.$k.'" class="thumb"><img src="'.$itemimage.'"></div>';
										$k++;
										echo '</div>';*/
									?>


        </div>


				<!-- control arrows -->
				<div class="prev2 cr-prev">
					<span class="fa fa-angle-left" aria-hidden="true"></span>
				</div>
				<div class="next2 cr-next">
					<span class="fa  fa-angle-right" aria-hidden="true"></span>
				</div>
				</div>

      </div>
						</div><!-- /clearfix -->
	<?php } ?>


					</div>
				</div> <!-- /col-sm-6 -->
	<?php
	$listitemimage = $item_datas['photos'][0]['image_name'];
	if($listitemimage == "")
		$listitemimage = "usrimg.jpg";
		echo '<input type="hidden" id="img_id'.$item_datas['id'].'" value="'.SITE_URL.'media/items/original/'.$listitemimage.'">';
		echo '<input type="hidden" id="itemid" value="'.$item_datas['id'].'">';
		echo '<input type="hidden" id="userid" value="'.$userid.'">';
		echo '<input type="hidden" value="'.$userid.'" id="loguser_id" />';
		echo '<input type="hidden" id="merchantid" value="'.$item_datas['user']['id'].'">';
		echo '<input type="hidden" id="merchantname" value="'.$item_datas['user']['username'].'" />';
		echo '<input type="hidden" id="itemname" value="'.$item_datas['item_title'].'" />';
		echo '<input type="hidden" value="'.$loguser['username'].'" id="usernames" />';
				echo '<input type="hidden" id="likebtncnt" value="'.$setngs['like_btn_cmnt'].'" />';
				echo '<input type="hidden" id="likedbtncnt" value="'.$setngs['liked_btn_cmnt'].'" />';
				echo '<input type="hidden" id="loguserid" value="'.$loguser['id'].'">';
			echo "<input type='hidden' id='featureditemid' value='".$item_datas['id']."' />";
					if(!empty($usershipping['profile_image'])){
					echo '<input type="hidden" value="'.$usershipping['profile_image'].'" id="userimges" />';
					}else{
						echo '<input type="hidden" value="usrimg.jpg" id="userimges" />';
					}
	?>

				<div class="col-xs-12 col-sm-12 col-md-6 no-hor-padding">
					<div class="prod-detail-cnt col-xs-12 col-sm-12 no-hor-padding">
						<div class="prod-detail-row col-xs-12 col-sm-12 no-hor-padding">
							<h2 class="prod-name bold-font" style="word-break: break-all;">
							<?php echo $item_datas['item_title'];?>
							</h2>

							<?php
							$date = date('d');
							$month = date('m');
							$year = date('y');
							$today = strtotime($month.'/'.$date.'/'.$year);
							$dealdate=strtotime($item_datas['dealdate']);
							if ($dealdate==$today) {
								echo '<strike class="bold-font price-strike">';
							}
							else{
								echo '<h1 class="prod-cost bold-font margin-top10">';
							}
							?>
							
							

							<?php
							$sizeoptions = json_decode($item_datas['size_options'],true);
							foreach ($sizeoptions['price'] as $key => $value) {
								$price[] = $value;
							}
							/*if(count($sizeoptions)>0)
							{

				$user_currency_price =  $currencycomponent->conversion($item_datas['forexrate']['price'],$_SESSION['currency_value'],$price[0]);
							if(isset($_SESSION['currency_code']))
								echo $_SESSION['currency_symbol'].$user_currency_price;
							else
								echo $item_datas['forexrate']['currency_symbol'].$price[0];
							}
							else
							{*/
								//echo $item_datas['dailydeal'];
								
							if($item_datas['dealdate']!= $today){

				              $user_currency_price =  $currencycomponent->conversion($item_datas['forexrate']['price'],$_SESSION['currency_value'],$item_datas['price']);

							if(isset($_SESSION['currency_code'])){ ?>&#x200E;<?php



								echo $_SESSION['currency_symbol'].' '.$user_currency_price;
							
							}
							else{
								?>&#x200E;<?php
								echo $item_datas['forexrate']['currency_symbol'].' '.$item_datas['price'];
								
							}
							}
							//}
							if ($dealdate==$today) {
								echo '</strike>';
							}
							else{
								echo '</h1>';
							}
							?>
		       <?php
				if($item_datas['dailydeal'] == 'yes' && $dealdate == $today) {
				date_default_timezone_set("Asia/KolKata");
				$date1 = date('Y-m-d H:i:s');
				$date2 = date("Y-m-d", strtotime($item_datas['Item']['dealdate'])).' 24:00:00';
				$diff = abs(strtotime($date2) - strtotime($date1));

				$hours = floor(($diff % 86400) / 3600);
				$mins = floor(($diff % 86400 % 3600) / 60);
				$sec = ($diff % 60);
			?>
				<script type="text/javascript">
				// Initialize the Date object.
				//  The set methods should be filled in by PHP

				var _date = new Date();
				_date.setHours('<?php echo $hours; ?>');
				_date.setMinutes('<?php echo $mins; ?>');
				_date.setSeconds('<?php echo $sec; ?>');

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
							$price=$item_datas['price'];
							$discountprice =  $price * ( 1 - $item_datas['discount'] / 100 );
							$user_deal_currency_price =  $currencycomponent->conversion($item_datas['forexrate']['price'],$_SESSION['currency_value'],$discountprice);
							if(isset($_SESSION['currency_code']))
                			{?>&#x200E;<?php
								echo '<div class="price-tag">'.$_SESSION['currency_symbol'].' '.'<span class="deal-price">'.$user_deal_currency_price.'</span>';
							}
							else{
								?>&#x200E;<?php
								echo '<div class="price-tag">'.$item_datas['forexrate']['currency_symbol'].' '.'<span class="deal-price">'.$discountprice.'</span>';
							}

							//New changes for strike
							if($item_datas['dailydeal']=='yes' && $item_datas['dealdate']== $today){
						$user_currency_price =  $currencycomponent->conversion($item_datas['forexrate']['price'],$_SESSION['currency_value'],$item_datas['price']);

							if(isset($_SESSION['currency_code'])){ ?>&#x200E;<?php



								echo '<strike class="pro-strike">'.$_SESSION['currency_symbol'].' '.$user_currency_price.'</strike>';
								//echo "if";
							}
							else{
								?>&#x200E;<?php
								echo '<strike class="pro-strike">'.$item_datas['forexrate']['currency_symbol'].' '.$item_datas['price'].'</strike>';
								//echo "else";
							}
							} 

							//New changes for strike end 
							

							?>
							</div>
							<div>
							<?php echo $item_datas['discount'].' % '.__d('user','off Ends in').' ';?>
							<span id="timer"></span>
							<?php //echo $item_datas['dailydeal'];?>
						</div>
							<?php } ?>
							<?php
							/* QUANTITY AVAILABILITY */

							if($item_datas['quantity']<10 && $item_datas['quantity'] != 0){ ?>
							<div class="prod-qty margin-top15"><?php echo __d('user','Quantity only');?> <b><?php echo $item_datas['quantity'];?></b> <?php echo __d('user','available');?></div>
							<?php }

							/* CHECK SOLDOUT */
							if($item_datas['quantity']<=0)
							{
								echo '<h1 class="red-txt">'.__d('user','Sold Out').'</h1>';
							}
							?>
							<input type="hidden" value="<?php echo $item_datas['quantity'];?>" id="quantity_val">
						</div>

						<div class="prod-detail-row col-xs-12 col-sm-12 no-hor-padding">
							<div class="col-xs-12 col-sm-12 no-hor-padding margin-bottom20">

							<!--CHANGE QUANTITY AND SIZES-->
							<?php
							$soldout=0;
							$sizes = json_decode($item_datas['size_options'],true);
							if(!empty($sizes) && $item_datas['quantity']>0){
							$sizeavail =1;
							$ech = $item_datas['size_options']; //print_r($item_datas);
							$eche = json_decode($ech, true);
							$echo = array_values($eche[0]);
							$count = count($eche[0]);
							$sz_count = count($eche['size']);
							$qty = reset($eche['unit']);

							foreach($eche['size'] as $val){
								$qty = $eche['unit'][$val];

								if ($qty > 0){
									$sizeVal[] = $val;

								}
							}
							//print_r($sizeVal);
							?>
							<input type="hidden" value="1" name="sizeset" id="sizeset">
							<?php if($sizeVal[0] != '') { ?>

							<div class="site-dd size-dd dropdown col-xs-12 col-sm-4 no-hor-padding">
							<div class="selectdiv">
							<select class="dropdown-toggle"  id="size_opt" name='size_opt' onchange="itemlistingloadqty('<?php echo $item_datas['id']; ?>')">
								<option value="" ><?php echo __d('user','SIZE'); ?></option>
								<?php
								foreach($eche['size'] as $sizeopt){
									$qty = $eche['unit'][$sizeopt];

									if ($qty > 0){
										$sizeVal[] = $val;
							  			echo '<option value="'.$sizeopt.'">'.$sizeopt.'</option>';
									}
							 	}
								 ?>
								</select>
								</div>
							</div>


							<div class="site-dd size-dd dropdown col-xs-12 col-sm-4 sizeqtydiv">
							<div class="selectdiv">
							<select class="dropdown-toggle"  id="qty-counter" name='qty-counter'>
							<option value="" ><?php echo __d('user','QUANTITY'); ?></option>
							<?php $szeopt = json_decode($item_datas['size_options'],true);
							    if(!empty($szeopt)){
									$ech = $item_datas['size_options']; //print_r($item_datas);
									$eche = json_decode($ech, true);

									foreach($eche['size'] as $sizeopt){
											$qty = $eche['unit'][$sizeopt];

											if ($qty > 0){
												$sizeVal[] = $val;

											}
									 }
									$qty = $eche['unit'][$sizeVal[0]];
									if($qty=='0'){$soldout=1;}
							    }else
									$qty = $item_datas['quantity'];
									if($qty=='0'){$soldout=1;}
									for($i = 1; $i <= $qty; $i++ ){
										echo '<option value="'.$i.'">'.$i.'</option>';
									}?>

							<!--<input type="number" class="form-control" name="qty-counter" id="qty-counter" value="1" min="1" max="<?php //echo $qty;?>"/>-->
							</select>
							</div>
							</div>
							<div class="sizeqtyloader"  style="display: none;">
								<img src="<?php echo SITE_URL; ?>images/loading.gif" />
							</div>

							<?php }}
							else if($item_datas['quantity']>0){
							$sizeavail =0;
							?>
							<input type="hidden" value="0" name="sizeset" id="sizeset">
							<div class="site-dd size-dd dropdown col-xs-12 col-sm-4 sizeqtydiv">
							<div class="selectdiv">
							<select class="dropdown-toggle"  id="qty-counter" name='qty-counter'>
							<option value="" ><?php echo __d('user','QUANTITY'); ?></option>
							<?php
								$qty = $item_datas['quantity'];
									if($qty==0){
										$soldout=1;
									}
									for($i = 1; $i <= $qty; $i++ ){
										echo '<option value="'.$i.'">'.$i.'</option>';
									} ?>
									</select>
									</div>
								</div>
							<?php }
							?>
							<!--CHANGE QUANTITY AND SIZES-->
							</div>
							<input type="hidden" id="sizeavail" value="<?php echo $sizeavail;?>"/>
							<span class="size_error errcls red-txt"><?php echo __d('user','Please select the size');?></span>
							<span class="qty_error errcls red-txt"><?php echo __d('user','Please select the quantity');?></span>
							<div class="col-xs-12 col-sm-12 no-hor-padding">
	<?php
		foreach($item_datas['itemfavs'] as $useritemfav){
			if($useritemfav['user_id'] == $userid ){
				$usecoun[] = $useritemfav['item_id'];
			}
		}
		if(isset($usecoun) &&  in_array($item_datas['id'],$usecoun)){
			echo '<div class="like-counter-cnt">
				<a href="javascript:void(0);" onclick="itemcounew('.$item_datas['id'].');" class="like-cnt primary-color-txt"><i class="fa fa-heart like-icon'.$item_datas['id'].'"></i> <span class="like-txt'.$item_datas['id'].'">'.$setngs['liked_btn_cmnt'].'</span></a>
				<a href="javascript:void(0);" class="like-counter arrow_box">'.$item_datas['fav_count'].'</a>
			</div>';
		}
		else
		{
			echo '<div class="like-counter-cnt">
				<a href="javascript:void(0);" onclick="itemcounew('.$item_datas['id'].');" class="like-cnt primary-color-txt"><i class="fa fa-heart-o like-icon'.$item_datas['id'].'"></i> <span class="like-txt'.$item_datas['id'].'">'.$setngs['like_btn_cmnt'].'</span></a>
				<a href="javascript:void(0);" class="like-counter arrow_box">'.$item_datas['fav_count'].'</a>
			</div>';
		}
	?>


								<a href="javascript:void(0);" onclick="itemcoulist(<?php echo $item_datas['id'];?>);" class="add-to-list-cnt">
									<div class="add-to-list-icon"></div>
									<div class="add-to-list-txt"><?php echo __d('user','Add to your collection');?></div>
								</a>
								<a href="javascript:void(0);" onclick="share_post(<?php echo $item_datas['id'];?>)" class="prod-share-icon-cnt">
									<div class="prod-share-icon"></div>
									<div class="add-to-list-txt"><?php echo __d('user','Share');?></div>
								</a>
							</div>
						</div>

<img id="fullimgtag" style="display: none;" alt="<?php echo $item_datas['item_title'];?>" title="<?php echo $item_datas['item_title'];?>" src="<?php echo SITE_URL.'media/items/original/'.$item_datas['photos'][0]['image_name'];?>">
<input type="hidden" id="item-descript" value="<?php echo strip_tags($item_datas['item_description']); ?>">

<?php
					echo '<input type="hidden" id="listingid" value="'.$item_datas['id'].'" />';
					echo '<input type="hidden" id="merchantid" value="'.$item_datas['user']['id'].'" />';
					?>


						<div class="prod-detail-row col-xs-12 col-sm-12 no-hor-padding">

				<?php
				$itemid = $item_datas['id'];
				$url = base64_encode($itemid."_".rand(1,9999));
				if($item_datas['share_coupon'] == 'yes' && !empty($loguser) && empty($shareCouponDetail) && $item_datas['status']=='publish'){
				if($item_datas["share_discountAmount"] == '')
				{
					?>
			<div class="col-xs-12 col-sm-12 no-hor-padding"><span>
					<?php echo __d('user','Share facebook get'); ?> <?php echo  $item_datas["share_discountAmount"];?>% <?php echo __d('user','discount'); ?> <a id="" class="red-txt" href="<?php echo SITE_URL.'listing/'.$url ;?>"><?php echo __d('user','share it'); ?>!</a>
				</span>
			</div>
					<!--button id="facebooksharebtn" class="facebuk btn-green grnshare col-lg-3 col-md-5 pdt-btns" type="button" href="<?php echo $url ;?>"><?php //echo  __d('user','Share Discount')?></button-->
				<?php }
				else
				{?>
			<div class="col-xs-12 col-sm-12 no-hor-padding"><span>
					<?php echo __d('user','Share facebook get'); ?> <?php echo  $item_datas["share_discountAmount"];?>% <?php echo __d('user','discount'); ?> <a id="facebooksharebtn" class="red-txt" href="javascript:void(0);"><?php echo __d('user','share it'); ?></a>
					<input type="hidden" id="discount_fb_share" val="<?php echo SITE_URL.'listing/'.$url ;?>" />
				</span>
			</div>
					<!--button id="facebooksharebtn" class="facebuk btn-green grnshare col-lg-3 col-md-5 pdt-btns" type="button" href="<?php echo $url ;?>"><?php //echo  $item_datas["share_discountAmount"].'% '.__d('user','Share Discount')?></button-->
				<?php }
				}?>

							<!--div class="col-xs-12 col-sm-12 no-hor-padding"><span>Share facebook get 20% discount</span> <a href="" class="red-txt" data-toggle="modal" data-dismiss="modal" data-target="#share-it-modal">share it!</a>
							</div-->
							<div class="prod-detail-btn-cnt col-xs-12 col-sm-12 no-hor-padding">



								<?php if(!empty($sizes) && $soldout=='0'){
								if (($item_datas['status']=='publish')) {
								if ($userid!='') {
								?>
								<a onclick="cart_show();" class="col-xs-12 col-sm-4  btn primary-color-border-btn prod-detail-btn bold-font"><?php echo __d('user','ADD TO CART'); ?></a>
								<?php }
								else { ?>
								<a href="<?php echo $baseurl.'login/';?>" class="col-xs-12 col-sm-4  btn primary-color-border-btn prod-detail-btn bold-font"><?php echo __d('user','ADD TO CART'); ?></a>
								<?php } ?>
								<?php
								/*if ($item_datas['cod']=='yes')
								{*/
									if ($userid!='') { ?>
										<a onclick="return buynow_show();" class="col-xs-12 col-sm-4 btn primary-color-bg prod-detail-btn bold-font"><?php echo __d('user','BUY NOW'); ?></a>
								<?php }
									else
									{ ?>
										<a href="<?php echo $baseurl.'login/';?>" class="col-xs-12 col-sm-4 btn primary-color-bg prod-detail-btn bold-font"><?php echo __d('user','BUY NOW'); ?></a>
									<?php
									}
								/*}*/
								}}
								else
								{	if (($item_datas['status']=='publish') && ($item_datas['quantity']>0) && $soldout=='0') {
									if ($userid!='') {
									?>
									<a onclick="cart_show();" class="col-xs-12 col-sm-4  btn primary-color-border-btn prod-detail-btn bold-font"><?php echo __d('user','ADD TO CART'); ?></a>
									<?php }
									else { ?>
									<a href="<?php echo $baseurl.'login/';?>" class="col-xs-12 col-sm-4  btn primary-color-border-btn prod-detail-btn bold-font"><?php echo __d('user','ADD TO CART'); ?></a>
									<?php } ?>
									<?php
									/*if ($item_datas['cod']=='yes')
									{*/
										if ($userid!='') { ?>
											<a onclick="return buynow_show();" class="col-xs-12 col-sm-4 btn primary-color-bg prod-detail-btn bold-font"><?php echo __d('user','BUY NOW'); ?></a>
									<?php }
										else
										{ ?>
											<a href="<?php echo $baseurl.'login/';?>" class="col-xs-12 col-sm-4 btn primary-color-bg prod-detail-btn bold-font"><?php echo __d('user','BUY NOW');?></a>
										<?php
										}
									/*}*/
									}
									else{ ?>

									<?php }
								}
								?>
								<!--Values-->
								<input type="hidden" id="loggeduserid" value="<?php if($userid!="" && $userid!='0') { echo $userid;} else { echo '0'; } ?>" />
								<input type="hidden" value="<?php echo $cntry_code; ?>" id="shipping_method_id">
								<input type="hidden" value="<?php echo $item_datas['id']; ?>" id="listing_id">
								<input type="hidden" value="<?php echo $item_datas['user_id']; ?>" id="itemuserid" >
								<?php
								if($item_datas['quantity']>0)
								{
									?>
								<input id="itm_id" type="hidden" value="<?php echo $item_datas['id'];?>">
								<a href="javascript:void(0);" onclick="creategroupgift();" class="col-xs-12 col-sm-4  btn primary-color-border-btn prod-detail-btn bold-font">
									<?php echo __d('user','CREATE GIFT');?></a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			  </div>
			  <div class="prod-desc-cnt col-xs-12 col-lg-12">
				<div class="col-xs-12 col-sm-12 no-hor-padding">
					<div class="bold-font desc-heading"><?php echo __d('user','Description');?>:</div>
					<a href="javascript:void(0);" class="report pull-right reportitem">
					<?php
					if ($loguser['id'] != $item_datas['user']['id']){
					$reportedUsers = json_decode($item_datas['report_flag'], true);
							if (in_array($loguser['id'], $reportedUsers)){
							echo '<i class="fa fa-flag-o"></i><span id="unreportflag">'.__d('user','Undo reporting').'</span>';
							}
							else
							{
							echo '<i class="fa fa-flag-o"></i><span id="reportflag">'.__d('user','Report Inappropriate').'</span>';

					}
				}
					?>
					</a>
				</div>
				<?php
				//echo '<pre>';print_r($item_datas);
				?>
				<div class="col-xs-12 col-sm-12 no-hor-padding comment more margin-top20">
					<?php  $description=$item_datas['item_description']; 

						if(strlen($description) > 500) {
									$desc = substr($description,0,500);
									echo html_entity_decode($desc);?>
									<span class="ellipses">...&nbsp;&nbsp;</span>

								<?php	
									$desclength = strlen($description);
									$moredesc = substr($description,500,$desclength);
									?>

							
								<input type="hidden" id="moremoredesc" value="<?php echo $moredesc;?>">
									<span class="moredesc" style="display:none;"></span>

									<a class="morelink showmoredesc" href="javascript:;" onClick="showmoredesc()"><?php echo 'More Info'; ?></a>
									<a class="morelink hidemoredesc" href="javascript:;" onClick="lessmoredesc()" style="display:none;"><?php echo 'Less Info'; ?></a>
									<?php	
									} else {
									echo html_entity_decode($description); 
								}?>
				</div>
				</div>
			  </div>
			  <div class="product-page-row col-xs-12 col-sm-12 no-hor-padding margin-top20">
				<div class="selfie-carousel-cnt col-xs-12 col-sm-7 col-md-8 col-lg-8 padding-left0">
					<div class="product_align_cnt col-sm-12 no-hor-padding">
						<div class="item-slider grid col-xs-12 col-sm-12 no-hor-padding">
							<div class="section_header col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
								<h2 class="section_heading bold-font">
									<?php echo __d('user','Customer Product Selfies');?>(<?php echo count($fashionimages);?>)</h2>
							</div>
			<?php
			if(count($fashionimages)>0)
			{
			?>
		<div class="  col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding product-sec-slide heroSlider-fixed">

         <!-- Slider -->
        <div class="slider responsive" id="featured">

							<?php
							$i = 0;
							foreach($fashionimages as $fimages)
							{
							$fashionimage = $fimages['userimage'];
							$fashionuserimage = $fimages['user']['profile_image'];
							if($fashionuserimage == "")
								$fashionuserimage = "usrimg.jpg";
							$fashionusername = $fimages['user']['first_name'];

								echo '<div class="item1 box_shadow_img" style="width:220px;">';
									echo '<div class="product_cnt col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<a class="img-hover1 selfie_slider" href="javascript:void(0)" data-toggle="modal" data-target="#selfie-modal" onclick="show_fashion_image('.$fimages['id'].',\''.$fashionimage.'\');">
	<div class="bg_product">
											<img src="'.SITE_URL.'media/avatars/original/'.$fashionimage.'" class="img-responsive" />
											<input type="hidden" value="'.$fashionuserimage.'" id="fashionuserimage'.$fimages['id'].'">
											<input type="hidden" value="'.$fashionusername.'" id="fashionusername'.$fimages['id'].'">
											</div>
										</a>
									</div>
								</div>';
								$i++;
							} ?>
            </div>

        <ul class="slick-dots" style="display: block;"><li class="slick-active" aria-hidden="false"><button type="button" data-role="none">1</button></li><li aria-hidden="true"><button type="button" data-role="none">2</button></li></ul>

				<!-- control arrows -->
				<div class="prev cr-prev slick-disabled" style="display: block;">
					<span class="fa fa-angle-left" aria-hidden="true"></span>
				</div>
				<div class="next cr-next" style="display: block;">
					<span class="fa  fa-angle-right" aria-hidden="true"></span>
				</div>
				</div>
			<?php } else { ?>
<div class="text-center padding-top30 padding-bottom30">
										 <div class="outer_no_div">
										  <div class="empty-icon no_follow_icon"></div>
										 </div>
										 <h5 class="empty-selpy"><?php echo __d('user','No product selfies');?></h5>
										</div>
			<?php } ?>
						  <!-- end Bottom to top-->
						</div>
					</div>
				</div>
				<div class="sold-by-cnt col-xs-12 col-sm-5 col-md-4 col-lg-4 no-hor-padding">
					<div class="sold-info-cnt col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="col-xs-12 col-sm-12 no-hor-padding">
							<?php echo __d('user','Sold By');?></div>
						<div class="sold-by-info col-xs-12 col-sm-12 no-hor-padding margin-top15">
							<div class="sold-by-prof-pic-cnt">
								<?php
								$userprofileimage = $item_datas['shop']['shop_image'];
								if($userprofileimage=="")
									$userprofileimage = "usrimg.jpg";
								else
									$userprofileimage = $users['profile_image'];
								echo '<a href="'.SITE_URL.'stores/'.$item_datas['shop']['shop_name_url'].'">';
								echo '<div class="sold-by-prof-pic" style="background-image:url('.SITE_URL.'media/avatars/thumb70/'.$userprofileimage.');background-repeat:no-repeat;"></div>';
								echo '</a>';
								?>

							</div>
							<?php

							foreach($order_datas as $orders)
							{
								$orderdate = $orders['Orders']['orderdate'];
								$today = date('Y-m-d H:i:s');
								$review_date=date('Y-m-d', strtotime($orderdate . " +30days"));
								if($today<$review_date)
									$cnt = 1;
								else
									$cnt = 0;
							}

							if($users['seller_ratings'] == "")
								$sellerrating = "0";
							else
								$sellerrating = $users['seller_ratings'];
							?>

							<div class="sold-by-prof-detail">
								<?php
								echo '<a href="'.SITE_URL.'stores/'.$item_datas['shop']['shop_name_url'].'">';
								?>
								<div class="bold-font"><?php echo $item_datas['shop']['shop_name'];?></div>
								<?php echo '</a>'; ?>
								<div class="margin-top10"><a href="javascript:void(0);" data-toggle="modal" data-target="#seller-review-modal" class="red-label"><?php echo $sellerrating;?></a><span class="rating">
									<?php echo __d('user','Rating');?></span></div>
<?php
if($loguser['id'] && $order_count>0 && $cnt==1 && $loguser['id']!=$item_datas['user']['id'])
{
	echo '<!--<div class="margin-top10">
	<a href="" data-toggle="modal" data-target="#seller-review-modal" class="red-label">
	<span class="rating">'.__d('user','Write review').'</span></a></div>-->';
}
/*else
{
	echo '<div class="margin-top10">
	<a href="" data-toggle="modal" data-target="#seller-review-modal" class="red-label">
	<span class="rating">Write review</span></a></div>';
}*/
?>
<?php
       if($userid != $item_datas['user']['id']){
       		if($item_datas["user"]["user_level"] == 'shop' && $item_datas['shop']['seller_status']=="1"){
				foreach($storefollowcnt as $flcnt){
					$strflwrcntid[] = $flcnt['store_id'];
				}
						//echo "<pre>Roja";print_r($strflwrcntid);die;
				if($userid != $item_datas['user']['id']){
					//if(isset($strflwrcntid) && in_array($item_datas['Shop']['id'],$strflwrcntid)){
					if(in_array($item_datas['shop']['id'],$strflwrcntid)  && isset($loguser['id']) ){
						$flw = false;
					}else{
						$flw = true;
					}
					if($flw){
						if(empty($item_datas['user']['id'])){
							echo "<input type='hidden' id='gstid' value='0' />";
						}else{
							echo "<input type='hidden' id='gstid' value='".$userid."' />";
				echo '<span id="foll'.$item_datas['shop']['id'].'"><div class="user_followers_butn btn margin-top15">
				<a href="javascript:void(0);" onclick="getshopfollows('.$item_datas['shop']['id'].')">'.__d('user','Follow Store').'</a></div></span>';
						}
					}else{
			echo '<span id="unfoll'.$item_datas['shop']['id'].'"><div class="btn user_unfollowers margin-top15">
			<a href="javascript:void(0);" onclick="deleteshopfollows('.$item_datas['shop']['id'].')">'.__d('user','Unfollow Store').'</a></div></span>';
						}
					echo '<div class="margin-top15"><span id="changebtn'.$item_datas['shop']['id'].'" class="margin-top15"></span></div>';
					}
					}else{
						foreach($followcnt as $flcnt){
							$flwrcntid[] = $flcnt['user_id'];
						}
						//echo "<pre>";print_r($flwrcntid);die;
						if($userid != $item_datas['user']['id']){
							if(isset($flwrcntid) && in_array($item_datas['user']['id'],$flwrcntid)){
								$flw = false;
							}else{
								$flw = true;
							}
							if($flw){
								if(empty($item_datas['user']['id'])){
									echo "<input type='hidden' id='gstid' value='0' />";
								}else{
			echo '<span id="foll'.$item_datas['user']['id'].'"><div class="user_followers_butn btn margin-top15">
				<a href="javascript:void(0);" onclick="getfollows('.$item_datas['user']['id'].')">'.__d('user','Follow').'</a></div></span>';
								}
							}else{
			echo '<span id="unfoll'.$item_datas['user']['id'].'"><div class="btn user_unfollowers margin-top15">
			<a href="javascript:void(0);" onclick="deletefollows('.$item_datas['user']['id'].')">'.__d('user','Unfollow').'</a></div></span>';
							}
							echo '<div class="margin-top15"><span id="changebtn'.$item_datas['user']['id'].'" ></span></div>';
						}
					}
		}
		?>
							</div>
						</div>
					</div>
					<?php
					if ($item_datas['user']['id'] != $userid){
						if (count($contactsellerModel)==0){
							echo '<div class="contactsellerli">
								<a href="javascript:void(0);" onclick="show_contactseller();" class="sold-contact-seller-cnt col-xs-12 col-sm-12">
									<span class="sold-contact-seller-txt">'.__d('user','Contact Seller').'</span><i class="fa fa-angle-right pull-right"></i>
								</a>
							</div>';
						}
						else
						{
							echo '<div class="contactsellerli">
								<a href="'.SITE_URL.'viewmessage/'.$contactsellerModel['id'].'" class="sold-contact-seller-cnt col-xs-12 col-sm-12">
									<span class="sold-contact-seller-txt">'.__d('user','Contact Seller').'</span><i class="fa fa-angle-right pull-right"></i>
								</a>
							</div>';
						}
					}
					?>
				</div>
			  </div>
			  <div class="product-page-row col-xs-12 col-sm-12 no-hor-padding margin-top20">
					<div class="section_header col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
						<div class="selfies-header-heading">
							<h2 class="section_heading bold-font">
								<?php echo __d('user','Product Comments');?></h2><a href="javascript:void(0);" onclick="show_writecomment();" class="view-all-btn primary-color-txt pull-right"><?php echo __d('user','Write a comment');?></a>
						</div>
					</div>
	            		<?php if (count($commentss_item) > 2) { ?>
	            		<div class='section_header col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding' style="padding-bottom:5px;">
					<a href="javascript:void(0);" id="show_all" onclick="show_comment()" >
						<?php echo __d('user','View all');?> <?php echo(count($commentss_item));?> <?php echo __d('user','comments');?></a>
					<a href="javascript:void(0);" id="hide_all" onclick="hided_comment()" style="display:none;" > <?php echo __d('user','Hide comments');?></a>
					</div>
					<?php } ?>

<?php
if(count($commentss_item) == 0 && $userid ==''){
	echo __d('user','There is no comment yet for this product');
	}
	echo '<div id="few">';
	$cmntflag = 1;
	foreach ($commentss_item as $key => $cmnt){
		//echo "<pre>";print_r($cmnt);$cmts=strip_tags($cmnt['id']);

		if($key > 1 && $cmntflag == 1) {
			echo '</div><div id="all" class="col-lg-12 no-padding no-hor-padding" style="display:none;">';
			$cmntflag = 0;
		}
		if($cmnt['user']['profile_image']=="")
			$prof_img = "usrimg.jpg";
		else
			$prof_img = $cmnt['user']['profile_image'];
		$pattern = '/<a[^<>]*?[^<>]*?>(.*?)<\/a>/';
		$atuserPattern = '/<span[^<>]*?[^<>]*?>(.@?)<\/span>/';
		$hashPattern = '/<span[^<>]*?[^<>]*?>(.*#)<\/span>/';
		echo '<div class="comment-row col-xs-12 col-sm-12 comment delecmt_'.$cmnt['id'].'" cuid="'.$cmnt['user']['id'].'" commid="'.$cmnt['id'].'">
			<div class="sold-by-prof-pic-cnt col-xs-2 col-lg-1 padding-right0">
			<a href="'.SITE_URL.'people/'.$cmnt['user']['username_url'].'" class="url">
				<div class="sold-by-prof-pic" style="background-image:url('.SITE_URL.'media/avatars/thumb70/'.$prof_img.');background-repeat:no-repeat;">
				</div>
			</a>
			</div>
			<div class="comment-section col-xs-10 col-lg-11 padding-right0">
			<a href="'.SITE_URL.'people/'.$cmnt['user']['username_url'].'" class="url">
				<div class="bold-font txt-uppercase comment-name">'.$cmnt['user']['username'].'</div>
			</a>';

			echo '<div class="c-text form-control-2 comment-input-box no-padding col-lg-11 col-md-12" id="txt1'.$cmnt['id'].'" style="display:none;">
						 <textarea  class="comment_textarea col-lg-12 col-md-12 form-control" rows="2" id="txt1val'.$cmnt['id'].'" maxlength="180" stye="/*overflow: auto; resize: none; height: 50px; width: 540px; padding: 5px 0px 0px 10px;border:1px solid #dcdcdc;*/"   onkeyup="ajaxuserautocedit(event,this.value, \''.$cmnt['id'].'\',\'comment-autocompleteN'.$cmnt['id'].'\',\'0\');">';

			//echo $cmnt['Comment']['comments'];
			/*$withoutAnchortag = preg_replace($pattern, '$1', $cmnt['comments']);
			$withoutAtuserspan = preg_replace($atuserPattern, '$1', $withoutAnchortag);
			$withoutHashspan = preg_replace($hashPattern, '$1', $withoutAtuserspan);
			echo $withoutHashspan;*/
			echo strip_tags($cmnt['comments']);

			echo '</textarea></div>';
			echo '<div id="comment-button'.$cmnt['id'].'" class="edit-comment-button comment-button col-lg-12 col-md-12" style="display: none;">';
			echo '<button class="btn filled-btn follow-btn primary-color-bg pull-right margin-top10" onclick = "return editcmntsave('.$cmnt['id'].')" >'?><?php echo __d('user','Save comment');echo '</button>';

			echo '</div>';
			echo '<div  class="col-lg-2 col-md-12 btn-blue-right" id="editcmnterr'.$cmnt['id'].'" style="font-size:13px;color:red;font-weight:bold;display:none;float:right;">'.__d('user','Please enter comment').'</div>';

				echo '<div class="margin-top10 comment-txt" id="oritext'.$cmnt['id'].'">
					'.$cmnt['comments'].'
				</div>';
				echo '<div id="oritextvalafedit'.$cmnt['id'].'"></div>';

			echo '<div class="comment-autocomplete comment-autocompleteN'.$cmnt['id'].' col-lg-11 no-padding" style="display: none;left: 30px; top: 84px;width:87%;">';
			echo '<ul class="usersearch dropdown-menu minwidth_33 padding-bottom0 padding-top0" role="menu">';

			echo '</ul>';
			echo '</div>';
			if($cmnt['user_id']==$userid){
				echo '<div class="comment-edit-cnt c-reply col-lg-12 no-hor-padding margin-top10">
					<a class="comment-edit" href="javascript:void(0);" onclick = "show_editcmnt('.$cmnt['id'].')">'.__d('user','Edit').'</a>
					<a class="comment-delete red-txt" href="javascript:void(0);" onclick = "return deletecmnt('.$cmnt['id'].')">'.__d('user','Delete').'</a>
				</div>';
			}
			echo '</div>
		</div>';
	}
	echo '</div><div id="sa"></div>';
?>


			  </div>
		</section>
		<!--Popular products-->
	<section class="container featured">
		<div class="product_align_cnt col-sm-12 no-hor-padding">
			<div class="item-slider grid col-xs-12 col-sm-12 no-hor-padding">
				<div class="section_header col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
					<h2 class="section_heading bold-font">
						<?php echo __d('user','Popular Products');?>
					</h2>

				</div>
				<?php
if(count($popular_products)==0)
{
		echo '<div class="text-center padding-top30 padding-bottom30">
										 <div class="outer_no_div">
										  <div class="empty-icon no_products_icon"></div>
										 </div>
										 <h5>'.__d('user','No Products').'</h5>
										</div>';
}
else
{

?>
<div class="  col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding product-sec-slide heroSlider-fixed">

         <!-- Slider -->
        <div class="slider responsive" id="featured">

<?php
foreach($popular_products as $featuredkey => $featured)
{
				$item_url = base64_encode($featured['id']."_".rand(1,9999));

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

				echo '<div class="item1 box_shadow_img">
				<div class="product_cnt">
				<a class="img-hover1" href="'.SITE_URL.'listing/'.$item_url.'">
				<div class="bg_product">
					<img src="'.$itemimage.'" class="img-responsive" />
					</div>		</a>

				<div class="hover-visible">
				<span class="hover-icon-cnt like_hover" href="javascript:void(0)" onclick="itemcou('.$featured['id'].')">';


						if(count($user_liked_items)!=0 &&  in_array($featured['id'],$user_liked_items)){
							
				echo '<img src="'.SITE_URL.'images/icons/liked-w.png" id="like-icon'.$featured['id'].'" class="like-icon'.$featured['id'].'">
								<span class="like-txt'.$featured['id'].' nodisply" id="like-txt'.$featured['id'].'" >'.$setngs['like_btn_cmnt'].'</span>';}
								else
								{
				
			echo '<img src="'.SITE_URL.'images/icons/heart_icon.png" id="like-icon'.$featured['id'].'" class="like-icon'.$featured['id'].'">
												<span class="like-txt'.$featured['id'].' nodisply" id="like-txt'.$featured['id'].'" >'.$setngs['like_btn_cmnt'].'</span>';
								}










						//	echo '	<img src="'.SITE_URL.'images/icons/heart_icon.png" id="like-icon'.$featured['id'].'" class="like-icon'.$featured['id'].'">
								//<span class="like-txt'.$featured['id'].' nodisply">'.$setngs['like_btn_cmnt'].'</span>';
				echo '</span>
				<span class="hover-icon-cnt share_hover" href="javascript:void(0)" onclick="share_posts('.$featured['id'].');" data-toggle="modal" data-target="#share-modal"><img src="'.SITE_URL.'images/icons/share_icon.png"></span>
					</div>';
			


				echo '<span id="figcaption_titles'.$featured['id'].'" figcaption_title ="'.$item_title.'" style="display:none;width:0px !important;"></span>';
				echo  '<span class="figcaption" id="figcaption_title_url'.$featured['id'].'" figcaption_url ="'.$item_title_url.'" style="display:none;width:0px !important;" >'.$item_title_url.'</span>';
				echo '<span id="price_vals'.$featured['id'].'" price_val="'.$_SESSION['currency_symbol'].$user_currency_price.'" style="display:none;width:0px !important;"></span>';
				echo '<a href="'.SITE_URL."people/".$username.'"  id="user_n'.$featured['id'].'" usernameval ="'.$username.'" style="display:none;width:0px !important;"></a>';
				echo '<span id="img_'.$featured['id'].'" class="nodisply" style="display:none;width:0px !important;">'.SITE_URL.'media/items/original/'.$items_image.'</span>';
				echo '<span class="fav_count" id="fav_count'.$featured['id'].'" fav_counts ="'.$favorte_count.'" style="display:none;width:0px !important;"></span>';
			echo	'<div class="rate_section col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
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
				<div class="prev cr-prev preb slick-disabled" style="display: block;">
					<span class="fa fa-angle-left" aria-hidden="true"></span>
				</div>
				<div class="next cr-next" style="display: block;">
					<span class="fa  fa-angle-right" aria-hidden="true"></span>
				</div>
				</div>
<?php } ?>


		</div>
	</div>
	</section>

	<section class="container featured">
		<div class="product_align_cnt col-sm-12 no-hor-padding">
			<div class="item-slider grid col-xs-12 col-sm-12 no-hor-padding">
				<div class="section_header col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
					<h2 class="section_heading bold-font">
						<?php echo __d('user','More from');?> <?php echo $users['first_name'];?>
					</h2>

				</div>
				<?php
if(count($item_all)==0)
{
		echo '<div class="text-center padding-top30 padding-bottom30">
										 <div class="outer_no_div">
										  <div class="empty-icon no_products_icon"></div>
										 </div>
										 <h5>'.__d('user','No Products').'</h5>
										</div>';
}
else
{

?>
<div class="  col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding product-sec-slide heroSlider-fixed">

         <!-- Slider -->
        <div class="slider responsive1" id="featured">

<?php
foreach($item_all as $featuredkey => $featured)
{
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

				echo '<div class="item1 box_shadow_img">
				<div class="product_cnt">
				<a class="img-hover1 selfie_slider" href="'.SITE_URL.'listing/'.$item_url.'">
				<div class="bg_product">
					<img src="'.$itemimage.'" class="img-responsive" />
					</div></a>

				<div class="hover-visible">
				<span class="hover-icon-cnt like_hover" href="javascript:void(0)" onclick="itemcou('.$featured['id'].')">';
									if(count($user_liked_items)!=0 &&  in_array($featured['id'],$user_liked_items)){
							
				echo '<img src="'.SITE_URL.'images/icons/liked-w.png" id="like-icon'.$featured['id'].'" class="like-icon'.$featured['id'].'">
								<span class="like-txt'.$featured['id'].' nodisply" id="like-txt'.$featured['id'].'" >'.$setngs['like_btn_cmnt'].'</span>';}
								else
								{
				
			echo '<img src="'.SITE_URL.'images/icons/heart_icon.png" id="like-icon'.$featured['id'].'" class="like-icon'.$featured['id'].'">
												<span class="like-txt'.$featured['id'].' nodisply" id="like-txt'.$featured['id'].'" >'.$setngs['like_btn_cmnt'].'</span>';
								}

				echo '</span>
				<span class="hover-icon-cnt share_hover" href="javascript:void(0)" onclick="share_posts('.$featured['id'].');" data-toggle="modal" data-target="#share-modal"><img src="'.SITE_URL.'images/icons/share_icon.png"></span>
					</div>

				
				<div class="rate_section col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
					<div class="product_name bold-font col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
						<a class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" href="'.SITE_URL.'listing/'.$item_url.'">'.$featured['item_title'].'</a><br/>
			<span class="price">
<a class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" href="javascript:void(0);">';
				if(isset($_SESSION['currency_code'])){?>&#x200E;<?php
					echo $_SESSION['currency_symbol'].' '.$user_currency_price;}
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
				<div class="preb slick-disabled" style="display: block;">
					<span class="fa fa-angle-left" aria-hidden="true"></span>
				</div>
				<div class="nexb" style="display: block;">
					<span class="fa  fa-angle-right" aria-hidden="true"></span>
				</div>
				</div>
<?php } ?>


		</div>
	</div>
	</section>

	<!-- Add to list popup -->
		<div id="add-to-list" class="modal fade" role="dialog" tabindex="-1" >
	  <div class="modal-dialog login-popup">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-body padding_btm45_mobile padding-top30">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="share-container margin-bottom20">
				<div class="share-cnt-row">
					<h2 class="bold-font text-center">
						<?php echo __d('user','Add to your Collection');?></h2>
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
									<a href="javascript:void(0);" >
										<?php echo __d('user','Create');?></a>
								  </span>
							</div><!-- /input-group -->
							<div id="listerr" style="display:none;color:red;font-size:13px;">
								<?php echo __d('user','Enter list name');?></div>
							</div>
	</div>

						</div>
					</div>
<div class="share-cnt-row padding-top30 text-center">

					<a href="javascript:void(0);" id="btn-doneid" class="edit_popup_button btn primary-color-bg bold-font transparent_border"><?php echo __d('user','Done');?></a>

					<a href="javascript:void(0);" class="edit_popup_button btn primary-color-border-btn bold-font margin-left10 btn-unfancy"><?php echo $setngs['unlike_btn_cmnt'];?></a>

				</div>
				</div>

			</div>
		  </div>
		</div>

	  </div>
	</div>
		<!-- Add to list popup -->

						<?php
				$item_title = $item_datas['item_title'];
				$item_title_url = $item_datas['item_title_url'];
				$item_price = $item_datas['price'];
				$favorte_count = $item_datas['fav_count'];
				$username = $item_datas['user']['username'];
				$items_image = $item_datas['photos'][0]['image_name'];

				echo '<span id="figcaption_titles'.$item_datas['id'].'" figcaption_title ="'.$item_title.'" ></span>';
				echo  '<span class="figcaption" id="figcaption_title_url'.$item_datas['id'].'" figcaption_url ="'.$item_title_url.'" style="position: relative; top: 10px; left: 7px;display:none;" >'.$item_title_url.'</span>';
				echo '<span id="price_vals'.$item_datas['id'].'" price_val="'.$item_price.'" ></span>';
				echo '<a href="'.SITE_URL."people/".$username.'"  id="user_n'.$item_datas['id'].'" usernameval ="'.$username.'"></a>';
				echo '<span class="fav_count" id="fav_count'.$item_datas['Item']['id'].'" fav_counts ="'.$favorte_count.'" ></span>';
					echo '<span id="img_'.$item_datas['Item']['id'].'" class="nodisply" style="display:none;width:0px !important;">'.SITE_URL.'media/items/original/'.$items_image.'</span>';

				?>



		<!-- Write Comment Modal-->
	<div id="write-comment-modal" class="modal fade" role="dialog">
	  <div class="modal-dialog downloadapp-modal">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-body">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="write-comment-container">
				<h2 class="bold-font margin-bottom10" >
					<?php echo __d('user','WRITE A COMMENT');?><label class="primary-color-txt">(<?php echo $item_datas['item_title'];?>)</label></h2>
				<div class="comment-modal-cnt col-xs-12 col-sm-12 no-hor-padding margin-top10">
					<textarea class="form-control" rows="5" id="comment_msg" maxlength="180" onkeyup="ajaxuserautoc(event,this.value, 'comment_msg','comment-autocompleteN','0');"  autocomplete="off" placeholder="<?php echo __d('user','Comment');?> , @<?php echo __d('user','mention');?>, #<?php echo __d('user','hashtag');?>"></textarea>
<div class="comment-autocomplete comment-autocompleteN" style="top:126px;width:100%;">
	<ul class="usersearch dropdown-menu minwidth_33 padding-bottom0 padding-top0" role="menu" style="border:none;"></ul>
	</div>
					<div class="comment-modal-btn-cnt col-xs-12 col-sm-12 no-hor-padding">
						<button class="btn filled-btn follow-btn primary-color-bg pull-right margin-top10" data-dismiss="modal">
							CANCEL</button>
						<button href="javascript:void(0);" id="commentssave" onclick ="return cmntsubmit();" class="btn filled-btn follow-btn primary-color-bg pull-right margin-top10">
							<?php echo __d('user','SUBMIT');?></button>
					</div>
        <div id="cmnterr" style="font-size:13px;color:red;font-weight:bold;display:none;float:right;margin-right:34px"><?php echo __d('user','Please enter comment');?></div>
				</div>
			</div>
		  </div>
		</div>

	  </div>
	</div>
	<!-- Write comment modal -->

		<!-- Edit Comment Modal-->
	<div id="edit-comment-modal" class="modal fade" role="dialog">
	  <div class="modal-dialog downloadapp-modal">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-body">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="write-comment-container">
				<h2 class="bold-font margin-bottom10">
					<?php echo __d('user','EDIT COMMENT');?><label class="primary-color-txt">(<?php echo $item_datas['item_title'];?>)</label></h2>
				<div class="comment-modal-cnt col-xs-12 col-sm-12 no-hor-padding margin-top10">
					<textarea class="form-control" rows="5" id="txt1val" maxlength="180" onkeyup="ajaxuserautocedits(event,this.value, 'txt1val','comment-autocompleteNedit','0');"  autocomplete="off" placeholder="<?php echo __d('user','Comment , @mention, #hashtag');?>"></textarea>
<div class="comment-autocomplete comment-autocompleteNedit" style="top:126px;width:100%;">
	<ul class="usersearch dropdown-menu minwidth_33 padding-bottom0 padding-top0" role="menu"></ul>
	</div>
					<div class="comment-modal-btn-cnt col-xs-12 col-sm-12 no-hor-padding">

						<button href="javascript:void(0);" id="commentssave" onclick ="return editcmntssave();" class="btn filled-btn follow-btn primary-color-bg pull-right margin-top10"><?php echo __d('user','Save Comment');?></button>
					</div>
					<input type="hidden" id="commentid">
        <div id="editcmnterr" style="font-size:13px;color:red;font-weight:bold;display:none;float:right;margin-right:34px"><?php echo __d('user','Please enter comment');?></div>
				</div>
			</div>
		  </div>
		</div>

	  </div>
	</div>
	<!-- Edit comment modal -->

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

		<!-- Contact Seller Modal-->
	<div id="contact-seller-modal" class="modal fade" role="dialog">
	  <div class="modal-dialog downloadapp-modal">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-body">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="write-comment-container">
				<h2 class="bold-font centered-text relatived-position">
					<?php echo __d('user','CONTACT SELLER');?></h2>
				<div class="comment-modal-cnt col-xs-12 col-sm-12 no-hor-padding margin-top10">
					<div class="col-xs-12 col-sm-12 no-hor-padding bold-font margin-bottom10">
						<?php echo __d('user','Query about item');?></div>
					<div class="site-dd dropdown col-xs-12 col-sm-12 no-hor-padding margin-bottom20">
					<div class="selectdiv">
					<select id="queryaboutitem" class="dropdown-toggle">
					<option value=""><?php echo __d('user','Select a Query');?></option>
					<?php
					foreach ($csqueries as $csquery){
						echo '<option value="'.$csquery.'">'.$csquery.'</option>';
					}
					?>
					<option value="others"><?php echo __d('user','Others');?></option>
					</select>
					</div>
					</div>
					<div class="cs-subject nodisply">
						<div class="col-xs-12 col-sm-12 no-hor-padding bold-font margin-bottom10">
							<?php echo __d('user','Subject');?></div>
						<input class="form-control popup-input col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" id="subject">
					</div>
					<div class="col-xs-12 col-sm-12 no-hor-padding bold-font margin-bottom10">
						<?php echo __d('user','Message');?></div>
					<textarea class="form-control popup-input" rows="5" maxlength="500" id="message" placeholder="<?php echo __d('user','Type your message');?>"></textarea>
					<div class="comment-modal-btn-cnt col-xs-12 col-sm-12 no-hor-padding margin-top10">
						<a href="javascript:void(0);" onclick="sendmessage('buyer');" class="btn filled-btn follow-btn primary-color-bg margin-top10">
							<?php echo __d('user','SEND');?></a>
					</div>
				<div class="cs-error trn red-txt"><?php echo __d('user','Error');?></div>
				<div class="trn" id="messageErr" style="color: red;"></div>
				<div class="cs-success"><?php echo __d('user','Message Sent Successfully');?></div>
				</div>
			</div>
		  </div>
		</div>

	  </div>
	</div>

	<!-- Contact seller modal -->

		<!-- Selfie Modal-->
	<div id="selfie-modal" class="modal fade" role="dialog">
	  <div class="modal-dialog selfie-modal">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-body">
			<div class="selfie-modal-container">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<div class="selfie-modal-image col-xs-12 col-sm-12 no-hor-padding">
				<img src="" id="fashionimage"></div>
				<div class="selfie-modal-info col-xs-12 col-sm-12 margin-top30">
					<div class="selfie-modal-prof-pic" id="fashionuserimage"></div>
					<div class="selfie-modal-prof-name bold-font" id="fashionusername"></div>
				</div>
			</div>
		  </div>
		</div>

	  </div>
	</div>
	<!--- Selfie Modal --->
	<!-- Seller review Modal-->
	<div id="seller-review-modal" class="modal fade" role="dialog">
	  <div class="modal-dialog downloadapp-modal">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-body">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="write-comment-container">
				<h2 class="bold-font centered-text relatived-position">
					<?php echo __d('user','SELLER REVIEW');?></h2>
				<div class="comment-modal-cnt col-xs-12 col-sm-12 no-hor-padding margin-top10">
					<div class="col-xs-12 col-sm-12 no-hor-padding bold-font margin-bottom10">
						<?php echo __d('user','Rating');?></div>
					<br />
						<form id="ratingsForm0">
							<div class="stars margin_top5min">
								<input type="radio" name="star" class="star-1" id="star-1" />
								<label class="star-1" for="star-1" onclick="ratingClick('1');">1</label>
								<input type="radio" name="star" class="star-2" id="star-2" />
								<label class="star-2" for="star-2" onclick="ratingClick('2');">2</label>
								<input type="radio" name="star" class="star-3" id="star-3" />
								<label class="star-3" for="star-3" onclick="ratingClick('3');">3</label>
								<input type="radio" name="star" class="star-4" id="star-4" />
								<label class="star-4" for="star-4" onclick="ratingClick('4');">4</label>
								<input type="radio" name="star" class="star-5" id="star-5" />
								<label class="star-5" for="star-5" onclick="ratingClick('5');">5</label>
								<span></span>
							</div>
						</form>


						<br />
								<center><span class="current-rate">0</span> <?php echo __d('user','Out of');?> 5</center>
								<input type="hidden" id="rateval">
<div class="col-xs-12 col-sm-12 no-hor-padding bold-font margin-bottom10"><?php echo __d('user','Order Id');?></div>
<div class="site-dd dropdown col-xs-12 col-sm-12 no-hor-padding margin-bottom20">
		<?php
		echo '<select id="ordername" class="dropdown-toggle">';
		foreach($order_datas as $orders)
		{
		$orderdate = $orders['Orders']['orderdate'];
		$today = date('Y-m-d H:i:s');
		$review_date=date('Y-m-d', strtotime($orderdate . " +30days"));
		if($today<$review_date)
		{
			$orderid = $orders['orderid'];
			//$query = mysql_query("select itemname from fc_order_items where orderid='$orderid'");
			//$row = mysql_fetch_array($query);
			//echo $row['itemname'];
			echo '<option value="'.$orderid.'">'.$orders['orderid'].'</option>';
		}
		}
		echo '</select>';
		?>
</div>
					<div class="col-xs-12 col-sm-12 no-hor-padding bold-font margin-bottom10">
						<?php echo __d('user','Review Title');?> :</div>
					<textarea class="form-control" rows="5" id="review_title" maxlength="50"></textarea>

					<div class="col-xs-12 col-sm-12 no-hor-padding bold-font margin-bottom10">
						<?php echo __d('user','Your Review');?> :</div>
					<textarea class="form-control" rows="5" id="review" maxlength="250"></textarea>
					<div class="comment-modal-btn-cnt col-xs-12 col-sm-12 no-hor-padding margin-top10">
					<?php
						echo '<a href="javascript:void(0);" onclick="review('.$item_datas['user']['id'].','.$loguser['id'].')" class="btn filled-btn follow-btn primary-color-bg margin-top10">'.__d('user','SEND').'</a>';
					?>
					</div>

<?php
echo '<input type="hidden" id="uname" value="'.$loguser['username'].'">';
echo '<div style="color:red;font-size:13px;display:none;margin-right:30px;margin-top:3px;" class="trn" id="raterr"></div>';
?>

				</div>
			</div>
		  </div>
		</div>

	  </div>
	</div>

	<!-- Seller review modal -->

	<script type="text/javascript">
	$(".button").on("click", function() {

  var $button = $(this);
  var oldValue = $("#qty-counter").val();
  var quantity = $("#quantity_val").val();
  if ($button.text() == "+") {
  		if(oldValue < parseFloat(quantity))
	  var newVal = parseFloat(oldValue) + 1;

	} else {
   // Don't allow decrementing below zero
    if (oldValue > 1) {
      var newVal = parseFloat(oldValue) - 1;
    } else {
      newVal = 1;
    }
  }

  $("#qty-counter").val(newVal);

});
	</script>
<style type="text/css">
label.primary-color-txt {
	padding: 5px 0px;
    display: block;
    font-size: 15px;
    word-break: break-all;
    margin-top: 10px;
    font-weight: 500;
}
.site-dd select {
    background-color: transparent;
    border: 1px solid #dbdbdd;
    padding: 7px 10px;
    text-align: left;
    width: 100%;
}
.errcls
{
	display: none;
}
</style>

<div id="fb-root"></div>
<script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '2032233600343602'
         // status     : true,
         // xfbml      : true,
      	 // version    : 'v2.4'
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/all.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));


function showmoredesc() {
	$('.ellipses').hide();
	$('.moredesc').slideToggle();
	$('.moredesc').css('display','inline');
	$('.showmoredesc').hide();
	$('.hidemoredesc').show();
	moredesc = $("#moremoredesc").val();
	$(".moredesc").html(moredesc).text();
}

function lessmoredesc() {
	$('.ellipses').show();
	$('.moredesc').slideToggle();
	$('.moredesc').css('display','none');
	$('.showmoredesc').show();
	$('.hidemoredesc').hide();
}

</script>


	<div class="modal fade" id="cancel-order" role="dialog" tabindex="-1">
		<div class=" modal-dialog">
			<div class="modal-content">
				<div class=" login-body modal-body clearfix">
					<button class="close" type="button" data-dismiss="modal">×</button>
					<div class="signup-left-cnt col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
						<h2 class="popupheder login-header-text bold-font txt-uppercase col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding reporttxt trn">Are you want Cancel it?</h2>
					</div>
					<div class=" share-cnt-row col-md-12 padding-bottom10">
						<a class="margin-bottom10  btn txt-uppercase primary-color-bg bold-font yes" href="javascript:void(0);"><?php echo __d('user','Yes');?></a>
						<a class="cancelpop margin-bottom10 btn txt-uppercase primary-color-border-btn bold-font margin-left10 no" data-dismiss="modal" href="javascript:void(0);">
							<?php echo __d('user','No');?></a>
					</div>

				</div>
			</div>
		</div>
	</div>
	<style type="text/css">
	.price-tag{
		display: inline-block;
		margin: 0 10px;
		font-weight: bold;
		font-size:14px;
	}
	.price-strike{
		font-size:14px;
		margin: 0;
	}
	</style>