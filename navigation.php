<?php
session_start();
?>
<div class="banner">
    <div class="navigation">
        <img src="images/logo.png" alt="Logo" class="logo">
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php
            if(isset($_SESSION['username']) && isset($_SESSION['password'])) {
                echo '<li><a href="account.php">Account</a></li>';
            } else {
                echo '<li><a href="login.php">Login</a></li>';
            }
            ?>
            <li><a href="contacts.php">Contacts</a></li>
        </ul>
    </div>
</div>