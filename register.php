<!-- /*
* Template Name: Learner
* Template Author: Untree.co
* Tempalte URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->

<style>

  #show{
    width: 150px;
    height: 150px;
    border: solid 1px #744547;
    border-radius: 50%;
    object-fit: cover;
    margin-top: 20px;
  }
  /* #show{
        width: 150px;
        height: 150px;
        border: 1px solid #744547;
        border-radius: 50% ;
        object-fit: cover;
    } */

</style>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

  <link href="https://fonts.googleapis.com/css2?family=Display+Playfair:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">


  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

  <link rel="stylesheet" href="Website/css/bootstrap.min.css">
  <link rel="stylesheet" href="Websitecss/animate.min.css">
  <link rel="stylesheet" href="Websitecss/owl.carousel.min.css">
  <link rel="stylesheet" href="Websitecss/owl.theme.default.min.css">
  <link rel="stylesheet" href="Websitecss/jquery.fancybox.min.css">
  <link rel="stylesheet" href="Website/fonts/icomoon/style.css">
  <link rel="stylesheet" href="Website/fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="Website/css/aos.css">
  <link rel="stylesheet" href="Website/css/style.css">

  <title>Learner Free Bootstrap Template by Untree.co</title>
</head>

<body>

  <div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close">
        <span class="icofont-close js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>


  
  <nav class="site-nav mb-5">
    <div class="pb-2 top-bar mb-3">
      <div class="container">
        <div class="row align-items-center">

          <div class="col-6 col-lg-9">
            <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> <span class="d-none d-lg-inline-block">Have a questions?</span></a> 
            <a href="#" class="small mr-3"><span class="icon-phone mr-2"></span> <span class="d-none d-lg-inline-block">10 20 123 456</span></a> 
            <a href="#" class="small mr-3"><span class="icon-envelope mr-2"></span> <span class="d-none d-lg-inline-block">info@mydomain.com</span></a> 
          </div>

          <div class="col-6 col-lg-3 text-right">
            <a href="..//signin.php" class="small mr-3">
              <span class="icon-lock"></span>
              Log In
            </a>
            <a href="..//register.php" class="small">
              <span class="icon-person"></span>
              Register
            </a>
          </div>

        </div>
      </div>
    </div>
    <div class="sticky-nav js-sticky-header">
      <div class="container position-relative">
        <div class="site-navigation text-center">
          <a href="dashbourd.php" class="logo menu-absolute m-0"><img style="border-radius: 50%; width: 50px; height: 50px;" src="../aploads/VOL006.png" alt=""><span class="text-primary">.</span></a>

          <ul class="js-clone-nav d-none d-lg-inline-block site-menu">
            <li><a href="dashbourd.php">Home</a></li>
      
            <li><a href="about.html">About</a></li>
            <li class="active"><a href="contact.html">Contact</a></li>
          </ul>

          <a href="#" class="btn-book btn btn-secondary btn-sm menu-absolute">Enroll Now</a>

          <a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light" data-toggle="collapse" data-target="#main-navbar">
            <span></span>
          </a>

        </div>
      </div>
    </div>
  </nav>
  

  <div class="untree_co-hero inner-page overlay" style="background-image: url('images/img-school-5-min.jpg');">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-12">
          <div class="row justify-content-center ">
            <div class="col-lg-6 text-center ">
              <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Register</h1>

            </div>
          </div>
        </div>
      </div> <!-- /.row -->
    </div> <!-- /.container -->

  </div> <!-- /.untree_co-hero -->




  <div class="untree_co-section">
    <div class="container">

      <div class="row mb-5 justify-content-center">
        <div class="col-lg-10 mx-auto order-1" data-aos="fade-up" data-aos-delay="500">
          <form class="form-box" id="employeeform">
            <input type="hidden" name="update_id" id="update_id">
            <div class="row">

            <div class="col-sm-12">
            <div class="alert alert-success d-none" role="alert">
            This is a success alert—check it out!
            </div>
            <div class="alert alert-danger d-none" role="alert">
            This is a danger alert—check it out!
            </div>
            </div>

            
              <div class="col-12 mb-3">
              <label for="">fullname</label>

                <input type="text" class="form-control" name="fullname" id="fullname"  placeholder="Full name">
              </div>

              <div class="col-6 mb-3">
              <label for="">email</label>
                <input type="text" class="form-control" name="email" id="email"  placeholder="Email">
              </div>

              <div class="col-6 mb-3">
              <label for="">password</label>
                <input type="password" class="form-control" name="password" id="password"  placeholder="password">
              </div>


              <div class="col-6 mb-3">
              <div class="form-group">
                <label for="">sex</label>

                <select name="sex" id="sex" class="form-control" >
                <option disabled selected value>Select sex</option>
                <!-- <option value="">select sex</option> -->
                <option value="male">male</option>
                <option value="female">female</option>
               
                </select>
                </div>             
               </div>
              
              <div class="col-6 mb-3">
              <div class="form-group">
                <label for="">phone</label>

                <input type="number" name="phone" id="phone" class="form-control" placeholder="phone" >
                </div>
              </div>

              <div class="col-6 mb-3">
              <div class="form-group">
                <label for="">age</label>
                <input type="text" name="age" id="age" class="form-control" placeholder="age" >
                </div>
                </div>

              <div class="col-6 mb-3 d-none" id="statas">
              <div class="form-group">
                <label for="">Status</label>
                <input type="text" name="status" id="status" class="form-control" placeholder="status" value="0">
                </div>
                </div>

              <div class="col-6 mb-3">
              <div class="form-group">
                <label for="">education</label>

                <select name="education" id="education" class="form-control" >
                <option disabled selected value>Select education level</option>
                <!-- <option value="secondery">select education level</option> -->
                <option value="secondery">secondery</option>
                <option value="primery">primery</option>
                <option value="university">university</option>
                </select>
                </div>              </div>

              <div class="col-6 mb-3">
              <div class="form-group">
                <label for="">branch</label>

                <select name="branch_id" id="branch_id" class="form-control">
                <option disabled selected value>Select branch</option>
                <!-- <option value="0">select branch</option> -->
                </select>
                </div>              </div>


          
              <div class="col-6 mb-3">

              <div class="form-group">
                <label for="">method</label>
                <select name="method" id="method" class="form-control">
                <option disabled selected value>who registed?</option>
                <option value="by_user">by user</option>
                <option value="by_self">by self</option>
                </select>
                </div>
            
              </div>
          
              <div class="col-12 mb-3">

              <div class="form-group">
                <label for="">image</label>
                <input type="file" name="image" id="image" class="form-control" required>
                </div>
              </div>
              </div>


              <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-6">
                <div class="form-group">
                <img id="show">
                </div>
            </div>
        </div>
            
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit"  name="insert" class="btn btn-primary">Save Info</button>
      </div>


