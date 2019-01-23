<table class="table table-user table-nohead" id="addresstable">
    <tbody> 
        
        <?php
            foreach ($addressbook as $add){
                $addressname = $add['emp_firstname']." ".$add['emp_lastname'];
                $empemail = $add['user_name'];
                $empmobile = $add['mobile_number'];
                if(file_exists('profilepictures/thumbimg-'.$add['id'].'.jpg') and $add['id']>0){
                    $addressimg = Yii::app()->request->baseUrl.'/profilepictures/thumbimg-'.$add['id'].'.jpg?'.time();
                }
                else{
                    $addressimg = Yii::app()->request->baseUrl.'/profilepictures/default.jpg?'.time();
                }
            ?>                           
        <tr>
            <td class='img'><img src="<?php echo $addressimg;?>"/></td>
            <td class='user'><?php echo $addressname;?></td>
            <td><?php echo $empemail;?></td>
            <td><?php echo $empmobile;?></td>
        </tr>    <?php } ?>                                                         
    </tbody>
</table>