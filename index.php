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
    if (strlen($un)>20||strlen($fn)>25||strlen($sn)>25) {
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
    die("<h2>Welcome to Shift-Tab</h2>Login to your account to get started ...");
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
    header("location: profile.php");
    exit();
    } else {
    echo 'That information is incorrect, try again';
    exit();
    }
    }

?>

<div id="subNavWrapper">
    <ul class="subNav">
        <li><a href="#">Login</a></li> or <li><a href="#">Signup</a></li>
    </ul>
</div>

<div id="mainWrapper">
    <div id="indexContentWrapper">
    <div id="alertBar">
        <p>This website is currently under development!</p>
    </div>
        <!--<div id="logoMain">
        <img src="images/hexacraft.png" alt="">
    </div>-->
        <div id="loginMainContainer">
            <div id="loginMainHeader">
                <h2>Login:</h2>
            </div>
            <div id="loginMainContent">
                <div id="loginMainForm">
                <table>
                    <tr>
                        <td width="40%" valign="top">
                            <form action="index.php" method="POST">
                                <input type="text" name="user_login" size="25" placeholder="Username" /><br /><br />
                                <input type="password" name="password_login" size="25" placeholder="Password" /><br /><br />
                                <input type="submit" name="login" value="Login!" />
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="containerForgottenPassword">
                <a href="#">Forgotten password?</a>
            </div>
        </div>
        </div>
        <div id="mainUpdatesContainer">
            <div id="mainUpdatesHeader">
                <h2>Recent Updates:</h2>
            </div>
            <div id="mainUpdatesContent">




                <div id="mainUpdatesPostContainer">
                <div id="mainUpdatesPostIcon">
                    <img src="images/scripticontest.png" alt="">
                </div>
                <div id="mainUpdatesPost">
                    ..
                </div>
                <div id="mainUpdatesPostIcon">
                    <img src="images/scripticontest.png" alt="">
                </div>
                <div id="mainUpdatesPost">
                    ..
                </div>
                <div id="mainUpdatesPostIcon">
                    <img src="images/scripticontest.png" alt="">
                </div>
                <div id="mainUpdatesPost">
                    ..
                </div>
                <div id="mainUpdatesPostIcon">
                    <img src="images/scripticontest.png" alt="">
                </div>
                <div id="mainUpdatesPost">
                    ..
                </div>
                <div id="mainUpdatesPostIcon">
                    <img src="images/scripticontest.png" alt="">
                </div>
                <div id="mainUpdatesPost">
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
