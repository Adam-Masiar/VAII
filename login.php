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
        <form name="loginform" method="post" action="login.php">
            <label for="loginname">Nickname</label><br>
            <input type="text" id="loginname" name="loginname"><br>
            <label for="loginpass">Password</label><br>
            <input type="text" id="loginpass" name="loginpass"><br>
            <input type="submit" id="submit-form" value="Login">
        </form>
        <div>
            <form action="register.php">
                <input type="submit" value="Create Account">
            </form>
        </div>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['loginname'];
            $password = $_POST['loginpass'];
            $username_error = $password_error = "";
            if(empty(trim($username))) {
                $username_error = "Enter a Username";
            } else if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($username))) {
                $username_error = "Nickname has to inlcude only Numbers and Letters";
            }
            $conn = new mysqli("dockerDB","root","password","myDB");
            $namecheck = $conn->query("SELECT * FROM users WHERE nickname = '$username'");

            if(mysqli_num_rows($namecheck) > 0) {
                $hash = $conn->query("SELECT password FROM users WHERE nickname = '$username'")->fetch_object()->password;
                if(password_verify($password,$hash)) {
                    echo "Successful";
                } else {
                    $password_error = "Incorrect Password";
                }
            } else {
                $username_error = "Nickname doesn't exist";
            }

            if($username_error != "") {
                echo "$username_error \n";
            } else if($password_error != "") {
                echo "$password_error \n";
            }
        }
        ?>
    </div>
</div>
</body>
</html>