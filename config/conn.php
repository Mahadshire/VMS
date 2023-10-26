<?php

$conn = new mysqli("localhost", "root", "", "volunteer");

if($conn->connect_error){
    echo $conn->error;
}