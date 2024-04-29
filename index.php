<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HomeNest</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    </head>
    <body>
        <header id="header">
            <h1>HomeNest</h1>
            <nav>
                <ul>
                    <li><a href="#login-popup"><i
                                class="fas fa-sign-in-alt"></i> Log
                            In</a></li>
                    <li><a href="#signup-popup"><i class="fas fa-user-plus"></i>
                            Sign
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
                <?php include("login1.php"); ?>
            </div>
        </div>

        <div id="signup-popup" class="popup">
            <div class="popup-content">
                <a href="#" class="close-btn">&times;</a>
                <?php include("signup.php"); ?>
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
                <p>HomeNest serves as a comprehensive platform that connects
                    property buyers and sellers. It simplifies the process of
                    real estate <br>transactions by providing a single platform
                    where users can easily access information, register
                    properties,<br> and engage in buying or selling activities.</p>
            </div>
        </section>

        <section id="our-services">
            <div class="hovering">
                <h2>Our Services</h2>
                <p>The services include user registration for buyers, sellers,
                    and an administrative function for business analytics. The
                    platform offers<br> detailed property listings, the ability to
                    add new properties, and functionalities like wishlisting for
                    buyers. It also<br> features robust search and filtering
                    capabilities to help users find <br>properties that meet their
                    specific criteria.</p>
            </div>
        </section>

        <section id="competition">
            <div class="hovering">
                <h2>Choose Us Over the Competition</h2>
                <p>HomeNest stands out due to its user-friendly design,
                    comprehensive property listings, and advanced features like
                    credit card type<br> detection during payments. The use of SCRUM
                    methodology ensures that the platform is developed with high
                    standards and <br>agility, allowing for quick updates and
                    feature integrations based on user <br>feedback and market
                    demands.</p>
            </div>
        </section>

        <section id="commitment">
            <div class="hovering">
                <h2>Our Commitment to Customers</h2>
                <p>The platform attracts customers by offering a seamless and
                    intuitive user experience, highlighted by features such as
                    easy navigation,<br> logical site structure, and attractive
                    design elements. HomeNest also emphasizes security with
                    encrypted <br>password storage and secure transaction processes.
                    The company engages with potential <br>users through innovative
                    marketing strategies and by showcasing the <br>effectiveness of
                    the platform through detailed demos and a <br>strong online
                    presence.
                </p>
            </div>
        </section>

        <footer id="footer">
            <p>Copyright © 2024. All rights reserved.</p>
        </footer>

        <script src="index.js"></script>
    </body>
</html>
