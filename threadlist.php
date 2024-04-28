<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>coding Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <style>

                /* .jumbotron-custom {
                    width: 70%; /* Adjust the width as needed */
                    height: 330px; /* Adjust the height as needed */
                    margin: 0 auto; /* Center the jumbotron horizontally */
                    margin-right: 300px;
                    overflow: hidden; /* Ensure content doesn't overflow */
                } */

        </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <?php require 'partials/_header.php';?>
    <?php require 'partials/_dbconnect.php';?>

    <?php
    $id= $_GET['catid'];
    $sql="SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
          
    }
    
    ?>

    <?php 
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method=='POST'){
       //insert thread into database
       $th_title= $_POST['title'];
       $th_desc= $_POST['desc'];
       $sno= $_POST['sno'];
       $sql= "INSERT INTO `threads` (`thread_title`, `thread_dsc`, `thread_cat_id`, `thread_user_id`, `timestamp`) 
       VALUES ('$th_title', '$th_desc', '$id', '$sno', CURRENT_TIMESTAMP)";
       $result = mysqli_query($conn, $sql);
       $showAlert = true;
       if($showAlert){
         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> Your thread has been added! please wait for community to respond
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';
       }
    }   
    ?>

    <!-- start category container  -->
    <div class="container-sm my-4 bg-light jumbotron-custom">
        <div class="jumbotron ">
            <h1 class="display-5">Welcome to <?php echo $catname;?> system</h1>
            <p class="lead"><?php echo $catdesc?></p>
            <hr class="my-4">
            <p>TImportant Programming "Rules of Thumb" 1) K.I.S.S. (Keep It Simple, Stupid)
                2) "Rule of Three" (code duplication)
                3) Ninety-ninety rule ( failure to anticipate the hard parts)
                4) Efficiency vs. code clarity (chasing false efficiency)
                5) Naming of things (subprograms and variables)</p>
            <a class="btn btn-success btn-lg my-2" href="#" role="button">Learn more</a>
        </div>
    </div>

      <?php
       if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo '<div class="container">
                <h4 class="my-3">Start a Disscussions</h4>
                        <form action= " '.$_SERVER["REQUEST_URI"].' ".$id. method= "post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" >
                                <div id="emailHelp" class="form-text">keep your title short as possible.</div>
                            </div>

                            <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                            
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="desc" name="desc" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Elaborate your Concern</label>
                            </div>
                            
                            <button type="submit" class="btn btn-success my-2">Submit</button>
                        </form>
                </div>';
        }

        else{

           echo '<div class="contaener" style="margin-left: 200px;">
                   <h4 class="my-3">Start a Disscussions</h4>
                   <p class="lead"><i>You are not logged in.please login to start a Discussion</i></p>
                 </div>';
        }

        ?>


    <!-- use of media object -->
    <div class="container">
        <h4 class="my-4">Browse Questions</h4>

        <?php
                $id= $_GET['catid'];
                $sql= "SELECT * FROM `threads` WHERE thread_cat_id=$id";
                $result = mysqli_query($conn, $sql);
                $noResult = true;
                while($row = mysqli_fetch_assoc($result)){
                    $noResult = false;
                    $id = $row['thread_id'];
                    $title = $row['thread_title'];
                    $desc = $row['thread_dsc'];
                    $thread_time = $row['timestamp'];
                    $thread_user_id = $row['thread_user_id'];
                    $sql2 = "SELECT user_email FROM `users` WHERE sno= '$thread_user_id'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    

         echo '<div class="d-flex align-items-center my-2">
                <div class="flex-shrink-0">
                    <img src="img/userdefault.jpg" width="34px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                <p class="fw-bold my-0"> '.$row2['user_email'].' at '.$thread_time.'</p>
                    <h6 class> <a class ="text-dark" href="thread.php?threadid=' .$id. '">'.$title.' </a></h6>
                    '.$desc.'
                
                </div>
            </div>';
                  
         }
          if($noResult){
            echo '<div class="container-fluid my-3 bg-light">
                <p class="display-6"><i>No result found</i></p>
                <p class="lead"> Be the first person to ask a questions</6>
            
            </div>';
         }

        ?>


    </div>

    <?php require 'partials/_footer.php'?>

</body>

</html>