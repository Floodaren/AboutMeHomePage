<h4 class="divH4">Sign up</h4>
<hr class="divHr">
<?php
/*
  This function is for the future when i want members to register themself on my homepage. 
  I've tried the function and i works. Just remove the comment signs and change the submitbutton from button->submit
  
  if (isset($_POST['submit']))
  {
    include 'databaseconnectionObject.php';
    $doesUserExsist = new dbManagement;
    $inputhotmail = $_POST['inputhotmail'];
    $inputpassword = $_POST['inputpassword'];
    $inputfname = $_POST['inputfname'];
    $inputlname = $_POST['inputlname'];
    $errorMessage = $doesUserExsist->checkIfMembersExist($inputhotmail,$inputpassword,$inputfname,$inputlname);
    echo $errorMessage;
  } 
*/
?>
<form class="form-horizontal" method="post" id="signUpForm">
  <fieldset>
    <div class="alert alert-dismissible alert-warning" id="signUpWarningID">
  <h4>Warning!</h4>
  <p>We are not accepting new members at this moment. Check in another time</p>
</div>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label signupClass">Email</label>
      <div class="col-lg-10">
        <input type="text" class="form-control form-control-index" id="inputEmail" placeholder="Email" name="inputhotmail">
        <span id="email_status"></span>
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label signupClass">Password</label>
      <div class="col-lg-10">
        <input type="password" class="form-control form-control-index" id="inputPassword" placeholder="Password" name="inputpassword">
      </div>
    </div>
    <div class="form-group">
      <label for="inputFirstname" class="col-lg-2 control-label signupClass">First name</label>
      <div class="col-lg-10">
        <input type="text" class="form-control form-control-index" id="inputFirstname" placeholder="First name" name="inputfname">
      </div>
    </div>
    <div class="form-group">
      <label for="inputLastname" class="col-lg-2 control-label signupClass">Last name</label>
      <div class="col-lg-10">
        <input type="text" class="form-control form-control-index" id="inputLastname" placeholder="Last name" name="inputlname">
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2" id="signUpSubmitCancel">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button type="button" class="btn btn-primary" name="submit">Submit</button>
      </div>
    </div>
  </fieldset>
</form>
