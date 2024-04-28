<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>coding Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <style>

         #ques{
            min-height: 480px;
         }


        </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <?php require 'partials/_header.php';?>
    <?php require 'partials/_dbconnect.php';?>


    <?php
    $id= $_GET['threadid'];
    $sql="SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $title = $row['thread_title'];
        $desc = $row['thread_dsc'];      
    }
    
    ?>


    <?php 
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method=='POST'){
            //insert comments  into database
            $comment= $_POST['comment'];
            $sno= $_POST['sno'];
            $sql= "INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`)
             VALUES ( '$comment', '$id', '$sno', CURRENT_TIMESTAMP)";
            $result = mysqli_query($conn, $sql);
            $showAlert = true;
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> Your comment has been added!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }   
    ?>

    <!-- start category container  -->
    <div class="container-sm my-4 bg-light">
        <div class="jumbotron ">
            <h1 class="display-5"><?php echo $title;?> system</h1>
            <p class="lead"><?php echo $desc?></p>
            <hr class="my-4">
            <p>Important Programming "Rules of Thumb" 1) K.I.S.S. (Keep It Simple, Stupid)
                    2) "Rule of Three" (code duplication)
                    3) Ninety-ninety rule ( failure to anticipate the hard parts)
                    4) Efficiency vs. code clarity (chasing false efficiency)
                    5) Naming of things (subprograms and variables)</p>
            <p>Posted by:<strong> Purushottam</strong></p>
        </div>
    </div>
    
    <?php
       if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo '<div class="container">
            <h4 class="my-3">Post a Comment</h4>
                   <form action= "'.$_SERVER['REQUEST_URI'].'".$id. method= "post">
                       <div class="form-floating">
                           <textarea class="form-control" placeholder="Leave a comment here" id="comment" name="comment" style="height: 100px"></textarea>
                           <label for="floatingTextarea2">Type your comment</label>

                           <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">

                       </div>
                       <button type="submit" class="btn btn-success my-3">Post Comment</button>
                   </form>
           </div>';
        }

        else{

           echo '<div class="contaener" style="margin-left: 200px;">
                   <h4 class="my-3">Post a Comment</h4>
                   <p class="lead"><i>You are not logged in.please login to Post a Comments</i></p>
                 </div>';
        }

        ?>

     <!-- use of media object -->
    <div class="container" id= "ques">
        <h4 class="my-3">Discussions</h4>

        <?php
            $id= $_GET['threadid'];
            $sql= "SELECT * FROM `comments` WHERE thread_id=$id";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)){
                $noResult = false;
                $id = $row['comment_id'];
                $content = $row['comment_content'];
                $comment_time= $row['comment_time'];

                   $thread_user_id = $row['comment_by'];
                    $sql2 = "SELECT user_email FROM `users` WHERE sno= '$thread_user_id'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                   

                echo '<div class="d-flex align-items-center my-2">
                    <div class="flex-shrink-0">
                        <img src="img/userdefault.jpg" width="34px" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3">
                    <p class="fw-bold my-0">'.$row2['user_email'].' at '.$comment_time.'</p>

                        '.$content.'
                    
                    </div>
                </div>';
                  
            }


            if($noResult){
                echo '<div class="container-fluid my-3 bg-light">
                    <p class="display-6"><i>No Comments found</i></p>
                    <p class="lead"> Be the first person to ask a questions</6>
                
                </div>';
            }

        ?>


    </div>

    <?php require 'partials/_footer.php'?>

</body>

</html>    