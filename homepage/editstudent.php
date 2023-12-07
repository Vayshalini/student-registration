<?php

include('../dbconn.php');

include "../loginpage/logging.php"; // Include the logging file


$userName = isset($_SESSION['name']) ? $_SESSION['name'] : "Unknown User";

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



    <?php 

      

      if (!ctype_alpha($fname)) {
          echo "<p>Please enter alphabetic characters for the first name</p>";
      } else if (!ctype_alpha($lname)) {
          echo "<p>Please enter alphabetic characters for the last name</p>";
      } else if ($age < 18 || $age > 30) {
          echo "<p>Invalid age. Age should be between 18 and 30.</p>";
      } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo "<p>Invalid email address.</p>";
      }

      
      
      else if(!empty($errorMsg) || isset($_GET['id'])){
      displayStudentForm($conn, $row, $errorMsg);

      }else{
      // Display form only if there is an error or 'id' is set
        ?>




      <?php
// Function definition for getting student data by ID

function getStudentDataById($conn, $id) {
  $query = "SELECT * FROM students WHERE id = $id";
  $result = mysqli_query($conn, $query);

  if (!$result) {
      die("Query failed: " . mysqli_error($conn));
  } else {
      $row = mysqli_fetch_assoc($result);
      return $row;
  }
}

// Function definition for displaying student form
function displayStudentForm($conn, $submittedData) {
  $id = isset($_GET['id']) ? $_GET['id'] : '';

  // Fetch student data if 'id' is set
  if (!empty($id)) {
      $row = getStudentDataById($conn, $id);
  } else {
      $row = [];
  }
?>
   
      <form class="student-form" action="editstudent.php?id_new=<?= isset($id) ? $id : '' ?>" method="post">
      <div class="form-group">
        <label for="firstname">First Name</label>
  
        <input type="text" id="firstname" value="<?= isset($submittedData['firstname']) ? $submittedData['firstname'] : (isset($row['fname']) ? $row['fname'] : '') ?>" name="firstname" required>
      </div>
      <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" id="lastname" value="<?= isset($submittedData['lastname']) ? $submittedData['lastname'] : (isset($row['lname']) ? $row['lname'] : '') ?>" name="lastname" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" value="<?= isset($submittedData['email']) ? $submittedData['email'] : (isset($row['email']) ? $row['email'] : '') ?>" name="email" required>
      </div>
      <div class="form-group">
        <label for="age">Age</label>
        <input type="number" id="age"  value="<?= isset($submittedData['age']) ? $submittedData['age'] : (isset($row['age']) ? $row['age'] : '') ?>" name="age" required>
      </div>
      <div class="form-group">
        <label>Gender</label>

        <?php 
          if(isset($_GET['message'])){
            echo "<h6 id='message'>".$_GET['message']."</h6>";
          }
        
        ?>

    

      <br />

        <div class="form-group">
      
        <input type="radio" id="male" name="gender" value="1" <?php if (isset($row['gender']) && $row['gender'] == 1) echo 'checked'; ?> >
        <label for="male" class="gender-label">Male</label>
        <input type="radio" id="female" name="gender" value="0" <?php if (isset($row['gender']) && $row['gender'] == 0) echo 'checked'; ?> >
        <label for="female" class="gender-label">Female</label>




        </div>
        <br />
      </div>

      <input type="submit" class= "btn" name="update_students" value="Update Info">
      <a href="javascript:history.go(-1);" class="btn-back">Back</a>

    </form>


        <?php
    }

    // Initialize these variables before calling the function
    $submittedData = isset($_POST) ? $_POST : [];


    displayStudentForm($conn, $submittedData);

      ?>

<?php
if (isset($_POST['update_students'])) {
    if (isset($_GET['id_new'])) {
        $idnew = $_GET['id_new'];

    }

    $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $age = (int)$_POST['age']; // Ensure age is treated as an integer
    $gender = isset($_POST['gender']) ? (int)$_POST['gender'] : 0; // Ensure gender is treated as an integer


 
    

    $query = "UPDATE students SET fname = '$fname', lname = '$lname', email = '$email', age = $age, gender = $gender WHERE id = $idnew";

    $data = mysqli_query($conn, $query);

    if (!$data) {
        die("Query failed: " . mysqli_error($conn));
    } else {
        logger("$userName Edited a student entry.");
        header("Location: updatestudent.php?update_msg=Student Info Updated Successfully");
        
        exit(); // Ensure that the script exits after a successful update
    }

}
}
?>



<!-- // Validate first name
     if (!ctype_alpha($fname)) {
      header("Location: editstudent.php?message=Please enter alphabetic characters only for the first name");
      exit;
  }

  // Validate last name
  else if (!ctype_alpha($lname)) {
      header("Location: editstudent.php?message=Please enter alphabetic characters only for the last name");
      exit;
  }

  // Validate age
  else if ($age < 18 || $age > 30) {
      header("Location: editstudent.php?message=Invalid age. Age should be between 18 and 30.");
      exit;
  }

  // Validate email
  else if  (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: editstudent.php?message=Invalid email address");
      exit;


  } -->

 


    <?php if (!empty($errorMsg)) : ?>
    <h6 id='message' style="color: red;"><?= $errorMsg ?></h6>
<?php endif; ?>

  </div>



  <!-- <script>

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
  -->
</body>
</html></span>



<?php 
}else{
    // header("Location: ../loginpage/index.php");
    // exit();
}
?>


