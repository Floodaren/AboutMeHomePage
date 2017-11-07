<?php
include 'databaseconnection.php';
?>
<?php 
  if (isset($_POST['login']))
  {
    $hotmail = $_POST['hotmail'];
    $password = $_POST['password'];
    $foundhotmail = 0;
    $sql = "SELECT hotmail, password FROM users";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0)
    {
      while ($row = mysqli_fetch_assoc($result))
      {
        if ($hotmail == $row['hotmail'] && $password == $row['password'])
        {
          $foundhotmail = 1;
        }
      }
    }
    if ($foundhotmail == 1)
    {
      $_SESSION["logInId"] = $hotmail;
      $cookie_name = "Admin";
      $cookie_value = $hotmail;
      setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
      header("Refresh: 0");
    }
    else 
    {
    echo "<div class='alert alert-dismissible alert-danger' id='logInWarning' onclick='removeLogInMessage()'>
      <strong>Either you entered an invalid login-input or you are not registered. Please try again!</strong><br><a href='#' id='warningLink'>(Press here to remove this message)</a></div>";
    }
  }
?>

<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
  <div class="container-fluid" style="padding: 0;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" id="navBarBrand" href="#pictureOfMeDiv">Nicholas portfolio</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#pictureOfMeDiv">Home</a></li>
        <li><a href="#aboutMeDiv">About me</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Navigate <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
          <li><a href="#uploadedFilesDiv">My files</a></li>
            <li><a href="#cvDiv">Curriculum vitae</a></li>
            <li class="divider"></li>
            <li><a href="#signUpDiv">Sign up</a></li>
            <li><a href="#footer">Contact</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right" style="margin-right: 1%;">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret" style="margin-right: 5px;"></span></a>
      <ul id="login-dp" class="dropdown-menu">
        <li>
           <div class="row">
              <div class="col-md-12">
                 <form class="form" method="post" accept-charset="UTF-8" id="login-nav">
                    <div class="form-group">
                       <label class="sr-only" for="exampleInputEmail2">Email address</label>
                       <input type="text" class="form-control" id="exampleInputEmail2" placeholder="Email address" name="hotmail">
                    </div>
                    <div class="form-group">
                      <label class="sr-only" for="exampleInputPassword2">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required name="password">
                      <!-- <div class="help-block text-right"><a href="">Forget the password ?</a></div> -->
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block" name="login">Sign in</button>
                    </div>
                 </form>
              </div>
              <div class="bottom text-center">
                New here? <a href="#signUpDiv"><b>Join my page</b></a>
              </div>
           </div>
        </li>
      </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script type="text/javascript">
function checkScroll()
{
    var startY = $('.navbar').height() * 1;

    if($(window).scrollTop() > startY){
        $('.navbar').addClass("scrolled");
    }else{
        $('.navbar').removeClass("scrolled");
    }
        if($(window).scrollTop() < startY){
        $('.navbar').addClass("back");
    }else{
        $('.navbar').removeClass("back");
    }
}
  if($('.navbar').length > 0)
  {
    $(window).on("scroll load resize", function()
    {
        checkScroll();
    });
  }
  $('a[href^="#"]').on('click', function(event) 
  {
    var target = $(this.getAttribute('href'));
    if( target.length ) {
        event.preventDefault();
        $('html, body').stop().animate({
            scrollTop: target.offset().top
        }, 500);
    }
});
function removeLogInMessage()
{
  $("#logInWarning").hide(800);
}
</script>