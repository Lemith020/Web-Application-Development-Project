<?php
include '../includes/auth_check.php';
include '../includes/db.php';

$item_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM menu_items"))['c'];
$order_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM orders WHERE order_status != 'Completed'"))['c'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Sun & Sea Restaurant</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            color: #334155;
        }

        /* Navigation Bar Styling */
        .admin-nav {
            background-color: #0f172a;
            color: white;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .admin-nav h2 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .admin-nav div a {
            color: #94a3b8;
            text-decoration: none;
            margin-left: 25px;
            font-weight: 500;
            font-size: 15px;
            transition: color 0.2s ease;
        }

        .admin-nav div a:hover {
            color: #ffffff;
        }

        /* Dashboard Content */
        .dashboard-content {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 30px;
        }

        .dashboard-content h1 {
            font-size: 28px;
            color: #1e293b;
            margin-bottom: 30px;
            font-weight: 600;
        }

        /* Stat Cards Layout */
        .stat-cards {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
        }

        .stat-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            text-align: center;
            min-width: 200px;
            border-top: 4px solid #0284c7;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08);
        }

        .stat-card h3 {
            margin: 0;
            font-size: 42px;
            color: #0284c7;
            font-weight: 700;
        }

        .stat-card p {
            margin: 10px 0 0 0;
            color: #64748b;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>
    <div class="admin-nav">
        <h2>Sun & Sea Restaurant - Admin</h2>
        <div>
            <a href="menu_management.php">Menu</a>
            <a href="orders.php">Orders</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="dashboard-content">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <div class="stat-cards">
            <div class="stat-card">
                <h3><?php echo $item_count; ?></h3>
                <p>Menu Items</p>
            </div>
            <div class="stat-card">
                <h3><?php echo $order_count; ?></h3>
                <p>Active Orders</p>
            </div>
        </div>
    </div>
</body>
</html>