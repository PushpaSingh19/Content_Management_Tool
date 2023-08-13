<?php require_once("../Includes/DB.php"); ?>
<?php require_once("../Includes/Functions.php"); ?>
<?php require_once("../Includes/Sessions.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Page</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/Styles.css">
</head>

<body>
    <!-- navbar -->
    <div style="height:10px; background: #27aae1;"></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="#" class="navbar-brand">JAZEBAKRAM.COM</a>S
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarcollapseCMS">

                <ul class="navbar-nav mr-auto">
                    
                    <li class="nav-item">
                        <a href="Blog.php" class="nav-link"> Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="Blog.php" class="nav-link">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Features</a>
                    </li>
                    
                </ul>
                <ul class="navbar-nav ml-auto">
                   <form action="Blog.php" class="form-inline d-none d-sm-block">
                    <div class="form-group">
                        <input type="text" class="form-control mr-2" name="Search" placeholder="Search here" value="">
                        <button class="btn btn-primary"  name="SearchButton">Go</button>
                
                    </div>
                   </form>
                </ul>
            </div>
        </div>
    </nav>
    <div style="height:10px; background: #27aae1;"></div>
    <!-- navbar end -->
    <!-- HEADER -->
   <div class="container">
    <div class="row mt-4">
        <!-- main area start -->
        <div class="col-sm-8 " >
            <h1>The Complete Resposive CMS Blog</h1>
            <h1 class="lead"> The Complete blog by using PHP by PUshpa Singh</h1>
            <?php
            global $ConnectingDB;
            if(isset($_GET["SearchButton"])){
                $Search = $_GET["Search"];
                $sql = "SELECT * FROM posts WHERE datetime LIKE :search 
                OR title LIKE :search 
                OR category LIKE :saerch 
                OR post LIKE :search " ;
                $stmt = $ConnectingDB->prepare($sql);
                $stmt->bindValue(':search','%'.$Search.'%');
                $stmt->execute();
            }
            // THE DEFAULT SQL  QUERY
            else{
                $PostIdFromURL = $_GET["id"];
                if(!isset($PostIdFromURL)){
                    $_SESSION["ErrorMessage"]="Bad Request !";
                    Redirect_to("Blog.php");
                }
                $sql = "SELECT * FROM posts WHERE id= '$PostIdFromURL'";
                $stmt = $ConnectingDB->query($sql);
            }
            while ($DateRows = $stmt->fetch()){
                //code
                $PostId = $DateRows["id"];
                $DateTime = $DateRows["datetime"];
                $PostTitle = $DateRows["title"];
                $Category = $DateRows["category"];
                $Admin = $DateRows["author"];
                $Image = $DateRows["image"];
                $PostDescription = $DateRows["post"];

            ?>
            <div class="card">
                <img src="Uploads/<?php echo htmlentities($Image); ?>" alt="Error while loading image" style="min-height:450px;" class="img-fluid card-img-top" />
                <div class="card-body">
                    <h4 class="card-title"><?php echo htmlentities($PostTitle); ?></h4>
                    <small class="text-muted">Written by <?php echo htmlentities($Admin); ?> On <?php echo htmlentities($DateTime); ?></small>
                    <span class="badge badge-dark text-light" style="float:right;">Comments 20</span>
                    <hr>
                    <p class="card-text">
                        <?php echo htmlentities($PostDescription); ?></p>
                    
                </div>
            </div>
            <?php } ?>
        </div>
        <!-- main area end -->
        <!-- side area start here -->
        <div class=" col-sm-4" style="min-height:40px; background:green;">

        </div>
    </div>
   </div>
    <br>
    <!-- footer -->
    <footer class="bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="lead text-center">Theme By |Jazem Aram |<span id="year"></span> &copy; ----All right
                        Reserved.</p>
                    <p class="text-center small"><a style="color: white; text-decoration: none; cursor:pointer;"
                            href="https://jazebakram.com/coupons/" target="_blank">
                            This site is only used for Study purpose jazebakram.com have all the righs. no one is allow
                            to distribute
                            copies other then <br>&trade; jazebakram.com &trade; Udemy ; &trade; Sillshare ;
                            &trade;Stackskills
                        </a></p>

                </div>
            </div>

        </div>
    </footer>
    <div style="height:10px; background: #27aae1;"></div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script>
        $('#year').text(new Date().getFullYear());
    </script>
 
</body>
   
</html>