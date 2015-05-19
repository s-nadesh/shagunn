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

                <h2>CHQ/DD  Details</h2>
                <div style="float:left; width:100%;">
                    <table class="myOrder" width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tr><td width="200" valign="top"><strong> Cheque / Demand Draft Number</strong></td><td>
                                <p><dd><input type="text" name="data[Paymentdetails][chq/dd]" id=""  class="validate[required]" size="50" 
                                      value="<?php
                                      if (empty($paymentaldetails['Paymentdetails']['chq/dd'])) {
                                          echo '';
                                      } else {
                                          echo $paymentaldetails['Paymentdetails']['chq/dd'];
                                      }
                                      ?>"/></dd></p>
                        </td></tr>
                        <tr><td width="200"  valign="top"><strong>Bank Name </strong></td><td>
                                <p><dd><input type="text" name="data[Paymentdetails][bankname]" id=""  class="validate[required]" size="50"
                                      value="<?php
                                      if (empty($paymentaldetails['Paymentdetails']['bankname'])) {
                                          echo '';
                                      } else {
                                          echo $paymentaldetails['Paymentdetails']['bankname'];
                                      }
                                      ?>"/></dd></p>
                        </td></tr>
                        <tr><td width="200"  valign="top"><strong> Bank  Branch</strong></td><td>
                                <p><dd><input type="text" name="data[Paymentdetails][bankbranch]" id=""  class="validate[required]" size="50"
                                      value="<?php
                                      if (empty($paymentaldetails['Paymentdetails']['bankbranch'])) {
                                          echo '';
                                      } else {
                                          echo $paymentaldetails['Paymentdetails']['bankbranch'];
                                      }
                                      ?>"/></dd></p>
                        </td></tr>
                        <tr><td width="200"  valign="top"><strong> Amount</strong></td><td>
                                <p><dd><input type="text" name="data[Paymentdetails][amount]" id=""  class="validate[required,custom[number]]" size="50"
                                      value="<?php
                                      if (empty($paymentaldetails['Paymentdetails']['amount'])) {
                                          echo '';
                                      } else {
                                          echo $paymentaldetails['Paymentdetails']['amount'];
                                      }
                                      ?>"/></dd></p>
                        </td></tr>

                        <tr><td colspan="2" align="center">
                                <input type="hidden" name="data[Paymentdetails][chkdd]" id=""  value="0" size="50"/>
                                <button type="submit"  class="button " name="data[Paymentdetails][chkdd]" value="">Submit</button></td></tr>
                    </table>

                </div>

            </div>
        </div>
    </div>
    <div style="clear:both;">&nbsp;</div>



</body>
</html>

