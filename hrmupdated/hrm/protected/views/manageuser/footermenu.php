<link rel="stylesheet" href="style.css">


      <footer id="allfooters">  
      <div class="row">
               <div class="column">
                  <div class="home-button">
                  </div>
                  <a class="caption" href="#dashboard"> Home</a>    
               </div>
               <?php if ($roledata == 1 or $roledata == 2)
                {
                ?>
               <div class="column">
                  <div class="assign-leave-button">
                  </div>
                  <a class="caption" href="#assignleave"> Assign</a>
               </div>
               
               <div class="column">
                  <div class="leave-balance-button">
                  </div>
                  <a class="caption" href="#manageleavebalance"> Emp Balance</a>
               </div>
               <?php } else {?>
                <div class="column">
                  <div class="apply-leave-button">
                  </div>
                  <a class="caption" href="#applyleave"> Apply</a>
               </div>
               <?php } ?>
               
               <?php if ($roledata == 1 or $roledata == 2 or $superfooter > 0)
                {?>
                
               <div class="column">
                  <div class="leave-status-button">
                  </div>
                  <a class="caption" href="#employeeleavestatus">Emp Status</a>
               </div>
               <?php } 

                elseif ($roledata > 2)
                {
                ?>
                <div class="column">
                  <div class="leave-status-button">
                  </div>
                  <a class="caption" href="#myleavestatus">Status</a>
                </div>
                <div class="column">
                  <div class="leave-balance-button">
                  </div>
                  <a class="caption" href="#myleavebalance">Balance</a>
               </div>
                <?php } ?>
          
          <?php if ($superfooter > 0)
                {?>
                <div class="column">
                  <div class="leave-balance-button">
                  </div>
                  <a class="caption" href="#myleavebalance">Balance</a>
               </div>
            <?php } ?>
            </div>
          </footer>
