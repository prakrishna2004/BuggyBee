<?php
require_once 'common.php';
require_once 'dbfuncs.php';
include 'header.php';

$getUser = $_REQUEST["username"];
$getId    = $_REQUEST["id"];
$user_role = $_REQUEST['role']?:$_SESSION['role'];
$username = $_POST['username']?:$_SESSION['username'];

// ' UNION SELECT 1,1,1,1,LOAD_FILE('/etc/passwd'),'1

if(!empty($username)) {
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
if(!empty($_SESSION['authed']) && $_SESSION['authed'] === true && $user_role == 'admin') {
   
   //Get Users List
   $user_query = "SELECT * FROM users";
   $user_info = getSelect($user_query); 
?>
<div class="row">
<div class="col-md-10">
 <form action="/BuggyBee/index.php?<?php echo 'username='.$username.'&role='.$user_role;?>" method="post" name="user-search" class="col-md-6">
         <div class="form-group">
            <label>Users</label>
       
                <select name="username" class="form-control">
                    <option value="">[Select User]</option>
                    <?php
                        foreach ($user_info as $user) {
                            ?>
                            <option value="<?php echo $user[1];?>" <?php if($username == $user[1]) echo "selected";?>><?php echo $user[1];?></option>
                            <?php
                        }
                    ?>
                </select>
                </div>
                <br>
           
    
    <button class="btn-primary form-control" type="submit">Search</button>
 </form>
</div>
</div>
<?php include 'footer.php'; ?>
<!-- <table class="table table-hover"> -->
<?php
    echo "<table class='table table-hover' id='users' style='width:50%;padding:15px;margin:15px'>";
    foreach($results as $row) {
        echo "<br><p style='margin:20px'>User found<p><br>";
        echo "<thead><tr><th>Id</th><th>Username</th><th>Password</th><th>Firstname</th><th>Lastname</th><th>Email</th></tr></thead>";
        echo "<tbody<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td></tr></tbody>";
        // echo "<b>Id:</b> " . $row[0] . "<br>";
        // echo "<b>Username: </b>" . $row[1] . "<br>";
        // echo "<b>Password: </b>" . $row[2] . "<br>";
        // echo "<b>Firstname: </b>" . $row[3] . "<br>";
        // echo "<b>Lastname: </b>" . $row[4] . "<br>";
        // echo "<b>Email: </b>" . $row[5] . "<br>";
    }
    echo "</table>";
//<!-- </table> -->
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
