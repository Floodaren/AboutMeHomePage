<?php
	class dbManagement 
	{
		// Connection function
		function connection()
		{
		$conn = new mysqli(/*"Ip connection"*/, /*"Username"*/, /*"Password"*/, /*"Table in db"*/);
			$conn->set_charset("utf8");
			if ($conn->connect_error) 
			{
				die("Connection failed: " . $conn->connect_error);
			}
			else 
			{
				return $conn;	
			}
		}

		//File functions
		function newFile($owner,$pathway,$filename,$Description)
		{
			$sqlInsert = "INSERT INTO downloadfile (owner,pathway,filename,Description) VALUES ('$owner','$pathway','$filename', '$Description')";
			$object = new dbManagement;
			$conn = $object->connection();
            mysqli_query($conn,$sqlInsert);
		}
		function updateDescription($olddescription,$newdescription)
		{
			$sqlUpdate = "UPDATE `downloadfile` SET `Description` = '$newdescription' WHERE `downloadfile`.`Description` = '$olddescription'";
			$object = new dbManagement;
			$conn = $object->connection();
			mysqli_query($conn, $sqlUpdate);
		}
		function deleteFile($olddescription)
		{
			$sqlDelete = "DELETE FROM `downloadfile` WHERE `downloadfile`.`Description` = '$olddescription'";
			$sqlFilename = "SELECT filename FROM `downloadfile` WHERE `downloadfile`.`Description` ='$olddescription'";
			$object = new dbManagement;
			$conn = $object->connection();
			$getFile = mysqli_query($conn, $sqlFilename);
			$fileNameFromDb = mysqli_fetch_assoc($getFile);
			$fileToDelete = $fileNameFromDb['filename'];
			$wholefilepathway = "uploadSlutprojekt/$fileToDelete";
			mysqli_query($conn, $sqlDelete);
			unlink($wholefilepathway);
		}

		//User functions
		/* The functions below are not in use right now. The reason for this is because i don't want any new members to register themself on my webpage. I've tested these functions to see that they are all working and i will benefit from them in the future. They are configured after the sign up form i have on the page but i can change them in the future when i want them to fit another form that is more suitable*/
		function createNewUser($hotmail,$password,$fname,$lname)
		{
			$sqlNewUser = "INSERT INTO users (hotmail,password,fname,lname,typeofuser) VALUES ('$hotmail','$password','$fname','$lname','User')";
			$object = new dbManagement;
			$conn = $object->connection();
			mysqli_query($conn, $sqlNewUser);
		}
		function deleteUser($hotmail)
		{
			$sqlDeleteUser = "DELETE FROM users WHERE `users`.`hotmail` = '$hotmail'";
			$object = new dbManagement;
			$conn = $object->connection();
			mysqli_query($conn, $sqlDeleteUser);
		}

		/*I know that the function below isn't flawless because i'm updating a user where the user types in the first name and last name. I'm also aware that this can be a problem if two or more persons have the same for- and last name. My plan from them beginning was that only I was supposed to be a user and therefore I didn't create a ID-column in the database. This is something i will change in the future, but for now i'm happy with the result i'm having. */
		function updateUserHotmail($hotmail,$fname,$lname)
		{
			$sqlUpdateUserHotmail = "UPDATE `users` SET `hotmail` = '$hotmail' WHERE `users`.`fname` = '$fname' AND `users`.`lname` = '$lname'";
			$object = new dbManagement;
			$conn = $object->connection();
			mysqli_query($conn, $sqlUpdateUserHotmail);
		}
		function updateUserPassword($hotmail,$password)
		{
			$sqlUpdateUserPassword = "UPDATE `users` SET `password` = '$password' WHERE `users`.`hotmail` = '$hotmail'";
			$object = new dbManagement;
			$conn = $object->connection();
			mysqli_query($conn, $sqlUpdateUserPassword);
		}
		function updateUserFname($hotmail,$fname)
		{
			$sqlUpdateUserFname = "UPDATE `users` SET `fname` = '$fname' WHERE `users`.`hotmail` = '$hotmail'";
			$object = new dbManagement;
			$conn = $object->connection();
			mysqli_query($conn, $sqlUpdateUserFname);
		}
		function updateUserLname($hotmail,$lname)
		{
			$sqlUpdateUserLname = "UPDATE `users` SET `lname` = '$lname' WHERE `users`.`hotmail` = '$hotmail'";
			$object = new dbManagement;
			$conn = $object->connection();
			mysqli_query($conn, $sqlUpdateUserLname);
		}
		function seeAllMembers()
		{
			$sqlAllMembers = "SELECT hotmail,password,fname,lname,typeofuser FROM users";
			$object = new dbManagement;
			$conn = $object->connection();
			$result = mysqli_query($conn, $sqlAllMembers);
			while ($members = mysqli_fetch_assoc($result))
			{
				echo $members['hotmail']." ".$members['fname']." ".$members['lname']."<br>";
			}
		}
		function checkIfMembersExist($hotmail,$password,$fname,$lname)
		{
			$sqlCheckAllMembers = "SELECT * FROM users";
			$foundHotmail = 0;
			$object = new dbManagement;
			$conn = $object->connection();
			$result = mysqli_query($conn, $sqlCheckAllMembers);
			while ($members = mysqli_fetch_assoc($result))
			{
				if ($hotmail == $members['hotmail'])
				{
					$foundHotmail = 1;
				}
			}
			if ($foundHotmail == 1)
			{
				$errorMessage = "<div class='alert alert-dismissible alert-danger' id='logInWarning' onclick='removeLogInMessage()'><strong>Either you entered an invalid login-input or you are not registered. Please try again!</strong><br><a href='#' id='warningLink'>(Press here to remove this message)</a></div>";
				return $errorMessage;
			}
			else 
			{
				$object->createNewUser($hotmail,$password,$fname,$lname);
			}
		}
	} 
?>