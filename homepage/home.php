<?php

session_start();
if(isset($_SESSION['id']) && isset($_SESSION['email'])){

?>

<!DOCTYPE html>
<span style="font-family: verdana, geneva, sans-serif;">

<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Knowledge Institute</title>
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
        <li><a href="./home.php" class="active-navbar">
          <i class="fas fa-home"></i>
          <span class="nav-item">Home</span>
        </a></li>
        <li><a href="./addstudent.php" >
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

    <section class="main" style="background-color: #f9f9f9;">
      
     
      <section id="carousal-sec">
     <div class="carousal-sty">

 

        <p style="font-size: 18px; font-family: 'Helvetica Neue', sans-serif; color: #333; text-align: center; background-color: #f9f9f9; padding: 15px;">
  Elevate your future at <strong style="color: #0077b5;">Knowledge Institute</strong> - Where Knowledge Meets Opportunity!
</p>


        <section class="carousel" aria-label="Gallery">
          <ol class="carousel__viewport">
            <li id="carousel__slide1"
                tabindex="0"
                class="carousel__slide">
              <div class="carousel__snapper">
                <a href="#carousel__slide4"
                  class="carousel__prev">Go to last slide</a>
                <a href="#carousel__slide2"
                  class="carousel__next">Go to next slide</a>
                 
              </div>
            </li>
            <li id="carousel__slide2"
                tabindex="0"
                class="carousel__slide">
              <div class="carousel__snapper"></div>
              <a href="#carousel__slide1"
                class="carousel__prev">Go to previous slide</a>
              <a href="#carousel__slide3"
                class="carousel__next">Go to next slide</a>
            </li>
            <li id="carousel__slide3"
                tabindex="0"
                class="carousel__slide">
              <div class="carousel__snapper"></div>
              <a href="#carousel__slide2"
                class="carousel__prev">Go to previous slide</a>
              <a href="#carousel__slide4"
                class="carousel__next">Go to next slide</a>
            </li>
            <li id="carousel__slide4"
                tabindex="0"
                class="carousel__slide">
              <div class="carousel__snapper"></div>
              <a href="#carousel__slide3"
                class="carousel__prev">Go to previous slide</a>
              <a href="#carousel__slide1"
                class="carousel__next">Go to first slide</a>
            </li>
          </ol>
          <aside class="carousel__navigation">
            <ol class="carousel__navigation-list">
              <li class="carousel__navigation-item">
                <a href="#carousel__slide1"
                  class="carousel__navigation-button">Go to slide 1</a>
              </li>
              <li class="carousel__navigation-item">
                <a href="#carousel__slide2"
                  class="carousel__navigation-button">Go to slide 2</a>
              </li>
              <li class="carousel__navigation-item">
                <a href="#carousel__slide3"
                  class="carousel__navigation-button">Go to slide 3</a>
              </li>
              <li class="carousel__navigation-item">
                <a href="#carousel__slide4"
                  class="carousel__navigation-button">Go to slide 4</a>
              </li>
            </ol>
          </aside>
        </section>




      </div>
     </section>


  </div>
</body>
</html></span>



<?php 
}else{
    // header("Location: ../loginpage/index.php");
    // exit();
}
?>