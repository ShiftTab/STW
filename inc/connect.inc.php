<?php
	$db = mysqli_connect("localhost", "root", "", "gsdatabase") or die("Couldn't connect to SQL server");
?>
















<!-- <?php
	$con = mysqli_connect("localhost","root","") or die("Couldn't connect to SQL server");
    mysqli_select_db($con,"gsdatabase") or die("Couldn't select DB");﻿
?>

<?php
	$db_conx = mysqli_connect("localhost", "root", "", "gsdatabase") or die("Couldn't connect to SQL server");
// Evaluate the connection
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
    exit();
} else {
	echo "Successful database connection, happy coding!!!";
}
?> -->