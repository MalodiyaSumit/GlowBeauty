<?php
$pageTitle = "Home";
include 'includes/header.php';
include 'config/database.php';

// Fetch featured products
$featuredSql = "SELECT * FROM products ORDER BY id DESC LIMIT 4";
$featuredResult = mysqli_query($conn, $featuredSql);
?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <span class="hero-badge">✨ New Collection 2024</span>
                    <h1>Discover Your <span>Natural</span> Beauty</h1>
                    <p>Explore our curated collection of premium skincare, makeup, and beauty products. Authentic brands, amazing prices.</p>
                    <div class="hero-buttons">
                        <a href="products.php" class="btn btn-primary">Shop Now</a>
                        <a href="services.php" class="btn btn-outline">View Categories</a>
                    </div>
                    <div class="hero-stats">
                        <div class="stat-item">
                            <h3>500+</h3>
                            <p>Products</p>
                        </div>
                        <div class="stat-item">
                            <h3>50+</h3>
                            <p>Brands</p>
                        </div>
                        <div class="stat-item">
                            <h3>10K+</h3>
                            <p>Customers</p>
                        </div>
                    </div>
                </div>
                <div class="hero-image">
                    <div class="hero-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=500&h=600&fit=crop" alt="Beauty Products">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-truck"></i></div>
                    <h4>Free Shipping</h4>
                    <p>On orders above ₹999</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-check-circle"></i></div>
                    <h4>100% Authentic</h4>
                    <p>Genuine products only</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-undo"></i></div>
                    <h4>Easy Returns</h4>
                    <p>7-day return policy</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-lock"></i></div>
                    <h4>Secure Payment</h4>
                    <p>100% secure checkout</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Browse</span>
                <h2>Shop by Category</h2>
                <p>Find the perfect products for your beauty routine</p>
            </div>
            <div class="categories-grid">
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1611930022073-b7a4ba5fcccd?w=400&h=300&fit=crop" alt="Skincare">
                    </div>
                    <h3>Skincare</h3>
                    <p>Cleansers, serums, moisturizers & more</p>
                    <a href="products.php" class="category-link">Shop Now →</a>
                </div>
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=400&h=300&fit=crop" alt="Makeup">
                    </div>
                    <h3>Makeup</h3>
                    <p>Lipsticks, foundations, eyeshadows</p>
                    <a href="products.php" class="category-link">Shop Now →</a>
                </div>
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1527799820374-dcf8d9d4a388?w=400&h=300&fit=crop" alt="Hair Care">
                    </div>
                    <h3>Hair Care</h3>
                    <p>Shampoos, oils, treatments</p>
                    <a href="products.php" class="category-link">Shop Now →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="products">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Featured</span>
                <h2>Bestselling Products</h2>
                <p>Our most loved products by customers</p>
            </div>
            <div class="products-grid">
                <?php if(mysqli_num_rows($featuredResult) > 0): ?>
                    <?php while($product = mysqli_fetch_assoc($featuredResult)): ?>
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
                                    <span class="product-badge">Bestseller</span>
                                </div>
                                <div class="product-info">
                                    <span class="product-category"><?php echo htmlspecialchars($product['category']); ?></span>
                                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                                    <div class="product-price">₹<?php echo number_format($product['price'], 0); ?></div>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p style="text-align:center; grid-column: 1/-1;">Products coming soon!</p>
                <?php endif; ?>
            </div>
            <div style="text-align: center; margin-top: 50px;">
                <a href="products.php" class="btn btn-primary">View All Products</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-image">
                    <div class="about-image-main">
                        <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=500&h=600&fit=crop" alt="About Beautybar">
                    </div>
                    <div class="about-image-float">
                        <h3>5+</h3>
                        <p>Years Experience</p>
                    </div>
                </div>
                <div class="about-text">
                    <span class="section-badge">About Us</span>
                    <h2>Your Trusted Beauty Partner</h2>
                    <p>At Beautybar, we believe everyone deserves access to premium beauty products. We carefully curate our collection from trusted brands to bring you the best in skincare, makeup, and beauty essentials.</p>
                    <div class="about-features">
                        <div class="about-feature">
                            <span><i class="fas fa-check"></i></span>
                            <p>100% Authentic Products</p>
                        </div>
                        <div class="about-feature">
                            <span><i class="fas fa-check"></i></span>
                            <p>Cruelty-Free Options</p>
                        </div>
                        <div class="about-feature">
                            <span><i class="fas fa-check"></i></span>
                            <p>Expert Recommendations</p>
                        </div>
                        <div class="about-feature">
                            <span><i class="fas fa-check"></i></span>
                            <p>Quality Guaranteed</p>
                        </div>
                    </div>
                    <a href="contact.php" class="btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Glow?</h2>
                <p>Place your order today and get free shipping on orders above ₹999!</p>
                <a href="appointment.php" class="btn btn-white">Place Order Now</a>
            </div>
        </div>
    </section>

<?php
mysqli_close($conn);
include 'includes/footer.php';
?>
