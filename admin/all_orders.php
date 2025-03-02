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
    <title>All Orders</title>
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
                        <!-- <li> <a href="all_orders.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Comenzi</span></a></li> -->
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Comenzi</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_orders.php">Toate Comenzile</a></li>
                                <li><a href="order_details.php">Detalii comanda user</a></li>
                            </ul>
                        </li>
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
                                    <h4 class="m-b-0 text-white">All Orders</h4>
                                </div>

                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>User</th>
                                                <th>Cantitatea totală</th>
                                                <th>Preţ total</th>
                                                <th>Adresa</th>
                                                <th>Status</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php
                                            $sql = "SELECT users.*, users_orders.*, user_orders_detailed.* FROM users 
                                             INNER JOIN users_orders ON users.u_id = users_orders.u_id
                                             INNER JOIN user_orders_detailed ON user_orders_detailed.o_id = users_orders.o_id";

                                            $query = mysqli_query($db, $sql);

                                            if (!mysqli_num_rows($query) > 0) {
                                                echo '<td colspan="8"><center>No Orders</center></td>';
                                            } else {
                                                $users_data = []; // Array pentru a salva datele utilizatorilor

                                                // Colectăm datele pentru fiecare utilizator
                                                while ($rows = mysqli_fetch_array($query)) {
                                                    $user_id = $rows['u_id'];
                                                    $order_status = $rows['status'];

                                                    // Verificăm dacă utilizatorul și statusul acestuia au fost deja adăugate
                                                    if (!isset($users_data[$user_id])) {
                                                        $users_data[$user_id] = [];
                                                    }

                                                    // Dacă nu există o comandă cu acest status, o adăugăm
                                                    if (!isset($users_data[$user_id][$order_status])) {
                                                        $users_data[$user_id][$order_status] = [
                                                            'username' => $rows['username'],
                                                            'total_quantity' => 0,
                                                            'total_price' => 0,
                                                            'address' => $rows['address'],
                                                            'status' => $order_status
                                                        ];
                                                    }

                                                    // Adăugăm cantitatea și prețul la totalurile comenzilor cu același status
                                                    $users_data[$user_id][$order_status]['total_quantity'] += $rows['quantity'];
                                                    $users_data[$user_id][$order_status]['total_price'] += $rows['total_price'];
                                                    // $users_data[$user_id][$order_status]['total_price'] += $rows['quantity'] * $rows['price'];
                                                }

                                                // Afișăm datele pentru fiecare utilizator
                                                foreach ($users_data as $user_id => $statuses) {
                                                    foreach ($statuses as $status => $user_info) {
                                            ?>
                                                        <tr>
                                                            <td><?php echo $user_info['username']; ?></td>
                                                            <td><?php echo $user_info['total_quantity']; ?></td>
                                                            <td><?php echo number_format($user_info['total_price'], 2); ?> MDL</td>
                                                            <td><?php echo $user_info['address']; ?></td>

                                                            <?php
                                                            // Afișăm statusul
                                                            if ($status == "" || $status == "NULL") {
                                                                echo '<td><button type="button" class="btn btn-info"><span class="fa fa-bars" aria-hidden="true"></span> Dispatch</button></td>';
                                                            } elseif ($status == "in process") {
                                                                echo '<td><button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span> În curs de livrare!</button></td>';
                                                            } elseif ($status == "closed") {
                                                                echo '<td><button type="button" class="btn btn-primary"><span class="fa fa-check-circle" aria-hidden="true"></span> Livrat</button></td>';
                                                            } elseif ($status == "rejected") {
                                                                echo '<td><button type="button" class="btn btn-danger"><i class="fa fa-close"></i> Anulat</button></td>';
                                                            } elseif ($status == "dispatch") {
                                                                echo '<td><button type="button" class="btn btn-info"><span class="fa fa-bars" aria-hidden="true"></span> Dispatch</button></td>';
                                                            }
                                                            ?>

                                                            <!-- <td>
                                                                                    <a href="delete_orders.php?order_del=<?php echo $user_id; ?>" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a>
                                                                                    <a href="view_order.php?user_upd=<?php echo $user_id; ?>" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
                                                                                </td> -->
                                                        </tr>
                                            <?php
                                                    }
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
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

</body>

</html>