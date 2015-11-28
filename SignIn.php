<?php
	session_start(); //starts the session
	include_once("database/connection.php");


	$username = $_POST['username'];
	$pass = $_POST['password'];

	$stmt =$db.prepare('SELECT password FROM Users WHERE username = :username LIMIT 1');
	$stmt->bindParam(':username', $username);
	$stmt->execute();
	$user = $sth->fetch(PDO::FETCH_OBJ);

	// Hashing the password with its hash as the salt returns the same hash
	if ( hash_equals($user->password, crypt($pass, $user->password)) ) {
  		$_SESSION['username'] = $username;            	// store the username
 		$_SESSION['password'] = $password;				// store the password
 		header("location:login_success.php");
 	} else{
 		echo'<script language="javascript">';
		echo 'alert("Incorrect username and/or password.")';
		echo '</script>';
		$redirectUrl = 'index.php';

    	echo '<script type="application/javascript">alert("Registration successful!"); window.location.href = "'.$redirectUrl.'";</script>';
 	}

?>