<?php
header("content-type: application/json");
include '..//config/conn.php';
// $action = $_POST['action'];


function register_hall($conn){
    extract($_POST);
    $data = array();
    $query = "INSERT INTO hall (hall_name, price, address)
     values('$hallname', '$price', '$address')";

    $result = $conn->query($query);


    if($result){

       
            $data = array("status" => true, "data" => "successfully Registered ");


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function read_all_hall($conn){
    $data = array();
    $array_data = array();
   $query ="select * from hall";
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

function get_hall($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="SELECT *FROM hall where hall_id= '$hall_id'";
    $result = $conn->query($query);


    if($result){
        $row = $result->fetch_assoc();
        
        $data = array("status" => true, "data" => $row);


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function update_hall($conn){
    extract($_POST);

    $data = array();

    $query = "UPDATE hall set hall_name ='$hallname', price = '$price',address= '$address' WHERE hall_id = '$update_id'";
     

    $result = $conn->query($query);


    if($result){

            $data = array("status" => true, "data" => "successfully updated");


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}


function Delete_hall($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="DELETE FROM hall where hall_id= '$hall_id'";
    $result = $conn->query($query);


    if($result){
   
        
        $data = array("status" => true, "data" => "successfully Deleted😎");


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