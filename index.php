<?php

session_start();
if (isset($_SESSION['userId'])) {
  if ((time() - $_SESSION['time']) > 1800) {
    header("Location: includes/logout.inc.php");
  }
}

?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Trackinus Health</title>
  <link rel="shortcut icon" type="image/png" href="img/favicon.png">
  <meta name="description" content="" />
  <meta content="" name="description" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta content="width=device-width" name="viewport" />
  <meta content="IE=edge" http-equiv="X-UA-Compatible" />
  <link rel="manifest" href="site.webmanifest" />
  <link rel="apple-touch-icon" href="icon.png" />
  <link rel="stylesheet" href="bootstrapIndex/styles/css/style.css" />
</head>

<body>
  <main class="main">
    <nav class="navbar fixed-top navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="img/navbar-logo.png" alt="logo" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="ti-menu"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <?php
            if (isset($_SESSION['userId'])) {

              echo '<li><a class="nav-link active" href="#about">how it works</a></li>
                    <li><a class="nav-link" href="#features">features</a></li>
                    <li><a class="nav-link" href="#team">our users</a></li>
                    <li><a class="nav-link" href="#faq">faq</a></li>
                    <li><a class="nav-link" href="dashboard.php">dashboard</a></li>
                    <li><a class="nav-link" href="includes/logout.inc.php">logout</a></li>';
            } else {

              echo '<li><a class="nav-link active" href="#about">how it works</a></li>
                      <li><a class="nav-link" href="#features">features</a></li>
                      <li><a class="nav-link" href="#team">our users</a></li>
                      <li><a class="nav-link" href="#faq">faq</a></li>
                      <li><a class="nav-link" href="login.php">login</a></li>
                      <li><a class="nav-link" href="register.php">join now</a></li>';
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>

    <section class="home__hero">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-7  home__hero-image-section">
            <img class="home__hero-img wow fadeInLeft" src="img/iPhoneXs.png" width="400" />
            <img class="home__hero-bg wow fadeInRight" src="img/bg.png" width="800" />
          </div>
          <div class="col-12 col-md-5  home__hero-text-section  align-self-end wow fadeInUp" data-wow-delay="0.2s">
            <h1>keep on track of your body</h1>
            <p class="mt-4 mb-4">
              Take control of tracking your own lifestyle and health.
              With Trackinus Health you can keep on track of health issues or catch them before they develop.
            </p>
            <button class="btn btn-secondary btn-lg" onclick="window.location.href='register.php'">Join Today</button>
          </div>
        </div>
      </div>
    </section>

    <section class="how-it-works" id="about">
      <div class="container">
        <div class="row">
          <!-- SINGLE ITEM -->
          <div data-wow-delay="0.6s" class="wow fadeInRight how-it-works__item col-12 col-md-6 col-lg-3 mb-3">
            <div class="how-it-works__item-bg d-flex flex-column align-items-center text-center">
              <span class="how-it-works__item-number">1</span>
              <i class="ti-mobile"> </i>
              <h4 class="mt-4 mb-4">Ease of access</h4>

              <p>
                Check what's going on inside your body from home and on the go with your mobile
              </p>
            </div>
          </div>
          <!-- / SINGLE ITEM -->
          <!-- SINGLE ITEM -->
          <div data-wow-delay="0.4s" class="wow fadeInRight how-it-works__item col-12 col-md-6 col-lg-3 mb-3">
            <div class="how-it-works__item-bg d-flex flex-column align-items-center text-center">
              <span class="how-it-works__item-number">2</span>
              <i class="ti-cloud-up"> </i>
              <h4 class="mt-4 mb-4">Backlog</h4>
              <p>
                Why search around the house for your results, we store every result to
                date all in one database
              </p>
            </div>
          </div>
          <!-- / SINGLE ITEM -->
          <!-- SINGLE ITEM -->
          <div data-wow-delay="0.2s" class="wow fadeInRight how-it-works__item col-12 col-md-6 col-lg-3 mb-3">
            <div data-wow-delay="0.4s" class="how-it-works__item-bg d-flex flex-column align-items-center text-center">
              <span class="how-it-works__item-number">3</span>
              <i class="ti-pulse"> </i>
              <h4 class="mt-4 mb-4">Register and go</h4>

              <p>
                Once registered simply input your results from your local GP
                and we'll take care of the rest
              </p>
            </div>
          </div>
          <!-- / SINGLE ITEM -->
          <!-- SINGLE ITEM -->
          <div class="wow fadeInRight how-it-works__item col-12 col-md-6 col-lg-3 mb-3">
            <div class="how-it-works__item-bg d-flex flex-column align-items-center text-center">
              <span class="how-it-works__item-number">4</span>
              <i class="ti-bar-chart"> </i>
              <h4 class="mt-4 mb-4">Visualize</h4>

              <p>
                Easily see if your results are within range through our
                graphical representation
              </p>
            </div>
          </div>
          <!-- / SINGLE ITEM -->
        </div>
      </div>
    </section>

    <section class="features" id="features">
      <img src="img/bg.png" class="features__logo wow fadeInLeft" alt="background element" />
      <div class="container">
        <div class="row features__item">
          <div class=" wow fadeInRight col-lg-4 col-md-8 col-sm-12 d-flex flex-column align-self-center">
            <span class="info-text">Why us?</span>
            <h3 class="mt-4 mb-4">Stay on track <br />with regular testing</h3>
            <p>
              With our web based application you can paint
              an accurate picture of lifestyle and track any
              changes your body makes. See what makes you tick
              on the inside, check if your body is within a
              healthy range.<br />

              With our app you will never lose track of your body again.
            </p>
            <ul class="features__item-list">
              <li>
                <i class="ti-file"> </i>
                <h4>Receive result</h4>
              </li>
              <li>
                <i class="ti-import"> </i>

                <h4>Input result</h4>
              </li>
              <li>
                <i class="ti-face-smile"></i>
                <h4>Stay healthy</h4>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section class="lead-form">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-5  wow fadeIn" data-wow-delay="0.3s">
            <h2 class="text-center">request a demo</h2>
            <p class="text-center info-text text-dark">
              why not try for yourself
            </p>
          </div>

          <div class="col-12 col-md-8 offset-md-2">
            <!-- CONTACT FORM -->

            <form class=" wow fadeInLeft">
              <div class="form-group">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required />
              </div>

              <div class="form-group">
                <input type="text" class="form-control" id="contact-email" name="contact-email" placeholder="Email" required />
              </div>

              <div class="form-group">
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" required />
              </div>

              <div class="form-group">
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Organization name" required />
              </div>
              <button type="button" class="btn btn-secondary">Submit</button>
            </form>
          </div>
        </div>
      </div>
      <img class="lead-form__bg wow fadeInRight" src="img/bg.png" />
    </section>

    <section class="team" id="team">
      <div class="container">
        <row>
          <div class="col-md-12 mb-5 mt-5  wow fadeIn" data-wow-delay="0.3s">
            <h2 class="text-center">What our users say</h2>
            <p class="text-center info-text text-dark">
              tell us what you think
            </p>
          </div>
        </row>

        <div class="row">
          <!-- SINGLE ITEM -->
          <div class="col-12 col-md-4">
            <div class="text-center team__item">
              <img class="u-box-shadow-lg img-fluid img-thumbnail rounded-circle mb-4" src="img/user-01.jpg" width="180" />
              <h4>Brandi Love</h4>
              <span class="team__item-role mb-4">Mother of 3</span>
              <p class="pb-32">
                I wasn't aware how high my cholesterol was until
                I used Trackinus Health. After the results I made a
                doctors appointment and now im back on track.
                <br /><br />
                Trackinus has helped me to increase my wellbeing
                and more time to raise my kids.
                <br /><br />
              </p>
              <div class="team__item-contact row mt-4">
                <button class="btn btn-link btn-block  btn-lg col-6" data-toggle="tooltip" data-original-title="share this">
                  <span class="ti-sharethis"></span>
                </button>
                <button class="btn btn-link btn-lg btn-block col-6" data-toggle="tooltip" data-placement="top" data-original-title="linkedin">
                  <span class="ti-linkedin"></span>
                </button>
              </div>
            </div>
          </div>
          <!-- / SINGLE ITEM -->

          <!-- SINGLE ITEM -->
          <div class="col-12 col-md-4">
            <div class="text-center team__item">
              <img class="u-box-shadow-lg img-fluid img-thumbnail rounded-circle mb-4" src="img/user-02.jpg" width="180" />
              <h4>Houston Jones</h4>
              <span class="team__item-role mb-4">Personal Trainer</span>
              <p class="pb-32">
                I've been using Trackinus Health for a little
                over six months now, and I'll never go back! It
                helps me track my healthy lifestyle hassle free.
                <br /><br />
                I recommend Trackinus Health to all my clients.
                <br /><br /><br /><br />
              </p>
              <div class="team__item-contact row mt-4">
                <button class="btn btn-link btn-block  btn-lg col-6" data-toggle="tooltip" data-original-title="share this">
                  <span class="ti-sharethis"></span>
                </button>
                <button class="btn btn-link btn-lg btn-block col-6" data-toggle="tooltip" data-placement="top" data-original-title="linkedin">
                  <span class="ti-linkedin"></span>
                </button>
              </div>
            </div>
          </div>
          <!-- / SINGLE ITEM -->
          <!-- SINGLE ITEM -->
          <div class="col-12 col-md-4">
            <div class="text-center team__item">
              <img class="u-box-shadow-lg img-fluid img-thumbnail rounded-circle mb-4" src="img/user-03.jpg" width="180" />
              <h4>Becky Lynch</h4>
              <span class="team__item-role mb-4">GP</span>
              <p class="pb-32">
                As a practicing Doctor, I would highly
                recommend all patients keep track of their health
                in some shape or form. Apps like Trackinus
                are so easy for the user, there's really no
                excuse why you can't track your own health.
                I tell all my patients about Trackinus Health.
                <br /><br /><br />
              </p>
              <div class="team__item-contact row mt-4">
                <button class="btn btn-link btn-block  btn-lg col-6" data-toggle="tooltip" data-original-title="share this">
                  <span class="ti-sharethis"></span>
                </button>
                <button class="btn btn-link btn-lg btn-block col-6" data-toggle="tooltip" data-placement="top" data-original-title="linkedin">
                  <span class="ti-linkedin"></span>
                </button>
              </div>
            </div>
          </div>
          <!-- / SINGLE ITEM -->
        </div>
      </div>
    </section>

    <section id="faq" class="faq">
      <div class="container">
        <row>
          <div class="col-md-12 mb-5  wow fadeIn" data-wow-delay="0.3s">
            <h2 class="text-center">frequently asked questions</h2>
            <p class="text-center info-text">Contact us for with more questions</p>
          </div>
        </row>
        <div class="row">
          <div class="col-12">
            <div class="accordion" id="accordionExample">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="pl-0 btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Where can I currently use Trackinus?
                    </button>
                  </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card-body">
                    Currently Trackinus Health is only a UK based business, as we
                    are only a start up company. In the years to come we intend
                    on breaking into the European Market after a deal is made for
                    Brexit.
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingTwo">
                  <h5 class="mb-0">
                    <button class="pl-0 btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      What age group is Trackinus catered for?
                    </button>
                  </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                    Trackinus Health hasn't got a catered audience of a
                    specific age group. The app is for anyone who wishes to
                    track their own body, due to long term illness(es) or
                    simply by life style choice. For any persons under the age of
                    16, an adult will have to register on your behalf.
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingThree">
                  <h5 class="mb-0">
                    <button class="pl-0 btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Are there any up-front costs?
                    </button>
                  </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                  <div class="card-body">
                    We here at Trackinus Health believe it is wrong to
                    put a price on your health. Unlike other companies we
                    do not offer subscription packages or up front costs. Our
                    users get access to our complete service absolutely FREE!
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingFour">
                  <h5 class="mb-0">
                    <button class="pl-0 btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                      Do I have to use my real name on Trackinus?
                    </button>
                  </h5>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                  <div class="card-body">
                    As our application runs solely of you, the user
                    it is not required to enter your real name. We do
                    not use your data with any government service.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <footer class="footer">
        <img class="footer__image" src="img/bg.png" alt="image background" />
        <div class="container">
          <div class="row">
            <div class="col-12 text-center mb-5">
              <img src="img/logo-white.png" width="200" alt="trackinus sign" />
            </div>
            <div class="col-12">
              <ul class="footer__social d-flex justify-content-center">
                <li>
                  <a href="https://en-gb.facebook.com/ulsteruniversity/"><span class="ti-facebook"></span></a>
                </li>
                <li>
                  <a href="https://twitter.com/ulsteruni?lang=en"><span class="ti-twitter"></span></a>
                </li>
                <li>
                  <a href="https://www.instagram.com/adamcherry.photography/?hl=en"><span class="ti-instagram"></span></a>
                </li>
                <li>
                  <a href="https://www.youtube.com/user/StudyAtUlster"><span class="ti-youtube"></span></a>
                </li>
                <li>
                  <a href="https://www.flickr.com/photos/universityofulster"><span class="ti-flickr"></span></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6 mb-5">
              <h5 class="mb-4">Some links</h5>
              <ul>
                <li><a href="#"> Terms and Conditions</a></li>
                <li><a href="#"> Privacy Policy</a></li>
                <li><a href="#"> Customer Terms </a></li>
                <li><a href="#"> Health Hub </a></li>
                <li><a href="#"> Blog</a></li>
                <li><a href="#"> Testimonials</a></li>
                <li><a href="#"> In the Press </a></li>
              </ul>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-6 mb-5">
              <div class="row">
                <div class="col-12 ">
                  <h5 class="mb-4">Support is available</h5>
                  <p class="contact-small-text">
                    <span class="ti-alarm-clock"></span> Mon - Tue
                    <span class="float-right"> 6:00 Am - 10:00 Pm</span>
                  </p>
                  <p class="contact-small-text">
                    <span class="ti-alarm-clock"></span> Wed - Thu
                    <span class="float-right"> 5:30 Am - 10:00 Pm</span>
                  </p>
                  <p class="contact-small-text">
                    <span class="ti-alarm-clock"></span> Fri - Sun
                    <span class="float-right"> 12:00 Pm - 6:00 Pm </span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </section>
  </main>


  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="bootstrapIndex/js/wow.js"></script>
  <script src="bootstrapIndex/js/main.js"></script>

  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function() {
      ga.q.push(arguments);
    };
    ga.q = [];
    ga.l = +new Date();
    ga("create", "UA-133162462-1", "auto");
    ga("send", "pageview");
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>

</html>