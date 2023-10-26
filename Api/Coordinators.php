
<?php

header("content-type: application/json");
include '..//config/conn.php';
// $action = $_POST['action'];


function register_Coordinators($conn){
    extract($_POST);
    $data = array();
    $query = "INSERT INTO Coordinators (fullname, sex, tell, email)
     values('$fullname', '$sex', '$tell', '$email')";

    $result = $conn->query($query);


    if($result){

       
            $data = array("status" => true, "data" => "successfully Registered");


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}


function read_all_Coordinators($conn){
    $data = array();
    $array_data = array();
   $query ="SELECT * from Coordinators";
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



function get_Coordinators_info($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="SELECT * FROM Coordinators where Coordinators_id= '$Coordinators_id'";
    $result = $conn->query($query);


    if($result){
        $row = $result->fetch_assoc();
        
        $data = array("status" => true, "data" => $row);


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function update_Coordinators($conn){
    extract($_POST);

    $data = array();

    $query = "UPDATE Coordinators set fullname = '$fullname', sex = '$sex', tell = '$tell', email = '$email' WHERE Coordinators_id = '$Coordinators_id'";
     
    $result = $conn->query($query);

    if($result){

            $data = array("status" => true, "data" => "successfully updated");


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function Delete_Coordinators($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="DELETE FROM Coordinators where Coordinators_id= '$Coordinators_id'";
    $result = $conn->query($query);


    if($result){
   
        
        $data = array("status" => true, "data" => "successfully Deleted");


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}


if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
}else{
    echo json_encode(array("status" => false, "data"=> "Action Required....."));
}



?>