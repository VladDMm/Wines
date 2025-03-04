<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
//ini_set('display_errors', 1);
session_start();

function function_alert()
{


    echo "<script>alert('Mulţumim. Comanda ta este plasată!');</script>";
    echo "<script>window.location.replace('your_orders.php');</script>";
}

if (empty($_SESSION["user_id"])) {
    header('location:login.php');
} else {
    $item_total = 0;
    // Salvare comenzi și alte informații
    $tot_quantity = 0;

    foreach ($_SESSION["cart_item"] as $item) {
        $item_total += ($item["price"] * $item["quantity"]);
        $tot_quantity += $item["quantity"];
    }

    if (isset($_POST['submit'])) {
        $user_id = $_SESSION["user_id"];
        $special_message = $_POST['special_message']; // Valoarea aleasă
        $message = $_POST['message']; // Mesajul introdus
        $video_link = $_POST['video_link']; // Link-ul video introdus
        $special_gift = $_POST['special_gift']; // Tipul de ambalaj selectat

        $cost_mesaj = 0;
        $cost_ambalaj = 0;

        switch ($special_message) {
            case 'message':
                $cost_mesaj = 5;
                break;
            case 'video_link':
                $cost_mesaj = 5;
                break;
            case 'both':
                $cost_mesaj = 10;
                break;
        }

        switch ($special_gift) {
            case 'cutie':
                $special_gift = 'Cutie';
                $cost_ambalaj = 20;
                break;
            case 'ladita':
                $cost_ambalaj = 30;
                $special_gift = 'Lădiţă';
                break;
            case 'punga':
                $cost_ambalaj = 10;
                $special_gift = 'Pungă Stilizată';
                break;
        }



        // Adăugarea costurilor la total
        $item_total += $cost_mesaj + $cost_ambalaj;

        // Inserare în tabelul users_orders
        $SQL = "INSERT INTO users_orders (u_id, message, video_link, tip_ambalaj, total_price, total_quantity) 
                VALUES ('$user_id', '$message', '$video_link', '$special_gift', '$item_total', '$tot_quantity')";
        mysqli_query($db, $SQL);

        // Obținerea ID-ului ultimei comenzi
        $order_id = mysqli_insert_id($db);

        // Inserare în tabelul user_orders_detailed
        foreach ($_SESSION["cart_item"] as $item) {
            $SQL = "INSERT INTO user_orders_detailed (o_id, u_id, title, quantity, price) 
                    VALUES ('$order_id', '$user_id', '" . $item["title"] . "', '" . $item["quantity"] . "', '" . $item["price"] . "')";
            mysqli_query($db, $SQL);
        }

        // Actualizare număr total de comenzi ale utilizatorului
        $SQL2 = "UPDATE users SET order_count = order_count + 1 WHERE u_id = '$user_id'";
        mysqli_query($db, $SQL2);

        // Golirea coșului
        unset($_SESSION["cart_item"]);

        // Confirmare comandă și redirecționare
        function_alert();
    }

    // if (isset($_POST['submit'])) {
    //     $user_id = $_SESSION["user_id"];
    //     $special_message = $_POST['special_message']; // Valoarea aleasă
    //     $message = $_POST['message']; // Mesajul introdus
    //     $video_link = $_POST['video_link']; // Link-ul video introdus
    //     $special_gift = $_POST['special_gift']; // Tipul de ambalaj selectat

    //     if($special_gift === 'Cutie (20 lei)')
    //     {
    //         $special_gift = 'Cutie';
    //     }
    //     elseif ($special_gift === 'Lădiță (30 lei)'){
    //         $special_gift = 'Lădiţă';
    //     }
    //     elseif($special_gift === 'Pungă Stilizată (10 lei)'){
    //             $special_gift = 'Pungă Stilizată';
    //         }
    //     else
    //         {
    //             $special_gift = '';
    //         }
    //     // Salvare comenzi și alte informații
    //     foreach ($_SESSION["cart_item"] as $item) {
    //         // $item_total += ($item["price"]*$item["quantity"]);

    //         $SQL = "INSERT INTO users_orders (u_id, title, quantity, price, message, video_link, special_gift) 
    //         VALUES ('$user_id', '" . $item["title"] . "', '" . $item["quantity"] . "', '" . $item["price"] . "', '$message', '$video_link', '$special_gift')";
    //         mysqli_query($db, $SQL);

    //         // Inserare fiecare element din coș în users_orders
    //         // $SQL = "INSERT INTO users_orders (u_id, title, quantity, price, message, video_link) 
    //         //         VALUES ('$user_id', '" . $item["title"] . "', '" . $item["quantity"] . "', '" . $item["price"] . "', '$message', '$video_link')";



    //     }

    //     // Actualizare număr total de comenzi ale utilizatorului
    //     $SQL2 = "UPDATE users SET order_count = order_count + 1 WHERE u_id = '$user_id'";
    //     mysqli_query($db, $SQL2);

    //     // Golirea coșului de cumpărături
    //     unset($_SESSION["cart_item"]);

    //     // Mesaj de confirmare și redirecționare
    //     function_alert();
    // }
?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="#">
        <title>Checkout</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/animsition.min.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <style>
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
        </style>
    </head>

    <body>

        <div class="site-wrapper">
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
                <div class="top-links">
                    <div class="container">
                        <ul class="row links">

                            <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="services.php">Alege Serviciul</a></li>
                            <li class="col-xs-12 col-sm-4 link-item "><span>2</span><a href="#">Alege Produsul Preferat</a></li>
                            <li class="col-xs-12 col-sm-4 link-item active"><span>3</span><a href="checkout.php">Comandă şi Plăteşte</a></li>
                        </ul>
                    </div>
                </div>

                <div class="container">

                    <span style="color:green;">
                        <?php echo $success; ?>
                    </span>

                </div>

                <div class="container m-t-30">
                    <form action="" method="post">
                        <div class="widget clearfix">
                            <div class="widget-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cart-totals margin-b-20">
                                            <div class="cart-totals-title">
                                                <h4>Total Coş</h4>
                                            </div>
                                            <div class="cart-totals-fields">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Cart Subtotal</td>
                                                            <td> <?php echo "MDL " . $item_total; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Livrarea</td>
                                                            <td>Gratuit</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-color"><strong>Total</strong></td>
                                                            <td class="text-color" id="total"><strong> <?php echo "MDL " . $item_total; ?></strong></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Secțiune pentru alegerea mesajului sau video link-ului -->
                                        <div class="form-group">
                                            <label for="special_message">Dorești să adaugi un mesaj de felicitare sau un link video?</label>
                                            <select class="form-control" id="special_message" name="special_message">
                                                <option value="none">Nimic</option>
                                                <option value="message">Mesaj (5 lei)</option>
                                                <option value="video_link">Link Video (5 lei)</option>
                                                <option value="both">Ambele (10 lei)</option>
                                            </select>
                                        </div>

                                        <div class="form-group" id="message_div" style="display:none;">
                                            <label for="message">Introdu mesajul tău:</label>
                                            <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                                        </div>
                                        <div class="form-group" id="video_div" style="display:none;">
                                            <label for="video_link">Introdu link-ul video:</label>
                                            <input type="text" class="form-control" id="video_link" name="video_link" />
                                        </div>

                                        <div class="form-group">
                                            <label for="special_gift">Tip ambalaj</label>
                                            <select class="form-control" id="special_gift" name="special_gift">
                                                <option value="none">Nimic</option>
                                                <option value="cutie">Cutie (20 lei)</option>
                                                <option value="ladita">Lădiță (30 lei)</option>
                                                <option value="punga">Pungă stilizată (10 lei)</option>
                                            </select>
                                        </div>


                                        <div class="payment-option">
                                            <ul class=" list-unstyled">
                                                <li>
                                                    <label class="custom-control custom-radio  m-b-20">
                                                        <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description">Cash</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="custom-control custom-radio  m-b-10">
                                                        <input name="mod" id="radioStacked2" checked value="COD" type="radio" value="paypal" class="custom-control-input">
                                                        <span class="custom-control-indicator"></span>
                                                        <span class="custom-control-description">POS Terminal <img src="images/paypal.jpg" alt="" width="90"></span>
                                                    </label>
                                                </li>
                                            </ul>
                                            <p class="text-xs-center">
                                                <input type="submit" onclick="return confirm('Doreşti să confirmi comanda?');" name="submit" class="btn btn-success btn-block" value="Order Now">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <?php include "include/footer.php" ?>
            </div>
        </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/animsition.min.js"></script>
        <script src="js/bootstrap-slider.min.js"></script>
        <script src="js/jquery.isotope.min.js"></script>
        <script src="js/headroom.js"></script>
        <script src="js/foodpicky.min.js"></script>
        <script>
            document.getElementById('special_message').addEventListener('change', function() {
                var messageDiv = document.getElementById('message_div');
                var videoDiv = document.getElementById('video_div');
                var selectedOption = this.value;

                if (selectedOption === 'message' || selectedOption === 'both') {
                    messageDiv.style.display = 'block';
                } else {
                    messageDiv.style.display = 'none';
                }

                if (selectedOption === 'video_link' || selectedOption === 'both') {
                    videoDiv.style.display = 'block';
                } else {
                    videoDiv.style.display = 'none';
                }
            });
        </script>
        <script>
            document.getElementById('special_message').addEventListener('change', function() {
                var selectedOption = this.value;
                var total = <?php echo $item_total; ?>; // preluăm suma inițială din PHP

                if (selectedOption === 'message') {
                    total += 5; // 5 Lei pentru 1 variantă
                } else if (selectedOption === 'video_link') {
                    total += 5; // 5 Lei pentru 1 variantă
                } else if (selectedOption === 'both') {
                    total += 10; // 10 Lei pentru 2 variante
                }

                // Actualizează totalul pe pagină
                document.getElementById('total').innerText = "MDL " + total;
            });
            // adaugare la pret plus din valoarea selectata de la tip ambalaj
            document.getElementById('special_gift').addEventListener('change', function() {
                var selectedOption = this.value;
                var total = <?php echo $item_total; ?>; // preluăm suma inițială din PHP

                if (selectedOption == 'cutie') {
                    total += 20; // 5 Lei pentru 1 variantă
                } else if (selectedOption == 'ladita') {
                    total += 30; // 5 Lei pentru 1 variantă
                } else if (selectedOption == 'punga') {
                    total += 10; // 10 Lei pentru 2 variante
                }

                // Actualizează totalul pe pagină
                document.getElementById('total').innerText = "MDL " + total;
            });
        </script>



    </body>

</html>
<?php
}
?>