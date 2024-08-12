<!DOCTYPE html>
<html>

<?php include('header.php'); ?>

  <body>
    <div class="page">
      
    <?php include('top_navbar.php'); ?>
      
      <div class="page-content d-flex align-items-stretch"> 
      
        <?php include('side_navbar.php'); ?>
        
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Dashboard --  <a data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm" style="color: white;" title="Click to add seat..."> Update Profile</a></h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <div class="row bg-white has-shadow">
              
                <!-- Item -->
                <div class="col-xl-6 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="fa fa-calendar"></i></div>
                    <div class="title"><span>Total<br>Events</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>
                    </div>
                    <div class="number"><strong>
                    <?php 
                    
                    include('dbcon.php');


                    $event_query = $conn->query("SELECT * FROM pref_event") or die(mysql_error());
                    echo $event_query->rowCount();
                    ?>
                    </strong></div>
                  </div>
                </div>
                
                <!-- Item -->
                <div class="col-xl-6 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-red"><i class="fa fa-users"></i></div>
                    <div class="title"><span>Total<br>Seats</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 70%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                      </div>
                    </div>
                    <div class="number"><strong>
                    <?php 
                    $seat_query = $conn->query("SELECT * FROM pref_seat") or die(mysql_error());
                    echo $seat_query->rowCount();
                    ?>
                    </strong></div>
                  </div>
                </div>
               
              </div>
            </div>
          </section>
 
          
          <hr />
          
          <!-- Projects Section-->
          <section class="projects no-padding-top">
            <div class="container-fluid">
                
            <?php
            
            $seat_query = $conn->query("SELECT * FROM pref_seat") or die(mysql_error());
            while ($seat_row = $seat_query->fetch()) 
            {
                $prefSeat_id=$seat_row['prefSeat_id'];
            
                $event_query = $conn->query("SELECT * FROM pref_event WHERE event_id='$seat_row[event_id]'") or die(mysql_error());
                $event_row = $event_query->fetch();
                
                
                $totalRemaining=$seat_row['max_seat']-$seat_row['currentNum'];
                
            ?>
                          
              <!-- Project-->
              <div class="project">
                <div class="row bg-white has-shadow">
                  <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center">
                      <div class="image has-shadow">
                      
                      <?php if($totalRemaining<=0){ ?>
                        <a href="#" class="btn btn-default" style="height: 100%; width: 100%; padding: 0px;"><small>Sold Out</small></a></div>
                      <?php }else{ ?>
                        <a href="checkout_ticket.php?seatNum=<?php echo $seat_row['area_prefix'].'-'; ?><?php echo $seat_row['currentNum']+1; ?>&prefSeat_id=<?php echo $seat_row['prefSeat_id']; ?>&event_id=<?php echo $seat_row['event_id']; ?>&currentNum=<?php echo $seat_row['currentNum']; ?>" class="btn btn-info" style="height: 100%; width: 100%; padding: 0px;"><i class="fa fa-shopping-cart"></i><br /><small>Sell</small></a></div>
                      
                      <?php } ?>
                      
                      
                      <div class="text">
                        <h3 class="h4"><?php echo $seat_row['area_prefix']; ?> @ <?php echo $seat_row['ticket_price']; ?></h3><small><?php echo $seat_row['desc']; ?></small>
                      </div>
                    </div>
                    <div class="project-date"><span class="hidden-sm-down">Last Sold Ticket: <?php echo $seat_row['area_prefix'].' - '.$seat_row['currentNum']; ?></span></div>
                  </div>
                  <div class="right-col col-lg-6 d-flex align-items-center">
                    <div class="time"><i class="fa fa-ticket"></i>Total Seats: <?php echo $seat_row['max_seat']; ?></div>
                    <div class="comments"><i class="fa fa-dollar"></i>Total Sold: <?php echo $seat_row['currentNum']; ?></div>
                    <div class="comments"><i class="fa fa-file"></i>Total Remaining: <?php echo $totalRemaining; ?></div>
                    
                  </div>
                </div>
              </div>
            
            <?php } ?>
            </div>
          </section>


          <?php
// Database connection using PDO
try {
    $conn = new PDO("mysql:host=localhost;dbname=qrcodegen", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

  $user_id = $_SESSION['id'];

    // Fetch the first user details from the database
    $query = $conn->prepare("SELECT * FROM useraccounts WHERE user_id = :user_id");
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

// print_r($user);

if (!$user) {
    die("User not found");
}
?>


          <!-- Modal-->
<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="exampleModalLabel" class="modal-title">Update Admin Details</h4>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>

            <form action="update_password.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input name="username" type="text" placeholder="Enter username..." class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required >
                        <input name="user_id" type="hidden" value="<?php echo htmlspecialchars($user['user_id']); ?>" />
                      </div>

                    <div class="form-group">
                        <label>New Password</label>
                        <input name="password" type="password" placeholder="Enter new password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <a data-dismiss="modal" class="btn btn-secondary">Close</a>
                    <button type="submit" name="update_password" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



          
          <?php include('footer.php'); ?>
          
        </div>
      </div>
    </div>
    
    <?php include('script_files.php'); ?>
  </body>
</html>