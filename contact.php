<?php
$pageTitle = "Contact Us";
include 'includes/header.php';
include 'config/database.php';

$message = '';
$messageType = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $userMessage = trim($_POST['message']);

    $errors = array();

    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    if (empty($userMessage)) {
        $errors[] = "Message is required";
    }

    if (empty($errors)) {
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $subject = mysqli_real_escape_string($conn, $subject);
        $userMessage = mysqli_real_escape_string($conn, $userMessage);

        $sql = "INSERT INTO contact_messages (name, email, subject, message)
                VALUES ('$name', '$email', '$subject', '$userMessage')";

        if (mysqli_query($conn, $sql)) {
            $message = "Thank you for your message! We'll get back to you soon.";
            $messageType = "success";
        } else {
            $message = "Error: Could not send message. Please try again.";
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
            <h1>Contact Us</h1>
            <p>We'd love to hear from you. Get in touch with us!</p>
            <div class="breadcrumb">
                <a href="index.php">Home</a> <span>→</span> Contact
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <section class="form-section">
        <div class="container">
            <div class="contact-wrapper">
                <!-- Contact Info -->
                <div class="contact-info">
                    <h3>Get In Touch</h3>
                    <p style="margin-bottom: 30px;">Have questions about our products? Need help with an order? We're here to help!</p>

                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="contact-details">
                            <h4>Our Location</h4>
                            <p>Umiya Campus, Near Bhagvat Vidyapith, S G Highway, Sola, Ahmedabad- 380060, Gujarat</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-phone"></i></div>
                        <div class="contact-details">
                            <h4>Phone Number</h4>
                            <p>+91 9725620168</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                        <div class="contact-details">
                            <h4>Email Address</h4>
                            <p>Malodiyadhruvi13@gmail.com</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-clock"></i></div>
                        <div class="contact-details">
                            <h4>Working Hours</h4>
                            <p>Mon - Sat: 10AM - 8PM<br>Sunday: 11AM - 6PM</p>
                        </div>
                    </div>

                    <div class="social-links">
                        <a href="#" class="social-link" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link" title="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="form-container" style="margin: 0; max-width: none;">
                    <h2 style="font-size: 1.5rem;">Send Us a Message</h2>

                    <?php if(!empty($message)): ?>
                        <div class="alert alert-<?php echo $messageType; ?>">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="contact.php" id="contactForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Your Name *</label>
                                <input type="text" id="name" name="name" placeholder="Enter your name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <select id="subject" name="subject">
                                <option value="General Inquiry">General Inquiry</option>
                                <option value="Product Question">Product Question</option>
                                <option value="Order Status">Order Status</option>
                                <option value="Return/Refund">Return/Refund</option>
                                <option value="Feedback">Feedback</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message">Your Message *</label>
                            <textarea id="message" name="message" placeholder="Write your message here..." required></textarea>
                        </div>

                        <div class="form-submit">
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section style="background: #fff;">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">FAQ</span>
                <h2>Frequently Asked Questions</h2>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <h3>How long does delivery take?</h3>
                    <p>Standard delivery takes 3-5 business days. Express delivery is available for select locations.</p>
                </div>
                <div class="service-card">
                    <h3>Are all products authentic?</h3>
                    <p>Yes! We only sell 100% authentic products sourced directly from brands or authorized distributors.</p>
                </div>
                <div class="service-card">
                    <h3>What is your return policy?</h3>
                    <p>We offer a 7-day return policy for unopened products. Contact us for return requests.</p>
                </div>
                <div class="service-card">
                    <h3>Do you offer COD?</h3>
                    <p>Yes, Cash on Delivery is available for most locations. Check availability during checkout.</p>
                </div>
                <div class="service-card">
                    <h3>How can I track my order?</h3>
                    <p>Once shipped, you'll receive a tracking link via SMS and email to monitor your delivery.</p>
                </div>
                <div class="service-card">
                    <h3>Do you ship internationally?</h3>
                    <p>Currently, we only ship within India. International shipping coming soon!</p>
                </div>
            </div>
        </div>
    </section>

<?php
mysqli_close($conn);
include 'includes/footer.php';
?>
