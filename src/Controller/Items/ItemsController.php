<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller\Items;
use Cake\Auth\DefaultPasswordHasher;
use App\Model\Table\UsersTable;
use App\Model\Table\ShopTable;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

class ItemsController extends AppController
{
    public $components = array('Urlfriendly');
    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.

     */

    public function initialize()
    {
      parent::initialize();
      $this->loadComponent('Captcha');
    }

    public function view($details)
    {
        $detail = base64_decode($details);
        $idval = explode('_',$detail);
        $id = $idval[0];

        $itemstable = TableRegistry::get('Items');
        $shippingaddressestable = TableRegistry::get('Shippingaddresses');
        $item_datas = $itemstable->find('all')->contain('Forexrates')->contain('Shops')->contain('Users')->contain(['Photos'])->where(['Items.id'=>$id])->first();
        $UsersTable = TableRegistry::get('Users');
        $users = $UsersTable->find('all')->contain('Shops')->where(['Users.id'=>$item_datas['user_id']])->first();
        $fashionusers = TableRegistry::get('Fashionusers');
        $fashionimages = $fashionusers->find('all')->contain('Users')->where(['itemId'=>$item_datas['id']])->where(['status'=>'Yes'])->all();
        $photosTable = TableRegistry::get('Photos');
        $photos = $photosTable->find('all')->where(['item_id'=>$item_datas['id']])->all();
        $this->set('item_datas',$item_datas);
        $this->set('users',$users);
        $this->set('fashionimages',$fashionimages);
        $this->set('photos',$photos);
            global $user_level;
            global $loguser;
            //$nme = $this->Urlfriendly->utils_makeUrlFriendly($nme);

            /*if ($this->RequestHandler->isMobile()) {
                $this->layout = "mobilelayout";
                $this->redirect('/mobile/listing/'.$id.'/'.$nme);
            }*/
        $mangagemodulestable = TableRegistry::get('Managemodules');
        $managemodules = $mangagemodulestable->find()->where(['id'=>1])->first();
        $displaybanner = $managemodules['display_banner'];
        $this->set('displaybanner',$displaybanner);
        $bannerstable = TableRegistry::get('Banners');
        $bannerdatas = $bannerstable->find()->where(['banner_type'=>'product'])->where(['status'=>'Active'])->first();
        $this->set('bannerdatas',$bannerdatas);

            $sitesettingstable = TableRegistry::get('Sitesettings');
            $setngs = $sitesettingstable->find()->where(['id'=>1])->first();

            $socialId = $setngs['social_id'];
            $socialId = json_decode($socialId,true); //print_r($socialId);die;
            //print_r($loguser);
            $userid = $loguser['id'];
            $this->loadModel('Countries');
            $this->loadModel('Shippingaddresses');
            $this->loadModel('Users');
            //$this->loadModel('Itemfav');
            //$this->loadModel('Shopfav');
            $this->loadModel('Categories');
            $this->loadModel('Itemlists');
            $this->loadModel('Photos');
            $this->loadModel('Comments');
            $this->loadModel('Itemfavs');
            $this->loadModel('Followers');
            $this->loadModel('Wantownits');
            $this->loadModel('Fashionusers');
            $this->loadModel('Contactsellers');
            $this->loadModel('Sitequeries');
            $this->loadModel('Banners');
            $this->loadModel('Storefollowers');
             $liked_items_model = $this->Itemfavs->find('all',array('conditions'=>array('user_id'=>$userid)));
            foreach ($liked_items_model as $i => $liked_items)
            {
                $user_liked_items[]=$liked_items['item_id'];

            }
              $this->set('user_liked_items',$user_liked_items);
            $sitesettings = TableRegistry::get('sitesettings');
            $setngs = $sitesettings->find()->first();
            //echo '<pre>';print_r($setngs['affiliate_enb']);die;
            if($setngs['affiliate_enb']=='enable'){
                $itemStatus['Items.status <>'] = 'draft';
            }else{
                $itemStatus['Items.status'] ='publish';
            }
            $popular_products = $itemstable->find('all')->contain('Users')->contain('Forexrates')->contain(['Photos'])->where([$itemStatus])->order(['Items.fav_count'=>'DESC'])->all();
            $this->set('popular_products',$popular_products);

            $item_all=$itemstable->find()->contain('Users')->contain('Forexrates')->contain(['Photos'])->where(['Items.user_id'=>$item_datas['user_id']])
            ->where(function ($exp, $q) {
                    return $exp->notEq('Items.status','draft');
                })->order(['Items.id DESC'])->all();
            $this->set('item_all',$item_all);


            /*$this->loadModel('Facebookcoupons');

            $shareCouponDetail = $this->Facebookcoupons->find('all',array('conditions'=>array('Facebookcoupon.item_id'=> $id , 'Facebookcoupon.user_id'=> $userid )));
            $this->set('shareCouponDetail',$shareCouponDetail);*/

            $item_datas = $itemstable->find()->contain('Photos')->contain('Forexrates')->contain('Users')->contain('Shops')->contain('Itemfavs')->contain('Shipings')->where(['Items.id'=>$id])
            ->where(function ($exp, $q) {
                    return $exp->notEq('Items.status','draft');
                        })->first();

            $this->set('fbimage',$_SESSION['media_url']."media/items/thumb350/".$item_datas['photos'][0]['image_name']);
            $itemid = base64_encode($item_datas['id']."_".rand(1,9999));
            $this->set('fburl',SITE_URL."listing/".$itemid);
            $this->set('fbid',$socialId['FB_ID']); //echo FB_ID;die;
            $this->set('fbtitle',$item_datas['item_title']);
            $this->set('fbdescription',strip_tags($item_datas['item_description']));
            $this->set('fbtype',"product");
            $bannerstable = TableRegistry::get('Banners');
            $banner_datas = $bannerstable->find()->where(['banner_type'=>'product'])->first();
            $this->set('banner_datas',$banner_datas);

            $sitequeriestable = TableRegistry::get('Sitequeries');
            $sitequeriesModel = $sitequeriestable->find()->where(['type'=>'contact_seller'])->first();

            $csqueries = json_decode($sitequeriesModel['queries'], true);


            $followcnt = $this->Followers->followcnt($userid);
            if(!empty($followcnt)){
                foreach($followcnt as $flcnt){
                    $flwngusrids[] = $flcnt['user_id'];
                }
            }
            $this->set('followcnt',$followcnt);
            //echo "<pre>";print_r($followcnt); die;
            $storefollowcnt = $this->Storefollowers->followcnt($userid);
            if(!empty($storefollowcnt)){
                foreach($storefollowcnt as $flcnt){
                    $storeflwngusrids[] = $flcnt['store_id'];
                }
            }
            $this->set('storefollowcnt',$storefollowcnt);

            $prnt_cat_data = $this->Categories->find('all',array('recursive'=>'-1','conditions'=>array('category_parent'=>0,'category_sub_parent'=>0)));

            $itemliststable = TableRegistry::get('Itemlists');
            $items_list_data = $itemliststable->find()->where(['user_id'=>$userid])->where(['user_create_list'=>'1'])->all();

            $contactsellerstable = TableRegistry::get('Contactsellers');
            $contactsellerModel = $contactsellerstable->find()->where(['itemid'=>$id])->where(['buyerid'=>$userid])->first();

            if(empty($id)){
                $this->Flash->error(__d('user','Url is not valid'));
                $this->redirect('/');
            }


            if(empty($item_datas)){
                $this->Flash->error(__d('user','The item you are searching was not found.'));
                $this->redirect('/');
            }

            $categoryID = $item_datas['category_id'];

            $moreFromCategory = $this->Items->find('all',array('conditions'=>array('Item.category_id'=>$categoryID,'Item.status'=>'publish','Item.id <>'=>$id),'order' => 'rand()','limit'=>3));

            $wantOwnModel = $this->Wantownits->find('all',array('conditions'=>array('userid'=>$userid,'itemid'=>$id,'type'=>'want')));
            $wantOwnModel = count($wantOwnModel);
            $wantIt = 0;
            if ($wantOwnModel > 0){
                $wantIt = 1;
            }
            $ownIt = 0;
            $wantOwnModel = $this->Wantownits->find('all',array('conditions'=>array('userid'=>$userid,'itemid'=>$id,'type'=>'own')));
            $wantOwnModel = count($wantOwnModel);
            if ($wantOwnModel > 0){
                $ownIt = 1;
            }
            $this->set('wantIt',$wantIt);
            $this->set('ownIt',$ownIt);

            $current_page_userid = $item_datas['user']['id'];


            if(isset($userid)){
                $usershipping = $UsersTable->find()->where(['id'=>$userid])->first();
                $usershippingid = $usershipping['defaultshipping'];

                $cntry_code = $shippingaddressestable->find()->where(['shippingid'=>$usershippingid])->first();
                $cntry_code = $cntry_code['countrycode'];
            }else{
                $cntry_code = '';
                $usershipping = '';
            }
            $countriestable = TableRegistry::get('Countries');
            $cntry_datas = $countriestable->find()->all();
            //foreach($cntry_datas as $cntry){
            //$cntryname[$cntry['Country']['id']] = $cntry['Country']['country'];
            //$cntryid[$cntry['Country']['code']] = $cntry['Country']['id'];
            //}

            //$itemfavs = $this->Itemfav->find('count',array('conditions'=>array('item_id'=>$id,'user_id'=>$loguser[0]['User']['id'])));
            //$shopfavs = $this->Shopfav->find('count',array('conditions'=>array('shop_id'=>$item_datas[0]['Shop']['id'],'user_id'=>$loguser[0]['User']['id'])));

            $commentstable = TableRegistry::get('Comments');
            $commentss_item = $commentstable->find()->contain('Users')->contain('Items')->where(['Comments.item_id'=>$id])->order(['Comments.id DESC'])->group(['Comments.id'])->all();
            //echo "<pre>";print_r($commentss_item);die;


            $itemfavs = $this->Itemfavs->find('all',array('conditions'=>array('item_id'=>$id)));
         
            //$shopfavs = $this->Shopfav->find('count',array('conditions'=>array('shop_id'=>$item_datas[0]['Shop']['id'],'user_id'=>$loguser[0]['User']['id'])));



            foreach ($itemfavs as $i => $row)
            {
                $itemusr[]=$row['user_id'];

            }
            $userlevels = array('god','moderator');
            if(!empty($itemusr))
            {
                $people_details =  $UsersTable->find('all')->contain('Itemfavs')->where(['Users.id IN'=>$itemusr])->where(['user_level NOT IN'=>$userlevels])->where(function ($exp, $q) {
                            return $exp->notEq('activation','0');
                        })->order(['Users.id DESC'])->all();
            }
            else
            {
                $people_details = "";
            }

            foreach($people_details as $ppl_dtl){
                $user_id = $ppl_dtl['User']['id'];
                $ppl_dtda = array();
                foreach($ppl_dtl['itemfavs'] as $favkey => $ppl_dt){
                    $ppl_dtda[] = $ppl_dt['item_id'];
                }
                $pho_datas = $itemstable->find()->contain('Photos')->contain('Itemfavs')->where(['Items.id IN'=>$ppl_dtda])->order(['Items.id DESC'])->all();
                //echo "<pre>";print_r($pho_datas); die;

                foreach($pho_datas as $key=>$ppl_dt1){
                    $itemIdses= $ppl_dt1['id'];
                    $itemnames = $ppl_dt1['item_title'];
                    $itemnamesUrl = $ppl_dt1['item_title_url'];
                    $photimgName = $ppl_dt1['photos'][0]['image_name'];

                    $favitemcount = $ppl_dt1['fav_count'];
                    $itemfavdata = $ppl_dt1['itemfavs'];

                    if ($key < 8){
                        $allitemdatta[$user_id][$key]['Itemidd'] = $itemIdses;
                        $allitemdatta[$user_id][$key]['item_title'] = $itemnames;
                        $allitemdatta[$user_id][$key]['item_title_url'] = $itemnamesUrl;
                        $allitemdatta[$user_id][$key]['image_name'] = $photimgName;

                        //$allitemdatta[$user_id][$key]['fav_count'] = $favitemcount;
                        //$allitemdatta[$user_id][$key]['Itemfav'] = $itemfavdata;

                        //$alldatta = $ppl_dt1[$user_id][$key][$itemIdses];
                    }else {
                        break;
                    }

                }
            }

            $possibleCountry = array();
            foreach ($item_datas['shipings'] as $shipping){
                $possibleCountry[] = $shipping['country_id'];
            }

            //echo "<pre>";print_r($allitemdatta);die;
            //$FashionuserDet =  $this->Fashionuser->find('all',array('conditions'=>array('Fashionuser.itemId'=>$id,'Fashionuser.status'=>'Yes'),'order'=>array('Fashionuser.id'=>'desc')));
            //echo "<pre>";print_r($FashionuserDet);die;
            $FashionuserDet =  $this->Fashionusers->find('all',array('conditions'=>array('Fashionuser.itemId'=>$id,'Fashionuser.status'=>'Yes'),'limit'=>3,'order'=>array('Fashionuser.id'=>'desc')));
            $this->set('FashionuserDet',$FashionuserDet);


            /****** Rating ***********/
            $this->loadModel('Reviews');
            $this->loadModel('Orders');
            $usrid = $loguser['id'];
            $sellerid = $item_datas["user"]["id"];
            $rateval_data = $this->Reviews->find('all',array('conditions'=>array('sellerid'=>$sellerid)));
            $count = count($rateval_data);
            foreach($rateval_data as $ratevaldata)
            {
                $rateval_total +=$ratevaldata['ratings'];
            }
            $orderstable = TableRegistry::get('Orders');
            $order_datas = $this->Orders->find('all',array('conditions'=>array('Orders.userid'=>$usrid,'Orders.merchant_id'=>$sellerid,'Orders.reviews !=' => '1')));
            //print_r($order_datas);
            $order_count = count($order_datas);
            $query = $orderstable->find();
            $order_date = $orderstable->find('all')->where(['Orders.userid'=>$usrid])->where(['Orders.merchant_id'=>$sellerid])->select(['maxorderdate'=>$query->func()->max('orderdate')])->first();
            $rateval_data = $this->Reviews->find('all',array('conditions'=>array('sellerid'=>$sellerid)));
            $average_rate = $rateval_total/$count;
            $average_rate = floor($average_rate * 2) / 2;

            $this->set('rateval_data',$rateval_data);
            $this->set('average_rate',$average_rate);
            $this->set('review_count',$count);
            $this->set('order_count',$order_count);
            $this->set('order_datas',$order_datas);
            $this->set('order_date',$order_date['maxorderdate']);
            /****** Rating ***********/

            $this->set('allitemdatta',$allitemdatta);
            $this->set('people_details',$people_details);


            //echo "<pre>";print_r($item_datas[0]);die;
            // echo "<pre>";print_r($FashionuserDet);die;
            $this->set('item_all',$item_all);
            $this->set('contry_datas',$cntry_datas);
            $this->set('item_datas',$item_datas);
            $this->set('moreFromCategory',$moreFromCategory);
            //$this->set('cntryname',$commentss_item);
            $this->set('loguser',$loguser);
            $this->set('userid',$userid);
            //$this->set('itemfavs',$itemfavs);
            //$this->set('shopfavs',$shopfavs);
            $this->set('cntry_code',$cntry_code);
            //$this->set('cntryid',$cntryid);
            $this->set('commentss_item',$commentss_item);
            $this->set('contactsellerModel',$contactsellerModel);

            $this->set('usershipping',$usershipping);
            $this->set('possibleCountry',$possibleCountry);
            $this->set('prnt_cat_data',$prnt_cat_data);
            $this->set('items_list_data',$items_list_data);
            $this->set('roundProf',$siteChanges['profile_image_view']);
            $this->set('setngs',$setngs);
            $this->set('csqueries',$csqueries);

            $lat2 = $item_datas['shop']['shop_latitude'];
            $lon2 = $item_datas['shop']['shop_longitude'];
            $lat1= $_SESSION['cur_lat'];
            $lon1 = $_SESSION['cur_lon'];

            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $distance =  $miles * 1.609344;
            $this->set('distance',$distance);
                //echo $distance; die;
            // Top Store
            $shopstable = TableRegistry::get('Shops');
            $shopsdet = $shopstable->find('all')->contain('Users')
            ->where(['Users.user_level'=>'shop'])
            ->where(['item_count >' => '0'])
            ->where(['seller_status'=>'1'])
            ->where(['store_enable'=>'enable'])
            ->where(function ($exp, $q) {
                        return $exp->notEq('Shops.paypal_id','')
                        ->notEq('Shops.user_id','$userid');
                    })->order(['item_count DESC','Shops.follow_count DESC'])->limit('3')->all();



            $topshoparr = array();
            $skey = 0;
            foreach ($shopsdet as $shopdata){
                $topshoparr[$skey]['username_url'] = $shopdata['user']['profile_image'];
                $topshoparr[$skey]['username'] = $shopdata['user']['username'];
                $topshoparr[$skey]['username_url_ori'] = $shopdata['user']['username_url'];
                $topshoparr[$skey]['item_count'] = $shopdata['item_count'];
                $topshoparr[$skey]['shopid'] = $shopdata['user_id'];
                $topshoparr[$skey]['shopurl'] = $shopdata['shop_name_url'];
                $topshoparr[$skey]['shopname'] = $shopdata['shop_name'];
                $topshoparr[$skey]['shop_image'] = $shopdata['shop_image'];



                $userid = $shopdata['user']['id'];
                $topshoparr[$skey]['itemModel'] = $itemstable->find('all')->where(['Items.user_id'=>$userid])
                ->where(function ($exp, $q) {
                        return $exp->notEq('Items.status','draft');
                    })->order(['Items.fav_count DESC','Items.id DESC'])->limit('5')->all();

                $itemcount = $itemstable->find('all')->where(['Items.user_id'=>$userid])
                ->where(function ($exp, $q) {
                        return $exp->notEq('Items.status','draft');
                    })->order(['Items.fav_count DESC','Items.id DESC'])->all();

                $topshoparr[$skey]['item_count'] = count($itemcount);
                $this->set('itemcount',$itemcount);
                $skey += 1;
            }
            //echo "<pre>";print_r($topshoparr);die;
            $this->set('shopsdet',$topshoparr);
    }

