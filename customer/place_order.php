<?php
session_start();
include '../includes/db.php';

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

$customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
$customer_contact = mysqli_real_escape_string($conn, $_POST['customer_contact']);
$order_type = $_POST['order_type'];
$table_number = isset($_POST['table_number']) ? mysqli_real_escape_string($conn, $_POST['table_number']) : null;

$cart = $_SESSION['cart'];
$ids = implode(',', array_map('intval', array_keys($cart)));
$result = mysqli_query($conn, "SELECT * FROM menu_items WHERE item_id IN ($ids)");

$total = 0;
$order_items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $qty = $cart[$row['item_id']];
    $subtotal = $qty * $row['price'];
    $total += $subtotal;
    $order_items[] = ['item_id' => $row['item_id'], 'quantity' => $qty, 'price' => $row['price']];
}

$sql = "INSERT INTO orders (order_type, table_number, customer_name, customer_contact, total_amount, payment_status, order_status)
        VALUES (?, ?, ?, ?, ?, 'Paid', 'Pending')";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssss", $order_type, $table_number, $customer_name, $customer_contact, $total);
mysqli_stmt_execute($stmt);
$order_id = mysqli_insert_id($conn);

foreach ($order_items as $oi) {
    $stmt2 = mysqli_prepare($conn, "INSERT INTO order_items (order_id, item_id, quantity, price) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt2, "iiid", $order_id, $oi['item_id'], $oi['quantity'], $oi['price']);
    mysqli_stmt_execute($stmt2);
}

$_SESSION['cart'] = [];
$_SESSION['last_order_id'] = $order_id;

header("Location: order_success.php");
exit();
?>