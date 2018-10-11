<?php
use Cake\Routing\Router;
$baseurl = Router::url('/');
?>
<div class="margin-top10  beforeclass">
	<div class="container">
		<section class="breadcrumb col-xs-12 col-sm-12 col-md-12 col-lg-12 margin_top_150_tab margin-md0 margin-top10 margin-bottom10">
			<div class="breadcrumb">
				<a href="<?php echo $baseurl;?>">Home</a>
				<span class="breadcrumb-divider1">/</span>
				<a href="#"><?php echo $this->request->getParam('controller');?></a>
				<span class="breadcrumb-divider1">/</span>
				<a href="#" style="text-transform:capitalize;"><?php echo strtolower($categoryName);?></a>
			</div>				
		</section>
	</div>
</div>
<div class="container">
	<?php
	if($displaybanner == "yes")
	{
		if(count($bannerdatas)>0)
		{
			echo '<div class="showad margin-bottom10">';
			echo $bannerdatas['html_source'];
			echo '</div>';
		}
	}
	?>
	<div id="sidebar" class="col-xs-12 col-sm-12 col-md-3 col-lg-3 no-hor-padding is-affixed" style="">
		<div class="sidebar__inner border_right_grey" style="position: relative; ">
			<div id="accordion1" class="panel-group margin-bottom0">
				<div id="" class="panel panel-default box_shadow0">
					<div class="panel-heading padding0">
						<a data-toggle="collapse" data-parent="#accordion1" href="#collapsezero" class="" aria-expanded="true">
							<h4 class="panel-title bold-font filter_accordion accordion_shop primary-color-bg white-txt">
								<div class="inlined-display shop_filter_menu_padding">
									<?php echo __d('user','Filter');?></div><i class="more-less glyphicon glyphicon-minus bold-font white-txt"></i>
								</h4>
							</a>
						</div>
						<div id="collapsezero" class="colla-hei panel-collapse collapse in" aria-expanded="true">
							<div class="panel-body no-hor-padding padding-top0">
								<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
									<div class="panel panel-default">
										<div class="panel-heading padding0" role="tab" id="headingOne">
											<a role="button" class="accordion_one" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
												<h4 class="panel-title accordion_shop bold-font">
													<div class="inlined-display shop_filter_menu_padding">
														<?php echo __d('user','Categories');?></div><i class="more-less glyphicon glyphicon-minus"></i>

													</h4>
												</a>
											</div>

											<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
												<div class="panel-body list_menu">
													<div class="panel-group" id="nested">
														<?php
														foreach($parent_categories as $parent_cat)
														{
															$parentcatid = $parent_cat['id'];
															echo '<div class="panel panel-default box_shadow0">
															<div class="panel-heading">
																<div class="checkbox checkbox-primary">';
																	if(count($sub_categories[$parentcatid])<=0)
																	{
																		echo '<a href="javascript:void(0);" class="shop_menu" onclick="setcategory(this);" id="'.$parentcatid.'-_-0-_-0" value="'.$parentcatid.'">

																		'.$parent_cat['category_name'].'
																	</a>
																	';
																}
																else
																{
																	echo '
																	<a data-toggle="collapse" class="shop_menu" data-parent="#nested" href="#nested-collapseOne'.$parentcatid.'">
																		<h4 class="panel-title sub_menu_panel">
																			'.$parent_cat['category_name'];
																			if(count($sub_categories[$parentcatid])>0)
																				echo '<i class="more-less glyphicon glyphicon-plus"></i>';
																			echo '</h4>
																		</a>
																		';
																	}
																	echo '</div>
																</div><!--/.panel-heading -->';
																if(count($sub_categories[$parentcatid])>0)
																{
																	echo '<div id="nested-collapseOne'.$parentcatid.'" class="panel-collapse collapse">
																	<div class="pad_left25">
																		';
																		if(count($sub_categories[$parentcatid])>0)
																		{
																			echo '<div class="checkbox checkbox-primary padding-bottom15">
																			<a href="javascript:void(0);" class="shop_menu" onclick="setcategory(this);" id="'.$parentcatid.'-_-0-_-0">
																				<h4 class="panel-title sub_menu_panel">
																					'.__d('user','View All').'
																				</h4></a></div>
																				';
																			}

																			foreach($sub_categories[$parentcatid] as $sub_cat)
																			{

																				$subcatid = $sub_cat['categoryid'];
																				$subcatname = $sub_cat['category_name'];
																				echo '
																				<div class="checkbox checkbox-primary padding-bottom15">';
																					if(count($super_categories[$parentcatid][$subcatid])<=0)
																					{
																						echo '<a href="javascript:void(0);" class="shop_menu" onclick="setcategory(this);" id="'.$parentcatid.'-_-'.$subcatid.'-_-0">'.$subcatname.'</a>';
																					}
																					else
																					{
																						echo '<a data-toggle="collapse" data-parent="#nested-collapseOne'.$parentcatid.'" href="#nested-collapseTwo'.$subcatid.'" class="shop_menu active">
																						'.$subcatname.'
																						<i class="more-less glyphicon glyphicon-plus"></i>
																					</a>';
																				}
										/*echo '<input id="'.$parentcatid.'-_-'.$subcatid.'-_-0" value="'.$parentcatid.'-'.$subcatid.'" type="checkbox" name="category">
										<label for="'.$parentcatid.'-_-'.$subcatid.'-_-0">
										<a data-toggle="collapse" data-parent="#nested-collapseOne'.$parentcatid.'" href="#nested-collapseTwo'.$subcatid.'" class="shop_menu active">
										'.$subcatname.'
										</a>
									</label>';*/
									echo '</div>
									';
									if(count($super_categories[$parentcatid][$subcatid])>0)
									{
										echo '<div id="nested-collapseTwo'.$subcatid.'" class="panel-collapse collapse">
										<div class="pad_left25">
											';

											if(count($super_categories[$parentcatid][$subcatid])>0)
											{
												echo '<div class="checkbox checkbox-primary padding-bottom15"><a href="javascript:void(0);" class="shop_menu" onclick="setcategory(this);" id="'.$parentcatid.'-_-'.$subcatid.'-_-0">'.__d('user','View All').'</a></div>';
											}

											foreach($super_categories[$parentcatid][$subcatid] as $super_cat)
											{
												$supercatid = $super_cat['categoryid'];
												$supercatname = $super_cat['category_name'];
												echo '
												<div class="checkbox checkbox-primary padding-bottom15">
													<a href="javascript:void(0);" class="shop_menu" onclick="setcategory(this);" id="'.$parentcatid.'-_-'.$subcatid.'-_-'.$supercatid.'">'.$supercatname.'</a>
												</div>
												';
											}
											echo '
										</div>
									</div>';
								}
							}
							echo '
						</div><!--/.panel-body -->
					</div><!--/.panel-collapse -->';
				}
				echo '</div><!-- /.panel -->';
			}
			?>

		</div>
	</div>
