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

        $check_cat = mysqli_query($db, "SELECT c_name FROM service_cat where c_name = '" . $_POST['c_name'] . "' ");



        if (mysqli_num_rows($check_cat) > 0) {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Category already exist!</strong>
															</div>';
        } else {


            $mql = "INSERT INTO service_cat(c_name) VALUES('" . $_POST['c_name'] . "')";
            mysqli_query($db, $mql);
            $success =     '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																New Category Added Successfully.</br></div>';
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
    <title>Add Category</title>
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
                                <li><a href="all_restaurant.php">Toate Serviciile</a></li>
                                <li><a href="add_category.php">Adaugă Categorie</a></li>
                                <li><a href="add_services.php">Adaugă Serviciu</a></li>

                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Vinuri</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_menu.php">Toate Vinurile</a></li>
                                <li><a href="add_category_wine.php">Adaugă Categorie Vin</a></li>
                                <li><a href="add_menu.php">Adaugă Vin</a></li>


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



                    <div class="container-fluid">



                        <?php
                        echo $error;
                        echo $success; ?>





                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">Adaugă Categorie Serviciu</h4>
                                </div>
                                <form action='' method='post'>
                                    <div class="form-body">

                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Categoria</label>
                                                    <input type="text" name="c_name" class="form-control">
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

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Listed Categories</h4>

                            <div class="table-responsive m-t-40">
                                <table id="myTable" class="table table-bordered table-hover table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Category Name</th>
                                            <th>Date</th>

                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $sql = "SELECT * FROM service_cat order by c_id desc";
                                        $query = mysqli_query($db, $sql);

                                        if (!mysqli_num_rows($query) > 0) {
                                            echo '<td colspan="7"><center>No Categories-Data!</center></td>';
                                        } else {
                                            while ($rows = mysqli_fetch_array($query)) {



                                                echo ' <tr><td>' . $rows['c_id'] . '</td>
																								<td>' . $rows['c_name'] . '</td>
																								<td>' . $rows['date'] . '</td>
																								
																									 <td><a href="delete_category.php?cat_del=' . $rows['c_id'] . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
																									 <a href="update_category.php?cat_upd=' . $rows['c_id'] . '" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
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