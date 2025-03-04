<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

if (empty($_SESSION['user_id'])) {
    header('location:login.php');
} else {
?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="#">
        <title>Comenzile Tale</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/animsition.min.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <style type="text/css" rel="stylesheet">
            .indent-small {
                margin-left: 5px;
            }

            .form-group.internal {
                margin-bottom: 0;
            }

            .dialog-panel {
                margin: 10px;
            }

            .datepicker-dropdown {
                z-index: 200 !important;
            }

            .panel-body {
                background: #e5e5e5;
                /* Old browsers */
                background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
                /* FF3.6+ */
                background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
                /* Chrome,Safari4+ */
                background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
                /* Chrome10+,Safari5.1+ */
                background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
                /* Opera 12+ */
                background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
                /* IE10+ */
                background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
                /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
                font: 600 15px "Open Sans", Arial, sans-serif;
            }

            label.control-label {
                font-weight: 600;
                color: #777;
            }

            @media only screen and (max-width: 768px) {
                .table-responsive {
                    overflow-x: auto;
                    display: block;
                    white-space: nowrap;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                thead {
                    display: none;
                    /* Ascunde antetul pe ecrane mici */
                }

                tbody tr {
                    display: block;
                    border: 1px solid #ccc;
                    margin-bottom: 10px;
                    padding: 10px;
                }

                tbody td {
                    display: flex;
                    justify-content: space-between;
                    padding: 8px;
                    border-bottom: 1px solid #ddd;
                }

                tbody td:before {
                    content: attr(data-column);
                    font-weight: bold;
                    color: #333;
                }
            }

            @media (max-width: 768px) {
                .navbar {
                    display: flex;
                    flex-direction: column;
                    /* Logo sus, meniu jos */
                    align-items: center;
                    /* Centrează elementele */
                    justify-content: space-between;
                    height: auto;
                    padding: 10px 0;
                }

                .navbar-brand {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    width: 100%;
                }

                .navbar-brand img {
                    width: 40%;
                    display: block;
                }

                .navbar-toggler {
                    position: absolute;
                    right: 15px;
                    /* Plasează meniul în dreapta */
                    top: 10px;
                    /* Evită suprapunerea cu logo-ul */
                }
            }

            /* Stilizare generală pentru tabel */
            .table {
                width: 100%;
                border-collapse: collapse;
                background-color: #fff;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            }

            .table thead {
                background-color: #404040;
                color: white;
                text-transform: uppercase;
                font-size: 14px;
            }

            .table th,
            .table td {
                padding: 12px;
                text-align: center;
                border: 1px solid #ddd;
            }

            .table tbody tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            .table tbody tr:hover {
                background-color: #f1f1f1;
            }

            /* Butoane status */
            .btn {
                border-radius: 5px;
                padding: 6px 12px;
                font-size: 14px;
            }

            .btn-info {
                background-color: #17a2b8;
                color: white;
            }

            .btn-warning {
                background-color: #ffc107;
                color: black;
            }

            .btn-success {
                background-color: #28a745;
                color: white;
            }

            .btn-danger {
                background-color: #dc3545;
                color: white;
            }

            /* Responsivitate tabel */
            @media only screen and (max-width: 768px) {
                .table-responsive {
                    overflow-x: auto;
                    display: block;
                    white-space: nowrap;
                }

                thead {
                    display: none;
                }

                tbody tr {
                    display: block;
                    border: 1px solid #ccc;
                    margin-bottom: 10px;
                    padding: 10px;
                    background: white;
                    border-radius: 8px;
                    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
                }

                tbody td {
                    display: flex;
                    justify-content: space-between;
                    padding: 8px;
                    border-bottom: 1px solid #ddd;
                }

                tbody td:before {
                    content: attr(data-column);
                    font-weight: bold;
                    color: #404040;
                }
            }
        </style>

    </head>

    <body>


        <header id="header" class="header-scroll top-header headrom">

            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/logo.png" alt="" width="18%"> </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Acasă <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="services.php">Servicii <span class="sr-only"></span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="profile.php">Contul Meu <span class="sr-only"></span></a> </li>
                            <?php
                            if (empty($_SESSION["user_id"])) {
                                echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
                            } else {


                                echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Comenzile mele</a> </li>';
                                echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
                            }

                            ?>

                        </ul>
                    </div>
                </div>
            </nav>

        </header>
        <div class="page-wrapper">



            <div class="inner-page-hero bg-image" data-image-src="images/img/yro.webp">
                <div class="container"> </div>

            </div>
            <div class="result-show">
                <div class="container">
                    <div class="row">


                    </div>
                </div>
            </div>

            <section class="restaurants-page">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                        </div>
                        <div class="col-xs-12">
                            <div class="bg-gray">
                                <div class="row">

                                    <table class="table table-bordered table-hover">
                                        <thead style="background: #404040; color:white;">
                                            <tr>

                                                <th>Produs</th>
                                                <th>Cantitatea</th>
                                                <th>Preț</th>
                                                <th>Status</th>
                                                <th>Mesaj Felicitare</th>
                                                <th>Video Link</th>
                                                <th>QR Cod Mesaj</th>
                                                <th>QR Cod Video</th>
                                                <th>Tip ambalaj</th>
                                                <th>Data</th>
                                                <th>Acțiune</th>

                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php

                                            // $query_res = mysqli_query($db, "select * from users_orders where u_id='" . $_SESSION['user_id'] . "'");
                                            $query = "SELECT users_orders.*, user_orders_detailed.*
                                            FROM users_orders 
                                            INNER JOIN user_orders_detailed ON users_orders.o_id = user_orders_detailed.o_id
                                            WHERE users_orders.u_id = ?";

                                            $stmt = $db->prepare($query);
                                            $stmt->bind_param("i", $_SESSION['user_id']); // Protecție împotriva SQL Injection
                                            $stmt->execute();
                                            $query_res = $stmt->get_result();


                                            if ($query_res->num_rows == 0) {
                                                echo '<td colspan="11"><center>Nu sunt comenzi!</center></td>';
                                            } else {

                                                while ($row = mysqli_fetch_array($query_res)) {

                                            ?>
                                                    <tr>
                                                        <td data-column="Produs"> <?php echo $row['title']; ?></td>
                                                        <td data-column="Cantitatea"> <?php echo $row['quantity']; ?></td>
                                                        <td data-column="Preţ">MDL <?php echo $row['price']; ?></td>
                                                        <td data-column="Status">
                                                            <?php
                                                            $status = $row['status'];
                                                            if ($status == "" or $status == "NULL") {
                                                            ?>
                                                                <button type="button" class="btn btn-info"><span class="fa fa-bars" aria-hidden="true"></span> Dispatch</button>
                                                            <?php
                                                            }
                                                            if ($status == "in process") { ?>
                                                                <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span> În curs de livrare!</button>
                                                            <?php
                                                            }
                                                            if ($status == "closed") {
                                                            ?>
                                                                <button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true"></span> Livrat</button>
                                                            <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($status == "rejected") {
                                                            ?>
                                                                <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i> Anulat</button>
                                                            <?php
                                                            }
                                                            ?>






                                                        </td>
                                                        <td data-column="Mesaj"> <?php echo $row['message']; ?></td>
                                                        <td data-column="Video"> <?php echo $row['video_link']; ?></td>
                                                        <td>
                                                            <?php
                                                            // Verifică dacă există un mesaj pentru a genera codul QR
                                                            if (!empty($row['message'])) {
                                                                $qr_text = $row['message']; // Folosim variabila corectă
                                                                $qr_text_encoded = urlencode($qr_text);
                                                                $file_path = "qr_codes/" . md5($qr_text) . ".png"; // Nume unic bazat pe conținut

                                                                // Verifică dacă folderul există și are permisiuni
                                                                if (!is_dir("qr_codes")) {
                                                                    mkdir("qr_codes", 0777, true);
                                                                }

                                                                // Salvează imaginea pe server dacă nu există deja
                                                                if (!file_exists($file_path)) {
                                                                    $qr_url = "https://quickchart.io/qr?text={$qr_text_encoded}&size=100";
                                                                    $qr_image = file_get_contents($qr_url);

                                                                    if ($qr_image) {
                                                                        file_put_contents($file_path, $qr_image);
                                                                    } else {
                                                                        echo 'Eroare la generarea QR!';
                                                                    }
                                                                }

                                                                // Verifică dacă fișierul există înainte de afișare
                                                                if (file_exists($file_path)) {
                                                                    echo '<img src="' . $file_path . '" alt="QR Code">';
                                                                } else {
                                                                    echo 'Eroare la afișarea QR!';
                                                                }
                                                            } else {
                                                                echo 'N/A';
                                                            }
                                                            ?>
                                                        </td>

                                                        <td>
                                                            <?php
                                                            // Verifică dacă există un link video pentru a genera codul QR
                                                            if (!empty($row['video_link'])) {
                                                                $qr_text = $row['video_link']; // Folosim variabila corectă
                                                                $qr_text_encoded = urlencode($qr_text);
                                                                $file_path = "qr_codes/" . md5($qr_text) . ".png"; // Nume unic bazat pe conținut

                                                                // Verifică dacă folderul există și are permisiuni
                                                                if (!is_dir("qr_codes")) {
                                                                    mkdir("qr_codes", 0777, true);
                                                                }

                                                                // Salvează imaginea pe server dacă nu există deja
                                                                if (!file_exists($file_path)) {
                                                                    $qr_url = "https://quickchart.io/qr?text={$qr_text_encoded}&size=100";
                                                                    $qr_image = file_get_contents($qr_url);

                                                                    if ($qr_image) {
                                                                        file_put_contents($file_path, $qr_image);
                                                                    } else {
                                                                        echo 'Eroare la generarea QR!';
                                                                    }
                                                                }

                                                                // Verifică dacă fișierul există înainte de afișare
                                                                if (file_exists($file_path)) {
                                                                    echo '<img src="' . $file_path . '" alt="QR Code">';
                                                                } else {
                                                                    echo 'Eroare la afișarea QR!';
                                                                }
                                                            } else {
                                                                echo 'N/A';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td data-column="Ambalaj"><?php echo $row['tip_ambalaj']; ?></td>
                                                        <td data-column="Data"> <?php echo $row['date']; ?></td>
                                                        <td data-column="Acţiune"> <a href="delete_orders.php?order_del=<?php echo $row['o_id']; ?>" onclick="return confirm('Doreşti să ştergi comanda?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a>
                                                        </td>

                                                    </tr>


                                            <?php }
                                            } ?>




                                        </tbody>
                                    </table>



                                </div>

                            </div>



                        </div>



                    </div>
                </div>
        </div>
        </section>


        <?php include "include/footer.php" ?>

        </div>


        <script src="js/jquery.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/animsition.min.js"></script>
        <script src="js/bootstrap-slider.min.js"></script>
        <script src="js/jquery.isotope.min.js"></script>
        <script src="js/headroom.js"></script>
        <script src="js/foodpicky.min.js"></script>
    </body>

</html>
<?php
}
?>