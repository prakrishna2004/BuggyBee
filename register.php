<?php
require_once 'common.php';
require_once 'dbfuncs.php';
require_once 'header.php';
?>
<div class="container">
  <h2>Register</h2>
  <form action="/action_page.php" class="col-md-6">
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
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
<?php include 'footer.php'; ?>