<?php
include '../includes/auth_check.php';
include '../includes/db.php';

$id = (int) $_GET['id'];
$stmt = mysqli_prepare($conn, "DELETE FROM menu_items WHERE item_id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

header("Location: menu_management.php");
exit();
?>