<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Clinic - Your Health, Our Priority</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        :root {
            --primary: #004258;
            --primary-light: #5a7d8c;
            --primary-dark: #00354a;
            --accent: rgba(90, 125, 140, 0.7);
            --text: #333;
            --text-light: #777;
            --danger: #e74c3c;
            --success: #2ecc71;
            --warning: #f39c12;
            --info: #3498db;
            --border-radius: 24px;
            --border-radius-sm: 12px;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: #f5f5f5;
            color: var(--text);
            min-height: 100vh;
        }

        .app-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header Styles */
        .dashboard-header {
            background-color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            color: var(--primary);
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-large {
            padding: 15px 30px;
            font-size: 18px;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .btn-outline:hover {
            background-color: rgba(0, 66, 88, 0.05);
        }

        /* Hero Section */
        .hero-section {
            display: flex;
            align-items: center;
            padding: 80px 30px;
            background-color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background-color: var(--primary-light);
            opacity: 0.1;
            border-radius: 50%;
            transform: translate(50%, -50%);
        }

        .hero-content {
            flex: 1;
            max-width: 600px;
            padding-right: 30px;
        }

        .hero-content h1 {
            font-size: 48px;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 18px;
            color: var(--text-light);
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-image img {
            max-width: 100%;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }

        /* Features Section */
        .features-section {
            padding: 80px 30px;
            text-align: center;
        }

        .features-section h2 {
            font-size: 36px;
            color: var(--primary);
            margin-bottom: 50px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background-color: white;
            padding: 30px;
            border-radius: var(--border-radius-sm);
            box-shadow: var(--shadow);
            transition: transform 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background-color: rgba(0, 66, 88, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .feature-icon i {
            font-size: 30px;
            color: var(--primary);
        }

        .feature-card h3 {
            font-size: 20px;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .feature-card p {
            color: var(--text-light);
            line-height: 1.6;
        }

        /* Testimonials Section */
        .testimonials-section {
            padding: 80px 30px;
            background-color: rgba(0, 66, 88, 0.05);
            text-align: center;
        }

        .testimonials-section h2 {
            font-size: 36px;
            color: var(--primary);
            margin-bottom: 50px;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .testimonial-card {
            background-color: white;
            padding: 30px;
            border-radius: var(--border-radius-sm);
            box-shadow: var(--shadow);
            text-align: left;
        }

        .testimonial-content {
            margin-bottom: 20px;
        }

        .testimonial-content p {
            font-style: italic;
            color: var(--text);
            line-height: 1.6;
            font-size: 16px;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .author-name {
            font-weight: bold;
            color: var(--primary);
        }

        .author-title {
            color: var(--text-light);
            font-size: 14px;
        }

        /* CTA Section */
        .cta-section {
            padding: 100px 30px;
            background-color: var(--primary);
            color: white;
            text-align: center;
        }

        .cta-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .cta-section h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .cta-section p {
            font-size: 18px;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .cta-section .btn-primary {
            background-color: white;
            color: var(--primary);
        }

        .cta-section .btn-primary:hover {
            background-color: rgba(255, 255, 255, 0.9);
        }

        /* Footer */
        .footer {
            background-color: var(--primary-dark);
            color: white;
            padding: 60px 30px 30px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto 40px;
        }

        .footer-section h3 {
            font-size: 20px;
            margin-bottom: 20px;
            color: white;
        }

        .footer-section p {
            margin-bottom: 10px;
            opacity: 0.8;
            line-height: 1.6;
        }

        .footer-section i {
            margin-right: 10px;
            opacity: 0.6;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: white;
            opacity: 0.8;
            text-decoration: none;
            transition: opacity 0.2s;
        }

        .footer-links a:hover {
            opacity: 1;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            opacity: 0.6;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .hero-section {
                flex-direction: column;
                text-align: center;
                padding: 60px 20px;
            }

            .hero-content {
                max-width: 100%;
                padding-right: 0;
                margin-bottom: 40px;
            }

            .hero-content h1 {
                font-size: 36px;
            }
        }

        @media (max-width: 768px) {
            .features-grid,
            .testimonials-grid {
                grid-template-columns: 1fr;
            }

            .features-section,
            .testimonials-section,
            .cta-section {
                padding: 60px 20px;
            }

            .features-section h2,
            .testimonials-section h2,
            .cta-section h2 {
                font-size: 30px;
            }
        }

        @media (max-width: 576px) {
            .dashboard-header {
                padding: 15px;
            }

            .logo {
                font-size: 20px;
            }

            .hero-content h1 {
                font-size: 28px;
            }

            .hero-content p,
            .cta-section p {
                font-size: 16px;
            }

            .btn-large {
                padding: 12px 24px;
                font-size: 16px;
            }
        }
    </style>


</head>
<body>
    <div class="app-container">
        <!-- Header -->
        <header class="dashboard-header">
            <a href="index.html" class="logo">MediCare Clinic</a>
            <div class="header-actions">
                <a href="#contact" class="btn btn-outline">Contact Us</a>
                <a href="{{ url('/login') }}" class="btn btn-primary">Login</a>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content">
                <h1>Your Health, Our Priority</h1>
                <p>Experience personalized healthcare with our team of expert doctors. Schedule appointments, access medical records, and manage your health journey all in one place.</p>
                <a href="#get-started" class="btn btn-primary btn-large">
                    <i class="fas fa-arrow-right"></i>
                    Get Started
                </a>
            </div>
            {{-- <div class="hero-image">
                <img src="https://via.placeholder.com/600x400" alt="Doctor with patient">
            </div> --}}
        </section>

        <!-- Features Section -->
        <section class="features-section">
            <h2>Why Choose Us</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>Easy Appointment Scheduling</h3>
                    <p>Book and manage your appointments online with just a few clicks.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-file-medical"></i>
                    </div>
                    <h3>Digital Medical Records</h3>
                    <p>Access your complete medical history anytime, anywhere.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h3>Expert Doctors</h3>
                    <p>Our team of specialists provides the highest quality of care.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h3>Transparent Billing</h3>
                    <p>View and manage all your payments and insurance claims.</p>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="testimonials-section">
            <h2>What Our Patients Say</h2>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <p>"The online appointment system is so convenient. I can schedule my visits without having to make a phone call!"</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="avatar">
                            <div class="avatar-fallback">JD</div>
                        </div>
                        <div class="author-info">
                            <div class="author-name">John Doe</div>
                            <div class="author-title">Patient since 2020</div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <p>"Having all my medical records in one place has made managing my health so much easier. Highly recommend!"</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="avatar">
                            <div class="avatar-fallback">JS</div>
                        </div>
                        <div class="author-info">
                            <div class="author-name">Jane Smith</div>
                            <div class="author-title">Patient since 2019</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section" id="get-started">
            <div class="cta-content">
                <h2>Ready to Take Control of Your Health?</h2>
                <p>Join thousands of patients who have simplified their healthcare journey with MediCare Clinic.</p>
                <a href="#register" class="btn btn-primary btn-large">
                    Get Started Now
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer" id="contact">
            <div class="footer-content">
                <div class="footer-section">
                    <h3 class="logo">MediCare Clinic</h3>
                    <p>Your health, our priority. We provide comprehensive healthcare services with a patient-centered approach.</p>
                </div>
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Medical Drive, Healthcare City</p>
                    <p><i class="fas fa-phone"></i> (123) 456-7890</p>
                    <p><i class="fas fa-envelope"></i> info@medicareclinic.com</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#doctors">Our Doctors</a></li>
                        <li><a href="#login">Patient Login</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 MediCare Clinic. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>