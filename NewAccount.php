<!DOCTYPE html>

<!-- This website template was created by: Seamus McShane-->

<html lang=:en">
<html>
    <head>
        <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
        <!--<link rel="stylesheet" href="css/styles.css">-->
        <title>New Account</title> 
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
            </ul>
        </nav>

        <main>
            <p>Please login to see your collections</p>
        </main>
        <form action="newProcessor.php" method="post">
            <label for="username">New Username</label>
            <input type="text" id="username" name="username">

            <label for="password">New Password</label>
            <input type="text" id="password" name="password">
            
            <button>Create Account</button>
        </form>
    </body>
    </html>