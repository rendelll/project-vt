/********* DECLARATION AND INTIALIZATION *********/
var $ = jQuery.noConflict();
var BaseURL=getBaseURL();
var specials = /^[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]*$/;
var alphaspace = /^[a-zA-Z ]*$/;
var alphanospace = /^[a-zA-Z]*$/;
var alphanumericnospace = /^[a-zA-Z0-9]*$/;
var alphanumericspace = /^[a-zA-Z0-9 ]*$/;
var numeric = /^[0-9]*$/;
var decinum = /^[0-9.]*$/;
var emptymsg = "This field is required";
var emptyaltmsg = "Check, empty fields are required";
var emptyamtmsg = "Enter the price";
var emptyselectmsg = "Select option from dropdown";
var emptytermsmsg = "Please check the terms and conditions";

/********* NOTIFY ********/

$( document ).ready(function() {
    setTimeout(function() {
        $("#notify-message").fadeOut('slow');
    }, 5000);
});

/********* READY FUNCTIONS ********/

$(document).ready(function(){

	// ADD CART COUPON SECTION
	$('#generate_coupon').click(function(){
		var baseurl = BaseURL+'merchant/generatecoupons';
		$.ajax({
		      url: baseurl,
		      type: "post",
		      dataType: "html",
		      beforeSend: function () {
		    	  //$('#loading_img').show();
		      },
		      success: function(responce){
			        var respon = $.trim(responce)
			        $('#couponcodes').val(respon);
			        $(".f4-error-couponcodes").fadeOut();
					setTimeout(function(){
						$("#couponcodes").removeClass('has-error');
					}, 400); 

		    	//  $('#loading_img').hide();
		      }
		});
	
	}); 

	$( "#dealstart, #dealend, .prvcmntcont > #sdate, .prvcmntcont > #edate" ).on("keypress", function(){
		return false;
	});
});

/******** BASE DEFAULT FUNCTIONS ********/
function enable_add(org, id) {
	if($.trim(org)!="")
		$("#"+id).attr("disabled", false);
	else
		$("#"+id).attr('disabled', true);
}

function isValidEmailAddress(email) {
	var emailreg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	return emailreg.test(email);
}

