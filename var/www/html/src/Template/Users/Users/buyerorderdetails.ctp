<?php
use Cake\Routing\Router;
$baseurl = Router::url('/');
?>

 <!-- breadcrumb start -->
<div class="container-fluid margin-top10 no_hor_padding_mobile">
  <div class="container">
<div class="breadcrumb col-xs-12 col-sm-12 col-md-12 col-lg-12 margin_top_150_tab margin-bottom10">
     <div class="breadcrumb">
      <a href="<?php echo $baseurl;?>"><?php echo __d('user','Home');?></a>
      <span class="breadcrumb-divider1">/</span>
      <a href="#"><?php echo __d('user','My Orders');?></a>
     
     </div>
    </div>
     
  </div>
    </div>
    <!-- breadcrumb end -->
	<div class="container margin_top165_mobile">
		<div id="sidebar" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 no-hor-padding sidebar is-affixed" style="">
			<div class="sidebar__inner border_right_grey" style="position: relative; ">
				<div class="mini-submenu profile-menu">
			        <!--<span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>-->
			    </div>
			    <!--SETTINGS SIDEBAR PAGE-->
				<?php echo $this->element('settingssidebar'); ?>

    			<object style="display: block; position: absolute; top: 0; left: 0; height: 100%; width: 100%;overflow: hidden; pointer-events: none; z-index: -1;" type="text/html"></object>

			</div>
		</div>

		<div id="content" class="col-lg-9 col-md-9 col-sm-12 col-xs-12 no-hor-padding clearfix min-height-profile">
			<div class="cnt-top-header border_bottom_grey col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
							<h2 class="user_profile_inner_heading pro-title-head section_heading bold-font extra_text_hide fint-height col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<?php echo __d('user','My Orders');?> </h2>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-top10 fint-height margin-bottom10 text-right responsive-text-center">
							<?php
								echo '<a href="'.SITE_URL.'purchases" class="primary-color-txt"><i class="fa fa-angle-left margin-both5"></i> '.__d('user','Back to My Orders').' </a>';
							?>
							</div>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding popular-pdt-cnt margin_top0_tab margin0_mobile clearfix">

							<h3 class="section_heading font13 bold-font margin0 extra_text_hide no-hor-padding padding-bottom15"><?php echo __d('user','Order Details');?></h3>

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-top10 padding-bottom10 hor-padding border">
								<div class="inline-block"><?php echo __d('user','Status');?>: </div>
								<?php
        	if ($orderModel['status'] != '' && $orderModel['status'] != 'Paid'){
				echo '<div class="inline-block green-txt">'.__d('user',$orderModel['status']).'</div>';
				$orderStatusSelfi=$orderModel['status'];
			}elseif ($orderModel['status'] != 'Paid'){
				echo '<div class="inline-block green-txt">'.__d('user','Pending').'</div>';
				$orderStatusSelfi='Pending';
			}else {
				echo '<div class="inline-block green-txt">'.__d('user','Delivered').'</div>';
				$orderStatusSelfi='Delivered';
			}
								?>
							</div>
							

							
	<?php
	if(count($trackingModel)==0)
	{
		echo '<div class="trck-detail col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-top10 padding-bottom10 hor-padding border"><div class="inline-block">'.__d('user','Tracking Details Not yet updated').'</div></div>';
	}
	else
	{
		echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 margin-top10 padding-top10 padding-bottom10 hor-padding border grey-color-bg">
								<div class="ship-detail padding-bottom10 clearfix ">';
		echo '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 padding-top5 padding-bottom5 no-hor-padding">
			<div class="inline-block">'.__d('user','Shipment Date').': </div>
			<div class="inline-block">'.date('d,M Y',$trackingModel['shippingdate']).'</div>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 padding-top5 padding-bottom5 no-hor-padding">
			<div class="inline-block">'.__d('user','Shipping Method').': </div>
			<div class="inline-block">'.$trackingModel['couriername'].' </div>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 padding-top5 padding-bottom5 no-hor-padding">
			<div class="inline-block">'.__d('user','Tracking Id').': </div>
			<div class="inline-block bold-font red-txt">'.$trackingModel['trackingid'].'</div>
		</div>';
		echo '</div>';
		echo '<div class="addition-note padding-right10 padding-left10 padding-top10 padding-bottom10">
					<div class="margin-bottom10 bold-font extra_text_hide no-hor-padding">'.__d('user','Additional Notes').':</div>
					<p class="margin-bottom5">'.$trackingModel['notes'].'</p>
				</div>';
				echo '</div>';
	}
	?>


								

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-top10 padding-bottom10 no-hor-padding">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 border_right_grey responsive-no-border">
							<?php
									echo '<div class="order-number order-number col-lg-10 col-md-10 col-sm-10 col-xs-12 no-hor-padding">
										<div class="listorder padding-top10 padding-bottom10 clearfix">
											<span class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-hor-padding">'.__d('user','Order Number').': </span>
											<span class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-hor-padding"><b>'.$orderModel['orderid'].'</b></span>
										</div>
										<div class="listorder padding-top10 padding-bottom10 clearfix">
											<span class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-hor-padding">'.__d('user','Seller').':  </span>
											<span class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-hor-padding"><a class="primary-color-txt" href="javascript:void(0);">'.$merchantModel['first_name'].'</a></span>
										</div>
										<div class="listorder padding-top10 padding-bottom10 clearfix">
											<span class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-hor-padding">'.__d('user','Order Date').': </span>
											<span class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-hor-padding">'.date('d, M Y',$orderModel['orderdate']).'</span>
										</div>';
				if($orderModel['status'] != "Delivered")
				{}
				else
				{
					echo '<div class="listorder padding-top10 padding-bottom10 clearfix">
											<span class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-hor-padding">'.__d('user','Deliver Date').': </span>
											<span class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-hor-padding">'.date('d, M Y',$orderModel['deliver_date']).'</span>
										</div>';
				}
				if($orderModel['status'] != "Delivered") {
					      $businessday = $itemModle[0]['businessday'];
					      $business = str_split($businessday);
					      $saledate = date('Y-m-d',$orderModel['orderdate']);
                                              $deliverydate = date("Y-m-d",strtotime($saledate. ' + 2 day'));
					      if($business[1] == 'd') {
						$expected_delivery = date("d, M Y",strtotime($deliverydate. ' + '.$business[0].' day'));
						$expected_from = date("Y-m-d",strtotime($deliverydate. ' + '.$business[0].' day'));
					      } else {
						$original_business = $business[0] * 6;
						$expected_delivery = date("d, M Y",strtotime($deliverydate. ' + '.$original_business.' day'));
						$expected_from = date("Y-m-d",strtotime($deliverydate. ' + '.$original_business.' day'));
					      }
					      $expected_to = date("d, M Y",strtotime($expected_from. ' + 3 day'));
					      echo '<div class="listorder padding-top10 padding-bottom10 clearfix">
											<span class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-hor-padding">'.__d('user','Expected Delivery Date').': </span>
											<span class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-hor-padding">'.$expected_delivery.' - '.$expected_to.'</span>
										</div>';
				}
										echo '<div class="listorder padding-top10 padding-bottom10 clearfix">
											<span class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-hor-padding">'.__d('user','Amount Paid').': </span>
											<span class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-hor-padding"><span id="grandtot1"></span></span>
										</div>';
										echo '
										<div id="discount">
										<div class="listorder padding-top10 padding-bottom10 clearfix">
											<span class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-hor-padding">'.__d('user','Discount Type').': </span>
											<span class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-hor-padding"><span id="disctype1"></span></span>
										</div>
										<div class="listorder padding-top10 padding-bottom10 clearfix">';
										
										echo '<div id="discountid">
											<span class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-hor-padding">'.__d('user','Discount Id').': </span>
											
											<span class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-hor-padding"><span  id="discid1"></span></span></div>';

										echo '</div></div>';
										echo '
										<div class="listorder padding-top10 padding-bottom30 clearfix">
											<span class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-hor-padding">'.__d('user','Payment Method').':</span>
											<span class="col-lg-6 col-md-6 col-sm-6 col-xs-6 no-hor-padding">'.strtoupper($paymentmethod).'</span>
										</div>
									</div>';
							?>

								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="order-customerdetail col-lg-10 col-md-10 col-sm-10 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 no-hor-padding">
									<?php
										echo '<div class="custme-ordername">
											<h3 class="bold-font margin-top10">'.$userModel['first_name'].'</h3>
											<p class="margin-bottom5">'.$shippingModel['address1'].',</p>';
					if (!empty($shippingModel['address2'])){
        				echo '<p class="margin-bottom5">'.$shippingModel['address2'].',';
        			}
											echo '<p class="margin-bottom5">'.$shippingModel['city'].' - '.$shippingModel['zipcode'].',</p>
											<p class="margin-bottom5">'.$shippingModel['state'].',</p>
											<p class="margin-bottom5">'.$shippingModel['country'].',</p>
											<br>
											<p class="margin-bottom5">Ph : '.$shippingModel['phone'].'.</p>
										</div>';
									?>
									</div>
								</div>

							</div>

							<div class="grey-color-bg col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-top10 padding-bottom10 no-hor-padding margin-top2">
								<div class="purchaseitme clearfix">
		<?php
		$totalShipping = 0;$totalitemprice = 0;$grandtotal = 0;
		foreach ($itemModle as $item){

        				$totalprice = $item['itemprice'] + $item['shippingprice'];
        				$totalShipping += $item['shippingprice'];
        				$totalitemprice += $item['itemprice'];
					$disCouunts = $disCouunts + $item['discountAmount'];
					$tax+= $item['tax'];
					if($item['discountType']!="")
					$discountType = $item['discountType'];
					$discId = $item['discountId'];
        				$taxtotal +=($item['itemprice'] * $tax) / 100;
        				$grandtotal += $totalprice;

		if($item['itemimage']=="")
			$itemimage = "usrimg.jpg";
		else
			$itemimage = $item['itemimage'];
				echo '<!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 margin-top2 no-hor-padding">-->
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 no-hor-padding"><div class="order-name-size">
				<div class="order-name-size">
					<div class="myorder-images border">
						<div class="purchas-image-item" style="background-image:url('.$baseurl.'media/items/thumb350/'.$itemimage.');background-repeat:no-repeat;"></div>
					</div></div>
					</div></div>
					<div class="col-lg-6 col-md-5 col-sm-5 col-xs-12 no-hor-padding">
					<div class="image-detailsitem text-left responsive-text-center">
						<div class="fnt16 bold-font extra_text_hide">'.$item['itemname'].' </div>
						<!--<div class="purh-price"><span class="fnt16 bold-font">$150.00 </span> <span class="ofrc-txt text_grey_dark">
												<strike>$200.00</strike> 50% OFF</span>
											</div>-->
						<h6 class="">'.__d('user','Qty').': '.$item['itemquantity'].' &nbsp; &nbsp; ';
						if(isset($item['itemsize']) && $item['itemsize'] != "")
						echo __d('user','Size').': '.$item['itemsize'];
						echo ' </h6>
					</div></div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 no-hor-padding">
					<div class="middle-postion">
						<div class="add-self-name-btn">';		
						 if($orderStatusSelfi=='Delivered'){
						echo	'<a class="btn primary-color-border-btn txt-uppercase oder-option bold-font" href="javascript:void(0)" onclick="showselfie('.$item['itemid'].')" data-toggle="modal" data-target="#add-selfies">'.__d('user','Add selfies').'</a>';
					}
					echo '</div>
					</div>
					</div>
				</div>';
		}
		$grandtotal += $tax;
		?>


								</div>
							<!--</div>-->

							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-top10 padding-bottom10 no-hor-padding">
								<div class="order-btns padding-left5 padding-right5">
									<ul>

											<?php $orderid=$orderModel['orderid'];$orderModel['commentcount']=$orderModelcommentcount;?>
									<?php if ($orderModel['status'] == 'Delivered' && $orderModel['commentcount']>0 || $orderModel['status'] == 'Paid' && $orderModel['commentcount']>0)
									{?>
									<li class="text-center margin-top5 margin-both5 margin-bottom5">
											<a data-target="#review-seller" data-toggle="modal" href="javascript:void(0)" class="btn primary-color-bg txt-uppercase oder-option bold-font" onclick="contactseller(<?php echo $orderid;?>)">View Conversation</a>
										</li>
										<?php } 
										else if ($orderModel['status'] == 'Delivered' && $orderModel['commentcount']== 0 || $orderModel['status']=='Paid' && $orderModel['commentcount'] == 0)
	{

	}
	else { ?>

											<li class="text-center margin-top5 margin-both5 margin-bottom5">
											<a data-target="#review-seller" data-toggle="modal" href="javascript:void(0)" class="btn primary-color-bg txt-uppercase oder-option bold-font" onclick="contactseller(<?php echo $orderid;?>)">Contact seller</a>
										</li>
											<?php } ?>
									
										

										<?php if ($orderModel['status'] == 'Shipped' && $orderModel['deliverytype'] != 'pickup'){?>
										<li class="text-center margin-top5 margin-both5 margin-bottom5">
											<a data-target="#review-seller" data-toggle="modal" href="javascript:void(0)" class="btn btn btn-success txt-uppercase oder-option bold-font" onclick="markprocess(<?php echo $orderid;?>,'Delivered')">Mark Received</a>
										</li>
										<?php } ?>
								
