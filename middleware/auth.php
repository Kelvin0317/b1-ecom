<?php 
if(isset($_SESSION['user_detials']) && !$_SESSION['user_details']['isAdmin']){
	header('Location: /');
}
?>