<?php require_once("../Includes/DB.php"); ?>
<?php require_once("../Includes/Functions.php"); ?>
<?php require_once("../Includes/Sessions.php"); ?>

<?php
if(isset($_POST["Submit"])){
    $Category = $_POST["CategoryTitle"];
    $Admin = "Jazeb";
    date_default_timezone_set("Asia/Karachi");
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);

    if(empty($Category)){
        $_SESSION["ErrorMessage"] = "All fields must be filled out";
        Redirect_to("Categories.php");
    } elseif (strlen($Category) < 3){
        $_SESSION["ErrorMessage"] = "Category title should be greater than 2 characters";
        Redirect_to("Categories.php");  
    } elseif (strlen($Category) > 49){
        $_SESSION["ErrorMessage"] = "Category title should be less than 50 characters";
        Redirect_to("Categories.php");
    } else {
        global $ConnectingDB;

        $sql = "INSERT INTO category(title, author, datetime) VALUES(:categoryName, :adminName, :dateTime)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':categoryName', $Category);
        $stmt->bindValue(':adminName', $Admin);
        $stmt->bindValue(':dateTime', $DateTime);

        $Execute = $stmt->execute(); // Corrected variable name

        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Category with id: " . $ConnectingDB->lastInsertId() . " added Successfully";
            Redirect_to("Categories.php");
        } else {
            $_SESSION["ErrorMessage"] = "Something went wrong. Try Again!";
            Redirect_to("Categories.php");
        }
    } 
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- ... rest of your HTML code ... -->
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- navbar -->
    <div style="height:10px; background: #27aae1;"></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container" >
        <a href="#" class="navbar-brand">JAZEBAKRAM.COM</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarcollapseCMS">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="MyProfile.php" class="nav-link"><i class="fas fa-user text-success"></i> MY Profile</a>
            </li>
            <li class="nav-item">
                <a href="Dashboard.php" class="nav-link"> Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="Posts.php" class="nav-link">Posts</a>
            </li>
            <li class="nav-item">
                <a href="Categories.php" class="nav-link">Categories</a>
            </li>
            <li class="nav-item">
                <a href="Admins.php" class="nav-link">Manage Admins</a>
            </li>
            <li class="nav-item">
                <a href="Comments.php" class="nav-link">Comments</a>
            </li>
            <li class="nav-item">
                <a href="Blog.php?page=1" class="nav-link">Live Blog</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="Logout.php" class="nav-link text-danger">
                <i class="fas fa-user-times"></i>Logout</a></li>
        </ul>
        </div>
        </div>
    </nav>
    <div style="height:10px; background: #27aae1;"></div>
    <!-- navbar end -->
    <!-- HEADER -->
    <header class="bg-dark text-white  py-3">
        <div class="container">
            <div class="row">
                <div class="col md-12">
                    <h1><i class="fas fa-edit" style="color:#27aae1;"></i>Manage Categories</h1>
                </div>
            </div>
        </div>
    </header>
    <!-- header end here -->
    <!-- main area -->
    <section class="container py-2 mb-4">
        <div class="row" >
        <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
        <?php echo ErrorMessage();
        echo SuccessMessage();
        ?>
        <form class="" action="Categories.php" method="post">
            <div class="card bg-secondary text-light mb-3">
                <div class="card-header">
                    <h1>Add New Category</h1>
                </div>
            <div class="card-body bg-dark">
                <div class="form-group">
                    <label for="title"> <span class="FieIdInfo">Category Title:</span></label>
                    <input class="form-control" type="text" name="CategoryTitle" id="title" placeholder="Type title here" value="">
                </div>
                <div class="row" >
                <div class="col-lg-6 mb-2">
                    <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i>Back To Dashboard</a>
                </div>
                <div class="col-lg-6 mb-2"> <!-- Corrected class name -->
                    <button name="Submit" type="submit" class="btn btn-success btn-block">
                        <i class="fas fa-check"></i> Publish
                    </button>
                </div>

            </div>
            </div>
            </div>
        </form>
        </div>
    </div>
    </section>
<!-- main area ends here  -->
    <!-- footer -->
    <footer class="bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="lead text-center">Theme By |Jazem Aram |<span id="year"></span> &copy; ----All right Reserved.</p>
                    <p class="text-center small"><a style="color: white; text-decoration: none; cursor:pointer;" href="https://jazebakram.com/coupons/" target="_blank">
                        This site is only used for Study purpose jazebakram.com have all the righs. no one is allow to distribute
                        copies other then <br>&trade; jazebakram.com &trade; Udemy ; &trade; Sillshare ; &trade;Stackskills
                    </a></p>

                </div>
            </div>
        </div>
    </footer>
     <div style="height:10px; background: #27aae1;"></div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $('#year').text(new Date().getFullYear());
</script>
</body>
</html>