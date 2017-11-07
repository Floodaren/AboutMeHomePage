<?php 
include 'databaseconnection.php';
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
        <li><a href="manageUploadedFiles.php">Manage my files</a></li>
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
        <li><a href="destroySession.php">Sign out</a></li>
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







