<?php
session_start(); // Start your sessions to allow your page to interact with session variables
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Forum Series - View Categories</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

<div id="wrapper">

    <?php
    // Check to see if the person accessing this page is logged in
    if (!isset($_SESSION['u'])) {
        echo "<form action='login_parse.php' method='post'>
	Username: <input type='text' name='username' />&nbsp;
	Password: <input type='password' name='password' />&nbsp;
	<input type='submit' name='submit' value='Log In' />
	";
    } else {
        echo "<p>You are logged is as ".$_SESSION['username']." &bull; <a href='logout_parse.php'>Logout</a>";
    }
    ?>

    <hr />
    <div id="content">
        <?php
        // Connect to the database
        include_once("./inc/connect.inc.php");

        // Function that will count how many replies each topic has
        function topic_replies($cid, $tid) {
            $sql = "SELECT count(*) AS topic_replies FROM posts WHERE category_id='".$cid."' AND topic_id='".$tid."'";
            $result = mysqli_query($sql) or die(mysqli_error());
            $row = mysqli_fetch_assoc($result);
            return $row['topic_replies'] - 1;
        }
        // Function that will convert a user id into their username
        function getusername($uid) {
            $sql = "SELECT username FROM users WHERE id='".$uid."' LIMIT 1";
            $result = mysqli_query($sql) or die(mysqli_error());
            $row = mysqli_fetch_assoc($result);
            return $row['username'];
        }
        // Function that will convert the datetime string from the database into a user-friendly format
        function convertdate($date) {
            $date = strtotime($date);
            return date("M j, Y g:ia", $date);
        }

        // Assign local variables
        $cid = $_GET['cid'];

        // Check to see if the person accessing this page is logged in
        if (isset($_SESSION['u'])) {
            $logged = " | <a href='create_topic.php?cid=".$cid."'>Click Here To Create A Topic</a>";
        } else {
            $logged = " | Please log in to create topics in this forum.";
        }
        // Query that checks to see if the category specified in the $cid variable actually exists in the database
        $sql = "SELECT id FROM categories WHERE id='".$cid."' LIMIT 1";
        // Execute the SELECT query
        die(mysqli_error($con)) or $result = mysqli_query($sql);
        // Check if the category exists
        if (mysqli_num_rows($result) == 1) {
            // Select the topics that are associated with this category id and order by the topic_reply_date
            $sql2 = "SELECT * FROM topics WHERE category_id='".$cid."' ORDER BY topic_reply_date DESC";
            // Execute the SELECT query
            $res2 = mysqli_query($sql2) or die(mysqli_error());
            // Check to see if there are topics in the category
            if (mysqli_num_rows($res2) > 0) {
                // Appending table data to the $topics variable for output on the page
                $topics .= "<table width='100%' style='border-collapse: collapse;'>";
                $topics .= "<tr><td colspan='4'><a href='index.php'>Return To Forum Index</a>".$logged."<hr /></td></tr>";
                $topics .= "<tr style='background-color: #dddddd;'><td>Topic Title</td><td width='65' align='center'>Last User</td><td width='65' align='center'>Replies</td><td width='65' align='center'>Views</td></tr>";
                $topic .= "<tr><td colspan='4'><hr /></td><tr>";
                // Fetching topic data from the database
                while ($row = mysqli_fetch_assoc($res2)) {
                    // Assign local variables from the database data
                    $tid = $row['id'];
                    $title = $row['topic_title'];
                    $views = $row['topic_views'];
                    $date = $row['topic_date'];
                    $creator = $row['topic_creator'];
                    // Check to see if the topic has every been replied to
                    if ($row['topic_last_user'] == "") { $last_user = "N/A"; } else { $last_user = getusername($row['topic_last_user']); }
                    // Append the actual topic data to the $topics variable
                    $topics .= "<tr><td><a href='view_topic.php?cid=".$cid."&tid=".$tid."'>".$title."</a><br /><span class='post_info'>Posted by: ".getusername($creator)." on ".convertdate($date)."</span></td><td align='center'>".$last_user."</td><td align='center'>".topic_replies($cid, $tid)."</td><td align='center'>".$views."</td></tr>";
                    $topics .= "<tr><td colspan='4'><hr /></td></tr>";
                }
                $topics .= "</table>";
                // Displaying the $topics variable on the page
                echo $topics;
            } else {
                // If there are no topics
                echo "<a href='index.php'>Return To Forum Index</a><hr />";
                echo "<p>There are no topics in this category yet.".$logged."</p>";
            }
        } else {
            // If the category does not exist
            echo "<a href='index.php'>Return To Forum Index</a><hr />";
            echo "<p>You are trying to view a category that does not exist yet.";
        }
        ?>
    </div>
</div>

</body>
</html>