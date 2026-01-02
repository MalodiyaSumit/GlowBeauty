<?php
$pageTitle = "Shop";
include 'includes/header.php';
include 'config/database.php';

// Fetch all products from database
$sql = "SELECT * FROM products ORDER BY category, name";
$result = mysqli_query($conn, $sql);
?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Shop All Products</h1>
            <p>Discover our complete range of premium beauty products</p>
            <div class="breadcrumb">
                <a href="index.php">Home</a> <span>→</span> Shop
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <section class="products">
        <div class="container">
            <?php if(mysqli_num_rows($result) > 0): ?>
                <div class="products-grid">
                    <?php
                    $counter = 0;
                    while($product = mysqli_fetch_assoc($result)):
                        $counter++;
                        $badges = ['New', 'Bestseller', 'Sale', 'Popular'];
                        $badge = $badges[$counter % 4];
                    ?>
                        <div class="product-card">
                            <a href="product-detail.php?id=<?php echo $product['id']; ?>">
                                <div class="product-image">
                                    <?php
                                    $images = [
                                        'Skincare' => 'https://images.unsplash.com/photo-1611930022073-b7a4ba5fcccd?w=300&h=300&fit=crop',
                                        'Makeup' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=300&h=300&fit=crop',
                                        'Hair Care' => 'https://images.unsplash.com/photo-1527799820374-dcf8d9d4a388?w=300&h=300&fit=crop',
                                        'Body Care' => 'https://images.unsplash.com/photo-1608248597279-f99d160bfcbc?w=300&h=300&fit=crop',
                                        'Nails' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=300&h=300&fit=crop'
                                    ];
                                    $imgUrl = isset($images[$product['category']]) ? $images[$product['category']] : 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=300&h=300&fit=crop';
                                    ?>
                                    <img src="<?php echo $imgUrl; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                    <span class="product-badge"><?php echo $badge; ?></span>
                                </div>
                                <div class="product-info">
                                    <span class="product-category"><?php echo htmlspecialchars($product['category']); ?></span>
                                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                                    <p style="font-size: 13px; color: #999; margin-bottom: 10px;"><?php echo htmlspecialchars($product['description']); ?></p>
                                    <div class="product-price">
                                        ₹<?php echo number_format($product['price'], 0); ?>
                                        <?php if($counter % 3 == 0): ?>
                                            <span class="original">₹<?php echo number_format($product['price'] * 1.2, 0); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div style="text-align: center; padding: 60px 20px;">
                    <span style="font-size: 60px;">🛍️</span>
                    <h3 style="margin: 20px 0 10px;">No Products Available</h3>
                    <p style="color: #999;">Please run the SQL file to add sample products.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Info Section -->
    <section style="background: var(--cream);">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Why Shop With Us</span>
                <h2>The GlowBeauty Promise</h2>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-check-circle"></i></div>
                    <h4>100% Authentic</h4>
                    <p>All products are genuine and sourced directly from brands.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-leaf"></i></div>
                    <h4>Natural Options</h4>
                    <p>Wide range of organic and natural beauty products.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-tag"></i></div>
                    <h4>Best Prices</h4>
                    <p>Competitive prices with regular discounts and offers.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-box"></i></div>
                    <h4>Fast Delivery</h4>
                    <p>Quick and secure delivery to your doorstep.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Order?</h2>
                <p>Fill out our order form and we'll get your products delivered!</p>
                <a href="appointment.php" class="btn btn-white">Place Order</a>
            </div>
        </div>
    </section>

<?php
mysqli_close($conn);
include 'includes/footer.php';
?>
