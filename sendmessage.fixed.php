<?php
require_once 'common.php';
require_once 'dbfuncs.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {
    
    //fixed tags level 1
   $msg= strip_tags($_REQUEST['message']);
   $subject=strip_tags($_REQUEST['subject']);
    if(!empty($_REQUEST['user']) && !empty($_REQUEST['subject'])
        && !empty($_REQUEST['message'])) {
        // fixed code level 1
        $msgSQL = "insert into messages(user_id, subject, message) values('" . 
                    $_REQUEST['user'] . "','" . $subject . "','"
                    . $msg . "')";

        $inserted = insertQuery($msgSQL);
        if($inserted === false) {
            echo 'Unable to send message. Sorry.';
        }
        else {
            echo 'Message successfully sent! Hooray!';
        }
    }
}
if(!empty($_SESSION['authed']) && $_SESSION['authed'] === true)  {
    $userSQL  = "select id, firstname, surname from users";
    $userList = getSelect($userSQL);

    if(!$userList) die('Unable to retrieve users to message');
    $select = "<select name='user' id='user' class='form-control'>";
    foreach($userList as $user)
        $select .= "<option value='" . $user[0] . "'>" . $user[1]
        . " " . $user[2] . "</option>";
    $select .= "</select>";
?>
<div class="container">
<form method="POST" class="col-md-6">
    <p style="font-weight: bold;font-size: 18px;">Select a user you wish to message</p>
    <div class="form-group">
    <label for="user">User:</label>
    <?=$select?> <br/>
    </div>
    <div class="form-group">
    <label for="subject">Subject:</label>
    <input class="form-control" name="subject" id="subject" /> <br />
    </div>
    <div class="form-group">
    <label for="message">Message:</label>
    <textarea class="form-control" rows="10" cols="50" name="message"></textarea>
    </div>
    <input class="btn-primary form-control" type="submit" value="Send Message">
</form>
</div>
<?php
}
else {
    header('location: /BuggyBee/login.php');
    die;
}
?>