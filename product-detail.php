<?php
session_start();
include 'config/database.php';

// Initialize cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Get product ID from URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch product details
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0) {
    header("Location: products.php");
    exit;
}

$product = mysqli_fetch_assoc($result);
$pageTitle = $product['name'];

// Fetch related products (same category)
$relatedSql = "SELECT * FROM products WHERE category = '" . mysqli_real_escape_string($conn, $product['category']) . "' AND id != $product_id LIMIT 4";
$relatedResult = mysqli_query($conn, $relatedSql);

include 'includes/header.php';
?>

    <!-- Breadcrumb -->
    <div class="page-header" style="padding: 120px 0 30px;">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php">Home</a> <span>→</span>
                <a href="products.php">Shop</a> <span>→</span>
                <?php echo htmlspecialchars($product['name']); ?>
            </div>
        </div>
    </div>

    <!-- Product Detail Section -->
    <section class="product-detail-section">
        <div class="container">
            <div class="product-detail-wrapper">
                <!-- Product Image -->
                <div class="product-detail-image">
                    <?php
                    $images = [
                        'Skincare' => [
                            'https://images.unsplash.com/photo-1611930022073-b7a4ba5fcccd?w=500&h=500&fit=crop',
                            'https://images.unsplash.com/photo-1570194065650-d99fb4b38b15?w=100&h=100&fit=crop',
                            'https://images.unsplash.com/photo-1556228720-195a672e8a03?w=100&h=100&fit=crop'
                        ],
                        'Makeup' => [
                            'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=500&h=500&fit=crop',
                            'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=100&h=100&fit=crop',
                            'https://images.unsplash.com/photo-1586495777744-4413f21062fa?w=100&h=100&fit=crop'
                        ],
                        'Hair Care' => [
                            'https://images.unsplash.com/photo-1527799820374-dcf8d9d4a388?w=500&h=500&fit=crop',
                            'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=100&h=100&fit=crop',
                            'https://images.unsplash.com/photo-1519699047748-de8e457a634e?w=100&h=100&fit=crop'
                        ],
                        'Body Care' => [
                            'https://images.unsplash.com/photo-1608248597279-f99d160bfcbc?w=500&h=500&fit=crop',
                            'https://images.unsplash.com/photo-1570194065650-d99fb4b38b15?w=100&h=100&fit=crop',
                            'https://images.unsplash.com/photo-1556228720-195a672e8a03?w=100&h=100&fit=crop'
                        ],
                        'Nails' => [
                            'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=500&h=500&fit=crop',
                            'https://images.unsplash.com/photo-1607779097040-26e80aa78e66?w=100&h=100&fit=crop',
                            'https://images.unsplash.com/photo-1519014816548-bf5fe059798b?w=100&h=100&fit=crop'
                        ]
                    ];
                    $default = [
                        'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=500&h=500&fit=crop',
                        'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=100&h=100&fit=crop',
                        'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=100&h=100&fit=crop'
                    ];
                    $productImages = isset($images[$product['category']]) ? $images[$product['category']] : $default;
                    ?>
                    <div class="product-image-main">
                        <img src="<?php echo $productImages[0]; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" id="mainImage">
                        <span class="product-detail-badge">Authentic</span>
                    </div>
                    <div class="product-thumbnails">
                        <div class="thumbnail active" onclick="changeImage('<?php echo $productImages[0]; ?>')">
                            <img src="<?php echo $productImages[0]; ?>" alt="View 1">
                        </div>
                        <div class="thumbnail" onclick="changeImage('<?php echo $productImages[1]; ?>')">
                            <img src="<?php echo $productImages[1]; ?>" alt="View 2">
                        </div>
                        <div class="thumbnail" onclick="changeImage('<?php echo $productImages[2]; ?>')">
                            <img src="<?php echo $productImages[2]; ?>" alt="View 3">
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="product-detail-info">
                    <span class="product-detail-category"><?php echo htmlspecialchars($product['category']); ?></span>
                    <h1 class="product-detail-title"><?php echo htmlspecialchars($product['name']); ?></h1>

                    <div class="product-detail-rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-text">(4.8) · 128 Reviews</span>
                    </div>

                    <div class="product-detail-price">
                        <span class="current-price">₹<?php echo number_format($product['price'], 0); ?></span>
                        <span class="original-price">₹<?php echo number_format($product['price'] * 1.25, 0); ?></span>
                        <span class="discount-badge">20% OFF</span>
                    </div>

                    <p class="product-detail-description">
                        <?php echo htmlspecialchars($product['description']); ?>
                    </p>

                    <div class="product-detail-features">
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>100% Authentic Product</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Dermatologically Tested</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check-circle"></i>
                            <span>Suitable for All Skin Types</span>
                        </div>
                    </div>

                    <div class="product-detail-options">
                        <div class="option-group">
                            <label>Quantity:</label>
                            <div class="quantity-selector">
                                <button class="qty-btn" onclick="changeQty(-1)">-</button>
                                <input type="number" id="quantity" value="1" min="1" max="10">
                                <button class="qty-btn" onclick="changeQty(1)">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="product-detail-actions">
                        <a href="cart.php?add=<?php echo $product['id']; ?>&qty=1" class="btn btn-primary btn-large" onclick="this.href='cart.php?add=<?php echo $product['id']; ?>&qty='+document.getElementById('quantity').value">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </a>
                        <a href="cart.php" class="btn btn-outline btn-large">
                            <i class="fas fa-shopping-bag"></i> View Cart
                        </a>
                    </div>

                    <div class="product-detail-meta">
                        <div class="meta-item">
                            <i class="fas fa-truck"></i>
                            <div>
                                <strong>Free Delivery</strong>
                                <span>On orders above ₹999</span>
                            </div>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-undo"></i>
                            <div>
                                <strong>Easy Returns</strong>
                                <span>7-day return policy</span>
                            </div>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-shield-alt"></i>
                            <div>
                                <strong>Secure Payment</strong>
                                <span>100% secure checkout</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Details Tabs -->
    <section class="product-tabs-section">
        <div class="container">
            <div class="product-tabs">
                <button class="tab-btn active" onclick="showTab('description')">Description</button>
                <button class="tab-btn" onclick="showTab('ingredients')">Ingredients</button>
                <button class="tab-btn" onclick="showTab('howto')">How to Use</button>
                <button class="tab-btn" onclick="showTab('reviews')">Reviews</button>
            </div>

            <div class="tab-content" id="description">
                <h3>Product Description</h3>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p>This premium <?php echo strtolower($product['category']); ?> product from GlowBeauty is carefully formulated to deliver exceptional results. Made with high-quality ingredients, it's perfect for daily use and suitable for all skin types.</p>
                <ul>
                    <li>Premium quality formulation</li>
                    <li>Long-lasting results</li>
                    <li>Gentle on skin</li>
                    <li>Paraben-free</li>
                    <li>Cruelty-free</li>
                </ul>
            </div>

            <div class="tab-content" id="ingredients" style="display: none;">
                <h3>Key Ingredients</h3>
                <ul>
                    <li><strong>Natural Extracts:</strong> Enriched with botanical extracts for nourishment</li>
                    <li><strong>Vitamin E:</strong> Provides antioxidant protection</li>
                    <li><strong>Hyaluronic Acid:</strong> Deep hydration and moisture retention</li>
                    <li><strong>Aloe Vera:</strong> Soothing and calming properties</li>
                </ul>
            </div>

            <div class="tab-content" id="howto" style="display: none;">
                <h3>How to Use</h3>
                <ol>
                    <li>Cleanse your face/skin thoroughly</li>
                    <li>Take a small amount of the product</li>
                    <li>Apply gently in circular motions</li>
                    <li>Allow it to absorb completely</li>
                    <li>Use twice daily for best results</li>
                </ol>
            </div>

            <div class="tab-content" id="reviews" style="display: none;">
                <h3>Customer Reviews</h3>
                <div class="review-summary">
                    <div class="rating-big">4.8</div>
                    <div class="rating-details">
                        <div class="stars-big">★★★★★</div>
                        <p>Based on 128 reviews</p>
                    </div>
                </div>
                <div class="review-item">
                    <div class="review-header">
                        <strong>Priya S.</strong>
                        <span class="review-stars">★★★★★</span>
                    </div>
                    <p>"Amazing product! Loved the results. Will definitely buy again."</p>
                    <span class="review-date">Verified Purchase · 2 days ago</span>
                </div>
                <div class="review-item">
                    <div class="review-header">
                        <strong>Anita M.</strong>
                        <span class="review-stars">★★★★★</span>
                    </div>
                    <p>"Best product I've used. Great quality and fast delivery!"</p>
                    <span class="review-date">Verified Purchase · 1 week ago</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    <?php if(mysqli_num_rows($relatedResult) > 0): ?>
    <section class="products" style="background: var(--cream);">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">You May Also Like</span>
                <h2>Related Products</h2>
            </div>
            <div class="products-grid">
                <?php while($related = mysqli_fetch_assoc($relatedResult)): ?>
                    <div class="product-card">
                        <a href="product-detail.php?id=<?php echo $related['id']; ?>">
                            <div class="product-image">
                                <?php
                                $relImages = [
                                    'Skincare' => 'https://images.unsplash.com/photo-1611930022073-b7a4ba5fcccd?w=300&h=300&fit=crop',
                                    'Makeup' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=300&h=300&fit=crop',
                                    'Hair Care' => 'https://images.unsplash.com/photo-1527799820374-dcf8d9d4a388?w=300&h=300&fit=crop',
                                    'Body Care' => 'https://images.unsplash.com/photo-1608248597279-f99d160bfcbc?w=300&h=300&fit=crop',
                                    'Nails' => 'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=300&h=300&fit=crop'
                                ];
                                $relImg = isset($relImages[$related['category']]) ? $relImages[$related['category']] : 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=300&h=300&fit=crop';
                                ?>
                                <img src="<?php echo $relImg; ?>" alt="<?php echo htmlspecialchars($related['name']); ?>">
                            </div>
                            <div class="product-info">
                                <span class="product-category"><?php echo htmlspecialchars($related['category']); ?></span>
                                <h3><?php echo htmlspecialchars($related['name']); ?></h3>
                                <div class="product-price">₹<?php echo number_format($related['price'], 0); ?></div>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <script>
        function changeQty(change) {
            var input = document.getElementById('quantity');
            var newVal = parseInt(input.value) + change;
            if(newVal >= 1 && newVal <= 10) {
                input.value = newVal;
            }
        }

        function changeImage(src) {
            document.getElementById('mainImage').src = src;
            document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
            event.currentTarget.classList.add('active');
        }

        function showTab(tabId) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(function(tab) {
                tab.style.display = 'none';
            });
            // Remove active class from buttons
            document.querySelectorAll('.tab-btn').forEach(function(btn) {
                btn.classList.remove('active');
            });
            // Show selected tab
            document.getElementById(tabId).style.display = 'block';
            // Add active class to clicked button
            event.target.classList.add('active');
        }
    </script>

<?php
mysqli_close($conn);
include 'includes/footer.php';
?>
