<?php
    session_start();
    $cardName = $_POST['Card_Name'];
    if (strpos($cardName, "'") !== FALSE){
        $cardName = addslashes($cardName);
    }
    $cardQuantity = $_POST['Quantity'];
    $collection_id = $_SESSION['Collection_ID'];
    
    $conn = mysqli_connect("localhost", "root", "", "card_db");
                
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT ID FROM cards WHERE Name = '$cardName';";
        if ($conn->query($sql) -> fetch_assoc()) {
            $newCard = $conn->query($sql) -> fetch_assoc()['ID'];
            $sql = "SELECT Collection_ID,Card_ID FROM contents WHERE Collection_ID = '$collection_id' AND Card_ID = '$newCard';";
            if($conn->query($sql) !== FALSE){
                $sql = "INSERT INTO contents (Collection_ID, Card_ID, Quantity)
                    Values ('$collection_id', '$newCard', '$cardQuantity')";
                if ($conn->query($sql) === TRUE) {
                header("Location:http://localhost/Database Website/Content.php?Collection_ID=$collection_id");
                } 
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            else{
                $sql = "UPDATE contents SET Quantity = '$cardQuantity' WHERE Collection_ID = '$collection_id' AND Card_ID = '$newCard';";
                if ($conn->query($sql) === TRUE) {
                    header("Location:http://localhost/Database Website/Content.php?Collection_ID=$collection_id");
                    } 
                    else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
            }
        }
        else {
            echo "no matching card found";
            header("Location:http://localhost/Database Website/Content.php?Collection_ID=$collection_id");
        }
        
    $conn->close();
?>
