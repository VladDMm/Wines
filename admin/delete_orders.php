<?php
include("../connection/connect.php"); // Conectare la DB
error_reporting(0);
session_start();

if (isset($_GET['order_del'])) {
    $order_id = $_GET['order_del'];

    // datele comenzii pentru a obtine mesajul si link-ul video
    $query = mysqli_query($db, "SELECT message, video_link FROM users_orders WHERE o_id = '$order_id'");
    $order = mysqli_fetch_assoc($query);

    if ($order) {
        // generam  QR code pentru fisiere ca sa le comparam si sa le stergem daca exista
        $message_qr = !empty($order['message']) ? "../qr_codes/" . md5($order['message']) . ".png" : null;
        $video_qr = !empty($order['video_link']) ? "../qr_codes/" . md5($order['video_link']) . ".png" : null;

        // stergem daca exista
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
        
    header("location:all_orders.php");
    exit();
}
?>
