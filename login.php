<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Website</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<div class="banner">
    <div class="navigation">
        <img src="images/logo.png" alt="Logo" class="logo">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="#">Contacts</a></li>
        </ul>
    </div>
</div>

<div class="indexBody">
    <div class="login">
        <form name="loginform">
            <label for="loginname">Nickname</label><br>
            <input type="text" id ="loginname"><br>
            <label for="loginpass">Password</label><br>
            <input type="text" id ="loginpass"><br>
        </form>
        <div>
            <input type="submit" value="Login" form="loginform">
            <form action="register.php">
                <input type="submit" value="Create Account">
            </form>
        </div>
    </div>
</div>
</body>
</html>