<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>coding Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <?php require 'partials/_header.php'?>
    <?php require 'partials/_dbconnect.php'?>



    <!-- Start changable slider -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>

        
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2400x700/?apple,code" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?programmers,microsoft" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?nature,water" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <script>
    // Activate the carousel
    var myCarousel = document.querySelector('#carouselExampleIndicators');
    var carousel = new bootstrap.Carousel(myCarousel, {
        interval: 3000, // Change slides every 3 seconds
        wrap: true // Allow wrapping from last to first slide
    });
    </script>

    <!-- start category container  -->
    <div class="container my-2">
        <h2 class="text-center"> welcome to the categories page</h2>
        <div class="row my-3">
            <!-- fetch all the categories and use  loop to iteration through categories  -->

            <?php 
                  $sql= "SELECT*FROM `categories`";
                  $result = mysqli_query($conn, $sql);
                  while($row = mysqli_fetch_assoc($result)){
                  // echo $row['category_id'];
                  // echo $row['category_name'];
                  $id= $row['category_id'];
                  $cat = $row['category_name'];
                  $cat_desc = $row['category_description'];
                  
                  echo  '<div class="col-md-4">
                          <div class="card mb-4" style="width: 18rem;">
                            <img src="https://source.unsplash.com/1200x700/?'.$cat. ',coding" class="card-img-top"   alt="...">
                          <div class="card-body">
                          <h5 class="card-title"><a href="threadlist.php?catid='.$id.'">'.$cat.' </a></h5>
                          <p class="card-text">'.substr($cat_desc,0,50).'</p>
                          <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
                      </div>
                  </div>
               </div>';
                  }
            ?>

        </div>
    </div>
    <?php require 'partials/_footer.php'?>
    


</body>

</html>