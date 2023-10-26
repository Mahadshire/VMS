
<?php

header("content-type: application/json");
include '..//config/conn.php';
// $action = $_POST['action'];


function register_applay($conn){
    extract($_POST);
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

function read_all_programs($conn){
    $data = array();
    $array_data = array();
   $query ="select * from programs";
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

function read_all_volunteers($conn){ 
    $data = array();
    $array_data = array();
   $query ="select * from volunteers where status = 1";
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

function read_all_applay($conn){
    $data = array();    
    $array_data = array();
   $query ="select a.applay_id,p.name,v.fullname from applay a join programs p on a.program_id=p.program_id JOIN volunteers v on a.volunteers_id=v.volunteers_id";
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



function get_applayinfo($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="SELECT *FROM applay where applay_id= '$applay_id'";
    $result = $conn->query($query);


    if($result){
        $row = $result->fetch_assoc();
        
        $data = array("status" => true, "data" => $row);


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function update_applay($conn){
    extract($_POST);

    $data = array();

    $query = "UPDATE applay set program_id = '$program_id', volunteers_id = '$volunteers_id' WHERE applay_id = '$applay_id'";
     
    $result = $conn->query($query);

    if($result){

            $data = array("status" => true, "data" => "successfully updated 😂😊😒😎");


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function delete_applay($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="DELETE FROM applay where applay_id= '$applay_id'";
    $result = $conn->query($query);


    if($result){
   
        
        $data = array("status" => true, "data" => "successfully deleted");


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