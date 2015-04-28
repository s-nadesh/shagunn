<div class="main">
    <header> &nbsp; </header>
    <div style="clear:both;">&nbsp;</div>
<div id="tabs2" class="tabsDiv ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-collapsible">
<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
<li class="ui-state-default ui-corner-top"><a href="<?php echo BASE_URL;?>orders/personal_details" class="ui-tabs-anchor">PERSONAL DETAILS</a></li>
<li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active"><a class="ui-tabs-anchor" >SHIPPING DETAILS</a></li>
<li class="ui-state-default ui-corner-top"><a  <?php if($this->Session->read('Order')!='') {  echo 'href="'.BASE_URL.'orders/order"'; } ?> class="ui-tabs-anchor">REVIEW ORDER AND PAY</a></li>
</ul>

<div id="tabs-3">
    <p>
 <form action="" method="post" name="Order_details" id="formSubmit">

                    <table cellpadding="0" cellspacing="0" border="0" width="100%">

                        <tr><td height="10"></td></tr>
                        <tr>
                            <td>Shipping Address</td>
                        </tr>
                        <tr><td height="10"></td></tr>

                        <tr>
                            <td><textarea name="data[Order][shipping_add]" cols="" rows="" class="validate[required,[minSize[10]]"><?php  if(!empty($order)) { echo $order['Order']['shipping_add']; } if(!empty($shipping)) { echo $shipping['Shipping']['shipping_address'];  } ?></textarea></td>
                        </tr>
                        <tr>
                            <td>Landmark</td>
                        </tr>
                        <tr><td height="10"></td></tr>
                        <tr>
                            <td><input name="data[Order][slandmark]" type="text" value="<?php  if(!empty($order)) { echo $order['Order']['slandmark']; } if(!empty($shipping)) { echo $shipping['Shipping']['shipping_landmark'];  } else {  echo ''; }?>" /></td>
                        </tr>
 <tr>
                            <td>Pincode</td>
                        </tr>
                        <tr><td height="10"></td></tr>

                        <tr>
                            <td><input name="data[Order][spincode]" type="text" class="validate[required,custom[integer],[minSize[6]] spincode" onkeypress="return intnumbers(this, event)" value="<?php  if(!empty($order)) { echo $order['Order']['spincode']; } if(!empty($shipping)) { echo $shipping['Shipping']['shipping_pincode'];  }else { echo ''; }?>" maxlength="6"></td>
                        </tr>

                        <tr><td height="10"></td></tr>
                        <tr>
                            <td>City</td>
                        </tr>
                        <tr><td height="10"></td></tr>

                        <tr>
                            <td><input name="data[Order][scity]" type="text" class="validate[required]"  value="<?php  if(!empty($order)) { echo $order['Order']['scity']; } if(!empty($shipping)) { echo $shipping['Shipping']['shipping_city'];  }else { echo ''; }?>"></td>
                        </tr>

                        <tr><td height="10"></td></tr>
                        <tr>
                            <td>State</td>
                        </tr>
                        <tr><td height="10"></td></tr>

                        <tr>
                            <td><input name="data[Order][sstate]" type="text" class="validate[required]" value="<?php  if(!empty($order)) { echo $order['Order']['sstate']; } if(!empty($shipping)) { echo $shipping['Shipping']['shipping_state'];  }else { echo ''; }?>"></td>
                        </tr>
                        

                        <tr><td height="10"></td></tr>
                        <tr>
                            <td>Billing Address</td>
                        </tr>
                        <tr><td height="10"></td></tr>

                        <tr>
                            <td><textarea name="data[Order][billing_add]" cols="" rows="" class="validate[required,[minSize[10]]"><?php  if(!empty($order)) { echo $order['Order']['billing_add']; } if(!empty($shipping)) { echo $shipping['Shipping']['billing_address'];  } else {  echo ''; }?></textarea></td>
                        </tr>

                        <tr><td height="10"></td></tr>
                        <tr>
                            <td>Landmark</td>
                        </tr>
                        <tr><td height="10"></td></tr>

                        <tr>
                            <td><input name="data[Order][blandmark]" type="text" class="validate[required]" value="<?php  if(!empty($order)) { echo $order['Order']['blandmark']; } if(!empty($shipping)) { echo $shipping['Shipping']['billing_landmark'];  }else {  echo ''; }?>" /></td>
                        </tr>

                        <tr><td height="10"></td></tr>


                        <tr>
                            <td>Pincode</td>
                        </tr>
                        <tr><td height="10"></td></tr>

                        <tr>
                            <td><input name="data[Order][pincode]" type="text" class="validate[required,custom[integer],[minSize[6]] pincode" onkeypress="return intnumbers(this, event)" value="<?php  if(!empty($order)) { echo $order['Order']['pincode']; } if(!empty($shipping)) { echo $shipping['Shipping']['pincode'];  }else { echo ''; }?>" maxlength="6"></td>
                        </tr>

                        <tr><td height="10"></td></tr>
                        <tr>
                            <td>City</td>
                        </tr>
                        <tr><td height="10"></td></tr>

                        <tr>
                            <td><input name="data[Order][city]" type="text" class="validate[required]"  value="<?php  if(!empty($order)) { echo $order['Order']['city']; } if(!empty($shipping)) { echo $shipping['Shipping']['city'];  }else { echo ''; }?>"></td>
                        </tr>

                        <tr><td height="10"></td></tr>
                        <tr>
                            <td>State</td>
                        </tr>
                        <tr><td height="10"></td></tr>

                        <tr>
                            <td><input name="data[Order][state]" type="text" class="validate[required]" value="<?php  if(!empty($order)) { echo $order['Order']['state']; } if(!empty($shipping)) { echo $shipping['Shipping']['state'];  }else { echo ''; }?>"></td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>

                        <tr>
                            <td> <input type="submit" class="button" id="nextBtn" value="Submit" /></td>
                        </tr>

                    </table>
                </form>
    </p>
</div>
</div>
<script>
        $(document).ready(function () {
         $("#formSubmit").validationEngine();

        });
    </script>