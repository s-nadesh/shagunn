<style>
    table.print-friendly tr td, table.print-friendly tr th {
        page-break-inside: avoid;
    }
</style>

<table cellpadding="0" cellspacing="0" border="0" style="width:100%"  align="left">
    <tr>
        <td colspan="2"><h1><p style="text-align: center">Invoice Details</p></h1></td>
    <tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    <tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    <tr>
        <?php
        $orderinvoice = ClassRegistry::init('Order')->find('first', array('conditions' => array('order_id' => $orderdetails['Order']['order_id'])));
        $ordercartamount = ClassRegistry::init('Shoppingcart')->find('first', array('conditions' => array('order_id' => $orderdetails['Order']['order_id']), 'fields' => array('SUM(total) AS totamount', 'sum(detected_amount) as discountamount', 'sum(total_amount) as originalamount', 'is_coupon_used', 'quantity', 'cart_id')));
        $paymentdetail = ClassRegistry::init('Paymentdetails')->find('first', array('conditions' => array('order_id' => $orderdetails['Order']['order_id'])));
        ?>
    <tr><td><strong>Invoice Number</strong></td>
        <td><p>
                <?php echo $in . $orderinvoice['Order']['invoice']; ?></p></td></tr>
    <tr><td ><strong >Payment Mode</strong></td><td><?php echo $orderdetails['Order']['cod_status']; ?></td></tr>
    <?php if (($orderdetails['Order']['cod_status'] != 'CHQ/DD') && ($orderdetails['Order']['order_status'] != 'Pending')) { ?>
        <tr><td ><strong>Transaction Id </strong></td>
            <td><p><?php
                    $txid = h($paymentdetail['Paymentdetails']['txnid']);
                    if (!empty($txid))
                        echo $txid;
                    else
                        '-';
                    ?></p></td></tr>
        <?php
    }
    if ($ordercartamount['Shoppingcart']['is_coupon_used'] == 1) {
        $Discounthistory = ClassRegistry::init('Discounthistory')->find('first', array('conditions' => array('cart_id' => $ordercartamount['Shoppingcart']['cart_id'])));
        $Discount = ClassRegistry::init('Discount')->find('first', array('conditions' => array('discount_id' => $Discounthistory['Discounthistory']['coupon_id'])));
        ?>
        <tr><td ><strong >Discount Type</strong></td><td><?php echo $Discount['Discount']['type']; ?></td></tr>
        <tr><td ><strong >Discount Code</strong></td><td><?php echo $Discount['Discount']['voucher_code']; ?></td></tr>
        <tr><td ><strong ><?php
                    if ($Discount['Discount']['per_amou'] == "1") {
                        echo "Percentage";
                    } else {
                        echo "Amount";
                    }
                    ?></strong></td><td><?php
                if ($Discount['Discount']['per_amou'] == "1") {
                    echo $Discount['Discount']['percentage'] . "  %  ";
                } else {
                    echo " Rs. " . $Discount['Discount']['percentage'];
                }
                ?></td></tr>
        <tr><td ><strong >Total Amount</strong></td><td>Rs. <?php echo $ordercartamount['0']['originalamount'] * $ordercartamount['Shoppingcart']['quantity']; ?></td></tr>
        <tr><td ><strong >Discount Amount Applied</strong></td><td>Rs. <?php echo $ordercartamount['0']['discountamount'] * $ordercartamount['Shoppingcart']['quantity']; ?></td></tr>            
        <tr><td ><strong >Remaining Amount</strong></td><td>Rs. <?php echo $ordercartamount['0']['totamount'] * $ordercartamount['Shoppingcart']['quantity']; ?></td></tr>
    <?php } else { ?>                     
        <tr><td ><strong >Total Amount</strong></td><td>Rs. <?php echo $ordercartamount['0']['totamount'] * $ordercartamount['Shoppingcart']['quantity']; ?></td></tr>
    <?php } ?>
    <tr><td ><strong >Paid Amount</strong></td>
        <td><p><?php
                $type = $user['User']['user_type'];
                if ($type == '0') {
                    if (($orderdetails['Order']['cod_status'] == 'PayU') && ($orderdetails['Order']['order_status'] != 'Pending')) {
                        $paid = h($paymentdetail['Paymentdetails']['amount']);
                    } else if (($orderdetails['Order']['cod_status'] == 'CHQ/DD') && ($orderdetails['Order']['order_status'] != 'Pending')) {
                        $paid = h($paymentdetail['Paymentdetails']['amount']);
                    }
                } elseif ($type == '1') {

                    $order_franchisee = ClassRegistry::init('Order')->find('first', array('conditions' => array('order_id' => $orderdetails['Order']['order_id'])));

                    if (($order_franchisee['Order']['cod_status'] == 'COD') && ($order_franchisee['Order']['order_status'] != 'Pending')) {

                        $per = $order_franchisee['Order']['cod_percentage'];
                        $amount = $ordercartamount['0']['totamount'];
                        $paid = h($paymentdetail['Paymentdetails']['amount']);
                        $balanceamt = $amount - $paid;
                    } elseif (($orderdetails['Order']['cod_status'] == 'PayU') && ($orderdetails['Order']['order_status'] != 'Pending')) {

                        $paid = h($paymentdetail['Paymentdetails']['amount']);
                    } elseif (($orderdetails['Order']['cod_status'] == 'CHQ/DD') && ($orderdetails['Order']['order_status'] != 'Pending')) {

                        $paid = h($paymentdetail['Paymentdetails']['amount']);
                    }
                }

                if (!empty($paid)) {
                    echo 'Rs.';
                    echo indian_number_format($paid);
                } else
                    '-';
                ?></p></td></tr>
    <?php
    if ($type == '1') {
        if ($order_franchisee['Order']['cod_status'] == 'COD') {
            ?>
            <tr><td ><strong>Balance Amount </strong></td>
                <td><p><?php
                        if (!empty($balanceamt)) {
                            echo 'Rs.';
                            echo indian_number_format($balanceamt);
                        } else {
                            echo '-';
                        };
                        ?></p></td></tr>

        <?php
        }
    }
    ?>
    <tr><td ><strong >Order Created Date</strong></td>
        <td><p><?php
                $dtt = h($orderdetails['Order']['created_date']);
                $ndtt = date("d-m-Y", strtotime($dtt));
                if (!empty($ndtt))
                    echo $ndtt;
                else
                    '-';
                ?></p></td></tr>
    <tr><td ><strong>Order Status </strong></td>
        <td><p><?php
                $st = h($orderdetails['Order']['order_status']);
                if (!empty($st))
                    echo $st;
                else
                    '-';
                ?></p></td></tr>
