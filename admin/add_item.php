<?php
include '../includes/auth_check.php';
include '../includes/db.php';

$categories = mysqli_query($conn, "SELECT * FROM categories");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category_id = (int) $_POST['category_id'];
    $dietary_type = $_POST['dietary_type'];
    $price = (float) $_POST['price'];
    $image_url = mysqli_real_escape_string($conn, $_POST['image_url']);

    $sql = "INSERT INTO menu_items (category_id, name, description, dietary_type, price, image_url)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "isssds", $category_id, $name, $description, $dietary_type, $price, $image_url);
    mysqli_stmt_execute($stmt);

    header("Location: menu_management.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Dish</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <div class="admin-nav">
        <h2>Sun & Sea Restaurant - Admin</h2>
        <div>
            <a href="menu_management.php">Back to Menu</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="dashboard-content">
        <h1>Add New Dish</h1>
        <form method="POST" class="admin-form">
            <label>Name</label>
            <input type="text" name="name" required>

            <label>Description</label>
            <textarea name="description"></textarea>

            <label>Category</label>
            <select name="category_id">
                <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
                    <option value="<?php echo $cat['category_id']; ?>"><?php echo htmlspecialchars($cat['category_name']); ?></option>
                <?php } ?>
            </select>

            <label>Dietary Type</label>
            <select name="dietary_type">
                <option value="Vegetarian">Vegetarian</option>
                <option value="Non-Vegetarian">Non-Vegetarian</option>
            </select>

            <label>Price (Rs.)</label>
            <input type="number" step="0.01" name="price" required>

            <label>Image filename (mock)</label>
            <input type="text" name="image_url" placeholder="e.g. dish.jpg">

            <button type="submit">Add Dish</button>
        </form>
    </div>
</body>
</html>