<?php
    $cardName = $_GET['Card_Name'];
    $cardName = str_replace("@", "'",$cardName);
                    if (strpos($cardName, "'") !== FALSE){
                        $cardName = addslashes($cardName);
                    }
    $collection_id = $_GET['Collection_ID'];

    $conn = mysqli_connect("localhost", "root", "", "card_db");
                
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "DELETE FROM contents WHERE Collection_ID = '$collection_id' AND Card_ID = (SELECT ID FROM cards WHERE Name = '$cardName')";
    if ($conn->query($sql) === TRUE) {
        header("Location:http://localhost/Database Website/Content.php?Collection_ID=$collection_id");
    } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>