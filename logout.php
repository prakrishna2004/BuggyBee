<?php
session_start();
session_destroy();
//unset($_SESSION);
header('location: /BuggyBee/login.php?message=signout');