<!-- 
      <div class="col-sm-12">
                                    <div class="alert alert-success d-none" role="alert">
            This is a success alert—check it out!
            </div>
            <div class="alert alert-danger d-none" role="alert">
            This is a danger alert—check it out!
            </div>
                        </div> -->
            </div>
          </form>
        </div>
      </div>

      
    </div>
  </div> <!-- /.untree_co-section -->

  <div class="site-footer">


    <div class="container">

      <div class="row">
        <div class="col-lg-3 mr-auto">
          <div class="widget">
            <h3>About Us<span class="text-primary">.</span> </h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div> <!-- /.widget -->
          <div class="widget">
            <h3>Connect</h3>
            <ul class="list-unstyled social">
              <li><a href="#"><span class="icon-instagram"></span></a></li>
              <li><a href="#"><span class="icon-twitter"></span></a></li>
              <li><a href="#"><span class="icon-facebook"></span></a></li>
              <li><a href="#"><span class="icon-linkedin"></span></a></li>
              <li><a href="#"><span class="icon-pinterest"></span></a></li>
              <li><a href="#"><span class="icon-dribbble"></span></a></li>
            </ul>
          </div> <!-- /.widget -->
        </div> <!-- /.col-lg-3 -->

        <div class="col-lg-2 ml-auto">
          <div class="widget">
            <h3>Programs</h3>
            <ul class="list-unstyled float-left links">
              <li><a href="#">fast Aid</a></li>
              <li><a href="#">Nutrition</a></li>
              <li><a href="#">Humanatarian</a></li>
              <li><a href="#">Vacceine</a></li>
            </ul>
          </div> <!-- /.widget -->
        </div> <!-- /.col-lg-3 -->

      

        <div class="col-lg-3">
          <div class="widget">
            <h3>Contact</h3>
            <address>43 Raymouth Rd. Baltemoer, London 3910</address>
            <ul class="list-unstyled links mb-4">
              <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
              <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
              <li><a href="mailto:info@mydomain.com">info@mydomain.com</a></li>
            </ul>
          </div> <!-- /.widget -->
        </div> <!-- /.col-lg-3 -->

      </div> <!-- /.row -->

      <div class="row mt-5">
        <div class="col-12 text-center">
          <p class="copyright">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a>  Distributed By <a href="https://bishacas.com">Bishacas</a> <!-- License information: https://untree.co/license/ -->
          </div>
        </div>
      </div> <!-- /.container -->
    </div> <!-- /.site-footer -->

    <div id="overlayer"></div>
    <div class="loader">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <script src="Website/js/jquery-3.4.1.min.js"></script>
    <script src="Website/js/popper.min.js"></script>
    <script src="Website/js/bootstrap.min.js"></script>
    <script src="Website/js/owl.carousel.min.js"></script>
    <script src="Website/js/jquery.animateNumber.min.js"></script>
    <script src="Website/js/jquery.waypoints.min.js"></script>
    <script src="Website/js/jquery.fancybox.min.js"></script>
    <script src="Website/js/jquery.sticky.js"></script>
    <script src="Website/js/aos.js"></script>
    <script src="Website/js/custom.js"></script>

  </body>

  </html>

  <?php
include 'include/footer.php';

?>
