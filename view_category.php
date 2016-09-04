<?php include ( "./inc/header.inc.php" ); ?>
<div id="content">

    <div id="subNavWrapper">
        <ul class="subNav">
            <li><?php echo " Would you like to logout $username? <a href='logout.php'>Logout</a>";?></li>
        </ul>
    </div>

    <div id="mainWrapper">
        <br />
        <br />
        <div id="alertBar">
            <p>This website is currently under development!</p>
        </div>

<?php
$cid = $_GET['cid'];

if (isset($_SESSION['u'])) {
    $logged = " | <a href='create_topic_php?cid=".$cid."'>Click Here To Create A Topic</a>";
} else {
    $logged = " | Please log in to create topics in this forum.";
}
$result = mysqli_query ($con, "SELECT id FROM categories WHERE id='".$cid."' LIMIT 1");
if (mysqli_num_rows($result) == 1) {
    $res2 = mysqli_query ($con, "SELECT * FROM topics WHERE category_id='".$cid."' ORDER BY topic_reply_date DESC");
    if (mysqli_num_rows($res2) > 0) {
        $topics .= "<table width='100%' style='border-collapse: collapse;'>";
        $topics .= "<tr><td colspan='3'><a href='forum.php'>Return to Forum Index</a><hr /></td></tr>";
        $topics .= "<tr style='background-color: #dddddd;'><td>Topic Title</td><td width='65' align='center'></td><td width='65' align='center'>Views</td>";
        $topics .= "<tr><td colspan='3'><hr /></td><tr>";
        while ($row = mysqli_fetch_assoc($res2)) {
            $tid = $row['id'];
            $title = $row['topic_title'];
            $views = $row['topic_views'];
            $date = $row['topic_date'];
            $username = $row['topic_creator'];
            $topics .= "<tr><td><a href='view_topic.php?cid=".$cid.".&tid=".$tid."'>".$title."</a><br /><span class='post_info'>Posted by: ".$username." on ".$date."</span></td><td align='center'>0</td><td align='center'>".$views."</td><tr>";
            $topics .= "<tr><td colspan='3'><hr /></td></tr>";
        }
        $topics .= "</table>";
    } else {
        echo "<a href='forum.php'>Return To Forum Index</a><hr />";
        echo "<p>There are no topics within this category yet.<p>";
    }
} else {
    echo "<a href='forum.php'>Return To Forum Index</a><hr />";
    echo "<p>You are trying to view a category that doesn't exist yet.";
}
?>

    </div>
</div>