<?php if (($orderdetails['Order']['cod_status'] != 'CHQ/DD') && ($orderdetails['Order']['order_status'] != 'Pending')) { ?>
        <tr><td ><strong >Payment Created Date</strong></td>
            <td><p><?php
                    $dt = h($paymentdetail['Paymentdetails']['created_date']);
                    $ndt = date("d-m-Y", strtotime($dt));
                    if (!empty($ndt))
                        echo $ndt;
                    else
                        '-';
                    ?></p></td></tr>
<?php } ?>   

    <tr><td ><strong>Payment Status </strong></td>
        <td><p><?php
                $st = h($orderdetails['Order']['status']);
                if (!empty($st))
                    echo $st;
                else
                    '-';
                ?></p></td></tr>

<?php if (($orderdetails['Order']['cod_status'] != 'CHQ/DD') && ($orderdetails['Order']['order_status'] != 'Pending')) { ?>         
        <tr><td ><strong>Ip No </strong></td>
            <td><p><?php
                    $ip = h($paymentdetail['Paymentdetails']['ip']);
                    if (!empty($ip))
                        echo $ip;
                    else
                        '-';
                    ?></p></td></tr>
<?php } ?>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="width:100%"  align="left">
    <tr>
        <td colspan="2">&nbsp;</td>
    <tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    <tr>
    <tr>
        <td colspan="2"><h3><p style="text-align: center">Product Details</p></h3></td>
    <tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    <tr>
</table>

