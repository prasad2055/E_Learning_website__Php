<?php
// Start the session
session_start();

// if the user is already logged in then redirect user to welcome page

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="#">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/login_system/index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Categories
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="contact.php">Contact</a>
      </li>
    </ul>';

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

        echo'<form class="d-flex mx-3" role="search ">
                <input class="form-control me-2  " type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
                <p class="text-light my-0 mx-2">Welcome '. $_SESSION['useremail']. ' </p>
                <a href="partials/_logout.php" class="btn btn-outline-success my-1">Logout</a>
            </form>';
      }
      else{
        echo'<form class="d-flex mx-4" role="search ">
                <input class="form-control me-2  " type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success " type="submit">Search</button>
            </form>
      
      <button  class="btn btn-outline-info mx-1" data-bs-toggle="modal" data-bs-target="#loginModal">LogIn</button>
      <button  class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>';
      
    }


 echo '</div>

 
</div>
</nav>';

require 'partials/_loginModal.php';  
require 'partials/_signupModal.php';  
    
if(isset($_GET['userid']) && $_GET['userid']== "true"){
  // header("location: /login_system/index.php");
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
          <strong>Success!</strong> You can now login.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';

}


?>







