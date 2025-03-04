<!DOCTYPE html>
<html lang="en">

<?php


session_start();
error_reporting(0);
include("../connection/connect.php");

if (isset($_POST['submit'])) {
    if (
        empty($_POST['uname']) ||
        empty($_POST['fname']) ||
        empty($_POST['lname']) ||
        empty($_POST['email']) ||
        empty($_POST['password']) ||
        empty($_POST['phone'])
    ) {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>All fields Required!</strong>
															</div>';
    } else {




        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
        {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>invalid email!</strong>
															</div>';
        } elseif (strlen($_POST['password']) < 6) {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Password must be >=6!</strong>
															</div>';
        } elseif (strlen($_POST['phone']) < 10) {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>invalid phone!</strong>
															</div>';
        } else {


            $mql = "update users set username='$_POST[uname]', f_name='$_POST[fname]', l_name='$_POST[lname]',email='$_POST[email]',phone='$_POST[phone]',password='" . md5($_POST['password']) . "' where u_id='$_GET[user_upd]' ";
            mysqli_query($db, $mql);
            $success =     '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>User Updated!</strong></div>';
        }
    }
}

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Update Users</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        /* ======= Sidebar Styles ======= */
        .left-sidebar {
            width: 250px;
            background-color: #f8f9fa;
            /* O nuanță gri-deschis pentru contrast */
            position: fixed;
            height: 100vh;
            padding-top: 20px;
        }

        /* Stilizare listă de navigație */
        .left-sidebar .sidebar-nav ul {
            list-style: none;
            padding: 0;
        }

        .left-sidebar .sidebar-nav ul li {
            padding: 10px 20px;
        }

        /* Link-urile din sidebar */
        .left-sidebar .sidebar-nav ul li a {
            text-decoration: none;
            color: #333;
            /* Gri închis pentru vizibilitate */
            font-size: 16px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            padding: 10px;
            border-radius: 5px;
        }

        /* Iconițele */
        .left-sidebar .sidebar-nav ul li a i {
            margin-right: 10px;
            font-size: 18px;
        }

        /* Efect la hover */
        .left-sidebar .sidebar-nav ul li a:hover {
            background-color: #1a252f;
            /* Albastru închis */
            color: white;
        }

        /* ======= Responsive Design ======= */
        @media (max-width: 768px) {
            .left-sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
            }
        }

        @media (max-width: 480px) {
            .left-sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
                padding: 10px;
            }

            .dashboard-cards {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
        }
    </style>
</head>

<body class="fix-header">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="main-wrapper">

        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php">
                        <span><img src="images\logoadmin.png" style="max-width: 100px;" alt="homepage" class="dark-logo" /></span>
                    </a>
                </div>
                <div class="navbar-collapse">

                    <ul class="navbar-nav mr-auto mt-md-0">

                    </ul>

                    <ul class="navbar-nav my-lg-0">


                       
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/bookingSystem/user-icn.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="left-sidebar">

            <div class="scroll-sidebar">

                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                        <li class="nav-label">Log</li>
                        <li> <a href="all_users.php"> <span><i class="fa fa-user f-s-20 "></i></span><span>Utilizatori</span></a></li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 color-warning"></i><span class="hide-menu">Servicii</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_services.php">Toate Serviciile</a></li>
                                <li><a href="add_category.php">Adaugă Categorie</a></li>
                                <li><a href="add_services.php">Adaugă Serviciu</a></li>

                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Vinuri</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_wines.php">Toate Vinurile</a></li>
                                <li><a href="add_category_wine.php">Adaugă Categorie Vin</a></li>
                                <li><a href="add_wines.php">Adaugă vin</a></li>

                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Turism</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_tour.php">Toate Tipurile Turism</a></li>
                                <li><a href="add_tour.php">Adaugă Tur</a></li>
                            </ul>
                        </li>
                        <li> <a href="all_orders.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Comenzi</span></a></li>


                    </ul>
                </nav>

            </div>

        </div>

        <div class="page-wrapper" style="height:1200px;">


            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Dashboard</h3>
                </div>

            </div>


            <div class="container-fluid">

                <div class="row">



                    <div class="container-fluid">



                        <?php
                        echo $error;
                        echo $success;



                        ?>


                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Update Users</h4>
                                </div>
                                <div class="card-body">
                                    <?php $ssql = "select * from users where u_id='$_GET[user_upd]'";
                                    $res = mysqli_query($db, $ssql);
                                    $newrow = mysqli_fetch_array($res); ?>
                                    <form action='' method='post'>
                                        <div class="form-body">

                                            <hr>
                                            <div class="row p-t-20">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Username</label>
                                                        <input type="text" name="uname" class="form-control" value="<?php echo $newrow['username']; ?>" placeholder="username">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group has-danger">
                                                        <label class="control-label">First-Name</label>
                                                        <input type="text" name="fname" class="form-control form-control-danger" value="<?php echo $newrow['f_name'];  ?>" placeholder="jon">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row p-t-20">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Last-Name </label>
                                                        <input type="text" name="lname" class="form-control" placeholder="doe" value="<?php echo $newrow['l_name']; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group has-danger">
                                                        <label class="control-label">Email</label>
                                                        <input type="text" name="email" class="form-control form-control-danger" value="<?php echo $newrow['email'];  ?>" placeholder="example@gmail.com">
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Password</label>
                                                        <input type="text" name="password" class="form-control form-control-danger" value="<?php echo $newrow['password'];  ?>" placeholder="password">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Phone</label>
                                                        <input type="text" name="phone" class="form-control form-control-danger" value="<?php echo $newrow['phone'];  ?>" placeholder="phone">
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Save">
                                    <a href="all_users.php" class="btn btn-inverse">Cancel</a>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>

            </div>

            <?php include "include/footer.php" ?>

        </div>

    </div>

    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>

</body>

</html>