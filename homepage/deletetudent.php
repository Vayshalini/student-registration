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
        <li><a href="./updatestudent.php">
          <i class="fas fa-wrench"></i>
          <span class="nav-item">Edit</span>
        </a></li>
        <li><a href="./deletetudent.php" class="active-navbar">
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
        <h1>Delete Student Info</h1>
      </div>


    <table>
      <thead>
        <tr class="dltpagetbhead">
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Gender</th>
        </tr>
      </thead>
      <?php 
          if(isset($_GET['delete_msg'])){
            echo "<p id='deletemsg'>".$_GET['delete_msg']."</p>";
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
            <tr onclick="confirmDelete(<?= $row['id']; ?>);" style="cursor: pointer;">
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

    <div id="confirmationModal"class ="deleteconfirmationbox">
        <p class="deleteconfirm">Are you sure you want to delete this record?</p>
        <button class="btndeleteconfirm" onclick="deleteRecord()">Yes</button>
        <button class="btndeleteconfirm" onclick="cancelDelete()">No</button>
    </div>

    <script>
        let recordIdToDelete;

        function confirmDelete(id) {
            recordIdToDelete = id;
            const modal = document.getElementById("confirmationModal");
            modal.style.display = "block";
        }

        function deleteRecord() {
            if (recordIdToDelete) {
                location.href = `./removestudent.php?id=${recordIdToDelete}`;
            }
        }

        function cancelDelete() {
            const modal = document.getElementById("confirmationModal");
            modal.style.display = "none";
        }
   
            var dltMsg = document.getElementById('deletemsg');

      // Function to hide the insertmsg element
      function hideDeleteMsg() {
        dltMsg.style.display = 'none';
      }

      // Add event listeners to the document body for keydown and mousedown events
      document.body.addEventListener('keydown', hideDeleteMsg);
      document.body.addEventListener('mousedown', hideDeleteMsg);



  </script>


</body>
</html></span>



<?php 
}else{
    // header("Location: ../loginpage/index.php");
    // exit();
}
?>

