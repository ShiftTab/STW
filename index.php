<?php include ( "./inc/header.inc.php" ); ?>
<?php
    $reg =@$_POST['reg'];
    //declaring variables to prevent errors
    $fn = ""; //Forename
    $sn = ""; //Surname
    $un = ""; //Username
    $em = ""; //Email
    $em2 =""; //Email 2
    $pswd =""; //Password
    $pswd2 = ""; //Password 2
    $d = ""; // Sign up date
    $u_check = ""; //Check if username exists
    //Registration form
    $fn = strip_tags(@$_POST['fname']);
    $sn = strip_tags(@$_POST['sname']);
    $un = strip_tags(@$_POST['username']);
    $em = strip_tags(@$_POST['email']);
    $em2 = strip_tags(@$_POST['email2']);
    $pswd = strip_tags(@$_POST['password']);
    $pswd2 = strip_tags(@$_POST['password2']);
    $d = date("Y-m-d"); // Year - Month - Day

    if($reg) {
    if($em == $em2) {
    $u_check = ("SELECT username FROM users WHERE username='$un'");
    $run_check = mysqli_query($con, $u_check);
    $check = mysqli_num_rows($run_check);
    if ($check == 0) {
    // Check all of the fields have been filled in
    if ($fn&&$sn&&$un&&$em&&$em2&&$pswd&&$pswd2) {
    // Check that passwords match
    if ($pswd==$pswd2) {
    // Check the maximum length of username/forename/surname does not exceed 25 characters
    if (strlen($un)>25||strlen($fn)>25||strlen($sn)>25) {
    echo "The maximum limit for username/forename/surname is 25 characters!";
    }
    else
    {
    // Check the maximum length of password does not exceed 25 characters and is not less than 5 characters
    if (strlen($pswd)>30||strlen($pswd)<5) {
    echo "You password must be between 5 and 30 characters long!";
    }
    else
    {
    // Encrypt password and password 2 using md5 before sending to database
    $pswd = md5($pswd);
    $pswd2 = md5($pswd2);
    $query = mysqli_query($con, "INSERT INTO users VALUES ('','$un','$fn','$sn','$em','$pswd','$d','0')");
    die("<h2>Welcome to Ghost-Squad</h2>Login to your account to get started ...");
    }
    }
    }
    else {
    echo "Your passwords don't match!";
    }
    }
    else
    {
    echo "Please fill in all of the fields";
    }
    }
    else
    {
    echo "Username already taken ...";
    }
    }
    else {
    echo "Your E-mails don't match!";
    }
    }

    // User Login Code

    if (isset($_POST["user_login"]) && isset($_POST["password_login"])) {
    $user_login = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["user_login"]);  //filters everything except numbers and letters
    $password_login = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password_login"]); //filters everything except numbers and letters

    $password_login_md5 = md5($password_login);
    $sql = ("SELECT id FROM users WHERE username='$user_login' AND password= '$password_login_md5' LIMIT 1");  //selects username = to user in db and password = to password in db if one returned code continues
    //Check for their existance
 
    $runCount = mysqli_query($con, $sql);
    $userCount = mysqli_num_rows($runCount); //Count the number of rows returned
     
      //$checkUser = mysqli_num_rows($userCount);
      
    if ($userCount == 1) {
    while($row = mysqli_fetch_array($sql)){
      $id = $row["id"];
    }
    $_SESSION["user_login"] =  $user_login;
    header("location: home.php");
    exit();
    } else {
    echo 'That information is incorrect, try again';
    exit();
    }
    }

?>

<div id="indexContainerWrapper">
    <div id="weeklyContainer">
   <div id="header_weekly">
    <h2>Testing...</h2>
    </div>
    <div id="container_weekly">
        test
    <!--<div class="containerForgottenPassword">
        <a href="#">Forgotten password?</a>
    </div>-->
</div>
</div>
<div id="signupContainer">
<div id="header_signup">
<h2>Sign up today it's Free!</h2>
</div>
    <div id="container_signup">
        <table>
            <tr>
    			<td width="40%" valign="top">
    				<form action="index.php" method="POST">
    					<input type="text" name="fname" size="25" placeholder="Forename" /><br /><br />
    					<input type="text" name="sname" size="25" placeholder="Surname" /><br /><br />
    					<input type="text" name="username" size="25" placeholder="Username" /><br /><br />
    					<input type="text" name="email" size="25" placeholder="Email Address" /><br /><br />
    					<input type="text" name="email2" size="25" placeholder="Email Address (again)" /><br /><br />
    					<input type="text" name="password" size="25" placeholder="Password" /><br /><br />
    					<input type="text" name="password2" size="25" placeholder="Password (again)" /><br /><br />
    					<input type="submit" name="reg" value="Sign Up!" />
    				</form>
    			</td>
    		</tr>
    </table>
</div>
</div>
</div>
<?php include ( "./inc/footer.inc.php" ); ?>