<!-- Intro -->

<?php

include('../dbconn.php');
include "../loginpage/logging.php"; // Include the logging file

session_start();
$userName = isset($_SESSION['name']) ? $_SESSION['name'] : "Unknown User"; // Information - Logging page
if(isset($_SESSION['id']) && isset($_SESSION['email'])){  // contains logined user info

?>

<!-- -------------------------------------------------------------------------------- -->
<!-- Dashboard -->

<!DOCTYPE html>
<span style="font-family: verdana, geneva, sans-serif;">

<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="style.css" />
  <!-- Include SweetAlert CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>

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


<!-- -------------------------------------------------------------------------------- -->
<!-- Derive Data from SQL -->

<?php
if(isset($_GET['id'])){
  $id = $_GET['id'];


  $query = "SELECT * FROM students WHERE id = $id";
  $result = mysqli_query($conn, $query);

  if(!$result){
    die("Query failed".mysqli_error($conn));
  }else{
    $row = mysqli_fetch_assoc($result);

  }
    
}
  
?>


<!-- -------------------------------------------------------------------------------- -->
<!-- Update Students Info -->

<?php
if (isset($_POST['update_students'])) {

    if(isset($_GET['id_new'])){
      $idnew = $_GET['id_new'];
    }
  
    $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $age = (int)$_POST['age']; // Ensure age is treated as an integer
    $gender = isset($_POST['gender']) ? (int)$_POST['gender'] : 0; // Ensure gender is treated as an integer

    $query = "UPDATE students SET fname = '$fname', lname = '$lname', email = '$email', age = $age, gender = $gender WHERE id = $idnew";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    } else {
        logger("$userName Edited a student entry.");
        header("Location: updatestudent.php?update_msg=Student Info Updated Successfully");
        
        exit(); // Ensure that the script exits after a successful update
    }

    }


?>

<!-- -------------------------------------------------------------------------------- -->
<!-- Form -->


<form class="student-form" action="editnewstudent.php?id_new=<?= $id; ?>" method="post" onsubmit="return validateForm(this)">
      <div class="form-group">
        <label for="firstname">First Name</label>
        <input type="text" id="firstname" value="<?= $row['fname']?>" name="firstname" oninput="validateText(this)" required>
      </div>
      <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" id="lastname" value="<?= $row['lname']?>" name="lastname" oninput="validateText(this)" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" value="<?= $row['email']?>" name="email" required>
      </div>
      <div class="form-group">
        <label for="age">Age</label>
        <input type="number" id="age" value="<?= $row['age']?>" name="age" oninput="validateAge(this)" required>
      </div>
      <div class="form-group">
        <label>Gender</label>
      <br />

        <div class="form-group">
          <input type="radio" id="male" name="gender" value="1" <?php if (isset($row['gender']) && $row['gender'] == 1) echo 'checked'; ?>>
          <label for="male" class="gender-label">Male</label>
          <input type="radio" id="female" name="gender" value="0" <?php if (isset($row['gender']) && $row['gender'] == 0) echo 'checked'; ?> >
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

      <input type="submit" class= "btn" name="update_students" value="Update Info">
      <a href="javascript:history.go(-1);" class="btn-back">Back</a>
    </form>

<!-- Verify Input Fields are Valid - Not Numeric -->

<script>
  // Text Validity
  function validateText(input) {
    var regex = /^[A-Za-z]+$/;
    if (!regex.test(input.value)) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Please enter only text (no numeric characters).',
      });
      input.value = input.value.replace(/[^A-Za-z]/g, ''); // Remove numeric characters
    }
  }

// Age validity
function validateForm(form) {
        var ageInput = form.querySelector('#age');
        var age = ageInput.value;

        // Check if age is not a number or if it's less than 18 or greater than 30
        if (isNaN(age) || age < 18 || age > 30) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter a valid age between 18 and 30.',
            });
            return false; // Prevent form submission
        }

        // If age is valid, allow form submission
        return true;
    }


</script>



<!-- Enclosing Edit Student Page -->
<?php
}


?>