<?php 

require_once('Model.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/interfaces/Database.php');

class User extends Model{
	public static function check_user($username , $email) {
		$query = "SELECT username, `email` FROM users WHERE username = '$username' AND email = '$email'";
		$result = mysqli_fetch_assoc(mysqli_query($cn, $query));
		if($result != NULL){
		    echo "Username or email is taken";
		    $errors++;
		    mysqli_close($cn);
		}
	}

	public static function find_user($username) {
		$all_users = Model::get_db('../assets/db/users.json');
		foreach($all_users as $user) {
			if($username == $user->username) {
				return $user;
			}
		}
		echo "User does not exist";
	}
}

// $user = new User("John", "Doe", "johndoe17", 17, "profile.jpg", "123456789");
// echo json_encode($user);

 ?>