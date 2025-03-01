<?php
session_start();
$serviceType = isset($_GET['service_type']) ? htmlspecialchars($_GET['service_type']) : '';
$itemId = isset($_GET['item_id']) ? (int) $_GET['item_id'] : 0;
$quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;


if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            $cartItem = [];
            var_dump($serviceType);
            var_dump($itemId);
            if (!empty($serviceType) && !empty($itemId)) {
                if ($serviceType === 'tourism') {
                    // Interogare pentru serviciu turistic
                    $stmt = $db->prepare("
                        SELECT sc.c_id, sc.c_name AS category, t.service_id, t.title AS destination, t.price
                        FROM services s
                        JOIN service_cat sc ON sc.c_id = s.c_id
                        LEFT JOIN tourism t ON t.service_id = s.service_id
                        WHERE t.t_id = ?
                    ");
                    $stmt->bind_param('i', $itemId);
                } elseif ($serviceType === 'wines') {
                    // Interogare pentru vinuri
                    $stmt = $db->prepare("SELECT w_id AS item_id, title, price FROM wines WHERE w_id = ?");
                    $stmt->bind_param('i', $itemId);
                } else {
                    exit("Tip de serviciu invalid.");
                }

                $stmt->execute();
                $result = $stmt->get_result();
                $item = $result->fetch_object();

                if ($item) {
                    $cartItem = [
                        'title' => $serviceType === 'tourism' ? $item->destination : $item->title,
                        'service_id' => $item->service_id ?? null,
                        'item_id' => $itemId,
                        'service_type' => $serviceType,
                        'quantity' => $quantity,
                        'price' => $item->price
                    ];

                    if (!isset($_SESSION["cart_item"])) {
                        $_SESSION["cart_item"] = [];
                    }

                    if (isset($_SESSION["cart_item"][$itemId])) {
                        $_SESSION["cart_item"][$itemId]["quantity"] += $quantity;
                        if (!empty($_SERVER['HTTP_REFERER'])) {
                            header("Location: " . $_SERVER['HTTP_REFERER']);
                            exit;
                        } else {
                            header("Location: services.php"); // Pagina implicită dacă nu există referer
                            exit;
                        }
                    } else {
                        $_SESSION["cart_item"][$itemId] = $cartItem;
                        if (!empty($_SERVER['HTTP_REFERER'])) {
                            header("Location: " . $_SERVER['HTTP_REFERER']);
                            exit;
                        } else {
                            header("Location: services.php"); // Pagina implicită dacă nu există referer
                            exit;
                        }
                    }
                }
            }
            break;

        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($itemId == $v['item_id'] && $serviceType == $v['service_type']) {
                        unset($_SESSION["cart_item"][$k]);
                        // Redirecționare înapoi la pagina anterioară
                        if (!empty($_SERVER['HTTP_REFERER'])) {
                            header("Location: " . $_SERVER['HTTP_REFERER']);
                            exit;
                        } else {
                            header("Location: services.php"); // Pagina implicită dacă nu există referer
                            exit;
                        }
                    }
                }
            }

            break;


        case "empty":
            unset($_SESSION["cart_item"]);
            break;

        case "check":
            header("location:checkout.php");
            break;
    }
}
