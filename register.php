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
        <form name="registerform" method="post" action="register.php">
            <label for="loginname">Nickname</label><br>
            <input type="text" id ="loginname" name="loginname"><br>
            <label for="loginpass">Password</label><br>
            <input type="text" id ="loginpass" name="loginpass"><br>
            <label for="loginpassrepeat">Repeat Password</label><br>
            <input type="text" id ="loginpassrepeat" name="loginpassrepeat"><br>
            <input type="submit" value="Register">
        </form>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['loginname'];
            $password = $_POST['loginpass'];
            $passwordrepeat = $_POST['loginpassrepeat'];
            $username_error = $password_error = $passwordrepeat_error = "";

            if (empty(trim($username)) || empty(trim($password)) || empty(trim($passwordrepeat))) {
                echo "Treba vyplnit vsetky polozky";
                return;
            }
            if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($username))) {
                $username_error = "Nickname has to inlcude only Numbers and Letters";
            }
            if(strlen(trim($password)) < 5) {
                $password_error = "Password has to include atleast 5 Characters";
            } elseif (strlen(trim($password)) > 18) {
                $password_error = "Password can include only up to 18 Characters";
            }
            if($password != $passwordrepeat) {
                $passwordrepeat_error = "Passwords must match";
            }
            $conn = new mysqli("dockerDB","root","password","myDB");
            $namecheck = $conn->query("SELECT * FROM users WHERE nickname = '$username'");

            if(mysqli_num_rows($namecheck) > 0) {
                $username_error = "Nickname already exists, try another one";
            }
            if(empty($username_error) && empty($password_error) && empty($passwordrepeat_error)) {
                $db_username = $username;
                $db_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (nickname,password) VALUES ('$db_username','$db_password')";

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                if ($conn->query($sql) == TRUE) {
                    echo "Successful!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                if($username_error != "") {
                    echo "$username_error \n";
                } else if($password_error != "") {
                    echo "$password_error \n";
                } else if($passwordrepeat_error != ""){
                    echo "$password_error \n";
                }
            }
        }
        ?>
    </div>
</div>
</body>
</html>
