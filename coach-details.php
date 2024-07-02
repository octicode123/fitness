<?php
require_once "pdo.php";
if (isset($_GET["q"]) && !empty($_GET["q"])) {
    $coach_id = htmlspecialchars($_GET["q"]);
    $coach = $pdo->prepare("SELECT c.*,cp.* FROM coach_account as c 
                            INNER JOIN coach_price as cp ON c.coach_id=cp.coach_id 
                            WHERE  c.coach_id=:coach_id LIMIT 1");
    $coach->bindParam(':coach_id', $coach_id);
    $coach->execute();
    $coach_result = $coach->fetch();
    if (!$coach_result) {
        header('location:index.php');
    } else {
?>
        <!doctype html>
        <html class="no-js" lang="zxx">

        <head>
            <meta charset="utf-8">
            <meta http-equiv="x-ua-compatible" content="ie=edge">
            <title>AHM FITNESS</title>
            <meta name="description" content="">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="manifest" href="site.webmanifest">
            <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

            <!-- CSS here -->
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="assets/css/slicknav.css">
            <link rel="stylesheet" href="assets/css/flaticon.css">
            <link rel="stylesheet" href="assets/css/gijgo.css">
            <link rel="stylesheet" href="assets/css/animate.min.css">
            <link rel="stylesheet" href="assets/css/animated-headline.css">
            <link rel="stylesheet" href="assets/css/magnific-popup.css">
            <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="assets/css/themify-icons.css">
            <link rel="stylesheet" href="assets/css/slick.css">
            <link rel="stylesheet" href="assets/css/nice-select.css">
            <link rel="stylesheet" href="assets/css/style.css">
        </head>

        <body class="black-bg">
            <!-- ? Preloader Start -->
            <div id="preloader-active">
                <div class="preloader d-flex align-items-center justify-content-center">
                    <div class="preloader-inner position-relative">
                        <div class="preloader-circle"></div>
                        <div class="preloader-img pere-text">
                            <img src="assets/img/logo/loader.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Preloader Start -->
            <div id="header"></div>

            <main>
                <!--? Hero Start -->
                <div class="slider-area2">
                    <div class="slider-height2 d-flex align-items-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="hero-cap hero-cap2 pt-70">
                                        <h2>Coach details</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Hero End -->
                <!--? Team -->
                <section class="team-area pt-80">
                    <div class="container">
                        <div class="row">
                            <?php

                            if ($coach_result) {

                            ?>
                                <div class="col-lg-12 col-md-12">
                                    <div class="single-cat text-center mb-30 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                                        <div class="cat-icon">
                                            <img src="../fitness_img/coach/<?php echo $coach_result["picture"]; ?>" alt="">
                                        </div>
                                        <div class="cat-cap">
                                            <h5><a href="services.html"><?php echo $coach_result["full_name"]; ?></a></h5>
                                            <p><?php echo $coach_result["about_me"]; ?> </p>
                                            <h5><a href="services.html"><?php echo $coach_result["price"]; ?> MAD</a></h5>
                                            <div class="text-center ">
                                                <button  onclick="subscribe('<?php echo $coach_result['coach_id']; ?>')"  class="btn">Hire</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php

                            } else {
                                echo "<h1 class='text-center text-light'>Search result  : There is no coach for your selected domain</h1>";
                            }
                            ?>

                        </div>
                    </div>
                </section>


                <!-- Blog Area End -->
                <!--? video_start -->

                <!-- video_end -->
                <!-- ? services-area -->

            </main>
            <div id="footer"></div>

            <!-- Scroll Up -->
            <div id="back-top">
                <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
            </div>

            <!-- JS here -->

            <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
            <!-- Jquery, Popper, Bootstrap -->
            <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
            <script src="./assets/js/popper.min.js"></script>
            <script src="./assets/js/bootstrap.min.js"></script>
            <!-- Jquery Mobile Menu -->
            <script src="./assets/js/jquery.slicknav.min.js"></script>

            <!-- Jquery Slick , Owl-Carousel Plugins -->
            <script src="./assets/js/owl.carousel.min.js"></script>
            <script src="./assets/js/slick.min.js"></script>
            <!-- One Page, Animated-HeadLin -->
            <script src="./assets/js/wow.min.js"></script>
            <script src="./assets/js/animated.headline.js"></script>
            <script src="./assets/js/jquery.magnific-popup.js"></script>

            <!-- Date Picker -->
            <script src="./assets/js/gijgo.min.js"></script>
            <!-- Nice-select, sticky -->
            <script src="./assets/js/jquery.nice-select.min.js"></script>
            <script src="./assets/js/jquery.sticky.js"></script>

            <!-- counter , waypoint,Hover Direction -->
            <script src="./assets/js/jquery.counterup.min.js"></script>
            <script src="./assets/js/waypoints.min.js"></script>
            <script src="./assets/js/jquery.countdown.min.js"></script>
            <script src="./assets/js/hover-direction-snake.min.js"></script>

            <!-- contact js -->
            <script src="./assets/js/contact.js"></script>
            <script src="./assets/js/jquery.form.js"></script>
            <script src="./assets/js/jquery.validate.min.js"></script>
            <script src="./assets/js/mail-script.js"></script>
            <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

            <!-- Jquery Plugins, main Jquery -->
            <script src="./assets/js/plugins.js"></script>
            <script src="./assets/js/main.js"></script>
            <script src="./assets/js/sweet.js"></script>

            <!-- header & footer -->

            <script src="./assets/js/header-footer.js?v=1"></script>
        </body>

        </html>
        <script>



    function subscribe(coach_id){
        if(coach_id!=null){

            var formData = new FormData();
    formData.append('ero', 'checkout');
    formData.append('coach_id', coach_id);


    fetch('./backend/checkout.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'Success') {
            swal("Good Job", data.message, "success");
            setTimeout(function() {
                window.location.href = 'user/account/login.php';
            }, 2000); 
        } else if (data.status === 'Error') {
            swal("Opps!", data.message, "warning");
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });

        }else{
            swal("error");
        }
    }
        </script>
<?php
    }
} else {
    header('location:index.php');
}
?>