<div class="main">
    <header> &nbsp; </header>
    <div style="clear:both;">&nbsp;</div>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td colspan="5" height="100" style="text-align:center"><?php echo $this->Html->image('payment_loader.gif');?><br/>Don't click "REFRESH" and "BACK" button.  </td></tr>
</table>

<script>
$(document).ready(function(){
$('.remove').clik(function(){
thivar=$(this);
thisvar.parents('tr').remove();

});

});
</script>
</div>