<?php
require_once 'common.php';
require_once 'consts.php';

$con = null;
function connect()
{
    global $con;
    $con = mysql_connect(DB_HOST, DB_USER, DB_PASS);

    if(!$con)
        die("Unable to connect to: " . DB_USER . ":" . DB_PASS . "@" . DB_HOST . ". Error: " . mysql_error());

    selectDb();
}

function selectDb()
{
    global $con;
    if($con !== null)
        mysql_select_db(DB_DB, $con);
}

function getSelect($query)
{
    global $con;
    if($con === null)
        connect();

    if(is_resource($con)) {
        $result = mysql_query($query, $con);
        if($result !== null && is_resource($result)) {
            $rows = array();
            while($row = mysql_fetch_row($result)) {
                $rows[] = $row;
            }
            return $rows;
        }
    }
}

function insertQuery($query, $update = false)
{
    global $con;
    if($con === null)
        connect();

    if(is_resource($con)) {
        $result = mysql_query($query, $con);
        if($result !== true) {
            return false;
        }

        return ($update === false) ? true : mysql_insert_id();
    }
}

/* 
function insertPreparedQuery($firstName, $surname, $email)
{
//$stmt = $conn->prepare("SELECT * FROM `users` WHERE `email`=:email AND `password` = :password");
$stmt = $conn->prepare("update users set firstname= '" . :firstName . "', surname = '" . :surName . "', email='" . :eMail . "' where username = '" . :userName ."'"; 
$stmt->bindValue(':firstName', $firstName);
$stmt->bindValue(':surName', $surname);
$stmt->bindValue(':eMail', $email);
//$stmt->bindValue(':password', $_POST["password"]);
return $stmt->execute();
}
*/
