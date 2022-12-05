<!DOCTYPE html>
<!-- http://localhost/Database%20Website/Login.html -->
<!-- This website template was created by: Seamus McShane-->

<html lang=:en">
<html>

<head>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="myCollections.css">
    <title>User Page</title>
    <meta charset="utf-8">
    <meta name="viewport" conent="width=device-width, initial-scale=1">
</head>

<body>
    <style>
        body {
            background-image: url('images/wrath-of-godBackground.jpg');
        }
    </style>

    <!-- Use the nav area to ass hyperlink to other pages within the website-->
    <nav class="navbar">
        <a href="Login.html"><button class="navButtons">Logout</button></a>
        <a href="User.php"><button class="navButtons">My Collections</button></a>
        <a href="Trading.php"><button class="navButtons">Trade</button></a>
    </nav>

    <div class="mainContent">
        <form action="newProcessor.php" method="post" class="collectionForm">
            <label for="Name">Collection Name:</label>
            <input type="text" id="Name" name="Name" class="inputBox" autofocus>

            <button class="buttons">Create Collection</button>
        </form>

        <table class="collectionTable">
            <tr>
                <th>Collection Id</th>
                <th>Username</th>
                <th>Collection Name</th>
                <th></th>
            </tr>
            <?php
            session_start();
            if (isset($_POST['username'])) {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['password'] = $_POST['password'];
                $username = $_SESSION['username'];
                $password = $_SESSION['password'];
                unset($_POST);
            } else {
                $username = $_SESSION['username'];
                $password = $_SESSION['password'];
            }
            $conn = mysqli_connect("localhost", "root", "", "card_db");
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            if ($conn->query("SELECT Username,Password FROM users WHERE Username = '$username' AND Password = '$password';")->fetch_assoc()) {
            } else {
                echo "An account with the entered username and password doesnt exist";
                #pop-up that lets the user know they entered an incorrect username or password
                header("Refresh:0; url=http://localhost/Database Website/Login.html");
            }
            $sql = "SELECT * FROM collections WHERE Username = '$username'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Collection_ID"] .
                        "</td><td>" . $row["Username"] .
                        "</td><td><a href='Content.php?Collection_ID=" . $row['Collection_ID'] . "'>" . $row["Name"] .
                        "<td><a href='removeCollection.php?Collection_ID=" . $row['Collection_ID'] . "'>" . "Remove" .
                        "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>

</html>