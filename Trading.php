<!DOCTYPE html>

<!-- This website template was created by: Seamus McShane-->

<html lang=:en">
<html>

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
        <!--<link rel="stylesheet" href="css/styles.css">-->
        <title>Trade</title>
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
                <li><a href="Login.php">Logout</a> </li>
                <li><a href="User.php">My Collections</a> </li>
                <li><a href="Trading.php">Trade</a> </li>
            </ul>
        </nav>

        <main>
            </div>
            <p>This is where the database will be</p>
        </main>

        <table>
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
                    $sql = "SELECT * FROM collections;";
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
    </body>
</html>