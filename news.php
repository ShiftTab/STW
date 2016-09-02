<?php include ( "./inc/header.inc.php" ); ?>
<div id="subNavWrapper">
    <ul class="subNav">
        <li><?php echo " Would you like to logout $username? <a href='logout.php'>Logout</a>";?></li>
    </ul>
</div>
<?php
if (isset($_GET['u'])) {
    $username = mysqli_real_escape_string($db_conx, $_GET['u']);
    if (ctype_alnum($username)) {
        // Check user exists
        $check = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        if (mysqli_num_rows($check)===1) {
            $get = mysqli_fetch_assoc($check);
            $username = $get['username'];
        }
        else
        {
            echo "<meta http-equiv=\"refresh\" content=\"0; url=http://localhost/ghostsquadwebsite/index.php\">";
            exit();
        }
    }
}
$post = @$_POST['post'];
if ($post != "") {
    $date_added = date("Y-m-d");
    $added_by = "$username";
    $user_posted_to = "$username";

    $sqlCommand = "INSERT INTO posts VALUES('', '$post','$date_added','$added_by','$user_posted_to')";
    $query = mysqli_query($con, $sqlCommand) or die (mysqli_error());

}
?>

<div id="mainWrapper">
    <div id="newsContentWrapper">
        <div id="alertBar">
            <p>This website is currently under development!</p>
        </div>

        <div id="mainUpdatesContainer">
            <div id="mainNewsHeader">
                <h2>News & updates:</h2>
            </div>
            <div id="newsUpdatesContent">




                <div id="mainNewsContainer">
                    <div id="mainNewsIcon">
                        <img src="images/scripticontest.png" alt="">
                    </div>
                    <div id="mainNewsPostTitle">
                        ....
                    </div>
                    <div id="mainNewsPost">
                        ..
                    </div>
                    <div id="mainNewsIcon">
                        <img src="images/scripticontest.png" alt="">
                    </div>
                    <div id="mainNewsPostTitle">
                        ....
                    </div>
                    <div id="mainNewsPost">
                        ..
                    </div>
                    <div id="mainNewsIcon">
                        <img src="images/scripticontest.png" alt="">
                    </div>
                    <div id="mainNewsPostTitle">
                        ....
                    </div>
                    <div id="mainNewsPost">
                        ..
                    </div>
                    <div id="mainNewsIcon">
                        <img src="images/scripticontest.png" alt="">
                    </div>
                    <div id="mainNewsPostTitle">
                        ....
                    </div>
                    <div id="mainNewsPost">
                        ..
                    </div>
                    <div id="mainNewsIcon">
                        <img src="images/scripticontest.png" alt="">
                    </div>
                    <div id="mainNewsPostTitle">
                        ....
                    </div>
                    <div id="mainNewsPost">
                        ..
                    </div>
                    <div id="mainNewsIcon">
                        <img src="images/scripticontest.png" alt="">
                    </div>
                    <div id="mainNewsPostTitle">
                        ....
                    </div>
                    <div id="mainNewsPost">
                        ..
                    </div>
                    <div id="mainNewsIcon">
                        <img src="images/scripticontest.png" alt="">
                    </div>
                    <div id="mainNewsPostTitle">
                        ....
                    </div>
                    <div id="mainNewsPost">
                        ..
                    </div><div id="mainNewsIcon">
                        <img src="images/scripticontest.png" alt="">
                    </div>
                    <div id="mainNewsPostTitle">
                        ....
                    </div>
                    <div id="mainNewsPost">
                        ..
                    </div>


                </div>






                <!--<div id="mainUpdatesPost">
                    ..
                </div>
                <div id="mainUpdatesPost">
                    ..
                </div>
                <div id="mainUpdatesPost">
                    ..
                </div>
                <div id="mainUpdatesPost">
                    ..
                </div>-->
            </div>
        </div>

    </div>
</div>


