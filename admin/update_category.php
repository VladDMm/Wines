                <!DOCTYPE html>
                <html lang="en">
                <?php
                include("../connection/connect.php");
                error_reporting(0);
                session_start();


                if (isset($_POST['submit'])) {
                    if (empty($_POST['c_name'])) {
                        $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>field Required!</strong>
															</div>';
                    } else {






                        $mql = "update service_cat set c_name ='$_POST[c_name]' where c_id='$_GET[cat_upd]'";
                        mysqli_query($db, $mql);
                        $success =     '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Updated!</strong> Successfully.</br></div>';
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
                    <title>Update Category</title>
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
                                                <li><a href="add_wines.php">Adaugă Vin</a></li>


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

                        <div class="page-wrapper">
                            <!--  <div style="padding-top: 10px;">
                                <marquee onMouseOver="this.stop()" onMouseOut="this.start()"> <a href="https://www.youtube.com/@codecampbdofficial">Code Camp BD</a> is the sole owner of this script. It is not suitable for personal use. And releasing it in demo version. Besides, it is being provided for free only from <a href="https://www.youtube.com/@codecampbdofficial">Code Camp BD</a>. For any of your problems contact us on <a href="https://www.youtube.com/@codecampbdofficial">Code Camp BD</a> facebook group / page or message <a href="https://www.facebook.com/dev.mhrony">MH RONY</a> on facebook. Thanks for staying with <a href="https://www.youtube.com/@codecampbdofficial">Code Camp BD</a>.</marquee>
                            </div> -->

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
                                        echo $success; ?>




                                        <div class="col-lg-12">
                                            <div class="card card-outline-primary">
                                                <div class="card-header">
                                                    <h4 class="m-b-0 text-white"></h4>
                                                </div>
                                                <div class="card-body">
                                                    <form action='' method='post'>
                                                        <div class="form-body">
                                                            <?php $ssql = "select * from service_cat where c_id='$_GET[cat_upd]'";
                                                            $res = mysqli_query($db, $ssql);
                                                            $row = mysqli_fetch_array($res); ?>
                                                            <hr>
                                                            <div class="row p-t-20">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Category</label>
                                                                        <input type="text" name="c_name" value="<?php echo $row['c_name'];  ?>" class="form-control" placeholder="Category Name">
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class="form-actions">
                                                                <input type="submit" name="submit" class="btn btn-primary" value="Save">
                                                                <a href="add_category.php" class="btn btn-inverse">Cancel</a>
                                                            </div>
                                                    </form>
                                                </div>
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