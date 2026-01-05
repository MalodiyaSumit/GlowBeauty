<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' | ' : ''; ?>Beautybar - Premium Beauty Products</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>✨</text></svg>">
</head>
<body>
    <header>
        <div class="top-bar">
            <div class="container">
                <div class="top-bar-content">
                    <span id="rotating-text">Free Shipping on Orders Above ₹999</span>
                </div>
            </div>
        </div>
        <script>
            const messages = [
                "Free Shipping on Orders Above ₹999",
                "100% Authentic Products"
            ];
            let currentIndex = 0;
            const rotatingText = document.getElementById('rotating-text');

            setInterval(() => {
                rotatingText.style.opacity = '0';
                setTimeout(() => {
                    currentIndex = (currentIndex + 1) % messages.length;
                    rotatingText.textContent = messages[currentIndex];
                    rotatingText.style.opacity = '1';
                }, 300);
            }, 2000);
        </script>
        <div class="container">
            <nav>
                <a href="index.php" class="logo">Beauty<span>bar</span></a>
                <span class="menu-toggle" onclick="toggleMenu()">☰</span>
                <ul class="nav-links" id="navLinks">
                    <li><a href="index.php" <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'class="active"' : ''; ?>>Home</a></li>
                    <li><a href="products.php" <?php echo basename($_SERVER['PHP_SELF']) == 'products.php' ? 'class="active"' : ''; ?>>Shop</a></li>
                    <li><a href="services.php" <?php echo basename($_SERVER['PHP_SELF']) == 'services.php' ? 'class="active"' : ''; ?>>Categories</a></li>
                    <li><a href="cart.php" <?php echo basename($_SERVER['PHP_SELF']) == 'cart.php' ? 'class="active"' : ''; ?>><i class="fas fa-shopping-cart"></i> Cart</a></li>
                    <li><a href="contact.php" <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'class="active"' : ''; ?>>Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
