<!DOCTYPE html>

<!-- This website template was created by: Seamus McShane-->

<html lang=:en">
<html>

<head>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="myCollections.css">
    <link rel="stylesheet" href="cardInfo.css">
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
    <nav class="navbar">
        <a href="Login.html"><button class="navButtons">Logout</button></a>
        <a href="User.php"><button class="navButtons">My Collections</button></a>
        <a href="Trading.php"><button class="navButtons">Trade</button></a>
    </nav>

    <div class="mainContent">

        <?php
        $card_name = $_GET['Card_Name'];
        $card_name = str_replace("@", "'", $card_name);
        if (strpos($card_name, "'") !== FALSE) {
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
            // output data
            $row = $result->fetch_assoc();
            echo "<div class='cardInfoDiv'>
                            <!--ID-->
                            <div class='textSections'>" . "Card Name: ". $row['Name'];
            echo "</div>
                            <!--Card Name-->
                            <div class='textSections'>" . "Card ID: ". $row['ID'];
            echo "</div>
                            <!--Cost-->
                            <div class='textSections'>" . "Mana Cost: ". $row['Cost'];
            echo "</div>
                            <!--Creature Type-->
                            <div class='textSections'>" . "Type: ". $row['Type'];
            echo "</div>
                            <!--Description-->
                            <div class='textSections'>" . "Description: <br>". nl2br(nl2br($row['Description']));
            echo "</div>
                            <!--Printings-->
                            <div class='textSections'>" . "Printings: ". $row['Printings'];
            echo "</div>
                            <!--Rarity-->
                            <div class='textSections'>" . "Rarity: ". $row['Rarity'];
            echo "</div>
                            <!--Loyalty-->
                            <div class='textSections'>" . "Loyalty: ";
                            if($row['Loyalty'] == null){
                                echo 0;
                            }
                            else{
                                echo $row['Loyalty'];
                            }
            echo "</div>
                        </div>";
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </div>
</body>

</html>