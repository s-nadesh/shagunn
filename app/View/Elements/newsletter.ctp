<div class="shadow"><?php echo  $this->Html->image("shadow.png",array("alt" => "index")); ?></div>
  <div style="clear:both;"></div>
  <div class="newletter">
    <div style="float:left; width:40%; border-right:dashed 1px #edc432; padding-right:15px;">
      <h1 style="color:#b29232;">Newsletter</h1>
      <p>Provide your email address and get notified about our latest products as well as other awesome offers.</p>
       <?php echo $this->Form->create('webpages', array('id'=>'myForm','action'=>'newsletter')); ?>
      <p> Email<br />
        <input type="text" name="data[Newsletter][email]" placeholder="Enter Email" class="validate[required,custom[email]] email" value="">
        <br />
        <br />
        <input name="submit" type="submit" value="Submit" id="submit">
       
      </p>
      <?php echo $this->Form->end(); ?>
    </div>
    <div style="float:left; width:56%; padding-left:20px;">
      <h1 style="color:#b29232;">Locate nearest Franchisee</h1>
      <p>(Delhi NCR, Gurgaon, Noida, Faridabad, Ghaziabad, Mumbai, Pune, Bangalore, Chennai, Chandigarh, Hyderabad, Ludhiana, Ambala, Patiala)</p>
      <p>Now you can try on our jewellery from the comfort of your home. Please provide us your contact details below and our jewellery consultant will get in touch with you soon.</p>
       <?php echo $this->Form->create('webpages', array('id'=>'tryHome','action'=>'enquries')); ?>
      <div style="float:left;">
        <div style="float:left; margin-right:10px;">Name <br />
          <input style="width:100px;" type="text" name="data[Enquries][name]" class="validate[required]">
        </div>
        <div style="float:left; margin-right:10px;">Phone <br />
          <input style="width:100px;" type="text" name="data[Enquries][phone]" class="validate[required,custom[integer]]" maxlength="10" onkeypress="return intnumbers(this, event)" >
        </div>
        <div style="float:left; margin-right:10px;">City <br />
          <select style="width:100px;"  name="data[Enquries][city]" id="try_city" class="validate[required]">
            <option value="">Select</option>
            <option value="Delhi">Delhi (NCR)</option>
            <option value="Gurgaon">Gurgaon</option>
            <option value="Noida">Noida</option>
            <option value="Faridabad">Faridabad</option>
            <option value="Ghaziabad">Ghaziabad</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Pune">Pune</option>
            <option value="Bangalore">Bangalore</option>
            <option value="Chennai">Chennai</option>
            <option value="Chandigarh">Chandigarh</option>
            <option value="Hyderabad">Hyderabad</option>
            <option value="Ludhiana">Ludhiana</option>
            <option value="Ambala">Ambala</option>
            <option value="Patiala">Patiala</option>
            <option value="Other">Other</option>
          </select>
        </div>
        <div style="float:left; margin-right:10px;">Pincode <br />
          <input style="width:100px;" type="text" name="data[Enquries][pincode]" class="validate[required,custom[integer]]" maxlength="6" onkeypress="return intnumbers(this, event)" >
        </div>
        <div style="float:left;"><br />
          <input style="padding:4px 15px 4px 15px;" name="submit" type="submit" value="Submit" class="button">
        </div>
         <?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
  
   <script>
    $(document).ready(function(){
    $("#myForm").validationEngine();
	 $("#tryHome").validationEngine();
    });
</script>
<script>
$(document).ready(function(){
	$('#myForm').submit(function(event) {
		event.preventDefault();
		if(!$("#myForm").validationEngine('validate')){
         return false;
         }
		$('.helpfade').show();
		$('.helptips').show();
		var email=$('.email').val();
		$.ajax({
		type: "POST",
		url: "<?php echo BASE_URL; ?>webpages/newsletter/",
		data: 'id='+email,
		success: function (msg) {
			$('.helpfade').hide();
		    $('.helptips').hide();
				alert(msg);
			 $('.email').val('');
			 }
		});
		
		
	});
	
});
</script>
