<?php 
include ( "./inc/connect.inc.php" ); 
session_start();
if (!isset($_SESSION["user_login"])) {
    $username = "";
}
else
{
    $username = $_SESSION["user_login"];
}
?>
<!doctype html>
<html>
    <head>
        <title>Ghost-Squad</title>
        <link rel="stylesheet" type="text/css" href="./css/style.css" />
        <script src="js/main.js" type="text/javascript"></script>
    </head>
    <body background="./img/background.png">
    	<div class="headerMenu">
    		<div id="wrapper">
    			<div class="logo">
    				<img src="./img/ghost_squad_logo.png" />
    			</div>
    			<div class="search_box">
    				<form action="search.php" method="GET" id="search">
    					<input type="text" name="q">
    				</form>
    			</div>
                <?php
                if (!$username) {
    			echo '<div id="menu">
    				<a href="#" />Sign Up</a>
    				<a href="#" />Sign In</a>
    			</div>';
            } else {
                echo '<div id="menu">
                    <a href="'.$username.'" />Profile</a>
                    <a href="account_settings.php" />Account Settings</a>
                    <!--<a href="#" style="background-color: #FF5858;"/>Admin</a>-->
                    <a href="logout.php" />Logout</a>
                </div>';
            }
            ?>
    		</div>    	
    	</div>
        <div class="alertBar">
            <marquee behavior="alternate" direction="left" width="40%"><b>Attention : This website is under development.</b></marquee>
        </div>
        <div id="wrapper">
        <br />
    </body>
</html>