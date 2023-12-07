<?php

include('../dbconn.php');
include "../loginpage/logging.php"; // Include the logging file

session_start();

$userName = isset($_SESSION['name']) ? $_SESSION['name'] : "Unknown User";

if(isset($_SESSION['id']) && isset($_SESSION['email'])){

?>

<!DOCTYPE html>
<span style="font-family: verdana, geneva, sans-serif;">

<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard</title>
  


  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container-dash">
    <nav>
      <ul> 
        <li><a href="#" class="logo">
          <img src="../images/logo.jpg" alt="">
          <span class="nav-item">DashBoard</span>
        </a></li>
        <li><a href="./home.php">
          <i class="fas fa-home"></i>
          <span class="nav-item">Home</span>
        </a></li>
        <li><a href="./addstudent.php" >
          <i class="fas fa-user"></i>
          <span class="nav-item">New</span>
        </a></li>
        <li><a href="./viewstudent.php" class="active-navbar">
          <i class="fas fa-eye"></i>
          <span class="nav-item">View</span>
        </a></li>
        <li><a href="./updatestudent.php">
          <i class="fas fa-wrench"></i>
          <span class="nav-item">Edit</span>
        </a></li>
        <li><a href="./deletetudent.php">
          <i class="fas fa-trash"></i>
          <span class="nav-item">Remove</span>
        </a></li>
        <li><a href="./logout.php" class="logout">
          <i class="fas fa-sign-out-alt"></i>
          <span class="nav-item">Log out</span>
        </a></li>
      </ul>
</span>
    </nav>

    <section class="main">
      <div class="main-top">
        <h1>View Student</h1>
      </div>


    <table>
      <thead>
        <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Gender</th>
        </tr>
      </thead>

      <tbody>

      <?php  
      
      $query = "SELECT * FROM students";
      $result = mysqli_query($conn, $query);

      if(!$result){
        die("Query failed".mysqli_error($conn));
      }else{
        while($row = mysqli_fetch_assoc($result)){

          ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['fname']; ?></td>
                <td><?= $row['lname']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['age']; ?></td>
                <td><?= $row['gender'] == 0 ? "Female" : "Male"; ?></td>
          </tr>
          <?php

        }
      }

      logger("$userName Viewed student entries.");

      ?>


       
      
      </tbody>
    </table>





  </div>



 
</body>
</html></span>


    
<?php 
}else{
    // header("Location: ../loginpage/index.php");
    // exit();
}
?>


