<?php 
	$title = "Login";
	function get_content() {

?>

<form method="POST" action="/routes/login.php" class="col-md-6 mx-auto py-5 ">
	<div class="form-group">
		<label>Username</label>
		<input type="text" name="username" class="form-control">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" name="password" class="form-control">
	</div>
	<button class="btn btn-primary">Submit</button>
</form>

<?php	}
	require '../layout.php';

?>