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
    <title>All Users</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        /* ======= Sidebar Styles ======= */
        .left-sidebar {
            width: 250px;
            background-color: rgb(255, 255, 255);
            position: fixed;
            height: 100vh;
            padding-top: 20px;
        }

        .left-sidebar .sidebar-nav ul {
            list-style: none;
            padding: 0;
        }

        .left-sidebar .sidebar-nav ul li {
            padding: 10px 20px;
        }

        .left-sidebar .sidebar-nav ul li a {
            text-decoration: none;
            color: black;
            font-size: 16px;
            display: flex;
            align-items: center;
            transition: background 0.3s ease;
        }

        .left-sidebar .sidebar-nav ul li a i {
            margin-right: 10px;
            font-size: 18px;
        }

        .left-sidebar .sidebar-nav ul li a:hover {
            background-color: #1a252f;
            border-radius: 5px;
            color: white;
        }

        /* ======= Dashboard Content ======= */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }


        /* ======= Footer ======= */
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #555;
        }

        /* ======= Table Styles ======= */
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
        }

        .table thead {
            background-color:rgb(195, 195, 195);
            color: white;
            text-transform: uppercase;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: center;
        }

        .table tbody tr {
            border-bottom: 1px solid #ddd;
            transition: all 0.3s ease-in-out;
        }

        .table tbody tr:hover {
            background-color: #f4e3ff;
            transform: scale(1.02);
        }

        .table td {
            color: #333;
        }

        /* Stilizare pentru butoane */
        .action-btn {
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 14px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-edit {
            background-color: #28a745;
            color: white;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-edit:hover {
            background-color: #218838;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }


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


            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">All Users</h4>
                                </div>

                                <div class="table-responsive m-t-40">
    <table id="myTable" class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>Username</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Reg-Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM users ORDER BY u_id DESC";
            $query = mysqli_query($db, $sql);

            if (!mysqli_num_rows($query) > 0) {
                echo '<tr><td colspan="8" class="text-center">No Users</td></tr>';
            } else {
                while ($rows = mysqli_fetch_array($query)) {
                    echo '<tr>
                        <td>' . $rows['username'] . '</td>
                        <td>' . $rows['f_name'] . '</td>
                        <td>' . $rows['l_name'] . '</td>
                        <td>' . $rows['email'] . '</td>
                        <td>' . $rows['phone'] . '</td>
                        <td>' . $rows['address'] . '</td>
                        <td>' . $rows['date'] . '</td>
                        <td>
                            <a href="edit_user.php?id=' . $rows['u_id'] . '" class="action-btn btn-edit">Edit</a>
                            <a href="delete_user.php?id=' . $rows['u_id'] . '" class="action-btn btn-delete">Delete</a>
                        </td>
                    </tr>';
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

    <script src="js/lib/jquery/jquery.min.js"></script>>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>

</body>

</html>