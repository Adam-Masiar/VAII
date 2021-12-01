<?php
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Website</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<?php include "navigation.php" ?>
<div class="indexBody">
    <div class="login">
        <li><a href="logout.php">Logout</a></li>
        <li><a href="deleteacc.php">Delete Account</a></li>
        <br>
        Change Password:
        <form name="passresetform" method="post" action="account.php">
            <label for="currentpass">Current Password</label><br>
            <input type="text" id="currentpass" name="currentpass"><br>
            <label for="newpass">New Password</label><br>
            <input type="text" id="newpass" name="newpass"><br>
            <input type="submit" id="submit-form" value="Change Password">
        </form>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $currentpass = $_POST['currentpass'];
            $newpass = $_POST['newpass'];
            $currentpass_error = $newpass_error = "";
            if (empty(trim($currentpass)) || empty(trim($newpass))) {
                echo "Treba vyplnit vsetky polozky";
                return;
            }
            if(strlen(trim($newpass)) < 5) {
                $newpass_error = "Password has to include atleast 5 Characters";
            } elseif (strlen(trim($newpass)) > 18) {
                $newpass_error = "Password can include only up to 18 Characters";
            }
            $conn = new mysqli("dockerDB","root","password","myDB");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            if(empty($newpass_error)) {
                $username = $_SESSION['username'];
                $hash = $conn->query("SELECT password FROM users WHERE nickname = '$username'")->fetch_object()->password;
                if (password_verify($currentpass, $hash)) {
                    $db_password = password_hash($newpass, PASSWORD_DEFAULT);
                    $sql = "UPDATE users SET password = '$db_password' WHERE nickname = '$username'";
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    if ($conn->query($sql) == TRUE) {
                        echo "Successful!";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    $currentpass_error = "Current Password doesn't match";
                }
            }
        if($newpass_error != "") {
            echo "$newpass_error \n";
        } else if($currentpass_error != "") {
            echo "$currentpass_error \n";
        }
        }
        ?>
    </div>
</div>


</body>
</html>