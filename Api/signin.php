<?php
session_start();
header("content-type: application/json");
include '..//config/conn.php';
// $action = $_POST['action'];



function signin($conn){
    extract($_POST);
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


if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($conn);
}else{
    echo json_encode(array("status" => false, "data"=> "Action Required....."));
}


?>