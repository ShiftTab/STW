<?php include ( "./inc/header.inc.php" ); ?>
<div id="content">
<?php
include_once("./inc/connect.inc.php");
$result = mysqli_query ($con, "SELECT * FROM categories ORDER BY category_title ASC");
$categories = "";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)){
        $id = $row['id'];
        $title = $row['category_title'];
        $description = $row['category_description'];
        $categories .= "<a href='#' class='cat_links'>".$title." - <font size'-1'>".$description."</font></a>";
    }
} else {
    echo "<p>There are no categories available yet.</p>";
}

?>
</div>