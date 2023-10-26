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
        <button type="button" class="btn d-none btn-info rounded-pill m-2" data-bs-toggle="modal" data-bs-target="#volunteermodal">
       Add volunteer
         </button>
         </div>
        <table class="table" id="applicationTable">

        <thead>
  

            
        </thead>

        <tbody>
   
        <!-- <tr>
          <td>welcome</td>
          <td>welcome</td>
          <td>welcome</td>
          <td>welcome</td>
          
        </tr>
        <tr>
          <td>welcome</td>
          <td>welcome</td>
          <td>welcome</td>
          <td>welcome</td>
          
        </tr>
        <tr>
          <td>welcome</td>
          <td>welcome</td>
          <td>welcome</td>
          <td>welcome</td>
          
        </tr>
        <tr>
          <td>welcome</td>
          <td>welcome</td>
          <td>welcome</td>
          <td>welcome</td>
          
        </tr> -->
        
     
        </tbody>
        </table>
        </div>
       </div>
    </div>
  </div>
   <!-- End Page Title -->

   

  </main>
  
  
  <!-- End #main -->

            
  <div class="modal fade" id="volunteermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Volunteer Info</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="applicatinForm">
      <form id="applicatinForm" enctype="multipart/form-data">
        <input type="hidden" name="update_id" id="update_id">
        <div class="row">

          
        <div class="col-sm-12">
                <div class="form-group">
                <!-- <label for="fullname">fullname</label> -->
                <!-- <input type="hidden" name="fullname" id="fullname" class="form-control" placeholder="fullname" required> -->
                </div>
            </div>
        <div class="col-sm-12 d-none">
                <div class="form-group">
                <label for="fullname">fullname</label>

                <input type="text" name="fullname" id="fullname" class="form-control" placeholder="fullname" required>
                </div>
            </div>

        <div class="col-sm-6 d-none">
                <div class="form-group">
                <label for="">Email</label>

                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                </div>
            </div>
        <div class="col-sm-6 d-none">
                <div class="form-group">
                <label for="">Password</label>

                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                </div>
            </div>

            <div class="col-sm-6 d-none">
                <div class="form-group">
                <label for="">sex</label>

                <select name="sex" id="sex" class="form-control" required>
                <option disabled selected value>Select sex</option>
                <!-- <option value="">select sex</option> -->
                <option value="male">male</option>
                <option value="female">female</option>
               
                </select>
                </div>

            </div>

            <div class="col-sm-6 d-none">
                <div class="form-group">
                <label for="">phone</label>

                <input type="number" name="phone" id="phone" class="form-control" placeholder="phone" required>
                </div>

            </div>


            <div class="col-sm-6 d-none">
                <div class="form-group">
                                  <label for="">age</label>

                <input type="text" name="age" id="age" class="form-control" placeholder="age" required>
                </div>

            </div>
            <div class="col-sm-6 d-none" id="statas">
                <div class="form-group">
                <label for="">Status</label>
                <input type="text" name="status" id="status" class="form-control" placeholder="status"value="1">
                </div>

            </div>

  
       

            <div class="col-sm-6 d-none">
                <div class="form-group">
                <label for="">education</label>

                <select name="education" id="education" class="form-control" required>
                <option disabled selected value>Select education level</option>
                <!-- <option value="secondery">select education level</option> -->
                <option value="secondery">secondery</option>
                <option value="primery">primery</option>
                <option value="university">university</option>
                </select>
                </div>

            </div>

          

            
            <div class="col-sm-6 d-none">
                <div class="form-group">
                <label for="">branch</label>

                <select name="branch_id" id="branch_id" class="form-control">
                <option disabled selected value>Select branch</option>
                <!-- <option value="0">select branch</option> -->
                </select>
                </div>

            </div>

            <div class="col-sm-6 d-none">
                <div class="form-group">
                <label for="">method</label>
                <select name="method" id="method" class="form-control">
                <option disabled selected value>who registed?</option>
                <option value="by_user">by user</option>
                <option value="by_self">by self</option>
                </select>
                </div>
            </div>


            <div class="col-sm-12 mt-3 d-none">
                <div class="form-group">
                <label for="">image</label>
                <input type="file" name="image" id="image" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-6 d-none">
                <div class="form-group">
                <img id="show">
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