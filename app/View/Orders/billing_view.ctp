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
                $billingdetails = ClassRegistry::init('Order')->find('first', array('conditions' => array('order_id' => $this->params['pass']['0'])));
                $user = ClassRegistry::init('User')->find('first', array('conditions' => array('user_id' => $orderdetails['Order']['user_id'])));
                ?>

                <h2>Billing details</h2>
                <div style="float:left; width:100%;">
                    <table class="bdrdottTd" width="45%" cellspacing="0" cellpadding="0" border="0">
                        <tr><td width="150"><strong> Billing Address</strong></td><td>
                                <?php
                                    $bill = h($billingdetails['Order']['billing_add']);
                                    if (!empty($bill))
                                        echo $bill;
                                    else
                                        '-';
                                    ?>
                            </td></tr>
                        <tr><td width="150"><strong> Billing Landmark</strong></td><td>
                                <?php
                                    $billland = h($billingdetails['Order']['blandmark']);
                                    if (!empty($billland))
                                        echo $billland;
                                    else
                                        '-';
                                    ?>
                            </td></tr>
                        <tr><td width="150"><strong> Billing Pincode</strong></td><td>
                                <?php
                                    $billpin = h($billingdetails['Order']['pincode']);
                                    if (!empty($billpin))
                                        echo $billpin;
                                    else
                                        '-';
                                    ?>
                            </td></tr>
                        <tr><td width="150"><strong> Billing State</strong></td><td>
                                <?php
                                    $billstate = h($billingdetails['Order']['state']);
                                    if (!empty($billstate))
                                        echo $billstate;
                                    else
                                        '-';
                                    ?>
                            </td></tr>
                        <tr><td width="150"><strong> Billing City</strong></td><td>
                                <?php
                                    $billcity = h($billingdetails['Order']['city']);
                                    if (!empty($billcity))
                                        echo $billcity;
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

