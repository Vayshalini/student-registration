<?php

include('../dbconn.php');

session_start();
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
        <li><a href="./viewstudent.php" >
          <i class="fas fa-eye"></i>
          <span class="nav-item">View</span>
        </a></li>
        <li><a href="./updatestudent.php" class="active-navbar">
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
        <h1>Edit Student Info</h1>
      </div>


    <table>
      <thead>
        <tr class="updatepagetbhead">
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Gender</th>

        </tr>
      </thead>

      <?php 
          if(isset($_GET['update_msg'])){
            echo "<p id='updatemsg'>".$_GET['update_msg']."</p>";
          }
        
        ?>



      <tbody>

      <?php  
      
      $query = "SELECT * FROM students";
      $result = mysqli_query($conn, $query);

      if(!$result){
        die("Query failed".mysqli_error($conn));
      }else{
        while($row = mysqli_fetch_assoc($result)){

          ?>
          <tr onclick="location.href = './editnewstudent.php?id=<?= $row['id']; ?>';" style="cursor: pointer;">
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

      ?>


       
      
      </tbody>
    </table>


  </div>

  <script>
      var updateMsg = document.getElementById('updatemsg');

// Function to hide the insertmsg element
function hideUpdateMsg() {
    updateMsg.style.display = 'none';
}

// Add event listeners to the document body for keydown and mousedown events
document.body.addEventListener('keydown', hideUpdateMsg);
document.body.addEventListener('mousedown', hideUpdateMsg);



  </script>
</body>
</html></span>



<?php 
}else{
    // header("Location: ../loginpage/index.php");
    // exit();
}
?>


