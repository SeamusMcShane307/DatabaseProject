<?php
    $collection_id = $_GET['Collection_ID'];

    $conn = mysqli_connect("localhost", "root", "", "card_db");
                
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "DELETE FROM collections WHERE Collection_ID = '$collection_id'";
    if ($conn->query($sql) === TRUE) {
        if ($conn->query("SET @count = 0;") === TRUE) {
            if ($conn->query("UPDATE collections SET Collection_ID = @count:= @count + 1") === TRUE) {
                if ($conn->query("ALTER TABLE collections AUTO_INCREMENT = 1;") === TRUE) {
                header("Location:http://localhost/Database Website/User.php");
                }else {echo "fail 3";}
            }else {echo "fail 2";}
        }
        else {echo "fail 1";} 
    } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
