<?php
require_once 'common.php';
require_once 'dbfuncs.php';
if($_REQUEST['username'])
$username = $_REQUEST['username'];
else
$username = $_SESSION['username'];
$user_role = $_REQUEST['role']?:$_SESSION['role'];

if(!empty($_SESSION['authed']) && $_SESSION['authed'] === true) {
    if(!empty($username)) {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if(!empty($_REQUEST['firstname']) && !empty($_REQUEST['surname'])
                && !empty($_REQUEST['email'])) {

                if(empty($_REQUEST['role']))
                    $_REQUEST['role'] = $_SESSION['role'];

                echo $updateSQL = "update users set firstname = '" . $_REQUEST['firstname']
                            . "', surname = '" . $_REQUEST['surname'] . "', email='" .
                            $_REQUEST['email'] . "', role = '" . $_REQUEST['role'] 
                            . "' where username = '" .  $username ."'";

                $updated = insertQuery($updateSQL, true);
                if($updated === false) {
                    echo 'Unable to update your profile.';
                }
                else {
                    echo 'Details updated! Excellent.';
                }
            }
        }
        else {
            echo $userSQL  = "select email, firstname, surname, role from users where username = '" .  $username ."'";
            $userList = getSelect($userSQL);

            if(empty($userList) && is_array($userList)) {
                die('Unable to retrieve your settings. Doh!');
            }
            $user = $userList[0];
        ?>
        <div class="container">
        <form method="POST" class="col-md-6">
            <p style="font-weight: bold;font-size: 18px;">Edit Profile</p>
            <div class="form-group">
            <label for="firstname">First Name:</label>
            <input class="form-control" name="firstname" id="firstname" value="<?=$user[1]?>" /> 
            </div>
             <div class="form-group">
            <label for="surname">Last Name:</label>
            <input class="form-control" name="surname" id="surname" value="<?=$user[2]?>" /> <br />
            </div>
            <div class="form-group">
            <label for="email">Email:</label>
            <input name="email" class="form-control" id="email" value="<?=$user[0]?>" /> <br />
            <label for="email">Role:</label>
            <input name="role" class="form-control" id="role" value="<?=$user[3]?>" <?php if($user_role != 'admin'){ echo 'disabled';}?>/> <br />
            <input type="submit" class="btn-primary form-control" value="Update profile">
        </form>
        </div>
        <?php
        }
    }
}
else {
    header('location: /BuggyBee/login.php');
    die;
}