
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td align="right" valign="top" width="230" class="sidepromenu">
<?php echo $this->Element('admin_leftsidebar'); ?></td>
<td align="left" valign="top">

<div id="content"  class="clearfix">			
    <div class="container">
    
        <div align="right" style="padding-right:50px;"><?php echo $this->Html->link('Back to User',array('action'=>'index'),array('class'=>'button')); ?></div>   
        <div class="texttabBox"> 
         <?php echo $this->Form->create('User',array('id'=>'myForm','type' => 'file','inputDefaults' => array ('fieldset' => false, 'legend' => false))); ?>    
      <fieldset>
        <legend>Shipping Details </legend>
        <dl class="inline">
     
          <dt><label for="name">Shipping Address</label></dt>
          <dd><?php if(!empty($this->request->data['Shipping']['shipping_address'])) { echo $this->request->data['Shipping']['shipping_address']; } else { echo '-'; } ?></textarea></dd>
          
          <dt><label for="name">LandMark</label></dt>
          <dd><?php if(!empty($this->request->data['Shipping']['shipping_landmark'])) { echo $this->request->data['Shipping']['shipping_landmark']; } else { echo '-'; }?></dd>
          
          
          <dt><label for="name">Billing Address</label></dt>
          <dd><?php if(!empty($this->request->data['Shipping']['shipping_landmark'])) { echo $this->request->data['Shipping']['billing_address']; }else { echo '-'; } ?></dd>
          
          <dt><label for="name">LandMark</label></dt>
          <dd><?php if(!empty($this->request->data['Shipping']['billing_landmark'])) { echo $this->request->data['Shipping']['billing_landmark']; }else { echo '-'; } ?></dd>
          
           <dt><label for="name">Pincode</label></dt>
          <dd><?php if(!empty($this->request->data['Shipping']['pincode'])) { echo $this->request->data['Shipping']['pincode']; }else { echo '-'; } ?></dd>
          
          <dt><label for="name">City</label></dt>
          <dd><?php if(!empty($this->request->data['Shipping']['city'])) { echo $this->request->data['Shipping']['city']; }else { echo '-'; } ?></dd>
          
          <dt><label for="name">State</label></dt>
          <dd><?php if(!empty($this->request->data['Shipping']['state'])) { echo $this->request->data['Shipping']['state']; }else { echo '-'; } ?></dd>
           
     	 </dl>
      </fieldset>
    </form>      
        </div>
       </div> 
    </div>
</div>
</td>
</tr>
</table>
