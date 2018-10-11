<?php
session_start();
error_reporting(E_ALL);
$root_folder = "/BuggyBee";
$user_role = $_REQUEST['role']?:$_SESSION['role'];
$username = $_REQUEST['username']?:$_SESSION['username'];
if($_REQUEST['sess_id'])
{
    $sess_id = $_REQUEST['sess_id'];
    session_id($sess_id);
}
else
$sess_id = session_id();
$links = array(
                'User Filter' => $root_folder.'/index.php?sess_id='.$sess_id.'&username='.$username.'&role='.$user_role,
                'Login' => $root_folder.'/login.php', 
                'Send Message' => $root_folder.'/sendmessage.php?sess_id='.$sess_id, 
                'View Messages' => $root_folder.'/messages.php?sess_id='.$sess_id, 
                'Edit Profile' => $root_folder.'/editprofile.php?sess_id='.$sess_id,
		'Logout' => $root_folder.'/logout.php'
          );

if(!empty($_SESSION['authed']) && $_SESSION['authed'] === true) {
    echo 'Logged in as: ' . $_SESSION['username'] . ' [' . $_SESSION['userid']
    . ']<br/><br/>';
}
foreach($links as $title => $link) {
    echo "<a href='" . $link . "'>" . $title . "<a> | ";
}
echo "<br/><hr/>";
