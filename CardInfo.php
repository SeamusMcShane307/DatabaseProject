<!DOCTYPE html>

<!-- This website template was created by: Seamus McShane-->

<html lang=:en">
<html>
    <head>
        <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
        <!--<link rel="stylesheet" href="css/styles.css">-->
        <title>Card Information Page</title> 
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
        <nav>
            <ul>
                <li><a href="Login.php">Login</a> </li>
                <li><a href="User.php">User</a> </li>
                <li><a href="Admin.php">Admin</a> </li>
            </ul>
        </nav>

        <main>
            </div>
            <p>This is where the database will be</p>
            <table>
                <tr>
                    <th>Card Id</th>
                    <th>Card Name</th>
                    <th>Cost</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Printings</th>
                    <th>Rarity</th>
                    <th>Loyalty</th>
                </tr>
                <?php
                    $card_name = $_GET['Card_Name'];
                    $card_name = str_replace("@", "'",$card_name);
                    if (strpos($card_name, "'") !== FALSE){
                        $card_name = addslashes($card_name);
                    }
                    
                    $conn = mysqli_connect("localhost", "root", "", "card_db");
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT * FROM cards WHERE Name = '$card_name';";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["ID"]. 
                                "</td><td>" . $row["Name"].
                                "</td><td>" . $row["Cost"].
                                "</td><td>" . $row["Type"].
                                "</td><td>" . $row["Description"].
                                "</td><td>" . $row["Printings"].
                                "</td><td>" . $row["Rarity"]. 
                                "</td><td>". $row["Loyalty"]. "</td></tr>";
                            }
                            echo "</table>";
                        } else { echo "0 results"; }
                        $conn->close();
                ?>
            </table>
        </main>
    </body>
    </html>