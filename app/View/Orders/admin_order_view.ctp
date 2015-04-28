<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td align="right" valign="top" width="230" class="sidepromenu">
<?php echo $this->Element('admin_order_leftsidebar'); ?></td>
<td align="left" valign="top">

<div id="content"  class="clearfix">			
    <div class="container">
    
        <div align="right" style="padding-right:50px;"><?php echo $this->Html->link('Back to Order Details',array('action'=>'order_index'),array('class'=>'button')); ?></div>   
        <div class="texttabBox"> 
            <form> 
             <fieldset><legend>Order   Details</legend>
           
           <table width="600" align="left">
           <?php $orderinvoice=ClassRegistry::init('Order')->find('first',array('conditions'=>array('order_id'=>$orderdetails['Order']['order_id'])));
		    $ordercartamount=ClassRegistry::init('Shoppingcart')->find('first',array('conditions'=>array('order_id'=>$orderdetails['Order']['order_id']),'fields'=>array('SUM(total) AS totamount','sum(detected_amount) as discountamount','sum(total_amount) as originalamount','is_coupon_used','quantity','cart_id')));
			
		
			
			$user=ClassRegistry::init('User')->find('first',array('conditions'=>array('user_id'=>$orderdetails['Order']['user_id'])));
			$paymentdetail=ClassRegistry::init('Paymentdetails')->find('first',array('conditions'=>array('order_id'=>$orderdetails['Order']['order_id']),'order'=>'paymentdetails_id DESC'));
		   ?>
            <tr><td width="250"><strong>Order Number</strong></td>
              <td><p>
				  <?php if($user['User']['user_type']=='0'){
                
                if($orderdetails['Order']['cod_status']=='PayU'){
                $in='SGN-ON-';
				$paymentmode='Full Payment';
                }elseif($orderdetails['Order']['cod_status']=='CHQ/DD'){
                    $in='SGN-CHQ/DD-';
					$paymentmode='CHQ/DD';
                }elseif($orderdetails['Order']['cod_status']=='COD'){
				$in='SGN-CD-';
				$paymentmode='Partial Payment';
			}
            }
		else
			{
				if($orderdetails['Order']['cod_status']=='PayU'){
					$in='SGN-FN-';
					$paymentmode='Full Payment';
				}elseif($orderdetails['Order']['cod_status']=='COD'){
					$in='SGN-FNCD-';
					$paymentmode='CHQ/DD';
				}elseif($orderdetails['Order']['cod_status']=='CHQ/DD'){
					$in='SGN-FNCHQ/DD-';
					$paymentmode='Partial Payment';
				}
				
				
			}?>
              
              <?php  echo $in.$orderinvoice['Order']['invoice'];?></p></td></tr>
               <tr><td width="150"><strong >Payment Mode</strong></td><td><?php echo $paymentmode; ?></td></tr>
               
               
				 <?php   if(($orderdetails['Order']['cod_status']!='CHQ/DD') && ($orderdetails['Order']['order_status']!='Pending')){?>
                 <tr><td width="150"><strong>Transaction Id </strong></td>
                 <td><p><?php $txid=h($paymentdetail['Paymentdetails']['txnid']); if(!empty($txid))echo $txid; else '-';  ?></p></td></tr>
                 <?php }?>
                 
             
              <?php $cart_amount=ClassRegistry::init('Shoppingcart')->find('first',array('conditions'=>array('order_id'=>$orderdetails['Order']['order_id']),'fields'=>'SUM(quantity*total) AS subtotal'));
			  $Discounthistory=ClassRegistry::init('Discounthistory')->find('first',array('conditions'=>array('order_id'=>$orderdetails['Order']['order_id'])));
			  if(!empty($Discounthistory)){
			  $Discount=ClassRegistry::init('Discount')->find('first',array('conditions'=>array('discount_id'=>$Discounthistory['Discounthistory']['coupon_id'])));
			  }
			  $netamount=$cart_amount[0]['subtotal'];
			  ?>
               <tr><td width="150"><strong >Sub Total Amount</strong></td><td>Rs.<?php echo $netamount=$cart_amount[0]['subtotal'];?></td></tr>
 <?php  if($orderdetails['Order']['discount_amount']>0){?>
          
         <tr><td width="150"><strong >Discount Type</strong></td><td><?php echo $Discount['Discount']['type'];?></td></tr>
        <tr><td width="150"><strong >Discount Code</strong></td><td><?php echo $Discount['Discount']['voucher_code'];?></td></tr>
         <!--<tr><td width="150"><strong ><?php //if($Discount['Discount']['per_amou']=="1") { echo "Percentage" ;} else { echo "Amount"; } ?></strong></td>
         <td><?php //if($Discount['Discount']['per_amou']=="1") { echo $Discount['Discount']['percentage']."  %  "; 	 } else {
              //echo " Rs. ".$Discount['Discount']['percentage'];  }?>
         </td></tr>-->
        <tr><td width="150"><strong >Discount Amount</strong></td><td>Rs. <?php echo $orderdetails['Order']['discount_amount'];?></td></tr>   
            
  <?php 
  $netamount-=$orderdetails['Order']['discount_amount'];
  }?>
              <?php  if($orderdetails['Order']['shipping_amt']>0){?>
              <tr><td width="150"><strong >Shipping Percentage</strong></td><td><?php echo $orderdetails['Order']['shipping_per'];?>%</td></tr>
				<tr><td width="150"><strong >Shipping Charges</strong></td><td>Rs. <?php echo $orderdetails['Order']['shipping_amt'];?></td></tr>
              
              <?php }?>
            <?php  $netamount+=$orderdetails['Order']['shipping_amt'];?>
              
               <tr><td width="150"><strong >Total Amount</strong></td><td>Rs. <?php echo $netamount;?></td></tr>
              <?php  if(($orderdetails['Order']['cod_status']=='PayU') && ($orderdetails['Order']['order_status']!='Pending')){
              $paid=$paymentdetail['Paymentdetails']['amount']; 
			  }elseif(($orderdetails['Order']['cod_status']=='COD') && ($orderdetails['Order']['order_status']!='Pending')){
				 $paid=$paymentdetail['Paymentdetails']['amount']; 
               $balance=$netamount-$orderdetails['Order']['cod_amount'];
			   }elseif(($orderdetails['Order']['cod_status']=='CHQ/DD') && ($orderdetails['Order']['order_status']!='Pending')){
				 $paid=$paymentdetail['Paymentdetails']['amount'];    
			   }
			   
			   ?>
               <?php if(($orderdetails['Order']['cod_status']=='COD') && ($orderdetails['Order']['order_status']!='Pending') && ($orderdetails['Order']['status']=='PartialPaid')){?>
               <tr><td width="150"><strong >Partial Payment Percentage</strong></td><td><?php echo $orderdetails['Order']['cod_percentage'];?>%</td></tr>
                <?php }?>
               <tr><td width="150"><strong >Amount Paid</strong></td><td><?php  if(!empty($paid)) {echo 'Rs.';
			   echo   $paid;} else echo 'Nill'; ?></td></tr>
               <?php if(($orderdetails['Order']['cod_status']=='COD') && ($orderdetails['Order']['order_status']!='Pending') && ($orderdetails['Order']['status']=='PartialPaid')){?>
                
               <tr><td width="150"><strong >Balance Amount</strong></td><td>Rs. <?php echo $balance;?></td></tr>
               <?php }?>
            
               <tr><td width="150"><strong >Order Created Date</strong></td>
             <td><p><?php $dtt=h($orderdetails['Order']['created_date']);
						 $ndtt=date("d-m-Y",strtotime($dtt));
						  if(!empty($ndtt))echo $ndtt; else '-';  ?></p></td></tr>
                          
                           <tr><td width="150"><strong>Order Status </strong></td>
             <td><p><?php $st=h($orderdetails['Order']['order_status']); if(!empty($st))echo $st; else '-';  ?></p></td></tr>
             
                           <?php    if(($orderdetails['Order']['cod_status']!='CHQ/DD') && ($orderdetails['Order']['order_status']!='Pending')){?>
              <tr><td width="150"><strong >Payment Created Date</strong></td>
             <td><p><?php $dt=h($paymentdetail['Paymentdetails']['created_date']);
						 $ndt=date("d-m-Y",strtotime($dt));
						  if(!empty($ndt))echo $ndt; else '-';  ?></p></td></tr>
                         <?php }?>   
                         
                 
              <tr><td width="150"><strong>Payment Status </strong></td>
             <td><p><?php $st=h($orderdetails['Order']['status']); if(!empty($st))echo $st; else '-';  ?></p></td></tr>
             
             
              <?php    if(($orderdetails['Order']['cod_status']!='CHQ/DD') && ($orderdetails['Order']['order_status']!='Pending')){?>         
              <tr><td width="150"><strong>Ip No </strong></td>
              <td><p><?php $ip=h($paymentdetail['Paymentdetails']['ip']); if(!empty($ip))echo $ip; else '-';  ?></p></td></tr>
              <?php }?>
           </table>         
                        
            </fieldset>
          </form>
          </div>
       </div> 
    </div>
</div>
</td>
</tr>
</table>
