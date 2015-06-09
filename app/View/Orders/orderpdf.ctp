<?php
$orderinvoice = ClassRegistry::init('Order')->find('first', array('conditions' => array('order_id' => $orderdetails['Order']['order_id'])));
$ordercartamount = ClassRegistry::init('Shoppingcart')->find('first', array('conditions' => array('order_id' => $orderdetails['Order']['order_id']), 'fields' => array('SUM(total) AS totamount', 'sum(detected_amount) as discountamount', 'sum(total_amount) as originalamount', 'is_coupon_used', 'quantity', 'cart_id')));
$paymentdetail = ClassRegistry::init('Paymentdetails')->find('first', array('conditions' => array('order_id' => $orderdetails['Order']['order_id'])));
$user = ClassRegistry::init('User')->find('first', array('conditions' => array('user_id' => $orderdetails['Order']['user_id'])));
$dtt = h($orderdetails['Order']['created_date']);
$ndtt = date("d-M-Y", strtotime($dtt));
if (empty($ndtt))
    $ndtt = '-';
$shippingdetails = ClassRegistry::init('Order')->find('first', array('conditions' => array('order_id' => $this->params['pass']['0'])));
$alphas = range('A', 'Z');
?>
<style>
    /**** Common Style *****/

    div, dl, dt, dd, ul, li, h1, h2, h3, h4, h5, h6, pre, code, form, fieldset, legend, input, textarea, p, blockquote, th, td {
        margin: 0;
        padding: 0;
    }
    html, body {
        font-size: 14px;
        text-align: left;
        color: #373435;
        font-family: Arial, Helvetica, sans-serif;
        direction: ltr;
        font-weight: normal;
        margin: 0;
        padding: 0px 0 0 0;
        background: #fff;
    }
