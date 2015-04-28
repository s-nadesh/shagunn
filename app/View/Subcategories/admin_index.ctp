<div id="content" class="clearfix"> 
    <div class="container">
        <div class="mainheading">   
        <div class="btnlink"><?php echo $this->Html->link(__('+Add Subcategory'), array('action' => 'add'),array('class'=>'button')); ?></div>         
        <div class="titletag"><h1><?php echo __('Subcategory'); ?></h1></div>
        </div>
        <div class="tablefooter clearfix">
           <form name="searchfilters" action="" id="myForm1" method="post" style="width:800px;float:left;padding: 5px 10px;">  
            <table cellpadding="0" cellspacing="2">
            <tr><td><strong><?php echo __('Category');?> : </strong>&nbsp;</td>
            <td><select name="searchcategory" id="category_id">
          <option value="">Select Category</option>
          <?php
		  foreach($category as $category){
			  echo '<option value="'.$category['Category']['category_id'].'" '.(isset($_REQUEST['searchcategory']) && $_REQUEST['searchcategory']==$category['Category']['category_id']?'selected="selected"':'').'>'.$category['Category']['category'].'</option>';
		  }
		  ?>
          </select></td><td>&nbsp;</td> <td><strong><?php echo __('Subcategory');?> : </strong>&nbsp;</td>
            <td><input id="searchsubcategory" name="searchsubcategory" type="text" class="validate[groupRequired[payments]] text-input" autocomplete="off" value="<?php if(isset($_REQUEST['searchsubcategory'])){echo $_REQUEST['searchsubcategory'];}?>" /></td><td>&nbsp;</td>        
            <td><input type="hidden" name="searchfilter" value="1"/><input type="submit" name="searchbutton" class="button small" value="<?php echo __('Search');?>" /></td>
            <td>&nbsp;</td><td>
            <?php if(isset($_REQUEST['search'])){			
            echo $this->Html->link(__('Cancel'),array('action'=>'index'),array('class'=>'button small','style'=>'padding:3px 5px;','title'=>'Cancel Search'));
            } ?></td>
            </tr></table></form>  
        </div>
    	<?php echo $this->Form->create('Subcategory', array('action' => 'delete','id'=>'myForm','Controller'=>'subcategories')); ?>
        <table cellpadding="0" cellspacing="0" id="example" class="table gtable">
        <thead>
        <tr>
         <th width="30" align="center"><?php echo __('<input type="checkbox" id="checkAllAuto" name="action[]" value="" class="" />'); ?></th> 
         <th width="30" align="center"><?php echo __('#');?></th>
         <th align="left"><?php echo $this->Paginator->sort('subcategory','Subcategory');?></th>   
          <th align="left"><?php echo __('SubCategory Code');?></th>       
         <th align="left"><?php echo __('Category');?></th> 
        <th align="left"><?php echo $this->Paginator->sort('status','Status');?></th> 
        <th align="center" width="100"><?php echo __('Action');?></th> 
       <th width="30" align="center">Edit</th>
         <th width="30" align="center">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php if(empty($subcategory))
        echo '<tr><td colspan="8" align="center">'.__('No records found').'</td></tr>';
        else{
			$i=$this->Paginator->counter('{:start}');
			foreach ($subcategory as $subcategory): 
				$category=ClassRegistry::init('Category')->find('first',array('conditions'=>array('category_id'=>$subcategory['Subcategory']['category_id'])));				
		?>
        <tr>
        <td align="center"><input type="checkbox" name="action[]" value="<?php echo h($subcategory['Subcategory']['subcategory_id']); ?>"  class="validate[minCheckbox[1]] checkbox" rel="action" /></td>
        <td align="center"><?php echo h($i); ?></td>
        <td align="left"><?php  echo $subcategory['Subcategory']['subcategory'];?></td>
         <td align="left"><?php  echo $subcategory['Subcategory']['subcategory_code'];?></td>
        <td align="left"><?php  echo $category['Category']['category'];?></td>
        <td align="left"><?php  echo $subcategory['Subcategory']['status'];?></td>
       <td align="center"><?php echo h($subcategory['Subcategory']['status'])=="Active" ? $this->Html->link(__('Click to Deactive'),array('action'=>'changestatus',$subcategory['Subcategory']['subcategory_id'],'Inactive')) : $this->Html->link(__('Click to Active'),array('action'=>'changestatus',$subcategory['Subcategory']['subcategory_id'],'Active')); ?></td> 
        <td align="center"><?php echo $this->Html->image('icons/edit.png',array('url'=>array('action'=>'edit', $subcategory['Subcategory']['subcategory_id']),'border'=>0,'alt'=>__('Edit')) );?></td>
       <td align="center"><?php echo $this->Html->image('icons/cross.png',array('url'=>array('action'=>'delete',$subcategory['Subcategory']['subcategory_id']),'border'=>0,'class'=>'confirdel','alt'=>__('Delete')) );?></td>
        </tr>
        <?php $i++; endforeach;
        }
        ?>
        </tbody>
        </table>
        <div class="tablefooter clearfix">   
        <div class="actions">
<input type="submit" id="action_btn"  class="button small" value="Delete"  />
        </div>
        <div class="pagination">
        <div class="pagenumber">
        <?php
        echo $this->Paginator->counter(array(
        'format' => __('Page').' {:page} '.__('of').' {:pages}, '.__('showing').' {:current} '.__('records out of').' {:count} '.__('total')
        ));
        ?>
        </div>
        <div class="paging">
        <?php
        echo $this->Paginator->prev(__('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') , array(), null, array('class' => 'next disabled'));
        ?>
        </div>
        </div>
        </div>
    	<?php echo $this->Form->end(); ?>
    </div>
</div>