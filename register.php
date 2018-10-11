<?php
require_once 'common.php';
require_once 'dbfuncs.php';
require_once 'header.php';

if($_POST['btn_register'] == 'btn_register')
{
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $register_query = "INSERT INTO users(username, password,  firstname, surname, email) VALUES('".$username."', '".$password."',  '".$firstname."', '".$lastname."', '".$email."')";
    $result = insertQuery($register_query);

    if($result)
      header('location:login.php?message=success');
}
?>
<div class="container">
  <h2>Register</h2>
  <form class="col-md-6" method="post">
    <div class="form-group">
      <label for="username">User Name:</label>
      <input type="text" class="form-control" id="username" placeholder="Enter user name" name="username">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
     <div class="form-group">
      <label for="firstname">First Name:</label>
      <input type="text" class="form-control" id="firstname" placeholder="Enter Firstname" name="firstname">
    </div>
    <div class="form-group">
      <label for="lastname">Last Name:</label>
      <input type="text" class="form-control" id="lastname" placeholder="Enter Lastname" name="lastname">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
    </div>
    
    <button type="submit" name="btn_register" value="btn_register" class="btn btn-primary">Submit</button>
  </form>
</div>
<?php include 'footer.php'; ?>