</style>
<div style="width:900px; padding:10px; margin:0 auto;">
    <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
            <td width="200"><?php echo $this->Html->image("icons/tax_invoice_logo.png", array('style' => 'float: left; height: 100px; background-repeat: no-repeat')) ?></td>
            <td width="200">&nbsp;</td>
            <td valign="middle"> Birla Gold and Precious Metals Pvt Ltd<br />
                Morya Landmark II, 2nd Floor 202,<br />
                New Link Road, Andheri (West)<br />
                Mumbai 400 053 </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" colspan="3"><span style="font-size:18px; font-weight:bold;">TAX INVOICE</span> <br />
                Inoive No: #<?php echo $in . $orderinvoice['Order']['invoice']; ?></td>
        </tr>
        <tr>
            <td style="border-top:1px solid #000;" colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td valign="top" width="270">
                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td width="90">Order No.</td>
                        <td width="20">:</td>
                        <td><?php echo $in . $orderinvoice['Order']['invoice']; ?></td>
                    </tr>
                    <tr>
                        <td>Order Date</td>
                        <td>:</td>
                        <td><?php echo $ndtt; ?></td>
                    </tr>
                    <tr>
                        <td>Invoice Date</td>
                        <td>:</td>
                        <td><?php echo $ndtt; ?></td>
                    </tr>
                    <tr>
                        <td>VAT/TIN</td>
                        <td>:</td>
                        <td>123456789011</td>
                    </tr>
                    <tr>
                        <td>Service Tax</td>
                        <td>:</td>
                        <td>ABCDE1123FSD001</td>
                    </tr>
                </table>
            </td>
            <td valign="top" width="250"><strong>Billing Address</strong> <br />
                <?php
                $sbill = h($shippingdetails['Order']['billing_add']);
                if (!empty($sbill))
                    echo "$sbill";
                else
                    '-';
                ?> <br />
                <?php
                $sbillland = h($shippingdetails['Order']['blandmark']);
                if (!empty($sbillland))
                    echo $sbillland;
                else
                    '-';
                ?> <br />
                <?php
                $sbillcity = h($shippingdetails['Order']['city']);
                if (!empty($sbillcity))
                    echo $sbillcity . ' - ';
                else
                    '-';
                $sbillpin = h($shippingdetails['Order']['pincode']);
                if (!empty($sbillpin))
                    echo $sbillpin;
                ?>, <br />
                <?php
                $sbillstate = h($shippingdetails['Order']['state']);
                if (!empty($sbillstate))
                    echo $sbillstate;
                else
                    '-';
                ?> <br />
            </td>
            <td valign="top" width="240"><strong>Shipping Address</strong> <br />
                <?php
                $sbill = h($shippingdetails['Order']['shipping_add']);
                if (!empty($sbill))
                    echo "$sbill";
                else
                    '-';
                ?><br />
                <?php
                $sbillland = h($shippingdetails['Order']['slandmark']);
                if (!empty($sbillland))
                    echo $sbillland;
                else
                    '-';
                ?>,<br />
                <?php
                $sbillcity = h($shippingdetails['Order']['scity']);
                if (!empty($sbillcity))
                    echo $sbillcity . ' - ';
                else
                    '-';
                $sbillpin = h($shippingdetails['Order']['spincode']);
                if (!empty($sbillpin))
                    echo $sbillpin;
                ?>,<br />
                <?php
                $sbillstate = h($shippingdetails['Order']['sstate']);
                if (!empty($sbillstate))
                    echo $sbillstate;
                else
                    '-';
                ?><br />
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td style="border-top:1px solid #000;" colspan="3">&nbsp;</td>
        </tr>
    </table>
    <table cellspacing="0" cellpadding="10" border="0" width="100%">
        <tr>
            <td align="center" width="200" style="border:1px solid #000; border-right:0px; padding:5px;">Product Description</td>
            <td style="border:1px solid #000; border-right:0px; padding:5px;" colspan="2" align="center">Metals Details</td>
            <td style="border:1px solid #000; border-right:0px; padding:5px;" colspan="2" align="center">Dimoand Details</td>
            <td style="border:1px solid #000; border-right:0px; padding:5px;" colspan="2" align="center">Stone Details</td>
            <td style="border:1px solid #000; border-right:0px; padding:5px;" align="center">Quantity</td>
            <td style="border:1px solid #000; padding:5px;" colspan="3" align="center">Product Price</td>
        </tr>
        <?php
        $k = 1;
        $ordercart = ClassRegistry::init('Shoppingcart')->find('all', array('conditions' => array('order_id' => $orderdetails['Order']['order_id'])));

        $net_product_amount = 0;
        $order_count = count($ordercart);
        foreach ($ordercart as $o_key => $ordercarts) {
            $productdetails = ClassRegistry::init('Product')->find('first', array('conditions' => array('product_id' => $ordercarts['Shoppingcart']['product_id'])));
            $category = ClassRegistry::init('Category')->find('first', array('conditions' => array('category_id' => $productdetails['Product']['category_id'])));
            $vendor = ClassRegistry::init('Vendor')->find('first', array('conditions' => array('vendor_id' => $productdetails['Product']['vendor_id'])));

            $stone_wght = $gem_wght = 0;
            $gem_names = '';
            $stone_details = ClassRegistry::init('Productdiamond')->find('all', array('conditions' => array('clarity' => $ordercarts['Shoppingcart']['clarity'], 'color' => $ordercarts['Shoppingcart']['color'], 'product_id' => $productdetails['Product']['product_id'])));
            $gemstone_details = ClassRegistry::init('Productgemstone')->find('all', array('conditions' => array('product_id' => $productdetails['Product']['product_id'])));

            foreach ($stone_details as $stone_detail) {
                $stone_wght += $stone_detail['Productdiamond']['stone_weight'];
            }

            foreach ($gemstone_details as $key => $gemstone_details) {
                $gem_wght += $gemstone_details['Productgemstone']['stone_weight'];
                $gem_names = $key == 0 ? "{$gemstone_details['Productgemstone']['gemstone']}" : ", {$gemstone_details['Productgemstone']['gemstone']}";
            }
            
            $product_name = $productdetails['Product']['product_name'];
            $product_name .= " {$ordercarts['Shoppingcart']['purity']}K Gold";
            $product_name .= $stone_wght > 0 ? " With Diamond" : "";
            $product_name .= ($ordercarts['Shoppingcart']['clarity'] != '' || $ordercarts['Shoppingcart']['color'] != '') ? " {$ordercarts['Shoppingcart']['clarity']}-{$ordercarts['Shoppingcart']['color']}" : "";
            $product_name .= $gem_names != '' ? " & {$gem_names}" : "";
            ?>
            <tr>
                <?php if($o_key == 0){?>
                <td style="border:1px solid #000; border-right:0px; border-bottom:0px; border-top:0px; padding:5px;" align="center"><?php echo $product_name ?></td>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;">Weight</td>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;">Amount</td>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;">Weight</td>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;">Amount</td>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;">Weight</td>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;">Amount</td>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;">&nbsp;</td>
                <td style="border:1px solid #000; border-top:0px; padding:5px;">&nbsp;</td>
                <?php }?>
            </tr>
            <tr>
                <?php if($o_key == 0){?>
                <td style="border:1px solid #000; border-right:0px; border-bottom:0px; border-top:0px; padding:5px;" align="center"></td>
                <?php }else{?>
                <td style="border:1px solid #000; border-right:0px; border-bottom:0px; border-top:0px; padding:5px;" align="center"><?php echo $product_name ?></td>
                <?php }?>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;" align="center"><?php echo $ordercarts['Shoppingcart']['weight']; ?></td>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;" align="center"><?php echo $ordercarts['Shoppingcart']['goldamount'] ?></td>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;" align="center"><?php echo $stone_wght ?></td>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;" align="center"><?php echo $ordercarts['Shoppingcart']['stoneamount']; ?></td>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;" align="center"><?php echo $gem_wght; ?></td>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;" align="center"><?php echo $ordercarts['Shoppingcart']['gemstoneamount']; ?></td>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;" align="center"><?php echo $ordercarts['Shoppingcart']['quantity'] ?></td>
                <?php $gold_amt = $ordercarts['Shoppingcart']['goldamount'] + $ordercarts['Shoppingcart']['stoneamount'] + $ordercarts['Shoppingcart']['gemstoneamount']?>
                <td style="border:1px solid #000; border-top:0px; padding:5px;" align="center"><?php echo indian_number_format($gold_amt) ?></td>
            </tr>
            <tr>
                <td style="border:1px solid #000; border-right:0px; border-bottom:0px; border-top:0px; padding:5px;" align="center"></td>
                <td style="border:1px solid #000; border-top:0px; border-right:0px; padding:5px;" colspan="7"></td>
                <td style="border:1px solid #000; border-top:0px; padding:5px;"></td>
            </tr>
            <tr>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; border-bottom:0px; padding:5px;" align="center"></td>
                <td style="border:1px solid #000; border-top:0px; border-right:0px; padding:5px;" align="right" colspan="7">Discount Amount</td>
                <?php $discount_amount = $ordercarts['Shoppingcart']['detected_amount'] == '' ? 0 : $ordercarts['Shoppingcart']['detected_amount']; ?>
                <td style="border:1px solid #000; border-top:0px; padding:5px;" align="center"><?php echo indian_number_format($discount_amount) ?></td>
            </tr>
            <tr>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; border-bottom:0px; padding:5px;" align="center"></td>
                <td style="border:1px solid #000; border-top:0px; border-right:0px; padding:5px;" align="right" colspan="7">Making Charge</td>
                <?php $making_charge = $ordercarts['Shoppingcart']['making_charge']; ?>
                <td style="border:1px solid #000; border-top:0px; padding:5px;" align="center"><?php echo indian_number_format($making_charge) ?></td>
            </tr>
            <tr>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;" align="center"></td>
                <td style="border:1px solid #000; border-top:0px; border-right:0px; padding:5px;" align="right" colspan="7">VAT</td>
                <?php $vat = $ordercarts['Shoppingcart']['vat']; ?>
                <td style="border:1px solid #000; border-top:0px; padding:5px;" align="center"><?php echo indian_number_format($vat) ?></td>
            </tr>
            <tr>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;" align="center"></td>
                <td style="border:1px solid #000; border-top:0px; border-right:0px; padding:5px;" colspan="7"></td>
                <td style="border:1px solid #000; border-top:0px; padding:5px;"></td>
            </tr>
            <tr>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;" align="center"></td>
                <?php $suffix = $order_count > 1 ? "($alphas[$o_key])" : '';?>
                <td style="border:1px solid #000; border-top:0px; border-right:0px; padding:5px;" align="right" colspan="7"><strong>Total Price <?php echo $suffix?></strong></td>
                <td style="border:1px solid #000; border-top:0px; padding:5px;" align="center"><strong><?php echo $net_amount = ($gold_amt + $making_charge + $vat) - $discount_amount ?></strong></td>
            </tr>
            <?php
            $net_product_amount += $net_amount;
        }
        ?>
        <!--  -->


        <tr>
            <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;" align="center"></td>
            <?php
            $suffix_all = '';
            if($order_count > 1){
                $imp_range = implode("+", array_slice($alphas, 0, $order_count));
                $suffix_all = "({$imp_range})";
            }
            ?>
            <td style="border:1px solid #000; border-top:0px; border-right:0px; font-size:18px; padding:5px;" align="right" colspan="7"><strong>Total Price (Rs.)<?php echo $suffix_all?></strong></td>
            <td style="border:1px solid #000; border-top:0px; padding:5px; font-size:18px;" align="center"><strong><?php echo $net_product_amount; ?></strong></td>
        </tr>

        <?php
        if (($orderdetails['Order']['cod_status'] == 'PayU') && ($orderdetails['Orderstatus']['order_status'] != 'Pending')) {
            $paid = isset($paymentdetail['Paymentdetails']) ? $paymentdetail['Paymentdetails']['amount'] : 0;
        } elseif (($orderdetails['Order']['cod_status'] == 'COD') && ($orderdetails['Orderstatus']['order_status'] != 'Pending')) {
            $paid = isset($paymentdetail['Paymentdetails']['amount']) ? $paymentdetail['Paymentdetails']['amount'] : 0;
            $balance = $netamount - $orderdetails['Order']['cod_amount'];
        } elseif (($orderdetails['Order']['cod_status'] == 'CHQ/DD') && ($orderdetails['Orderstatus']['order_status'] != 'Pending')) {
            $paid = isset($paymentdetail['Paymentdetails']['amount']) ? $paymentdetail['Paymentdetails']['amount'] : 0;
        }
        if (!empty($paid)) {
            ?>        <tr>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;" align="center"></td>
                <td style="border:1px solid #000; border-top:0px; border-right:0px; padding:5px;" align="right" colspan="7"><strong>Amount Paid by Customer (Rs.)</strong></td>
                <td style="border:1px solid #000; border-top:0px; padding:5px;" align="center"><strong><?php echo $paid; ?></strong></td>
            </tr>
            <?php
        }
        if (($orderdetails['Order']['cod_status'] == 'COD') && ($orderdetails['Orderstatus']['order_status'] != 'Pending') && ($orderdetails['Order']['status'] == 'PartialPaid')) {
            ?>
            <tr>
                <td style="border:1px solid #000; border-right:0px; border-top:0px; padding:5px;" align="center"></td>
                <td style="border:1px solid #000; border-top:0px; border-right:0px; padding:5px;" align="right" colspan="7"><strong>Balance Amount to be collected</strong></td>
                <td style="border:1px solid #000; border-top:0px; padding:5px;" align="center"><strong><?php echo $balance; ?></strong></td>
            </tr>
        <?php } ?>

        <tr>
            <td style="border:1px solid #000; border-top:0px; padding:5px; font-size:11px; font-style:italic;" align="center" colspan="9">This is computer generated invoice.No Signature required.</td>
        </tr>
        <tr>
            <td style="border:1px solid #000; border-top:0px; border-right:0px; padding:5px; font-size:11px; font-style:italic;" colspan="8"><strong>Contact us : 1800  102 2066</strong></td>
            <td style="border:1px solid #000; border-top:0px; border-left:0px; padding:5px; font-size:11px; font-style:italic;">customer.service@shagunn.in</td>
        </tr>
        <tr>
            <td style="border:1px solid #000; border-top:0px; padding:5px; font-size:11px;" colspan="9"><strong>Returns Policy :</strong> At Shagunn we try to deliver perfectly each time.But in the off-chance that you need to return the item, please do so with the original Brand box/price tag, original packing and invoice without which it will be really difficult for us to act on your request.Please help us to helping you. Terms and condition apply.</td>
        </tr>
        <tr>
            <td style="border:1px solid #000; border-top:0px; padding:5px; font-size:11px;" align="center" colspan="9">The goods sold as part of this shipment are intended for end user consumption/retail sale and not for re-sale.</td>
        </tr>
        <tr>
            <td style="border:1px solid #000; border-top:0px; padding:5px; font-size:10px;" colspan="9"><strong>Regd. Office :</strong> Birla Gold and Precious Metals Pvt. Ltd. Morya Landmark II, 2nd Floor,202, New Link Road, Andheri (W), Mumbai - 400053,Maharashtra,India</td>
        </tr>
    </table>
