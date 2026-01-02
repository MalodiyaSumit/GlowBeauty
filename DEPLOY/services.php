<?php
$pageTitle = "Categories";
include 'includes/header.php';
?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <h1>Shop by Category</h1>
            <p>Browse our curated collection of beauty products</p>
            <div class="breadcrumb">
                <a href="index.php">Home</a> <span>→</span> Categories
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <section class="categories" style="background: #fff;">
        <div class="container">
            <div class="categories-grid">
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1611930022073-b7a4ba5fcccd?w=400&h=300&fit=crop" alt="Skincare">
                    </div>
                    <h3>Skincare</h3>
                    <p>Cleansers, toners, serums, moisturizers, sunscreens, and face masks for healthy, glowing skin.</p>
                    <a href="products.php" class="category-link">Shop Skincare →</a>
                </div>
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=400&h=300&fit=crop" alt="Makeup">
                    </div>
                    <h3>Makeup</h3>
                    <p>Foundations, lipsticks, eyeshadows, mascaras, and complete makeup kits for every occasion.</p>
                    <a href="products.php" class="category-link">Shop Makeup →</a>
                </div>
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1527799820374-dcf8d9d4a388?w=400&h=300&fit=crop" alt="Hair Care">
                    </div>
                    <h3>Hair Care</h3>
                    <p>Shampoos, conditioners, hair oils, serums, and treatments for beautiful, healthy hair.</p>
                    <a href="products.php" class="category-link">Shop Hair Care →</a>
                </div>
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1608248597279-f99d160bfcbc?w=400&h=300&fit=crop" alt="Body Care">
                    </div>
                    <h3>Body Care</h3>
                    <p>Body lotions, scrubs, shower gels, and moisturizers for soft, smooth skin all over.</p>
                    <a href="products.php" class="category-link">Shop Body Care →</a>
                </div>
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1604654894610-df63bc536371?w=400&h=300&fit=crop" alt="Nails">
                    </div>
                    <h3>Nails</h3>
                    <p>Nail polishes, nail art kits, manicure tools, and nail care essentials.</p>
                    <a href="products.php" class="category-link">Shop Nails →</a>
                </div>
                <div class="category-card">
                    <div class="category-img">
                        <img src="https://images.unsplash.com/photo-1541643600914-78b084683601?w=400&h=300&fit=crop" alt="Fragrances">
                    </div>
                    <h3>Fragrances</h3>
                    <p>Perfumes, body mists, deodorants, and fragrance gift sets for every personality.</p>
                    <a href="products.php" class="category-link">Shop Fragrances →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Brands Section -->
    <section style="background: var(--cream);">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Our Brands</span>
                <h2>Trusted Brands We Carry</h2>
                <p>Only authentic products from renowned beauty brands</p>
            </div>
            <div class="brands-grid">
                <div class="brand-card">
                    <span class="brand-name">Lakme</span>
                </div>
                <div class="brand-card">
                    <span class="brand-name">Mamaearth</span>
                </div>
                <div class="brand-card">
                    <span class="brand-name">Maybelline</span>
                </div>
                <div class="brand-card">
                    <span class="brand-name">Himalaya</span>
                </div>
                <div class="brand-card">
                    <span class="brand-name">L'Oreal</span>
                </div>
                <div class="brand-card">
                    <span class="brand-name">Nivea</span>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Can't Find What You Need?</h2>
                <p>Contact us and we'll help you find the perfect product for your needs!</p>
                <a href="contact.php" class="btn btn-white">Contact Us</a>
            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
