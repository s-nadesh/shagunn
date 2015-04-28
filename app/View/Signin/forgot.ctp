<!--<base target="_parent" />-->
<html >
    <body >
    <div class="dismsg" id="msginfo"><?php $msg=$this->Session->flash(); if(!empty($msg)) echo $msg.'<div class="close">Click to close.</div>'; ?></div>
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


       
        <?php
        echo $this->Html->css(array('style','webindex','webcss/main','jQuery.validation/validationEngine.jquery'));
		 echo $this->Html->script(array('jQuery.validation/jquery.validationEngine','jQuery.validation/languages/jquery.validationEngine-en'));
    
        ?>
        <form name="forgot" id="formForgot" action="<?php echo BASE_URL; ?>signin/forgot" method="post">
       <div style="margin-top:50px;" class="forgot">
			<div id='inline_content' style='padding:10px; background:#fff;'>
            	<div class="forgotPopup" style="margin-bottom:30px;">
                	<h3>Forgot Your Password?</h3>
                    <p>Please enter your email ID below we will send you the password</p>
                    <p>
                    	<form action="" method="post">
	                    	<table cellpadding="0" cellspacing="0" border="0" width="100%">	
                        	<tr>
                            	<td width="80">Email ID</td>
                            	<td width="30">:</td>
                            	<td><input name="data[User][email]" type="text" class="validate[required,custom[email]]"></td>
                            </tr>
                            <tr><td colspan="3">&nbsp;</td></tr>
	
                        	<tr>
                            	<td>&nbsp;</td>
                            	<td></td>
                            	<td><input type="submit" name="sub" value="Submit" id="sub" class="button" /></td>
                            </tr>
                        </table>
                        </form>
                    </p>
                </div>
			</div>
		</div>
        </body>
        </html>

  <script>
    $(document).ready(function(){
    $("#formForgot").validationEngine();
	 
    });
</script>
<script>
$("#msginfo").click(function () { 
  $("#msginfo").fadeOut(1000);
 });
 setTimeout(function(){  $('#msginfo').fadeOut(1000); }, 5000);
</script>
<style>
@charset "utf-8";
/* CSS Document */

div.msg {
	border-radius: 5px 5px 5px 5px;
}
div.information {
	background: url("../img/icons/information.png") no-repeat scroll 10px 11px #E3F2F7;
	border: 1px solid #B4DBE8;
}
div.warning {
	background: url("../img/icons/exclamation.png") no-repeat scroll 10px 11px #FFFFD3;
	border: 1px solid #D6D61F;
}
div.error {
	background: url("../img/icons/error.png") no-repeat scroll 10px 11px #FAE8E8;
	border: 1px solid #FFA2AA;
}
div.success {
	background: url("../img/icons/accept.png") no-repeat scroll 10px 11px #E3FFDE;
	border: 1px solid #6CD858;
}
div.msg {
	cursor: pointer;
	margin-bottom: 10px;
	padding: 9px 10px 9px 37px;
    width: 160%;
	position: absolute;
    right: -73px;
	bottom:100px;
}
div.error1 {
	background: url("../img/error.png") no-repeat scroll 0 9px;
	color: #D00;
}
div.success1 {
	background: url("../img/accept.png") no-repeat scroll 0 9px;
	color: #00773C;
}
div.msg1 {
	padding: 10px 0 10px 40px;
}

div.dismsg{
	margin:0 auto;
	position:absolute;
	top:175px;
	width:40%;
	left:30%;
}
div.close{
	background: url("../img/icons/delete.png") no-repeat;
    cursor: pointer;
    height: 16px;
    position: absolute;
    right: -18%;
    text-indent: -999999px;
    top: -136px;
    width: 16px;
}
</style>