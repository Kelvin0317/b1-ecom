<?php 
session_start();
require_once '../vendor/autoload.php';
require('../models/User.php');
class UserController extends User {
	public static function create($user) {
		$firstname = htmlspecialchars($_POST['firstname']);
		$lastname = htmlspecialchars($_POST['lastname']);
		$username = htmlspecialchars($_POST['username']);
		$email = htmlspecialchars($_POST['email']);
		$password = sha1(htmlspecialchars($_POST['password']));
		$password2 = sha1(htmlspecialchars($_POST['cpassword']));
		$error = 0;
		if(strlen($user['username']) < 8){
			$error++;
			echo"Username should be greater than 8 characters.";
		}else if(strlen($user['password']) < 8){
			$error++;
			echo"Password should be greather than 8 charachers";

		}else if(($user['password']) != ($user['cpassword'])){
			$error++;
			echo"Password and Confirm password must be same";

		}else if($error == 0){
			// $user['password'] = sha1($user['password']);
			$query = "INSERT INTO users ( firstname, lastname, username, email, password ) VALUES ('$firstname', '$lastname','$username', '$email', '$password')";
			Model::get_db($query);
			mysqli_close(Model::get_cn());
			header('Location:/');
		}
		// User::send_email($user);
	}

	public static function login($user) {
		$username = $user['username'];
		$password = sha1($user['password']);
		$query = "SELECT id, username, email, isAdmin FROM users WHERE username ='$username' AND password = '$password' ";
		$result = mysqli_fetch_assoc(Model::get_db($query));

		if ($result) {
			$_SESSION['user_details'] = $result;
			header('Location: /');
		} else {
			echo "Please check your credentials";
			echo "<br>";
			echo "<a href='/views/forms/login.php>Go back to Login</a>";
		}
	}

	public static function logout($user){
		session_start();
		session_destroy();
		header('Location: /');
	}
}

 ?>