<div class="main">
  <header> &nbsp; </header>
  <div style="clear:both;">&nbsp;</div>
  
  <!--- New HTML Start -->
  
  <div class="productInfoDiv"> 
    <!--<div class="lF"><img src="images/product_top_submenu.png" alt="" /></div>-->
    
    <p align="center"><?php echo $this->Html->image('all-jewellery.jpg'); ?></p>
    <?php
   $counts='';
   $imagecount1=ClassRegistry::init('Productimage')->find('all', array('conditions' => array('status'=>'Active')));
   $counts+=count($imagecount1);
  ?>
    <p align="center"><a style="color:#8d3446;" href="#">View all <!--(<?php echo $counts;?>)--></a></p>
    <div style="clear:both;">&nbsp;</div>
    <div class="shadow"><?php  echo $this->Html->image('shadow.png',array("alt" => "Image")); ?></div>
    <div style="float:left; width:100%;">
    
  <?php 
  $i=0;
    $category = ClassRegistry::init('Category')->find('all', array('conditions' => array('status' =>'Active'),'order'=>'category_id ASC'));
   $length = count($category);
   foreach($category as $categories) {
    $prdav=0;
    $product=ClassRegistry::init('Product')->find('all', array('conditions' => array('category_id' =>$categories['Category']['category_id'],'status'=>'Active'),'limit'=>'7'));
    //echo "<pre>";
    //print_r($product);
       
    ?>
   
        <div class="category_images">
    <?php if(!empty($product)){?> 
      <p align="center"><?php $name=$categories['Category']['category']; echo  strtoupper($name);?></p>
    <?php }?>
        <ul>
        <?php 
    $count='';
     foreach($product as $products) {
      $prdav=1;
        $image=ClassRegistry::init('Productimage')->find('first', array('conditions' => array('product_id' =>$products['Product']['product_id'],'status'=>'Active')));
    
     $imagecount=ClassRegistry::init('Productimage')->find('all', array('conditions' => array('product_id' =>$products['Product']['product_id'],'status'=>'Active')));
      $count+=count($imagecount);
      if(empty($image)) {
      }
     
    ?>
        <?php if(!empty($image) && $count > 0) { ?>
     <li><?php echo $this->Html->link($this->Html->image( 'product/small/'.$image['Productimage']['imagename'],array('border'=>0,'width'=>'100px','height'=>'100')),array('action'=>'product','controller'=>'webpages',$categories['Category']['link']),array('escape'=>false)
       );?></li>
         <?php } } ?>
        </ul>
       
        
        <?php if($count > 0){?>
    <p align="center">
      <a href="<?php echo BASE_URL.$categories['Category']['link'];?>" style="color:#8d3446;">
        <?php echo $count;?> More</a>
          <?php //echo $this->Html->link($count.'  More',array('action'=>'category_list','controller'=>'webpages',$categories['Category']['link']),array('style' => 'color:#8d3446;'));?>
    </p>
    <?php }?>
    
       <!-- <p align="center"><?php echo $count.'  More';?></p>-->
          </div> 
         <?php if ($i != $length - 1 and $prdav) { ?>
      <?php if($count > 0){?>
        <div class="shadow"><?php  echo $this->Html->image('shadow.png',array("alt" => "Image")); ?></div>
      <?php }?>
        <div style="clear:both;"></div>
       <?php }  $i++;
       } ?>
       
     </div>
  </div>