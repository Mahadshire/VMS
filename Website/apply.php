<?php
session_start();
require('../config/conn.php');
?>

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

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/style.css">
  <style>

  </style>
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


  
  <?php
  require('includes/header.php');
  ?>
  

  <div class="untree_co-hero inner-page overlay" style="background-image: url('images/img-school-5-min.jpg');">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-12">
          <div class="row justify-content-center ">
            <div class="col-lg-6 text-center ">
              <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Applay</h1>

            </div>
          </div>
        </div>
      </div> <!-- /.row -->
    </div> <!-- /.container -->

  </div> <!-- /.untree_co-hero -->



  <?php
  function signin($conn, $email, $password){
    
    $data = array();
    $array_data = array();
   $query ="CALL signin_sp('$email', '$password')";
    $result = $conn->query($query);


    if($result){
        $row = $result->fetch_assoc();

        if(isset($row['Msg'])){

     if($row['Msg'] == 'Deny'){
        $data = array("status" => false, "data" => "Email or password are incorrect");

     }else{
        $data = array("status" => false, "data" => "User Locked By The Admin");

     }


        }else{
            forEach($row as $key => $value){

                $_SESSION[$key] = $value;

            }
            $data = array("status" => true, "data" => "success");
            

        }

    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}
   if(!isset($_SESSION['volunteers_id'])){
    ?>

  <div class="untree_co-section">
    <div class="container">

      <div class="row mb-5 justify-content-center">
        <div class="col-lg-5 mx-auto order-1" data-aos="fade-up" data-aos-delay="200">
          <form action="#" class="form-box">
            <div class="row">
              <div class="col-12 mb-3">
                <!-- <input type="hidden" class="form-control" placeholder="Email"> -->
              </div>
              <div class="col-12 mb-3">
                <!-- <input type="hidden" class="form-control" placeholder="Email"> -->
              </div>
              <div class="col-12 mb-3">
                <!-- <input type="hidden" class="form-control" placeholder="Email"> -->
              </div>
              <div class="col-12 mb-3">
                <input type="text" class="form-control" placeholder="Email">
              </div>
              <div class="col-12 mb-3">
                <input type="password" class="form-control" placeholder="Password">
              </div>

              <div class="col-12 mb-3">
                <label class="control control--checkbox">
                  <span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked" />
                  <div class="control__indicator"></div>
                </label>
              </div>

              <div class="col-12">
                <input type="submit" value="Send Message" class="btn btn-primary">
              </div>
            </div>
          </form>
        </div>
      </div>

      
    </div>
  </div>
  <?php
   }
   else{
    ?>
   <div class="container m-auto">
    <div class="row"></div>
    <div class="row mb-5">
      <div class="col-lg-3"></div>
      <div class="col-lg-6  order-1"data-aos="fade-up" data-aos-delay="200">

      <form id="applayform"class="m-4">
        <input type="hidden" name="update_id" id="update_id">
        <div class="row">
           
            <div class="col-sm-12">
                <div class="form-group">
                <label for="">program</label>

                <input type="hidden" name="program_id" id="program_id" value="<?=$_GET['program_id'];?>"  class="form-control" required>

                <input type="text" name="program" readonly value="<?=$_GET['program'];?>" class="form-control" required>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                <label for="">volunteer</label>

                <input type="hidden" name="volunteers_id"  value="<?=$_SESSION['volunteers_id'];?>" class="form-control" required>

                <input type="text" readonly value="<?=$_SESSION['fullname'];?>" class="form-control" required>
                </div>
                <div class="row">
      <div class="col-sm-12">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit"  name="insert" class="btn btn-primary">Save Info</button>
      </div>
      </div>
     </div>
            </div>
        </div>
       
      </div>
      
    
     </form>
     <?php
     if (isset($_GET['insert'])) {
      extract($_GET);
      $data = array();
      $query = "INSERT INTO applay (program_id,volunteers_id) values('$program_id', '$volunteers_id')";
  
      $result = $conn->query($query);
  
      if($result){
         
              $data = array("status" => true, "data" => "successfully Registered");
  
      }else{
          $data = array("status" => false, "data"=> $conn->error);
               
      }
  
      echo json_encode($data);
     }
     ?>
        
      </div>
    </div>
   </div>
    <?php
   }
   ?>
  <!-- /.untree_co-section -->

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
          <p class="copyright">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a>  Distributed By <a href="https://bishacas.com">bishacas</a> <!-- License information: https://untree.co/license/ -->
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

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/custom.js"></script>

  </body>

  </html>
