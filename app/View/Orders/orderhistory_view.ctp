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
                <?php $user = ClassRegistry::init('User')->find('first', array('conditions' => array('user_id' => $orderdetails['Order']['user_id']))); ?>

                <h2>Order History</h2>
                <div style="float:left; width:100%;">
                    <table class="myOrder" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                        <th width="10">#</th>
                        <th width="10">Status Type</th>
                        <th width="20">Date</th>
                        <th width="15">Old Status</th>
                        <th width="15">New Status</th>
                        <th width="30">Remarks</th>
                        </tr>
                            <?php if (!empty($orderhistory)) { ?>
                                <?php foreach ($orderhistory as $key => $history) { ?>
                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo ucfirst($history['Orderhistory']['status_type']) ?></td>
                                        <td><?php echo $history['Orderhistory']['date'] ?></td>
                                        <td><?php echo $history['Oldorderstatus']['order_status']; ?></td>
                                        <td><?php echo $history['Neworderstatus']['order_status'] ?></td>
                                        <td><?php echo $history['Orderhistory']['remarks'] ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="6" style="text-align:center">No Order History</td>
                                </tr>
                            <?php } ?>
                    </table>

                </div>

            </div>
        </div>
    </div>
    <div style="clear:both;">&nbsp;</div>



</body>
</html>

