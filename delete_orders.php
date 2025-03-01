<?php
include("connection/connect.php"); // Conectare la DB
error_reporting(0);
session_start();

if (isset($_GET['order_del'])) {
    $order_id = $_GET['order_del'];

    // Preluăm datele comenzii pentru a obține mesajul și link-ul video
    $query = mysqli_query($db, "SELECT message, video_link FROM users_orders WHERE o_id = '$order_id'");
    $order = mysqli_fetch_assoc($query);

    if ($order) {
        // Generăm numele fișierelor QR code
        $message_qr = !empty($order['message']) ? "qr_codes/" . md5($order['message']) . ".png" : null;
        $video_qr = !empty($order['video_link']) ? "qr_codes/" . md5($order['video_link']) . ".png" : null;

        // Ștergem fișierele QR dacă există
        if ($message_qr && file_exists($message_qr)) {
            unlink($message_qr);
        }
        if ($video_qr && file_exists($video_qr)) {
            unlink($video_qr);
        }
    }

    // Ștergem comanda din baza de date
    mysqli_query($db, "DELETE FROM users_orders WHERE o_id = '$order_id'");
    mysqli_query($db, "DELETE FROM user_orders_detailed WHERE o_id = '$order_id'");


    // Redirecționare
    header("location:your_orders.php");
    exit();
}
