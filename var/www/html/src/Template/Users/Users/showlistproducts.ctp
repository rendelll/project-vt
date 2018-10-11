<?php
use Cake\Routing\Router;
$baseurl = Router::url('/');
$listid = $itemListsAll['id'];


echo '<h2 class="login-header-text bold-font txt-uppercase col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" ><span class="change_home" id="listname'.$listid.'">'.$itemListsAll['lists'].'</span>';
if($userid == $itemListsAll['user_id'])
{
echo ' <a href="javascript:void(0);" onclick="change_text('.$listid.');" id="buttonid'.$listid.'" class="change_text text buttonid">'.__d('user','Change').'</a>
<a class="nodisply" href="javascript:void(0);" onclick="save_list('.$listid.');" id="savebtn'.$listid.'">'.__d('user','Done').'</a>
<div class="red-txt trn nodisply" id="listerr'.$listid.'" style="font-size:12px;">'.__d('user','Enter your list name').'</div>';
}
echo '</h2>
';


if(count($itemdatasall)>0)
{
foreach($itemdatasall as $item)
{
		$image_name = $item[photos][0]['image_name'];
		$itemid = base64_encode($item->id."_".rand(1,9999));


					$itemprice = $item['price'];

$user_currency_price =  $currencycomponent->conversion($item['forexrate']['price'],$_SESSION['currency_value'],$itemprice);

						$item_image = $item['photos'][0]['image_name'];
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
echo '<div class="product_cnt col-lg-4 col-md-6 col-sm-6 col-xs-12 margin-bottom20 fh5co-board-img">
											<a class="img-hover1" href="'.SITE_URL.'listing/'.$itemid.'">
											<div class="bg_product">
												<img src="'.$itemimage.'" class="img-responsive" />
												</div>
											</a>
		<div class="hover-visible">';
		if($userid == $itemListsAll['user_id'])
		{
			echo '<span class="hover-icon-cnt like_hover white-txt" href="javascript:void(0)" onclick="itemcoulist('.$item['id'].')">Edit</span>';
		}
echo '<img src="'.SITE_URL.'images/icons/liked-w.png" id="like-icon'.$item['id'].'" class="like-icon'.$item['id'].'" style="display:none;">
<span class="nodisply like-txt'.$item['id'].'">'.$setngs['liked_btn_cmnt'].'</span>
			<span class="nodisply hover-icon-cnt share_hover delete_bg" href="javascript:void(0)" >Delete</span>
		</div>
											<div class="rate_section padding-left0 col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
												<div class="product_name bold-font col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding">
													<a class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" href="">'.$item['item_title'].'</a><br/>
													<span class="price"><a class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-hor-padding" href="">';
				if(isset($_SESSION['currency_code']))
					echo $_SESSION['currency_symbol'].$user_currency_price;
				else
					echo $item['forexrate']['currency_symbol'].$itemprice;
													echo '</a></span>
												</div>
											</div>
									</div>';
}
}
else
{
		echo '<div class="text-center padding-top30 padding-bottom30">
		 <div class="outer_no_div">
		  <div class="empty-icon no_products_icon"></div>
		 </div>
		 <h5>'.__d('user','No Products').'</h5>
		</div>';
}
				echo '<input type="hidden" id="likebtncnt" value="'.$setngs['like_btn_cmnt'].'" />';
				echo '<input type="hidden" id="likedbtncnt" value="'.$setngs['liked_btn_cmnt'].'" />';
	$listitemimage = $item['photos'][0]['image_name'];
	if($listitemimage == "")
		$listitemimage = "usrimg.jpg";
		echo '<input type="hidden" id="img_id'.$item['id'].'" value="'.SITE_URL.'media/items/original/'.$listitemimage.'">';
?>


