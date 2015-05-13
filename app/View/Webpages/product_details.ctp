<?php //print_r($browse_product);exit;    ?>
<div class="main">
    <header> &nbsp; </header>
    <div style="clear:both;">&nbsp;</div>
    <!--- New HTML Start -->
    <div class="productInfoDiv">
        <div style="clear:both;"></div>
        <div class="productMiddleDeatil">
            <div class="topsubmenudiv">
                <div class="topsubmenu">
                    <ul>
                        <?php
                        $product_name_par = $this->params['pass']['2'];
                        $product = ClassRegistry::init('Product')->find('first', array('conditions' => array('product_id' => $product_name_par)));
                        $sub = ClassRegistry::init('Subcategory')->find('first', array('conditions' => array('subcategory_id' => $product['Product']['subcategory_id'], 'status' => 'Active')));
                        $category = $product_category = ClassRegistry::init('Category')->find('first', array('conditions' => array('category_id' => $sub['Subcategory']['category_id'], 'status' => 'Active')));
                        $code = $category['Category']['category_code'];
                        $pattern = "/(\d+)/";
                        $array = preg_split($pattern, $code, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
                        //print_r($product);exit;
                        ?>
                        <li><?php echo $this->Html->link('Home', array('controller' => 'webpages', 'action' => 'index'), array('escape' => false)); ?></li>
                        <li class="line_img"><?php echo $this->Html->image('line-img.png', array("alt" => "Image")); ?></li>
                        <li><?php echo $this->Html->link('Jewellery', array('controller' => 'webpages', 'action' => 'jewellery'), array('escape' => false)); ?></li>
                        <li class="line_img"><?php echo $this->Html->image('line-img.png', array("alt" => "Image")); ?></li>
                        <li class="category"><a href="<?php echo BASE_URL . str_replace(' ', '_', strtolower($category['Category']['category'])); ?>" class="product"><?php echo $category['Category']['category']; ?></a></li>
                        <li class="line_img"><?php echo $this->Html->image('line-img.png', array("alt" => "Image")); ?></li>            
                        <li class="category"><a class="product"><?php echo $sub['Subcategory']['subcategory']; ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        $product = ClassRegistry::init('Product')->find('first', array('conditions' => array('product_id' => $product_name_par, 'status' => 'Active')));
        $images = ClassRegistry::init('Productimage')->find('first', array('conditions' => array('product_id' => $product['Product']['product_id'], 'status' => 'Active')));
        ?>
        <div class="shadow"><?php echo $this->Html->image("shadow.png", array("alt" => "index")); ?></div>
        <div style="clear:both;">&nbsp;</div>
        <div class="productdetailsMian">
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr>
                    <td valign="top" width="510" style="border-right:1px dotted #666;"><table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                                <td><div class="clearfix" id="content">
                                        <?php $link = BASE_URL . 'img/product/home/' . $images['Productimage']['imagename']; ?>
                                        <?php $image = $images['Productimage']['imagename'];
                                        ?>
                                        <div class="clearfix"><?php
                                            echo $this->Html->link(
                                                    $this->Html->image('product/big/' . $images['Productimage']['imagename'], array("alt" => "Image", 'width' => '400')), $link, array('escape' => false, 'class' => 'jqzoom', 'rel' => 'gal1')
                                            );
                                            ?></div>
                                        <br/>
                                        <div class="clearfix" >
                                            <ul id="thumblist" class="clearfix" >
                                                <?php
                                                $productimages = ClassRegistry::init('Productimage')->find('all', array('conditions' => array('product_id' => $product['Product']['product_id'], 'status' => 'Active'), 'limit' => 4));
                                                foreach ($productimages as $productimage) {
                                                    $imagelink1 = BASE_URL . 'img/product/big/' . $productimage['Productimage']['imagename'];
                                                    $imagelink2 = BASE_URL . 'img/product/home/' . $productimage['Productimage']['imagename'];
                                                    ?>
                                                    <li>
                                                        <a class="zoomThumbActive" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage:'<?php echo $imagelink1; ?>',largeimage:'<?php echo $imagelink2; ?>'}">
                                                            <?php
                                                            echo $this->Html->image('product/small/' . $productimage['Productimage']['imagename'], array("alt" => "Image", 'width' => '120', 'height' => '90'));
                                                            ?></a></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div></td>
                            </tr>
                        </table></td>
                    <?php
                    $metals = ClassRegistry::init('Productmetal')->find('first', array('conditions' => array('product_id' => $product['Product']['product_id'], 'type' => 'Purity')));
                    $diamond = ClassRegistry::init('Productdiamond')->find('first', array('conditions' => array('product_id' => $product['Product']['product_id'])));
                    ?>
                    <td width="40"></td>
                    <td valign="top">
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                                <td colspan="9"><h1 style="color:#a53030;"><?php echo $product['Product']['product_name']; ?></h1></td>
                            </tr>
                            <tr>
                                <td colspan="9">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="9">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="9"><strong>Product code :</strong><?php echo $category['Category']['category_code']; ?><?php echo $product['Product']['product_code']; ?> -
                                    <span class="pcode_purity" ><?php echo $metals['Productmetal']['value']; ?>K<?php ?></span><?php if (!empty($diamond)) { ?><span class="pcode_clarity" ><?php echo $diamond['Productdiamond']['clarity']; ?></span><span class="pcode_stonecolor"><?php echo $diamond['Productdiamond']['color']; ?></span><?php } ?></td>
                            </tr>
                            <tr>
                                <td colspan="9">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="9" class="amt">Rs.<span class="total_amount"><?php echo $product['Product']['total_amount']; ?></span>/-</td>
                            </tr>
                            <tr>
                                <td colspan="9">&nbsp;</td>
                            </tr>
                            <tr class="show_non_gold">
                                <td colspan="9"> You selected :  <strong><span class="pcode_purity" ><?php echo $metals['Productmetal']['value']; ?></span></strong> Gold <?php if (!empty($diamond)) { ?>with Diamond of <strong>clarity <span class="pcode_clarity"><?php echo $diamond['Productdiamond']['clarity']; ?></span></strong> and <strong>color <span class="pcode_stonecolor"><?php echo $diamond['Productdiamond']['color']; ?></span></strong><?php } ?></td>
                            </tr>
                            <tr>
                                <td colspan="9">&nbsp;</td>
                            </tr>
                            <?php
                            foreach ($rating as $rating) {
                                foreach ($rating as $rating) {
                                    $count = $rating['total'] / $reviewcount;
                                    $count = round($count, 2);
                                }
                            }
                            ?>
                            <?php if (in_array($product_category['Category']['category'], array('Gold Coins', 'Gold Coin'))) { ?>
                            <tr>
                                <td colspan="9"><hr /></td>
                            </tr>
                            <tr>
                                <td colspan="9">
                                    <?php
                                    $exp_fineness = explode(',', $product['Product']['metal_fineness']);
                                    $fineness = !empty($exp_fineness) ? " ({$exp_fineness[0]}) " : ' ';
                                    ?>
                                    <strong>Gold Coin In <?php echo $metals['Productmetal']['value'].'K'.$fineness; ?>Yellow Gold</strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="9">&nbsp;</td>
                            </tr>
                            <?php }?>
                            <tr>
                                <td colspan="9"><span class="b-star"><span style="width:<?php
                                        if (!empty($rating)) {
                                            echo $count * 20;
                                        } else {
                                            echo '0';
                                        }
                                        ?>%" class="rstar"></span></span>&nbsp; (<?php
                                                                           if (!empty($reviewcount)) {
                                                                               echo $reviewcount;
                                                                           }
                                                                           ?> Reviews )</td>
                            </tr>
                            <tr>
                                <td colspan="9">&nbsp;</td>
                            </tr>
                            <tr class="show_non_gold">
                                <td align="center"> GOLD <br />
                                    <hr />
                                    <div id="productcode"> <span class="goldprice">N/A</span>/- </div></td>
                                <td width="20" align="center"><?php echo $this->Html->image("icons/plus_icn.png", array("alt" => "index")); ?></td>
                                <?php if (($product['Product']['stone'] === 'Yes')) { ?>
                                    <td align="center"> DIAMOND <br />
                                        <hr />
                                        <div id="productcode"> <span class="diamondprice">N/A</span>/- </div></td>
                                    <td width="20" align="center"><?php echo $this->Html->image("icons/plus_icn.png", array("alt" => "index")); ?></td>
                                <?php } ?>
                                <?php if (($product['Product']['gemstone'] == 'Yes')) { ?>
                                    <td align="center"> GEMSTONE <br />
                                        <hr />
                                        <div id="productcode"> <span class="gemstoneprice">N/A</span>/- </div></td>
                                    <td width="20" align="center"><?php echo $this->Html->image("icons/plus_icn.png", array("alt" => "index")); ?></td>
                                <?php } ?>
                                <td align="center"> MAKING CHARGES <br />
                                    <hr />
                                    <div id="productcode">   <span class="makingcharge">N/A</span>/- </div></td>
                                <td width="20" align="center"><?php echo $this->Html->image("icons/plus_icn.png", array("alt" => "index")); ?></td>
                                <td align="center"> VAT(<?php echo $product['Product']['vat_cst']; ?>%)<br />
                                    <hr />
                                    <div id="productcode">   <span class="vat">N/A</span>/- </div></td>
                                <td width="20"></td>
                                <td><a href="#product" style="font-size:12px; color:#dba715; text-decoration:underline;">VIEW DETAILS</a></td>
                            </tr>
                            <tr class="show_non_gold">
                                <td colspan="9">&nbsp;</td>
                            </tr>
                            <tr class="show_non_gold">
                                <td colspan="9">&nbsp;</td>
                            </tr>
                            <tr class="show_non_gold">
                                <td colspan="9"><hr /></td>
                            </tr>
                            <tr class="show_non_gold">
                                <td colspan="9">&nbsp;</td>
                            </tr>
                            <tr class="show_non_gold">
                                <td colspan="9"><table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tr>
                                            <?php $ids = explode(',', $product['Product']['metal_color']); ?>
                                            <td width="100"><select name="color" id="color">
                                                    <?php
                                                    $i = 0;
                                                    foreach ($ids as $ids) {
                                                        ?>
                                                        <option value="<?php echo $ids; ?>" <?php
                                                        if ($i == 0) {
                                                            echo 'selected="selected"';
                                                        }
                                                        ?>><?php echo $ids; ?></option>
                                                        <?php
                                                        $i++;
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td width="100"></td>
                                            <td><?php
                                                $purity = ClassRegistry::init('Productmetal')->find('all', array('conditions' => array('product_id' => $product['Product']['product_id'], 'type' => 'Purity', 'status' => 'Active'), 'order' => 'value ASC'));
                                                $i = 0;
                                                foreach ($purity as $purity) {
                                                    //$purities=ClassRegistry::init('Purity')->find('first',array('conditions'=>array('purity_id'=>$purity['Productmetal']['purity'])));					   
                                                    ?>
                                                    <input type="radio" name="data[Product][goldpurity]" id="<?php echo $purity['Productmetal']['value']; ?>" class="radio_gold_purity" value="<?php echo $purity['Productmetal']['value']; ?>" <?php echo $i == 0 ? 'checked="checked"' : ''; ?> /><?php echo $purity['Productmetal']['value']; ?>K 
                                                    <?php
                                                    $i++;
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">&nbsp;</td>
                                        </tr>
                                        <?php
                                        $diamonddiv = ClassRegistry::init('Productdiamond')->find('all', array('conditions' => array('product_id' => $product['Product']['product_id']), 'group' => array('clarity', 'color'), 'order' => "FIELD(`clarity`,'SI','VS','VVS'),FIELD(`color`,'IJ','GH','EF')"));
                                        ?>
                                        <tr>
                                            <td align="center"><?php if (!empty($diamonddiv)) { ?>Diamond <?php } ?></td>
                                            <td width="100"></td>
                                            <td><?php
                                                if (!empty($diamonddiv)) {
                                                    // pr( $diamonddiv);exit;
                                                    $i = 0;
                                                    foreach ($diamonddiv as $diamond) {
                                                        echo '<input type="radio" name="data[Product][stone]" id="" class="radio_diamond" value="' . $diamond['Productdiamond']['clarity'] . '-' . $diamond['Productdiamond']['color'] . '" ' . ($i == 0 ? 'checked="checked"' : '') . ' />' . $diamond['Productdiamond']['clarity'] . ' ' . $diamond['Productdiamond']['color'];
                                                        $i++;
                                                    }
                                                }
                                                ?></td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <tr class="show_non_gold">
                                <td colspan="9" id="product">&nbsp;</td>
                            </tr>
                            <tr class="show_non_gold">
                                <td colspan="9"><hr /></td>
                            </tr>
                            <tr class="show_non_gold">
                                <td colspan="9">&nbsp;</td>
                            </tr>
                            <?php
                            $Productmetal = ClassRegistry::init('Productmetal')->find('all', array('conditions' => array('product_id' => $product['Product']['product_id'], 'type' => 'Size', 'status' => 'Active'), 'order' => 'productmetal_id ASC'));
                            if (!empty($Productmetal)) {
                                ?> 
                                <tr class="show_non_gold">
                                    <td colspan="2">
                                        <strong>
                                            <?php if ($category['Category']['category'] == "Rings") {
                                                ?>
                                                Ring 
                                            <?php } elseif ($category['Category']['category'] == "Bangles") { ?>
                                                Bangle
                                            <?php } elseif ($category['Category']['category'] == "Bracelets") { ?>
                                                Bracelet
                                            <?php } elseif ($category['Category']['category'] == "Chains") { ?>
                                                Chain
                                            <?php } ?>
                                            Size :</strong></td>
                                    <td colspan="7">
                                        <select name="size" id="size">
                                            <option value=''>Select one</option>
                                            <?php
                                            $i = 0;
                                            foreach ($Productmetal as $Productmetal) {
                                                if ($category['Category']['category'] != "Bangles") {
                                                    $val = $Productmetal['Productmetal']['value'];
                                                    $st = $Productmetal['Productmetal']['value'];
                                                } else {
                                                    $nt = number_format($Productmetal['Productmetal']['value'], 3, '.', '');
                                                    $size = ClassRegistry::init('Size')->find('first', array('conditions' => array('size_value' => $nt), 'group' => 'size', 'order' => 'size_id ASC'));
                                                    $val = $size['Size']['size'];
                                                    $st = $size['Size']['size_value'];
                                                }
                                                ?>
                                                <option value="<?php echo $st ?>" <?php
                                                if ($i == 0) {
                                                    echo 'selected="selected"';
                                                }
                                                ?>><?php echo $val; ?></option>
                                                        <?php
                                                        $i++;
                                                    }
                                                    ?></select>
                                    </td></tr>
                            <?php } ?>
                            <tr class="show_non_gold">      <td colspan="9">&nbsp;</td></tr>
                            <tr>
                                <td colspan="5"><strong>Expected delivery date to pincode :</strong></td>
                                <td colspan="5" style="margin: 5px;">
                                    <form id="deliveryForm" name="myForm" method="post">
                                        <input placeholder="Enter pincode" name="pincode" type="text" class="validate[required,minSize[6],custom[integer]] pincode" onkeypress="return intnumbers(this, event)" maxlength="6">&nbsp;&nbsp;&nbsp;
                                        <input type="submit" name="update" class="update" value="Update" id="update" /></form>&nbsp;&nbsp;&nbsp;<span class="delivery_date"></span> </td>
                            </tr>
                            <input type="hidden" name="product_id" value="<?php echo $product['Product']['product_id']; ?>" class="product_id"/> 
                            <tr>
                                <td colspan="9">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="9">
                                    <form method="post" action="<?php echo BASE_URL; ?>shoppingcarts/addcart" name="Shopping" class="shoppingdetails">
                                        <div class="cartid"></div>
                                        <input type="hidden" name="data[Shopping][shoppingsubmit]" value="1" />
                                        <button type="submit" value="Submit" class="button" />BUY NOW</button>
                                        &nbsp; or call 1800 102 2066 </td>
                                </form>    
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
            </table>
            <div class="productdescription" style="border-top:3px solid #dba715; padding-top:20px;">
                <div class="productdescriptionleft">
                    <h1>Product Details</h1>
                    <div class="product_div">
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                                <?php
// $metals=ClassRegistry::init('Productmetal')->find('first', array('conditions' => array('product_id' =>$this->params['pass']['0'])));
//$purity=ClassRegistry::init('Purity')->find('first', array('conditions' => array('purity_id' =>$metals['Productmetal']['purity'])));
                                ?>
                                <td width="170">Product Code</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Metal</td>
                                <td> <div id="productcode">
                                        <?php
//$metals=ClassRegistry::init('Productmetal')->find('first', array('conditions' => array('product_id' =>$this->params['pass']['0'])));
//$purity=ClassRegistry::init('Purity')->find('first', array('conditions' => array('purity_id' =>$metals['Productmetal']['purity'])));
                                        ?>
                                        -</div></td>
                            </tr>
                            <tr>
                                <td>Approx Metal Weight</td>
                                <td>-</td>
                            </tr>
                            <tr class="show_non_gold">
                                <td>Approximate Product weight</td>
                                <td><span class="wt"></span> -</td>
                            </tr>
                            <tr>
                                <td>Height</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Width</td>
                                <td>- </td>
                            </tr>
                            <tr><td colspan="2">&nbsp;</td></tr>
                        </table>
                    </div>
                    <div class="diamond_div">
                        <h1>Diamonds Details</h1>
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                                <td width="170">Diamond Weight</td>
                                <td>- </td>
                            </tr>
                            <tr>
                                <td>Diamond Quality</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Setting Type</td>
                                <td>-</td>
                            </tr>
                            <tr><td colspan="2">&nbsp;</td></tr>
                        </table>
                    </div>
                    <div class="gemstone">
                    </div>
                    <?php if (!in_array($category['Category']['category'], array('Gold Coins', 'Gold Coin'))) { ?>
                        <h1>Price Break-up</h1>
                        <div class="price_div">
                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr>
                                    <td colspan="2" style="border-bottom:none;">
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tr>
                                                <td><strong>Component</strong></td>
                                                <td><strong>Rate</strong></td>
                                                <td><strong>Weight</strong></td>
                                                <td><strong>Value</strong></td>
                                            </tr>
                                            <tr>
                                                <td><div id="productcode">-</div></td>
                                                <td><div id="productcode">-</div></td>
                                                <td><div id="productcode">-</div></td>
                                                <td><div id="productcode">-</div></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><strong>Diamonds</strong></td>
                                            </tr>
                                            <tr>
                                                <td><div id="productcode">-</div></td>
                                                <td><div id="productcode">-</div></td>
                                                <td><div id="productcode">-</div></td>
                                                <td><div id="productcode">-</div></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Gemstone</strong></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td><strong>Rs.<div id="productcode"></div></strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Making Charges</strong></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td><strong>Rs.<div id="productcode"></div></strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>VAT</strong></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td><strong>Rs.<div id="productcode">-</div></strong></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    <?php } ?>
                </div>      	
                <div class="productdescriptionright">
                    <!--<div class="slider1">
                              <div class="slide"><a href="#"><img src="images/triumph_thumb1.png"></a></div>
                              <div class="slide"><a href="#"><img src="images/triumph_thumb2.png"></a></div>
                              <div class="slide"><a href="#"><img src="images/triumph_thumb3.png"></a></div>
                              <div class="slide"><a href="#"><img src="images/triumph_thumb1.png"></a></div>
                              <div class="slide"><a href="#"><img src="images/triumph_thumb2.png"></a></div>
                              <div class="slide"><a href="#"><img src="images/triumph_thumb3.png"></a></div>
                            </div>-->
                    <?php if (!empty($product['Product']['certificate_image'])) { ?>
                        <p><?php echo $this->Html->image('certificate/big/' . $product['Product']['certificate_image']); ?></p><?php } ?>
                    <?php
                    $product = ClassRegistry::init('Product')->find('first', array('conditions' => array('product_id' => $product_name_par, 'status' => 'Active')));
                    $category = ClassRegistry::init('Category')->find('first', array('conditions' => array('category_id' => $product['Product']['category_id'], 'status' => 'Active')));
                    $productnew = ClassRegistry::init('Product')->find('all', array('conditions' => array('category_id' => $category['Category']['category_id'], 'status' => 'Active'), 'order' => 'product_id DESC', 'limit' => 12));
                    ?> 
                    <div class="best_seller"><h1>You May Also  Like</h1></div>
                    <div style="clear:both;"></div>  				
                    <div class="slider1">
                        <?php
                        foreach ($productnew as $productnew) {
                            $productimages = ClassRegistry::init('Productimage')->find('first', array('conditions' => array('product_id' => $productnew['Product']['product_id'], 'status' => 'Active')));
                            $imagelink = BASE_URL . 'img/product/small/' . $productimages['Productimage']['imagename'];
                            $category = ClassRegistry::init('Category')->find('first', array('conditions' => array('category_id' => $productnew['Product']['category_id'])));
                            $subcategory = ClassRegistry::init('Subcategory')->find('first', array('conditions' => array('subcategory_id' => $productnew['Product']['subcategory_id'])));
                            $Product_product_name = str_replace(" ", "_", $productnew['Product']['product_name']);
                            ?>
                            <div class="slide">
                                <a href="<?php echo BASE_URL; ?><?php echo $category['Category']['category'] . "/" . $subcategory['Subcategory']['subcategory'] . "/" . $productnew['Product']['product_id'] . "/" . $Product_product_name; ?>"><img src="<?php echo $imagelink; ?>"/></a>
                <!--  <a href="<?php echo BASE_URL; ?>webpages/product_details/<?php echo $productnew['Product']['product_id']; ?>"><?php echo $this->Html->image($imagelink, array('border' => 0, 'alt' => 'logo')); ?></a>--></div>
                        <?php } ?>
                    </div>  
                    <form name="Question" method="POST" id="QuestionForm" action=""> 
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr><td colspan="3">&nbsp; </td></tr>
                            <tr><td colspan="3">&nbsp; </td></tr>
                            <tr>
                                <td><h3>Have a Question?</h3></td>
                                <td>&nbsp;</td>
                                <td align="right"><a href="<?php echo BASE_URL ?>faq-s"><h3>FAQS</h3></a></td>
                            </tr>
                            <tr>
                                <td colspan="3">Call us at 1800 1022 066</td>
                            </tr>
                            <tr><td colspan="3" height="10"></td></tr>
                            <tr>
                                <td width="130">Name</td>
                                <td width="20">:</td>
                                <td><input name="data[Question][name]" type="text" class="validate[required]"></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><input name="data[Question][email]" type="text" class="validate[required,custom[email]]"></td>
                            </tr>
                            <tr>
                                <td>Contact Number</td>
                                <td>:</td>
                                <td><input name="data[Question][contact_no]" type="text" class="validate[required,custom[integer]]"  maxlength="10" onkeypress="return intnumbers(this, event)"></td>
                            </tr>
                            <tr>
                                <td valign="top">Question</td>
                                <td valign="top">:</td>
                                <td><textarea name="data[Question][question]" cols="" rows="" class="validate[required]"></textarea></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><input type="hidden" name="data[Question][questionsubmit]" value="" />
                                    <button type="submit" value="Submit" class="button" />Submit</button></td>
                            </tr>
                        </table>
                    </form>
                </div>      	
            </div>
        </div>
        <div style="clear:both;">&nbsp;</div>
        <div class="shadow"><?php echo $this->Html->image('shadow.png', array('border' => 0, 'alt' => 'logo')); ?></div>
        <div style="clear:both;">&nbsp;</div>
        <div id="tabs2" class="tabsDiv">
            <form name="Rating" method="POST" id="ratingForm" action="">
                <div class="middleContent">
                    <h2>Help others! Write a Product review </h2>
                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                        <tr><td colspan="3">&nbsp;</td></tr>
                        <tr><td colspan="3">Guidelines for writing a product review <strong>All fields are mandatory</strong> </td></tr>
                        <tr><td colspan="3">&nbsp;</td></tr>
                        <tr>
                            <td valign="top" width="160"> Review Title</td>
                            <td valign="top" width="20">:</td>
                            <td><input type="text" name="data[Rating][title]" class="validate[required]"> <br /> <span class="font-size12">Maximum 20 words)</span>  </td>
                        </tr>
                        <tr><td colspan="3" height="10"></td></tr>
                        <tr>
                            <td valign="top"> Your Review</td>
                            <td valign="top">:</td>
                            <td><textarea rows="" cols="" name="data[Rating][comments]" class="validate[required]"></textarea> <br />  <span class="font-size12">(Please make sure your review contains at least 100 characters.)</span> </td>
                        </tr>
                        <tr><td colspan="3" height="10"></td></tr>
                        <tr>
                            <td valign="top"> Your Review</td>
                            <td valign="top">:</td>
                            <td>
                                <?php //echo $this->Html->image('review_icon.png',array('border'=>0,'alt'=>'Rate'));   ?>
                                <div class="stars">
                                    <input type="radio" name="data[Rating][rate]" class="star-1 validate[required]" id="star-1" value="1"  />
                                    <label class="star-1" for="star-1">1</label>
                                    <input type="radio" name="data[Rating][rate]" class="star-2 validate[required]" id="star-2" value="2"  />
                                    <label class="star-2" for="star-2">2</label>
                                    <input type="radio" name="data[Rating][rate]" class="star-3 validate[required]" id="star-3" value="3"  />
                                    <label class="star-3" for="star-3">3</label>
                                    <input type="radio" name="data[Rating][rate]" class="star-4 validate[required]" id="star-4" value="4" />
                                    <label class="star-4" for="star-4">4</label>
                                    <input type="radio" name="data[Rating][rate]" class="star-5 validate[required]" id="star-5" value="5"  />
                                    <label class="star-5" for="star-5">5</label>
                                    <span></span>
                                </div>
                                <span class="font-size12">(Click to rate on scale of 1-5) </span> </td>
                        </tr>
                        <tr><td colspan="3" height="10"></td></tr>
                        <tr>
                            <td valign="top"> Name</td>
                            <td valign="top">:</td>
                            <td><input type="text" name="data[Rating][name]" class="validate[required]"> <br />  <span class="font-size12"> (First and last name)  </span> </td>
                        </tr>
                        <tr><td colspan="3" height="10"></td></tr>
                        <tr>
                            <td valign="top"> Email ID </td>
                            <td valign="top">:</td>
                            <td><input type="text" name="data[Rating][email]" class="validate[required,custom[email]]"></td>
                        </tr>
                        <tr><td colspan="3" height="10"></td></tr>
                        <tr>
                            <td valign="top"> Mobile No.  </td>
                            <td valign="top">:</td>
                            <td><input type="text" name="data[Rating][mobile]" class="validate[required,custom[integer]]" maxlength="10" onkeypress="return intnumbers(this, event)"></td>
                        </tr>
                        <tr><td colspan="3" height="10"></td></tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td> <input type="hidden" name="data[Rating][ratingsubmit]" value="" />
                                <button type="submit" value="Submit" class="button" />Submit</button></td>
                        </tr>
                        <tr><td colspan="3">&nbsp;</td></tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>Have questions regarding this product? Please contact us by clicking <a href="#">here.</a> </td>
                        </tr>
                        <tr><td colspan="3" height="10"></td></tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>Had a great experience buying on Shagunn Or do you think we can do better? Tell us <a href="#">here.</a> </td>
                        </tr>
                        <tr><td colspan="3">&nbsp;</td></tr>
                    </table>
                </div></form>
        </div>
        <div style="clear:both;">&nbsp;</div>
        <div class="shadow"><?php echo $this->Html->image('shadow.png', array('border' => 0, 'alt' => 'logo')); ?></div>
        <div style="clear:both;">&nbsp;</div>
        <div class="best_seller">
            <h2 align="center">What Our Customers Have To Say</h2>
            <table cellpadding="0" cellspacing="0" border="0" width="50%" align="center">
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <?php
                    foreach ($customer as $customer) {
                        ?>
                        <td align="center" width="300"><p><?php echo $this->Html->image('testimonial/' . $customer['Testimonial']['image'], array('border' => 0, 'alt' => 'logo', 'width' => '30%', 'height' => '150px')); ?></p>
                            <p style="color:#51595e;"><i><strong><?php echo $customer['Testimonial']['name']; ?></strong></i></p>
                            <p style="color:#51595e;">" <?php echo $customer['Testimonial']['content']; ?>"</p>
                            <p style="color:#1c5b8f; font-size:12px;"><a href="<?php echo $customer['Testimonial']['facebook_link']; ?>"><?php echo$this->Html->image('icons/fb_icn.png', array('border' => 0, 'alt' => 'logo')); ?> &nbsp;<i><?php echo $customer['Testimonial']['customer_name'] ?></i></a></p></td>   <td width="100"></td>
                    <?php } ?>
                </tr>
            </table>
        </div>
        <?php if (!empty($browse_product)) { ?>
            <div style="clear:both;">&nbsp;</div>
            <div class="shadow"><?php echo $this->Html->image('shadow.png', array('border' => 0, 'alt' => 'logo')); ?></div>
            <div style="clear:both;">&nbsp;</div>
        </div>
        <div class="best_seller">
            <h2 align="center">Recommendations On Your browsing History</h2>
            <div id="slideshowWrapper">
                <ul class="slideshow2">
                    <li style="width: 100%;">
                        <?php
                        //print_r($browse_product);exit;
                        foreach ($browse_product as $browse_product) {
                            $productimg = ClassRegistry::init('Productimage')->find('first', array('conditions' => array('product_id' => $browse_product['Product']['product_id'])));
                            $category = ClassRegistry::init('Category')->find('first', array('conditions' => array('category_id' => $browse_product['Product']['category_id'])));
                            $subcategory = ClassRegistry::init('Subcategory')->find('first', array('conditions' => array('subcategory_id' => $browse_product['Product']['subcategory_id'])));
                            $Product_product_name = str_replace(" ", "_", $browse_product['Product']['product_name']);
                            ?>
                            <div class="best_seller_section best_seller_section2"> 
                                <a href="<?php echo BASE_URL; ?><?php echo $category['Category']['category'] . "/" . $subcategory['Subcategory']['subcategory'] . "/" . $browse_product['Product']['product_id'] . '/' . $Product_product_name; ?>">
                             <!--  <a href="<?php echo BASE_URL; ?>/webpages/product_details/<?php echo $browse_product['Product']['product_id']; ?>">-->
                                    <div class="best_seller_section_menu">
                                        <div class="best_seller_section_menu_img" style="background-image: url(<?php echo BASE_URL; ?>img/product/small/<?php echo $productimg['Productimage']['imagename']; ?>);"></div>
                                        <h4><?php echo $browse_product['Product']['product_name'] ?></h4>
                                        <!--<h3>19,599</h3>-->
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </li>
                </ul>
                <br clear="all" />
            </div>
        </div>
    <?php } ?>
    <div style="clear:both;">&nbsp;</div>
</div>
<script>
    $(document).ready(function () {
        $("#ratingForm").validationEngine();
        $("#QuestionForm").validationEngine();
        $("#deliveryForm").validationEngine();
    });
</script>
<!--<script>
$(document).ready(function(){
        $('.update').click(function() {
                
                var id=$('.pincode').val();
                var product_id=$('.product_id').val();
                $.ajax({
                type: "POST",
                url: "<?php echo BASE_URL; ?>webpages/delivery_date/",
                data: 'id='+id+"&product_id="+product_id,
            dataType: 'json',
                success: function (data) {
           $('.delivery_date').html(data.date);
                }
                });
                
                
        });
        
});
</script>-->
<script>
    $("#deliveryForm").validationEngine('attach', {
        autoHidePrompt: true,
        autoHideDelay: 50000,
        onValidationComplete: function (form, status) {
            if (status == true) {
                var id = $('.pincode').val();
                var product_id = $('.product_id').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo BASE_URL; ?>webpages/delivery_date/",
                    data: 'id=' + id + "&product_id=" + product_id,
                    dataType: 'json',
                    success: function (data) {
                        if (data.status == '200') {
                            $('.delivery_date').html(data.date);
                        } else {
                            $('.delivery_date').html(data.data);
                        }
                    }
                });
                //form.validationEngine('detach');
                //return false;
                //form.submit();			
            }
        }
    });
    $(document).ready(function () {
        calprice();
    });
    $('.radio_gold_purity,.radio_diamond').click(function () {
        calprice();
    });
    $('#size,#color').change(function () {
        calprice();
    });
