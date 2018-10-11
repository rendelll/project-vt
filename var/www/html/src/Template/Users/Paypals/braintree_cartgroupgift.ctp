<html>
<title>Pay with Card Or Paypal</title>
<head>
  <meta charset="utf-8">
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"></script>
      <script src="https://js.braintreegateway.com/web/3.20.1/js/client.js"></script>
      <script src="https://js.braintreegateway.com/web/3.20.1/js/three-d-secure.js"></script>
      <script src="https://js.braintreegateway.com/web/dropin/1.5.0/js/dropin.js"></script>
</head>
<body>
<center><h2><?php echo __d('user','Pay with Card Or Paypal');?></h2></center>
<form action="javascript:void(0)" class="container">
 
  <div class="row">
    <div class="col-xs-12" >
      <div id="drop-in"></div>
    </div>
  </div>
  <div class="row">

    <div class="col-xs-6">
      <div class="input-group nonce-group hidden">
        <input type="hidden" name="nonce" class="form-control">
      </div>
      <div class="input-group pay-group">
        <input disabled id="pay-btn" class="btn btn-success btn-successs" type="submit" value="Loading...">
      </div>
    </div>
  </div>
</form>

<form name="paymentbraintreeform" method="post" action="<?php echo SITE_URL.'braintree/groupgift/'?>">
<input type="hidden" name="giftamount" value="<?php echo $amount; ?>" id="giftamountb" >
<input type="hidden" name="itemid" value="<?php echo $itemIds; ?>"/>
<input type="hidden" name="ggid" value="<?php echo $ggId; ?>"/>
<input type="hidden" name="currency" value="<?php echo $currency; ?>"/>
<input type="hidden" value="<?php echo $prices; ?>" id="prices" name="prices">
<input type="hidden" id="payment_method_nonce" value="" name="payment_method_nonce">
</form>

<div id="modal" class="hidden">
  <div class="bt-mask"></div>
  <div class="bt-modal-frame">
    <div class="bt-modal-header">
      <div class="header-text">Authentication</div>
    </div>
    <div class="bt-modal-body"></div>
    <div class="bt-modal-footer"><a id="text-close" href="#">Cancel</a></div>
  </div>
</div>


<script>
var payBtn = document.getElementById('pay-btn');
var nonceGroup = document.querySelector('.nonce-group');
var nonceInput = document.querySelector('.nonce-group input');
var payGroup = document.querySelector('.pay-group');
var modal = document.getElementById('modal');
var bankFrame = document.querySelector('.bt-modal-body');
var closeFrame = document.getElementById('text-close');
var components = {};

var clientToken = "<?php echo $clienttoken; ?>";
var clientPrice = "<?php echo $prices; ?>";

function start() {
  getClientToken();
}

function getClientToken() {
 
      onFetchClientToken(clientToken);  
   
}

function onFetchClientToken(clientToken) {
  braintree.client.create({
    authorization: clientToken
  }, function onClientCreate(err, client) {
    if (err) {
      console.log('client error:', err);
      return;
    }

    braintree.threeDSecure.create({
      client: client
    }, onComponent('threeDSecure'));
  });
  
  braintree.dropin.create({
    authorization: clientToken,
    container: '#drop-in',
    paypal: {
    flow: 'vault'
  }
  }, onComponent('dropin'));
}

function onComponent(name) {
  return function(err, component) {
    if (err) {
      console.log('component error:', err);
      return;
    }

    components[name] = component;

    if (components.threeDSecure && components.dropin) {
      setupForm();
    }
  }
}

function setupForm() {
  enablePayNow();
}

function addFrame(err, iframe) {
  bankFrame.appendChild(iframe);
  modal.classList.remove('hidden');
}

function removeFrame() {
  var iframe = bankFrame.querySelector('iframe');
  
  modal.classList.add('hidden');
  iframe.parentNode.removeChild(iframe);
}

function enablePayNow() {
  payBtn.value = 'Pay Now';
  payBtn.removeAttribute('disabled');
}

function showNonce(payload) {
    $('#payment_method_nonce').val(payload.nonce);
    setTimeout("document.paymentbraintreeform.submit()", 2);
  nonceInput.value = payload.nonce;
  payGroup.classList.add('hidden');
  payGroup.style.display = 'none';
  nonceGroup.classList.remove('hidden');
}

closeFrame.addEventListener('click', function () {
  components.threeDSecure.cancelVerifyCard(function (err, payload) {
    removeFrame();
    
    if (err) {
      console.log('cancel 3ds verify card failed.');
      return;
    }
    console.log('customer has cancelled 3ds. Send nonce from 3ds to server.')
    showNonce(payload);
  });
});

payBtn.addEventListener('click', function(event) {
  payBtn.setAttribute('disabled', 'disabled');
  payBtn.value = 'Processing...';

  components.dropin.requestPaymentMethod(function(err, payload) {
    if (err) {
      console.log('tokenization error:', err);
      enablePayNow();
      return;
    } else {
      console.log('initial tokenization success:', payload);
    }

    if (payload.type !== 'CreditCard') {
      // if not a credit card, skip 3ds and send nonce to server
      return;
    }
    
    components.threeDSecure.verifyCard({
      amount: clientPrice,
      nonce: payload.nonce,
      addFrame: addFrame,
      removeFrame: removeFrame
    }, function(err, verification) {
      // in the case of an error
      // or if liability could not be shifted
      // update your UI to tell your customer
      // that they must try a different payment method
      if (err) {
        components.dropin.clearSelectedPaymentMethod();
        console.log('verification error:', err);
        enablePayNow();
        return;
      }
      
      if (!verification.liabilityShifted) {
        components.dropin.clearSelectedPaymentMethod();
        console.log('Liability did not shift', verification);
        enablePayNow();
        return;
      }

      console.log('verification success:', verification);
      showNonce(verification);
      
      // send nonce and verification data to your server
    });
  });
});

start();
</script>
<style>
* {
  padding: 0;
}

body {
  display: flex;
  align-items: center;
  height: 100vh;
  padding: 2em;
  flex-direction: column;
}

hr {
  width: 85%;
}

form {
  max-width: 800px;
  margin: auto;
}

.row {
  margin-bottom: 1em;
}

.row:last-child {
  margin-bottom: 0;
}

#modal {
  position: absolute;
  top: 0;
  left: 0;
  display: flex;
  align-items: center;
  height: 100vh;
  width: 100vw;
  z-index: 100;
}

.bt-modal-frame {
  height: 480px;
  width: 440px;
  margin: auto;
  background-color: #eee;
  z-index: 2;
  border-radius: 6px;
}

.bt-modal-body {
  height: 400px;
  margin: 0 20px;
  background-color: white;
  border: 1px solid lightgray;
}

.bt-modal-header, .bt-modal-footer {
  height: 40px;
  text-align: center;
  line-height: 40px;
}

.bt-mask {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: black;
  opacity: 0.8;
}
.btn-successs
{
width: 280px !important;
margin-left: 240px !important;
}
</style>


</body>
</html>
