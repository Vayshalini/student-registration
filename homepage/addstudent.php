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
  <link rel="stylesheet" href="style.css" />
  
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
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
        <li><a href="./addstudent.php" class="active-navbar">
          <i class="fas fa-user"></i>
          <span class="nav-item">New</span>
        </a></li>
        <li><a href="./viewstudent.php">
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
    </nav>

    <section class="main">
      <div class="main-top">
        <h1>Add Student</h1>
      </div>
     
   








      <?php


// Initialize variables to store form values and error message
$submittedValues = array(
    'firstname' => '',
    'lastname' => '',
    'email' => '',
    'age' => '',
    'gender' => '',
);

$errorMsg = '';


if (isset($_POST['add_students'])) {
  $fname = $_POST['firstname'];
  $lname = $_POST['lastname'];
  $email = $_POST['email'];
  $age = $_POST['age'];
  $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

  // Validate first name
  if (!ctype_alpha($fname)) {
      $errorMsg = "Please enter alphabetic characters for the first name";
  }

  // Validate last name
  elseif (!ctype_alpha($lname)) {
      $errorMsg = "Please enter alphabetic characters for the last name";
  }

  // Validate age
  elseif ($age < 18 || $age > 30) {
      $errorMsg = "Invalid age. Age should be between 18 and 30.";
  }

  // Validate email
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errorMsg = "Invalid email address";
  }

  if (empty($errorMsg)) {
      // Use prepared statement to insert data safely
      $query = "INSERT INTO students (fname, lname, email, age, gender) VALUES (?, ?, ?, ?, ?)";
      $stmt = mysqli_prepare($conn, $query);

      if ($stmt) {
          // Bind the parameters
          mysqli_stmt_bind_param($stmt, "sssis", $fname, $lname, $email, $age, $gender);

          // Execute the statement
          if (mysqli_stmt_execute($stmt)) {
              logger("$userName Inserted a new student entry.");
              header("Location: addstudent.php?insert_msg=New student added successfully.");
              exit; // Ensure script stops execution after redirect
          } else {
              die("Query Failed: " . mysqli_error($conn));
          }

          // Close the statement
          mysqli_stmt_close($stmt);
      } else {
          die("Prepared statement error: " . mysqli_error($conn));
      }
  } else {
      // Store submitted values in the array for repopulating the form fields
      $submittedValues = array(
          'firstname' => $fname,
          'lastname' => $lname,
          'email' => $email,
          'age' => $age,
          'gender' => $gender,
      );
  }
}
?>

<!-- ... (your existing HTML code) ... -->

<?php if (!empty($errorMsg)) : ?>
    <h6 id='message' style="color: red;"><?= $errorMsg ?></h6>
<?php endif; ?>








  
   
    <form class="student-form" action="addstudent.php" method="post">
      <div class="form-group">
        <label for="firstname">First Name</label>
        <input type="text" id="firstname" name="firstname" required>
      </div>
      <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" id="lastname" name="lastname" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="age">Age</label>
        <input type="number" id="age" name="age" required>
      </div>
      <div class="form-group">
        <label>Gender</label>

        

      <br />

        <div class="form-group">
          <input type="radio" id="male" name="gender" value=1 onclick="hideMessage()">
          <label for="male" class="gender-label">Male</label>
          <input type="radio" id="female" name="gender" value=0 onclick="hideMessage()">
          <label for="female" class="gender-label">Female</label>
        </div>
        <br />

        

        <?php 
          if(isset($_GET['message'])){
            echo "<h6 id='message'>".$_GET['message']."</h6>";
          }
        
        ?>

      <?php 
          if(isset($_GET['insert_msg'])){
            echo "<p id='insertmsg'>".$_GET['insert_msg']."</p>";
          }
        
        ?>




      </div>

      <input type="submit" class= "btn" name="add_students" value="Add Student">
      <input type="reset" class= "btn-clear" value="Clear">
    </form>

     


  </div>


<script>

  function hideMessage() {
    var messageElement = document.getElementById("message");
    if (messageElement) {
      messageElement.style.display = "none";
    }
  }

  var insertMsg = document.getElementById('insertmsg');
  var insertMsg = document.getElementById('message');

// Function to hide the insertmsg element
function hideInsertMsg() {
  insertMsg.style.display = 'none';
  message.style.display = 'none';
}

// Add event listeners to the document body for keydown and mousedown events
document.body.addEventListener('keydown', hideInsertMsg);
document.body.addEventListener('mousedown', hideInsertMsg);
  
</script>

</body>
</html></span>



<?php 
}else{
    // header("Location: ../loginpage/index.php");
    // exit();
}
?>