<?php
include('../dbconn.php');
include "../loginpage/logging.php"; // Include the logging file

session_start();
$userName = isset($_SESSION['name']) ? $_SESSION['name'] : "Unknown User";

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
    // Store submitted values in session variables
    $_SESSION['submittedValues'] = $_POST;

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
    }
} else {
    // If there are submitted values in session, use them to populate the form fields
    if (isset($_SESSION['submittedValues'])) {
        $submittedValues = $_SESSION['submittedValues'];
        unset($_SESSION['submittedValues']); // Clear the session variable
    }
}
?>

<!-- ... (your existing HTML code) ... -->

<?php if (!empty($errorMsg)) : ?>
    <h6 id='message' style="color: red;"><?= $errorMsg ?></h6>
<?php endif; ?>


<script>

  function hideMessage() {
    var messageElement = document.getElementById("message");
    if (messageElement) {
      messageElement.style.display = "none";
    }
  }

  var insertMsg = document.getElementById('insertmsg');

// Function to hide the insertmsg element
function hideInsertMsg() {
  insertMsg.style.display = 'none';
}

// Add event listeners to the document body for keydown and mousedown events
document.body.addEventListener('keydown', hideInsertMsg);
document.body.addEventListener('mousedown', hideInsertMsg);
  
</script>

</body>
</html></span>