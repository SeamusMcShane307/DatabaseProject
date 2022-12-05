<!DOCTYPE html>

<!-- This website template was created by: Seamus McShane-->

<html lang=:en">
<html>

<head>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="myCollections.css">
    <title>Trade</title>
    <meta charset="utf-8">
    <meta name="viewport" conent="width=device-width, initial-scale=1">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- jQuery UI library -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

    <script>
        $(function() {
            $("#Card_Name").autocomplete({
                source: "fetchData.php",
            });
        });
    </script>
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
        <form method='get' action='Trading.php' class='collectionForm'>
            <div class='form-group'>
                <label>Find Card:</label>
                <input type='text' id='Card_Name' name='Card_Name' placeholder='Start typing...' class="inputBox" autofocus>

                <input type='submit' class'btn btn-primary' name='submit' value='Submit' class='buttons'>
            </div>
        </form>
        <table class="collectionTable">
            <tr>
                <th>Collection_Id</th>
                <th>Username</th>
                <th>Collection_Name</th>
            </tr>
            <?php
            session_start();
            $conn = mysqli_connect("localhost", "root", "", "card_db");
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_GET['Card_Name'])) {
                $card_name = $_GET['Card_Name'];
                if (strpos($card_name, "'") !== FALSE) {
                    $card_name = addslashes($card_name);
                }
                if($conn->query("SELECT ID FROM cards WHERE Name = '$card_name';") -> num_rows === 0){
                    $card_id = "";
                } 
                else {
                    $sql = "SELECT ID FROM cards WHERE Name = '$card_name';";
                    $card_id = $conn->query($sql)->fetch_assoc()['ID'];
                }
            }

            if (isset($card_id)) {
                $sql = "SELECT * FROM collections WHERE Collection_ID IN (SELECT Collection_ID FROM contents WHERE Card_id = '$card_id');";
            } else {
                $sql = "SELECT * FROM collections;";
            }
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Collection_ID"] .
                        "</td><td>" . $row["Username"] .
                        "</td><td><a href='Content.php?Collection_ID=" . $row['Collection_ID'] . "'>" . $row["Name"] .
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