<nav class="site-nav mb-5">
    <div class="pb-2 top-bar mb-3">
      <div class="container">
        <div class="row align-items-center">

          <div class="col-6 col-lg-9">
            <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> <span class="d-none d-lg-inline-block">Have a questions?</span></a> 
            <a href="#" class="small mr-3"><span class="icon-phone mr-2"></span> <span class="d-none d-lg-inline-block">10 20 123 456</span></a> 
            <a href="#" class="small mr-3"><span class="icon-envelope mr-2"></span> <span class="d-none d-lg-inline-block">info@mydomain.com</span></a> 
          </div>
          <?php
          if(!isset($_SESSION['volunteers_id'])){
            ?>
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
            <?php
          }
          ?>
          

        </div>
      </div>
    </div>
    <div class="sticky-nav js-sticky-header">
      <div class="container position-relative">
        <div class="site-navigation text-center">
          <a href="dashbourd.php" class="logo menu-absolute m-0"><img style="border-radius: 50%; width: 50px; height: 50px;" src="images/images.jpg" alt=""><span class="text-primary">.</span></a>

          <ul class="js-clone-nav d-none d-lg-inline-block site-menu">
            <li class="active"><a href="dashbourd.php">Home</a></li>
            <li><a href="..//login.php">Admin</a></li>
            <li class=""><a href="profiles.php">profile</a></li>
            <!-- <li class="has-children">
              <a href="#">Dropdown</a>
              <ul class="dropdown">
                <li><a href="elements.html">Elements</a></li>
                <li class="has-children">
                  <a href="#">Menu Two</a>
                  <ul class="dropdown">
                    <li><a href="#">Sub Menu One</a></li>
                    <li><a href="#">Sub Menu Two</a></li>
                    <li><a href="#">Sub Menu Three</a></li>
                  </ul>
                </li>
                <li><a href="#">Menu Three</a></li>
              </ul>
            </li>
            <li><a href="staff.html">Our Staff</a></li> -->
            <!-- <li><a href="#programs">programs</a></li> -->
            <!-- <li><a href="gallery.html">Gallery</a></li>  -->
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        <?php
         if(!isset($_SESSION['volunteers_id'])){
          ?>
          <a href="#programs" class="btn-book btn btn-secondary btn-sm menu-absolute">Apply Now</a>
          <?php
         }
         else{
          ?>
           <a href="signout.php" class="btn-book btn btn-secondary btn-sm menu-absolute">logout</a>
          <?php
         }
         ?>
          <a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light" data-toggle="collapse" data-target="#main-navbar">
            <span></span>
          </a>

        </div>
      </div>
    </div>
  </nav>