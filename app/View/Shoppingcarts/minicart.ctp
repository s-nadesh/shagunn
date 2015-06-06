<form name="cartform" id="cartform" action="" method="post">
    <table cellpadding="0" border="0" cellspacing="0" width="100%" class="table">
        <tr>
            <th colspan="2" align="left">PRODUCTS DETAILS</th>
            <th>QUANTITY</th>
            <th align="center">PRICE</th>
            <th align="center">&nbsp;</th>
        </tr>
        <?php
        $j = 0;
        $total = 0;
        foreach ($cart_products as $carts) {
            $product = ClassRegistry::init('Product')->find('first', array('conditions' => array('product_id' => $carts['Shoppingcart']['product_id'], 'status' => 'Active')));
            $image = ClassRegistry::init('Productimage')->find('first', array('conditions' => array('product_id' => $carts['Shoppingcart']['product_id'], 'status' => 'Active')));
            $category = ClassRegistry::init('Category')->find('first', array('conditions' => array('category_id' => $product['Product']['category_id'], 'status' => 'Active')));
            $subcategory = ClassRegistry::init('Subcategory')->find('first', array('conditions' => array('subcategory_id' => $product['Product']['subcategory_id'], 'status' => 'Active')));

            if ($carts['Shoppingcart']['size'] == '') {
                $size = 'N/A';
            } else {
                if ($category['Category']['category'] != 'Bangles') {
                    $size = $carts['Shoppingcart']['size'];
                } else {
                    $size = ClassRegistry::init('Size')->find('first', array('conditions' => array('size_value' => $carts['Shoppingcart']['size'], 'status' => 'Active')));
                    $size = $size['Size']['size'];
                    //$size=$carts['Shoppingcart']['size'];
                }
            }
            ?>
            <tr>
                <td valign="top"><a href="<?php echo BASE_URL ?><?php echo $category['Category']['category'] . "/" . $subcategory['Subcategory']['subcategory'] . "/" . $product['Product']['product_id'] . "/" . str_replace(' ', '_', $product['Product']['product_name']); ?>"><?php echo $this->Html->image('product/small/' . $image['Productimage']['imagename'], array("alt" => "index", 'height' => '60')); ?></a></td>
                <td valign="top" ><a style="color:#979797;font-weight:bold;" href="<?php echo BASE_URL ?><?php echo $category['Category']['category'] . "/" . $subcategory['Subcategory']['subcategory_id'] . "/" . $product['Product']['product_id'] . "/" . $product['Product']['product_name'] ?>"><?php echo $product['Product']['product_name']; ?></a></td>
                <td valign="top" class="minicart_qty" data-qty="<?php echo $carts['Shoppingcart']['quantity'] ?>"><?php echo $carts['Shoppingcart']['quantity'] ?>
                    <input type="hidden" name="cartid[<?php echo $j ?>]" class="cartid" value="<?php echo $carts['Shoppingcart']['cart_id']; ?>" />
                    <input type="hidden" name="productid[<?php echo $j ?>]" class="productid" value="<?php echo $carts['Shoppingcart']['product_id']; ?>" /></td>
                <td valign="top">
                    <span >Rs. <?php
                            $total_amt = str_replace(',', '', $carts['Shoppingcart']['total']) * $carts['Shoppingcart']['quantity'];
                            $total+=$total_amt;
                            echo indian_number_format($total_amt);
                            ?></span>/-
                </td>
                <td valign="top">
                    <a style="color:#8d3446;" href="<?php echo BASE_URL ?>shoppingcarts/remove/<?php echo $carts['Shoppingcart']['cart_id'] ?>">Remove</a>
                </td>
            </tr>
            <tr>
                <th colspan="5" style="border-bottom:0px none; padding:0px;">&nbsp;</th>
            </tr>
            <?php $j++; ?>
        <?php } ?>
        <tr>
            <td align="center"><a href="<?php echo BASE_URL; ?>webpages/jewellery">Continue Shopping</a></td>
            <td>&nbsp;</td>
            <td style="font-size:16px;"><strong>Total</strong></td>
            <td style="font-size:16px;"><strong>Rs.<?php echo indian_number_format($total); ?>/-</strong></td>
            <td align="center"><?php
                if ($this->Session->read('User') == '') {
                    $link = BASE_URL . 'signin/index?ref=cart';
                } else {
                    $link = BASE_URL . 'orders/shipping_details';
                }
                ?>
                <a href="<?php echo $link; ?>"> Place Order</a>
            </td>

        </tr>
    </table>
</form>

<script>
    $(document).ready(function () {
        $("#myForm").validationEngine();
    });
</script> 

<script>
    $(document).ready(function () {
        $('.quantity').on('change', function () {
            $('#cartform').submit();
            //alert( this.value );
            /* var qty=$(this).val();
             
             var cartid=$('.cartid').val();
             
             var productamt=$('.productamt').val();
             var productid=$('.productid').val();
             alert(productamt);
             // window.location ='<?php echo BASE_URL; ?>shoppingcarts/qtyprice/'+qty+'/'+cartid+'/'+productamt; // or $(this).val()
             $.ajax({
             type: "POST",
             url: "<?php echo BASE_URL; ?>shoppingcarts/qtyprice",
             data: 'qt=' + qty + '&cartid_t=' + cartid + '&productamt_t=' +productamt + '&pid=' +productid,
             dataType: 'json',
             success: function (msg) {
             find('span').html(msg);
             
             }
             });
             */

        });

    });

</script>