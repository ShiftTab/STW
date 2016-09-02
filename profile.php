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
        <div id="profileContentWrapper">
            <div id="alertBar">
                <p>This website is currently under development!</p>
            </div>
            <div id="profileImageContentContainer">
                <div id="profileImageHeader">
                    <h2><?php echo $username ?>'s Profile</h2>
                </div>
                <div id="profileImageContent">
                    <img src="images/default_pic.png" alt="" width="200" height="200">
                </div>
            </div>
            <div id="profileDescContainer">
                <div id="profileDescHeader">
                    <h2><?php echo $username ?>'s description</h2>
                </div>
                <div id="descMainContent">
                    <?php
                    $about_query = mysqli_query($con, "SELECT bio FROM users WHERE username='$username'");
                    $get_result = mysqli_fetch_assoc($about_query);
                    $about_the_user = $get_result['bio'];

                    echo $about_the_user;
                    ?>
                </div>
            </div>
            <div id="profileSideContainer">
                <div id="profileSideContent">

                </div>
            </div>
            <div id="profilePostsContainer">
                <div id="postsMainContent">

                </div>
            </div>
        </div>
    </div>
</div>
