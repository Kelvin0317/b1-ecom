<?php 
	require_once '../vendor/autoload.php';
	require('../controllers/UserController.php');
	UserController::create($_POST);
 ?>