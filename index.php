<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
	session_start();
	include 'head.php';
	?>
</head>
<body>
	<?php
	if (isset($_SESSION["logInId"]) || isset($_COOKIE['Admin']))
	{
		include 'navbarLoggedIn.php';
	}
	else 
	{
		include 'navbar.php';
	}
	?> 
	<div class="divIndex" id="pictureOfMeDiv">
		<?php include 'pictureOfMe.html' ?>
	</div>

	<div class="divIndex" id="aboutMeDiv">
		<?php include 'aboutMe.php'; ?>
	</div>

	<div class="divIndex" id="uploadedFilesDiv">
		<?php include 'showUploadedFiles.php';?>
	</div>

	<div class="divIndex" id="cvDiv">
		<?php include 'cvTable.html'; ?>
	</div>

	<div class="divIndex" id="signUpDiv">
		<?php include 'signUp.php';?>
	</div>

	<footer id="footer">
		<?php include 'footer.html'; ?>
	</footer>
</body>
</html>