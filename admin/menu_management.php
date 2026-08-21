<?php
include '../includes/auth_check.php';
include '../includes/db.php';

$sql = "SELECT m.*, c.category_name FROM menu_items m
        LEFT JOIN categories c ON m.category_id = c.category_id
        ORDER BY m.item_id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Menu Management</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <div class="admin-nav">
        <h2>Sun & Sea Restaurant - Admin</h2>
        <div>
            <a href="dashboard.php">Dashboard</a>
            <a href="orders.php">Orders</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="dashboard-content">
        <h1>Menu Management</h1>
        <a href="add_item.php" class="btn-add">+ Add New Dish</a>
        <table class="admin-table">
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Type</th>
                <th>Price</th>
                <th>Available</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                <td><?php echo htmlspecialchars($row['dietary_type']); ?></td>
                <td>Rs. <?php echo number_format($row['price'], 2); ?></td>
                <td><?php echo $row['is_available'] ? 'Yes' : 'No'; ?></td>
                <td>
                    <a href="edit_item.php?id=<?php echo $row['item_id']; ?>">Edit</a>
                    <a href="delete_item.php?id=<?php echo $row['item_id']; ?>" onclick="return confirm('Delete this item?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>