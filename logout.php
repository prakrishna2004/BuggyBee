<?php
session_start();
session_destroy();
//unset($_SESSION);
header('location: /testsite/login.php?message=signout');