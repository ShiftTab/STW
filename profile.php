<?php include ( "./inc/header.inc.php" ); ?>
<div id="subNavWrapper">
    <ul class="subNav">
        <li><?php echo " Would you like to logout $username? <a href='logout.php'>Logout</a>";?></li>
    </ul>
</div>
<?php
if (isset($_GET['u'])) {
    $username = mysqli_real_escape_string($db, $_GET['u']);
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
                    <h2><?php echo $username ?>'s Description</h2>
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
                    <?php
                    $getposts = mysqli_query($con, "SELECT * FROM posts WHERE user_posted_to='$username' ORDER BY id DESC LIMIT 10") or die(mysqli_error());
                    while($row = mysqli_fetch_assoc($getposts)) {
                        $id = $row['id'];
                        $body = $row['body'];
                        $date_added = $row['date_added'];
                        $added_by = $row['added_by'];
                        $user_posted_to = $row['user_posted_to'];
                        echo "<div style='padding: 10px;'><div class='posted_by'><a href='$added_by'><img src='images/default_pic.png' height='50' style='border: 1px solid #1470FF; float: left; margin-right: 10px;'>$added_by</a> - $date_added</div><br />$body<hr></div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
