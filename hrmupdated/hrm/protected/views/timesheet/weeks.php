<table class="table table-hover table-nomargin table-bordered usertable" id="weektable">
    <thead>
        <tr>
            <th style="width: 10%;"><?php echo date('l j',  strtotime($weekstart));?></th>
            <th style="width: 10%;"><?php echo date('l j',  strtotime('next monday',  strtotime($weekstart)));?></th>
            <th style="width: 10%;"><?php echo date('l j',  strtotime('next tuesday',  strtotime($weekstart)));?></th>
            <th style="width: 10%;"><?php echo date('l j',  strtotime('next wednesday',  strtotime($weekstart)));?></th>
            <th style="width: 10%;"><?php echo date('l j',  strtotime('next thursday',  strtotime($weekstart)));?></th>
            <th style="width: 10%;"><?php echo date('l j',  strtotime('next friday',  strtotime($weekstart)));?></th>
            <th style="width: 10%;"><?php echo date('l j',  strtotime('next saturday',  strtotime($weekstart)));?></th>
            
        </tr>
    </thead>
    <tr>
        <td><input type="text" id="<?php echo date('Y_m_d',  strtotime($weekstart));?>" name="<?php echo date('Y_m_d',  strtotime($weekstart));?>" value="" style="width: 70px;"></td>                                        
        <td><input type="text" id="<?php echo date('Y_m_d',  strtotime('next monday',  strtotime($weekstart)));?>" name="<?php echo date('Y_m_d',  strtotime('next monday',  strtotime($weekstart)));?>" value="" style="width: 70px;"></td>
        <td><input type="text" id="<?php echo date('Y_m_d',  strtotime('next tuesday',  strtotime($weekstart)));?>" name="<?php echo date('Y_m_d',  strtotime('next tuesday',  strtotime($weekstart)));?>" value="" style="width: 70px;"></td>
        <td><input type="text" id="<?php echo date('Y_m_d',  strtotime('next wednesday',  strtotime($weekstart)));?>" name="<?php echo date('Y_m_d',  strtotime('next wednesday',  strtotime($weekstart)));?>" value="" style="width: 70px;"></td>
        <td><input type="text" id="<?php echo date('Y_m_d',  strtotime('next thursday',  strtotime($weekstart)));?>" name="<?php echo date('Y_m_d',  strtotime('next thursday',  strtotime($weekstart)));?>" value="" style="width: 70px;"></td>
        <td><input type="text" id="<?php echo date('Y_m_d',  strtotime('next friday',  strtotime($weekstart)));?>" name="<?php echo date('Y_m_d',  strtotime('next friday',  strtotime($weekstart)));?>" value="" style="width: 70px;"></td>
        <td><input type="text" id="<?php echo date('Y_m_d',  strtotime('next saturday',  strtotime($weekstart)));?>" name="<?php echo date('Y_m_d',  strtotime('next saturday',  strtotime($weekstart)));?>" value="" style="width: 70px;"></td>
    </tr>
</table>