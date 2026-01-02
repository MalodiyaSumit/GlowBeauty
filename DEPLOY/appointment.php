<?php
session_start();
$pageTitle = "Place Order";
include 'includes/header.php';
include 'config/database.php';

// Initialize cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$message = '';
$messageType = '';

// Get cart items
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $payment = trim($_POST['payment']);
    $notes = trim($_POST['message']);

    // Build product list from cart
    $productList = '';
    foreach ($cartItems as $item) {
        $productList .= $item['name'] . ' (x' . $item['qty'] . '), ';
    }
    $productList = rtrim($productList, ', ');

    // Basic validation
    $errors = array();

    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    if (empty($phone) || strlen($phone) < 10) {
        $errors[] = "Valid phone number is required";
    }
    if (empty($cartItems)) {
        $errors[] = "Your cart is empty. Please add products first.";
    }
    if (empty($address)) {
        $errors[] = "Delivery address is required";
    }

    if (empty($errors)) {
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $phone = mysqli_real_escape_string($conn, $phone);
        $productList = mysqli_real_escape_string($conn, $productList);
        $address = mysqli_real_escape_string($conn, $address);
        $payment = mysqli_real_escape_string($conn, $payment);
        $notes = mysqli_real_escape_string($conn, $notes);
        $totalAmount = $total < 999 ? $total + 50 : $total;

        $sql = "INSERT INTO appointments (name, email, phone, service, date, time, message)
                VALUES ('$name', '$email', '$phone', '$productList', '$totalAmount', '$address', 'Payment: $payment. Notes: $notes')";

        if (mysqli_query($conn, $sql)) {
            // Clear cart after successful order
            $_SESSION['cart'] = array();
            $message = "Your order has been placed successfully! Order Total: ₹" . number_format($totalAmount, 0) . ". We will contact you shortly.";
            $messageType = "success";
            $cartItems = array();
            $total = 0;
        } else {
            $message = "Error: Could not place order. Please try again.";
            $messageType = "error";
        }
    } else {
        $message = implode("<br>", $errors);
        $messageType = "error";
    }
}
?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Checkout</h1>
            <p>Complete your order</p>
            <div class="breadcrumb">
                <a href="index.php">Home</a> <span>→</span> <a href="cart.php">Cart</a> <span>→</span> Checkout
            </div>
        </div>
    </div>

    <!-- Order Form Section -->
    <section class="form-section">
        <div class="container">
            <?php if(!empty($message) && $messageType == 'success'): ?>
                <div class="form-container" style="text-align: center;">
                    <div class="alert alert-success" style="margin-bottom: 30px;">
                        <?php echo $message; ?>
                    </div>
                    <i class="fas fa-check-circle" style="font-size: 80px; color: #4CAF50; margin-bottom: 20px;"></i>
                    <h2>Thank You!</h2>
                    <p>Your order has been placed successfully.</p>
                    <a href="products.php" class="btn btn-primary" style="margin-top: 20px;">Continue Shopping</a>
                </div>
            <?php elseif(empty($cartItems)): ?>
                <div class="form-container" style="text-align: center;">
                    <i class="fas fa-shopping-cart" style="font-size: 80px; color: #ccc; margin-bottom: 20px;"></i>
                    <h2>Your Cart is Empty</h2>
                    <p>Please add products to your cart before checkout.</p>
                    <a href="products.php" class="btn btn-primary" style="margin-top: 20px;">Browse Products</a>
                </div>
            <?php else: ?>
                <div class="checkout-wrapper">
                    <!-- Order Summary -->
                    <div class="checkout-summary">
                        <h3>Order Summary</h3>
                        <div class="checkout-items">
                            <?php foreach ($cartItems as $item): ?>
                                <div class="checkout-item">
                                    <span class="item-name"><?php echo htmlspecialchars($item['name']); ?> x <?php echo $item['qty']; ?></span>
                                    <span class="item-price">₹<?php echo number_format($item['subtotal'], 0); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="checkout-totals">
                            <div class="checkout-row">
                                <span>Subtotal</span>
                                <span>₹<?php echo number_format($total, 0); ?></span>
                            </div>
                            <div class="checkout-row">
                                <span>Shipping</span>
                                <span><?php echo $total >= 999 ? 'FREE' : '₹50'; ?></span>
                            </div>
                            <div class="checkout-row total">
                                <span>Total</span>
                                <span>₹<?php echo number_format($total < 999 ? $total + 50 : $total, 0); ?></span>
                            </div>
                        </div>
                        <a href="cart.php" class="btn btn-outline" style="width: 100%; text-align: center; margin-top: 15px;">Edit Cart</a>
                    </div>

                    <!-- Checkout Form -->
                    <div class="form-container" style="margin: 0; max-width: none;">
                        <h2>Delivery Details</h2>

                        <?php if(!empty($message) && $messageType == 'error'): ?>
                            <div class="alert alert-error">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="appointment.php">
                            <div class="form-group">
                                <label for="name">Full Name *</label>
                                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">Email Address *</label>
                                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number *</label>
                                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address">Delivery Address *</label>
                                <textarea id="address" name="address" placeholder="Enter your complete delivery address with pincode..." required style="min-height: 100px;"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="payment">Payment Method *</label>
                                <select id="payment" name="payment" required>
                                    <option value="COD">Cash on Delivery</option>
                                    <option value="UPI">UPI Payment</option>
                                    <option value="Bank">Bank Transfer</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="message">Additional Notes (Optional)</label>
                                <textarea id="message" name="message" placeholder="Any special requests or notes..."></textarea>
                            </div>

                            <div class="form-submit">
                                <button type="submit" class="btn btn-primary" style="width: 100%;">Place Order - ₹<?php echo number_format($total < 999 ? $total + 50 : $total, 0); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php
mysqli_close($conn);
include 'includes/footer.php';
?>
