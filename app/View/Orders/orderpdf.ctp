<?php
$orderinvoice = ClassRegistry::init('Order')->find('first', array('conditions' => array('order_id' => $orderdetails['Order']['order_id'])));
$ordercartamount = ClassRegistry::init('Shoppingcart')->find('first', array('conditions' => array('order_id' => $orderdetails['Order']['order_id']), 'fields' => array('SUM(total) AS totamount', 'sum(detected_amount) as discountamount', 'sum(total_amount) as originalamount', 'is_coupon_used', 'quantity', 'cart_id')));
$paymentdetail = ClassRegistry::init('Paymentdetails')->find('first', array('conditions' => array('order_id' => $orderdetails['Order']['order_id'])));
$user = ClassRegistry::init('User')->find('first', array('conditions' => array('user_id' => $orderdetails['Order']['user_id'])));
?>
<style type="text/css">
    .invoice_table {
        border:#ccc solid 1px;
        border-collapse:collapse;
        font-family:Arial, Helvetica, sans-serif;
        font-size:13px;
    }
    .invoice_table td {
        border:#ccc solid 1px;
        border-collapse:collapse;
        padding:5px;
    }
</style>
<table cellspacing="0" cellpadding="0" class="invoice_table" width="500">
    <tr>
        <td colspan="7" align="left" valign="top">
            <?php echo $this->Html->image("icons/logo.png", array('style' => 'float: left; height: 100px; background-repeat: no-repeat')) ?>
        </td>
        <td colspan="3" rowspan="3">
            <p><strong>Birla Gold and Precious Metals Pvt Ltd</strong></p>
            <p><strong>Morya Landmark II, 2nd Floor 202,</strong></p>
            <p><strong>New Link Road, Andheri (West)</strong></p>
            <p><strong>Mumbai 400053</strong></p>
        </td>
    </tr>
    <tr>
        <td colspan="7" align="center"><h2><strong>TAX INVOICE</strong></h2></td>
    </tr>
    <tr>
        <td colspan="7" align="center" valign="top"><strong>Inoive No: #<?php echo $in . $orderinvoice['Order']['invoice']; ?></strong></td>
    </tr>
    <tr>
        <td colspan="4">&nbsp;</td>
        <td colspan="3"><strong>Billing Address</strong></td>
        <td colspan="3"><strong>Shipping Address</strong></td>
    </tr>
    <tr>
        <td colspan="4">
            <p>Order No.:<?php echo $in . $orderinvoice['Order']['invoice']; ?></p>
            <?php
            $dtt = h($orderdetails['Order']['created_date']);
            $ndtt = date("d-M-Y", strtotime($dtt));
            if (empty($ndtt))
                $ndtt = '-';
            ?>
            <p>Order Date: <?php echo $ndtt; ?></p>
            <p>Invoice Date: <?php echo $ndtt; ?></p>
            <p>VAT/TIN: 123456789011</p>
            <p>Service Tax:    ABCDE1123FSD001</p></td>
        <td colspan="3">
            <?php $shippingdetails = ClassRegistry::init('Order')->find('first', array('conditions' => array('order_id' => $this->params['pass']['0']))); ?>
            <p>
                <?php
                $sbill = h($shippingdetails['Order']['billing_add']);
                if (!empty($sbill))
                    echo "<strong>$sbill</strong>";
                else
                    '-';
                ?>
            </p>
            <p>
                <?php
                $sbillland = h($shippingdetails['Order']['blandmark']);
                if (!empty($sbillland))
                    echo $sbillland;
                else
                    '-';
                ?>
            </p>
            <p>
                <?php
                $sbillcity = h($shippingdetails['Order']['city']);
                if (!empty($sbillcity))
                    echo $sbillcity . ' - ';
                else
                    '-';
                $sbillpin = h($shippingdetails['Order']['pincode']);
                if (!empty($sbillpin))
                    echo $sbillpin;
                ?>
            </p>
            <p>
                <?php
                $sbillstate = h($shippingdetails['Order']['state']);
                if (!empty($sbillstate))
                    echo $sbillstate;
                else
                    '-';
                ?>
            </p>
        </td>
        <td colspan="3">
            <p>
                <?php
                $sbill = h($shippingdetails['Order']['shipping_add']);
                if (!empty($sbill))
                    echo "<strong>$sbill</strong>";
                else
                    '-';
                ?>
            </p>
            <p>
                <?php
                $sbillland = h($shippingdetails['Order']['slandmark']);
                if (!empty($sbillland))
                    echo $sbillland;
                else
                    '-';
                ?>
            </p>
            <p>
                <?php
                $sbillcity = h($shippingdetails['Order']['scity']);
                if (!empty($sbillcity))
                    echo $sbillcity . ' - ';
                else
                    '-';
                $sbillpin = h($shippingdetails['Order']['spincode']);
                if (!empty($sbillpin))
                    echo $sbillpin;
                ?>
            </p>
            <p>
                <?php
                $sbillstate = h($shippingdetails['Order']['sstate']);
                if (!empty($sbillstate))
                    echo $sbillstate;
                else
                    '-';
                ?>
            </p>
        </td>
    </tr>
    <tr>
        <td rowspan="2" colspan="2" width="150"><strong>Product Description</strong></td>
        <td colspan="2" align="center"><strong>Metals Details</strong></td>
        <td colspan="2" align="center"><strong>Dimoand Details</strong></td>
        <td colspan="2" align="center"><strong>Stone Details</strong></td>
        <td align="center"><strong>Quantity</strong></td>
        <td align="center"><strong>Product Price</strong></td>
    </tr>
    <tr>
        <td ><strong>Weight</strong></td>
        <td ><strong>Amount</strong></td>
        <td ><strong>Weight</strong></td>
        <td ><strong>Amount</strong></td>
        <td ><strong>Weight</strong></td>
        <td ><strong>Amount</strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <?php
    $k = 1;
    $ordercart = ClassRegistry::init('Shoppingcart')->find('all', array('conditions' => array('order_id' => $orderdetails['Order']['order_id'])));

    $net_product_amount = 0;
    foreach ($ordercart as $ordercarts) {
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
        ?>

        <tr>
            <?php
            $product_name = $productdetails['Product']['product_name'];
            $product_name .= " {$ordercarts['Shoppingcart']['purity']}K Gold";
            $product_name .= $stone_wght > 0 ? " With Diamond" : "";
            $product_name .= " {$ordercarts['Shoppingcart']['clarity']}-{$ordercarts['Shoppingcart']['color']}";
            $product_name .= $gem_names != '' ? " & {$gem_names}" : "";
            ?>
            <td colspan="2" rowspan="7"><strong><?php echo $product_name ?></strong></td>
            <td align="center"><?php echo $ordercarts['Shoppingcart']['weight']; ?></td>
            <td align="center"><?php echo $ordercarts['Shoppingcart']['goldamount'] ?></td>
            <td align="center"><?php echo $stone_wght ?></td>
            <td align="center"><?php echo $ordercarts['Shoppingcart']['stoneamount']; ?></td>
            <td align="center"><?php echo $gem_wght; ?></td>
            <td align="center"><?php echo $ordercarts['Shoppingcart']['gemstoneamount']; ?></td>
            <td align="center"><?php echo $ordercarts['Shoppingcart']['quantity'] ?></td>
            <td align="center"><?php echo $gold_amt = $ordercarts['Shoppingcart']['goldamount'] + $ordercarts['Shoppingcart']['stoneamount'] + $ordercarts['Shoppingcart']['gemstoneamount'] ?></td>
        </tr>
        <tr>
            <td colspan="7"></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="7" align="right"><strong>Discount Amount</strong></td>
            <td align="center"><?php echo $discount_amount = $ordercarts['Shoppingcart']['detected_amount'] == '' ? 0 : $ordercarts['Shoppingcart']['detected_amount']; ?></td>
        </tr>
        <tr>
            <td colspan="7" align="right"><strong>Making Charge</strong></td>
            <td align="center"><?php echo $making_charge = $ordercarts['Shoppingcart']['making_charge']; ?></td>
        </tr>
        <tr>
            <td colspan="7" align="right"><strong>VAT</strong></td>
            <td align="center"><?php echo $vat = $ordercarts['Shoppingcart']['vat']; ?></td>
        </tr>
        <tr>
            <td colspan="7" align="right"><strong> Total Price</strong></td>
            <td align="center"><strong><?php echo $net_amount = ($gold_amt + $making_charge + $vat) - $discount_amount ?></strong></td>
        </tr>
        <tr>
            <td colspan="8">&nbsp;</td>
        </tr>
        <?php
        $net_product_amount += $net_amount;
    }
    ?>

    <tr>
        <td colspan="9" align="right"><h2><strong>Total Price (Rs.)</strong></h2></td>
        <td align="center"><h2><strong><?php echo $net_product_amount; ?></strong></h2></td>
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
        ?>
        <tr>
            <td colspan="9" align="right"><h2><strong>Amount Paid by Customer (Rs.)</strong></h2></td>
            <td align="center"><h2><strong><?php echo $paid; ?></strong></h2></td>
        </tr>
    <?php }
    if (($orderdetails['Order']['cod_status'] == 'COD') && ($orderdetails['Orderstatus']['order_status'] != 'Pending') && ($orderdetails['Order']['status'] == 'PartialPaid')) {
        ?>
        <tr>
            <td colspan="9" align="right"><h2><strong>Balance Amount to be collected</strong></h2></td>
            <td align="center"><h2><strong><?php echo $balance; ?></strong></h2></td>
        </tr>
<?php } ?>

    <tr>
        <td colspan="10" align="center">This is computer generated invoice. No Signature required.</td>
    </tr>
    <tr style="height: 100px;">
        <td colspan="10">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="5">
            <em style="text-align: left">Contact us : 1800 102 2066</em>
        </td>
        <td colspan="5" align="right">
            <a href="mailto:customer.service@shagunn.in">customer.service@shagunn.in</a>
        </td>
    </tr>
    <tr>
        <td colspan="10"><strong><em>Returns Policy :</em></strong><em> At Shagunn we try to deliver perfectly each time.But in the off-chance that    you need to return the item, please do so with the original Brand box/price    tag, original packing and invoice without which it will be really difficult    for us to act on your request.Please help us to helping you. Terms and    condition apply.</em></td>
    </tr>
    <tr>
        <td colspan="10">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="10" align="center"><em>The goods sold as part of this shipment are intended for end    user consumption/retail sale and not for re-sale.</em></td>
    </tr>
    <tr>
        <td colspan="10"><strong><em>Regd. Office : </em></strong><em>Birla Gold and Precious Metals Pvt. Ltd. Morya Landmark II, 2nd Floor,202,    New Link Road, Andheri (W), Mumbai - 400053,Maharashtra,India</em></td>
    </tr>

</table>