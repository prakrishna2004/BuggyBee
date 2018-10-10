<?php
require_once 'common.php';
require_once 'dbfuncs.php';
include 'header.php';

$getUser = $_REQUEST["username"];
$getId    = $_REQUEST["id"];
$user_role = $_SESSION['role'];
$username = $_POST['userid'];
// ' UNION SELECT 1,1,1,1,LOAD_FILE('/etc/passwd'),'1

if(!empty($getUser)) {
	$query   = "select * from users where username = '" . $username . "'";
	$results = getSelect($query);
}
elseif(!empty($getId)) {
	$query   = "select * from users where id = " . $getId;
	$results = getSelect($query);
}

//echo $query . "<br>";

if(!$results) {
    echo "Unable to find users: " . $username;
}
if(!empty($_SESSION['authed']) && $_SESSION['authed'] === true && $_GET['role'] == 'admin') {
   
   //Get Users List
   $user_query = "SELECT * FROM users";
   $user_info = getSelect($user_query); 
?>
<div class="row">
<div class="col-md-10">
<table>
    <tr>
        <td>
            Users
        </td>
        <td>
            <form action="/BuggyBee/index.php?<?php echo 'username='.$username.'&role='.$user_role;?>" method="post" name="user-search">
                <select name="userid">
                    <option value="">[Select User]</option>
                    <?php
                        foreach ($user_info as $user) {
                            ?>
                            <option value="<?php echo $user[1];?>" <?php if($username == $user[1]) echo "selected";?>><?php echo $user[1];?></option>
                            <?php
                        }
                    ?>
                </select>
                <button type="submit">Search</button>
            </form>
        </td>
    </tr>
</table>
</div>
</div>
<?php include 'footer.php'; ?>
<?php
    foreach($results as $row) {
        echo "User found: <br>";
        echo "<b>Id:</b> " . $row[0] . "<br>";
        echo "<b>Username: </b>" . $row[1] . "<br>";
        echo "<b>Password: </b>" . $row[2] . "<br>";
        echo "<b>Firstname: </b>" . $row[3] . "<br>";
        echo "<b>Lastname: </b>" . $row[4] . "<br>";
        echo "<b>Email: </b>" . $row[5] . "<br>";
    }
}
else if(empty($_SESSION['authed']))
{
    header('location: /BuggyBee/login.php');
    die;
}
else
{
    echo "<h3 style='color:red'>You donot have permissions to access this page.</h3>";
}
