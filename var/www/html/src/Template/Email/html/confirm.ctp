<?php echo $this->element('emailHeader'); ?>  
				<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="font-family: Georgia, serif; background: #fff;" bgcolor="#ffffff">
			      <tr>
			        <td width="14" style="font-size: 0px;" bgcolor="#ffffff">&nbsp;</td>
					<td width="100%" valign="top" align="left" bgcolor="#ffffff" style="font-family: Georgia, serif; background: #fff;">
						<table cellpadding="0" cellspacing="0" border="0"  style="color: #333333; font: normal 13px Arial; margin: 0; padding: 0;" width="100%" class="content">
						<!-- <tr>
							<td style="padding: 25px 0 5px; border-bottom: 2px solid #d2b49b;font-family: Georgia, serif; "  valign="top" align="center">
								<h3 style="color:#767676; font-weight: normal; margin: 0; padding: 0; font-style: italic; line-height: 13px; font-size: 13px;">~ <currentmonthname> <currentday>, <currentyear> ~</h3>
							</td>
						</tr> -->
						<tr>
							<td style="padding: 18px 0 0;" align="left">			
								<h2 style=" font-weight: normal; margin: 0; padding: 0 0 12px; font-style: inherit; line-height: 30px; font-size: 25px; font-family: Trebuchet MS; border-bottom: 1px solid #333333; ">Your order has been approved successfully - Order ID #<?php echo $orderId; ?>.</h2>
							</td>
						</tr>
						
							<tr>
								<td style="padding: 15px 0;"  valign="top">
									<p style='margin-bottom: 10px'>
										Hi <?php echo $name; ?>,
									</p>
									<!--<p style='margin-bottom: 10px'>
										This email confirms your shipment on your order #<?php echo $orderid; ?> was successfully delivered to the buyer. <?php echo ucwords(strtolower($setngs[0]['Sitesetting']['site_name'])); ?> accounts team will review this order and your fund for this order will be delivered within 3 working days. 

									</p>
									<p style='margin-bottom: 10px'>
										If you do not receive your fund within the time, kindly send an email <a href='<?php echo SITE_URL; ?>help/contact'>here</a>.

									</p>-->
									<p style='margin-bottom: 10px'>
										Order #<?php echo $orderId; ?> details:
									</p>
									<p style='margin-bottom: 10px'>
										Buyer: <?php echo "<a href='".SITE_URL."people/".$loguser[0]['username']."'>"; ?><?php echo ucwords(strtolower($buyername)); ?></a>
										<br>
										Order ID: #<?php echo $orderId; ?>
										<br>
										Order Date: <?php echo date('j-M-Y', $orderdate); ?>
									</p>
									<p style='margin-bottom: 10px'>
										<table width="100%" class='order-details-table' style='border-spacing: 0;border-collapse: collapse;border: none;'>
										  <tr>
										    <th style='padding: 6px 10px;border: 1px solid rgba(0, 0, 0, 0.12);'>Item</th>
										    <th style='padding: 6px 10px;border: 1px solid rgba(0, 0, 0, 0.12);'>Quantity</th>
										    <th style='padding: 6px 10px;border: 1px solid rgba(0, 0, 0, 0.12);'>Size</th>
										  </tr>
										  <?php foreach($itemname as $key=>$item){ ?>
										  <tr>
										
											<td style='padding: 6px 10px;border: 1px solid rgba(0, 0, 0, 0.12);'><?php echo $item; ?></td>
											<td style='padding: 6px 10px;border: 1px solid rgba(0, 0, 0, 0.12);text-align: center;'><?php echo $tot_quantity[$key]; ?></td>
											<?php if ($sizeopt[$key] == '0') { ?>
												<td style='padding: 6px 10px;border: 1px solid rgba(0, 0, 0, 0.12);text-align: center;'> -- </td>
											<?php }else { ?>
												<td style='padding: 6px 10px;border: 1px solid rgba(0, 0, 0, 0.12);text-align: center;'><?php echo $sizeopt[$key]; ?></td>
											<?php } ?>
										
										  </tr>
										  <?php } ?>
										</table>
									</p>
									<p style='margin-bottom: 10px'>
										Ship to:
										<br clear="all" /><br />
										Name:-  <?php echo $usershipping_addr['name']; ?><br />
										Address1:-  <?php echo $usershipping_addr['address1']; ?><br />
										Address2:-  <?php echo $usershipping_addr['address2']; ?><br />
										City:-  <?php echo $usershipping_addr['city']; ?><br />
										State:-  <?php echo $usershipping_addr['state']; ?><br />
										Country:-  <?php echo $usershipping_addr['country']; ?><br />
										Zip code:-  <?php echo $usershipping_addr['zipcode']; ?><br />
										Phone:-  <?php echo $usershipping_addr['phone']; ?><br />
									</p>
									<p style='margin-bottom: 10px;font-size:16px;'>
										Total: <b><?php echo $totalcost." ".$currencyCode; ?></b>
									</p>
								</td>
							</tr>			
							
							<tr>
								<td style="padding: 15px 0"  valign="top">
									<p style="color: #333333; font-weight: normal; margin: 0; padding: 0; line-height: 20px; font-size: 14px;font-family: Arial; ">
										Regards,
										<br />
										<b><?php echo $setngs['site_name'].' Team'; ?>.</b>
									</p>
									<br>
								</td>
							</tr>
						</table>	
					</td>
					<td width="16" bgcolor="#ffffff" style="font-size: 0px;font-family: Georgia, serif; background: #fff;">&nbsp;</td>
			      </tr>
				</table><!-- body -->
				  <?php echo $this->element('emailFooter'); ?>  
		  	</td>
		</tr>
    </table>
  </body>
</html>