</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading padding0" role="tab" id="headingTwo">
		<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
			<h4 class="panel-title accordion_shop bold-font">
				<?php echo __d('user','By Price');?><i class="more-less glyphicon glyphicon-plus"></i>
			</h4>
		</a>
	</div>
	<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		<div class="panel-body list_menu">
			<?php
			foreach($price_val as $price)
			{
				echo '<div class="checkbox checkbox-primary padding-bottom15">
				<input id="price'.$price['id'].'" value="'.$price['from'].'-'.$price['to'].'" type="checkbox" name="price">
				<label for="price'.$price['id'].'">'.$price['from'].'-'.$price['to'].'</label>
			</div>';
		}
		?>
	</div>
</div>
</div>

<div class="panel panel-default">

	<div class="panel-heading padding0" role="tab" id="headingThree">
		<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
			<h4 class="panel-title accordion_shop bold-font">
				<div class="inlined-display shop_filter_menu_padding">
					<?php echo __d('user','By Color');?></div><i class="more-less glyphicon glyphicon-plus"></i>

				</h4>
			</a>
		</div>

		<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
			<div class="panel-body list_menu">
				<?php
				foreach($color_val as $color)
				{
					echo '<div class="checkbox checkbox-primary padding-bottom15">
					<input id="color'.$color['id'].'" value="'.$color['color_name'].'" type="checkbox" name="color">
					<label for="color'.$color['id'].'">
						<span class="color_box" style="background: '.$color['color_name'].';"></span>
						'.$color['color_name'].'</label>
					</div>';
				}
				?>
			</div>
		</div>
	</div>


</div>