</script>
<script type="text/javascript">
    function calprice() {
        $('.helpfade').show();
        $('.helptips').show();
        var product_id = $('.product_id').val();
        var size = $('#size').length > 0 ? ($('#size').val() == '' ? $('#size option:last').val() : $('#size').val()) : '';
        var color = $('#color').length > 0 ? $('#color').val() : '';
        var diamond = $('.radio_diamond').length > 0 ? $('.radio_diamond:checked').val() : '';
        $.ajax({
            type: "POST",
            url: "<?php echo BASE_URL; ?>webpages/calculate_price/",
            data: 'customid=' + $('.radio_gold_purity:checked').val() + 'K' + diamond + "&size=" + size + "&gcolor=" + color + "&product_id=" + product_id,
            dataType: 'json',
            success: function (data) {
                $('.pcode_purity').html(data.purity + 'K');
                $('.pcode_clarity').html(data.clarity);
                $('.pcode_stonecolor').html(data.color);
                $('.total_amount').html(data.total);
                $('.goldprice').html(data.gold_price);
                $('.diamondprice').html(data.stone_price);
                $('.makingcharge').html(data.making_charge);
                $('.vat').html(data.vat);
                $('.product_div').html(data.product_details);
                $('.diamond_div').html(data.stonedetails);
                $('.price_div').html(data.pricediv);
                $('.gemstoneprice').html(data.gemstone);
                $('.gemstone').html(data.gemstonediv);
                $('.cartid').html(data.cartdiv);
                $('.wt').html(data.app_wt);
                /*if($('.diamond_div').width() > 490){
                 $('.diamond_div').css({"overflow-y":"hidden","overflow-x":"scroll"})
                 }*/
                //console.log(data);
                $('.helpfade').hide();
                $('.helptips').hide();
            }
        });
    }
</script>
<!--Show if not gold coin - added by prakash-->
<style type="text/css">
<?php if (in_array($product_category['Category']['category'], array('Gold Coins', 'Gold Coin'))) { ?>
        .show_non_gold{
            display: none;
        }
<?php } ?>
.productdetailsMian form {
  margin: 15px 0 0;
}
</style>
