<!DOCTYPE html>

<!-- This website template was created by: Seamus McShane-->

<html lang=:en">
<html>
    <head>
        <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
        <title>Login Page</title> 
        <meta charset="utf-8">
        <meta name="viewport" conent="width=device-width, initial-scale=1">
    </head>
    <body>
        <style>
            body {
              background-image: url('images/RagavanBackground.jpg');
            }
        </style>
        <main>
            <p>Please login to see your collections</p>
        </main>
        <form action="User.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username">

            <label for="password">Password</label>
            <input type="text" id="password" name="password">
            
            <button>Login</button>
        </form>
        <a href='NewAccount.php'>Make Account</a>
    </body>
</html>