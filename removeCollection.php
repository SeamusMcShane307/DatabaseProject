<?php
    $collection_id = $_GET['Collection_ID'];

    $conn = mysqli_connect("localhost", "root", "", "card_db");
                
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "DELETE FROM collections WHERE Collection_ID = '$collection_id'";
    if ($conn->query($sql) === TRUE) {
        header("Location:http://localhost/Database Website/User.php");
    } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