</div>

<pagebreak />

<div style="width:900px; padding:20px; margin:0 auto;">
  <table cellpadding="0" cellspacing="0" width="100%" border="0" style="font-size:12px;">
    <tr>
      <td colspan="2"><strong>Terms &amp; Conditions of sales of products by Birla Gold and Precious Metals Private Limited.</strong></td>
    </tr>
    <tr>
      <td colspan="2" height="15"></td>
    </tr>
    <tr>
      <td width="15">1)</td>
      <td>Any matter/claim/dispute arising out of the transaction will be subject to the Jurisdiction of Mumbai Courts only. </td>
    </tr>
    <tr>
      <td colspan="2" height="15"></td>
    </tr>
    <tr>
      <td valign="top">2)</td>
      <td>All request for further services or exchange of the products or complaints pertaining to the product should be accompanied with the Tax Invoice and valid photo identity of the person making such request/complaint. </td>
    </tr>
    <tr>
      <td colspan="2" height="15"></td>
    </tr>
    <tr>
      <td>3)</td>
      <td>Jewellery Sold by Birla Gold can be exchange at the same showroom for the product of the same value, provided :</td>
    </tr>
    <tr>
      <td colspan="2" height="10"></td>
    </tr>
    <tr>
      <td colspan="2" style="padding-left:30px;"> a) Product is unused. <br />
        b) Product is in the same condition in which it was sold. <br />
        c) Product is returned within 30 days from the date of tax invoice. <br />
        d) Tax Invoice to be produced. <br />
        e) A photo identity of a person is produced. <br />
        f) The product is not tampered with or altered. <br />
        g) No request for cash back shall be entertained. <br /></td>
    </tr>
    <tr>
      <td colspan="2" height="15"></td>
    </tr>
    <tr>
      <td>4)</td>
      <td> No Complaint will be entertrained if :</td>
    </tr>
    <tr>
      <td colspan="2" height="10"></td>
    </tr>
    <tr>
      <td colspan="2" style="padding-left:30px;"> a) The Jewellery is damaged by mishandling. <br />
        b) The Jewellery is altered or repaired by a person not authorized by Birla Gold. <br /></td>
    </tr>
    <tr>
      <td colspan="2" height="15"></td>
    </tr>
    <tr>
      <td>5)</td>
      <td>Birla Gold not be liable or responsible for any indirect or consequential loss or damages.</td>
    </tr>
    <tr>
      <td colspan="2" height="15"></td>
    </tr>
    <tr>
      <td valign="top">6)</td>
      <td>If the payment made by cheque or Demand Draft, the delivery of the item purchases against the bill, will be made only after realization of the amount.</td>
    </tr>
  </table>
</div>
