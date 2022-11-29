<?php 
    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $conn = mysqli_connect("localhost", "root", "", "card_db");
            
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            if($conn->query("SELECT Username FROM users WHERE Username = '$username';") ->fetch_assoc()){
                # pop-up that the username is already taken
                header("Refresh:0; url=http://localhost/Database Website/User.php");
            }
            else{
                $sql = "INSERT INTO users (Username, Password, Num_Collection)
                Values ('$username', '$password', '0')";

                if ($conn->query($sql) === TRUE) {
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    header("Refresh:0; url=http://localhost/Database Website/User.php");
                } 
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            
        $conn->close();
    }
    else if(isset($_POST['Name'])){
        $collection_name = $_POST['Name'];
        $conn = mysqli_connect("localhost", "root", "", "card_db");
            
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT MAX(Collection_ID) FROM collections";
            if ($conn->query($sql) -> fetch_assoc()) {
                $newCollection_id = intval($conn->query($sql) -> fetch_assoc()['MAX(Collection_ID)'])+1;
                session_start();
                $username = $_SESSION['username'];
                $sql = "INSERT INTO collections (Collection_ID, Username, Name)
                Values ('$newCollection_id', '$username', '$collection_name')";
                if ($conn->query($sql) === TRUE) {
                    unset($_POST);
                    header("Refresh:0; url=http://localhost/Database Website/User.php");
                } 
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } 
            else {
                echo "nothing found";
            }
        $conn->close();
    }
    else{
        echo "what happened";
    }
?>