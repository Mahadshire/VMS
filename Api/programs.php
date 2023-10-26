
<?php

header("content-type: application/json");
include '..//config/conn.php';
// $action = $_POST['action'];


function register_program($conn){
    extract($_POST);
    $data = array();
    // $query = "INSERT INTO programs (name, ptype, descriptionription, durations,from_date,to_date)
    //  values('$name', '$ptype', '$description', '$durations', '$from_date','$to_date')";

     $query = "call programprod('$name','$ptype', '$description', '$durations', '$from_date','$to_date')";


    $result = $conn->query($query);


    if($result){

       
            $data = array("status" => true, "data" => "successfully Registered 😂😊😒😎");


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}


function read_all_program($conn){
    $data = array();
    $array_data = array();
   $query ="SELECT program_id, name as pname, ptype AS Type, description, durations, from_date as Start, to_date as End FROM `programs`";
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


function get_program_info($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="SELECT *FROM programs where program_id= '$program_id'";
    $result = $conn->query($query);


    if($result){
        $row = $result->fetch_assoc();
        
        $data = array("status" => true, "data" => $row);


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function update_program($conn){
    extract($_POST);

    $data = array();

    $query = "UPDATE programs set name = '$name', ptype = '$ptype', description = '$description', durations = '$durations', to_date = '$to_date' WHERE program_id = '$program_id'";
     

    $result = $conn->query($query);


    if($result){

            $data = array("status" => true, "data" => "successfully updated 😂😊😒😎");


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function Delete_program($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="DELETE FROM programs where program_id='$program_id'";
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