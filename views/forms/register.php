<?php
	$title = "Register";
	function get_content() {

?>

<form class="col-md-6 mx-auto py-5" method="POST" action="../../routes/register.php">
		<div class="form-group">
			<label>Firstname</label>
			<input type="text" name="firstname" class="form-control">
		</div>
		<div class="form-group">
			<label>Lastname</label>
			<input type="text" name="lastname" class="form-control">
		</div>
		<div class="form-group">
			<label>Username</label>
			<input type="text" name="username" class="form-control">
		</div>
		<div>
			<label>Email</label>
			<input type="email" name="email" class="form-control">
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" name="password" class="form-control">
		</div>
		<div class="form-group">
			<label>Conform Password</label>
			<input type="password" name="cpassword" class="form-control">
		</div>
		<button class="btn btn-primary">Register</button>
</form>

<?php
	}
	require '../layout.php';

?>