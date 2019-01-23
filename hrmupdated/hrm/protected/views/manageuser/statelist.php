<?php
if(count($selectarray)>0){?>
<select id="statelist" name="statelist" class="input-xlarge">
     <option value="">----Select a State----</option>
 <?php
 foreach ($selectarray as $key => $value) {?>
    <option value="<?php echo $value->id;?>"><?php echo $value->state;?></option>

 <?php } ?>
    
</select>    
 <?php }
 else {?>
      <input type="text" id="statelist" name="statelist" class='input-xlarge' value="">
<?php }?>

