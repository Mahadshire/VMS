
<?php

header("content-type: application/json");
include '..//config/conn.php';
// $action = $_POST['action'];


function register_reward($conn){
    extract($_POST);    
    $data = array();
    $query = "INSERT INTO reward(reward_type, volunteers_id,program_id) 
    values('$reward_type', '$volunteers_id', '$program_id')";

    $result = $conn->query($query);

    if($result){
       
            $data = array("status" => true, "data" => "successfully Registered");

    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function read_all_program($conn){
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
   $query ="select * from volunteers";
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


function read_all_reward($conn){
    $data = array();
    $array_data = array();
   $query ="select r.reward_id, r.reward_type as Reward,v.fullname as Volunteer, p.name as Program from reward r join programs p on r.program_id=p.program_id JOIN volunteers v on r.volunteers_id=v.volunteers_id";
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

function get_rewardinfo($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="SELECT *FROM reward where reward_id= '$reward_id'";
    $result = $conn->query($query);


    if($result){
        $row = $result->fetch_assoc();
        
        $data = array("status" => true, "data" => $row);


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function update_reward($conn){
    extract($_POST);

    $data = array();

    $query = "UPDATE reward set reward_type ='$reward_type', program_id = '$program_id', volunteers_id = '$volunteers_id' WHERE reward_id = '$reward_id'";
     
    $result = $conn->query($query);

    if($result){

            $data = array("status" => true, "data" => "successfully updated");


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function delete_reward($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="DELETE FROM reward where reward_id= '$reward_id'";
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