<?php
include '../includes/auth_check.php';
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = (int) $_POST['order_id'];
    $status = $_POST['order_status'];
    $stmt = mysqli_prepare($conn, "UPDATE orders SET order_status = ? WHERE order_id = ?");
    mysqli_stmt_bind_param($stmt, "si", $status, $order_id);
    mysqli_stmt_execute($stmt);
}

$result = mysqli_query($conn, "SELECT * FROM orders ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Order Management</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <div class="admin-nav">
        <h2>Sun & Sea Restaurant - Admin</h2>
        <div>
            <a href="dashboard.php">Dashboard</a>
            <a href="menu_management.php">Menu</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="dashboard-content">
        <h1>Incoming Orders</h1>
        <table class="admin-table">
            <tr>
                <th>Order #</th><th>Customer</th><th>Type</th><th>Table</th><th>Total</th><th>Payment</th><th>Status</th><th>Update</th>
            </tr>
            <?php while ($order = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td>#<?php echo $order['order_id']; ?></td>
                <td><?php echo htmlspecialchars($order['customer_name']); ?><br><small><?php echo htmlspecialchars($order['customer_contact']); ?></small></td>
                <td><?php echo $order['order_type']; ?></td>
                <td><?php echo $order['table_number'] ?: '-'; ?></td>
                <td>Rs. <?php echo number_format($order['total_amount'], 2); ?></td>
                <td><?php echo $order['payment_status']; ?></td>
                <td><?php echo $order['order_status']; ?></td>
                <td>
                    <form method="POST" style="display:flex; gap:5px;">
                        <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                        <select name="order_status">
                            <option value="Pending" <?php echo $order['order_status']=='Pending'?'selected':''; ?>>Pending</option>
                            <option value="Preparing" <?php echo $order['order_status']=='Preparing'?'selected':''; ?>>Preparing</option>
                            <option value="Ready" <?php echo $order['order_status']=='Ready'?'selected':''; ?>>Ready</option>
                            <option value="Completed" <?php echo $order['order_status']=='Completed'?'selected':''; ?>>Completed</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>