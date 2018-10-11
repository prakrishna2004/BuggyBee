<!DOCTYPE html>
<html>
<head>
    <title>Buggy Bee</title>
    <style type="text/css">
        a{
         text-decoration: none !important;
         color: #000 !important;
        }
        a:visited{
        text-decoration: none;
        }
        a.style-nav{
         color: #ffffff !important;
         text-decoration: none !important;
        }
         a.style-nav:active{
         color: #000000 !important;/*#c7c0c0*/ 
         background-color: #c7c0c0 !important;
        }
        .bg-nav{
         padding-top: 10px;
         background-color: #282833;
         height: 50px;
        }
        label,input{
         color: #000000 !important;   
        }
        h4,h3,h2,h5,h6,p{
         color:  #000000;
        }
        .btn-primary{
          color: #ffffff!important;  
        }
        td tr{
         color: #000000!important;
        }
        #users th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #004080;
        color: white;
        }
        #users td, #users th {
    border: 1px solid #ddd;
    padding: 8px;
}

#users tr:nth-child(even){background-color: #f2f2f2;}

#users tr:hover {background-color: #ddd;}
a:link {
    text-decoration: none;
}

a:visited {
    text-decoration: none;
}
    </style>
</head>
<body>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php
error_reporting(0);
session_start();
// error_reporting(E_ALL);
$root_folder = "/BuggyBee";
$user_role = $_REQUEST['role']?:$_SESSION['role'];
$username = $_POST['username']?:$_SESSION['username'];
if($_REQUEST['sess_id'])
{
    $sess_id = $_REQUEST['sess_id'];
    session_id($sess_id);
}
else
$sess_id = session_id();
$links = array(
                'Register' => $root_folder.'/register.php',
                'Manage Users' => $root_folder.'/index.php?sess_id='.$sess_id.'&username='.$username.'&role='.$user_role,
                'Login' => $root_folder.'/login.php', 
                'Send Message' => $root_folder.'/sendmessage.php?sess_id='.$sess_id, 
                'View Messages' => $root_folder.'/messages.php?sess_id='.$sess_id, 
                'Edit Profile' => $root_folder.'/editprofile.php?sess_id='.$sess_id,
		'Logout' => $root_folder.'/logout.php',
        'References' => $root_folder.'/references.html'
          );

echo "<div class='bg-nav'>";
foreach($links as $title => $link) {
    echo "<a class ='style-nav' href='" . $link . "'>" . $title . "<a> | ";
}

if(!empty($_SESSION['authed']) && $_SESSION['authed'] === true) {
   echo '<div style="float:right;display:inline;color:#fff ;font-weight:bold;">Logged in as: ' . $_SESSION['username'] . ' [' . $_SESSION['userid']
   . ']</div><br/><br/>';
}
echo "</div><br>";?>