    public function adduserlist(){
            global $loguser;
            $this->autoRender = false;
            $this->loadModel('Itemlists');
            $itemliststable = TableRegistry::get('Itemlists');
            $userid = $loguser['id'];
            $itemid = array();
            $itemid[] = $_REQUEST['itemid'];
            $newlist = $_REQUEST['newlist'];
            $item_ids = json_encode($itemid);
            $itemlistcount = $itemliststable->find()->where(['lists'=>$newlist])->where(['user_id'=>$userid])->count();


            if($itemlistcount <= 0){
                $itemlists = $itemliststable->newEntity();
                $itemlists->user_id = $userid;
                $itemlists->list_item_id = $item_ids;
                $itemlists->lists = $newlist;
                $itemlists->user_create_list = '1';
                $itemlists->created_on = date('Y-m-d H:i:s');
                $result = $itemliststable->save($itemlists);
                $newlistid = $result->id;
                echo $newlistid.'-_-'.$newlist;
            }
        }

    public function totaladduserlist(){
        global $loguser;
        $this->autoRender = false;
        $this->loadModel('Itemlists');
        $userid = $loguser['id'];
        $itemid = $_POST['itemid'];
        $allData = $_POST['alldata'];
        $params = array();
        $lists = array();
        parse_str($_POST['alldata'], $params);
        $itemliststable = TableRegistry::get('Itemlists');
        $itemstable = TableRegistry::get('Items');

        //echo "<pre>";print_r($params);die;

        $itemlistModel = $this->Itemlists->find('all',array('conditions'=>array('user_id'=>$userid)));
        foreach($itemlistModel as $itemlist){
            $listexist[] = $itemlist['lists'];
            if (!in_array($itemlist['lists'], $params['category_items'])){
                $listItems = json_decode($itemlist['list_item_id'],true);
                $listItems = array_diff($listItems, array($itemid));

                $itemlists = $itemliststable->find()->where(['id'=>$itemlist['id']])->first();
                $itemlists->list_item_id = json_encode($listItems);
                $itemliststable->save($itemlists);



            }
        }
        $userdatasall = $itemstable->find()->contain('Photos')->where(['Items.id'=>$itemid])->first();
            $notifyto = $userdatasall['user_id'];
            $userstable = TableRegistry::get('Users');
            $users = $userstable->find()->where(['id'=>$notifyto])->first();
            $notificationSettings = json_decode($users['push_notifications'], true);
                $logusername = $loguser['username'];
                $logfirstname = $loguser['first_name'];
                $logusernameurl = $loguser['username_url'];
                $itemname = $userdatasall['item_title'];
                $item_url = base64_encode($itemid."_".rand(1,9999));
                $itemurl = $userdatasall['item_title_url'];
                $liked = $setngs['liked_btn_cmnt'];
                $userImg = $loguser['profile_image'];
                if (empty($userImg)){
                    $userImg = 'usrimg.jpg';
                }
                $image['user']['image'] = $userImg;
                $image['user']['link'] = SITE_URL."people/".$logusernameurl;
                $image['item']['image'] = $userdatasall['photos'][0]['image_name'];
                $image['item']['link'] = SITE_URL."listing/".$item_url;
                $loguserimage = json_encode($image);
                $loguserlink = "<a href='".SITE_URL."people/".$logusernameurl."'>".$logfirstname."</a>";
                $productlink = "<a href='".SITE_URL."listing/".$itemid."/".$itemurl."'>".$itemname."</a>";
                $notifymsg = $loguserlink." -___-added your product in their collection -___- ".$productlink;
                $logdetails = $this->addloglive('favorite',$userid,$notifyto,$itemid,$notifymsg,NULL,$loguserimage,$itemid);


        foreach($params['category_items'] as $key=>$para){
            $itemlistcount = $itemliststable->find()->where(['lists'=>$para])->where(['user_id'=>$userid])->all();

            if(count($itemlistcount)==0){
                $item_lis[] = $itemid;
                $item_ids = json_encode($item_lis);
                $itemLists = $itemliststable->newEntity();
                $itemLists->user_id = $userid;
                $itemLists->list_item_id = $item_ids;
                $itemLists->lists = $para;
                $itemLists->created_on = date('Y-m-d H:i:s');
                $itemliststable->save($itemLists);
                $item_lis='';
            }else{
                foreach($itemlistcount as $item){
                    $lists = json_decode($item['list_item_id'],true);
                    $lists[] = $itemid;
                    $lists = array_unique($lists);
                    $item_ids = json_encode($lists);
                    $itemLists = $itemliststable->find()->where(['id'=>$item['id']])->first();
                    $itemLists->user_id = $userid;
                    $itemLists->list_item_id = $item_ids;
                    $itemLists->lists = $para;
                    $itemliststable->save($itemLists);
                    $lists='';
                }

            }
        }
    }

