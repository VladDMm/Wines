<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include("connection/connect.php");

if (empty($_SESSION["user_id"])) {
    header('location:login.php');
    exit();
}
// Получение данных пользователя из базы
$user_id = $_SESSION["user_id"];
$sql = "SELECT username, f_name, l_name, email, phone, address FROM users WHERE u_id='$user_id'";
$result = mysqli_query($db, $sql);
if ($row = mysqli_fetch_assoc($result)) {
    $_SESSION['username'] = $row['username'];
    $_SESSION['f_name'] = $row['f_name'];
    $_SESSION['l_name'] = $row['l_name'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['phone'] = $row['phone'];
    $_SESSION['address'] = $row['address'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"];
    $username = $_POST["username"];
    $f_name = $_POST["f_name"];
    $l_name = $_POST["l_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    $sql = "UPDATE users SET username='$username', f_name='$f_name', l_name='$l_name', email='$email', phone='$phone', address='$address' WHERE u_id='$user_id'";
    if (mysqli_query($db, $sql)) {
        $_SESSION['username'] = $username;
        $_SESSION['f_name'] = $f_name;
        $_SESSION['l_name'] = $l_name;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['address'] = $address;
        echo "<script>alert('Данные успешно обновлены!'); window.location.replace('profile.php');</script>";
    } else {
        echo "Ошибка: " . mysqli_error($db);
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Profil</title>

    <style>
          @media only screen and (max-width: 768px) {
            .navbar-toggler {
                font-size: 24px;
                padding: 5px 10px;
            }

            .navbar-brand img {
                width: 40%;
            }
        }
        .form1 {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            display: flex;
            flex-direction: column;
            /* Ensure the form elements stack vertically */
            align-items: center;
            /* Center the content inside .form1 */
        }

        .form1 h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 12px;
            font-weight: 600;
            color: #555;
            width: 100%;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #0066cc;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #0066cc;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #005bb5;
        }
    </style>

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
        <div class="container m-t-30">

            <h2>Editează profilul</h2>
            <form action="" method="POST">
                <label>Nume de utilizator: <input type="text" name="username" value="<?php echo $_SESSION['username'] ?? ''; ?>"></label>
                <label>Prenume: <input type="text" name="f_name" value="<?php echo $_SESSION['f_name'] ?? ''; ?>"></label>
                <label>Nume: <input type="text" name="l_name" value="<?php echo $_SESSION['l_name'] ?? ''; ?>"></label>
                <label>Email: <input type="email" name="email" value="<?php echo $_SESSION['email'] ?? ''; ?>"></label>
                <label>Telefon: <input type="text" name="phone" value="<?php echo $_SESSION['phone'] ?? ''; ?>"></label>
                <label>Adresă: <input type="text" name="address" value="<?php echo $_SESSION['address'] ?? ''; ?>"></label>
                <button type="submit">Salvează modificările</button>
            </form>


        </div>
    </div>
    <?php include "include/footer.php" ?>

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