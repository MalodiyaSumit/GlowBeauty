/**
 * Beautybar - Beauty Products Store
 * JavaScript Functionality
 */

// Mobile Menu Toggle
function toggleMenu() {
    var navLinks = document.getElementById('navLinks');
    navLinks.classList.toggle('active');
}

// Close mobile menu when clicking outside
document.addEventListener('click', function(e) {
    var navLinks = document.getElementById('navLinks');
    var menuToggle = document.querySelector('.menu-toggle');

    if (navLinks && navLinks.classList.contains('active')) {
        if (!navLinks.contains(e.target) && !menuToggle.contains(e.target)) {
            navLinks.classList.remove('active');
        }
    }
});

// Header scroll effect
window.addEventListener('scroll', function() {
    var header = document.querySelector('header');
    if (window.scrollY > 50) {
        header.style.boxShadow = '0 2px 20px rgba(0,0,0,0.1)';
    } else {
        header.style.boxShadow = '0 2px 20px rgba(0,0,0,0.06)';
    }
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
    anchor.addEventListener('click', function(e) {
        var target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Form Validation
document.addEventListener('DOMContentLoaded', function() {

    // Order Form Validation
    var orderForm = document.getElementById('appointmentForm');
    if (orderForm) {
        orderForm.addEventListener('submit', function(e) {
            var isValid = true;
            var errors = [];

            var name = document.getElementById('name').value.trim();
            var email = document.getElementById('email').value.trim();
            var phone = document.getElementById('phone').value.trim();
            var product = document.getElementById('service').value;

            if (name === '' || name.length < 2) {
                isValid = false;
                errors.push('Please enter a valid name');
            }

            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                isValid = false;
                errors.push('Please enter a valid email address');
            }

            var phonePattern = /^[0-9]{10,12}$/;
            if (!phonePattern.test(phone.replace(/\s/g, ''))) {
                isValid = false;
                errors.push('Please enter a valid 10-digit phone number');
            }

            if (product === '') {
                isValid = false;
                errors.push('Please select a product');
            }

            if (!isValid) {
                e.preventDefault();
                alert('Please fix the following:\n\n' + errors.join('\n'));
            }
        });
    }

    // Contact Form Validation
    var contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            var isValid = true;
            var errors = [];

            var name = document.getElementById('name').value.trim();
            var email = document.getElementById('email').value.trim();
            var message = document.getElementById('message').value.trim();

            if (name === '' || name.length < 2) {
                isValid = false;
                errors.push('Please enter a valid name');
            }

            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                isValid = false;
                errors.push('Please enter a valid email address');
            }

            if (message === '' || message.length < 10) {
                isValid = false;
                errors.push('Please enter a message (at least 10 characters)');
            }

            if (!isValid) {
                e.preventDefault();
                alert('Please fix the following:\n\n' + errors.join('\n'));
            }
        });
    }
});

// Animate elements on scroll
function animateOnScroll() {
    var elements = document.querySelectorAll('.feature-card, .category-card, .product-card, .service-card');

    elements.forEach(function(element) {
        var position = element.getBoundingClientRect();

        if (position.top < window.innerHeight - 100) {
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }
    });
}

// Initialize animations
document.addEventListener('DOMContentLoaded', function() {
    var elements = document.querySelectorAll('.feature-card, .category-card, .product-card, .service-card');

    elements.forEach(function(element) {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    });

    // Trigger initial animation
    setTimeout(animateOnScroll, 100);
});

window.addEventListener('scroll', animateOnScroll);

// Product card wishlist functionality (demo)
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('action-btn')) {
        var btn = e.target;
        if (btn.textContent.trim() === '♡') {
            btn.textContent = '♥';
            btn.style.color = '#e8a4b8';
        } else if (btn.textContent.trim() === '♥') {
            btn.textContent = '♡';
            btn.style.color = '';
        }
    }
});
