<?php
session_start();
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <div style="padding: 30px 40px;">
        <h1>Checkout</h1>
        <form method="POST" action="place_order.php" class="checkout-form">
            <label>Full Name</label>
            <input type="text" name="customer_name" required>

            <label>Contact Number</label>
            <input type="text" name="customer_contact" required>

            <label>Order Type</label>
            <select name="order_type" id="order_type" onchange="toggleTable()">
                <option value="Pickup">Pickup</option>
                <option value="Dine-in">Dine-in</option>
            </select>

            <div id="table-field" style="display:none;">
                <label>Table Number</label>
                <input type="text" name="table_number">
            </div>

            <label>Payment Method (mock gateway)</label>
            <select name="payment_method">
                <option value="Card">Credit / Debit Card</option>
                <option value="Cash">Cash on Pickup/Table</option>
            </select>

            <button type="submit">Confirm & Pay</button>
        </form>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script>
        function toggleTable() {
            const type = document.getElementById('order_type').value;
            document.getElementById('table-field').style.display = (type === 'Dine-in') ? 'block' : 'none';
        }
    </script>
</body>
</html>