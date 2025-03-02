                 <!DOCTYPE html>
                 <html lang="en">
                 <?php
                    include("../connection/connect.php");
                    error_reporting(0);
                    session_start();




                    if (isset($_POST['submit'])) {
                        if (empty($_POST['d_name']) || empty($_POST['about']) || $_POST['price'] == '' || $_POST['res_name'] == '') {
                            $error = '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>All fields Must be Filled!</strong>
                  </div>';
                        } else {
                            $fname = $_FILES['file']['name'];
                            $temp = $_FILES['file']['tmp_name'];
                            $fsize = $_FILES['file']['size'];
                            $extension = explode('.', $fname);
                            $extension = strtolower(end($extension));
                            $fnew = uniqid() . '.' . $extension;

                            $store = "Res_img/dishes/" . basename($fnew);

                            // Verifică dacă o imagine nouă a fost încărcată
                            if (!empty($fname)) {
                                // Dacă imaginea este încărcată, verifică extensia și dimensiunea
                                if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif') {
                                    if ($fsize > 1024 * 1024) {
                                        $error = '<div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Max Image Size is 1024kb!</strong> Try a different image.
                              </div>';
                                    } else {
                                        // Mută imaginea și actualizează baza de date cu imaginea nouă
                                        move_uploaded_file($temp, $store);
                                        $sql = "UPDATE wines 
                            SET service_id='$_POST[res_name]', 
                                title='$_POST[d_name]', 
                                slogan='$_POST[about]', 
                                price='$_POST[price]', 
                                img='$fnew' 
                            WHERE w_id='$_GET[menu_upd]'";
                                    }
                                } else {
                                    $error = '<div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Invalid file format!</strong> Only JPG, PNG, or GIF allowed.
                          </div>';
                                }
                            } else {
                                // Dacă nu se încarcă o imagine nouă, păstrează imaginea curentă
                                $sql = "UPDATE wines 
                    SET service_id='$_POST[res_name]', 
                        title='$_POST[d_name]', 
                        slogan='$_POST[about]', 
                        price='$_POST[price]' 
                    WHERE w_id='$_GET[menu_upd]'";
                            }

                            // Execută query-ul
                            if (mysqli_query($db, $sql)) {
                                $success = '<div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Record Updated!</strong>
                        </div>';
                            } else {
                                $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Failed to Update Record!</strong>
                      </div>';
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
                     <title>Update Menu</title>
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



                                 <?php echo $error;
                                    echo $success; ?>




                                 <div class="col-lg-12">
                                     <div class="card card-outline-primary">
                                         <div class="card-header">
                                             <h4 class="m-b-0 text-white">Editează</h4>
                                         </div>
                                         <div class="card-body">
                                             <form action='' method='post' enctype="multipart/form-data">
                                                 <div class="form-body">
                                                     <?php $qml = "select * from wines where w_id='$_GET[menu_upd]'";
                                                        $rest = mysqli_query($db, $qml);
                                                        $roww = mysqli_fetch_array($rest);
                                                        ?>
                                                     <hr>
                                                     <div class="row p-t-20">
                                                         <div class="col-md-6">
                                                             <div class="form-group">
                                                                 <label class="control-label">Vin</label>
                                                                 <input type="text" name="d_name" value="<?php echo $roww['title']; ?>" class="form-control" placeholder="">
                                                             </div>
                                                         </div>

                                                         <div class="col-md-6">
                                                             <div class="form-group has-danger">
                                                                 <label class="control-label">Despre</label>
                                                                 <input type="text" name="about" value="<?php echo $roww['slogan']; ?>" class="form-control form-control-danger" placeholder="">
                                                             </div>
                                                         </div>

                                                     </div>

                                                     <div class="row p-t-20">
                                                         <div class="col-md-6">
                                                             <div class="form-group">
                                                                 <label class="control-label">Preț </label>
                                                                 <input type="text" name="price" value="<?php echo $roww['price']; ?>" class="form-control" placeholder="MDL">
                                                             </div>
                                                         </div>

                                                         <div class="col-md-6">
                                                             <div class="form-group has-danger">
                                                                 <label class="control-label">Imagine curentă</label>
                                                                 <!-- Afișează imaginea curentă -->
                                                                 <?php if (!empty($roww['img'])): ?>
                                                                     <div class="mb-3">
                                                                         <img src="Res_img/dishes/<?php echo $roww['img']; ?>" alt="Imagine curentă" style="width: 90px; height: 150; border-radius: 5px;">
                                                                     </div>
                                                                 <?php endif; ?>
                                                                 <!-- Input pentru înlocuirea imaginii -->
                                                                 <label for="lastName">Înlocuiește imaginea:</label>
                                                                 <input type="file" name="file" id="lastName" class="form-control form-control-danger" placeholder="">
                                                             </div>
                                                         </div>
                                                     </div>



                                                     <div class="row">

                                                         <div class="col-md-12">
                                                             <div class="form-group">
                                                                 <label class="control-label">Selectează Categoria</label>
                                                                 <select name="res_name" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                                                     <option>--Selectează Serviciu--</option>
                                                                     <?php $ssql = "select * from services";
                                                                        $res = mysqli_query($db, $ssql);
                                                                        while ($row = mysqli_fetch_array($res)) {
                                                                            echo ' <option value="' . $row['service_id'] . '">' . $row['title'] . '</option>';;
                                                                        }

                                                                        ?>
                                                                 </select>
                                                             </div>
                                                         </div>



                                                     </div>

                                                 </div>
                                         </div>
                                         <div class="form-actions">
                                             <input type="submit" name="submit" class="btn btn-primary" value="Save">
                                             <a href="all_wines.php" class="btn btn-inverse">Cancel</a>
                                         </div>
                                         </form>
                                     </div>
                                 </div>
                             </div>

                             <?php include "include/footer.php" ?>

                         </div>

                     </div>

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