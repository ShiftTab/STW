<?php include ( "./inc/header.inc.php" ); ?>
<div id="content">

<div id="subNavWrapper">
    <ul class="subNav">
        <li><?php echo " Would you like to logout $username? <a href='logout.php'>Logout</a>";?></li>
    </ul>
</div>

<div id="mainWrapper">
    <div id="alertBar">
        <p>This website is currently under development!</p>
    </div>

<?php
$result = mysqli_query ($con, "SELECT * FROM categories ORDER BY category_title ASC");
$categories = "";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Assign local variables from each field in the categories table
        $id = $row['id'];
        $title = $row['category_title'];
        $description = $row['category_description'];
        // Append the data from the categories table into a list of links
        $categories .= "<a href='view_category.php?cid=".$id."' class='cat_links'>".$title." - <font size='-1'>".$description."</font></a>";
    }
    // Display list of links
    echo $categories;
} else {
    // If there are is no data in the categories table
    echo "<p>There are no categories available yet.</p>";
}

?>
    </div>
</div>