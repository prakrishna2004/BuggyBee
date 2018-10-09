<?php
error_reporting(E_ALL);
session_start();
$root_folder = "/testsite";
$user_role = $_SESSION['role'];
$links = array(
                'User Filter' => $root_folder.'/index.php?username=jared&role='.$user_role,
                'Login' => $root_folder.'/login.php', 
                'Send Message' => $root_folder.'/sendmessage.php', 
                'View Messages' => $root_folder.'/messages.php', 
                'Edit Profile' => $root_folder.'/editprofile.php',
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
