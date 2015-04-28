<div class="main">
  <header> &nbsp; </header>
  <div class="banner_slide">
    <ul id="demo1">
     <?php foreach($banner as $banners) { ?>
      <li>
      <?php 
	   if(!empty($banners)){
	   if($banners['Banner']['image'] != NULL){
					 echo $this->Html->image('banner/'.$banners['Banner']['image'],array("alt" => "Banner")); ?>
    <?php }} if(empty($banners)) {
                     echo $this->Html->image('icons/slide1_new.png',array('border'=>0,'alt'=>'logo') ); }?>
           <div class="slide-desc">
          <h2><?php echo $banners['Banner']['title'];?></h2>
          <p><?php echo $banners['Banner']['description'];?><br>
            <a class="more" href="<?php echo $banners['Banner']['link'];?>">more</a></p>
        </div>
      </li>
        <?php } ?>
    </ul>
  </div>
</div>
<div class="main"><form name="searchlist" id="explore_form" method="get"  action="<?php echo BASE_URL;?>product" >
  <div class="filter">
  
  <?php $category=ClassRegistry::init('Category')->find('all',array('conditions'=>array('status'=>'Active'),'order'=>'category_id ASC')); ?>
    <select name="category" id="explore_cat" class="select-category validate[groupRequired[payments]]">
   <option value="">Choose Category </option>
   <?php foreach($category as $categories){?>
   <option value="<?php echo str_replace(' ','_',strtolower($categories['Category']['category']));?>"><?php echo $categories['Category']['category']?> </option>
  
<?php }?>   
     </select>
     
     
    
    <select name="jewellery" id="explore_jewellery" class="select-type  validate[groupRequired[payments]]">
   <option value="" >Choose Type</option>
   <option value="diamond">Diamond Jewellery</option>
   <option value="plain_gold">Plain Gold Jewellery</option>
   <option value="gemstone">Gemstone Jewellery</option>
     </select>
         
  <?php $gemstone=ClassRegistry::init('Gemstone')->find('all',array('conditions'=>array('status'=>'Active'),'order'=>'stone'))?>
    <select name="gemstone" id="explore_gemstone" class="select-stones  validate[groupRequired[payments]]">
   <option value="">Choose Stones</option>
   <?php foreach($gemstone as $gemstonedetails){?>
   <option value="<?php echo $gemstonedetails['Gemstone']['stone']?>"> <?php echo $gemstonedetails['Gemstone']['stone']?></option>
   <?}?>
    </select>
     
 <select name="price" id="explore_jewellery" class="select-price  validate[groupRequired[payments]]">
       <option value="">Choose Price</option>
       <option value="1">Below Rs. 10,000</option>
       <option value="2">Rs. 10,000 - Rs. 20,000</option>
       <option value="3">Rs. 20,000 - Rs. 30,000 </option>
       <option value="4">Rs. 30,000 - Rs. 40,000</option>
       <option value="5">Rs. 40,000 - Rs. 50,000</option>
       <option value="6">Rs. 50,000 and Above</option>
 </select> 
 <input name="searchitems" value="EXPLORE NOW" type="submit">
     </div></form>
     <script>
    $(document).ready(function(){
    	$("#explore_form").validationEngine();
	 
    });