function IsAlphaNumeric(e) {
	var specialKeys = new Array();
	specialKeys.push(8); // Backspace
	specialKeys.push(9); // Tab
	specialKeys.push(46); // Delete
	specialKeys.push(36); // Home
	specialKeys.push(35); // End
	specialKeys.push(37); // Left
	specialKeys.push(39); // Right
	specialKeys.push(27); // Space
	var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
	var ret = ((keyCode >= 48 && keyCode <= 57)
			|| (keyCode >= 65 && keyCode <= 90) || (keyCode == 32)
			|| (keyCode >= 97 && keyCode <= 122) || (specialKeys
			.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
	return ret;
}

function isAlpha(e) {
	var specialKeys = new Array();
	specialKeys.push(8); // Backspace
	specialKeys.push(9); // Tab
	specialKeys.push(46); // Delete
	specialKeys.push(36); // Home
	specialKeys.push(35); // End
	specialKeys.push(37); // Left
	specialKeys.push(39); // Right
	specialKeys.push(27); // Space
	var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
	var ret = ((keyCode >= 65 && keyCode <= 90) || (keyCode == 32)
			|| (keyCode >= 97 && keyCode <= 122) || (specialKeys
			.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
	return ret;
}

function isNumber(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
	}
	return true;
}

function isNumberdot(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46) {
		return false;
	}
	return true;
}

function chknum(field,e)
{
    var val = field.value;
    var re = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;
    var re1 = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;
    if (re.test(val)) {
        //do something here

    } else {
        val = re1.exec(val);
        if (val) {
            field.value = val[0];
        } else {
            field.value = "";
        }
    }
}

function IsDataError(data, msg, name, type) {
	$(".f4-error-"+name).show();
	$('.f4-error-'+name).text(msg);
	if(!$("#"+name).hasClass('has-error'))
		$("#"+name).addClass('has-error');
	if(type=="select"){
		$("#"+name).on("change", function(){
			$(".f4-error-"+name).fadeOut();
			setTimeout(function(){
				$("#"+name).removeClass('has-error');
			}, 400); 		
		});
	} else if(type=="checkbox"){
		$("."+name).on("click", function(){
			$(".f4-error-"+name).fadeOut();
			setTimeout(function(){
				$("#"+name).removeClass('has-error');
			}, 400); 		
		});
	} else if(type=="date"){
		$("#"+name).on("click", function(){
			$(".f4-error-"+name).fadeOut();
			setTimeout(function(){
				$("#"+name).removeClass('has-error');
			}, 400); 		
		});
	} else {
		$("#"+name).keydown(function(){
			$(".f4-error-"+name).fadeOut();
			setTimeout(function(){
				$("#"+name).removeClass('has-error');
			}, 400); 		
		});
	}
}

function IsDataErrornotime(msg, name, type, time) {
	if(type==true){
		$(".f4-error-"+name).fadeOut();
		setTimeout(function(){
			if($("#"+name).hasClass('has-error'))
				$("#"+name).removeClass('has-error');
		}, time);
		
	} else {
		if(!$("#"+name).hasClass('has-error'))
			$("#"+name).addClass('has-error');
		$(".f4-error-"+name).show();
		$('.f4-error-'+name).text(msg);
		setTimeout(function(){
			$(".f4-error-"+name).fadeOut();
		}, time);
		setTimeout(function(){
			if($("#"+name).hasClass('has-error'))
				$("#"+name).removeClass('has-error');
		}, time);		
	}
}

function IsTimerror(name, outtime, msg){
	$(".f4-error-"+name).show();
	$('.f4-error-'+name).text(msg);
	setTimeout(function(){
			$(".f4-error-"+name).fadeOut();
		}, outtime);
}

function IsEmpty(data, msg, name) {
	if($.trim(data) == ''){
		IsDataError(data, msg, name, '');
		return false;
	}	
}

function IsDataValidation(data, msg, name, type, flag, optional) {	
	var validCheck = false;
	data = $.trim(data);
	if($.trim(data) == ''){
		validCheck = true;
	} else if(type=="length" && $.trim(data).length < flag) {
		msg = "This field must have atleast "+flag+" characters";
		validCheck = true;
	} else if(optional=="alphaspace" && (!alphaspace.test(data))) {
   	 	msg = "Characters and Whitespace only allowed";
		validCheck = true;
	} else if(optional=="alphanospace" && (!alphanospace.test(data))) {
   	 	msg = "Characters only allowed";
		validCheck = true;
	} else if(optional=="alphanumericspace" && (!alphanumericspace.test(data))) {
   	 	msg = "Characters, Numbers and Whitespace only allowed";
		validCheck = true;
	} else if(optional=="alphanumericnospace" && (!alphanumericnospace.test(data))) {
   	 	msg = "Characters and Numbers only allowed";
		validCheck = true;
	} else if(optional=="numeric" && (!numeric.test(data))) {
		msg = "Numbers only allowed";
		validCheck = true;
	} else if(type=="price" && decinum.test(data)) {
		if(data == flag){
			msg = "Amount should not be zero";	validCheck = true;
		} else if(parseInt(data) != data) {
			msg = "Decimal price value not allowed";	validCheck = true;
		}	//parseInt(data) == data || parseFloat(data) == data
	}	else if(type=="floatprice" && decinum.test(data)) {
		if(data <= 0 || isNaN(data)){
			msg = "Enter the valid price";	validCheck = true;
		}
	}
	else if((type=="email") && (!(isValidEmailAddress(data)))) {
		msg = "Check the Email address";
		validCheck = true;
	} else if((type=="match") && (data.localeCompare(optional))) {
		msg = flag+" not matched";
		validCheck = true;
	}else if(type=="checkbox" && $.trim(data) < flag) {
		msg = "Select atleast one "+optional;
		validCheck = true;
	}

	if(validCheck == true) {
		if(type=="select")
			IsDataError(data, msg, name,'select');
		else if(type=="checkbox" || type=="date")
			IsDataError(data, msg, name, type);
		else
			IsDataError(data, msg, name,'');
		return false;
	}
}

function IsDateEmpty(data, name, error, edate) {
	if($.trim(data) == ''){
		if(!$("#"+name).hasClass('has-error'))
			$("#"+name).addClass('has-error');
		$(".f4-error-"+error).show();
		$('.f4-error-'+error).text("Select the date");
		$("#"+name).on("click", function(){
			$(".f4-error-"+error).fadeOut();
			setTimeout(function(){
				$("#"+name).removeClass('has-error');
			}, 400); 		
		});
		return false;
	}
	else if(($.trim(data) > $.trim(edate)) && ($.trim(edate) != "")) {
		if(!$("#"+name).hasClass('has-error'))
			$("#"+name).addClass('has-error');
		$(".f4-error-"+error).show();
		$('.f4-error-'+error).text("Start date exceeded end date");
		$("#"+name).on("click", function(){
			$(".f4-error-"+error).fadeOut();
			setTimeout(function(){
				$("#"+name).removeClass('has-error');
			}, 400); 		
		});
		return false;
	}
	return true;
}


/******* MERCHANT SCRIPT ********/

function merchantsignform() {
	var check = true;
	var firstname=$('#firstname').val();
	var lastname=$('#lastname').val();
	var email=$('#email').val();
	var username=$('#username').val();	
	var password=$('#password').val();
	var cpassword = $('#cpassword').val();
	var storename = $('#storename').val();
	var storephonecode = $('#storephonecode').val();
	var storephonearea = $('#storephonearea').val();
	var storephoneno = $('#storephoneno').val();
	var storeplatform = $('#storeplatform').val();
	var braintreeid = $('#braintreeid').val();
	var braintreepublickey = $('#braintreepublickey').val();
	var braintreeprivatekey = $('#braintreeprivatekey').val();
	var prodcat = $("input.prodcat:checked").length;
	var freeamt = $('#freeamt').val();
	var pricefree = $("input[name=pricefree]:checked").val().toLowerCase(); 
	var postalfree = $("input[name=postalfree]:checked").val().toLowerCase();
	var agree = $("input[name=agree]:checked").length;
	var address = $('#address').val();
	var city = $('#city').val();
	var statprov = $('#statprov').val();
	var country = $('#country').val();
	var zipcode = $('#zipcode').val();
	var latbox = $('#latbox').val();
	var postalbox = $('#postalboxes > div').length;

 	if(IsDataValidation(firstname, emptymsg, 'firstname', 'length', 3, 'alphaspace') == false) check = false;
 	else if(IsDataValidation(lastname, emptymsg, 'lastname', 'length', 3, 'alphaspace') == false) check = false;
 	else if(IsDataValidation(email, emptymsg, 'email', 'email', '', '') == false) check = false;
	else if(IsDataValidation(username, emptymsg, 'username', 'length', '3', 'alphanumericnospace') == false) check = false;
	else if(IsDataValidation(password, emptymsg, 'password', 'length', '6', '') == false) check = false;
	else if(IsDataValidation(cpassword, emptymsg, 'cpassword', 'match', 'Password', password) == false) check = false;
	else if(IsDataValidation(storename, emptymsg, 'storename', 'length', 3, 'alphanumericspace') == false) check = false;
	else if(IsDataValidation(storephonecode, emptyaltmsg, 'storephonecode', '', '', 'numeric') == false) check = false;
	else if(IsDataValidation(storephonearea, emptyaltmsg, 'storephonearea', '', '', 'numeric') == false) check = false;
	else if(IsDataValidation(storephoneno, emptyaltmsg, 'storephoneno', '', '', 'numeric') == false) check = false;
	else if(IsDataValidation(storeplatform, emptyselectmsg, 'storeplatform', 'select', '', '') == false) check = false;
	else if(IsEmpty(braintreeid, emptymsg, 'braintreeid')== false) check = false;
	else if(IsEmpty(braintreepublickey, emptymsg, 'braintreepublickey')== false) check = false;
	else if(IsEmpty(braintreeprivatekey, emptymsg, 'braintreeprivatekey')== false) check = false;
	else if(IsDataValidation(prodcat, emptymsg, 'prodcat', 'checkbox', '1', 'Product Category') == false) check = false;
	else if($.trim(pricefree) == 'yes') {
		if(IsDataValidation(freeamt, emptyamtmsg, 'freeamt', 'price', '0', '') == false) check = false;
	}
	if(check) {
		if(postalfree=="yes" && postalbox<1){
			postmsg = "Click add button to update codes";
			IsDataError('', postmsg, 'postal-codes', '');
			check = false;
		} else {
			if(IsDataValidation(address, emptymsg, 'address', '', '', '') == false) check = false;
			else if(IsDataValidation(city, emptymsg, 'city', '', '', '') == false) check = false;
			else if(IsDataValidation(statprov, emptymsg, 'statprov', '', '', '') == false) check = false;
			else if(IsDataValidation(country, emptyselectmsg, 'country', 'select', '', '') == false) check = false;
			else if(IsDataValidation(zipcode, emptymsg, 'zipcode', '', '', '') == false) check = false;
			else if($.trim(latbox) == ''){
				IsTimerror('zipcode', 10000, 'Enter address details and click go button - or - move marker in map to update your latitude & longitude');
				check = false;
			}
		}
	}

	if(agree == 0 && check == true){
		IsTimerror('agree', 3000, emptytermsmsg);
		return false;		
	}
	if(check == false)
	{
		IsTimerror('signerror', 3000, 'Please Check the details to be filled');
		return false;
	}

	return true;
	
}

function getBaseURL(){ 
	var url = location.href; 
	var baseURL = url.substring(0, url.indexOf('/', 14));  
	if (baseURL.indexOf('http://localhost') != -1) { 
		var url = location.href; 
		var pathname = location.pathname; 
		var index1 = url.indexOf(pathname); 
		var index2 = url.indexOf("/", index1 + 1); 
		var baseLocalUrl = url.substr(0, index2);  
		return baseLocalUrl + "/dev/"; 
	} else { 
		return baseURL + "/dev/"; 
	}
}

function add_postalcode() {
	var postalcode = $("#postal_code").val();
	if($.trim(postalcode)!="") {
		$('#postal-codes').removeClass('has-error');
		$('.f4-error-postal-codes').html('');
		$("#postalboxes").prepend('<div class="input-group"><input type="text" value="'+postalcode+'" name="postalcodes[]" class="form-control postalcodes" onkeypress="return isNumber(event)"><span class="input-group-btn btn" onclick="delete_post_code(this);"><i class="icon-trash"></i></span></div>');
		$("#postadd").attr('disabled',true);
		$("#postal_code").val("");
	}
}

function delete_post_code(org) {
	//$(org).prev("input").remove();
	$(org).parent("div").remove();
	$(org).remove();
}

function pricefreeamt(e, value, func, name, msg) {
	var radio = $("input[name="+value+"]:checked").val().toLowerCase();
	if(radio=="yes") {
		IsDataErrornotime('', name, true, '400');
		if(func == "isNumberdot")
			return isNumberdot(e);
		else
			return isNumber(e);
	} else {
		IsDataErrornotime(msg, name, false, '1500');
		return false;
	}
}

function emptyfield(e, id, btn) {
	$('#'+e).val('');
	if($.trim(id)!=""){
		$('#'+id).html('');
		enable_add('', btn);
	}
}

$( document ).ready(function() {
	$( "#addcartcoupon, #additemcoupon, #addcategorycoupon, #editcategorycoupon" ).submit(function() {
		var check = true;
		var couponcodes = $('#couponcodes').val();
		var couponrange = $('#couponrange').val();
		var dealstart = $('#dealstart').val();
		var dealend = $('#dealend').val();
		var couponamounts = $('#couponamounts').val();

		var startdate = $('#dealstart').datepicker('getDate') / 1000;
		var enddate = $('#dealend').datepicker('getDate') / 1000;

		if(IsDataValidation(couponcodes, emptymsg, 'couponcodes', 'length', 8, '') == false) check = false;
	 	else if(IsDataValidation(couponrange, emptymsg, 'couponrange', '', '', 'numeric') == false) check = false;
	 	else if(IsDataValidation(dealstart, emptymsg, 'dealstart', 'date', '', '') == false) check = false;
	 	else if(IsDataValidation(dealend, emptymsg, 'dealend', 'date', '', '') == false) check = false;
	 	else if(startdate>enddate) {
	 		IsDataErrornotime('Expire date should be greater than start date','dealend', false, '5000');
	 		check = false; 	
	 	}
	 	else if(IsDataValidation(couponamounts, emptymsg, 'couponamounts', '', '', 'numeric') == false) check = false;
	 	else if($.trim(couponamounts)>=100){
	 		IsDataError('','Discount percentage should be below 100','couponamounts','');
	 		check = false;
	 	}

	 	if(check == false) {
			IsTimerror('couponerror', 3000, 'Please Check the details to be filled');
			return false;
		}
		
	  return true;
	});
});

$( document ).ready(function() {
	$( "#paymentsettings" ).submit(function() {
		var braintreeid = $('#braintreeid').val();
		var publickey = $('#publickey').val();
		var privatekey = $('#privatekey').val();
		var check = true;

		if(IsEmpty(braintreeid, emptymsg, 'braintreeid')== false) return false;
		else if(IsEmpty(publickey, emptymsg, 'publickey')== false) return false;
		else if(IsEmpty(privatekey, emptymsg, 'privatekey')== false) return false;
		
		return true;
	});
});

function deletecoupon(id){
    var baseurl = BaseURL;
	if (confirm("Are you sure you want to delete this Coupon? ")) {
		$.post(baseurl+'merchant/deletecoupon', { "id": id},
			function(data) {
				$("#del_"+id).remove();
			}
		);
	
	}
	return false;	
}

$( document ).ready(function() {
	$("#msgForm").submit(function() {
		var message = $('#message').val();
		if(IsDataValidation(message, emptymsg, 'message', '', '', '') == false) return false;
	  	return true;
	});
});

function fulfilloldorder_search()
{
	startdate = $('#sdate').datepicker('getDate') / 1000;
	enddate = $("#edate").datepicker('getDate') / 1000;
	sdate =  $('#sdate').val();
	edate =  $('#edate').val();
	if(IsDateEmpty(sdate, 'sdate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(edate, 'edate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(startdate, 'sdate', 'daterror', enddate) == false) return false;
	
	var baseurl = BaseURL+"merchant/fulfilloldorders/"+startdate+"/"+enddate;
	window.location = baseurl;
}

function fulfillorder_search()
{
	startdate = $('#sdate').datepicker('getDate') / 1000;
	enddate = $("#edate").datepicker('getDate') / 1000;
	sdate =  $('#sdate').val();
	edate =  $('#edate').val();
	if(IsDateEmpty(sdate, 'sdate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(edate, 'edate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(startdate, 'sdate', 'daterror', enddate) == false) return false;
	
	var baseurl = BaseURL+"merchant/fulfillorders/"+startdate+"/"+enddate;
	window.location = baseurl;
}

function actionoldorder_search()
{
	startdate = $('#sdate').datepicker('getDate') / 1000;
	enddate = $("#edate").datepicker('getDate') / 1000;
	sdate =  $('#sdate').val();
	edate =  $('#edate').val();
	if(IsDateEmpty(sdate, 'sdate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(edate, 'edate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(startdate, 'sdate', 'daterror', enddate) == false) return false;
	
	var baseurl = BaseURL+"merchant/actionoldorders/"+startdate+"/"+enddate;
	window.location = baseurl;
}

function actionorder_search()
{
	startdate = $('#sdate').datepicker('getDate') / 1000;
	enddate = $("#edate").datepicker('getDate') / 1000;
	sdate =  $('#sdate').val();
	edate =  $('#edate').val();
	if(IsDateEmpty(sdate, 'sdate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(edate, 'edate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(startdate, 'sdate', 'daterror', enddate) == false) return false;
	
	var baseurl = BaseURL+"merchant/actionrequired/"+startdate+"/"+enddate;
	window.location = baseurl;
}

function historyoldorder_search()
{
	startdate = $('#sdate').datepicker('getDate') / 1000;
	enddate = $("#edate").datepicker('getDate') / 1000;
	sdate =  $('#sdate').val();
	edate =  $('#edate').val();
	if(IsDateEmpty(sdate, 'sdate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(edate, 'edate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(startdate, 'sdate', 'daterror', enddate) == false) return false;
	
	var baseurl = BaseURL+"merchant/historyoldorders/"+startdate+"/"+enddate;
	window.location = baseurl;
}

function historyorder_search()
{
	startdate = $('#sdate').datepicker('getDate') / 1000;
	enddate = $("#edate").datepicker('getDate') / 1000;
	sdate =  $('#sdate').val();
	edate =  $('#edate').val();
	if(IsDateEmpty(sdate, 'sdate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(edate, 'edate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(startdate, 'sdate', 'daterror', enddate) == false) return false;
	
	var baseurl = BaseURL+"merchant/history/"+startdate+"/"+enddate;
	window.location = baseurl;
}

function claimedorder_search()
{
	startdate = $('#sdate').datepicker('getDate') / 1000;
	enddate = $("#edate").datepicker('getDate') / 1000;
	sdate =  $('#sdate').val();
	edate =  $('#edate').val();
	if(IsDateEmpty(sdate, 'sdate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(edate, 'edate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(startdate, 'sdate', 'daterror', enddate) == false) return false;
	
	var baseurl = BaseURL+"merchant/claimed/"+startdate+"/"+enddate;
	window.location = baseurl;
}

function claimedoldorder_search()
{
	startdate = $('#sdate').datepicker('getDate') / 1000;
	enddate = $("#edate").datepicker('getDate') / 1000;
	sdate =  $('#sdate').val();
	edate =  $('#edate').val();
	if(IsDateEmpty(sdate, 'sdate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(edate, 'edate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(startdate, 'sdate', 'daterror', enddate) == false) return false;
	
	var baseurl = BaseURL+"merchant/claimedoldorders/"+startdate+"/"+enddate;
	window.location = baseurl;
}

function returnedorder_search()
{
	startdate = $('#sdate').datepicker('getDate') / 1000;
	enddate = $("#edate").datepicker('getDate') / 1000;
	sdate =  $('#sdate').val();
	edate =  $('#edate').val();
	if(IsDateEmpty(sdate, 'sdate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(edate, 'edate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(startdate, 'sdate', 'daterror', enddate) == false) return false;
	
	var baseurl = BaseURL+"merchant/returned/"+startdate+"/"+enddate;
	window.location = baseurl;
}

function returnedoldorder_search()
{
	startdate = $('#sdate').datepicker('getDate') / 1000;
	enddate = $("#edate").datepicker('getDate') / 1000;
	sdate =  $('#sdate').val();
	edate =  $('#edate').val();
	if(IsDateEmpty(sdate, 'sdate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(edate, 'edate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(startdate, 'sdate', 'daterror', enddate) == false) return false;
	
	var baseurl = BaseURL+"merchant/returnedoldorders/"+startdate+"/"+enddate;
	window.location = baseurl;
}

function cancelledorder_search()
{
	startdate = $('#sdate').datepicker('getDate') / 1000;
	enddate = $("#edate").datepicker('getDate') / 1000;
	sdate =  $('#sdate').val();
	edate =  $('#edate').val();
	if(IsDateEmpty(sdate, 'sdate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(edate, 'edate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(startdate, 'sdate', 'daterror', enddate) == false) return false;

	var baseurl = BaseURL+"merchant/cancelled/"+startdate+"/"+enddate;
	window.location = baseurl;
}

function cancelledoldorder_search()
{
	startdate = $('#sdate').datepicker('getDate') / 1000;
	enddate = $("#edate").datepicker('getDate') / 1000;
	sdate =  $('#sdate').val();
	edate =  $('#edate').val();
	if(IsDateEmpty(sdate, 'sdate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(edate, 'edate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(startdate, 'sdate', 'daterror', enddate) == false) return false;

	var baseurl = BaseURL+"merchant/cancelledoldorders/"+startdate+"/"+enddate;
	window.location = baseurl;
}

function actionpay_history()
{
	startdate = $('#sdate').datepicker('getDate') / 1000;
	enddate = $("#edate").datepicker('getDate') / 1000;
	sdate =  $('#sdate').val();
	edate =  $('#edate').val();
	if(IsDateEmpty(sdate, 'sdate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(edate, 'edate', 'daterror', '') == false) return false;
	else if(IsDateEmpty(startdate, 'sdate', 'daterror', enddate) == false) return false;
	
	var baseurl = BaseURL+"merchant/paymenthistory/"+startdate+"/"+enddate;
	window.location = baseurl;
}

function showInvoicePopup(id) {

	var baseurl = BaseURL+'merchant/viewinvoice/'+id;
	var element = '.inv-loader-'+id;

	if (id != "" || id != 0) {
		$.ajax({
		      url: baseurl,
		      type: "post",
		      dataType: "html",
		      before: function(){
		    	 $(element).show(); 
		      },
		      success: function(responce){
		          //alert(responce);
		    	  $(element).hide(); 
			    	 $('.moreactionlistmyord'+id).slideToggle();
		    		$('#invoice-popup-overlay').show();
		    		$('#invoice-popup-overlay').css("opacity", "1");
		          $('.invoice-popup').html(responce);
		      }
		});
	}
}

function markprocess (oid, process){
	var status = ".status"+oid;
	var curlist = "."+process+oid;
	var markloader = '';
	
	if (process == 'Processing'){
		markloader = ".process-loader-"+oid;
	}else if(process == 'Delivered'){
		markloader = ".buyerst-loader-"+oid;
	}
	if(process == 'Shipped'){
		window.location = BaseURL+'merchant/markshipped/'+oid;
		return;
	}else if(process == 'Track'){
		window.location = BaseURL+'merchant/trackingdetails/'+oid;
		return;
	}else if(process == 'ContactBuyer'){
		window.location = BaseURL+'merchant/sellerconversation/'+oid;
		return;
	}
	var element = '.paidinv-loader-'+oid;
	$.ajax({
	      url: BaseURL+"merchant/orderstatus",
	      type: "post",
	      data : { 'orderid': oid, 'chstatus': process},
		  beforeSend: function() {
			  $(element).show(); 
			},
	      success: function(){
	    	  $(element).hide(); 
	          $('.moreactionlistmyord'+oid).slideToggle();
	  	 $(".paid"+oid).hide();
	    	 $("#odr"+oid).remove();
	      }
	});
}


function markpaid (id) {
	var baseurl = BaseURL+'merchant/markpaid/'+id;
	var element = '.paidinv-loader-'+id;

	$.ajax({
	      url: baseurl,
	      type: "post",
	      dataType: "html",
	      beforeSend: function(){
	    	 $(element).show(); 
	      },
	      success: function(responce){
	    	  if($.trim(responce)=='success')
	    	  {
	    	  $(element).hide(); 
		    	 $('.moreactionlistmyord'+id).slideToggle();
		    	 $(".paid"+id).hide();
		    	 $("#odr"+id).remove();
	        
	    	  } 
	    	  else if($.trim(responce)=='fail')
	    	  {
	    		  window.location.reload();
	    	  }
	     }
	});
	
}


function merchantaddtracking(){
	var shippingdate = $('#shipmentdate').val();
	var couriername = $('#couriername').val();
	var courierservice = $('#courierservice').val();
	var trackid = $('#trackingid').val();
	var notes = $('#notes').val();
	var orderid = $('#hiddenorderid').val();
	var buyeremail = $('#hiddenbuyeremail').val();
	var buyername = $('#hiddenbuyername').val();
	var orderstatus = $('#hiddenorderstatus').val();
	var address = $('#hiddenbuyeraddress').val();
	var id = $('#trackid').val();
	
	if(IsDataValidation(shippingdate, emptymsg, 'shipmentdate', 'date', '', '') == false) return false;
	else if(IsDataValidation(couriername, emptymsg, 'couriername', '', '', '') == false) return false;
	else if(IsDataValidation(trackid, emptymsg, 'trackingid', '', '', '') == false) return false;
	
	$.ajax({
	      url: BaseURL+"merchant/updatetrackingdetails",
	      type: "post",
	      data : { 'orderid': orderid, 'buyeremail': buyeremail, 'orderstatus': orderstatus, 
	    	  		'address': address, 'buyername': buyername, 'shippingdate': shippingdate,
	    	  		'couriername': couriername, 'trackid': trackid, 'notes': notes,
	    	  		'courierservice': courierservice, 'id':id},
		  beforeSend: function() {
				$('.updatetrackingloader').show();
			},
	      success: function(responce){
				$('.updatetrackingloader').hide();
				window.location = BaseURL+'merchant/actionrequired';
	      }
	});
	return true;
}

function merchantmarkshipped(){
	var orderid = $('#hiddenorderid').val();
	var buyeremail = $('#hiddenbuyeremail').val();
	var buyername = $('#hiddenbuyername').val();
	var subject = $('#emailsubject').val();
	var message = $('#emailmessage').val();
	
	if(IsDataValidation(subject, emptymsg, 'emailsubject', '', '', '') == false) return false;
	else if(IsDataValidation(message, emptymsg, 'emailmessage', '', '', '') == false) return false;

	$.ajax({
	      url: BaseURL+"merchant/markshipped",
	      type: "post",
	      data : { 'orderid': orderid, 'buyeremail': buyeremail, 'subject': subject, 
	    	  		'message': message, 'buyername': buyername,},
		  beforeSend: function() {
				//$('.markshipbtnloader').show();
			},
	      success: function(responce){
				//$('.markshipbtnloader').hide();
				window.location = BaseURL+'merchant/actionrequired';
	      }
	});
	return true;
}

/************** ADD PRODUCT *******************/
function detect_method()
{
	color_method = $("#detectmethod").val();
	if(color_method=="manual")	{
		$("#manual_select").slideDown();
	} else	{
		$("#manual_select").slideUp();
	}
}

function selectDeal(deal) {
	var dealval = deal.value;
	if(dealval == 'yes') {
		$('.deal-content').slideDown();
	} else {
		$('.deal-content').slideUp();
	}
}

$(document).ready(function() {
	$('#price, #quantity').keydown(function (e) { 
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
	});
  $('input[name=shareCoupon]').change(function() {
      if (this.value == 'yes') {
    	$('#sharediscount').slideDown();
      }
      else if (this.value == 'no') {
    	$('#sharediscount').slideUp();
      }
  });

  $("#itemform").submit(function(){
  	var check = true;
  	var cat_double = true;
  	var cate_id  = $("select#cate_id").val();
  	var cate_id2  = $("select#cate_id2.active").val();
		var cate_id3  = $("select#cate_id3.active").val();
		var title  = $("#title").val();
		var description  = tinyMCE.get('description').getContent();
		var videourl = $("#videourl").val();
		var matches = videourl.match(/watch\?v=([a-zA-Z0-9\-_]+)/);
		var skuid = $("#skuid").val();
		var detectmethod = $("#detectmethod").val();
		var price  = $("#price").val();
		var quantity  = $("#quantity").val();
		var dailydeal = $('input[name=deal]:checked').val();
		var couponpercent = $('input[name=shareCoupon]:checked').val();
		var processing_time = $("#processing_time").val();
		var prmry_val  = $(".primary-shipping-price input").val();
		var imagecon = $("#imageCount").val();
		var delimgcon = $("#delimageCount").val();
		var imgval = delimgcon - 1;
		var imgname = $("#image_computer_"+imgval).val();

		if(IsDataValidation(cate_id, emptyselectmsg, 'cate_id', 'select', '', '') == false) check = false;
		if($("#cate_id2").hasClass('active')) {
			if(IsDataValidation(cate_id2, emptyselectmsg, 'cate_id2', 'select', '', '') == false)	check = false; 
			else if($("#cate_id3").hasClass('active') && check == true )
				if(IsDataValidation(cate_id3, emptyselectmsg, 'cate_id3', 'select', '', '') == false) check = false;
		}
		if(check == true)
		{
			if(imagecon==0 || imgname==""){
				$(".f4-error-image").show();
				$('.f4-error-image').text('Please add atleast one photo.');
				setTimeout(function(){
					$(".f4-error-image").hide();
					$('.f4-error-image').text('');
				}, 5000); 				 
				check = false;
			}
			else if(IsDataValidation(title, emptymsg, 'title', 'length', 3, '')  == false) check = false;
			else if($.trim(description)  == ""){
				IsTimerror('description','8000',"This field is required");
			 	check = false;
			}
			else if($.trim(description).length < 10){
				IsTimerror('description','8000',"This field must have atleast 10 charactes");
			 	check = false;
			}
			else if($.trim(videourl)!="" && !matches)	{
					IsDataError(videourl,"Video url is not valid","videourl","");
					check = false;
			}
			else if(IsDataValidation(skuid, emptymsg, 'skuid', '', '', '')  == false) check = false;
			else if(IsDataValidation(detectmethod, emptyselectmsg, 'detectmethod', 'select', '', '') == false) check = false;
			else if($.trim(detectmethod) == "manual")	{
				var item_color_manual = $("#item_color_manual").val();
				if($.trim(item_color_manual)=="")	{
						IsDataError(item_color_manual, "Select one or more colors", 'item_color_manual', 'select');
						check = false;
				}
			}
		}
		if(check == true) {
			if(IsDataValidation(price, emptymsg, 'price', 'floatprice', '', '') == false) check = false;
			else if($.trim(quantity) == '' || $.trim(quantity) <= 0 || parseInt($.trim(quantity)) != $.trim(quantity))
			{
				IsDataError(quantity, "Enter valid quantity", 'quantity', '');
				check = false;
			}
		}
		if(check == true) {
			if(dailydeal == 'yes') {
				var discount = $('#discount').val();
				var dealstart = $("#dealstart").val();
				if($.trim(discount) == '') {
					IsDataError(discount, emptymsg, 'discount', '');
					check = false;
				} else if(parseInt(discount) != discount){
					IsDataError(discount, 'Enter valid Percentage or Decimal values not allowed', 'discount', '');
					check = false;
				} else if(parseInt(discount) <= 0) {
					IsDataError(discount, 'Please enter the discount percentage above 0', 'discount', '');
					check = false;
				}  else if(parseInt(discount) > 100) {
					IsDataError(discount, 'Please enter the discount percentage below 100', 'discount', '');
					check = false;
				} 

				if($.trim(dealstart) == '' && check == true) {
					IsDataError(dealstart, 'Select the date', 'dealstart', 'date');
					check = false;
				}
			}
		}
		if(check == true) {
			if(couponpercent == 'yes')
			{
					var coupon_data = $.trim($('#share_discountAmnt').val());
					if($.trim(coupon_data) == '') {
						IsDataError(coupon_data, emptymsg, 'share_discountAmnt', '');
						check = false;
					} else if($.trim(coupon_data) != '') {
						if(parseInt(coupon_data) == coupon_data || parseFloat(coupon_data) == coupon_data){
							if(coupon_data <= 0) {
								IsDataError(coupon_data, 'Please enter the coupon percentage above 0', 'share_discountAmnt', '');
								check = false;
							}  else if(coupon_data > 100) {
								IsDataError(coupon_data, 'Please enter the coupon percentage below 100', 'share_discountAmnt', '');
								check = false;
							} 
						}	else {
							IsDataError(coupon_data, 'Enter valid Percentage', 'share_discountAmnt', '');
							check = false;
						}
				} 
			}
		}
		if(check == true) {
			if(IsDataValidation(processing_time, emptyselectmsg, 'processing_time', 'select', '', '') == false) check = false;	
			else if($.trim(prmry_val) == ''){
				$("#shipcosterror").show();
				$(".primary-shipping-price input").val("");
				$('#shipcosterror').text('Please enter a shipping cost for atleast one country or region.');
				$(".primary-shipping-price input").keydown(function(){
					$("#shipcosterror").hide();
				});
				check = false;
			}
		}
		if(check == false) {
			IsTimerror('itemformerror','5000','Please fill the deails');
			return false;
		}
  	return true;

 	});
});

function removeDynamicimg(imgno){
	$(".file-holder1").show();
	var selector = "#image_"+imgno;
	$(selector).remove();
	var img = $('#imageCount').val();
	$('#imageCount').val(img - 1);
	$("#divform").show();
}


