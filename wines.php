<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php"); 
error_reporting(0);
session_start();

include_once 'product-action.php'; 

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Vinuri</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/logo.png" alt="" width="18%"> </a>
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="services.php">Servicii <span class="sr-only"></span></a> </li>

                        <?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
							}
						else
							{
									
									
										echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
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
                    <li class="col-xs-12 col-sm-4 link-item active"><span>2</span><a href="wines.php?service_id=<?php echo $_GET['service_id']; ?>">Alege Produsul Preferat</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Comandă şi Plăteşte</a></li>

                </ul>
            </div>
        </div>
        <?php $ress= mysqli_query($db,"select * from services where service_id='$_GET[service_id]'");
									     $rows=mysqli_fetch_array($ress);
                                         $service_id = $_GET['service_id'];

                                         // Obținem detaliile serviciului selectat
                                         $ress = mysqli_query($db, "SELECT * FROM services WHERE service_id='$service_id'");
                                         $rows = mysqli_fetch_array($ress);
                                         
                                         // Dacă acest serviciu aparține de servicii turistice, afișăm datele din tabelul tourism
                                         if ($rows['title'] == 'Servicii Turistice') { 
                                             $tourism_res = mysqli_query($db, "SELECT * FROM tourism WHERE service_id='$service_id'");
                                             $tourism_data = mysqli_fetch_array($tourism_res);
                                         }
                                         
										  ?>
                                          
        <section class="inner-page-hero bg-image" data-image-src="images/img/restrrr.png">
            <div class="profile">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                            <div class="image-wrap">
                                <figure><?php echo '<img src="admin/Res_img/'.$rows['image'].'" alt="Wines logo">'; ?></figure>
                            </div>
                        </div>
                      
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                            <div class="pull-left right-text white-txt">
                                <h6><a href="#"><?php echo $rows['title']; ?></a></h6>
                                <p><?php echo $rows['']; ?></p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>
        <div class="breadcrumb">
            <div class="container">
                
            </div>
        </div>
        <div class="container m-t-30">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">

                    <div class="widget widget-cart">
                        <div class="widget-heading">
                            <h3 class="widget-title text-dark">
                                Coşul Tău
                            </h3>


                            <div class="clearfix"></div>
                        </div>
                        <div class="order-row bg-white">
                            <div class="widget-body">
                                <?php

$item_total = 0;

foreach ($_SESSION["cart_item"] as $item)  
{
?>

                                <div class="title-row">
                                 
                                    <?php echo $item["title"]; ?>
                                    <a href="wines.php?service_type=<?php echo $item['service_type']; ?>&action=remove&item_id=<?php echo $item['item_id']; ?>">
                                        <i class="fa fa-trash pull-right"></i></a>
                                </div>

                                <div class="form-group row no-gutter">
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control b-r-0" value=<?php echo "$".$item["price"]; ?> readonly id="exampleSelect1">

                                    </div>
                                    <div class="col-xs-4">
                                        <input class="form-control" type="text" readonly value='<?php echo $item["quantity"]; ?>' id="example-number-input">
                                    </div>

                                </div>

                                <?php
$item_total += ($item["price"]*$item["quantity"]); 
}
?>
                            </div>
                        </div>



                        <div class="widget-body">
                            <div class="price-wrap text-xs-center">
                                <p>TOTAL</p>
                                <h3 class="value"><strong><?php echo "$".$item_total; ?></strong></h3>
                                <p>Free Delivery!</p>
                                <?php
                                        if($item_total==0){
                                        ?>


                                <a href="checkout.php?service_id=<?php echo $_GET['service_id'];?>&action=check" class="btn btn-danger btn-lg disabled">Checkout</a>

                                <?php
                                        }
                                        else{   
                                        ?>
                                <a href="checkout.php?service_id=<?php echo $_GET['service_id'];?>&action=check" class="btn btn-success btn-lg active">Checkout</a>
                                <?php   
                                        }
                                        ?>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-8">


                    <div class="menu-widget" id="2">
                        <div class="widget-heading">
                            <h3 class="widget-title text-dark">
                                MENU <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular2" aria-expanded="true">
                                    <i class="fa fa-angle-right pull-right"></i>
                                    <i class="fa fa-angle-down pull-right"></i>
                                </a>
                            </h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="collapse in" id="popular2">
                            <?php  
                            // Dacă acest serviciu aparține de servicii turistice, afișăm datele din tabelul tourism
                            if ($rows['title'] == 'Servicii Turistice') { 

                                $stmt = $db->prepare("select * from tourism where service_id='$_GET[service_id]'");
									$stmt->execute();
									$products = $stmt->get_result();
									if (!empty($products)) 
									{
									foreach($products as $product)
										{ ?>

                            <div class="food-item">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-lg-8">
                                       <!--<form method="post" action='wines.php?service_id=<?php echo $_GET['service_id'];?>&action=add&t_id=<?php echo $product['t_id']; ?>'>-->
                                        <form method="post" action='wines.php?service_id=<?php echo $_GET['service_id'];?>&action=add&service_type=tourism&item_id=<?php echo $product['t_id']; ?>'>

                                            <div class="rest-logo pull-left">
                                                <a class="restaurant-logo pull-left" href="#"><?php echo '<img src="admin/Res_img/dishes/'.$product['img'].'" alt="logo">'; ?></a>
                                            </div>

                                            <div class="rest-descr">
                                                <h6><a href="#"><?php echo $product['title']; ?></a></h6>
                                                <p> <?php echo $product['slogan']; ?></p>
                                            </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-lg-3 pull-right item-cart-info">
                                    <div class="price-container" style="display: flex; flex-direction: column; align-items: start;">
                                    <span class="price">$<?php echo $product['price']; ?></span>
                                    <input class="b-r-0" type="text" name="quantity" style="margin-left:30px;" value="1" size="2" />
                                    <span class="pers-count">Max Persoane: <?php echo $product['pers_count']; ?></span>
                                    <input class="b-r-0" type="text" name="pers_count" style="margin-left:30px; margin-bottom: 5px" value="1" size="2" />
                                    </div>
                                    
                                    <input type="submit" class="btn theme-btn" style="margin-left:40px;" value="Add To Cart" />

                                        
                                    </div>
                                    </form>
                                </div>

                            </div>
                         

                            <?php
									  }
                                    }
                                
                            }
                            else
                            {
                                $stmt = $db->prepare("select * from wines where service_id='$_GET[service_id]'");
                                $stmt->execute();
                                $products = $stmt->get_result();
                                if (!empty($products)) 
                                {
                                foreach($products as $product)
                                    { ?>

                        <div class="food-item">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-lg-8">
                                <form method="post" action='wines.php?service_id=<?php echo $_GET['service_id'];?>&action=add&service_type=wines&item_id=<?php echo $product['w_id']; ?>'>

                                  <!--  <form method="post" action='wines.php?service_id=<?php echo $_GET['service_id'];?>&action=add&id=<?php echo $product['w_id']; ?>'>-->
                                        <div class="rest-logo pull-left">
                                            <a class="restaurant-logo pull-left" href="#"><?php echo '<img src="admin/Res_img/dishes/'.$product['img'].'" alt="Food logo">'; ?></a>
                                        </div>

                                        <div class="rest-descr">
                                            <h6><a href="#"><?php echo $product['title']; ?></a></h6>
                                            <p> <?php echo $product['slogan']; ?></p>
                                        </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-lg-3 pull-right item-cart-info">
                                    <span class="price pull-left">$<?php echo $product['price']; ?></span>
                                    <input class="b-r-0" type="text" name="quantity" style="margin-left:30px;" value="1" size="2" />
                                    <input type="submit" class="btn theme-btn" style="margin-left:40px;" value="Add To Cart" />
                                </div>
                                </form>
                            </div>

                        </div>
                     

                        <?php
                                  }
                                }
                            }
									
									
								?>



                        </div>

                    </div>


                </div>

            </div>

        </div>
   

        <?php include "include/footer.php" ?>

    </div>

    </div>
    <div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn theme-btn">Add To Cart</button>
                </div>
            </div>
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
</body>

</html>