<?php
require_once 'common.php';
require_once 'dbfuncs.php';
require_once 'header.php';

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
<div class="container">
<form method="POST" class="col-md-6">
    <?php 
        if($_REQUEST['message'] == 'signout')
        {
            echo '<h4 style="color:red">You are successfully logged out.</h4>';
        }
        else if($_REQUEST['message'] == 'success')
        {
            echo '<h4 style="color:green">You are successfully regisered. Welcome to BuggyBee</h4>';
        }
    ?>
    <div class="form-group">
    <label for="username">Username</label>
    <input class="form-control" name="username" type="text" id="username" /> <br />
    </div>
    <div class="form-group">
    <label for="password">Password:</label>
    <input class="form-control" name="password" type="password" id="password" /> <br />
    </div>
    <input type="submit" class="btn-primary form-control" value="Login!">
</form>
</div>
<?php include 'footer.php'; ?>
<?php
}
else {
    header('location: /BuggyBee/editprofile.php?sess_id='.session_id());
    die;
}
?>