<?php
if(count($disp_data)>0)
{
		echo '<li class="text-center margin-top5 margin-both5 margin-bottom5">
					<a class="btn red-btn txt-uppercase oder-option bold-font" href="javascript:void(0)" onclick="disputemsg('.$orderModel['orderid'].');">'.__d('user','View Disputes').'</a>
		</li>';
}
else
{
	if($orderModel['status']=="Paid" || $orderModel['status']=="Shipped" || $orderModel['status']=="Delivered" ){
	echo '<li class="text-center margin-top5 margin-both5 margin-bottom5">
					<a class="btn red-btn txt-uppercase oder-option bold-font" href="javascript:void(0)" onclick="dispute('.$orderModel['orderid'].');">'.__d('user','Create Disputes').'</a>
		</li>';
	}
}


			//if($orderModel['paymentmethod']=='COD')
			//{
				if($orderModel['status']=="" || $orderModel['status']=="Pending" || $orderModel['status']=="Processing")
				{
					echo '<li class="text-center margin-top5 margin-both5 margin-bottom5">
							<a class="white-txt btn dark-grey-bg txt-uppercase oder-option bold-font" onclick="cancel_cod_order('.$orderModel['orderid'].');" href="javascript:void(0)" data-toggle="modal" data-target="#cancel-order">'.__d('user','Cancel Order').'</a>
						</li>';
				}
			//}
				?>

				<?php 	if ($orderModel['status'] == 'Shipped' && $orderModel['trackingdetails'] > 0 && $orderModel['deliverytype'] != 'pickup'){ ?>
										<li class="text-center margin-top5 margin-both5 margin-bottom5">
											<a data-target="#review-seller" data-toggle="modal" href="javascript:void(0)" class="btn btn-warning txt-uppercase oder-option bold-font" onclick="markclaim(<?php echo $orderid;?>)">Claim</a>
										</li>
										<?php } ?>



									</ul>
								</div>
							</div>
