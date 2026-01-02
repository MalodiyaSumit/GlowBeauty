<?php
$pageTitle = "Place Order";
include 'includes/header.php';
include 'config/database.php';

$message = '';
$messageType = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $product = trim($_POST['service']);
    $quantity = isset($_POST['date']) ? $_POST['date'] : '1';
    $address = isset($_POST['time']) ? $_POST['time'] : '';
    $notes = trim($_POST['message']);

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
    if (empty($product)) {
        $errors[] = "Please select a product";
    }
    if (empty($address)) {
        $errors[] = "Delivery address is required";
    }

    if (empty($errors)) {
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $phone = mysqli_real_escape_string($conn, $phone);
        $product = mysqli_real_escape_string($conn, $product);
        $quantity = mysqli_real_escape_string($conn, $quantity);
        $address = mysqli_real_escape_string($conn, $address);
        $notes = mysqli_real_escape_string($conn, $notes);

        $sql = "INSERT INTO appointments (name, email, phone, service, date, time, message)
                VALUES ('$name', '$email', '$phone', '$product', '$quantity', '$address', '$notes')";

        if (mysqli_query($conn, $sql)) {
            $message = "Your order has been placed successfully! We will contact you shortly to confirm.";
            $messageType = "success";
        } else {
            $message = "Error: Could not place order. Please try again.";
            $messageType = "error";
        }
    } else {
        $message = implode("<br>", $errors);
        $messageType = "error";
    }
}

// Fetch products for dropdown
$productsSql = "SELECT * FROM products ORDER BY name";
$productsResult = mysqli_query($conn, $productsSql);
?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Place Your Order</h1>
            <p>Fill out the form below and we'll deliver to your doorstep</p>
            <div class="breadcrumb">
                <a href="index.php">Home</a> <span>→</span> Order
            </div>
        </div>
    </div>

    <!-- Order Form Section -->
    <section class="form-section">
        <div class="container">
            <div class="form-container">
                <h2>Order Form</h2>

                <?php if(!empty($message)): ?>
                    <div class="alert alert-<?php echo $messageType; ?>">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="appointment.php" id="appointmentForm">
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
                        <label for="service">Select Product *</label>
                        <select id="service" name="service" required>
                            <option value="">-- Select a Product --</option>
                            <?php if(mysqli_num_rows($productsResult) > 0): ?>
                                <?php while($prod = mysqli_fetch_assoc($productsResult)): ?>
                                    <option value="<?php echo htmlspecialchars($prod['name']); ?>">
                                        <?php echo htmlspecialchars($prod['name']); ?> - ₹<?php echo number_format($prod['price'], 0); ?>
                                    </option>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <option value="Skincare Product">Skincare Product</option>
                                <option value="Makeup Product">Makeup Product</option>
                                <option value="Hair Care Product">Hair Care Product</option>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="date">Quantity *</label>
                            <select id="date" name="date" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="time">Payment Method *</label>
                            <select id="time" name="payment" required>
                                <option value="">-- Select Payment --</option>
                                <option value="COD">Cash on Delivery</option>
                                <option value="UPI">UPI Payment</option>
                                <option value="Bank">Bank Transfer</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="time">Delivery Address *</label>
                        <textarea id="time" name="time" placeholder="Enter your complete delivery address with pincode..." required style="min-height: 100px;"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="message">Additional Notes (Optional)</label>
                        <textarea id="message" name="message" placeholder="Any special requests or notes..."></textarea>
                    </div>

                    <div class="form-submit">
                        <button type="submit" class="btn btn-primary">Place Order</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section style="background: #fff;">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Delivery Info</span>
                <h2>How It Works</h2>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">1</div>
                    <h4>Place Order</h4>
                    <p>Fill out the order form with your details</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">2</div>
                    <h4>Confirmation</h4>
                    <p>We'll call to confirm your order</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">3</div>
                    <h4>Processing</h4>
                    <p>Your order will be packed carefully</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">4</div>
                    <h4>Delivery</h4>
                    <p>Delivered to your doorstep in 3-5 days</p>
                </div>
            </div>
        </div>
    </section>

<?php
mysqli_close($conn);
include 'includes/footer.php';
?>