<table border="0" class="print-friendly">
    <thead>
        <tr style="height: 30px;">
            <th  align="center"><?php echo __('#'); ?></th>   
            <th  align="center">Product Details</th>
            <th  align="right">Quantity </th>
            <th  align="right">Price </th>
        </tr>
    </thead>
    <tbody>

        <?php
        $k = 1;
        $ordercart = ClassRegistry::init('Shoppingcart')->find('all', array('conditions' => array('order_id' => $orderdetails['Order']['order_id'])));
        $ordercartamount = ClassRegistry::init('Shoppingcart')->find('first', array('conditions' => array('order_id' => $orderdetails['Order']['order_id']), 'fields' => array('SUM(total) AS totamount')));
        foreach ($ordercart as $ordercarts) {
            $productdetails = ClassRegistry::init('Product')->find('first', array('conditions' => array('product_id' => $ordercarts['Shoppingcart']['product_id'])));
            $category = ClassRegistry::init('Category')->find('first', array('conditions' => array('category_id' => $productdetails['Product']['category_id'])));
            $vendor = ClassRegistry::init('Vendor')->find('first', array('conditions' => array('vendor_id' => $productdetails['Product']['vendor_id'])));
            ?>
            <tr border="0">
                <td align="center" valign="top"><?php echo ($k); ?></td>	
                <td  align="left">
                    <table border="0">
                        <tr style="padding-bottom:10px;">
                            <td  valign="top">
                                <?php $images = ClassRegistry::init('Productimage')->find('first', array('conditions' => array('product_id' => $productdetails['Product']['product_id'], 'status' => 'Active'))); ?>
                                <?php //$link=BASE_URL.'img/product/home/'.$images['Productimage']['imagename'];  ?>
                                <?php
                                $image = $images['Productimage']['imagename'];
                                echo $this->Html->image('product/small/' . $images['Productimage']['imagename'], array("alt" => "Image", 'width' => '120', 'height' => '90'));
                                ?>
                            </td>
                            <td> 
                                <p>Product Name: <?php echo $productdetails['Product']['product_name'] ?>  </p>
                                <p>Product Code: <?php echo $category['Category']['category_code'] . ' ' . $productdetails['Product']['product_code']; ?>  </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table>
                                    <tr><th colspan="2" style="text-align: left"><strong>Metal Details</strong></th></tr>
                                    <tr><td>
                                            <table style="width:100%">
                                                <tr><td ><strong>Metal</strong></td><td><p><?php echo $ordercarts['Shoppingcart']['metal'] ?></strong></p></td></tr>
                                                <tr><td ><strong>Metal Color</strong></td><td><p><?php echo $ordercarts['Shoppingcart']['metalcolor'] ?></strong></p></td></tr>
                                                <tr><td ><strong>Purity</strong></td><td><p><?php echo $ordercarts['Shoppingcart']['purity'] ?>K</strong></p></td></tr>
                                            </table>    
                                        </td>
                                        <td valign="top">
                                            <table style="width:100%">
                                                <tr><td ><strong>Size</strong></td><td><p><?php echo $ordercarts['Shoppingcart']['size'] ?></strong></p></td></tr>
                                                <tr><td ><strong>Metal Weight</strong></td><td><p><?php echo $ordercarts['Shoppingcart']['weight'] . ' gm'; ?></strong></p></td></tr>
                                            </table>   
                                        </td></tr>
                                </table>      
                            </td>
                        </tr>

                        <?php
                        $stone_details = ClassRegistry::init('Productdiamond')->find('all', array('conditions' => array('clarity' => $ordercarts['Shoppingcart']['clarity'], 'color' => $ordercarts['Shoppingcart']['color'], 'product_id' => $productdetails['Product']['product_id'])));

                        if (!empty($stone_details)) {
                            ?>
                            <tr>
                                <td  colspan="4">

                                    <?php
                                    $sd_clarity = '<tr><td >Clarity</td>';
                                    $sd_color = '<tr><td>Color</td>';
                                    $sd_nostones = '<tr><td>No.of Stones</td>';
                                    $sd_weight = '<tr><td>Weight</td>';
                                    $sd_shape = '<tr><td>Shape</td>';
                                    $sd_setting_type = '<tr><td>Setting Type</td>';
                                    $i = 1;
                                    foreach ($stone_details as $stone_detail) {
                                        $sd_clarity.='<td class="widthtd">' . $stone_detail['Productdiamond']['clarity'] . '</td>';
                                        $sd_color.='<td class="widthtd">' . $stone_detail['Productdiamond']['color'] . '</td>';
                                        $sd_nostones.='<td class="widthtd">' . $stone_detail['Productdiamond']['noofdiamonds'] . '</td>';
                                        $sd_weight.='<td class="widthtd">' . $stone_detail['Productdiamond']['stone_weight'] . '</td>';
                                        $sd_shape.='<td class="widthtd">' . $stone_detail['Productdiamond']['shape'] . '</td>';
                                        $sd_setting_type.='<td class="widthtd">' . $stone_detail['Productdiamond']['settingtype'] . '</td>';
                                        $i++;
                                    }
                                    $sd_clarity.='</tr>';
                                    $sd_color.='</tr>';
                                    $sd_shape.='</tr>';
                                    $sd_setting_type.='</tr>';
                                    $sd_nostones.='</tr>';
                                    $sd_weight.='</tr>';
                                    $stonehtml = '<p><strong><b>Diamonds Details</b></strong></p>';
                                    $stonehtml.=(($i > 3) ? ('<div style="">') : '');
                                    $stonehtml.='<table  border="0" style="width:100%">
     ' . $sd_clarity . $sd_color . $sd_nostones . $sd_weight . $sd_shape . $sd_setting_type . '	 
     </table>';
                                    $stonehtml.=(($i > 3) ? ('</div>') : '');
                                    $stonehtml.='<table>
	<tr><td colspan="' . $i . '">&nbsp;</td></tr></table>';
                                    echo $stonehtml;
                                    ?>
                                </td>
                            </tr>
                            <?php
                        } else {
                            
                        }
                        ?>






                        <?php
                        $gemstone_details = ClassRegistry::init('Productgemstone')->find('all', array('conditions' => array('product_id' => $productdetails['Product']['product_id'])));
                        if (!empty($gemstone_details)) {
                            ?>
                            <tr>
                                <td colspan="2">
                                    <?php
                                    $sd_clarity1 = '<tr><td >Gemstone</td>';
                                    $sd_color1 = '<tr><td>Size</td>';
                                    $sd_nostones1 = '<tr><td>No.of Stones</td>';
                                    $sd_weight1 = '<tr><td>Weight</td>';
                                    $sd_shape1 = '<tr><td>Shape</td>';
                                    $sd_setting_type1 = '<tr><td>Setting Type</td>';
                                    $i = 1;
                                    foreach ($gemstone_details as $gemstone_details) {
                                        $sd_clarity1.='<td class="widthtd">' . $gemstone_details['Productgemstone']['gemstone'] . '</td>';
                                        $sd_color1.='<td class="widthtd">' . $gemstone_details['Productgemstone']['size'] . '</td>';
                                        $sd_nostones1.='<td class="widthtd">' . $gemstone_details['Productgemstone']['no_of_stone'] . '</td>';
                                        $sd_weight1.='<td class="widthtd">' . $gemstone_details['Productgemstone']['stone_weight'] . '</td>';
                                        $sd_shape1.='<td class="widthtd">' . $gemstone_details['Productgemstone']['shape'] . '</td>';
                                        $sd_setting_type1.='<td class="widthtd">' . $gemstone_details['Productgemstone']['settingtype'] . '</td>';
                                        $i++;
                                    }
                                    $sd_clarity1.='</tr>';
                                    $sd_color1.='</tr>';
                                    $sd_shape1.='</tr>';
                                    $sd_setting_type1.='</tr>';
                                    $sd_nostones1.='</tr>';
                                    $sd_weight1.='</tr>';
                                    $stonehtml1 = '<p><strong><b>Gemstone Details</b></strong></p>';
                                    $stonehtml1.=(($i > 3) ? ('<div style="">') : '');
                                    $stonehtml1.='<table  border="0" style="width:100%">
     ' . $sd_clarity1 . $sd_color1 . $sd_nostones1 . $sd_weight1 . $sd_shape1 . $sd_setting_type1 . '	 
     </table>';
                                    $stonehtml1.=(($i > 3) ? ('</div>') : '');
                                    $stonehtml1.='<table>
	<tr><td colspan="' . $i . '">&nbsp;</td></tr></table>';
                                    echo $stonehtml1;
                                    ?>
                                </td>
                            </tr>
                            <?php
                        } else {
                            
                        }
                        ?>


                        <tr>
                            <td colspan="2">
                                <table>
                                    <tr><th colspan="2" style="text-align: left"><strong>Price Details</strong></th></tr>
                                    <tr><td   valign="top">
                                            <table style="width:100%">
                                                <tr><td ><strong>Metal Rate</strong></td><td><p>Rs.<?php
                                                            echo round($ordercarts['Shoppingcart']['goldprice'] * ($ordercarts['Shoppingcart']['purity'] / 24)) . '/gm';
                                                            ?></strong></p></td></tr>
                                                    <?php if (!empty($ordercarts['Shoppingcart']['stoneprice'])) { ?>
                                                    <tr><td ><strong>Diamond  Rate</strong></td><td><pRs.><?php echo $ordercarts['Shoppingcart']['stoneprice'] ?></strong></p></td></tr>
                                                    <?php } ?>
                                                    <?php if (!empty($ordercarts['Shoppingcart']['gemprice'])) { ?>
                                                        <tr><td ><strong>Gemstone Rate</strong></td><td><p>Rs.<?php echo $ordercarts['Shoppingcart']['gemprice'] ?></strong></p></td></tr>
    <?php } ?>
                                                    <tr><td ><strong>Making Charge (%)</strong></td><td><p><?php echo $ordercarts['Shoppingcart']['making_per'] ?></strong></p></td></tr>
                                                    <tr><td ><strong>Vat (%)</strong></td><td><p><?php echo $ordercarts['Shoppingcart']['vat_per'] ?></strong></p></td></tr>
                                            </table>   
                                        </td>
                                        <td   valign="top">
                                            <table style="width:100%">
                                                <tr><td ><strong>Metal Value</strong></td><td><p>Rs.<?php echo $ordercarts['Shoppingcart']['goldamount'] ?></p></td></tr>
                                                <?php if (!empty($ordercarts['Shoppingcart']['stoneamount'])) { ?>
                                                    <tr><td ><strong>Diamond Value</strong></td><td><p>Rs.<?php echo $ordercarts['Shoppingcart']['stoneamount']; ?></strong></p></td></tr>
                                                <?php } ?>
                                                <?php if (!empty($ordercarts['Shoppingcart']['gemstoneamount'])) { ?>
                                                    <tr><td ><strong>Gemstone Value</strong></td><td><p>Rs.<?php echo $ordercarts['Shoppingcart']['gemstoneamount']; ?></strong></p></td></tr>
    <?php } ?>
                                                <tr><td ><strong>Making Charge Value</strong></td><td><p>Rs.<?php echo $ordercarts['Shoppingcart']['making_charge']; ?></strong></p></td></tr>
                                                <tr><td ><strong>Vat  Value</strong></td><td><p>Rs.<?php echo $ordercarts['Shoppingcart']['vat']; ?></strong></p></td></tr>
                                                <tr><td ><strong>Total Amount</strong></td><td><p>Rs.<?php echo indian_number_format($ordercarts['Shoppingcart']['total']); ?></strong></p></td></tr>
                                            </table>   
                                        </td>


                                    </tr>
                                </table>
                            </td></tr>
                        <tr>
                            <td colspan="2">
                                <table>
    <?php $vendoroff = classRegistry::init('Vendorcontact')->find('first', array('conditions' => array('vendor_id' => $vendor['Vendor']['vendor_id']))); ?>
                                    <tr><th colspan="2" style="text-align: left"><strong>Vendor Details</strong></th></tr>
                                    <tr><td   valign="top">
                                            <table style="width:100%">
                                                <tr><td ><strong>Vendor Code</strong></td><td><p><?php echo $vendor['Vendor']['vendor_code']; ?></p></td></tr>
                                                <tr><td ><strong>Company</strong></td><td><p><?php echo $vendor['Vendor']['Company_name']; ?></p></td></tr>
                                                <tr><td ><strong>Phone No(1)</strong></td><td><p><?php echo $vendor['Vendor']['reg_phone']; ?> </p></td></tr>



                                            </table>   
                                        </td>
                                        <td   valign="top">
                                            <table style="width:100%">  
                                                <tr><td ><strong>Mobile</strong></td><td><p><?php echo $vendor['Vendor']['reg_mobile']; ?></p></td></tr>
                                                <tr><td ><strong>Email</strong></td><td><p><?php echo $vendoroff['Vendorcontact']['email']; ?></p></td></tr>

                                            </table>   
                                        </td>


                                    </tr>
                                </table>
                            </td></tr>
                    </table>
                </td>
                <td align="right" valign="top"><?php echo $ordercarts['Shoppingcart']['quantity'] ?>  </td>
                <td align="right" valign="top"><span>Rs.</span><?php echo indian_number_format($ordercarts['Shoppingcart']['total'] * $ordercarts['Shoppingcart']['quantity']) ?> </td>
            </tr>
            <?php
            $k++;
        }
        ?>
    </tbody>
