<?php
session_start();
header("content-type: application/json");
include '..//config/conn.php';
// $action = $_POST['action'];



function forget($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="CALL forget('$yourusername','$yourPassword')";
    $result = $conn->query($query);


    if($result){

        $row= $result->fetch_assoc();

        if($row['Msg']=='deny'){
         $data = array("status" => false, "data" => "this username does not exsist");
 
        }
 
        else if($row['Msg']=='success'){
         $data = array("status" => true, "data" => "updated successfully");
 
        }

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