<?php
							echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-top20 padding-bottom0 no-hor-padding">
								<div class="text-right padding-top5 padding-bottom5 total-order-price">
									<span class="text-left margin-both10">'.__d('user','Item Total').': </span>
									<span class="order-rate margin-both5"> '.$totalitemprice.' '.$currencyCode.'</span>
								</div>
								<div class="text-right padding-top5 padding-bottom5 total-order-price">
									<span class="text-left margin-both10">'.__d('user','Shipping Fee').': </span>
									<span class="order-rate margin-both5"> '.$totalShipping.' '.$currencyCode.'</span>
								</div>';
if(!empty($disCouunts) && $discountType!='Giftcard Discount' && $discountType!='User Credits'){
								echo '<div class="text-right padding-top5 padding-bottom5 total-order-price" >
									<span class="text-left margin-both10" id="disctype">'.__d('user',$discountType).' </span>
									<span class="order-rate margin-both5" id="discamount"> (-) '.$disCouunts." ".$currencyCode.'</span>
									<input type="hidden" value="0" id="discid">
								</div>';
	$grandtotal -=$disCouunts;
}
if($tax>0)
{
								echo '<div class="text-right padding-top5 padding-bottom5 total-order-price">
									<span class="text-left margin-both10">'.__d('user','Tax').': </span>
									<span class="order-rate margin-both5"> '.round($tax,2).' '.$currencyCode.'</span>
								</div>';
}
								echo '<div class="text-right padding-top10 padding-bottom10 margin-top5 margin-bottom5 grey-color-bg total-order-price">
									<span class="text-left margin-both10">'.__d('user','Order Total').':</span>
									<span class="order-rate margin-both5"><b id="grandtot">'.round($grandtotal,2).' '.$currencyCode.'</b></span>
								</div>';

							echo '</div>';