</script>
  <div style="clear:both;">&nbsp;</div>
  <div class="shadow"> <?php echo  $this->Html->image("shadow.png",array("alt" => "index")); ?></div>
    <?php
	
	
	
	
	$collection_type_ech=ClassRegistry::init('Product')->find('first',array('conditions'=>array('FIND_IN_SET(1,Product.collection_type)','status'=>'Active')));
   $collectiontype_val_name1=ClassRegistry::init('Collectiontype')->find('first',array('conditions'=>array('collectiontype_id'=>'1')));
   
   
    $collection_type_sap=ClassRegistry::init('Product')->find('first',array('conditions'=>array('FIND_IN_SET(2,Product.collection_type)','status'=>'Active')));
	 $collectiontype_val_name2=ClassRegistry::init('Collectiontype')->find('first',array('conditions'=>array('collectiontype_id'=>'2')));
	
    $collection_type_emr=ClassRegistry::init('Product')->find('first',array('conditions'=>array('FIND_IN_SET(3,Product.collection_type)','status'=>'Active')));
	 $collectiontype_val_name3=ClassRegistry::init('Collectiontype')->find('first',array('conditions'=>array('collectiontype_id'=>'3')));
	
    $collection_type_bel=ClassRegistry::init('Product')->find('first',array('conditions'=>array('FIND_IN_SET(4,Product.collection_type)','status'=>'Active')));
	 $collectiontype_val_name4=ClassRegistry::init('Collectiontype')->find('first',array('conditions'=>array('collectiontype_id'=>'4')));
	
    $collection_type_ship=ClassRegistry::init('Product')->find('first',array('conditions'=>array('FIND_IN_SET(5,Product.collection_type)','status'=>'Active')));
	 $collectiontype_val_name5=ClassRegistry::init('Collectiontype')->find('first',array('conditions'=>array('collectiontype_id'=>'5')));
  
    
    if(!empty($collection_type_bel) || !empty($collection_type_ech) || !empty($collection_type_emr) || !empty($collection_type_sap) || !empty($collection_type_ship)){
    
   ?>
  <div class="products">
    <div class="products1">
  
      <ul>
      <?php if(!empty($collection_type_ech)){
		   $collection_type_ech_img=ClassRegistry::init('Productimage')->find('first', array('conditions' => array('product_id' =>$collection_type_ech['Product']['product_id'])));
		  ?>
        <a href="<?php echo BASE_URL;?>product?collection=<?php echo str_replace(' ','_',strtolower(trim($collectiontype_val_name1['Collectiontype']['collection_name'])));?>">
        <li>
          <div class="products_top" style="background-image: url(<?php echo  BASE_URL; ?>img/product/small/<?php echo $collection_type_ech_img['Productimage']['imagename']?>)"; ></div>
          <div class="products_bottom">
            <h2><?php echo $collectiontype_val_name1['Collectiontype']['collection_name']?></h2>
          </div>
        </li>
        
        </a><?php }?> 
         <?php if(!empty($collection_type_sap)){
			$collection_type_sap_img=ClassRegistry::init('Productimage')->find('first', array('conditions' => array('product_id' =>$collection_type_sap['Product']['product_id']))); 
			 ?><a href="<?php echo BASE_URL;?>product?collection=<?php echo str_replace(' ','_',strtolower(trim($collectiontype_val_name2['Collectiontype']['collection_name'])));?>">
        <li>
          <div class="products_top" style="background-image: url(<?php echo  BASE_URL; ?>img/product/small/<?php echo $collection_type_sap_img['Productimage']['imagename']?>)";></div>
          <div class="products_bottom">
            <h2><?php echo $collectiontype_val_name2['Collectiontype']['collection_name']?></h2>
          </div>
        </li>
        </a><?php }?> 
         <?php if(!empty($collection_type_emr)){
			 $collection_type_emr_img=ClassRegistry::init('Productimage')->find('first', array('conditions' => array('product_id' =>$collection_type_emr['Product']['product_id'])));
			 ?> <a href="<?php echo BASE_URL;?>product?collection=<?php echo str_replace(' ','_',strtolower(trim($collectiontype_val_name3['Collectiontype']['collection_name'])));?>">
        <li>
          <div class="products_top" style="background-image: url(<?php echo  BASE_URL; ?>img/product/small/<?php echo $collection_type_emr_img['Productimage']['imagename']?>)";></div>
          <div class="products_bottom">
            <h2><?php echo $collectiontype_val_name3['Collectiontype']['collection_name']?></h2>
          </div>
        </li>
        </a><?php }?> 
       
      </ul>
    </div>
    <div class="products2">
      <ul>
       <?php if(!empty($collection_type_bel)){
		   $collection_type_bel_img=ClassRegistry::init('Productimage')->find('first', array('conditions' => array('product_id' =>$collection_type_bel['Product']['product_id'])));
		   ?>
        <a href="<?php echo BASE_URL;?>product?collection=<?php echo str_replace(' ','_',strtolower(trim($collectiontype_val_name4['Collectiontype']['collection_name'])));?>">
        <li>
          
          <div class="products2_img" style="background-image: url(<?php echo  BASE_URL; ?>img/product/small/<?php echo $collection_type_bel_img['Productimage']['imagename']?>)";></div>
          <!--<h2>Best Discount</h2>-->
          <a href="<?php echo BASE_URL;?>product?collection=<?php echo str_replace(' ','_',strtolower(trim($collectiontype_val_name4['Collectiontype']['collection_name'])));?>">
          <h1><?php echo $collectiontype_val_name4['Collectiontype']['collection_name']?></h1>
          <!--<div class="products2_shop_now">SHOP</div>-->
        </li>
        </a> 
        <?php }?> 
         <?php if(!empty($collection_type_ship)){
			   $collection_type_ship_img=ClassRegistry::init('Productimage')->find('first', array('conditions' => array('product_id' =>$collection_type_ship['Product']['product_id'])));
			 ?>
         <a href="<?php echo BASE_URL;?>product?collection=<?php echo str_replace(' ','_',strtolower(trim($collectiontype_val_name5['Collectiontype']['collection_name'])));?>">
        <li>
         
          <div class="products2_img" style="background-image: url(<?php echo  BASE_URL; ?>img/product/small/<?php echo $collection_type_ship_img['Productimage']['imagename']?>)"; ></div>
         <!-- <h2>Prompt Delivery</h2>-->
          <a href="<?php echo BASE_URL;?>product?collection=<?php echo str_replace(' ','_',strtolower(trim($collectiontype_val_name5['Collectiontype']['collection_name'])));?>">
          <!--<div class="products2_shop_now">SHOP</div>-->
           <h1><?php echo $collectiontype_val_name5['Collectiontype']['collection_name']?></h1>
        </li>
        </a>
        <?php }?> 
        
      </ul>
    </div>
  </div>
  <div style="clear:both;">&nbsp;</div>
  <div class="shadow"> <?php echo  $this->Html->image("shadow.png",array("alt" => "index")); ?></div>
  <div style="clear:both;"></div>
  <?php }?>
 <!-- <div class="offer">
   <?php// foreach($advertisement as $advertisements) { 
   //$images=$advertisements['Advertisement']['images'];
  ?>
   <a class="group2" href="<?php echo $this->webroot; ?>img/advertisement/<?php echo $images;?>">
     <div class="offer_inner" style="background-image:url(<?php echo $this->webroot; ?>img/advertisement/<?php echo $images;?>)";>
      <h3><?php echo $advertisements['Advertisement']['title'];?></h3>
    </div>
    </a> 
    <?php //} ?> </div>-->
    
    <?php
	$image1=ClassRegistry::init('Advertisement')->find('first',array('conditions'=>array('ads_id'=>1,'status'=>'Active')));
	$imagedel1=ClassRegistry::init('Advertisementdetails')->find('first',array('conditions'=>array('ads_id'=>1,'status'=>'Active')));
	$images=$imagedel1['Advertisementdetails']['values'];
	$imagedel2=ClassRegistry::init('Advertisementdetails')->find('all',array('conditions'=>array('ads_id'=>1,'status'=>'Active')));
	$img=array();	
	
	?>
     <?php if(!empty($image1)) { ?>
      <div class="offer"> <a class="group2" href="<?php echo BASE_URL;?>img/advertisement/big/<?php echo $images; ?>">
     <div class="offer_inner" style="background-image:url(<?php echo BASE_URL; ?>img/advertisement/small/<?php echo $images;?>)";>
      <h3><?php echo $image1['Advertisement']['title'];?></h3>
    </div>
      </a> 
      <?php } ?>
      <?php
	  foreach($imagedel2 as $del){
		echo '<a class="group2" href="'.BASE_URL.'img/advertisement/big/'.$del['Advertisementdetails']['values'].'"></a>';
		
	}
	  ?>
    <?php
	$image2=ClassRegistry::init('Advertisement')->find('first',array('conditions'=>array('ads_id'=>2,'status'=>'Active')));
	$imagedel1=ClassRegistry::init('Advertisementdetails')->find('first',array('conditions'=>array('ads_id'=>2,'status'=>'Active')));
	$images=$image2['Advertisement']['images'];
	?>
      <?php if(!empty($image2)) { ?>
     <a href="<?php echo $imagedel1['Advertisementdetails']['values'];?>" target="_blank">
    <div class="offer_inner" style="background-image:url(<?php echo $this->webroot; ?>img/advertisement/<?php echo $images;?>)";>
      <h3><?php echo $image2['Advertisement']['title'];?></h3>
    
    </div>
    </a>
    <?php } ?>
    <?php
	$image3=ClassRegistry::init('Advertisement')->find('first',array('conditions'=>array('ads_id'=>3,'status'=>'Active')));
	$imgsome=$image3['Advertisement']['images'];
	$imagedel1=ClassRegistry::init('Advertisementdetails')->find('all',array('conditions'=>array('ads_id'=>3,'status'=>'Active'),'order'=>'advertisement_id ASC'));
	?>
      <?php if(!empty($image3)) { ?>
    <div class="offer_inner"  style="background-image:url(<?php echo $this->webroot; ?>img/advertisement/<?php echo $imgsome;?>)";>
      <h3>
      <?php 
	  if(!empty($imagedel1)){		  
		  foreach($imagedel1 as $news) {
			  if($news['Advertisementdetails']['type']=="Link"){
			  $explode=explode('v=',$news['Advertisementdetails']['values']);
			  if(!empty($explode[1])){?>			  
		  <a class='youtube' href="http://www.youtube.com/embed/<?php echo $explode[1];?>?rel=0&wmode=transparent"><?php echo $news['Advertisementdetails']['video'];?></a> &nbsp;
          <?php } }else{?>
           <a target="_blank"  href="<?php echo BASE_URL.'img/advertisement/'.$news['Advertisementdetails']['values'];?>"><?php echo $news['Advertisementdetails']['video'];?></a> &nbsp;
          <?php } 
		  }}?>
          </h3>
    </div>
    
    <?php } ?>
     <?php
	$image4=ClassRegistry::init('Advertisement')->find('first',array('conditions'=>array('ads_id'=>4,'status'=>'Active')));
	$imdg=$image4['Advertisement']['images'];
	?>
    <?php if($image4) { ?>
    <a href="<?php echo BASE_URL?>webpages/jewellery_requestform">
    <div class="offer_inner" style="background-image:url(<?php echo $this->webroot; ?>img/advertisement/<?php echo $imdg;?>)";>
      <h3><?php echo $image4['Advertisement']['title'];?></h3>
     
    </div>
    </a> 
    <?php } ?></div>
    
    
  
    
  <div style="clear:both;"></div>
  <div class="shadow"><?php echo  $this->Html->image("shadow.png",array("alt" => "index")); ?></div>
  <div class="best_seller">
    <h1>Best Seller</h1>
  </div>
  <div style="clear:both;"></div>
   <?php