</div>
</div>
</div>
</div>
<object style="display: block; position: absolute; top: 0; left: 0; height: 100%; width: 100%;overflow: hidden; pointer-events: none; z-index: -1;" type="text/html"></object>
</div>
</div>

<div id="content" class="col-xs-12 col-sm-12 col-md-9 col-lg-9 white-color-bg">
	<div class="row border_bottom_grey height_50 margin-bottom20 rowmargin0_mobile filter-ooptn">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h2 class="section_heading bold-font margin0 padding-top13 extra_text_hide"><?php echo ucfirst($categoryName);?></h2>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 border_left_grey mobile_border_bottom padding0">
			<ul class="padding-top13"><li class="dropdown"><button class="dropdown-toggle padding-left10 padding-right10 text_grey shop_sortby_button" data-toggle="dropdown" href="javascript:void(0)"><span class="pull-left sorttxt trn">
				<?php echo __d('user','Sort by : Newest');?></span>&nbsp;&nbsp;<i class="fa fa-angle-down padding-top3 padding_rght_10_mobletab pull-right"></i></button>
				<ul class="dropdown-menu popualrity_sort_menu">
					<li><a href="javascript:void(0);" onclick="setsort('new');">
						<?php echo __d('user','Newest');?>
					</a></li>
					<li><a href="javascript:void(0);" onclick="setsort('asc');">
						<?php echo __d('user','Price - Low to High');?>
					</a></li>
					<li><a href="javascript:void(0);" onclick="setsort('desc');">
						<?php echo __d('user','Price - High to Low');?>
					</a></li>
				</ul>
				<input type="hidden" id="sortvalue" value="new">
			</li>
		</ul>

	</div>
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 border_left_grey mobile_border_bottom margin_bottom_mobile20 no-hor-padding">
		<span class="second_header_search full_width full_height"><input type="text" class="form-control shop_search search-string" id ="search-string" placeholder="<?php echo __d('user','Search');?>" onkeyup="searchstring();"></span>
	</div>
