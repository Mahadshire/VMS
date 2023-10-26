<?php
header("content-type: application/json");
include '..//config/conn.php';
// $action = $_POST['action'];


function register_booking($conn){
    extract($_POST);
    $data = array();
    $query = "INSERT INTO booking (customer_id, hall_id, w_id, start_time, End_time,Total_Guests,Total_price)
     values('$customers_id', '$hall_id','$wedding_id', '$start_time', '$End_time','$Total_Guests', '$Total_price')";

    $result = $conn->query($query);


    if($result){

       
            $data = array("status" => true, "data" => "successfully Registered 😂😊😒😎");


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function read_all_booking($conn){
    $data = array();
    $array_data = array();
   $query ="SELECT b.b_id,concat(c.fristname,' ',c.lastname) AS Customer_name,h.hall_name,concat(w.male_name,' & ',w.female_name) AS couples,b.start_time,b.End_time,b.Total_Guests,b.Total_price,b.booking_date FROM booking b JOIN customer c ON b.customer_id=c.customer_id JOIN hall h ON b.hall_id=h.hall_id JOIN wedding w ON b.w_id=w.w_id";
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

function read_all_customers($conn){
    $data = array();
    $array_data = array();
   $query ="select * from customer";
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
function read_all_wedding($conn){
    $data = array();
    $array_data = array();
   $query ="select w_id, concat(w.male_name,' & ',w.female_name) AS Wedding_names from wedding w";
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

function get_booking($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="SELECT *FROM booking where b_id = '$b_id '";
    $result = $conn->query($query);


    if($result){
        $row = $result->fetch_assoc();
        
        $data = array("status" => true, "data" => $row);


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}

function update_booking($conn){
    extract($_POST);

    $data = array();

    $query = "UPDATE booking set customer_id = '$customers_id', hall_id = '$hall_id',start_time = '$start_time', End_time = '$End_time',Total_Guests = '$Total_Guests', Total_price = '$Total_price', w_id  = '$wedding_id' WHERE b_id  = '$b_id '";
     

    $result = $conn->query($query);


    if($result){

            $data = array("status" => true, "data" => "successfully updated 😂😊😒😎");


    }else{
        $data = array("status" => false, "data"=> $conn->error);
             
    }

    echo json_encode($data);
}


function Delete_booking($conn){
    extract($_POST);
    $data = array();
    $array_data = array();
   $query ="DELETE FROM booking where b_id = '$b_id '";
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