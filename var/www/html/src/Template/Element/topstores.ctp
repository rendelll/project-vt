	<section class="container logo-slider margin-top20">
		<div class="client-slider-header col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
			<h2 class="section_heading bold-font">
				<?php echo __d('user','Top Stores');?>
			</h2>
			<a class="view-all-btn primary-color-txt pull-right" href="<?php echo SITE_URL.'allstores';?>"><?php echo __d('user','View All');?></a>
		</div>
		<div class="col-xs-12 col-sm-12 no-hor-padding margin-top20">
		<div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding product-sec-slide heroSlider-fixed" id="sliderIdName">

         <!-- Slider -->
        <div class="slider responsive4">
	<?php
	foreach ($shopsdet as $shopkey => $shopdata){
					$username_url = $shopdata['username_url'];
					$username = $shopdata['username'];
					$username_url_ori = $shopdata['username_url_ori'];
					$shopid = $shopdata['shopid'];
					$shopurl = $shopdata['shopurl'];
					$shopname = $shopdata['shopname'];
					$shopimage = $shopdata['shop_image'];
					if($shopimage == "")
					$shopimage = "usrimg.jpg";


		$shop_image = $shopdata['shop_image'];
						if($shop_image == "")
						{
							$shopimage = SITE_URL.'media/avatars/original/usrimg.jpg';
						}
						else
						{
							$shopimage = WWW_ROOT.'media/avatars/thumb70/'.$shop_image;
							/*$header_response = get_headers($itemimage, 1);*/
							if (file_exists($shopimage))
							{
								$shopimage = SITE_URL.'media/avatars/thumb70/'.$shop_image;
							}
							else
							{
								$shopimage = SITE_URL.'media/avatars/original/usrimg.jpg';
							}
						}

		echo '<div class="item">';
			echo '<div class="image-grid product_cnt"><a href="'.$baseurl.'stores/'.$shopurl.'">

				<img class="" src="'.$shopimage.'" alt="img" title="'.$shopname.'">
			</a></div>
			<!--<div class="panel-title accordion_shop bold-font " style="word-break:break-all;">'.$shopname.'</div>-->
		</div>';
	}
	?>

            </div>

        <ul class="slick-dots" style="display: block;"><li class="slick-active" aria-hidden="false"><button type="button" data-role="none">1</button></li><li aria-hidden="true"><button type="button" data-role="none">2</button></li></ul>


				<!-- control arrows -->
				<div class="prev3 preb slick-disabled" style="display: block;">
					<span class="fa fa-angle-left" aria-hidden="true"></span>
				</div>
				<div class="next3 nexb" style="display: block;">
					<span class="fa  fa-angle-right" aria-hidden="true"></span>
				</div>
				</div>
		</div>
	</section>