<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>TastyBites</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Login
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=$this->Url->build(['controller'=> 'Product','action'=>'index'])  ?> ">Menu</a></li>

                <?php
                if (!$this->Identity->isLoggedIn()) {
                    echo $this->Html->link(
                        'Log in',
                        ['controller' => 'Product', 'action' => 'add'],
                        ['class' => 'button button-outline']);
                }
                ?>
                <?php

                echo $this->Html->link(
                    'Log out',
                    ['controller' => 'Auth', 'action' => 'logout'],
                    ['class' => 'button button-outline']);

                ?>






            </ul>
        </div>
    </div>
</nav>
<!-- Masthead-->
<!-- Masthead with semi-transparent overlay -->
<header class="masthead">
    <div class="container-fluid">
        <div class="masthead-overlay"></div> <!-- Overlay element -->
        <div class="text-center">
            <h2>Welcome To Our Kitchen!</h2>
            <h1>Tasty Bites</h1>
        </div>
    </div>
</header>





<!-- Services-->
<section class="page-section" id="services">
    <div class="text-center">
        <a class="btn btn-primary btn-xl text-uppercase" href="<?=$this->Url->build(['controller'=> 'Product','action'=>'index'])  ?>">Menu</a>
    </div>
    <div class="container">
        <div class="text-center">


            <h2 class="section-heading text-uppercase">Services</h2>

            <h3 class="section-subheading text-muted"></h3>
        </div>
        <div class="row text-center">
            <div class="col-md-4">
                                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-utensils fa-stack-1x fa-inverse"></i>
                        </span>
                <h4 class="my-3">Home Made Meals</h4>
                <p class="text-muted">Enjoy the warmth of home with TastyBites’ home-cooked meals. Prepared with fresh ingredients and traditional recipes, our meals deliver both taste and comfort directly to your table.</p>
            </div>
            <div class="col-md-4">
                                        <span class="fa-stack fa-4x">
                    <i class="fas fa-circle fa-stack-2x text-primary"></i>
                    <i class="fas fa-user-cog fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="my-3">Tailored Meals</h4>
                <p class="text-muted">Customize your dining experience with TastyBites’ tailored meals. Choose from options like low-carb, vegan, or gluten-free to meet your dietary needs with delicious, personalized meals.".</p>
            </div>
            <div class="col-md-4">
                        <span class="fa-stack fa-4x">
    <i class="fas fa-circle fa-stack-2x text-primary"></i>
    <i class="fas fa-seedling fa-stack-1x fa-inverse"></i>
</span>

                <h4 class="my-3">Seasonal Specials</h4>
                <p class="text-muted">Explore new flavors with TastyBites Seasonal Specials. Our menu changes with the seasons, offering you a unique culinary experience that highlights the freshest ingredients available. Try something new each season!</p>
            </div>
        </div>
    </div>
</section>
<!-- Portfolio Grid-->

<!-- About-->
<section class="page-section" id="about">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">About Us</h2>
            <br />
        </div>
        <ul class="timeline">
            <li>
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/icon2img.png" alt="..." /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>2020</h4>
                        <h4 class="subheading">Our Humble Beginnings</h4>
                    </div>
                    <div class="timeline-body"><p class="text-muted">Born in the midst of the 2020 global health crisis, Tasty Bites sprouted from the simple idea that everyone deserves the comfort of a home-cooked meal, regardless of life's circumstances. Our founder, inspired by the resilience of the human spirit and the communal love for food, saw an opportunity to serve joy and nutrition on a plate. What started as a small initiative to cater to the lock-down, quickly grew into a beacon of homemade, customizable meals that celebrate individual tastes and dietary needs.</p></div>
                </div>
            </li>


            <li class="timeline-inverted">
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/icon1img.png" alt="..." /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4></h4>
                        <h4 class="subheading">Crafting Your Meals, Your Way</h4>
                    </div>
                    <div class="timeline-body"><p class="text-muted">At Tasty Bites, we believe in the power of personal touch. Our menu is a canvas for your palate, where every dish is tailored to meet your unique preferences. With an emphasis on freshness and variety, our weekly meal offerings are more than just food; they're a testament to our dedication to quality and the bespoke experience.</p></div>
                </div>
            </li>
            <li class="timeline-inverted">
                <div class="timeline-image">
                    <h4>
                        Be Part
                        <br />
                        Of Our
                        <br />
                        Story!
                    </h4>
                </div>
            </li>
        </ul>
    </div>
</section>
<!-- Team-->



<!-- Footer-->
<footer class="footer py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-lg-start">Tasty Bites Kitchen &copy; 2024</div>
            <div class="col-lg-4 my-3 my-lg-0">
                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>