    public function sendmessage(){
            $this->autoRender = false;
            $this->loadModel('Users');
            $this->loadModel('Contactsellers');
            $this->loadModel('Contactsellermsgs');
            $this->loadModel('Photos');
            $this->loadModel('Userdevices');

            global $setngs;
            global $loguser;
            $itemId = $_POST['itemId'];
            $merchantId = $_POST['merchantId'];
            $buyerId = $_POST['buyerId'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $itemName = $_POST['itemName'];
            $username = $_POST['username'];
            $sellername = $_POST['sellername'];
            $sender = $_POST['sender'];
            $timenow = time();

            $contactsellerstable = TableRegistry::get('Contactsellers');
            $contactsellers = $contactsellerstable->newEntity();
            $contactsellers->itemid = $itemId;
            $contactsellers->merchantid = $merchantId;
            $contactsellers->buyerid = $buyerId;
            $contactsellers->subject = $subject;
            $contactsellers->itemname = $itemName;
            $contactsellers->buyername = $username;
            $contactsellers->sellername = $sellername;
            $contactsellers->lastsent = $sender;
            if ($sender == 'buyer'){
                $contactsellers->sellerread = 1;
                $contactsellers->buyerread = 0;
            }else{
                $contactsellers->sellerread = 0;
                $contactsellers->buyerread = 1;
            }
            $contactsellers->lastmodified = $timenow;
            $results = $contactsellerstable->save($contactsellers);

            $lastInserId = $results->id;

            $contactsellermsgstable = TableRegistry::get('Contactsellermsgs');
            $contactsellermsgs = $contactsellermsgstable->newEntity();
            $contactsellermsgs->contactsellerid = $lastInserId;
            $contactsellermsgs->message = $message;
            $contactsellermsgs->sentby = $sender;
            $contactsellermsgs->createdat = $timenow;
            $contactsellermsgstable->save($contactsellermsgs);

            $photostable = TableRegistry::get('Photos');
            $itemImage = $photostable->find()->where(['item_id'=>$itemId])->first();
            $logusername = $loguser['username'];
            $logfirstname = $loguser['first_name'];
            $logusernameurl = $loguser['username_url'];
            $itemname = $itemName;
            $itemid = base64_encode($itemId."_".rand(1,9999));
            $userImg = $loguser['profile_image'];
            if (empty($userImg)){
                $userImg = 'usrimg.jpg';
            }
            $image['user']['image'] = $userImg;
            $image['user']['link'] = SITE_URL."people/".$logusernameurl;
            $image['item']['image'] = $itemImage['image_name'];
            $image['item']['link'] = SITE_URL."listing/".$itemid;
            $loguserimage = json_encode($image);
            $loguserlink = "<a href='".SITE_URL."people/".$logusernameurl."'>".$logfirstname."</a>";
            $productlink = "<a href='".SITE_URL."listing/".$itemid."'>".$itemname."</a>";
            $notifymsg = $loguserlink." -___-sent a query on your product: -___- ".$productlink;
            $logdetails = $this->addlog('chatmessage',$buyerId,$merchantId,$lastInserId,$notifymsg,$message,$loguserimage,$itemId);


            $this->loadModel('Userdevices');
            $this->loadModel('Users');
            $logusername = $username;
            $userstable = TableRegistry::get('Users');
            $logfirstnam = $userstable->find()->where(['username'=>$logusername])->first();
            $logfirstname1 = $logfirstnam['first_name'];
            $userdevicestable = TableRegistry::get('Userdevices');
            $userddett = $userdevicestable->find()->where(['user_id'=>$merchantId])->all();
            if(count($userddett)>0)
            {
                foreach($userddett as $userdet){
                    $deviceTToken = $userdet['deviceToken'];
                    $badge = $userdet['badge'];
                    $badge +=1;

                $query = $userdevicestable->query();
                $query->update()
                    ->set(['badge' => "'$badge'"])
                    ->where(['deviceToken' => $deviceTToken])
                    ->execute();

                    if(isset($deviceTToken)){
                        $messages = $logfirstname1." sent a query on your product ".$itemName;
                        //$Users->pushnot($deviceTToken,$messages,$badge);
                    }
                }
            }
            $result[] = 'success';
            $result[] = '<a href="'.SITE_URL.'viewmessage/'.$lastInserId.'" class="sold-contact-seller-cnt col-xs-12 col-sm-12"><span class="sold-contact-seller-txt">Contact Seller</span><i class="fa fa-angle-right pull-right"></i></a>';
            echo json_encode($result);

            $userstable = TableRegistry::get('Users');
            $email_address = $userstable->find()->where(['id'=>$merchantId])->first();
            $emailaddress = $email_address['email'];
            $name = $email_address['first_name'];

        $sitesettingstable = TableRegistry::get('Sitesettings');
        $setngs = $sitesettingstable->find()->where(['id'=>1])->first();
            $email=$emailaddress;
            $aSubject=$setngs['site_name']." – ".__d('user','You have got a message');
            $aBody='';
            $template='contactseller';
            $setdata=array('name'=>$name,'email'=>$emailaddress,'username'=>$username,'message'=>$message,'access_url'=>SITE_URL.'login','setngs'=>$setngs);
            $this->sendmail($email,$aSubject,$aBody,$template,$setdata);


        if($setngs['gmail_smtp'] == 'enable'){
            $this->Email->smtpOptions = array(
                'port' => $setngs['smtp_port'],
                'timeout' => '30',
                'host' => 'ssl://smtp.gmail.com',
                'username' => $setngs['noreply_email'],
                'password' => $setngs['noreply_password']);

            $this->Email->delivery = 'smtp';
        }
        $this->Email->to = $emailaddress;
        $this->Email->subject = $setngs['site_name']." – You have got a message";
        $this->Email->from = SITE_NAME."<".$setngs['noreply_email'].">";
        $this->Email->sendAs = "html";
        $this->Email->template = 'contactseller';
        $this->set('name', $name);
        $this->set('urlname', $urlname);
        $this->set('email', $emailaddress);
        $this->set('username',$username);
        $this->set('message',$message);
        $this->set('access_url',SITE_URL."login");

        //$this->Email->send();


    }

        public function addlog($type=NULL,$userId=NULL,$notifyTo=NULL,$sourceId=NULL,$notifymsg=NULL,$message=NULL,$image=NULL,$itemid=0){
            $this->loadModel('Log');
            $this->loadModel('User');

            $userstable = TableRegistry::get('Users');
            $logstable = TableRegistry::get('Logs');
            $logs = $logstable->newEntity();
            $logs->type = $type;
            $logs->userid = $userId;
            $logs->notifyto = 0;
            if(!is_array($notifyTo))
                $logs->notifyto = $notifyTo;
            $logs->sourceid = $sourceId;

            $logs->itemid = $itemid;
            $logs->notifymessage = $notifymsg;
            $logs->message = $message;
            $logs->image = $image;
            $logs->cdate = time();

            $logstable->save($logs);
            $userdata = $userstable->find()->where(['Users.id'=>$notifyTo])->first();
            $unread_notify_cnt = $userdata->unread_notify_cnt + 1;
            $query = $userstable->query();
            $query->update()
                ->set(['unread_notify_cnt' => "'$unread_notify_cnt'"])
                ->where(['Users.id' => $notifyTo])
                ->execute();
        }

        public function addloglive($type=NULL,$userId=NULL,$notifyTo=NULL,$sourceId=NULL,$notifymsg=NULL,$message=NULL,$image=NULL,$itemid=0){
            $this->loadModel('Log');
            $this->loadModel('User');

            $userstable = TableRegistry::get('Users');
            $logstable = TableRegistry::get('Logs');
            $logs = $logstable->newEntity();
            $logs->type = $type;
            $logs->userid = $userId;
            $logs->notifyto = 0;
            if(!is_array($notifyTo))
                $logs->notifyto = $notifyTo;
            $logs->sourceid = $sourceId;

            $logs->itemid = $itemid;
            $logs->notifymessage = $notifymsg;
            $logs->message = $message;
            $logs->image = $image;
            $logs->cdate = time();

            $logstable->save($logs);
            $userstable = TableRegistry::get('Users');
            $query = $userstable->query();
            $query->update()->set($query->newExpr('unread_livefeed_cnt = unread_livefeed_cnt + 1'))->where(['id IN'=>$notifyTo])
                    ->execute();
            /*$userdata = $userstable->find()->where(['Users.id IN'=>$notifyTo])->first();
            $unread_livefeed_cnt = $userdata->unread_livefeed_cnt + 1;
            $query = $userstable->query();
            $query->update()
                ->set(['unread_livefeed_cnt' => "'$unread_livefeed_cnt'"])
                ->where(['id IN' => $notifyTo])
                ->execute();*/

        }

        /*function pushnot($deviceToken=NULL,$message=NULL,$badge=NULL){
            $userdevicestable = TableRegistry::get('Userdevices');
            $userddett = $userdevicestable->find()->where(['deviceToken'=>$deviceToken])->first();
            if($userddett['type'] == 0){
                include_once( WWW_ROOT . 'PushNotification.php' );
                //Selecting the first parameter as live or test cases if you are going to use test means use sandbox.
                if($userddett['mode'] == 1){
                    $certifcUrl =  WWW_ROOT . 'fancyclonepush.pem';
                    $push = new PushNotification("sandbox",$certifcUrl);
                }else{
                    //$certifcUrl =  WWW_ROOT . 'milymarketpush.pem';
                    $certifcUrl =  WWW_ROOT . 'fancycloneproductionPush.pem';
                    $push = new PushNotification("production",$certifcUrl);
                }
                $push->setDeviceToken($deviceToken);
                $push->setPassPhrase("");
                $push->setBadge($badge);
                $push->setMessageBody($message);
                $push->sendNotification();
            }else{
                $this->send_push_notification($deviceToken, $message);
            }
        }

        function send_push_notification($registatoin_ids, $message) {


            // Set POST variables
            $url = 'https://android.googleapis.com/gcm/send';
            $registatoin_ids = array($registatoin_ids);
            $message = array("price" => $message);
            $fields = array(
                    'registration_ids' => $registatoin_ids,
                    'data' => $message,
            );

            $headers = array(
                    //'Authorization: key=AIzaSyBWzx6q4_JYxYE1DTxLsl6VKvRsJPrKE5g',
                    'Authorization: key=AIzaSyBvoyfQYjYyswzifj9Euc27qY7bAuYpLaw',
                    'Content-Type: application/json'
            );
            //print_r($headers);
            // Open connection
            $ch = curl_init();

            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

            // Execute post
            $result = curl_exec($ch);
            if ($result === FALSE) {
                //die('Curl failed: ' . curl_error($ch));
            }

            // Close connection
            curl_close($ch);
            //echo $result;
        }*/

        public function reportitem(){
            $this->autoRender = FALSE;
            $this->loadModel('Items');
            $itemstable = TableRegistry::get('Items');

            if (isset($_GET['itemid']) && isset($_GET['userid'])){
                $itemId = $_GET['itemid'];
                $userId = $_GET['userid'];

                $itemModel = $itemstable->find()->where(['id'=>$itemId])->first();
                if (!empty($itemModel['report_flag'])){
                    $reportFlag = json_decode($itemModel['report_flag'],true);
                    /*if (count($reportFlag) == 4){
                        $this->request->data['Item']['status'] = 'draft';
                        $this->request->data['Item']['report_flag'] = '';
                        $this->request->data['Item']['id'] = $itemId;
                    }else{*/
                        $reportFlag[] = $userId;

                    $query = $itemstable->query();
                    $query->update()
                        ->set(['report_flag' => json_encode($reportFlag)])
                        ->where(['id' => $itemId])
                        ->execute();

                    //}
                }else{
                    $reportFlag[] = $userId;
                    $query = $itemstable->query();
                    $query->update()
                        ->set(['report_flag' => json_encode($reportFlag)])
                        ->where(['id' => $itemId])
                        ->execute();
                }
                echo true;
            }
        }

        public function undoreportitem(){
            $this->layout = FALSE;
            $this->autoRender = FALSE;
            $this->loadModel('Items');
            $itemstable = TableRegistry::get('Items');

            if (isset($_GET['itemid']) && isset($_GET['userid'])){
                $itemId = $_GET['itemid'];
                $userId = $_GET['userid'];

                $itemModel = $itemstable->find()->where(['id'=>$itemId])->first();
                if (count($itemModel['report_flag'])>0){
                    $reportFlag = json_decode($itemModel['report_flag'],true);
                    $newreportflag = array();
                    foreach ($reportFlag as $flag){
                        if ($flag != $userId){
                            $newreportflag[] = $flag;
                        }
                    }
                    if (!empty($newreportflag)){
                    $query = $itemstable->query();
                    $query->update()
                        ->set(['report_flag' => json_encode($newreportflag)])
                        ->where(['id' => $itemId])
                        ->execute();
                    }else{
                    $query = $itemstable->query();
                    $query->update()
                        ->set(['report_flag' => ''])
                        ->where(['id' => $itemId])
                        ->execute();
                    }
                }
                echo true;
            }
        }

    public function ajaxHashAuto(){
        $this->autoRender = false;
        $this->loadModel('Hashtags');
        $searchWord = $_POST['searchStr'];

        $hashtagModel = $this->Hashtags->find('all',array('conditions'=>array(
                'hashtag like'=>$searchWord.'%'),'order'=>'usedcount DESC'));
        $hashContent = '';
        if (!empty($hashtagModel)){
            foreach($hashtagModel as $hashtag){
                $tagName = $hashtag['hashtag'];
                $hashContent .= "<li><input type='hidden' class = 'nam'  value='".$tagName."' /><a class='username'>".$tagName."</a></li>";
                $hashcontents[] = "#".$tagName;
            }
        }else{
            $hashContent = "No Data";
        }
        $json = array();
        $json[] = $hashContent;
        echo json_encode($hashcontents);
    }

    public function ajaxUserAuto () {
        $this->autoRender = false;
        $this->loadModel('Users');
        $this->loadModel('Items');

        global $siteChanges;
        $roundProf = "";
        if ($siteChanges['profile_image_view'] == "round") {
            $roundProfile = "border-radius:50%;";
        }else{
            $roundProfile = "border-radius:0 !important;";
        }

         $searchWord = $_POST['searchStr'];
        $userContent = '';
        $userstable = TableRegistry::get('Users');
        $userDetails = $userstable->find()->where(['username LIKE' => $searchWord.'%'])
        ->where(['user_level'=>'normal'])
        ->limit('50')->all();
        if (count($userDetails) > 0) {
            $k=0;
            foreach ($userDetails as $userData) {
                $usernameurl = $userData['username_url'];
                $usernam = $userData['username'];
                $userimg = $userData['profile_image'];
                if(empty($userimg)){
                    $userimg = "usrimg.jpg";
                }else{
                    $userimg = $userimg;
                }
                $url = SITE_URL.'people/'.$usernameurl;

                /*if ($userContent == ''){
                    //onclick='getusrname($usernam);'
                    $userContent = "<li class='col-lg-12' style='padding-right:5px;'><img class='photo col-lg-2' style='".$roundProfile."' src='".$_SESSION['media_url']."media/avatars/thumb70/".$userimg."'  ><input type='hidden' class = 'nam'  value='".$usernam."' /><span class='username col-lg-10'>".$usernameurl."</span></li>";
                }else {
                    $userContent = $userContent."<li class='col-lg-12' style='padding-right:5px;'><img class='photo col-lg-2' style='".$roundProfile."' src='".$_SESSION['media_url']."media/avatars/thumb70/".$userimg."'><input type='hidden' class = 'nam'  value='".$usernam."' /><span class='username col-lg-10'>".$usernameurl."</span></li>";

                }*/
                if($usernameurl != "")
                $usercontents[] = "@".$usernameurl."";
                $k++;
            }
        } else {
            $userContent = "No Data";
        }
        $json = array();
        $json[] = $userContent;
        //echo '<pre>';print_r($usercontents);
        echo json_encode($usercontents);
    }

        function addcomments(){
            global $loguser;
            global $setngs;
            $logusername = $loguser['username'];
            //$userid = $loguser[0]['User']['id'];
            $this->autoRender=false;
            $this->loadModel('Hashtags');


            $userid = $_REQUEST['userid'];
            $itemid = $_REQUEST['itemid'];
            $commentss = $_REQUEST['commentss'];
            $usedHashtags = $_REQUEST['hashtags'];
            $mentionedUsers = $_REQUEST['atusers'];
            $oldHashtags = array();
            $hashtagstable = TableRegistry::get('Hashtags');
            $commentstable = TableRegistry::get('Comments');
            $itemstable = TableRegistry::get('Items');
            $userstable = TableRegistry::get('Users');

            if ($usedHashtags != ''){
                $hashTags = explode(',', $usedHashtags);
                $hashtagstable = TableRegistry::get('Hashtags');
                $hashtagsModel = $hashtagstable->find()->where(['hashtag IN'=>$hashTags])->all();
                if (!empty($hashtagsModel)){
                    foreach($hashtagsModel as $hashtags){
                        $id = $hashtags['id'];
                        $count = $hashtags['usedcount'] + 1;

                        $hashquery = $hashtagstable->query();
                        $hashquery->update()
                            ->set(['usedcount' => "'$count'"])
                            ->where(['id' => $id])
                            ->execute();

                        $oldHashtags[] = $hashtags['hashtag'];
                    }
                }
                foreach($hashTags as $hashtag){
                    if (!in_array($hashtag, $oldHashtags)){
                        $hasgtags = $hashtagstable->newEntity();
                        $hasgtags->hashtag = $hashtag;
                        $hasgtags->usedcount = 1;
                        $hashtagstable->save($hasgtags);
                    }
                }
            }

            $comments_datas = $commentstable->newEntity();
            $comments_datas->user_id = $userid;
            $comments_datas->item_id = $itemid;
            $comments_datas->comments = $commentss;
            $comments_datas->created_on = date("Y-m-d H:i:s");
            $results = $commentstable->save($comments_datas);
            $comment_id = $results->id;

            $userdatasall = $itemstable->find()->contain('Photos')->contain('Users')->contain('Itemfavs')->where(['Items.id'=>$itemid])->first();
            if ($mentionedUsers != ""){
                $mentionedUsers = explode(",", $mentionedUsers);
                foreach ($mentionedUsers as $musers){
                    $userModel = $userstable->find()->where(['username'=>$musers])->first();
                    $notificationSettings = json_decode($userModel['push_notifications'], true);
                    $notifyto = $userModel['id'];
                    if ($notificationSettings['somone_mentions_push'] == 1 && $userid != $notifyto){
                        $logusername = $loguser['username'];
                        $logusernameurl = $loguser['username_url'];
                        $itemname = $userdatasall['item_title'];
                        $itemurl = $userdatasall['item_title_url'];
                        $liked = $setngs['liked_btn_cmnt'];
                        $userImg = $loguser['profile_image'];
                        $item_url = base64_encode($itemid."_".rand(1,9999));
                        if (empty($userImg)){
                            $userImg = 'usrimg.jpg';
                        }
                        $image['user']['image'] = $userImg;
                        $image['user']['link'] = SITE_URL."people/".$logusernameurl;
                        if($userdatasall['photos'][0]['image_name'] != '')
                            $image['item']['image'] = $userdatasall['photos'][0]['image_name'];
                        if($itemid == 0){
                            $image['item']['link'] = 0;
                        }else {
                            $image['item']['link'] = SITE_URL."listing/".$item_url;
                        }
                        //$image['item']['link'] = SITE_URL."listing/".$itemid."/".$itemurl;
                        $loguserimage = json_encode($image);
                        $loguserlink = "<a href='".SITE_URL."people/".$logusernameurl."'>".$logusername."</a>";
                        $productlink = "<a href='".SITE_URL."listing/".$item_url."'>".$itemname."</a>";
                        $notifymsg = $loguserlink." -___-mentioned you in a comment on: -___- ".$productlink;
                        if($itemid  ==  0){
                            $productlink = "<a href='".SITE_URL."create/giftcard/'>Gift Card.</a>";
                            $notifymsg = $loguserlink." -___-mentioned you in a comment on: -___- ".$productlink;
                            $itemname = "Gift Card";
                        }
                        $logdetails = $this->addloglive('mentioned',$userid,$notifyto,$comment_id,$notifymsg,$commentss,$loguserimage,$itemid);

       $userdevicestable = TableRegistry::get('Userdevices');
$userddett = $userdevicestable->find('all')->where(['user_id'=>$notifyto])->all();

                    foreach($userddett as $userdet){
                        $deviceTToken = $userdet['deviceToken'];
                        $badge = $userdet['badge'];
                        $badge +=1;


                    $querys = $userdevicestable->query();
                    $querys->update()
                        ->set(['badge' => $badge])
                        ->where(['deviceToken' => $deviceTToken])
                        ->execute();

                        if(isset($deviceTToken)){
                            $pushMessage['type'] = 'mention_item_comment';
                            $pushMessage['user_id'] = $loguser['id'];
                            $pushMessage['item_id'] = $itemid;
                            $pushMessage['user_name'] = $loguser['username'];
                            $pushMessage['user_image'] = $userImg;
                            $user_detail = TableRegistry::get('Users')->find()->where(['id'=>$notifyto])->first();
                            I18n::locale($user_detail['languagecode']);
                            $pushMessage['message'] = __d('user',"mentioned you in a item comment");
                            $messages=json_encode($pushMessage);
                            $this->pushnot($deviceTToken,$messages,$badge);
                        }
                    }


                                /*$this->loadModel('Userdevices');
                                $userddett = $this->Userdevices->findAllByuser_id($notifyto);

                                foreach($userddett as $userddet){
                                    $deviceTToken = $userddet['deviceToken'];
                                    $badge = $userdet['badge'];
                                    $badge +=1;
                                    $this->Userdevices->updateAll(array('badge' =>"'$badge'"), array('deviceToken' => $deviceTToken));
                                    if(isset($deviceTToken)){
                                        $messages = $logusername." mentioned you in a comment on: ".$itemname;
                                        //$Users->pushnot($deviceTToken,$messages,$badge);
                                    }
                                }*/
                    }
                }
            }
            $favUsers = $userdatasall['itemfavs'];
            if (!empty($favUsers)){
                foreach ($favUsers as $fuser){
                    $userModel = $userstable->find()->where(['id'=>$fuser['user_id']])->first();
                    $notificationSettings = json_decode($userModel['push_notifications'], true);
                    $notifyto = $userdatasall['user']['id'];
                    if ($notificationSettings['somone_cmnts_push'] == 1 && $userid != $notifyto){
                        $favnotifyto[] = $userModel['id'];
                    }
                }
                if (!empty($favnotifyto)){
                    $logusername = $loguser['username'];
                    $logusernameurl = $loguser['username_url'];
                    $itemname = $userdatasall['item_title'];
                    $itemurl = $userdatasall['item_title_url'];
                    $liked = $setngs['liked_btn_cmnt'];
                        $userImg = $loguser['profile_image'];
                        if (empty($userImg)){
                            $userImg = 'usrimg.jpg';
                        }
                        $image['user']['image'] = $userImg;
                        $item_url = base64_encode($itemid."_".rand(1,9999));
                    $image['user']['link'] = SITE_URL."people/".$logusernameurl;
                    $image['item']['image'] = $userdatasall['photos'][0]['image_name'];
                    $image['item']['link'] = SITE_URL."listing/".$item_url;
                    $loguserimage = json_encode($image);
                    $loguserlink = "<a href='".SITE_URL."people/".$logusernameurl."'>".$logusername."</a>";
                    $productlink = "<a href='".SITE_URL."listing/".$item_url."'>".$itemname."</a>";
                    $notifymsg = $loguserlink." -___-commented on-___- ".$productlink;
                    $logdetails = $this->addloglive('comment',$userid,$favnotifyto,$comment_id,$notifymsg,$commentss,$loguserimage);
                }
            }

            $this->loadModel('Userdevices');
            $this->loadModel('Items');
            $userdevicestable = TableRegistry::get('Userdevices');
            $getuserIdd = $itemstable->find()->where(['id'=>$itemid])->first();
            $ItemaddUserid = $getuserIdd['user_id'];
            if ($ItemaddUserid != $userid){
                $userddett = $userdevicestable->find()->where(['user_id'=>$ItemaddUserid])->all();
                //echo "<pre>";print_r($userddett);die;
                foreach ($userddett as $userd) {
                    $deviceTToken = $userd['deviceToken'];
                    $badge = $userd['badge'];
                    $badge +=1;
                    $this->Userdevices->updateAll(array('badge' =>"'$badge'"), array('deviceToken' => $deviceTToken));
                    if(isset($deviceTToken)){
                        $messages = $logusername." is commented on your item : ".$commentss;
                        //$messages = $logusername." est commenté votre article : ".$commentss;
                        //$Users->pushnot($deviceTToken,$messages,$badge);
                    }
                }
            }

            $cmntCount = $commentstable->find()->where(['item_id'=>$itemid])->count();
            $itemquery = $itemstable->query();
            $itemquery->update()
                ->set(['comment_count' => $cmntCount])
                ->where(['id' => $itemid])
                ->execute();

            $item_status = $userdatasall['user']['someone_cmnt_ur_things'];
        $sitesettingstable = TableRegistry::get('Sitesettings');
        $setngs = $sitesettingstable->find()->where(['id'=>1])->first();

            if($item_status==1)
            {
            $item_url = base64_encode($itemid."_".rand(1,9999));
            $email=$userdatasall['user']['email'];
            $aSubject=$setngs['site_name']." - ".__d('user','Some one commented on your product - Product ID')." #".$itemid;
            $aBody='';
            $template='addcomment';
            $setdata=array('name'=>$userdatasall['user']['first_name'],'itemname'=>$userdatasall['item_title'],'itemurl'=>$item_url,'itemid'=>$itemid,'comments'=>$commentss);
            $this->sendmail($email,$aSubject,$aBody,$template,$setdata);

                if($setngs['gmail_smtp'] == 'enable'){
                    $this->Email->smtpOptions = array(
                            'port' => $setngs['smtp_port'],
                            'timeout' => '30',
                            'host' => 'ssl://smtp.gmail.com',
                            'username' => $setngs['noreply_email'],
                            'password' => $setngs['noreply_password']);

                    $this->Email->delivery = 'smtp';
                }
                $this->Email->to = $userdatasall['user']['email'];
                $this->Email->subject = $setngs['site_name']." - Some one commented on your product - Product ID #".$itemid;
                $this->Email->from = SITE_NAME."<".$setngs['noreply_email'].">";
                $this->Email->sendAs = "html";
                $this->Email->template = 'addcomment';
                $this->set('name', $userdatasall['user']['first_name']);
                //$this->set('urlname', $urlname);
                //$this->set('email', $emailaddress);
                //$username = $loguser[0]['User']['username'];
                //$this->set('username',$email_address[0]['User']['first_name']);
                //$this->set('sender',$sender);
                $this->set('itemname',$userdatasall['item_title']);
                $this->set('$itemurl',$userdatasall['item_title_url']);
                $this->set('itemid',$itemid);
                $this->set('comments',$commentss);

                //$this->Email->send();
            }

            echo $comment_id;

        }

        function editcommentsave(){

            $cmtid = $_REQUEST['cmtid'];
            $cmntval = $_REQUEST['cmntval'];
            //echo  $cmntval;

            $commentstable = TableRegistry::get('Comments');
            $query = $commentstable->query();
            $query->update()
                ->set(['comments' => $cmntval])
                ->where(['id' => $cmtid])
                ->execute();


                echo $cmntval;

            die;
        }

        function deletecomments(){
            $cmtid = $_REQUEST['addid'];
            $this->loadModel('Comments');
            $this->loadModel('Logs');

            $itemid = $_REQUEST['itemid'];

            $commentstable = TableRegistry::get('Comments');
            $commentquery = $commentstable->query();
            $commentquery->delete()
                ->where(['id' => $cmtid])
                ->execute();

            $logstable = TableRegistry::get('Logs');
            $logsquery = $logstable->query();
            $logsquery->delete()
                ->where(['notification_id'=>$cmtid])
                ->where(['type' => 'comment'])
                ->execute();


            $cmntCount = $commentstable->find()->where(['item_id'=>$itemid])->count();

            $itemstable = TableRegistry::get('Items');
            $query = $itemstable->query();
            $query->update()
                ->set(['comment_count' => "'$cmntCount'"])
                ->where(['id' => $itemid])
                ->execute();

            echo "1";
            die;
        }


        //CHANGE QUANTITY AND SIZES
         function getsizeqty() {
            $this->autoLayout = false;
            $this->autoRender = false;
            $itemId = $_POST['id'];
            $seltsize = $_POST['size'];
            $itemstable = TableRegistry::get('Items');
            $itemModel = $itemstable->find('all')->contain('Forexrates')->where(['Items.id'=>$itemId])->first();
            $sizeqty = $itemModel['size_options'];
            $sizeQty = json_decode($sizeqty, true);
            $prices = $sizeQty['price'][$seltsize];
            if($prices == 0 || $prices == '')
                $price = $itemModel['price'];
            else
                $price = $sizeQty['price'][$seltsize];
            $qty = $sizeQty['unit'][$seltsize];
            $qtyOptions = ''.'<option value="" >'.__d('user','QUANTITY').'</option>';
            //echo $qty;
            for($i=1; $i <= $qty; $i++) {
                $qtyOptions .=  '<option value="'.$i.'">'.$i.'</option>';

            }
            $date = date('d');
            $month = date('m');
            $year = date('Y');
           // $today = $month.'/'.$date.'/'.$year;
            $today =date('m/d/y');
            if($itemModel['dailydeal'] == 'yes' && $itemModel['dealdate'] == $today) {
                if(isset($_SESSION['currency_code']))
                {
                    $dealprice = $price * ( 1 - $itemModel['discount'] / 100 );
                    $price=$this->Currency->conversion($itemModel['forexrate']['price'],$_SESSION['currency_value'],$price);
                    $dealprice=$this->Currency->conversion($itemModel['forexrate']['price'],$_SESSION['currency_value'],$dealprice);
                    $convertprice = round($price, 2);
                    $convertdealprice = round($dealprice, 2);
                }
                else{

                    $price = $price;
                    $dealprice = $price * ( 1 - $itemModel['discount'] / 100 );
                    $convertprice = round($price, 2);
                    $convertdealprice = round($dealprice, 2);
                }
                $convertprice = $convertdealprice;
                $priceval = $price * ( 1 - $itemModel['discount'] / 100 );
                //$price =  "<strike>".$_SESSION['default_currency_symbol']."&nbsp;".$price."</strike>&nbsp".$_SESSION['default_currency_symbol']."&nbsp;".$convertprice ."</br>";
                $price =  $_SESSION['default_currency_symbol']."&nbsp;".$price;
          
            } else {
                $price = $price;

                $convertprice = round($price * $itemModel['forexrate']['price'], 2);
                $convertprice = $convertprice."&nbsp;".$_SESSION['default_currency_code'];
                $priceval = $price;
                if(isset($_SESSION['currency_code']))
                            $price = $_SESSION['currency_symbol']."&nbsp;".$this->Currency->conversion($itemModel['forexrate']['price'],$_SESSION['currency_value'],$price);
                else
                        $price =  $itemModel['forexrate']['currency_symbol']."&nbsp;".$price;
            }
            $output = array();
            $output[] = $qtyOptions;
            $output[] = $price;
            $output[] = $priceval."&nbsp;";
            $output[] = "&nbsp;".$convertprice;
            if($oldprice != $price && $price_old == 1)
                $output[] = '<span style="text-decoration:line-through;color:#8D8D8D;"><span style="font-size:20px;">'.$oldprice.'</span>'.$_SESSION['currency_code'].'</span>';
            else
                $output[] = '';
            echo json_encode($output);
        }

        function getfacebookcoupon(){

            $this->autoRender = false;
            global $loguser;
            $userId = $loguser['id'];
            $itemId = $_REQUEST['itemId'];
            $shopId = $_REQUEST['shopId'];

            $this->loadModel('Facebookcoupons');
            $this->loadModel('Sellercoupons');
            $this->loadModel('Shops');
            $this->loadModel('Items');

            $itemstable = TableRegistry::get('Items');
            $sellercouponstable = TableRegistry::get('Sellercoupons');
            $facebookcouponstable = TableRegistry::get('Facebookcoupons');
            $generatevalue = $this->Urlfriendly->get_uniquecode('8');
            $itemDatas = $itemstable->find()->where(['id'=>$itemId])->first();
            $couponPercent = $itemDatas['share_discountAmount'];
            $getcouponval = $sellercouponstable->find()->where(['couponcode'=>$generatevalue])->first();
            $todayDate = date("Y-m-d");
            $lastDate = date("Y-m-d", strtotime("tomorrow"));

            if(empty($getcouponval)) {

                $sellercoupon = $sellercouponstable->newEntity();
                $sellercoupon->type = 'facebook';
                $sellercoupon->couponcode = $generatevalue;
                $sellercoupon->couponpercentage = $couponPercent;
                $sellercoupon->validtodate = $lastDate;
                $sellercoupon->remainrange = 1;
                $sellercoupon->sellerid = $shopId;
                $sellercoupon->sourceid = $itemId; //Item is the source
                $sellercoupon->totalrange = '1';
                $sellercoupon->validfrom = $todayDate;
                $sellercoupon->validto = $lastDate;
                $couponid = $sellercouponstable->save($sellercoupon);
                $couponId = $couponid->id;

                $this->Facebookcoupon->create();
                $facebookcoupon = $facebookcouponstable->newEntity();
                $facebookcoupon->couponcode = $generatevalue;
                $facebookcoupon->item_id = $itemId;
                $facebookcoupon->user_id = $userId;
                $facebookcoupon->coupon_id = $couponId;
                $facebookcoupon->cdate = time();
                $facebookcouponid = $facebookcouponstable->save($facebookcoupon);
                $shareCouponId = $facebookcouponid->id;





                echo $generatevalue;

            }else{ echo 'false'; }

        }

        public function sociallogin()
        {
            
        }

}
