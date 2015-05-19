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

                <h2>User details</h2>
                <div style="float:left; width:100%;">
                    <table class="bdrdottTd" width="45%" cellspacing="0" cellpadding="0" border="0">
                        <tr><td width="150"><strong>Type</strong></td>                    
                            <td><?php
                                    if ($user['User']['user_type'] == '0') {
                                        echo 'User';
                                    } elseif ($user['User']['user_type'] == '1') {
                                        echo 'Franchisee';
                                    }
                                    ?></td></tr>

                        <tr><td width="150"><strong>First Name</strong></td>                    
                            <td><?php
                                    $firstname = h($user['User']['first_name']);
                                    if (!empty($firstname))
                                        echo $firstname;
                                    else
                                        '-';
                                    ?></td></tr>
                        <tr><td width="150"><strong>Last Name</strong></td>                    
                            <td><?php
                                    $lastname = h($user['User']['last_name']);
                                    if (!empty($lastname))
                                        echo $lastname;
                                    else
                                        '-';
                                    ?></td></tr>

                        <tr><td width="150"><strong>Date of Birth</strong></td>                    
                            <td><?php
                                    $dobf = h($user['User']['date_of_birth']);
                                    $dob = date("Y-m-d", strtotime($dobf));
                                    if (!empty($dob))
                                        echo $dob;
                                    else
                                        '-';
                                    ?></td></tr>

                        <tr><td width="150"><strong>Email</strong></td>                    
                            <td><?php
                                    $email = h($user['User']['email']);
                                    if (!empty($email))
                                        echo $email;
                                    else
                                        '-';
                                    ?></td></tr>

                        <tr><td width="150"><strong>Phone Number</strong></td>                    
                            <td><?php
                                    $phone = h($user['User']['phone_no']);
                                    if (!empty($phone))
                                        echo $phone;
                                    else
                                        '-';
                                    ?></td></tr>

                    </table>
                </div>

            </div>
        </div>
    </div>
    <div style="clear:both;">&nbsp;</div>



</body>
</html>

