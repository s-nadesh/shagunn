<script type="text/javascript">
<?php $total_pages=ClassRegistry::init('Locateus')->find('count',array('conditions'=>array('status'=>'Active')));?>
	var total_pages	=	<?php echo $total_pages; ?>;	
</script>
<div class="main">
  <header> &nbsp; </header>
  <div style="clear:both;">&nbsp;</div>
<div  class="">
    <div class="middleContent">
      <h2>Locate Us </h2>
       <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
          <td><form name="searchlocation" method="post" id="myForm" action="">
          	<table cellspacing="0" cellpadding="0" border="0" width="100%">
            	<tr>
                	<td width="100">Select State -</td>
                	
                    <td width="200">
                          <select onChange="" style="width:180px;" name="servicestate" id="servicestate" class="validate[required] nostyle span4 valid state_type ">
                          <option value="All">== Select ==</option>
                         <?php 
						 foreach($state as $states){?>
                         <option value="<?php echo $states['States']['state_id']?>"><?php echo $states['States']['state'];?></option>
                         <?php }?>
                        </select>
                    </td>
                	
                    <td width="100">Select City -</td>
                	
                    <td width="230">
                        <select name="servicecity" id="servicecity" style="width:180px;" class="nostyle span4 valid city_type">
                        <option value="">== No Value ==</option> 
                        </select>
                       
                    </td>
                	
                    <td>
                    	<!--<button>Search</button> &nbsp; <button>Clear</button>-->
                        <input type="submit"  name="searchfilter" value="Search"/>
                        <?php if(isset($_REQUEST['search'])){?>
						<a href="<?php echo BASE_URL;?>locateus/locate_us"> <input type="button"  name="cancel" value="Cancel"  /></a>	
						<?php }?>
                    </td>
                	
                    
                </tr>
            </table></form>
          </td>
        </tr>
        
        <tr><td colspan="5">&nbsp;</td></tr>

        <tr>
            <td colspan="5">
            <table cellspacing="0" cellpadding="0" border="0" class="tBorder" width="100%" id="loadContentshead" style="background-color: rgb(255, 252, 247);">
                <thead id="loadTH">
                  <tr style="height: 30px;">
                    <td width="98" style="background-color: #FDF2DC" class="tdBorderR"><b>Name</b></td>
                    <td width="192" style="background-color: #FDF2DC" class="tdBorderR"><b>Address</b></td>
                    <td width="110" style="background-color: #FDF2DC" class="tdBorderR"><b>Location</b></td>
                    <td width="20" style="background-color: #FDF2DC" class="tdBorderR"><b>Email ID</b></td>
                    <td width="80" style="background-color: #FDF2DC" class="tdBorderR"><b>Phone</b></td>
                    <td width="80" style="background-color: #FDF2DC" class="tdBorderR"><b>Fax</b></td>
                  </tr>
                </thead>
                <tbody id="messages-list" >
                
                   <?php
					if(!empty($locateus)){
				 foreach($locateus as $locateus){
					$city=ClassRegistry::init('Cities')->find('first',array('conditions'=>array('city_id'=>$locateus['Locateus']['city'])));
					$state=ClassRegistry::init('States')->find('first',array('conditions'=>array('state_id'=>$locateus['Locateus']['state'])));
					?>
                  <tr>
                    <td class="tdBorderR"><?php echo $locateus['Locateus']['name']?></td>
                    <td class="tdBorderR"><?php echo $locateus['Locateus']['address'];?></td>
                    <td class="tdBorderR"><?php echo $city['Cities']['city']?>,<br>
                     <?php echo  $state['States']['state']?></td>
                    <td class="tdBorderR"><?php echo $locateus['Locateus']['email'];?></td>
                    <td class="tdBorderR"><?php $phone=explode(",",$locateus['Locateus']['phone']);?>
                   <?php  foreach($phone as $p1){
				echo  $p1.'<br>';
				   }?> 
                     </td>
                    <td class="tdBorderR"><?php  $fax=explode(",",$locateus['Locateus']['fax']);?>
                     <?php  foreach($fax as $f1){
				echo  $f1.'<br>';
				   }?> 
                    </td>
                  </tr>
                  
                    <?php }}else{?>
                    
                    <tr><td colspan="6" align="center">No Records Found</td></tr>
                    <?php }?>      
                </tbody>
            </table>
            </td>
        </tr>
            
      </table>
      </div>
      <?php //if(!empty($locateus)){?>
    <!--  <div class="loading">LOAD MORE</div>-->
	  <?php //}?>
    </div>
 <script>
    $(document).ready(function(){
    $("#myForm").validationEngine();
	 });
</script>
  <script>
  
  $(document).ready(function(){
	  $('.state_type').on("change",function(){
		  var id=$(this).val();
		  $.ajax({
		type: "POST",
		url: "<?php echo BASE_URL; ?>locateus/register_state1/",
		data: 'id='+id,
	    dataType: 'json',
		success: function (data) {
			 appenddata = "<select name='servicecity' id='servicecity' style='width:180px;' class='nostyle span4 valid city_type'><option value=''>== No Value ==</option> ";
                        $.each(data, function (k, v) {
                            appenddata += "<option value = '" +v.Cities.city_id + "' '>" +v.Cities.city + " </option>";
                        });
                        appenddata += "</select>";
                        $('.city_type').html(appenddata);
                      
          }
		});
		  });
	  });
//variable initialization 
/*var current_page	=	2;
var loading			=	false;
var oldscroll		=	0;
$(document).ready(function(){

	$.ajax({
		'url':'<?php echo BASE_URL; ?>locateus/get_data/',
		'type':'post',
		'data': 'p='+current_page,
		success:function(data){
			var data	=	$.parseJSON(data);
			$(data.html).hide().append('#messages-list').fadeIn(1000);
			current_page++;
		}
	});
	
	$(window).scroll(function() {
		if( $(window).scrollTop() > oldscroll ){ //if we are scrolling down
			if( ($(window).scrollTop() + $(window).height() >= $(document).height()  ) && (current_page <= total_pages) ) {
				   if( ! loading ){
						loading = true;
						$('#messages-list').addClass('loading');
						$.ajax({
							'url':'<?php echo BASE_URL; ?>locateus/get_data/',
							'type':'post',
							'data': 'p='+current_page,
							success:function(data){
								var data	=	$.parseJSON(data);								
								$('#messages-list').append(data);
								current_page++;
								$('#messages-list').removeClass('loading');
								loading = false;
							}
						});	
				   }
			}
		}
	});
	
});*/
  </script>
  
   