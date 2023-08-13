<?php require_once("../Includes/DB.php"); ?>
<?php require_once("../Includes/Functions.php"); ?>
<?php require_once("../Includes/Sessions.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
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
    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><i class="fas fa-blog" style="color:#27aae1;"></i>Blog Posts</h1>
                </div>
                <div class="col-lg-3 mb-2">
                    <a href="AddNewPost.php" class="btn btn-primary btn-block">
                        <i class="fas fa-edit"></i>Add New Post
                    </a>
                </div>
                <div class="col-lg-3 mb-2">
                    <a href="Categories.php" class="btn btn-info btn-block">
                        <i class="fas fa-folder-plus"></i>Add New Category
                    </a>
                </div>
                <div class="col-lg-3 mb-2">
                    <a href="Admins.php" class="btn btn-warning btn-block">
                        <i class="fas fa-user-plus"></i>Add New Admin
                    </a>
                </div>
                <div class="col-lg-3 mb-2">
                    <a href="Comments.php" class="btn btn-success btn-block">
                        <i class="fas fa-check"></i>Approve Comments
                    </a> 
                </div>

            </div>
        </div>
    </header>
    <!-- header end -->
    <!-- main area -->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date&Time</th>
                        <th>Author</th>
                        <th>Banner</th>
                        <th>Comments</th>
                        <th>Action</th>
                        <th>Live Preview</th>
                    </tr>
                    </thead>
                    <?php
                    global $ConnectingDB;
                    $sql = "SELECT * FROM posts";
                    $stmt = $ConnectingDB->query($sql);
                    $Sr = 0;
                    while ($DataRows = $stmt->fetch()){
                        $Id = $DataRows["id"];
                        $DataTime = $DataRows["datetime"];
                        $PostTitle = $DataRows["title"];
                        $Category = $DataRows["category"]; 
                        $Admin = $DataRows["author"];
                        $Image = $DataRows["image"];
                        $PostText = $DataRows["post"];
                        $Sr++;
                    
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $Sr; ?></td>
                        <td>
                             <?php if (strlen($PostTitle)>20){$PostTitle= substr($PostTitle,0,18).'..';}
                            echo $PostTitle; ?></td>
                        <td>
                        <?php if (strlen($Category)>8){$Category= substr($Category,0,8).'..';}
                             echo $Category; ?></td>
                        <td>
                            <?php if (strlen($DateTime)>11){$DateTime= substr($DateTime,0,11).'..';}
                            echo $DataTime; ?></td>
                        <td >
                        <?php if (strlen($Admin)>6){$Admin= substr($Admin,0,6).'..';}
                             echo $Admin; ?></td>
                        <td><img src="Uploads/<?php echo $Image; ?>" width="170px;" height="50px"></td>

                        <td>Comments</td>
                        <td><a href="EditPost.php?id=<?php echo $Id; ?>"><span class="btn btn-warning">Edit</span></a>
                            <a href="DeletePost.php?id=<?php echo $Id; ?>"><span class="btn btn-danger">Delete</span></a>
                    </td>
                        <td><a href="FullPost.php?id=<?php echo $Id;  ?>" target="-blank"><span class="btn btn-primary">Live Preview</span></a>
                    </td>
                        
                    </tr>
                    </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>

    </section>
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