<!-- Side Navbar -->
       


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


<nav class="side-navbar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="img/person.png" alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
              <h1 class="h4"><?php echo $user["username"]; ?></h1>
              <p>Administrator</p>
            </div>
          </div>
          <!-- Sidebar Navidation Menus--><span class="heading">Main Menu</span>
          <ul class="list-unstyled">
          
            <li><a href="home.php"> <i class="icon-home"></i>Home </a></li>
            <li><a href="list_tickets.php?prefSeat_id="> <i class="icon-form"></i>Sold Tickets </a></li>
            
           
          </ul><span class="heading">Preferences</span>
          
          <ul class="list-unstyled">
            <li> <a href="event_list.php"> <i class="icon-list"></i>Event </a></li>
            <li> <a href="seats_list.php"> <i class="icon-list"></i>Seats </a></li>
          </ul>
          
        </nav>