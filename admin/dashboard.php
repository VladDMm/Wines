<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if (empty($_SESSION["adm_id"])) {
    header('location:index.php');
} else {
?>


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Admin Panel</title>
        <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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

            /* ======= Dashboard Content ======= */
            .main-content {
                margin-left: 250px;
                padding: 20px;
            }

            .admin-dashboard {
                background-color: #6a0dad;
                color: white;
                padding: 15px;
                border-radius: 8px;
                font-size: 18px;
                text-align: center;
            }

            /* ======= Cards Styling ======= */
            .dashboard-cards {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
                margin-top: 20px;
            }

            .card {
                background: white;
                border-radius: 12px;
                padding: 20px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                text-align: center;
                display: flex;
                flex-direction: column;
                justify-content: center;
                transition: transform 0.3s ease-in-out;
            }

            .card:hover {
                transform: scale(1.05);
            }

            .card i {
                font-size: 2.5rem;
                color: #ff5722;
                margin-bottom: 10px;
            }

            .card .card-title {
                font-size: 18px;
                font-weight: bold;
                color: #333;
            }

            .card .card-value {
                font-size: 22px;
                color: #2c3e50;
                font-weight: bold;
            }

            /* ======= Footer ======= */
            .footer {
                text-align: center;
                padding: 10px;
                font-size: 14px;
                color: #555;
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
                            <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
                            </li>
                            <li class="nav-label">Log</li>
                            <li> <a href="all_users.php"> <span><i class="fa fa-user f-s-20 "></i></span><span>Utilizatori</span></a></li>
                            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 color-warning"></i><span class="hide-menu">Servicii</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="all_services.php">Toate Serviciile</a></li>
                                    <li><a href="add_category.php">Adaugă Categorie Serviciu</a></li>
                                    <li><a href="add_services.php">Adaugă Serviciu</a></li>

                                </ul>
                            </li>
                            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Vinuri</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="all_wines.php">Toate Produsele</a></li>
                                    <li><a href="add_category_wine.php">Adaugă Categorie</a></li>
                                    <li><a href="add_wines.php">Adaugă Produs</a></li>
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



                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Admin Dashboard</h4>
                            </div>
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-home f-s-40 "></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql = "select * from services";
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);

                                                    echo $rws; ?></h2>
                                                <p class="m-b-0">Servicii</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa-solid fa-wine-bottle f-s-40" aria-hidden="true"></i></span>
                                            </div>

                                            <div class="media-body media-text-right">
                                                <h2><?php $sql = "select * from wines";
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);

                                                    echo $rws; ?></h2>
                                                <p class="m-b-0">Vinuri</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-users f-s-40"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql = "select * from users";
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);

                                                    echo $rws; ?></h2>
                                                <p class="m-b-0">Utilizatori</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-shopping-cart f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql = "select * from users_orders";
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);

                                                    echo $rws; ?></h2>
                                                <p class="m-b-0">Total Comenzi</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-th-large f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql = "select * from service_cat";
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);

                                                    echo $rws; ?></h2>
                                                <p class="m-b-0">Categorii de servicii</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-spinner f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql = "select * from user_orders_detailed WHERE status = 'in process' ";
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);

                                                    echo $rws; ?></h2>
                                                <p class="m-b-0">Comenzi în procesare</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-check f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql = "select * from user_orders_detailed WHERE status = 'closed' ";
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);

                                                    echo $rws; ?></h2>
                                                <p class="m-b-0">Comenzi livrate</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-times f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php $sql = "select * from user_orders_detailed WHERE status = 'rejected' ";
                                                    $result = mysqli_query($db, $sql);
                                                    $rws = mysqli_num_rows($result);

                                                    echo $rws; ?></h2>
                                                <p class="m-b-0">Comenzi anulate</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card p-30">
                                        <div class="media">
                                            <div class="media-left meida media-middle">
                                                <span><i class="fa fa-usd f-s-40" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="media-body media-text-right">
                                                <h2><?php
                                                    $result = mysqli_query($db, 'SELECT SUM(price) AS value_sum FROM user_orders_detailed WHERE status = "closed"');
                                                    $row = mysqli_fetch_assoc($result);
                                                    $sum = $row['value_sum'];
                                                    echo $sum;
                                                    ?></h2>
                                                <p class="m-b-0">Total venit</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include "include/footer.php" ?>

                <script src="js/lib/jquery/jquery.min.js"></script>
                <script src="js/lib/bootstrap/js/popper.min.js"></script>
                <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
                <script src="js/jquery.slimscroll.js"></script>
                <script src="js/sidebarmenu.js"></script>
                <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
                <script src="js/custom.min.js"></script>

    </body>

</html>
<?php
}
?>