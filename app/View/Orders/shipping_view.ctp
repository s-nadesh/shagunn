<div class="main">
    <header> &nbsp; </header>
    <div style="clear:both;">&nbsp;</div>

    <!--- New HTML Start -->

    <div id="tabs2" class="tabsDiv ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-collapsible" >
        <div id="" class="tabsDiv">
            <div class="middleContent">
                <h2>View Order</h2>
                <?php
                if ($user['User']['user_type'] == '0') {
                    if ($orderdetails['Order']['cod_status'] == 'PayU') {
                        $in = 'SGN-ON-';
                        $paymentmode = 'Full Payment';
                    } elseif ($orderdetails['Order']['cod_status'] == 'CHQ/DD') {
                        $in = 'SGN-CHQ/DD-';
                        $paymentmode = 'CHQ/DD';
                    } elseif ($orderdetails['Order']['cod_status'] == 'COD') {
                        $in = 'SGN-CD-';
                        $paymentmode = 'Partial Payment';
                    }
                } else {
                    if ($orderdetails['Order']['cod_status'] == 'PayU') {
                        $in = 'SGN-FN-';
                        $paymentmode = 'Full Payment';
                    } elseif ($orderdetails['Order']['cod_status'] == 'COD') {
                        $in = 'SGN-FNCD-';
                        $paymentmode = 'Partial Payment ';
                    } elseif ($orderdetails['Order']['cod_status'] == 'CHQ/DD') {
                        $in = 'SGN-FNCHQ/DD-';
                        $paymentmode = 'CHQ/DD';
                    }
                }
                ?>
                <p> Order No: <strong><?php echo $in . $orderdetails['Order']['invoice']; ?></strong></p>
            </div>
        </div>
        <?php echo $this->Element('vendor_order_header'); ?></td>

        <div id="tabs-1" class="">
            <p></p>
            <div class="account_details" id="account_details">
                <div align="right" style="padding-right:50px;"><?php echo $this->Html->link('Back to User Orders', array('controller' => 'vendors', 'action' => 'user_orders'), array('class' => 'button')); ?></div>   
                <?php
                $shippingdetails = ClassRegistry::init('Order')->find('first', array('conditions' => array('order_id' => $this->params['pass']['0'])));
                $user = ClassRegistry::init('User')->find('first', array('conditions' => array('user_id' => $orderdetails['Order']['user_id'])));
                ?>

                <h2>Shipping details</h2>
                <div style="float:left; width:100%;">
                    <table class="bdrdottTd" width="45%" cellspacing="0" cellpadding="0" border="0">
                        <tr><td width="150"><strong> Shipping Address</strong></td><td>
                                <?php
                                $sbill = h($shippingdetails['Order']['shipping_add']);
                                if (!empty($sbill))
                                    echo $sbill;
                                else
                                    '-';
                                ?>
                            </td></tr>
                        <tr><td width="150"><strong>Shipping Landmark</strong></td><td>
                                <?php
                                $sbillland = h($shippingdetails['Order']['slandmark']);
                                if (!empty($sbillland))
                                    echo $sbillland;
                                else
                                    '-';
                                ?>
                            </td></tr>
                        <tr><td width="150"><strong>Shipping Pincode</strong></td><td>
                                <?php
                                $sbillpin = h($shippingdetails['Order']['spincode']);
                                if (!empty($sbillpin))
                                    echo $sbillpin;
                                else
                                    '-';
                                ?>
                            </td></tr>
                        <tr><td width="150"><strong>Shipping State</strong></td><td>
                                <?php
                                $sbillstate = h($shippingdetails['Order']['sstate']);
                                if (!empty($sbillstate))
                                    echo $sbillstate;
                                else
                                    '-';
                                ?>
                            </td></tr>
                        <tr><td width="150"><strong>Shipping City</strong></td><td>
                                <?php
                                $sbillcity = h($shippingdetails['Order']['scity']);
                                if (!empty($sbillcity))
                                    echo $sbillcity;
                                else
                                    '-';
                                ?>
                            </td></tr>

                    </table>
                </div>

            </div>
        </div>
    </div>
    <div style="clear:both;">&nbsp;</div>



</body>
</html>

