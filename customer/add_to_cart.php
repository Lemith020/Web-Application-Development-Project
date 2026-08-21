<?php
session_start();
header('Content-Type: application/json');

$item_id = (int) $_POST['item_id'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_SESSION['cart'][$item_id])) {
    $_SESSION['cart'][$item_id]++;
} else {
    $_SESSION['cart'][$item_id] = 1;
}

echo json_encode(['success' => true, 'cart_count' => array_sum($_SESSION['cart'])]);
?>