/*$bestsells=ClassRegistry::init('Shoppingcarts')->find('all', array('conditions'=>array('Product.status'=>'Active'),'fields'=>array('Product.*','Shoppingcarts.*'),
'joins'=>array(array(
'table'=>'products',
'alias'=>'Product',
'type'=>'inner',
 'foreignKey' => false,
'conditions' => array('`Shoppingcarts.product_id`=`Product.product_id`')

),
array(
'table'=>'orders',
'alias'=>'Order',
'type'=>'inner',
 'foreignKey' => false,
'conditions' => array('`Shoppingcarts.order_id`=`Order.order_id`','OR'=>array('Order.status'=>'Paid','Order.status'=>'PartialPaid'))
)),
'group'=>'Shoppingcarts.product_id',
'order'=>'count(Shoppingcarts.product_id) DESC','limit'=>10));*/
$bestsells=ClassRegistry::init('Product')->find('all',array('conditions'=>array('status'=>'Active','best_seller'=>'1')));

  ?>
  <div class="slider1">
  <?php  foreach($bestsells as $bestsellproduct) {
	  //$bestsellproduct=ClassRegistry::init('Product')->find('first',array('conditions'=>array('product_id'=>$bestsell['Shoppingcarts']['product_id'])));
	  $category = ClassRegistry::init('Category')->find('first', array('conditions' => array('category_id'=>$bestsellproduct['Product']['category_id'])));
		if(!empty($bestsellproduct['Product']['subcategory_id'])){	 
			$subcategory=ClassRegistry::init('Subcategory')->find('first', array('conditions' => array('subcategory_id' =>$bestsellproduct['Product']['subcategory_id'])));
			$subcat=str_replace(' ','_',$subcategory['Subcategory']['subcategory']);
		}else{
			$subcat='all_items';
		}
	$Product_product_name=str_replace(" ","_",$bestsellproduct['Product']['product_name']); 
	$productimage=ClassRegistry::init('Productimage')->find('first', array('conditions' => array('product_id' =>$bestsellproduct['Product']['product_id'])));
  if(isset($productimage['Productimage']['imagename']))
  {
  ?>
     <div class="slide"><a href="<?php echo BASE_URL;?><?php echo str_replace(' ','_',$category['Category']['category'])."/".$subcat."/".$bestsellproduct['Product']['product_id']."/".$Product_product_name;?>"><?php echo  $this->Html->image('product/small/'.$productimage['Productimage']['imagename'],array("alt" => "index",'height'=>'120','weight'=>'100')); ?></a></div>
     
   <?php } } ?>
   
  </div>
   <div style="clear:both; margin:10px 0"></div>
  <div class="shadow"> <?php echo  $this->Html->image("shadow.png",array("alt" => "index")); ?></div>
  <?php
 $product=ClassRegistry::init('Product')->find('all', array('conditions' => array('status' =>'Active'),'order'=>'product_id DESC','limit'=>12));
