
<?php

header("content-type: application/json");
include '..//config/conn.php';
// $action = $_POST['action'];


function register_feedback($conn){
    extract($_POST);
    $data = array();
    $query = "INSERT INTO feedback (program_id,volunteers_id,Coordinators_id,comments) 
    values('$program_id', '$volunteers_id','$Coordinators_id','$comments')";

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

function read_all_coordinators($conn){
    $data = array();
    $array_data = array();
   $query ="select * from Coordinators";
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


function read_all_feedback($conn){
    $data = array();
    $array_data = array();
   $query ="SELECT  f.feedback_id,v.fullname as fulname,p.name,c.fullname,f.comments from feedback f LEFT JOIN volunteers v on f.volunteers_id=v.volunteers_id LEFT JOIN Coordinators c on f.Coordinators_id= c.Coordinators_id LEFT JOIN programs p on f.program_id =p.program_id";
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



function get_feedbackinfo($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="SELECT *FROM feedback where feedback_id= '$feedback_id'";
    $result = $conn->query($query);


    if($result){
        $row = $result->fetch_assoc();
        
        $data = array("status" => true, "data" => $row);


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function update_feedback($conn){
    extract($_POST);

    $data = array();

    $query = "UPDATE feedback set program_id = '$program_id', volunteers_id = '$volunteers_id',Coordinators_id ='$Coordinators_id', comments ='$comments' WHERE feedback_id = '$feedback_id'";
     
    $result = $conn->query($query);

    if($result){

            $data = array("status" => true, "data" => "successfully updated");


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function delete_feedback($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="DELETE FROM feedback where feedback_id= '$feedback_id'";
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