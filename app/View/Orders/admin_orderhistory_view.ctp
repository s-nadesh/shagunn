<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr><td align="right" valign="top" width="230" class="sidepromenu">
            <?php echo $this->Element('admin_order_leftsidebar'); ?></td>
        <td align="left" valign="top">

            <div id="content"  class="clearfix">			
                <div class="container">

                    <div align="right" style="padding-right:50px;">
                        <?php
                        $user = ClassRegistry::init('User')->find('first', array('conditions' => array('user_id' => $orderdetails['Order']['user_id'])));
                        if ($user['User']['user_type'] == '0') {
                            echo $this->Html->link('Back to Vendor Brokerage', array('action' => 'vendors_brokerage'), array('class' => 'button'));
                        } elseif ($user['User']['user_type'] == '1') {
                            echo $this->Html->link('Back to Franchisee Brokerage', array('action' => 'franchisee_brokerage'), array('class' => 'button'));
                        }
                        ?>
                        <?php echo $this->Html->link('Back to Order Details', array('action' => 'order_index'), array('class' => 'button')); ?>
                    </div>   
                    <div class="texttabBox">
                        <form>
                            <fieldset><legend>Order Histroy</legend>

                                <table width="950" align="left">
                                    <thead>
                                    <th width="10" align="left">#</th>
                                    <th width="10" align="left">Status Type</th>
                                    <th width="20" align="left">Date</th>
                                    <th width="15" align="left">Old Status</th>
                                    <th width="15" align="left">New Status</th>
                                    <th width="30" align="left">Remarks</th>
                                    </thead>
                                    <tbody>
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
                                        <?php }else{ ?>
                                                <tr style="text-align: center">
                                                    <td colspan="6">No Order History</td>
                                                </tr>
                                        <?php } ?>
                                    </tbody>
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
