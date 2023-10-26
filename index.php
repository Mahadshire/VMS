<?php
session_start();
// include 'config/conn.php';
// $id = $_SESSION['id'];

if (!isset($_SESSION['username'])) {
  header('Location:login.php');
  
  die();
}

?>


<?php
include 'include/header.php';


?>
<!-- ======= Header ======= -->
<?php
include 'include/nav.php';
?>
<!-- End Header -->

<!-- ======= Sidebar ======= -->
<?php

include 'include/sidebar.php';

?>
<!-- End Sidebar-->

<main id="main" class="main">
  <div class="pagetitle">
    <h5>Dashboard</h5>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">
          <!-- Sales Card -->
          <div class="col-xxl-3 col-md-6">
            <div class="card info-card sales-card bg-warning">

             
              <div class="card-body">
                <h5 class="card-title text-light">Total Users <span></span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people-fill"></i>
                  </div>
                  <div class="ps-3 text-light" id="users">
                    <h6>145</h6>
                    <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

            </div>
          </div>


          <!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-3 col-md-6">
            <div class="card info-card revenue-card bg-primary">

             

              <div class="card-body bg-infonf">
                <h5 class="card-title text-light">Total valunteers <span></span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-check-fill"></i>
                  </div>
                  <div class="ps-3 text-light" id="total_valunteer">
                   
                    

                  </div>
                </div>
              </div>



            </div>
          </div>

          <!-- End Revenue Card -->

          <!-- Customers Card -->
          <div class="col-xxl-3 col-xl-6">

            <div class="card info-card customers-card bg-danger">

            

              <div class="card-body">
                <h5 class="card-title text-light">Total programs <span></span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-book"></i>
                  </div>
                  <div class="ps-3 text-light" id="total_prgrams">
                    

                  </div>
                </div>

              </div>
            </div>

          </div>

          <div class="col-xxl-3 col-md-6">
            <div class="card info-card sales-card bg-success">



              <div class="card-body">
                <h5 class="card-title text-light">Total feedbacks <span></span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cash-stack"></i>
                  </div>
                  <div class="ps-3 text-light" id="total_feedback">
                    <!-- <h6>145</h6>
                    <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Customers Card -->

          <!-- Reports -->
          <div class="col-12">
            <div class="card">

             



            </div>
          </div><!-- End Reports -->

          <!-- Recent Sales -->
          <!-- <div class="col-12">
            <div class="card recent-sales overflow-auto">

              

              <div class="card-body">
                <h5 class="card-title">Top 4 booking customers <span>| Today</span></h5>

                <table class="table" id="custtop">

                  <thead>



                  </thead>

                  <tbody>


                  </tbody>
                </table>

              </div>

            </div>
          </div>End Recent Sales -->

          <!-- Top Selling -->
          <!-- End Top Selling -->

        </div>
      </div><!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-4">

        <!-- Recent Activity -->


        <!-- Budget Report -->
        <!-- End Budget Report -->

        <!-- Website Traffic -->
        <!-- End Website Traffic -->

        <!-- News & Updates Traffic -->
        <!-- End News & Updates -->

      </div><!-- End Right side columns -->

      
    </div>
  </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->

<!-- End Footer -->


<!-- Vendor JS Files -->
<?php
include 'include/footer.php';

?>