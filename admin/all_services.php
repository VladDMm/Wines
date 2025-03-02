<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Toate Serviciile</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
    /* ======= Responsive Table ======= */
    @media (max-width: 768px) {
        .table {
            font-size: 14px;
        }

        .table th,
        .table td {
            padding: 8px;
        }
    }

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
        }
    </style>
</head>


<body class="fix-header fix-sidebar">

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
                        <li class="nav-label">Acasă</li>
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

            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">


                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Toate Serviciile</h4>
                                </div>

                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Categorie</th>
                                                <th>Nume</th>
                                                <th>Imagine</th>
                                                <th>Data</th>
                                                <th>Acţiune</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM services order by service_id desc";
                                            $query = mysqli_query($db, $sql);

                                            if (!mysqli_num_rows($query) > 0) {
                                                echo '<td colspan="11"><center>No Services</center></td>';
                                            } else {
                                                while ($rows = mysqli_fetch_array($query)) {

                                                    $mql = "SELECT * FROM service_cat where c_id='" . $rows['c_id'] . "'";
                                                    $res = mysqli_query($db, $mql);
                                                    $row = mysqli_fetch_array($res);

                                                    echo ' <tr><td>' . $row['c_name'] . '</td>
																								<td>' . $rows['title'] . '</td>
																																																
																								
																								
                                                                                                <td><div class="col-md-3 col-lg-8 m-b-10">
                                                                                                <center><img src="Res_img/' . $rows['image'] . '" class="img-responsive radius"  style="max-width:90px;max-height:150px;"/></center>
                                                                                                </div></td>
                                                                                            

																								<td>' . $rows['date'] . '</td>
																									 <td><a href="delete_restaurant.php?res_del=' . $rows['service_id'] . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
																									 <a href="update_restaurant.php?res_upd=' . $rows['service_id'] . '" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
																									</td></tr>';
                                                }
                                            }


                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>
</body>

</html>