//pr($product);exit;
  ?>
  <div class="best_seller">
    <h1>New Arrivals</h1>
  </div>
  <div style="clear:both;"></div>
  <div class="slider1">
  <?php foreach($product as $images) {	 
	  $category = ClassRegistry::init('Category')->find('first', array('conditions' => array('category_id'=>$images['Product']['category_id'])));
		if(!empty($images['Product']['subcategory_id'])){	 
			$subcategory=ClassRegistry::init('Subcategory')->find('first', array('conditions' => array('subcategory_id' =>$images['Product']['subcategory_id'])));
			$subcat=str_replace(' ','_',$subcategory['Subcategory']['subcategory']);
		}else{
			$subcat='all_items';
		}
$productimage=ClassRegistry::init('Productimage')->find('first', array('conditions' => array('product_id' =>$images['Product']['product_id'])));
 $Product_product_name=str_replace(" ","_",$images['Product']['product_name']);
 if(isset($productimage['Productimage']['imagename']))
  { 
  ?>
     <div class="slide"><a href="<?php echo BASE_URL;?><?php echo str_replace(' ','_',$category['Category']['category'])."/".$subcat."/".$images['Product']['product_id']."/".$Product_product_name;?>"><?php echo  $this->Html->image('product/small/'.$productimage['Productimage']['imagename'],array("alt" => "index",'height'=>'120','weight'=>'100')); ?></a></div>
   <?php }
   } ?>
  </div>
   <div style="clear:both; margin:10px 0"></div>
  <div class="shadow"><?php echo  $this->Html->image("shadow.png",array("alt" => "index")); ?></div>
  <h1 align="center" style="color:#b29232;">What our Customer Says</h1>
  <div class="testimonial">
  <?php
  foreach($test as $test) {
  
  ?>
      <div class="testimonial_menu1">
                    <div class="testimonial_menu_img" style="background-image: url(<?php echo $this->webroot; ?>img/testimonial/<?php echo $test['Testimonial']['image']; ?>);"></div>
                    <div class="testimonial_menu_testimonial">
                        <p>"<?php echo $test['Testimonial']['content'];?>"</p>
                        
                    </div>
                </div>
                <?php } ?> 

  </div>
 <?php echo $this->Element('newsletter');?>
  <div class="shadow"><?php echo  $this->Html->image("shadow.png",array("alt" => "index")); ?></div>
  <?php
  $storeId=array('24','25','26','27','28','29'); 
  $staticpagesfeature=ClassRegistry::init('Staticpage')->find('all',array('conditions'=>array('staticpage_id'=>$storeId)));
  if(!empty($staticpagesfeature)){
 ?>   
  <div class="features" style="text-align:center;"><?php //echo  $this->Html->image("features_img.png",array("alt" => "index")); ?>
   
    <?php foreach($staticpagesfeature as $staticpagesfeatures){?>
    
    <a href="#"><?php echo $staticpagesfeatures['Staticpage']['pagecontent'];?></a>
    <?php }?>	
    
  </div>
  
  <?php }?>
