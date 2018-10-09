<?php
require_once 'common.php';
require_once 'dbfuncs.php';
if($_REQUEST['username'])
$username = $_REQUEST['username'];
else
$username = $_SESSION['username'];

if(!empty($_SESSION['authed']) && $_SESSION['authed'] === true) {
    if(!empty($username)) {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if(!empty($_REQUEST['firstname']) && !empty($_REQUEST['surname'])
                && !empty($_REQUEST['email'])) {

                echo $updateSQL = "update users set firstname = '" . $_REQUEST['firstname']
                            . "', surname = '" . $_REQUEST['surname'] . "', email='" .
                            $_REQUEST['email'] . "' where username = '" .  $username ."'";

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
            echo $userSQL  = "select email, firstname, surname from users where username = '" .  $username ."'";
            $userList = getSelect($userSQL);

            if(empty($userList) && is_array($userList)) {
                die('Unable to retrieve your settings. Doh!');
            }
            $user = $userList[0];
        ?>
        <form method="POST">
            <p>Edit your settings</p>
            <label for="firstname">Firstname:</label>
            <input name="firstname" id="firstname" value="<?=$user[1]?>" /> <br />
            <label for="surname">Surname:</label>
            <input name="surname" id="surname" value="<?=$user[2]?>" /> <br />
            <label for="email">Email:</label>
            <input name="email" id="email" value="<?=$user[0]?>" /> <br />
            <input type="submit" value="Update profile">
        </form>
        <?php
        }
    }
}
else {
    header('location: /testsite/login.php');
    die;
}