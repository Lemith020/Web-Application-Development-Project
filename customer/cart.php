<?php
session_start();
include '../includes/db.php';

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$items = [];
$total = 0;

if (!empty($cart)) {
    $ids = implode(',', array_map('intval', array_keys($cart)));
    $result = mysqli_query($conn, "SELECT * FROM menu_items WHERE item_id IN ($ids)");
    while ($row = mysqli_fetch_assoc($result)) {
        $row['quantity'] = $cart[$row['item_id']];
        $row['subtotal'] = $row['quantity'] * $row['price'];
        $total += $row['subtotal'];
        $items[] = $row;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <div style="padding: 30px 40px;">
        <h1>Your Cart</h1>
        <?php if (empty($items)) { ?>
            <p>Your cart is empty. <a href="index.php">Browse the menu</a></p>
        <?php } else { ?>
        <table class="cart-table">
            <tr><th>Item</th><th>Price</th><th>Qty</th><th>Subtotal</th></tr>
            <?php foreach ($items as $item) { ?>
            <tr>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td>Rs. <?php echo number_format($item['price'], 2); ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td>Rs. <?php echo number_format($item['subtotal'], 2); ?></td>
            </tr>
            <?php } ?>
        </table>
        <h2>Total: Rs. <?php echo number_format($total, 2); ?></h2>
        <a href="checkout.php"><button style="margin-top:15px; padding:10px 25px; background:#0b3d59; color:#fff; border:none; border-radius:4px;">Proceed to Checkout</button></a>
        <?php } ?>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>