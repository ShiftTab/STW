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
    <body>
        <div id="navWrapper">
    <ul class="navMain">
        <li><a class="active" href="#">HOME</a></li>
        <li><a href="#">MEMBERS</a></li>
        <li><a href="#">STORE</a></li>
        <li><a href="#">NEWS</a></li>
        <li><a href="#">FORUM</a></li>
    </ul>
</div>
    </body>
</html>