</table>


<table cellpadding="0" cellspacing="0" border="0" style="width:100%"  align="left">
    <tr>
        <td colspan="2">&nbsp;</td>
    <tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    <tr>
    <tr>
        <td colspan="2"><h3><p style="text-align: center">Shipping Details</p></h3></td>
    <tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    <tr>
</table>

<?php $shippingdetails = ClassRegistry::init('Order')->find('first', array('conditions' => array('order_id' => $this->params['pass']['0'])));
?>
<table  align="left" style="width:100%;" >
    <tr><td ><strong> Shipping Address</strong></td><td>
            <p><?php
                $sbill = h($shippingdetails['Order']['shipping_add']);
                if (!empty($sbill))
                    echo $sbill;
                else
                    '-';
                ?></p>
        </td></tr>
    <tr><td ><strong>Shipping Landmark</strong></td><td>
            <p><?php
                $sbillland = h($shippingdetails['Order']['slandmark']);
                if (!empty($sbillland))
                    echo $sbillland;
                else
                    '-';
                ?></p>
        </td></tr>
    <tr><td ><strong>Shipping Pincode</strong></td><td>
            <p><?php
                $sbillpin = h($shippingdetails['Order']['spincode']);
                if (!empty($sbillpin))
                    echo $sbillpin;
                else
                    '-';
                ?></p>
        </td></tr>
    <tr><td ><strong>Shipping State</strong></td><td>
            <p><?php
                $sbillstate = h($shippingdetails['Order']['sstate']);
                if (!empty($sbillstate))
                    echo $sbillstate;
                else
                    '-';
                ?></p>
        </td></tr>
    <tr><td ><strong>Shipping City</strong></td><td>
            <p><?php
                $sbillcity = h($shippingdetails['Order']['scity']);
                if (!empty($sbillcity))
                    echo $sbillcity;
                else
                    '-';
                ?></p>
        </td></tr>