</div>
<input type="hidden" value="<?php echo $currentIds; ?>" id="currentCategory">
<div class="left-padding padding-right7 row margin0_mobile stream">
	<?php
	if(isset($loguser['id']))
		echo '<input type="hidden" id="loguserid" value="'.$loguser['id'].'">';
	else
		echo '<input type="hidden" id="loguserid" value="0">';

	echo '<input type="hidden" id="likebtncnt" value="'.$setngs['like_btn_cmnt'].'" />';
	echo '<input type="hidden" id="likedbtncnt" value="'.$setngs['liked_btn_cmnt'].'" />';
	?>

	<?php
	if(count($item->toArray())!=0)
	{

		foreach ($item as $itms) 
		{
			$itm_id = $itms['id'];
			$item_title_url = $itms['item_title_url'];
			$item_title = $itms['item_title'];
			$image_name = $itms['photos'][0]['image_name'];
			$price = $itms['price'];
			$user_id = $itms['user_id'];
			$item_price = $itms['price'];
			$item_default_price = round($itms['price'] * $itms['forexrate']['price'], 2);
			$itemid = base64_encode($itm_id."_".rand(1,9999));
			$item_price = $itms['price'];
			$favorte_count = $itms['fav_count'];
			$username = $itms['user']['username'];
			$currencysymbol = $itms['forexrate']['currency_symbol'];
			$items_image = $itms['photos'][0]['image_name'];
					//$item_title = UrlfriendlyComponent::limit_char($item_title,12);

			if(isset($itms['photos'][0])){
				$image_name = $itms['photos'][0]['image_name'];
			}
			else
			{
				$image_name = "usrimg.jpg";
			}
			$shopname_url = $itms['shop']['shop_image'];
			$username_url = $itms['user']['profile_image'];
			if($shopname_url == ''){
				$shopname_url = 'usrimg.jpg';
			}
			if($username_url == ''){
				$username_url = 'usrimg.jpg';
			}
			$user_level = $itms['user']['user_level'];
			$username = $itms['user']['username'];
			$sellername=$itms['shop']['shop_name'];
			$sellername_id=$itms['shop']['user_id'];
			$sellername_url_ori=$itms['shop']['shop_name_url'];

			$username_url_ori = $itms['user']['username_url'];
			$favorte_count = $itms['fav_count'];

			$item_price = $itms['price'];
			$item_default_price = round($item_price * $itms['forexrate']['price'], 2);
			$size_options = $itms['size_options'];
			$sizeoptions = json_decode($size_options,true);
			if(!empty($sizeoptions['size']))
			{
				$item_price =  reset($sizeoptions['price']);
				$item_default_price = round(reset($sizeoptions['price']) * $itms['Forexrates']['price'], 2);
			}


			$itemprice = $itms['price'];

			$user_currency_price =  $currencycomponent->conversion($itms['forexrate']['price'],$_SESSION['currency_value'],$itemprice);

			echo '<span id="figcaption_titles'.$itms['id'].'" figcaption_title ="'.$item_title.'" ></span>';
			echo  '<span class="figcaption" id="figcaption_title_url'.$itms['id'].'" figcaption_url ="'.$item_title_url.'" style="position: relative; top: 10px; left: 7px;display:none;" >'.$item_title_url.'</span>';
			echo '<span id="price_vals'.$itms['id'].'" price_val="'.$_SESSION['currency_symbol'].$user_currency_price.'" ></span>';
			echo '<a href="'.SITE_URL."people/".$username.'"  id="user_n'.$itms['id'].'" usernameval ="'.$username.'"></a>';
			echo '<span id="img_'.$itms['id'].'" class="nodisply">'.SITE_URL.'media/items/original/'.$items_image.'</span>';
			echo '<span class="fav_count" id="fav_count'.$itms['id'].'" fav_counts ="'.$favorte_count.'" ></span>';
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




			echo '<div class="item1 box_shadow_img"><div class="product_cnt box_shadow_img col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-bottom20">
			<a class="img-hover" href="'.SITE_URL.'listing/'.$itemid.'">
				<img src="'.SITE_URL.'media/items/original/'.$image_name.'" class="img-responsive" /></a>

				<div class="hover-visible">
					<span class="hover-icon-cnt like_hover" href="javascript:void(0)" onclick="itemcou('.$itms['id'].')">';

						if(count($likeditemid)!=0 &&  in_array($itms['id'],$likeditemid)){
							/*echo 	'<i class="fa fa-heart like-icon'.$itms['id'].'" id="like-icon'.$itms['id'].'"></i>*/
							echo '<img src="'.SITE_URL.'images/icons/liked-w.png" id="like-icon'.$itms['id'].'" class="like-icon'.$itms['id'].'">
							<span class="like-txt'.$itms['id'].' nodisply" id="like-txt'.$itms['id'].'" >'.$setngs['like_btn_cmnt'].'</span>';}
							else
							{
								/*echo 	'<i class="fa fa-heart-o like-icon'.$itms['id'].'" id="like-icon'.$itms['id'].'"></i>*/
								echo '<img src="'.SITE_URL.'images/icons/heart_icon.png" id="like-icon'.$itms['id'].'" class="like-icon'.$itms['id'].'">
								<span class="like-txt'.$itms['id'].' nodisply" id="like-txt'.$itms['id'].'" >'.$setngs['like_btn_cmnt'].'</span>';
							}
							echo '</span>
							<span class="hover-icon-cnt share_hover" href="javascript:void(0)" onclick="share_posts('.$itms['id'].')" data-toggle="'.$temp.'" data-target="'.$temp1.'"><img src="'.SITE_URL.'images/icons/share_icon.png"></span>
						</div>



						<div class="rate_section padding-left0 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
							<div class="product_name bold-font col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
								<a class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" href="'.SITE_URL.'listing/'.$itemid.'">
									'.$item_title.'
								</a><br/>
								<span class="price">
									<a class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" href="javascript:void(0);">
										';
										if(isset($_SESSION['currency_code'])){?>&#x200E;<?php
											echo $_SESSION['currency_symbol'].' '.$user_currency_price;}
											else{?>&#x200E;<?php
												echo $itms['forexrate']['currency_symbol'].' '.$itemprice;
											}
											echo '
										</a></span>
									</div>
								</div>
							</div>';
						}
					}

					else
					{
						echo '<div class="text-center padding-top30 padding-bottom30"><div class="outer_no_div"><div class="empty-icon no_products_icon"></div></div><h5>'.__d('user','No Products').'</h5></div>';
					}?>

					<input type="hidden" value="<?php echo $categoryId; ?>" id="hiddencatvalue">
					<input type="hidden" value="<?php echo $currentUrl; ?>" id="currentCatPath">


				</div>
			</div>
			<object style="display: block; position: absolute; top: 0; left: 0; height: 100%; width: 100%;overflow: hidden; pointer-events: none; z-index: -1;" type="text/html"></object>
		</div>	

		<?php
		if(!empty($loguser)){
			echo "<input type='hidden' id='loguserid' value='".$loguser['id']."' />";
		}else{
			echo "<input type='hidden' id='loguserid' value='0' />";
		}
		echo '<input type="hidden" id="likebtncnt" value="'.$setngs['like_btn_cmnt'].'" />';
		echo '<input type="hidden" id="likedbtncnt" value="'.$setngs['liked_btn_cmnt'].'" />';

		?>

		<script type="text/javascript">
			var sIndex = 20, offSet = 20, isPreviousEventComplete = true, isDataAvailable = true;
			var baseurl = getBaseURL();
			$(window).scroll(function () {
	 //if ($(document).height() - 50 <= $(window).scrollTop() + $(window).height()) {
	 	if ($(window).scrollTop() >= ($(document).height() - $(window).height())*0.5) {
	 		if (isPreviousEventComplete && isDataAvailable) {

	 			isPreviousEventComplete = false;
	 			var selectedCategory = $('.sub-category').val();
	 			if (selectedCategory == '') {
	 				selectedCategory = $('#currentCatPath').val();
	 			}
	 			var priceRange;var color;var sortPrice;var categoryId;
	 			$("input[name='price']:checked").each( function () {
	 				priceRange = $(this).val();
	 			});
	 			$("input[name='color']:checked").each( function () {
	 				color = $(this).val();
	 			});
	 			$("input[name='sort']:checked").each( function () {
	 				sortPrice = $(this).val();
	 			});

	 			if( typeof (priceRange) == 'undefined'){
	 				priceRange = "";
	 			}
	 			if( typeof (color) == 'undefined'){
	 				color = "";
	 			}
	 			if( typeof (sortPrice) == 'undefined'){
	 				sortPrice = "";
	 			}

	 			categoryId = $("#currentCategory").val();
	 			if(typeof(categoryId) == 'undefined')
	 			{
	 				categoryId = $('#hiddencatvalue').val();
	 			}


	 			var searchKey = $('.search-string').val();
	 			var baseurl = getBaseURL()+"getItemByCategory";
	 			$(".LoaderImage").css("display", "block");

	 			$.ajax({
	 				type: "POST",
	 				url: baseurl+'?startIndex=' + sIndex + '&offset=' + offSet,
	 				data: {price : priceRange, color:color, category:selectedCategory, catids:categoryId, sortPrice:sortPrice, q:searchKey},
	 				beforeSend: function () {
	 					$('#infscr-loading').show();
	 				},
	 				dataType: 'html',
	 				success: function (responce) {

	 					$('#infscr-loading').hide();
	 					var out = responce.toString();
	 					if($.trim(out)=='')
	 						$(window).unbind('scroll');
      	else if (out != 'false') {//When data is not available
      		$('.stream').append(responce);
      	}else {
      		isDataAvailable = false;
      	}
      	sIndex = sIndex + offSet;
      	isPreviousEventComplete = true;
      }
  });

	 		}
	 	}
	 });


	</script>

	<!-- Share Modal -->
	<div id="share-modal" class="modal fade" role="dialog">
		<div class="modal-dialog downloadapp-modal">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="share-container margin-bottom20">
						<div class="share-cnt-row">
							<h2 class="bold-font text-center">
								<?php echo __d('user','SHARE THIS THING');?></h2>
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
	$(':checkbox').on('change',function(){
		var th = $(this), name = th.attr('name');
		if(th.is(':checked')){
			$(':checkbox[name="'  + name + '"]').not(th).prop('checked',false);
		}


		selectedCategory = $('#currentCatPath').val();
		var priceRange;var color;var sortPrice;var categoryId;
		$("input[name='price']:checked").each( function () {
			priceRange = $(this).val();
		});
		$("input[name='color']:checked").each( function () {
			color = $(this).val();
		});
		sortPrice = $("#sortvalue").val();
		if( typeof (priceRange) == 'undefined'){
			priceRange = "";
		}
		if( typeof (color) == 'undefined'){
			color = "";
		}
		if( typeof (sortPrice) == 'undefined'){
			sortPrice = "";
		}

		var searchKey = $('.search-string').val();
		var baseurl = getBaseURL()+"getItemByCategory";


		categoryId = $("#currentCategory").val();

		if(typeof(categoryId) == 'undefined')
		{
			categoryId = $('#hiddencatvalue').val();
		}

		$.ajax({
			url: baseurl,
			type: "post",
			data: {price : priceRange, color:color, category:selectedCategory, catids:categoryId, sortPrice:sortPrice, q:searchKey},
			dataType: "html",
			beforeSend: function () {
    	  //$('.stream').fadeOut("slow","linear");
    	  //$('.itemLoader').show();
	  //$('.stream').hide();
	},
	success: function(responce){
    	  //$('.itemLoader').hide();
    	  if($.trim(responce) != 'false')
    	  	$('.stream').html(responce);
    	  else
    	  	$(".stream").html('<div class="text-center padding-top30 padding-bottom30"><div class="outer_no_div"><div class="empty-icon no_products_icon"></div></div><h5 class="trn">No Products</h5></div>');
    	  var sessionlang = $("#languagecode").val();
    	  var translator = $('body').translate({t: dict});
    	  translator.lang(sessionlang);
          //$('.stream').fadeIn("slow","linear");
          sIndex = 21;
          isDataAvailable = true;
      }
  });

	});

	function setsort(sortval)
	{
		$("#sortvalue").val(sortval);
		var sessionlang = $("#languagecode").val();
		var translator = $('body').translate({t: dict});
		if(sortval == "new")
		{
			$(".sorttxt").removeAttr("data-trn-key");
			$(".sorttxt").html('Sort by: Newest');
		}
		else if(sortval == 'asc')
		{	
			$(".sorttxt").removeAttr("data-trn-key");
			$(".sorttxt").html('Sort by: Price - Low to High');
		}
		else if(sortval == 'desc')
		{
			$(".sorttxt").removeAttr("data-trn-key");
			$(".sorttxt").html('Sort by: Price - High to Low');
		}
		translator.lang(sessionlang);
		selectedCategory = $('#currentCatPath').val();
		var priceRange;var color;var sortPrice;var categoryId;
		$("input[name='price']:checked").each( function () {
			priceRange = $(this).val();
		});
		$("input[name='color']:checked").each( function () {
			color = $(this).val();
		});
		sortPrice = $("#sortvalue").val();
		if( typeof (priceRange) == 'undefined'){
			priceRange = "";
		}
		if( typeof (color) == 'undefined'){
			color = "";
		}
		if( typeof (sortPrice) == 'undefined'){
			sortPrice = "";
		}

		var searchKey = $('.search-string').val();
		var baseurl = getBaseURL()+"getItemByCategory";


		categoryId = $("#currentCategory").val();

		if(typeof(categoryId) == 'undefined')
		{
			categoryId = $('#hiddencatvalue').val();
		}

		$.ajax({
			url: baseurl,
			type: "post",
			data: {price : priceRange, color:color, category:selectedCategory, catids:categoryId, sortPrice:sortPrice, q:searchKey},
			dataType: "html",
			beforeSend: function () {
    	  //$('.stream').fadeOut("slow","linear");
    	  //$('.itemLoader').show();
	  //$('.stream').hide();
	},
	success: function(responce){
    	  //$('.itemLoader').hide();
    	  if($.trim(responce) != 'false')
    	  	$('.stream').html(responce);
    	  else
    	  	$(".stream").html('<div class="text-center padding-top30 padding-bottom30"><div class="outer_no_div"><div class="empty-icon no_products_icon"></div></div><h5 class"trn">No Products</h5></div>');
    	  var sessionlang = $("#languagecode").val();
    	  var translator = $('body').translate({t: dict});
    	  translator.lang(sessionlang);
          //$('.stream').fadeIn("slow","linear");
          sIndex = 21;
          isDataAvailable = true;
      }
  });
	}

	function setcategory(org)
	{
		$("#currentCategory").val(org.id);
		selectedCategory = $('#currentCatPath').val();
		var priceRange;var color;var sortPrice;var categoryId;
		$("input[name='price']:checked").each( function () {
			priceRange = $(this).val();
		});
		$("input[name='color']:checked").each( function () {
			color = $(this).val();
		});
		sortPrice = $("#sortvalue").val();
		if( typeof (priceRange) == 'undefined'){
			priceRange = "";
		}
		if( typeof (color) == 'undefined'){
			color = "";
		}
		if( typeof (sortPrice) == 'undefined'){
			sortPrice = "";
		}

		var searchKey = $('.search-string').val();
		var baseurl = getBaseURL()+"getItemByCategory";


		categoryId = $("#currentCategory").val();

		if(typeof(categoryId) == 'undefined')
		{
			categoryId = $('#hiddencatvalue').val();
		}

		$.ajax({
			url: baseurl,
			type: "post",
			data: {price : priceRange, color:color, category:selectedCategory, catids:categoryId, sortPrice:sortPrice, q:searchKey},
			dataType: "html",
			beforeSend: function () {
    	  //$('.stream').fadeOut("slow","linear");
    	  //$('.itemLoader').show();
	  //$('.stream').hide();
	},
	success: function(responce){
    	  //$('.itemLoader').hide();
    	  if($.trim(responce) == "")
    	  {
    	  	$('.stream').html('<div class="text-center padding-top30 padding-bottom30"><div class="outer_no_div"><div class="empty-icon no_products_icon"></div></div><h5 class="trn">No Products</h5></div>');
    	  }

    	  else if($.trim(responce) != 'false')
    	  {

    	  	$('.stream').html(responce);
    	  }
    	  else
    	  	$(".stream").html('<div class="text-center padding-top30 padding-bottom30"><div class="outer_no_div"><div class="empty-icon no_products_icon"></div></div><h5 class="trn">No Products</h5></div>');
    	  var sessionlang = $("#languagecode").val();
    	  var translator = $('body').translate({t: dict});
    	  translator.lang(sessionlang);
          //$('.stream').fadeIn("slow","linear");
          sIndex = 21;
          isDataAvailable = true;
      }
  });
	}

	function searchstring()
	{
		selectedCategory = $('#currentCatPath').val();
		var priceRange;var color;var sortPrice;var categoryId;
		$("input[name='price']:checked").each( function () {
			priceRange = $(this).val();
		});
		$("input[name='color']:checked").each( function () {
			color = $(this).val();
		});
		sortPrice = $("#sortvalue").val();
		if( typeof (priceRange) == 'undefined'){
			priceRange = "";
		}
		if( typeof (color) == 'undefined'){
			color = "";
		}
		if( typeof (sortPrice) == 'undefined'){
			sortPrice = "";
		}

		var searchKey = $('.search-string').val();
		var baseurl = getBaseURL()+"getItemByCategory";
	var spclChars = "!@#$%^&*()"; // specify special characters

	for (var i = 0; i < searchKey.length; i++)
	{
		if (spclChars.indexOf(searchKey.charAt(i)) != -1)
		{
//alert ("Special characters are not allowed.");
document.getElementById("search-string").value = "";
return false;
}
} 

categoryId = $("#currentCategory").val();

if(typeof(categoryId) == 'undefined')
{
	categoryId = $('#hiddencatvalue').val();
}

$.ajax({
	url: baseurl,
	type: "post",
	data: {price : priceRange, color:color, category:selectedCategory, catids:categoryId, sortPrice:sortPrice, q:searchKey},
	dataType: "html",
	beforeSend: function () {
    	  //$('.stream').fadeOut("slow","linear");
    	  //$('.itemLoader').show();
	  //$('.stream').hide();
	},
	success: function(responce){
    	  //$('.itemLoader').hide();
    	  if($.trim(responce) == "")
    	  {
    	  	$('.stream').html('<div class="text-center padding-top30 padding-bottom30"><div class="outer_no_div"><div class="empty-icon no_products_icon"></div></div><h5 class="trn">No Products</h5></div>');
    	  }

    	  else if($.trim(responce) != 'false')
    	  {

    	  	$('.stream').html(responce);
    	  }
    	  else
    	  	$(".stream").html('<div class="text-center padding-top30 padding-bottom30"><div class="outer_no_div"><div class="empty-icon no_products_icon"></div></div><h5 class="trn">No Products</h5></div>');
    	  var sessionlang = $("#languagecode").val();
    	  var translator = $('body').translate({t: dict});
    	  translator.lang(sessionlang);
          //$('.stream').fadeIn("slow","linear");
          sIndex = 21;
          isDataAvailable = true;
      }
  });
}
</script>

<style type="text/css">
	.checkbox input[type="checkbox"]
	{
		left: 45px;
		width: 120px;
	}
</style>