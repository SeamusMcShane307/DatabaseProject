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
                if($conn->query("SELECT Password FROM users WHERE Password = '$password';") ->fetch_assoc()){
                    header("Refresh:0; url=http://localhost/Database Website/User.php");
                }
                else{
                    header("Refresh:0; url=http://localhost/Database Website/NewAccount.php");
                }
            }
            else{
                $sql = "INSERT INTO users (Username, Password, Num_Collection)
                Values ('$username', '$password', '0')";

                echo "How did we get here?";
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
?>