?>
						</div>
		</div>
        	<input type="hidden" id="hiddenorderid" value="<?php echo $orderModel['orderid']; ?>" />
        	<input type="hidden" id="hiddenbuyeremail" value="<?php echo $userModel['email']; ?>" />
        	<input type="hidden" id="hiddenbuyername" value="<?php echo $userModel['first_name']; ?>" />
		<object style="display: block; position: absolute; top: 0; left: 0; height: 100%; width: 100%;overflow: hidden; pointer-events: none; z-index: -1;" type="text/html"></object>

	</div>

	<script type="text/javascript">
    $(document).ready(function(){
	var grandtotal = $("#grandtot").html();
	$("#grandtot1").html(grandtotal);
	var disctype = $("#disctype").html();
	if (typeof disctype == 'undefined') {
    $("#discount").hide();
	}
	else{
	$("#disctype1").html(disctype);
	var discamount = $("#discamount").html();
	$("#discamount1").html(discamount);

	var discid = $("#discid").html();
if(discid == 0)
{
	$("#discountid").hide();
}
else
{	$("#discountid").show();
	$("#discid1").html(discid);
}
	
	
	}
	
    });
</script>

	  <div class="modal fade" id="add-selfies" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-md sucessfull-dispute">

		  <!-- Modal content-->
		  <div class="modal-content text-center">
			<div class="modal-body clearfix">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<div class="signup-left-cnt col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
					<h2 class="bold-font text-center txt-uppercase col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-top10 padding-bottom15 no-hor-padding">
						<?php echo __d('user','Add your Selfies');?></h2>
						<div class="popup-heading-border"></div>
					<div class="text-center col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-top20 padding-bottom20 no-hor-padding">
						<img id="fashionimg" class="img-responsive border center-block" src="<?php echo SITE_URL.'media/avatars/original/usrimg.jpg'; ?>" width="300">
					</div>
					<div class="share-cnt-row padding-top10 padding-bottom20 text-center">

						<a class="margin-bottom10 edit_popup_button btn txt-uppercase primary-color-bg bold-font transparent_border" href="javascript:void(0);">
		<input type="file" value="Browse..." class="file-input-area1 uploadimgbtn" id="uploadfashionfile" name="image" style="" onchange="uploadfashionfile()" accept="image/*"/>
						<?php echo __d('user','Upload');?></a>
						<a class="margin-bottom10 edit_popup_button btn txt-uppercase primary-color-border-btn bold-font margin-left10" href="javascript:void(0);" onclick="savefashionfile();"><?php echo __d('user','Save');?></a>
					</div>
					<div id="loadingimgg" class="nodisply"><img src="<?php echo SITE_URL.'images/loading.gif';?>"></div>
						<div id="imageerror" class="statuspostimg-error trn" style="color: red;"></div>
								<input id="image_computer" class="celeb_name" type="hidden" value="" name="image">
								<input type="hidden" id="itemid" value="">
				</div>
			</div>
		</div>
	  </div>
	</div>

	<div class="modal fade" id="creat-dispute" role="dialog" tabindex="-1">
		<div class="modal-dialog">

		  <!-- Modal content-->
		  <div class="pop-up modal-content">
			<div class="pop-up-cnt modal-body">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<div class="signup-left-cnt col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
						<h2 class="login-header-text bold-font txt-uppercase col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding"><?php echo __d('user','Create a Dispute');?></h2>
						<div class="email-addr padding-bottom15 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding"><?php echo __d('user','Order Id');?>:<span id="orderid"></span>
						</div>
							<form class="" method="post" action="<?php echo SITE_URL.'userdispute';?>" onsubmit="return disputesendform();">
								<div class="email-addr padding-bottom15 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
									<div class="selectdiv select-div">
										<label>
											<?php
											if(count($subject_data)>0)
											{
											$subjects = json_decode($subject_data['queries'], true);
											}
											else
											{
												$subjects = "";
											}
											?>
											<select name="data[Dispute][plm]" id="problem">
												<option value=""><?php echo __d('user','Choose One');?></option>
												<?php
												foreach($subjects as $key=>$subject){
													echo '<option value="'.substr($subject, 0, 40).'">'.substr($subject, 0, 70).'</option>';
												}
												?>
											</select>
										</label>
									</div>
								</div>
								<div id='alertName' class="email-addr padding-bottom15 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding trn" style="color:red;"></div>
								<div class="email-addr padding-bottom15 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
									<textarea class="popup-input col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" name="data[Dispute][msg]" id="message" maxlength="500"></textarea>
								</div>
								<div id='alertNamemsg' class="email-addr padding-bottom15 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding trn"  style="color:red;"></div>
								<div class="email-addr padding-bottom15 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding option-radio">
										<input id="id_radio1" value="Order" name="data[Dispute][types]" type="radio" checked="checked">
											<label class="" for="id_radio1">
												<span></span>
											<?php echo __d('user','Orders');?>
											</label>
											<input id="id_radio2" value="Item" name="data[Dispute][types]" type="radio">
											<label class="" for="id_radio2">
												<span></span>
												<?php echo __d('user','Items');?>
											</label>
									</div>
								</div>
								<div class="padding-bottom15 col-lg-12 col-md-12 col-sm-12 col-xs-12 no-hor-padding">
									<div id="itemlist" class="email-addr padding-bottom15 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
									</div>
								</div>
								<input type="hidden" id="disputeorderid" name="data[Dispute][orderid]">
								<div class="padding-bottom15 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding text-right">
									<div class="share-cnt-row create-dispute-btn ">
										<button type="submit" data-toggle="modal" data-target="#sucess-dispute" class="margin-bottom10 edit_popup_button btn txt-uppercase primary-color-bg bold-font transparent_border"><?php echo __d('user','Create Dispute');?></button>
										<button type="button" class="margin-bottom10 edit_popup_button btn white-color-bg txt-uppercase primary-color-border-btn bold-font margin-left10"><?php echo __d('user','Cancel');?></button>
									</div>

								</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	  </div>