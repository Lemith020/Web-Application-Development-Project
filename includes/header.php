<header class="site-header">
    <div class="logo">Sun & Sea Restaurant</div>
    <nav>
        <a href="index.php">Menu</a>
        <a href="cart.php">Cart (<span id="cart-count"><?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?></span>)</a>
    </nav>
</header>