<?php

header("content-type: application/json");
include '..//config/conn.php';
// $action = $_POST['action'];

function read_all_branch($conn){
    $data = array();
    $array_data = array();
   $query ="select * from branch";
    $result = $conn->query($query);


    if($result){
        while($row = $result->fetch_assoc()){
            $array_data[] = $row;
        }
        $data = array("status" => true, "data" => $array_data);


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}


function register_valunteers($conn){
    extract($_POST);
    $data = array();
    $eroor_Array= array();
    $new_id= generate($conn);

    $file_name= $_FILES['image']['name'];
    $file_type= $_FILES['image']['type'];
    $file_size= $_FILES['image']['size'];

    $save_name= $new_id . ".png";

    // allowed images

    $allowedImages =  ["image/jpg", "image/jpeg", "image/png"];
    $max_size= 5 * 1024 * 1024;

    if(in_array($file_type, $allowedImages)){
         
        if($file_size > $max_size){
            $eroor_Array[]=  $file_size/1024/1024 . " MB  file size must be less then" . $max_size/1024/1024 ." MB";
        }


    }else{
        $eroor_Array[]= "this file is not Allowed";
    }

     if(count($eroor_Array) <= 0){
         $query = "INSERT INTO `volunteers`(`volunteers_id`, `fullname`, `email`, `password`, `sex`, `phone`, `age`, `education`, `branch_id`, `image`, `method`, `status`)
         values('$new_id','$fullname', '$email',  MD5('$password'), '$sex', '$phone', '$age','$education', '$branch_id', '$save_name', '$method', '$status')";
   
       $result = $conn->query($query);
   
   
       if($result){
       move_uploaded_file($_FILES['image']['tmp_name'], "../aploads/" . $save_name);
       $data = array("status" => true, "data"=>  "successfully Registered");

    
       }else{
           $data = array("status" => false, "data"=> $conn->error);
                
       }


     }else{
        $data = array("status" => false, "data"=> $eroor_Array);

     }
  

    echo json_encode($data);
}


function get_volunteers_list($conn){
    $data = array();
    $array_data = array();
   $query ="SELECT v.volunteers_id,v.fullname, v.sex, v.education, v.age, v.phone, b.branch_name Branch, v.method, v.image, if(v.status = 1, 'active', 'pending')as status FROM `volunteers` V JOIN branch b ON V.branch_id = b.branch_id where v.status = 1";
    $result = $conn->query($query);

    if($result){
        while($row = $result->fetch_assoc()){
            $array_data[] = $row;
        }
        $data = array("status" => true, "data" => $array_data);


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function get_volunteers_info($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="SELECT * FROM `volunteers` where volunteers_id= '$volunteers_id'";
    $result = $conn->query($query);


    if($result){
        $row = $result->fetch_assoc();
        
        $data = array("status" => true, "data" => $row);


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}


function update_volunteers($conn){
    extract($_POST);
    $data = array();
    if(!empty($_FILES['image']['tmp_name'])){

        $eroor_Array= array();
        // $new_id= generate($conn);
    
        $file_name= $_FILES['image']['name'];
        $file_type= $_FILES['image']['type'];
        $file_size= $_FILES['image']['size'];
    
        $save_name= $update_id . ".png";
    
        // allowed images
    
        $allowedImages =  ["image/jpg", "image/jpeg", "image/png"];
        $max_size= 15 * 1024 * 1024;
    
        if(in_array($file_type, $allowedImages)){
             
            if($file_size > $max_size){
                $eroor_Array[]=  $file_size/1024/1024 . " MB  file size must be less then" . $max_size/1024/1024 ." MB";
            }
    
    
        }else{
            $eroor_Array[]= "this file is not Allowed";
        }
    
         if(count($eroor_Array) <= 0){
            $query = "UPDATE volunteers set volunteers.fullname= '$fullname',volunteers.email = '$email', volunteers.password =  MD5('$password'), volunteers.sex= '$sex', volunteers.phone = '$phone', volunteers.age = '$age', volunteers.education = '$education', volunteers.branch_id = '$branch_id', volunteers.method = '$method', volunteers.status = '$status' where volunteers.volunteers_id= '$update_id'";
       
           $result = $conn->query($query);
       
       
           if($result){
           move_uploaded_file($_FILES['image']['tmp_name'], "../aploads/" . $save_name);
           $data = array("status" => true, "data"=>  "successfully Updated");
           
    
        
           }else{
               $data = array("status" => false, "data"=> $conn->error);
                    
           }
    
    
         }else{
            $data = array("status" => false, "data"=> $eroor_Array);
    
         }
      

    }else{

        $query = "UPDATE volunteers set  volunteers.fullname= '$fullname', volunteers.email = '$email', volunteers.password =  MD5('$password'), volunteers.sex= '$sex', volunteers.phone = '$phone', volunteers.age = '$age', volunteers.education = '$education', volunteers.branch_id = '$branch_id', volunteers.method = '$method',volunteers.status = '$status' where volunteers.volunteers_id= '$update_id'";
  
      $result = $conn->query($query);
  
  
      if($result){
      $data = array("status" => true, "data"=>  "successfully updated");

   
      }else{
          $data = array("status" => false, "data"=> $conn->error);
               
      }


   

    }
   

    echo json_encode($data);
}



function Delete_volunteers_info($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="DELETE FROM `volunteers` where volunteers_id  = '$volunteers_id'";
    $result = $conn->query($query);


    if($result){
     
        unlink('../aploads/' .$volunteers_id. ".png");
        
        $data = array("status" => true, "data" => "Deleted successfully😎");


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}


function generate($conn){
    $new_id= '';
    $data = array();
    $array_data = array();
   $query ="SELECT * FROM `volunteers` order by volunteers.volunteers_id DESC limit 1";
    $result = $conn->query($query);


    if($result){
        $num_rows= $result->num_rows;

        if($num_rows > 0){
            $row = $result->fetch_assoc();

            $new_id = ++$row['volunteers_id'];

        }else{
              
            $new_id= "VOL001";
        }
       
        


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

  return $new_id;
}



if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
}else{
    echo json_encode(array("status" => false, "data"=> "Action Required....."));
}
?>