<!DOCTYPE html>

<!-- This website template was created by: Seamus McShane-->

<html lang=:en">
<html>
    <head>
        <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
        <!--<link rel="stylesheet" href="css/styles.css">-->
        <title>Content Page</title> 
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
        <nav>
            <ul>
                <li><a href="Login.php">Login</a> </li>
                <li><a href="User.php">User</a> </li>
                <li><a href="Admin.php">Admin</a> </li>
            </ul>
        </nav>

        <main>
            <p>This is where the database will be</p>
            <table>
                <tr>
                    <th>Card Name</th>
                    <th>Mana Cost</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
                <?php
                    $collection_id = $_GET['Collection_ID'];
                    session_start();
                    $_SESSION['Collection_ID'] = $collection_id;
                    echo $collection_id;

                    $conn = mysqli_connect("localhost", "root", "", "card_db");
            
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT Quantity FROM contents WHERE Collection_ID = '$collection_id';";
                    $result1 = $conn->query($sql);
                    $sql = "SELECT Name,Cost FROM cards WHERE ID IN (SELECT Card_ID FROM contents WHERE Collection_ID = '$collection_id');";
                    $result2 = $conn->query($sql);
                    if ($result1->num_rows > 0) {
                    // output data of each row
                        $row2 = $result2 -> fetch_assoc();
                        while($row = $result1->fetch_assoc()) {
                            echo "<tr><td><a href='CardInfo.php?Card_Name=".$row2['Name']."'>" . $row2["Name"]. 
                            "</td><td>" . $row2["Cost"]. 
                            "</td><td>" . $row["Quantity"].
                            "<td><a href='removeCard.php?Card_Name=".$row2['Name']."&Collection_ID=".$collection_id."'>" . "Remove".
                            "</td></tr>";
                            $row2 = $result2 -> fetch_assoc();
                        }
                        echo "</table>";
                    } else { echo "0 results"; }
                    $conn->close();
                ?>
            </table>
            <form method="post" action="addCard.php">
                <div class="form-group">
                    <label>Card Name:</label>
                    <input type="text" id="Card_Name" name="Card_Name" placeholder="Start typing...">
                </div>

                <label for="Quantity">Quantity</label>
                <input type="number" id="Quantity" name="Quantity" min="1" max="4">

                <input type="submit" class"btn btn-primary" name="submit" value="Submit">
            </form>
        </main>
    </body>
    </html>