</table>

<table cellpadding="0" cellspacing="0" border="0" style="width:100%"  align="left">
    <tr>
        <td colspan="2">&nbsp;</td>
    <tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    <tr>
    <tr>
        <td colspan="2"><h3><p style="text-align: center">Billing Details</p></h3></td>
    <tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    <tr>
</table>
<?php $billingdetails = ClassRegistry::init('Order')->find('first', array('conditions' => array('order_id' => $this->params['pass']['0'])));
?>
<table style="width:100%" align="left">
    <tr><td ><strong> Billing Address</strong></td><td>
            <p><?php
                $bill = h($billingdetails['Order']['billing_add']);
                if (!empty($bill))
                    echo $bill;
                else
                    '-';
                ?></p>
        </td></tr>
    <tr><td ><strong> Billing Landmark</strong></td><td>
            <p><?php
                $billland = h($billingdetails['Order']['blandmark']);
                if (!empty($billland))
                    echo $billland;
                else
                    '-';
                ?></p>
        </td></tr>
    <tr><td ><strong> Billing Pincode</strong></td><td>
            <p><?php
                $billpin = h($billingdetails['Order']['pincode']);
                if (!empty($billpin))
                    echo $billpin;
                else
                    '-';
                ?></p>
        </td></tr>
    <tr><td ><strong> Billing State</strong></td><td>
            <p><?php
                $billstate = h($billingdetails['Order']['state']);
                if (!empty($billstate))
                    echo $billstate;
                else
                    '-';
                ?></p>
        </td></tr>
    <tr><td ><strong> Billing City</strong></td><td>
            <p><?php
                $billcity = h($billingdetails['Order']['city']);
                if (!empty($billcity))
                    echo $billcity;
                else
                    '-';
                ?></p>
        </td></tr>


</table>


