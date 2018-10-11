<?php
require_once 'common.php';
require_once 'dbfuncs.php';

if(!empty($_SESSION['authed']) && $_SESSION['authed'] === true) {
    if(!empty($_SESSION['userid'])) {
        $msgSQL = "select * from messages where user_id = " .
                    $_SESSION['userid'];
        $messages = getSelect($msgSQL);
        echo "<div class='container'>";
        echo "<p>Here are messages people have sent you!</p>";
        echo "<table class ='table table-hover' width='50%'>";
        echo "<thead><th>Subject</th><th>Message</th></thead>";
        if(!empty($messages) && is_array($messages)) {
            foreach($messages as $message) {
                echo "<tr><td>" . $message[2] . "</td><td>" . $message[3] .
                "</td></tr>";
            }
        }
        echo "</table>";
        echo "</div>";
    }
}
else {
    header('location: /BuggyBee/login.php');
    die;
}
