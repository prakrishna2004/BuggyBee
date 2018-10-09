<?php
require_once 'common.php';
require_once 'dbfuncs.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(!empty($_REQUEST['username']) && !empty($_REQUEST['password'])) {
        $authSQL = "select * from users where username = '" . $_REQUEST['username'] .
           "' and password = '" . $_REQUEST['password'] . "'"; 
        $authed = getSelect($authSQL);

        if(!$authed) {
            echo 'Invalid login.<br>';
            echo 'SQL Used: ' . $authSQL;
            die;
        }
        else {
            echo 'Success, you authed! <br>';
            echo 'SQL Used: ' . $authSQL;
            $_SESSION['authed'] = true;
            $_SESSION['userid'] = $authed[0][0];
            $_SESSION['username'] = $authed[0][1];
            $_SESSION['role'] = $authed[0][6];
            $_SESSION['user_info'] = $authed[0];
        }
    }
}

if(empty($_SESSION['authed'])){
?>
<form method="POST">
    <?php 
            if($_REQUEST['message'] == 'signout')
            {
                echo '<h4 style="color:red">You are successfully logged out.</h4>';
            }
    ?>
    <label for="username">username:</label>
    <input name="username" id="username" /> <br />
    <label for="password">password:</label>
    <input name="password" id="password" /> <br />
    <input type="submit" value="Login!">
</form>
<?php
}
else {
    header('location: /testsite/editprofile.php');
    die;
}
?>
