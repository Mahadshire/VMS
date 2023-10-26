<?php
session_start();
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
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>


    <div class="container">
  <div class="row justify-content-center mt-4">
    <div class="col-sm-12">
      <div class="card">
        <div class="text-end">
        <button type="button" class="btn btn-info rounded-pill m-2" data-bs-toggle="modal" data-bs-target="#Coordinatorsmodal">
       Add Coordinators
         </button>
         </div>
         <div class="table-responsive style="overflow-y: scroll;">
        <table class="table" id="CoordinatorsTable">
         
      
        <thead>
       

            
        </thead>

        <tbody>
   
   
        
     
        </tbody>
        </table>
        </div>
       </div>
       </div>
    </div>
  </div>
   <!-- End Page Title -->

   

  </main>
  
  
  <!-- End #main -->

            
  <div class="modal fade " id="Coordinatorsmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Coordinators</h1>
        <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="Coordinatorsform">
        <input type="hidden" name="update_id" id="update_id">
        <div class="row">
           
       

            <div class="col-sm-12">
                <div class="form-group">
                <label for="">fullname</label>

                <input type="text" name="fullname" id="fullname" class="form-control" placeholder="fullname" required>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                <label for="">sex</label>

                <select name="" id="sex" class="form-control" required>
                <option disabled selected value>Select sex</option>
                <!-- <option value="">select sex</option> -->
                <option value="male">male</option>
                <option value="female">female</option>
               
                </select>
                </div>

            </div>

            <div class="col-sm-6">
                <div class="form-group">
                <label for="">tell</label>

                <input type="number" name="tell" id="tell" class="form-control" placeholder="phone" required>
                </div>

            </div>


            <div class="col-sm-6">
                <div class="form-group">
                <label for="">email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="email" required>
                </div>

            </div>

           

           
        </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit"  name="insert" class="btn btn-primary">Save Info</button>
      </div>
     </form>
    </div>
  </div>
</div>

 

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

  <?php
include 'include/footer.php';

?>