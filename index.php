<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HomeNest</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    </head>
    <body>
        <header id="header">
            <h1>HomeNest</h1>
            <nav>
                <ul>
                    <li><a href="#login-popup"><i class="fas fa-sign-in-alt"></i> Log
                            In</a></li>
                    <li><a href="#signup-popup"><i class="fas fa-user-plus"></i> Sign
                            Up</a></li>
                </ul>
            </nav>
        </header>

        <div id="login-popup" class="popup">
            <div class="popup-content">
                <a href="#" class="close-btn">&times;</a>
                <?php include("login.php"); ?>
            </div>
        </div>

        <div id="login1-popup" class="popup">
            <div class="popup-content">
                <a href="#" class="close-btn">&times;</a>
                <h2 style="color: red;">ACCOUNT SUCCESSFULLY CREATED</h2>
                <?php include("login.php"); ?>
            </div>
        </div>

        <div id="signup-popup" class="popup">
            <div class="popup-content">
                <a href="#" class="close-btn">&times;</a>
                <?php include_once("signup.php"); ?>
            </div>
        </div>
        

        <!-- Sections -->
        <section id="hero">
            <div class="hero-content">
                <h2>Welcome to Our World!</h2>
                <p>Empowering Your Journey to a Better Home Experience</p>
                <a href="#what-we-do" class="btn">Learn More</a>
            </div>
        </section>

        <section id="what-we-do">
            <div class="hovering">
                <h2>What We Do</h2>
                <p>HomeNest simplifies the real estate process by providing a
                    user-friendly platform that connects buyers and sellers
                    directly. <br>We leverage cutting-edge technology to provide
                    fast,
                    efficient, and secure transactions.</p>
            </div>
        </section>

        <section id="our-services">
            <div class="hovering">
                <h2>Our Services</h2>
                <p>From detailed property listings with high-quality photos and
                    virtual tours to customized property management tools and
                    real-time <br>analytics, HomeNest offers everything needed
                    to
                    make
                    informed real estate decisions.</p>
            </div>
        </section>

        <section id="competition">
            <div class="hovering">
                <h2>Choose Us Over the Competition</h2>
                <p>Unlike our competitors, HomeNest prioritizes your needs by
                    offering lower fees, higher visibility for listings, and
                    personalized <br>customer support designed to help you
                    succeed
                    whether you're buying, selling, or managing properties.</p>
            </div>
        </section>

        <section id="commitment">
            <div class="hovering">
                <h2>Our Commitment to Customers</h2>
                <p>To attract and retain customers, we focus on continuous
                    improvement of our services based on user feedback, provide
                    educational <br>resources to help customers navigate the
                    market,
                    and
                    run regular promotions that make our premium features
                    accessible
                    <br>to a broader audience.</p>
            </div>
        </section>

        <footer id="footer">
            <p>Copyright © 2024. All rights reserved.</p>
        </footer>
        <script src="index.js"></script>
    </body>
</html>
