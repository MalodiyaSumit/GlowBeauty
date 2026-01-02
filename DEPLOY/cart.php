<?php
session_start();
include 'config/database.php';

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Add to cart
if (isset($_GET['add'])) {
    $product_id = (int)$_GET['add'];
    $qty = isset($_GET['qty']) ? (int)$_GET['qty'] : 1;

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $qty;
    } else {
        $_SESSION['cart'][$product_id] = $qty;
    }

    header("Location: cart.php");
    exit;
}

// Remove from cart
if (isset($_GET['remove'])) {
    $product_id = (int)$_GET['remove'];
    unset($_SESSION['cart'][$product_id]);
    header("Location: cart.php");
    exit;
}

// Update quantity
if (isset($_POST['update_cart'])) {
    foreach ($_POST['qty'] as $product_id => $qty) {
        if ($qty > 0) {
            $_SESSION['cart'][$product_id] = (int)$qty;
        } else {
            unset($_SESSION['cart'][$product_id]);
        }
    }
    header("Location: cart.php");
    exit;
}

// Clear cart
if (isset($_GET['clear'])) {
    $_SESSION['cart'] = array();
    header("Location: cart.php");
    exit;
}

$pageTitle = "Shopping Cart";
include 'includes/header.php';

// Get cart items from database
$cartItems = array();
$total = 0;

if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_keys($_SESSION['cart']));
    $sql = "SELECT * FROM products WHERE id IN ($ids)";
    $result = mysqli_query($conn, $sql);

    while ($product = mysqli_fetch_assoc($result)) {
        $product['qty'] = $_SESSION['cart'][$product['id']];
        $product['subtotal'] = $product['price'] * $product['qty'];
        $total += $product['subtotal'];
        $cartItems[] = $product;
    }
}
?>

<div class="page-header">
    <div class="container">
        <h1>Shopping Cart</h1>
        <p>Review your items before checkout</p>
        <div class="breadcrumb">
            <a href="index.php">Home</a> <span>→</span> Cart
        </div>
    </div>
</div>

<section class="cart-section">
    <div class="container">
        <?php if (!empty($cartItems)): ?>
            <form method="POST" action="cart.php">
                <div class="cart-wrapper">
                    <div class="cart-items">
                        <?php foreach ($cartItems as $item): ?>
                            <div class="cart-item">
                                <div class="cart-item-image">
                                    <?php
                                    $images = [
                                        'Skincare' => 'https://images.unsplash.com/photo-1611930022073-b7a4ba5fcccd?w=100&h=100&fit=crop',
                                        'Makeup' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=100&h=100&fit=crop',
                                        'Hair Care' => 'https://images.unsplash.com/photo-1527799820374-dcf8d9d4a388?w=100&h=100&fit=crop',
                                        'Body Care' => 'https://images.unsplash.com/photo-1608248597279-f99d160bfcbc?w=100&h=100&fit=crop',
                                        'Nails' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=100&h=100&fit=crop'
                                    ];
                                    $imgUrl = isset($images[$item['category']]) ? $images[$item['category']] : 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=100&h=100&fit=crop';
                                    ?>
                                    <img src="<?php echo $imgUrl; ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
                                </div>
                                <div class="cart-item-details">
                                    <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                                    <p class="cart-item-category"><?php echo htmlspecialchars($item['category']); ?></p>
                                    <p class="cart-item-price">₹<?php echo number_format($item['price'], 0); ?></p>
                                </div>
                                <div class="cart-item-qty">
                                    <input type="number" name="qty[<?php echo $item['id']; ?>]" value="<?php echo $item['qty']; ?>" min="1" max="10">
                                </div>
                                <div class="cart-item-subtotal">
                                    ₹<?php echo number_format($item['subtotal'], 0); ?>
                                </div>
                                <a href="cart.php?remove=<?php echo $item['id']; ?>" class="cart-item-remove">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="cart-summary">
                        <h3>Order Summary</h3>
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>₹<?php echo number_format($total, 0); ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span><?php echo $total >= 999 ? 'FREE' : '₹50'; ?></span>
                        </div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span>₹<?php echo number_format($total < 999 ? $total + 50 : $total, 0); ?></span>
                        </div>
                        <button type="submit" name="update_cart" class="btn btn-outline" style="width:100%; margin-bottom:10px;">Update Cart</button>
                        <a href="appointment.php" class="btn btn-primary" style="width:100%; text-align:center;">Proceed to Checkout</a>
                        <a href="cart.php?clear=1" class="btn btn-outline" style="width:100%; margin-top:10px; text-align:center;">Clear Cart</a>
                    </div>
                </div>
            </form>
        <?php else: ?>
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h2>Your cart is empty</h2>
                <p>Looks like you haven't added any products yet.</p>
                <a href="products.php" class="btn btn-primary">Continue Shopping</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
mysqli_close($conn);
include 'includes/footer.php';
?>
