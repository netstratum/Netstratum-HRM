<table class="table table-user table-nohead" id="noticetable">
    <tbody>
        
<!--        <th>Time</th>-->
        <th>Message</th>
        <?php 
        foreach ($notices as $notes)
        {
            $dates = date('M j, Y',  strtotime($notes['added_date']));
            $msgnote = $notes['message'];
            $bithdayimg = Yii::app()->request->baseUrl.'/img/notes.png';
            if($notes['message']==="")
            {   $bithdayimg = Yii::app()->request->baseUrl.'/img/Birthday_cake.png';            
                $msgnote=$notes['name']."'s"." Birthday is today";
                
            }
        ?>
    
        <tr>
            <!--date('F j, Y',  strtotime($tdatas['task_date']))-->
            <!--<td></td>-->
            <td><img src="<?php echo $bithdayimg;?>"/><?php echo $msgnote;?><div class="fordatenotice"><?php echo $dates; ?></div></td>
        </tr>
        <?php  } ?>
    </tbody>
</table>